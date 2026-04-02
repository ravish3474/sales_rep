<?php

/**
 * QbToken — ActiveRecord for the `qb_tokens` table.
 *
 * Columns:
 *   id            int PK AI
 *   realm_id      varchar(100) UNIQUE  — QuickBooks company (realm) ID
 *   access_token  text                 — short-lived Bearer token
 *   refresh_token text                 — long-lived refresh token
 *   token_expiry  datetime             — when the access_token expires
 *   created_at    timestamp
 *   updated_at    timestamp
 */
class QbToken extends CActiveRecord
{
    /**
     * Required Yii 1.x pattern: overriding model() ensures __CLASS__ resolves
     * to 'QbToken' (not 'CActiveRecord') when no argument is passed.
     *
     * @param string $className
     * @return QbToken
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'qb_tokens';
    }

    /**
     * @return array validation rules
     */
    public function rules()
    {
        return array(
            array('realm_id, access_token, refresh_token, token_expiry', 'required'),
            array('realm_id', 'length', 'max' => 100),
        );
    }

    /**
     * @return QbToken|null the token record for a given realm, or null if not found
     */
    public static function getToken($realmId)
    {
        return QbToken::model()->findByAttributes(array('realm_id' => $realmId));
    }

    /**
     * Insert or update the token record for a given realm.
     *
     * @param string $realmId
     * @param string $accessToken
     * @param string $refreshToken
     * @param int    $expiresIn    seconds until access token expires (from QB response)
     * @return QbToken
     */
    public static function saveToken($realmId, $accessToken, $refreshToken, $expiresIn)
    {
        $record = self::getToken($realmId);
        if ($record === null) {
            $record = new QbToken();
            $record->realm_id = $realmId;
        }

        $record->access_token  = $accessToken;
        $record->refresh_token = $refreshToken;
        $record->token_expiry  = date('Y-m-d H:i:s', time() + (int)$expiresIn);
        $record->save(false); // skip validation to avoid re-validating existing data

        return $record;
    }

    /**
     * Returns true if the stored access token is still valid (not expired).
     * Treats tokens expiring within 60 seconds as already expired.
     *
     * @return bool
     */
    public function isAccessTokenValid()
    {
        return strtotime($this->token_expiry) > (time() + 60);
    }
}
