<?php


class SalesOrders extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sales_orders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_no', 'required'),
			array('order_no, 	order_name', 'length', 'max'=>255),
			//array('invoice_mail_detail, file_path', 'safe'),
			//array('invoice_mail_customer', 'email','message'=>"The email isn't correct"),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, order_no, order_name, commission_percent, commission_percent2, remark, date_saleorder, sales_rep, date_update', 'safe', 'on'=>'search'),
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
			'id'          				=> 'ID',
			'order_no'     				=> 'Order No #',
			'order_name'				=> 'Order Name',
			'commission_percent'        => 'Commission (%)',
			'date_saleorder'        	=> 'Date Order',
			'invoice_date'        		=> 'Received Date',
			'remark'  				 	=> 'Remark',
			'sales_rep'  				=> 'Sales Rep',
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
		$criteria->compare('order_no',$this->order_no,true);
		$criteria->compare('order_name',$this->order_name,true);
		$criteria->compare('commission_percent',$this->commission_percent,true);
		$criteria->compare('commission_percent2',$this->commission_percent2,true);
		$criteria->compare('date_saleorder',$this->date_saleorder,true);
		$criteria->compare('invoice_date',$this->invoice_date,true);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('sales_rep',$this->sales_rep,true);
		$criteria->compare('date_update',$this->date_update,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HockeyLine the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function add($post)
	{
		$model = new Calculator;
		$model->attributes = $post;

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

	public static function edit($post)
	{
		$model = Calculator::model()->findByPk($post['id']);
		$model->attributes = $post;

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
}
