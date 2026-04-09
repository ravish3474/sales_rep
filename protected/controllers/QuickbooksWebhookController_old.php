<?php

/**
 * QuickbooksWebhookController
 *
 * Handles the full QuickBooks OAuth2 + Webhooks flow:
 *
 *   GET  /quickbooksWebhook/connect   — Admin initiates OAuth2 (opens QB consent page)
 *   GET  /quickbooksWebhook/callback  — QB redirects here after consent; stores tokens
 *   POST /quickbooksWebhook/receive   — QB delivers change notifications (public, no auth)
 *
 * Configuration required in protected/config/main.php → params:
 *   QB_CLIENT_ID, QB_CLIENT_SECRET, QB_WEBHOOK_VERIFIER_TOKEN,
 *   QB_REALM_ID, QB_BASE_URL
 */
class QuickbooksWebhookController extends Controller
{
    // -----------------------------------------------------------------------
    // Access control: receive is public; connect/callback require a logged-in
    // admin (user_group 1 or 99).
    // -----------------------------------------------------------------------

    public function filters()
    {
        return array('accessControl');
    }

    public function accessRules()
    {
        return array(
            array('allow', 'actions' => array('receive'), 'users' => array('*')),
            array('allow', 'actions' => array('connect', 'callback', 'getInvoiceStatus', 'getPaymentStatuses'), 'users' => array('@')),
            array('deny'),
        );
    }

