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
            array('allow', 'actions' => array('connect', 'callback', 'test'), 'users' => array('@')),
            array('deny'),
        );
    }

    // -----------------------------------------------------------------------
    // actionTest — TEMPORARY: manually trigger invoice processing (remove in production)
    // Usage: /quickbooksWebhook/test?inv_id=<QB invoice ID>
    // -----------------------------------------------------------------------

    public function actionTest()
    {
        $realmId = Yii::app()->params['QB_REALM_ID'];
        if (empty($realmId)) {
            echo '<p style="color:red">QB_REALM_ID is not set in params.</p>';
            return;
        }

        $qbInvoiceId = isset($_GET['inv_id']) ? trim($_GET['inv_id']) : '';

        // No inv_id supplied — list active invoices so the user can pick one
        if (empty($qbInvoiceId)) {
            $token = $this->_getValidToken($realmId);
            if ($token === null) {
                echo '<p style="color:red">No valid token. Visit /quickbooksWebhook/connect first.</p>';
                return;
            }
            $params  = Yii::app()->params;
            $base    = $params['QB_BASE_URL'] === 'production'
                ? 'https://quickbooks.api.intuit.com'
                : 'https://sandbox-quickbooks.api.intuit.com';
            $url     = "$base/v3/company/$realmId/query?query="
                . urlencode("SELECT Id, DocNumber, TotalAmt, Balance FROM Invoice MAXRESULTS 20")
                . "&minorversion=65";
            $resp    = $this->_curlGet($url, $token->access_token);
            $json    = $resp ? json_decode($resp, true) : null;
            $invoices = isset($json['QueryResponse']['Invoice']) ? $json['QueryResponse']['Invoice'] : array();

            echo '<h3>Active Invoices in QB Sandbox (pick an Id to test)</h3>';
            if (empty($invoices)) {
                echo '<p style="color:orange">No active invoices found. Raw response: <pre>'
                    . htmlspecialchars($resp) . '</pre></p>';
                return;
            }
            echo '<table border="1" cellpadding="4" style="border-collapse:collapse">'
                . '<tr><th>QB Id</th><th>DocNumber</th><th>TotalAmt</th><th>Balance</th><th>Test link</th></tr>';
            foreach ($invoices as $inv) {
                $id  = htmlspecialchars($inv['Id']);
                $doc = htmlspecialchars(isset($inv['DocNumber']) ? $inv['DocNumber'] : '');
                $tot = htmlspecialchars(isset($inv['TotalAmt']) ? $inv['TotalAmt'] : '');
                $bal = htmlspecialchars(isset($inv['Balance'])  ? $inv['Balance']  : '');
                $url = '?inv_id=' . $inv['Id'];
                echo "<tr><td>$id</td><td>$doc</td><td>$tot</td><td>$bal</td>"
                    . "<td><a href='$url'>Test this</a></td></tr>";
            }
            echo '</table>';
            return;
        }

        if (!ctype_digit($qbInvoiceId)) {
            echo '<p style="color:red">inv_id must be numeric.</p>';
            return;
        }

        echo "<p>Processing QB invoice ID <strong>$qbInvoiceId</strong> for realm <strong>$realmId</strong>...</p>";

        $token = $this->_getValidToken($realmId);
        if ($token === null) {
            echo '<p style="color:red">No valid token found. Please visit /quickbooksWebhook/connect first.</p>';
            return;
        }

        $params  = Yii::app()->params;
        $baseUrl = $params['QB_BASE_URL'] === 'production'
            ? 'https://quickbooks.api.intuit.com'
            : 'https://sandbox-quickbooks.api.intuit.com';

        $url      = "$baseUrl/v3/company/$realmId/invoice/$qbInvoiceId?minorversion=65";
        $response = $this->_curlGet($url, $token->access_token);

        if ($response === false) {
            echo '<p style="color:red">QB API call failed. Check Yii logs.</p>';
            return;
        }

        $data = json_decode($response, true);
        if (empty($data['Invoice'])) {
            echo '<p style="color:red">QB response did not contain an Invoice. Raw response:</p><pre>'
                . htmlspecialchars($response) . '</pre>';
            return;
        }

        $invoice   = $data['Invoice'];
        $docNumber = isset($invoice['DocNumber']) ? trim($invoice['DocNumber']) : '(none)';
        $balance   = isset($invoice['Balance'])   ? (float)$invoice['Balance']   : 0.0;
        $totalAmt  = isset($invoice['TotalAmt'])  ? (float)$invoice['TotalAmt']  : 0.0;

        if ($balance <= 0) {
            $paymentStatus = 'paid';
        } elseif ($balance < $totalAmt) {
            $paymentStatus = 'partial';
        } else {
            $paymentStatus = 'unpaid';
        }

        echo "<p>Invoice found: DocNumber=<strong>$docNumber</strong>, "
            . "TotalAmt=<strong>$totalAmt</strong>, Balance=<strong>$balance</strong> "
            . "→ status=<strong style='color:" . ($paymentStatus === 'paid' ? 'green' : ($paymentStatus === 'partial' ? 'orange' : 'red')) . "'>$paymentStatus</strong></p>";

        $this->_updateOrderPaymentStatus($docNumber, $paymentStatus, (string)$qbInvoiceId);

        // Check if any rows were actually updated
        $db   = Yii::app()->db;
        $safe = $db->quoteValue($docNumber);
        $rows = $db->createCommand(
            "SELECT id, Inv_no, payment_status FROM tbl_order
              WHERE FIND_IN_SET($safe, REPLACE(`Inv_no`, ' ', '')) > 0"
        )->queryAll();

        if (empty($rows)) {
            echo "<p style='color:orange'>No rows in tbl_order matched DocNumber <strong>$docNumber</strong>. "
                . "Check that Inv_no contains this value.</p>";
        } else {
            echo '<p style="color:green">Updated ' . count($rows) . ' order row(s):</p><ul>';
            foreach ($rows as $row) {
                echo '<li>Order ID ' . htmlspecialchars($row['id'])
                    . ' | Inv_no: ' . htmlspecialchars($row['Inv_no'])
                    . ' | payment_status: <strong>' . htmlspecialchars($row['payment_status']) . '</strong></li>';
            }
            echo '</ul>';
        }
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
        // Only accept POST
        if (!Yii::app()->request->isPostRequest) {
            header('HTTP/1.1 405 Method Not Allowed');
            Yii::app()->end();
        }

        $rawBody  = file_get_contents('php://input');
        $signature = isset($_SERVER['HTTP_INTUIT_SIGNATURE'])
            ? $_SERVER['HTTP_INTUIT_SIGNATURE']
            : '';

        // 1. Verify HMAC-SHA256 signature
        if (!$this->_verifySignature($rawBody, $signature)) {
            Yii::log('QB webhook signature mismatch.', CLogger::LEVEL_WARNING, 'quickbooks');
            header('HTTP/1.1 401 Unauthorized');
            Yii::app()->end();
        }

        $payload = json_decode($rawBody, true);
        if (empty($payload['eventNotifications'])) {
            // QB sends an empty verification POST on setup — respond 200 OK
            header('HTTP/1.1 200 OK');
            Yii::app()->end();
        }

        // 2. Process each notification
        foreach ($payload['eventNotifications'] as $notification) {
            $realmId = isset($notification['realmId']) ? $notification['realmId'] : '';
            if (empty($realmId)) {
                continue;
            }

            $entities = isset($notification['dataChangeEvent']['entities'])
                ? $notification['dataChangeEvent']['entities']
                : array();

            foreach ($entities as $entity) {
                if ($entity['name'] !== 'Invoice') {
                    continue;
                }
                $qbInvoiceId = $entity['id'];
                $this->_processInvoice($realmId, $qbInvoiceId);
            }
        }

        header('HTTP/1.1 200 OK');
        Yii::app()->end();
    }

    // -----------------------------------------------------------------------
    // Private helpers
    // -----------------------------------------------------------------------

    /**
     * Fetch QB invoice details, determine payment status, update tbl_order.
     */
    private function _processInvoice($realmId, $qbInvoiceId)
    {
        // Ensure we have a valid access token
        $token = $this->_getValidToken($realmId);
        if ($token === null) {
            Yii::log(
                "QB webhook: no valid token for realmId=$realmId, skipping invoice $qbInvoiceId",
                CLogger::LEVEL_WARNING, 'quickbooks'
            );
            return;
        }

        // Fetch the invoice from QB API
        $params  = Yii::app()->params;
        $baseUrl = $params['QB_BASE_URL'] === 'production'
            ? 'https://quickbooks.api.intuit.com'
            : 'https://sandbox-quickbooks.api.intuit.com';

        $url      = "$baseUrl/v3/company/$realmId/invoice/$qbInvoiceId?minorversion=65";
        $response = $this->_curlGet($url, $token->access_token);

        if ($response === false) {
            Yii::log("QB API call failed for invoice $qbInvoiceId", CLogger::LEVEL_ERROR, 'quickbooks');
            return;
        }

        $data = json_decode($response, true);
        if (empty($data['Invoice'])) {
            Yii::log("QB invoice response missing Invoice key: $response", CLogger::LEVEL_WARNING, 'quickbooks');
            return;
        }

        $invoice  = $data['Invoice'];
        $docNumber = isset($invoice['DocNumber']) ? trim($invoice['DocNumber']) : '';
        $balance   = isset($invoice['Balance'])   ? (float)$invoice['Balance']   : 0.0;
        $totalAmt  = isset($invoice['TotalAmt'])  ? (float)$invoice['TotalAmt']  : 0.0;

        if (empty($docNumber)) {
            return;
        }

        // Map QB balances to our three statuses
        if ($balance <= 0) {
            $paymentStatus = 'paid';
        } elseif ($balance < $totalAmt) {
            $paymentStatus = 'partial';
        } else {
            $paymentStatus = 'unpaid';
        }

        // Update every tbl_order row whose Inv_no contains this DocNumber.
        // We split the CSV, trim each part, and match exactly to avoid false positives.
        $this->_updateOrderPaymentStatus($docNumber, $paymentStatus, (string)$qbInvoiceId);

        Yii::log(
            "QB invoice $docNumber (id=$qbInvoiceId) → status=$paymentStatus",
            CLogger::LEVEL_INFO, 'quickbooks'
        );
    }

    /**
     * Update tbl_order rows where Inv_no contains the given doc number (exact, case-insensitive).
     * Because Inv_no is a CSV field we cannot use a simple = comparison; we use FIND_IN_SET
     * on a space-stripped copy, or fall back to LIKE with explicit boundary matching.
     */
    private function _updateOrderPaymentStatus($docNumber, $paymentStatus, $qbPaymentId)
    {
        $db = Yii::app()->db;

        // Allowed values — whitelist to prevent injection via webhook data
        $allowedStatuses = array('paid', 'partial', 'unpaid');
        if (!in_array($paymentStatus, $allowedStatuses, true)) {
            return;
        }

        // Sanitise docNumber — allow only alphanumeric, dash, space
        if (!preg_match('/^[\w\s\-]+$/', $docNumber)) {
            Yii::log("QB webhook: invalid DocNumber format: $docNumber", CLogger::LEVEL_WARNING, 'quickbooks');
            return;
        }

        $docNumber    = $db->quoteValue($docNumber);
        $statusVal    = $db->quoteValue($paymentStatus);
        $qbIdVal      = $db->quoteValue($qbPaymentId);

        // FIND_IN_SET works on comma-separated values but is space-sensitive.
        // We cover both "INV-001" and " INV-001" by checking with and without leading space.
        $sql = "UPDATE `tbl_order`
                SET `payment_status` = $statusVal,
                    `qb_payment_id`  = $qbIdVal
                WHERE FIND_IN_SET($docNumber, REPLACE(`Inv_no`, ' ', '')) > 0";

        $db->createCommand($sql)->execute();
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
