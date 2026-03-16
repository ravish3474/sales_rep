<?php


class DealersheaderSalesrep extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dealer_header';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('style, discription', 'required'),
			array('type, r1c1, r1c2, r1c3, r1c4, r1c5, r1c6, r1c7, r1c8, r2c1, r2c2, r2c3, r2c4, r2c5, r2c6, r2c7, r2c8', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, r1c1, r1c2, r1c3, r1c4, r1c5, r1c6, r1c7, r1c8, r2c1, r2c2, r2c3, r2c4, r2c5, r2c6, r2c7, r2c8', 'safe', 'on'=>'search'),
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
			'id'         => 'ID',
			'type'       => 'Type',
			'r1c1'       => 'Colum 1',
			'r1c2'	 	 => 'Colum 2',
			'r1c3'       => 'Colum 3',
			'r1c4'       => 'Colum 4',
			'r1c5'       => 'Colum 5',
			'r1c6'       => 'Colum 6',
			'r1c7'       => 'Colum 7',
			'r1c8'       => 'Colum 8',
	
			
			'r2c1'       => 'Colum 1',
			'r2c2'	 	 => 'Colum 2',
			'r2c3'       => 'Colum 3',
			'r2c4'       => 'Colum 4',
			'r2c5'       => 'Colum 5',
			'r2c6'       => 'Colum 6',
			'r2c7'       => 'Colum 7',
			'r2c8'       => 'Colum 8',

			
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
		$criteria->compare('type',$this->type);
		$criteria->compare('r1c1',$this->r1c1,true);
		$criteria->compare('r1c2',$this->r1c2,true);
		$criteria->compare('r1c3',$this->r1c3,true);
		$criteria->compare('r1c4',$this->r1c4,true);
		$criteria->compare('r1c5',$this->r1c5,true);
		$criteria->compare('r1c6',$this->r1c6,true);
		$criteria->compare('r1c7',$this->r1c7,true);
		$criteria->compare('r1c8',$this->r1c8,true);
		
		
		$criteria->compare('r2c1',$this->r2c1,true);
		$criteria->compare('r2c2',$this->r2c2,true);
		$criteria->compare('r2c3',$this->r2c3,true);
		$criteria->compare('r2c4',$this->r2c4,true);
		$criteria->compare('r2c5',$this->r2c5,true);
		$criteria->compare('r2c6',$this->r2c6,true);
		$criteria->compare('r2c7',$this->r2c7,true);
		$criteria->compare('r2c8',$this->r2c8,true);
		
		
		
		

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
		$model = new DheaderSalesrep;
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
		$model = DheaderSalesrep::model()->findByPk($post['id']);
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
