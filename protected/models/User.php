<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $password_salt
 * @property string $fullname
 * @property string $phone
 * @property string $email
 * @property integer $user_group_id
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('username, password, password_salt, fullname, phone, email, bank_name, bank_account_name, bank_number, user_group_id', 'required'),
			array('username, password, password_salt, fullname, phone, email, user_group_id', 'required'),
			array('user_group_id', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>50),
			array('password, email', 'length', 'max'=>255),
			array('password_salt', 'length', 'max'=>6),
			array('fullname', 'length', 'max'=>100),
			array('phone', 'length', 'max'=>20),
			array('email', 'email'),
			array('commission_type', 'required'),
			array('quote_permission', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, password_salt, fullname, phone, email, bank_name, bank_account_name, bank_number, bank_swift_code, bank_name_check, bank_mailing_address, bank_other, user_group_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'password_salt' => 'Password Salt',
			'fullname' => 'Fullname',
			'phone' => 'Phone',
			'email' => 'Email',
			'bank_name' => 'Bank Name :',
			'bank_account_name' => 'Account Name :',
			'bank_number' => 'Bank Number :',
			'bank_swift_code' => 'Swift Code :',
			'bank_name_check' => 'Make check payable to :',
			'bank_mailing_address' => 'Mailing Address :',
			'bank_other' => 'Other :',
			'user_group_id' => 'User Group',
			'commission_type' => 'Commission Type',
			'quote_permission' => 'Quotation Permission',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('password_salt',$this->password_salt,true);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('bank_name',$this->bank_name,true);
		$criteria->compare('bank_account_name',$this->bank_account_name,true);
		$criteria->compare('bank_number',$this->bank_number,true);
		$criteria->compare('bank_swift_code',$this->bank_swift_code,true);
		$criteria->compare('bank_name_check',$this->bank_name_check,true);
		$criteria->compare('bank_mailing_address',$this->bank_mailing_address,true);
		$criteria->compare('bank_other',$this->bank_other,true);
		$criteria->compare('user_group_id',$this->user_group_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	// public static function model($className=__CLASS__)
	// {
	// 	return parent::model($className);
	// }

	public function getUserGroup()
	{
		return array(
			'2' => 'Sales Direct',
			'3' => 'Sales Dealers',
			'4' => 'Dealers',
			'1' => 'Admin',
			'5' => 'Factory Direct',
			'7' => 'Designer'
			);
	}

	public static function genPassword($password = null)
	{
		$result = array();

		if (!is_null($password)) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$result['password_salt'] = substr(str_shuffle($characters),0,6);
			$result['password'] = hash_hmac('ripemd160', $password, $result['password_salt']);
		}

		return $result;
	}

	public static function add($post)
	{
		$result = array();
		$checkUser = self::checkUser($post);
		if ($checkUser['check']) {
			$model = new User;
			$model->attributes = $post;

			$genPassword = self::genPassword($post['password']);

			if (sizeof($genPassword) > 0) {
				$model['password'] = $genPassword['password'];
				$model['password_salt'] = $genPassword['password_salt'];
			}

			if ($model->validate()) {
				$model->save();
			} else {
				$model->getErrors();
				$errors = array();
				foreach ($model->getErrors() as $key => $error) {
					foreach ($error as $key => $value) {
						array_push($errors, $value);
					}
				}

				$result['error'] = implode("\n", $errors);
			}
		} else {
			$result['error'] = $checkUser['error'];
		}

		return $result;
	}

	public static function edit($post)
	{
		$model = User::model()->findByPk($post['id']);
		$oldPassword = $model['password'];
		$oldSalt = $model['password_salt'];

		$model->attributes = $post;

		if (!empty($post['password']) && $post['password'] != '******') {
			$genPassword = self::genPassword($post['password']);
			if (sizeof($genPassword) > 0) {
				$model['password'] = $genPassword['password'];
				$model['password_salt'] = $genPassword['password_salt'];
			}
		} else {
			$model['password'] = $oldPassword;
			$model['password_salt'] = $oldSalt;
		}

		$result = array();
		if ($model->validate()) {
			$model->save();
		} else {
			$model->getErrors();

			$errors = array();
			foreach ($model->getErrors() as $key => $error) {
				foreach ($error as $key => $value) {
					array_push($errors, $value);
				}
			}

			$result['error'] = implode("\n", $errors);
		}
		
		return $result;
	}

	public static function checkUser($post)
	{
		$model = User::model()->findByAttributes(array('username'=>$post['username']));
		if (sizeof((array)$model) > 0) {
			$errors[] = 'username is not available';
		}

		$model = User::model()->findByAttributes(array('email'=>$post['email']));
		if (sizeof((array)$model) > 0) {
			$errors[] = 'email is not available';
		}

		if (isset($errors)) {
			$result['check'] = false;
			$result['error'] = implode("\n", $errors);
		} else {
			$result['check'] = true;
		}

		return $result;
	}


	/**
     * Validates the password.
     * @param string $password the password to validate
     * @return boolean whether the password is valid
     */
    public function validatePassword($password)
    {
        $hashedPassword = hash_hmac('ripemd160', $password, $this->password_salt);
        return $hashedPassword === $this->password;
    }

    /**
     * Generates an authentication token.
     * @return string the generated token
     */
    public function generateAuthToken($device_token)
    {
        // $token = bin2hex(openssl_random_pseudo_bytes(16)); // Example of a simple token
        // $this->auth_token = $token;
        // $this->save(false); // Save without validation to avoid re-validating fields
        // return $token;

		$token = bin2hex(openssl_random_pseudo_bytes(16)); // Example of a simple token
        $userToken = new UserToken();
        $userToken->user_id = $this->id;
        $userToken->token = $token;
		$userToken->device_token = $device_token;
        $userToken->save(false); // Save without validation to avoid re-validating fields
        return $token;
    }

    /**
     * Finds a user by the authentication token.
     * @param string $token the authentication token
     * @return User the user model
     */
    public static function findByAuthToken($token)
    {
        $userToken = UserToken::model()->find('token=:token', array(':token' => $token));
        if ($userToken) {
            return self::model()->findByPk($userToken->user_id);
        }
        return null;
    }

    // Other methods...

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

	public static function GetSalesRep(){
		$sql = "SELECT * FROM user Where user_group_id =2 ORDER BY fullname ASC";
		$data = Yii::app()->db->createCommand($sql)->queryAll(); 
		return $data ; 
	}

    public static function GetAdmins(){
		$sql = "SELECT * FROM user Where (user_group_id =99 OR user_group_id=1) ORDER BY fullname ASC";
		$data = Yii::app()->db->createCommand($sql)->queryAll(); 
		return $data ; 
	}
 
	// public static function GetAlluser(){
	// 	$sql = "SELECT * FROM user ORDER BY fullname ASC";
	// 	$data = Yii::app()->db->createCommand($sql)->queryAll(); 
	// 	return $data ; 
	// }
	
	public static function GetAlluser($api=false){
		if($api){
		   	$sql = "SELECT id,username,fullname FROM user Where 
			              (
							enable != 0 
							AND user_group_id = 2 
							AND id NOT IN (9,24,38,10,48,47,5,39,8,33,41 ,12)
						 )
						OR id IN (26 ,28 ,65 ,76 ,44 ,40) ORDER BY fullname ASC"; 
		}else{
            
			$sql = "SELECT * 
						FROM user  
						WHERE 
						(
							enable != 0 
							AND user_group_id = 2 
							AND id NOT IN (9,24,38,10,48,47,5,39,8,33,41 ,12)
						)
						OR id IN (26 ,28 ,65 ,76 ,44 ,40)   -- put all special-allowed IDs here
						ORDER BY fullname ASC ";
		}
		$data = Yii::app()->db->createCommand($sql)->queryAll(); 
		return $data ; 
	}
}
