<?php
class LeadsStatus extends CActiveRecord
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
        return 'leads_status';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [];
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
            'id' => 'ID',
            'lead_id' => 'Lead ID',
            'action_type' => 'Action Type',
            'note' => 'Note',
            'created_at' => 'Created At',
        ];
    }
}
