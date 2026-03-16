<?php
class LeadSales extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return LeadSales the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'lead_sales';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            ['sales_name, sales_id, state_name, country_name, sales_priority, lead_capacity, status', 'safe'],
            ['sales_priority, lead_capacity', 'numerical', 'integerOnly' => true], // Ensure numerical fields are integers
            ['sales_name, state_name, country_name', 'length', 'max' => 255], // Limit string length
        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return [
            // Define relations here if necessary
            // Example: 'lead' => [self::BELONGS_TO, 'TblLeads', 'lead_id'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'lead_sales_id' => 'Lead Sales ID',
            'sales_name' => 'Sales Name',
            'sales_id' => 'Sales ID',
            'state_name' => 'State',
            'country_name' => 'Country',
            'sales_priority' => 'Sales Priority',
            'lead_capacity' => 'Lead Capacity',
            'status' => 'Status',
        ];
    }
}
