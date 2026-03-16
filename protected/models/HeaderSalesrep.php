<?php


class HeaderSalesrep extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'header';
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
			array('type, r1c1, r1c2, r1c3, r1c4, r1c5, r1c6, r1c7, r1c8, r1c9, r1c10, r1c11, r1c12, r1c13, r1c14, r1c15, r1c16, r1c17, r1c18, r1c19, r1c20, r2c1, r2c2, r2c3, r2c4, r2c5, r2c6, r2c7, r2c8, r2c9, r2c10, r2c11, r2c12, r2c13, r2c14, r2c15, r2c16, r2c17, r2c18, r2c19, r2c20, r3c1_2, r3c3, r3c4, r3c5, r3c6, r3c7, r3c8, r3c9, r3c10, r3c11, r3c12, r3c13, r3c14, r3c15, r3c16, r3c17, r3c18, r3c19, r3c20', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, r1c1, r1c2, r1c3, r1c4, r1c5, r1c6, r1c7, r1c8, r1c9, r1c10, r1c11, r1c12, r1c13, r1c14, r1c15, r1c16, r1c17, r1c18, r1c19, r1c20, r2c1, r2c2, r2c3, r2c4, r2c5, r2c6, r2c7, r2c8, r2c9, r2c10, r2c11, r2c12, r2c13, r2c14, r2c15, r2c16, r2c17, r2c18, r2c19, r2c20, r3c1_2, r3c3, r3c4, r3c5, r3c6, r3c7, r3c8, r3c9, r3c10, r3c11, r3c12, r3c13, r3c14, r3c15, r3c16, r3c17, r3c18, r3c19, r3c20', 'safe', 'on'=>'search'),
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
			'r1c6'       => 'Colum 5',
			'r1c7'       => 'Colum 6',
			'r1c8'       => 'Colum 7',
			'r1c9'       => 'Colum 8',
			'r1c10'      => 'Colum 9',
			'r1c11'      => 'Colum 9',
			'r1c12'      => 'Colum 10',
			'r1c13'      => 'Colum 11',
			'r1c14'      => 'Colum 12',
			'r1c15'      => 'Colum 13',
			'r1c16'      => 'Colum 13',
			'r1c17'      => 'Colum 14',
			'r1c18'      => 'Colum 15',
			'r1c19'      => 'Colum 16',
			'r1c20'      => 'Colum 17',
			
			'r2c1'       => 'Colum 1',
			'r2c2'	 	 => 'Colum 2',
			'r2c3'       => 'Colum 3',
			'r2c4'       => 'Colum 4',
			'r2c5'       => 'Colum 5',
			'r2c6'       => 'Colum 5',
			'r2c7'       => 'Colum 6',
			'r2c8'       => 'Colum 7',
			'r2c9'       => 'Colum 8',
			'r2c10'      => 'Colum 9',
			'r2c11'      => 'Colum 9',
			'r2c12'      => 'Colum 10',
			'r2c13'      => 'Colum 11',
			'r2c14'      => 'Colum 12',
			'r2c15'      => 'Colum 13',
			'r2c16'      => 'Colum 13',
			'r2c17'      => 'Colum 14',
			'r2c18'      => 'Colum 15',
			'r2c19'      => 'Colum 16',
			'r2c20'      => 'Colum 17',
			
			'r3c1_2'       => 'Colum 1',
			'r3c5'       => 'Colum 5',
			'r3c6'       => 'Colum 5',
			'r3c7'       => 'Colum 6',
			'r3c8'       => 'Colum 7',
			'r3c9'       => 'Colum 8',
			'r3c10'      => 'Colum 9',
			'r3c11'      => 'Colum 9',
			'r3c12'      => 'Colum 10',
			'r3c13'      => 'Colum 11',
			'r3c14'      => 'Colum 12',
			'r3c15'      => 'Colum 13',
			'r3c16'      => 'Colum 13',
			'r3c17'      => 'Colum 14',
			'r3c18'      => 'Colum 15',
			'r3c19'      => 'Colum 16',
			'r3c20'      => 'Colum 17',
			
			
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
		$criteria->compare('r1c9',$this->r1c9,true);
		$criteria->compare('r1c10',$this->r1c10,true);
		$criteria->compare('r1c11',$this->r1c11,true);
		$criteria->compare('r1c12',$this->r1c12,true);
		$criteria->compare('r1c13',$this->r1c13,true);
		$criteria->compare('r1c14',$this->r1c14,true);
		$criteria->compare('r1c15',$this->r1c15,true);
		$criteria->compare('r1c16',$this->r1c16,true);
		$criteria->compare('r1c17',$this->r1c17,true);
		$criteria->compare('r1c18',$this->r1c18,true);
		$criteria->compare('r1c19',$this->r1c18,true);
		$criteria->compare('r1c20',$this->r1c18,true);
		
		$criteria->compare('r2c1',$this->r2c1,true);
		$criteria->compare('r2c2',$this->r2c2,true);
		$criteria->compare('r2c3',$this->r2c3,true);
		$criteria->compare('r2c4',$this->r2c4,true);
		$criteria->compare('r2c5',$this->r2c5,true);
		$criteria->compare('r2c6',$this->r2c6,true);
		$criteria->compare('r2c7',$this->r2c7,true);
		$criteria->compare('r2c8',$this->r2c8,true);
		$criteria->compare('r2c9',$this->r2c9,true);
		$criteria->compare('r2c10',$this->r2c10,true);
		$criteria->compare('r2c11',$this->r2c11,true);
		$criteria->compare('r2c12',$this->r2c12,true);
		$criteria->compare('r2c13',$this->r2c13,true);
		$criteria->compare('r2c14',$this->r2c14,true);
		$criteria->compare('r2c15',$this->r2c15,true);
		$criteria->compare('r2c16',$this->r2c16,true);
		$criteria->compare('r2c17',$this->r2c17,true);
		$criteria->compare('r2c18',$this->r2c18,true);
		$criteria->compare('r2c19',$this->r2c18,true);
		$criteria->compare('r2c20',$this->r2c18,true);
		
		$criteria->compare('r3c1_2',$this->r3c1_2,true);
		$criteria->compare('r3c3',$this->r3c3,true);
		$criteria->compare('r3c4',$this->r3c4,true);
		$criteria->compare('r3c5',$this->r3c5,true);
		$criteria->compare('r3c6',$this->r3c6,true);
		$criteria->compare('r3c7',$this->r3c7,true);
		$criteria->compare('r3c8',$this->r3c8,true);
		$criteria->compare('r3c9',$this->r3c9,true);
		$criteria->compare('r3c10',$this->r3c10,true);
		$criteria->compare('r3c11',$this->r3c11,true);
		$criteria->compare('r3c12',$this->r3c12,true);
		$criteria->compare('r3c13',$this->r3c13,true);
		$criteria->compare('r3c14',$this->r3c14,true);
		$criteria->compare('r3c15',$this->r3c15,true);
		$criteria->compare('r3c16',$this->r3c16,true);
		$criteria->compare('r3c17',$this->r3c17,true);
		$criteria->compare('r3c18',$this->r3c18,true);
		$criteria->compare('r3c19',$this->r3c18,true);
		$criteria->compare('r3c20',$this->r3c18,true);
		

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
		$model = new HeaderSalesrep;
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
		$model = HeaderSalesrep::model()->findByPk($post['id']);
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
