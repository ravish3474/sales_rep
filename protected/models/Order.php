<?php
class Order extends CActiveRecord
{
    public $JOG_Code;
    public $No_Quote;
    public $QB_Draft;
    public $Order_Name;
    public $Inv_no;
    public $Sales_Rep1;
    public $Commission1;
    public $Sales_Rep2;
    public $Commission2;
    public $Remark;
    public $Invoice_ink;
    public $month;
    public $year;
    public $Invlink;
    public $typeofcode;
    public $online_store;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_order'; // Adjust the table name as per your database structure
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('JOG_Code, No_Quote, QB_Draft, Order_Name, Inv_no, Sales_Rep_1, percentage_1, Sales_Rep_2, percentage_2, Remark, month, year, Invlink, typeofcode, online_store' ,'safe' ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'JOG_Code' => 'JOG_Code',
            'No_Quote' => 'No_Quote',
            'QB_Draft' => 'QB_Draft',
            'Order_Name' => 'Order_Name',
            'Inv_no' => 'Inv_No',
            'Sales_Rep1' => 'Sales_Rep_1',
            'Commission1' => 'Percentage_1',
            'Sales_Rep2' => 'Sales_Rep2',
            'Commission2' => 'Percentage_2',
            'Remark' => 'Remark',            
            'month' => 'Month',
            'year' => 'Year',
            'Invlink' => 'Invlink',
            'typeofcode' => 'typeofcode',
            'online_store' => 'online_store',
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
        $criteria=new CDbCriteria;

        $criteria->compare('JOG_Code',$this->JOG_Code,true);
        $criteria->compare('No_Quote',$this->No_Quote,true);
        $criteria->compare('QB_Draft',$this->QB_Draft,true);
        $criteria->compare('Order_Name',$this->Order_Name,true);
        $criteria->compare('Inv_no',$this->Inv_no,true);
        $criteria->compare('Sales_Rep_1',$this->Sales_Rep1,true);
        $criteria->compare('percentage_1',$this->Commission1,true);
        $criteria->compare('Sales_Rep_2',$this->Sales_Rep2,true);
        $criteria->compare('percentage_2',$this->Commission2,true);
        $criteria->compare('Remark',$this->Remark,true);        
        $criteria->compare('month',$this->month,true);
        $criteria->compare('year',$this->year,true);
        $criteria->compare('Invlink',$this->Invlink,true);
        $criteria->compare('typeofcode',$this->typeofcode,true);
        $criteria->compare('online_store',$this->online_store,true);
        
        
        

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Order the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
