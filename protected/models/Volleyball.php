<?php

/**
 * This is the model class for table "volleyball".
 *
 * The followings are the available columns in table 'volleyball':
 * @property integer $id
 * @property string $category
 * @property string $qty1
 * @property string $qty2
 * @property string $qty3
 * @property string $cad
 * @property string $asia
 * @property string $thai
 * @property string $msrp
 * @property string $notes
 * @property string $d_qty1
 * @property string $d_qty2
 * @property string $d_qty3
 * @property string $d_msrp
 * @property string $d_notes
 */
class Volleyball extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'volleyball';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category', 'required'),
			array('category, qty1, qty1_1, qty1_2, qty1_3, qty1_4, qty1_5, qty2, qty2_1, qty2_2, qty2_3, qty2_4, qty2_5, qty3, qty3_1, qty3_2, qty3_3, qty3_4, qty3_5, qty4, qty4_1, qty4_2, qty4_3, qty4_4, qty4_5, qty5, qty5_1, qty5_2, qty5_3, qty5_4, qty5_5, qty6, qty6_1, qty6_2, qty6_3, qty6_4, qty6_5, qty7 , qty7_1, qty7_2, qty7_3, qty7_4, qty7_5, qty8, qty8_1, qty8_2, qty8_3, qty8_4, qty8_5, qty9, qty9_1, qty9_2, qty9_3, qty9_4, qty9_5, qty10, qty10_1, qty10_2, qty10_3, qty10_4, qty10_5, qty11, qty11_1, qty11_2, qty11_3, qty11_4, qty11_5, qty12, qty12_1, qty12_2, qty12_3, qty12_4, qty12_5, qty13, qty13_1, qty13_2, qty13_3, qty13_4, qty13_5, qty14, qty14_1, qty14_2, qty14_3, qty14_4, qty14_5, qty15, qty15_1, qty15_2, qty15_3, qty15_4, qty15_5, cad, thai, asia, msrp, msrp_1, msrp_2, msrp_3, msrp_4, msrp_5, d_qty1, d_qty1_1, d_qty1_2, d_qty1_3, d_qty1_4, d_qty1_5, d_qty2, d_qty2_1, d_qty2_2, d_qty2_3, d_qty2_4, d_qty2_5, d_qty3, d_qty3_1, d_qty3_2, d_qty3_3, d_qty3_4, d_qty3_5, d_qty4, d_qty4_1, d_qty4_2, d_qty4_3, d_qty4_4, d_qty4_5, d_qty5, d_qty5_1, d_qty5_2, d_qty5_3, d_qty5_4, d_qty5_5, d_qty6, d_qty6_1, d_qty6_2, d_qty6_3, d_qty6_4, d_qty6_5, d_qty7, d_qty7_1, d_qty7_2, d_qty7_3, d_qty7_4, d_qty7_5, d_qty8, d_qty8_1, d_qty8_2, d_qty8_3, d_qty8_4, d_qty8_5, d_qty9, d_qty9_1, d_qty9_2, d_qty9_3, d_qty9_4, d_qty9_5, d_msrp, d_msrp_1, d_msrp_2, d_msrp_3, d_msrp_4, d_msrp_5, dealers_qty1, dealers_qty1_1, dealers_qty1_2, dealers_qty1_3, dealers_qty1_4, dealers_qty1_5, dealers_qty2, dealers_qty2_1, dealers_qty2_2, dealers_qty2_3, dealers_qty2_4, dealers_qty2_5, dealers_qty3, dealers_qty3_1, dealers_qty3_2, dealers_qty3_3, dealers_qty3_4, dealers_qty3_5, dealers_msrp, dealers_msrp_1, dealers_msrp_2, dealers_msrp_3, dealers_msrp_4, dealers_msrp_5, d_notes, sort_data', 'length', 'max'=>255),
			array('notes', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, category, qty1, qty2, qty3, qty4, qty5, qty6, qty7, qty8, qty9, qty10, qty11, qty12, qty13, qty14, qty15, cad, asia, thai, msrp, notes, d_qty1, d_qty2, d_qty3, d_qty4, d_qty5, d_qty6, d_qty7, d_qty8, d_qty9, d_msrp, dealers_qty1, dealers_qty2, dealers_qty3, dealers_msrp, d_notes, sort_data', 'safe', 'on'=>'search'),
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
			'category' => 'Product',
			'qty1' => 'QTY 20-99',
			'qty2' => 'QTY 100-299',
			'qty3' => 'QTY 300+',
			'cad' => 'CAD Price ',
			'asia' => 'Asia/Australia',
			'thai' => 'Thailand',
			'msrp' => 'MSRP',
			'notes' => 'Notes',
			'd_qty1' => 'QTY 20-99',
			'd_qty2' => 'QTY 100-299',
			'd_qty3' => 'QTY 300+',
			'd_msrp' => 'MSRP',
			'd_notes' => 'Notes',
			
			'dealers_qty1'      => 'QTY 15-99)',
			'dealers_qty2'      => 'QTY 100-299',
			'dealers_qty3'      => 'QTY 300+',
			'dealers_msrp'      => 'MSRP (USD)',
			
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
		$criteria->compare('category',$this->category,true);
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
		$criteria->compare('cad',$this->cad,true);
		$criteria->compare('asia',$this->asia,true);
		$criteria->compare('thai',$this->thai,true);
		$criteria->compare('msrp',$this->msrp,true);
		$criteria->compare('notes',$this->notes,true);
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
		$criteria->compare('d_notes',$this->d_notes,true);
		
		$criteria->compare('dealers_qty1',$this->dealers_qty1,true);
		$criteria->compare('dealers_qty2',$this->dealers_qty2,true);
		$criteria->compare('dealers_qty3',$this->dealers_qty3,true);
		$criteria->compare('dealers_msrp',$this->dealers_msrp,true);
		
		$criteria->compare('sort_data',$this->sort_data,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Volleyball the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function add($post)
	{
		$model = new Volleyball;
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
		$model = Volleyball::model()->findByPk($post['id']);
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
