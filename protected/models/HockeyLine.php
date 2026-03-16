<?php

/**
 * This is the model class for table "hockey_line".
 *
 * The followings are the available columns in table 'hockey_line':
 * @property integer $id
 * @property string $style
 * @property string $discription
 * @property string $qty1
 * @property string $qty2
 * @property string $qty3
 * @property string $qty4
 * @property string $qty5
 * @property string $qty6
 * @property string $msrp
 * @property string $price_th
 * @property string $price
 * @property string $d_qty1
 * @property string $d_qty2
 * @property string $d_qty3
 * @property string $d_msrp
 */
class HockeyLine extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hockey_line';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('style, discription', 'required'),
			array('style, qty1, qty2, qty3, qty4, qty5, qty6, qty7, qty8, qty9, qty10, qty11, qty12, qty13, qty14, qty15, msrp, price_th, price, d_qty1, d_qty2, d_qty3, d_qty4, d_qty5, d_qty6, d_qty7, d_qty8, d_qty9, d_msrp, dealers_qty1, dealers_qty2, dealers_qty3, dealers_msrp, category, group_data, sort_data', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, style, discription, qty1, qty2, qty3, qty4, qty5, qty6, qty7, qty8, qty9, qty10, qty11, qty12, qty13, qty14, qty15, msrp, price_th, price, d_qty1, d_qty2, d_qty3, d_qty4, d_qty5, d_qty6, d_qty7, d_qty8, d_qty9, d_msrp, dealers_qty1, dealers_qty2, dealers_qty3, dealers_msrp, category, group_data, sort_data', 'safe', 'on'=>'search'),
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
			'id'          => 'ID',
			'style'       => 'Style',
			'discription' => 'Discription',
			'qty1'        => 'QTY 15-99 (15%)',
			'qty2'        => 'QTY 15-99 (13%)',
			'qty3'        => 'QTY 15-99 (10%)',
			'qty4'        => 'QTY 15-99 (7%)',
			'qty5'        => 'QTY 15-99 (5%)',
			'qty6'        => 'QTY 100-299 (15%)',
			'qty7'        => 'QTY 100-299 (13%)',
			'qty8'        => 'QTY 100-299 (10%)',
			'qty9'        => 'QTY 100-299 (7%)',
			'qty10'        => 'QTY 100-299 (5%)',
			'qty11'        => 'QTY 300+ (15%)',
			'qty12'        => 'QTY 300+ (13%)',
			'qty13'        => 'QTY 300+ (10%)',
			'qty14'        => 'QTY 300+ (7%)',
			'qty15'        => 'QTY 300+ (5%)',
			'msrp'        => 'MSRP (USD)',
			'price_th'    => 'Thailand',
			'price'       => 'Asia/Australia',
			'd_qty1'      => 'QTY 15-99 (10%)',
			'd_qty2'        => 'QTY 15-99 (5%)',
			'd_qty3'        => 'QTY 15-99 (3%)',
			'd_qty4'      => 'QTY 100-299 (10%)',
			'd_qty5'        => 'QTY 100-299 (5%)',
			'd_qty6'        => 'QTY 100-299 (3%)',
			'd_qty7'        => 'QTY 300+ (10%)',
			'd_qty8'        => 'QTY 300+ (5%)',
			'd_qty9'        => 'QTY 300+ (3%)',
			'd_msrp'      => 'MSRP (USD)',
			
			'dealers_qty1'      => 'QTY 15-99)',
			'dealers_qty2'      => 'QTY 100-299',
			'dealers_qty3'      => 'QTY 300+',
			'dealers_msrp'      => 'MSRP (USD)',
			'category'      => 'Product Type',
			
			'sort_data'      => 'Sort Data',
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
		$criteria->compare('style',$this->style,true);
		$criteria->compare('discription',$this->discription,true);
		$criteria->compare('qty1',$this->qty1,true);
		$criteria->compare('qty2',$this->qty2,true);
		$criteria->compare('qty3',$this->qty3,true);
		$criteria->compare('qty4',$this->qty4,true);
		$criteria->compare('qty5',$this->qty5,true);
		$criteria->compare('qty6',$this->qty6,true);
		$criteria->compare('qty7',$this->qty7,true);
		$criteria->compare('qty8',$this->qty8,true);
		$criteria->compare('qty9',$this->qty9,true);
		$criteria->compare('qty10',$this->qty10,true);
		$criteria->compare('qty11',$this->qty11,true);
		$criteria->compare('qty12',$this->qty12,true);
		$criteria->compare('qty13',$this->qty13,true);
		$criteria->compare('qty14',$this->qty14,true);
		$criteria->compare('qty15',$this->qty15,true);
		$criteria->compare('msrp',$this->msrp,true);
		$criteria->compare('price_th',$this->price_th,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('d_qty1',$this->d_qty1,true);
		$criteria->compare('d_qty2',$this->d_qty2,true);
		$criteria->compare('d_qty3',$this->d_qty3,true);
		$criteria->compare('d_qty4',$this->d_qty4,true);
		$criteria->compare('d_qty5',$this->d_qty5,true);
		$criteria->compare('d_qty6',$this->d_qty6,true);
		$criteria->compare('d_qty7',$this->d_qty7,true);
		$criteria->compare('d_qty8',$this->d_qty8,true);
		$criteria->compare('d_qty9',$this->d_qty9,true);
		$criteria->compare('d_msrp',$this->d_msrp,true);
		$criteria->compare('dealers_qty1',$this->dealers_qty1,true);
		$criteria->compare('dealers_qty2',$this->dealers_qty2,true);
		$criteria->compare('dealers_qty3',$this->dealers_qty3,true);
		$criteria->compare('dealers_msrp',$this->dealers_msrp,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('group_data',$this->group_data,true);
		$criteria->compare('sort_data',$this->sort_data,true);

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
		$model = new HockeyLine;
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
		$model = HockeyLine::model()->findByPk($post['id']);
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
