<?php


class Calculator extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'calculator';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_name, currency', 'required'),
			array('invoice, inv_link, order_name, invoice_status, sales_manager, currency, payment_method,invoice_mail_name, status_commission, invoice_mail_status, invoice_mail_customer, invoice_mail_subject, invoice_date, invoice_payment_method, commisson_payment_status, order_no', 'length', 'max'=>255),
			array('invoice_mail_detail, file_path', 'safe'),
			array('invoice_mail_customer', 'email','message'=>"The email isn't correct"),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, invoice, order_name, date_quarter, total_sales, shipping_cost, creditcard_feecost, royalty_feecost, comp_itemcost, commission_percent, commission, invoice_status, date_for_sales, pay_for_sales, sales_manager, sales_status currency, file_path, payment_method, invoice_mail_name, status_commission, invoice_mail_status, invoice_mail_customer, invoice_mail_subject, invoice_mail_detail,invoice_date, invoice_amount_received, invoice_payment_method, commisson_payment_status, order_no', 'safe', 'on'=>'search'),
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
			'invoice'     				=> 'invoice #',
			'inv_link'       	 		=> 'Invoice Link',
			'order_name'				=> 'Order Name',
			'date_quarter'  			=> 'Date/Quarter',
			'comments'      			=> 'Comments',
			'total_sales'   			=> 'Total Sales',
			'shipping_cost'   			=> 'Shipping Cost',
			'creditcard_feecost'   		=> 'Credit Card Fee',
			'royalty_feecost'   		=> 'Royalty Fee',
			'comp_itemcost'   			=> 'Comp. Item Cost',
			'commission_percent'    	=> 'Commission%',
			'commission'        		=> 'Commissionable Sales (%)',
			'invoice_status'        	=> 'Invoice Payment Status',
			'invoice_date'        		=> 'Received Date',
			'invoice_amount_received'   => 'Amount Received',
			'invoice_payment_method'    => 'Payment Method',
			'commisson_payment_status'  => 'Commission Payment Status',
			'date_for_sales'        	=> 'Commission Date',
			'pay_for_sales'        		=> 'Pay Outs',
			'sales_manager'        		=> 'Sales Manager',
			'currency'       	 		=> 'Currency',
			'file_path'       	 		=> 'Invoice File',
			'payment_method'       		=> 'Payment Method',
			'status_commission'     	=> 'Commission Status',
			'invoice_mail_status'   	=> 'Invoice Mailing Status',
			'invoice_mail_customer' 	=> 'E-mail : ',
			'invoice_mail_subject' 	 	=> 'Subject : ',
			'invoice_mail_detail'   	=> 'Messages',
			'invoice_mail_name'   		=> 'Name',
			'order_no'   				=> 'Order No.',
			
			
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
		$criteria->compare('invoice',$this->invoice,true);
		$criteria->compare('inv_link',$this->inv_link,true);
		$criteria->compare('order_name',$this->order_name,true);
		$criteria->compare('date_quarter',$this->date_quarter,true);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('total_sales',$this->total_sales,true);
		$criteria->compare('commission_percent',$this->commission_percent,true);
		$criteria->compare('comp_itemcost',$this->comp_itemcost,true);
		$criteria->compare('creditcard_feecost',$this->creditcard_feecost,true);
		$criteria->compare('royalty_feecost',$this->royalty_feecost,true);
		$criteria->compare('shipping_cost',$this->shipping_cost,true);
		$criteria->compare('commission',$this->commission,true);
		$criteria->compare('invoice_status',$this->invoice_status,true);
		$criteria->compare('invoice_date',$this->invoice_date,true);
		$criteria->compare('invoice_amount_received',$this->invoice_amount_received,true);
		$criteria->compare('invoice_payment_method',$this->invoice_payment_method,true);
		$criteria->compare('date_for_sales',$this->date_for_sales,true);
		$criteria->compare('pay_for_sales',$this->pay_for_sales,true);
		$criteria->compare('sales_manager',$this->sales_manager,true);
		$criteria->compare('sales_status',$this->sales_status,true);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('status_commission',$this->status_commission,true);
		$criteria->compare('file_path',$this->file_path,true);
		$criteria->compare('payment_method',$this->payment_method,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('invoice_mail_status',$this->invoice_mail_status,true);
		$criteria->compare('invoice_mail_customer',$this->invoice_mail_customer,true);
		$criteria->compare('invoice_mail_subject',$this->invoice_mail_subject,true);
		$criteria->compare('invoice_mail_detail',$this->invoice_mail_detail,true);
		$criteria->compare('invoice_mail_name',$this->invoice_mail_name,true);
		$criteria->compare('commisson_payment_status',$this->commisson_payment_status,true);
		$criteria->compare('order_no',$this->order_no,true);
		
		

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
