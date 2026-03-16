<?php
class  ActivityLog extends CActiveRecord
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
        return 'lead_activity';
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
            'action_type' => 'Action Type',
            'status' =>'Status',
            'created_at'=>'Created At',
            'updated_at' =>'Updated At'
        ];
    }

    public static function getActivityLog(){
          $month = $_POST['month']; 
          $date = getMonthdDate($month) ; 
          $today_date  = date('Y-m-d');

          $sql  ="SELECT * FROM lead_activity  Where DATE(created_at) BETWEEN '".$date['start_date']."' AND '".$date['end_date']."' AND DATE(created_at) !='$today_date'";
          $data = Yii::app()->db->createCommand($sql)->queryAll(); 
    
            $totalCount = count($data); 
            $currentPage =    isset($_POST['page']) ? (int)$_POST['page'] : 1; 
            $pagination_arr = TblLeads::getPagination($currentPage ,$totalCount);
            $sql .= " ORDER BY created_at DESC  LIMIT  ".$pagination_arr['pageSize']."   OFFSET ".$pagination_arr['offset']."";
            $data = Yii::app()->db->createCommand($sql)->queryAll(); 

          return ['data' => $data  , 
                   'total_count' => $totalCount ,
                   'totalPages' => $pagination_arr['totalPages'], 
                   'currentPage' => $pagination_arr['currentPage'] 
                ] ; 
    }


    public static function AddLeadActivity($lead_id ,$type ,$other_val=false){
           $lead_act  = new ActivityLog(); 
           $lead_act->lead_id = $lead_id ; 
           $lead_act->action_type =$type ; 
           $lead_act->status = 1 ;
           $lead_act->created_at = date('Y-m-d H:i:s');
           $lead_act->updated_at = date('Y-m-d H:i:s');
           if($type==3):
             $lead_act->lead_status= $other_val;
           else:
             $lead_act->sales_rep= $other_val;
           endif ;
           $lead_act->save();
           return $lead_act ; 

    }

    public static function getTodayData(){
          $date = date('Y-m-d'); 
          $sql ="SELECT * FROM lead_activity Where DATE(created_at)='$date'";
          $data = Yii::app()->db->createCommand($sql)->queryAll(); 
          return ['data'=>$data];
    }

     



}