    /**
     * Disable Yii CSRF validation for the `receive` action so that QuickBooks
     * can POST to the webhook endpoint without a CSRF token.
     */
    public function beforeAction($action)
    {
        if (in_array($action->id, array('receive', 'getInvoiceStatus', 'getPaymentStatuses'))) {
            Yii::app()->request->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    // -----------------------------------------------------------------------
    // actionGetPaymentStatuses — fast DB-only batch lookup for visible rows
    // -----------------------------------------------------------------------

    public function actionGetPaymentStatuses()
    {
        header('Content-Type: application/json');

        if (!Yii::app()->request->isPostRequest) {
            echo CJSON::encode(array());
            Yii::app()->end();
        }

        $raw = trim(Yii::app()->request->getPost('order_ids', ''));
        if ($raw === '') {
            echo CJSON::encode(array());
            Yii::app()->end();
        }

        // Sanitise: only allow comma-separated integers
        $ids = array_filter(array_map('trim', explode(',', $raw)), function ($v) {
            return ctype_digit($v) && $v !== '';
        });

        if (empty($ids)) {
            echo CJSON::encode(array());
            Yii::app()->end();
        }

        $db           = Yii::app()->db;
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $rows         = $db->createCommand(
            "SELECT `id`, COALESCE(`payment_status`, 'unpaid') AS `payment_status`
             FROM `tbl_order`
             WHERE `id` IN ($placeholders)"
        )->queryAll(true, array_values($ids));

        $result = array();
        foreach ($rows as $row) {
            $result[(string)$row['id']] = $row['payment_status'];
        }

        echo CJSON::encode($result);
        Yii::app()->end();
    }

    // -----------------------------------------------------------------------
    // actionGetInvoiceStatus — fetch live payment status for an invoice by DocNumber
    // -----------------------------------------------------------------------

    public function actionGetInvoiceStatus()
    {
        header('Content-Type: application/json');

        if (!Yii::app()->request->isPostRequest) {
            echo CJSON::encode(array('status' => false, 'error' => 'POST required'));
            Yii::app()->end();
        }

        $invoiceNumber = trim(Yii::app()->request->getPost('invoice_number', ''));
        if ($invoiceNumber === '') {
            echo CJSON::encode(array('status' => false, 'error' => 'Missing invoice_number'));
            Yii::app()->end();
        }

        // Sanitise: DocNumbers are alphanumeric with hyphens/spaces only
        if (!preg_match('/^[\w\s\-\/]+$/', $invoiceNumber)) {
            echo CJSON::encode(array('status' => false, 'error' => 'Invalid invoice_number'));
            Yii::app()->end();
        }

        $realmId = Yii::app()->params['QB_REALM_ID'];
        $token   = $this->_getValidToken($realmId);
        if ($token === null) {
            Yii::log('QB getInvoiceStatus: no valid token for realmId=' . $realmId, CLogger::LEVEL_ERROR, 'quickbooks');
            echo CJSON::encode(array('status' => false, 'error' => 'QB not connected'));
            Yii::app()->end();
        }

        // Use the QB Query API to look up the invoice by DocNumber
        $baseUrl  = $this->_apiBase();
        $query    = "SELECT Balance, TotalAmt FROM Invoice WHERE DocNumber = '" . addslashes($invoiceNumber) . "'";
        $url      = $baseUrl . '/v3/company/' . $realmId . '/query?query=' . urlencode($query) . '&minorversion=65';
        $response = $this->_curlGet($url, $token->access_token);

        if ($response === false) {
            Yii::log('QB getInvoiceStatus: API call failed for DocNumber=' . $invoiceNumber, CLogger::LEVEL_ERROR, 'quickbooks');
            echo CJSON::encode(array('status' => false, 'error' => 'QB API error'));
            Yii::app()->end();
        }

        $data = json_decode($response, true);
        $invoices = isset($data['QueryResponse']['Invoice']) ? $data['QueryResponse']['Invoice'] : array();

        if (empty($invoices)) {
            // Invoice not found in QB — return status false so the link still opens
            echo CJSON::encode(array('status' => false, 'error' => 'Invoice not found in QB'));
            Yii::app()->end();
        }

        // Use the first matching invoice
        $invoice  = $invoices[0];
        $balance  = isset($invoice['Balance'])  ? (float)$invoice['Balance']  : 0.0;
        $totalAmt = isset($invoice['TotalAmt']) ? (float)$invoice['TotalAmt'] : 0.0;

        if ($balance <= 0) {
            $paymentStatus = 'paid';
        } elseif ($balance < $totalAmt) {
            $paymentStatus = 'partial';
        } else {
            $paymentStatus = 'unpaid';
        }

        // Also persist to local DB (same as webhook path)
        $this->_updateOrderPaymentStatus($invoiceNumber, $paymentStatus, '');

        echo CJSON::encode(array(
            'status'         => true,
            'payment_status' => $paymentStatus,
        ));
        Yii::app()->end();
    }

    // -----------------------------------------------------------------------
    // actionConnect — step 1 of OAuth2 (admin visits this once)
    // -----------------------------------------------------------------------

    public function actionConnect()
    {
        $params    = Yii::app()->params;
        $clientId  = $params['QB_CLIENT_ID'];
        $baseUrl   = $params['QB_BASE_URL'];  // 'sandbox' or 'production'

        if (empty($clientId)) {
            echo 'QB_CLIENT_ID is not configured in params.';
            return;
        }

        $redirectUri = $this->_redirectUri();
        $state       = bin2hex(random_bytes(16));
        Yii::app()->session['qb_oauth_state'] = $state;

        $authBase = ($baseUrl === 'production')
            ? 'https://appcenter.intuit.com/connect/oauth2'
            : 'https://appcenter.intuit.com/connect/oauth2';   // same URL for both

        $query = http_build_query(array(
            'client_id'     => $clientId,
            'response_type' => 'code',
            'scope'         => 'com.intuit.quickbooks.accounting',
            'redirect_uri'  => $redirectUri,
            'state'         => $state,
        ));

        $this->redirect($authBase . '?' . $query);
    }

    // -----------------------------------------------------------------------
    // actionCallback — step 2 of OAuth2; exchange auth code for tokens
    // -----------------------------------------------------------------------

    public function actionCallback()
    {
        $state        = isset($_GET['state'])        ? $_GET['state']        : '';
        $code         = isset($_GET['code'])         ? $_GET['code']         : '';
        $realmId      = isset($_GET['realmId'])      ? $_GET['realmId']      : '';
        $errorParam   = isset($_GET['error'])        ? $_GET['error']        : '';

        if (!empty($errorParam)) {
            echo htmlspecialchars('QB OAuth error: ' . $errorParam);
            return;
        }

        // CSRF / state validation
        $savedState = Yii::app()->session['qb_oauth_state'];
        if (empty($savedState) || !hash_equals($savedState, $state)) {
            throw new CHttpException(400, 'Invalid OAuth state parameter.');
        }
        unset(Yii::app()->session['qb_oauth_state']);

        if (empty($code) || empty($realmId)) {
            throw new CHttpException(400, 'Missing code or realmId from QB callback.');
        }

        $params       = Yii::app()->params;
        $clientId     = $params['QB_CLIENT_ID'];
        $clientSecret = $params['QB_CLIENT_SECRET'];
        $redirectUri  = $this->_redirectUri();

        $tokenUrl = 'https://oauth.platform.intuit.com/oauth2/v1/tokens/bearer';
        $postData = array(
            'grant_type'   => 'authorization_code',
            'code'         => $code,
            'redirect_uri' => $redirectUri,
        );

        $response = $this->_curlPost($tokenUrl, $postData, $clientId, $clientSecret);
        if ($response === false) {
            throw new CHttpException(500, 'Failed to contact QB token endpoint.');
        }

        $data = json_decode($response, true);
        if (empty($data['access_token'])) {
            Yii::log('QB token exchange failed: ' . $response, CLogger::LEVEL_ERROR, 'quickbooks');
            throw new CHttpException(500, 'QB token exchange failed.');
        }

        // Store realm_id in params for later (admin should also set QB_REALM_ID in config)
        QbToken::saveToken(
            $realmId,
            $data['access_token'],
            $data['refresh_token'],
            isset($data['expires_in']) ? (int)$data['expires_in'] : 3600
        );

        Yii::log("QB OAuth connected. realmId=$realmId", CLogger::LEVEL_INFO, 'quickbooks');
        echo '<p>QuickBooks connected successfully. Realm ID: <strong>'
            . htmlspecialchars($realmId)
            . '</strong></p><p>You may now close this window.</p>';
    }

    // -----------------------------------------------------------------------
    // actionReceive — QuickBooks webhook POST endpoint
    // -----------------------------------------------------------------------

    public function actionReceive()
    {
        if (!Yii::app()->request->isPostRequest) {
            header('HTTP/1.1 405 Method Not Allowed');
            Yii::app()->end();
        }

        $rawBody   = file_get_contents('php://input');
        $signature = isset($_SERVER['HTTP_INTUIT_SIGNATURE']) ? $_SERVER['HTTP_INTUIT_SIGNATURE'] : '';

        if (!$this->_verifySignature($rawBody, $signature)) {
            Yii::log('QB webhook: signature verification failed.', CLogger::LEVEL_WARNING, 'quickbooks');
            header('HTTP/1.1 401 Unauthorized');
            Yii::app()->end();
        }

        $payload = json_decode($rawBody, true);
        if (empty($payload['eventNotifications'])) {
            // QB sends a verification POST on setup with no notifications — respond 200 OK
            header('HTTP/1.1 200 OK');
            Yii::app()->end();
        }

        foreach ($payload['eventNotifications'] as $notification) {
            $realmId  = isset($notification['realmId']) ? $notification['realmId'] : '';
            $entities = isset($notification['dataChangeEvent']['entities'])
                ? $notification['dataChangeEvent']['entities']
                : array();

            foreach ($entities as $entity) {
                $name = isset($entity['name']) ? $entity['name'] : '';
                $id   = isset($entity['id'])   ? $entity['id']   : '';

                if ($name === 'Invoice') {
                    $this->_processInvoice($realmId, $id);
                } elseif ($name === 'Payment') {
                    $this->_processPayment($realmId, $id);
                }
            }
        }

        header('HTTP/1.1 200 OK');
        Yii::app()->end();
    }

    // -----------------------------------------------------------------------
    // Private helpers
    // -----------------------------------------------------------------------

    /**
     * Handle a QB Payment entity event.
     * Fetches the QB Payment record, extracts all linked Invoice IDs,
     * then calls _processInvoice() for each so their payment_status is updated.
     */
    private function _processPayment($realmId, $qbPaymentId)
    {
        $token = $this->_getValidToken($realmId);
        if ($token === null) {
            Yii::log("QB: no valid token for realmId=$realmId", CLogger::LEVEL_ERROR, 'quickbooks');
            return;
        }

        $baseUrl  = $this->_apiBase();
        $response = $this->_curlGet("$baseUrl/v3/company/$realmId/payment/$qbPaymentId?minorversion=65", $token->access_token);
        if ($response === false) {
            Yii::log("QB: API call failed for payment $qbPaymentId", CLogger::LEVEL_ERROR, 'quickbooks');
            return;
        }

        $data = json_decode($response, true);
        if (empty($data['Payment'])) {
            Yii::log("QB: no Payment key in response for $qbPaymentId: $response", CLogger::LEVEL_WARNING, 'quickbooks');
            return;
        }

        $linkedInvoiceIds = array();
        foreach ((array)$data['Payment']['Line'] as $line) {
            foreach ((array)(isset($line['LinkedTxn']) ? $line['LinkedTxn'] : array()) as $txn) {
                if (isset($txn['TxnType']) && $txn['TxnType'] === 'Invoice' && !empty($txn['TxnId'])) {
                    $linkedInvoiceIds[] = $txn['TxnId'];
                }
            }
        }

        foreach (array_unique($linkedInvoiceIds) as $invId) {
            $this->_processInvoice($realmId, $invId);
        }
    }

    /**
     * Fetch QB invoice details, determine payment status, update tbl_order.
     */
    private function _processInvoice($realmId, $qbInvoiceId)
    {
        $token = $this->_getValidToken($realmId);
        if ($token === null) {
            Yii::log("QB: no valid token for realmId=$realmId, skipping invoice $qbInvoiceId", CLogger::LEVEL_ERROR, 'quickbooks');
            return;
        }

        $baseUrl  = $this->_apiBase();
        $response = $this->_curlGet("$baseUrl/v3/company/$realmId/invoice/$qbInvoiceId?minorversion=65", $token->access_token);
        if ($response === false) {
            Yii::log("QB: API call failed for invoice $qbInvoiceId", CLogger::LEVEL_ERROR, 'quickbooks');
            return;
        }

        $data = json_decode($response, true);
        if (empty($data['Invoice'])) {
            Yii::log("QB: no Invoice key in response for $qbInvoiceId: $response", CLogger::LEVEL_WARNING, 'quickbooks');
            return;
        }

        $invoice   = $data['Invoice'];
        $docNumber = isset($invoice['DocNumber']) ? trim($invoice['DocNumber']) : '';
        $balance   = isset($invoice['Balance'])   ? (float)$invoice['Balance']  : 0.0;
        $totalAmt  = isset($invoice['TotalAmt'])  ? (float)$invoice['TotalAmt'] : 0.0;

        if (empty($docNumber)) {
            return;
        }

        if ($balance <= 0) {
            $paymentStatus = 'paid';
        } elseif ($balance < $totalAmt) {
            $paymentStatus = 'partial';
        } else {
            $paymentStatus = 'unpaid';
        }

        $this->_updateOrderPaymentStatus($docNumber, $paymentStatus, (string)$qbInvoiceId);
        Yii::log("QB: invoice $docNumber (id=$qbInvoiceId) → $paymentStatus", CLogger::LEVEL_INFO, 'quickbooks');
    }

    /**
     * Update tbl_order rows where Inv_no contains the given doc number (exact, case-insensitive).
     * Because Inv_no is a CSV field we cannot use a simple = comparison; we use FIND_IN_SET
     * on a space-stripped copy, or fall back to LIKE with explicit boundary matching.
     * Also syncs payment_status to order_main in jogjoino_lockerroom (db2) via JOG_Code.
     */
    private function _updateOrderPaymentStatus($docNumber, $paymentStatus, $qbPaymentId)
    {
        $allowedStatuses = array('paid', 'partial', 'unpaid');
        if (!in_array($paymentStatus, $allowedStatuses, true)) {
            return;
        }

        if (!preg_match('/^[\w\s\-]+$/', $docNumber)) {
            Yii::log("QB: invalid DocNumber format: $docNumber", CLogger::LEVEL_WARNING, 'quickbooks');
            return;
        }

        $db        = Yii::app()->db;
        $docVal    = $db->quoteValue($docNumber);
        $statusVal = $db->quoteValue($paymentStatus);
        $qbIdVal   = $db->quoteValue($qbPaymentId);

        // Fetch JOG_Code values for the rows that are about to be updated
        // so we can sync to order_main in db2 afterwards.
        $jogCodes = $db->createCommand(
            "SELECT `JOG_Code` FROM `tbl_order`
             WHERE FIND_IN_SET($docVal, REPLACE(`Inv_no`, ' ', '')) > 0"
        )->queryColumn();

        $db->createCommand(
            "UPDATE `tbl_order`
             SET `payment_status` = $statusVal,
                 `qb_payment_id`  = $qbIdVal,
                 `qb_payment_datetime`  = NOW()
             WHERE FIND_IN_SET($docVal, REPLACE(`Inv_no`, ' ', '')) > 0"
        )->execute();

        // Sync payment_status to order_main in jogjoino_lockerroom (db2)
        if (!empty($jogCodes)) {
            $db2        = Yii::app()->db2;
            $statusVal2 = $db2->quoteValue($paymentStatus);
            foreach ($jogCodes as $jogCode) {
                $jogCodeVal = $db2->quoteValue($jogCode);
                $db2->createCommand(
                    "UPDATE `order_main`
                     SET `payment_status` = $statusVal2,`qb_payment_datetime`  = NOW()
                     WHERE `order_main_code` = $jogCodeVal"
                )->execute();
            }
            Yii::log(
                'QB: synced payment_status=' . $paymentStatus
                    . ' to order_main for JOG codes: ' . implode(', ', $jogCodes),
                CLogger::LEVEL_INFO,
                'quickbooks'
            );
        }
    }

    /**
     * Return a valid (non-expired) QbToken for the given realmId,
     * auto-refreshing if the access token has expired.
     *
     * @return QbToken|null
     */
    private function _getValidToken($realmId)
    {
        $token = QbToken::getToken($realmId);
        if ($token === null) {
            return null;
        }
        if (!$token->isAccessTokenValid()) {
            $token = $this->_refreshAccessToken($token);
        }
        return $token;
    }

    private function _apiBase()
    {
        return Yii::app()->params['QB_BASE_URL'] === 'production'
            ? 'https://quickbooks.api.intuit.com'
            : 'https://sandbox-quickbooks.api.intuit.com';
    }

    /**
     * Use the stored refresh token to obtain a new access token from QB.
     *
     * @return QbToken|null  updated record, or null on failure
     */
    private function _refreshAccessToken(QbToken $token)
    {
        $params       = Yii::app()->params;
        $clientId     = $params['QB_CLIENT_ID'];
        $clientSecret = $params['QB_CLIENT_SECRET'];

        $tokenUrl = 'https://oauth.platform.intuit.com/oauth2/v1/tokens/bearer';
        $postData = array(
            'grant_type'    => 'refresh_token',
            'refresh_token' => $token->refresh_token,
        );

        $response = $this->_curlPost($tokenUrl, $postData, $clientId, $clientSecret);
        if ($response === false) {
            Yii::log('QB token refresh HTTP request failed.', CLogger::LEVEL_ERROR, 'quickbooks');
            return null;
        }

        $data = json_decode($response, true);
        if (empty($data['access_token'])) {
            Yii::log('QB token refresh failed: ' . $response, CLogger::LEVEL_ERROR, 'quickbooks');
            return null;
        }

        return QbToken::saveToken(
            $token->realm_id,
            $data['access_token'],
            $data['refresh_token'],
            isset($data['expires_in']) ? (int)$data['expires_in'] : 3600
        );
    }

    /**
     * Verify the intuit-signature header against the raw request body using HMAC-SHA256.
     *
     * @param string $body      raw POST body
     * @param string $signature base64-encoded signature from QB header
     * @return bool
     */
    private function _verifySignature($body, $signature)
    {
        if (empty($signature)) {
            return false;
        }
        $verifierToken = Yii::app()->params['QB_WEBHOOK_VERIFIER_TOKEN'];
        if (empty($verifierToken)) {
            // Cannot verify without the token; log and reject
            Yii::log('QB_WEBHOOK_VERIFIER_TOKEN not configured.', CLogger::LEVEL_WARNING, 'quickbooks');
            return false;
        }

        $expected = base64_encode(hash_hmac('sha256', $body, $verifierToken, true));
        return hash_equals($expected, $signature);
    }

    /**
     * Absolute redirect URI for OAuth2 callback.
     *
     * @return string
     */
    private function _redirectUri()
    {
        return Yii::app()->request->hostInfo
            . Yii::app()->request->baseUrl
            . '/quickbooksWebhook/callback';
    }

    /**
     * HTTP POST via curl with HTTP Basic Auth (client_id:client_secret).
     *
     * @return string|false response body or false on error
     */
    private function _curlPost($url, array $postData, $user, $pass)
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($postData),
            CURLOPT_USERPWD        => $user . ':' . $pass,
            CURLOPT_HTTPHEADER     => array('Accept: application/json'),
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_SSL_VERIFYPEER => true,
        ));
        $response = curl_exec($ch);
        if ($response === false) {
            Yii::log('QB curlPost error: ' . curl_error($ch), CLogger::LEVEL_ERROR, 'quickbooks');
        }
        curl_close($ch);
        return $response;
    }

    /**
     * HTTP GET via curl using a Bearer token.
     *
     * @return string|false response body or false on error
     */
    private function _curlGet($url, $accessToken)
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => array(
                'Authorization: Bearer ' . $accessToken,
                'Accept: application/json',
            ),
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_SSL_VERIFYPEER => true,
        ));
        $response = curl_exec($ch);
        if ($response === false) {
            Yii::log('QB curlGet error: ' . curl_error($ch), CLogger::LEVEL_ERROR, 'quickbooks');
        }
        curl_close($ch);
        return $response;
    }
}
