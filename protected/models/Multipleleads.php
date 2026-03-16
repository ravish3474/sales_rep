<?php
class  Multipleleads extends CActiveRecord
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
        return 'tbl_leads_multiple';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
     ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return [
            // Define relations here if necessary
            // Example: 'lead' => [self::BELONGS_TO, 'TblLeads', 'lead_id'], CREATE TABLE `salesrep`.`tbl_leads_multiple` (`id` INT NOT NULL AUTO_INCREMENT , `lead_id` INT NOT NULL , `sale_rep` VARCHAR(255) NULL DEFAULT NULL , PRIMARY KEY (`id`));
        ];
    } 

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lead_id' => 'Lead Sales ID',
            'sale_rep' => 'Sales Rep',
            
        ];
    }


    public static function SavemultipleSalesRep(){
        $lead_id = $_POST['lead_id']; 
        $sales_rep = $_POST['all_values'];
        $check_exsist =  Yii::app()->db->createCommand("SELECT * FROM tbl_leads_multiple Where lead_id =  '$lead_id' AND sale_rep = '".$sales_rep."'")->queryRow(); 
     

       if(empty($check_exsist)){
        $multiple_lead = new Multipleleads(); 
        $multiple_lead->lead_id = $lead_id; 
        $multiple_lead->sale_rep =$sales_rep ;
        $multiple_lead->created_at = date('Y-m-d  H:i:s'); 
        $multiple_lead->updated_at =date('Y-m-d H:i:s');
        $multiple_lead->save();
        // $lead_activity = ActivityLog::AddLeadActivity($lead_id ,2);
            $lead_activity = ActivityLog::AddLeadActivity($lead_id ,2 ,$sales_rep);

            // send mail to assigned sales rep 
            $details = self::GetLeadDetailsById($lead_id); 
            TblLeads::SendAutomaticAssignedMail($details);

            TblLeads::UpdateAssignLeadCount($sales_rep ,$lead_id ,'Add');


        return $lead_id ; 
        }
  }


   
     //====================Get the leads  details for send mail ===================
      
    public static function GetLeadDetailsById($lead_id){
                $sql = "
                    SELECT *
                    FROM tbl_leads
                    WHERE lead_id = :lead_id
                    AND status != 5
                ";

                return Yii::app()->db
                    ->createCommand($sql)
                    ->bindValue(':lead_id', (int)$lead_id)
                    ->queryRow();
    }










    // public static function SavemultipleSalesRep(){
       
    //     $lead_id = $_POST['lead_id']; 
    //     $sales_rep = $_POST['all_values']; 

    //     $delete_all = Yii::app()->db->createCommand("DELETE FROM tbl_leads_multiple Where lead_id = :lead_id")->bindValue('lead_id'  ,$lead_id ,PDO::PARAM_INT)->execute(); 

        
    //     if(!empty($sales_rep)){
    //         foreach($sales_rep as $key=>$value){
    //               $multiple_lead = new Multipleleads(); 
    //               $multiple_lead->lead_id = $lead_id; 
    //               $multiple_lead->sale_rep =$value ;
    //               $multiple_lead->save();
    //         }             
    //     }
    //     return $lead_id ; 
    // }
}
