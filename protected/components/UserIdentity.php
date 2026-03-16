<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		// $users=array(
		// 	// username => password
		// 	'demo'=>'demo',
		// 	'admin'=>'admin',
		// );
		// if(!isset($users[$this->username]))
		// 	$this->errorCode=self::ERROR_USERNAME_INVALID;
		// elseif($users[$this->username]!==$this->password)
		// 	$this->errorCode=self::ERROR_PASSWORD_INVALID;
		// else
		// 	$this->errorCode=self::ERROR_NONE;
		// return !$this->errorCode;

		$user = User::model()->findByAttributes(array('username' => $this->username));
		if(!is_null($user)){
			$this->password = hash_hmac('ripemd160', $this->password, $user->password_salt);
		}

		if(sizeof((array)$user) == 0) {
        	$this->errorCode=self::ERROR_USERNAME_INVALID;
		} else if ($user->password!==$this->password) {
	        $this->errorCode=self::ERROR_PASSWORD_INVALID;
		} else {
	    	$this->errorCode=self::ERROR_NONE;

	    	$this->_id = $user->id;
	    	$this->setUserKey($user->id);
	    	$this->setUserName($user->username);
	    	$this->setUserFullName($user->fullname);
	    	$this->setUserUserGroup($user->user_group_id);
	    	$this->setUserQuotePermission($user->quote_permission);
	    	$this->setUserCommissionType($user->commission_type);
	    	$this->setUserPricingModule($user->pricing_module);
	    	$this->setUserMSRP($user->msrp_active);
	    }

		return !$this->errorCode;
	}

	public function setUserKey($value) {
		Yii::app()->user->setState('userKey', $value);
	}

	public function setUserName($value) {
		Yii::app()->user->setState('userName', $value);
	}

	public function setUserFullName($value) {
		Yii::app()->user->setState('fullName', $value);
	}

	public function setUserUserGroup($value) {
		Yii::app()->user->setState('userGroup', $value);
	}
	
	public function setUserQuotePermission($value) {
		Yii::app()->user->setState('quotePermission', $value);
	}
	
	public function setUserCommissionType($value) {
		Yii::app()->user->setState('commissionType', $value);
	}
	
	public function setUserPricingModule($value) {
		Yii::app()->user->setState('userPricing', $value);
	}
	
	public function setUserMSRP($value) {
		Yii::app()->user->setState('userMSRP', $value);
	}



	public function getUserKey() {
	    return Yii::app()->user->getState('userKey');
	}

	public function getUserName() {
	    return Yii::app()->user->getState('userName');
	}

	public function getFullName() {
	    return Yii::app()->user->getState('fullName');
	}

	public function getUserGroup() {
	    return Yii::app()->user->getState('userGroup');
	}
	
	public function getUserQuotePermission() {
	    return Yii::app()->user->getState('quotePermission');
	}
	
	public function getUserCommissionType() {
	    return Yii::app()->user->getState('commissionType');
	}
	
	public function getUserPricingModule() {
	    return Yii::app()->user->getState('userPricing');
	}
	
	public function getUserMSRP() {
		return Yii::app()->user->getState('userMSRP');
	}

}