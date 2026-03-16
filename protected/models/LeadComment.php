<?php
class LeadComment extends CActiveRecord
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
        return 'leads_comment';
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
           
        ];
    }

    public function addComment($data){
          $cmt = new LeadComment(); 
          $cmt->lead_id = $data['lead_id']; 
          $cmt->sales_rep = $data['sales_rep']; 
          $cmt->comment = $data['cmt']; 
          $cmt->created_at = date('Y-m-d H:i:s'); 
          $cmt->save();
          
          $lead_activity = ActivityLog::AddLeadActivity($data['lead_id'] ,4);

          return $cmt->id; 
    }
}
