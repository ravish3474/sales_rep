<?php
class TblLeads extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TblLeads the static model class
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
        return 'tbl_leads';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            ['pro_name, TAC_name, description, qty, due_date, name, last_name, email, phone_no, state_name, city , country_name, status, date_add, assigned_to, notes', 'safe' ],
            ['email', 'email'],
            ['qty', 'numerical', 'integerOnly' => true],
            ['phone_no', 'length', 'max' =>40],
            ['created_at', 'safe'],
        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return [
            // Define relations if needed, e.g.:
            // 'user' => [self::BELONGS_TO, 'User', 'assigned_to'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'lead_id' => 'Lead ID',
            'pro_name' => 'Product Name',
            'TAC_name' => 'TAC Name',
            'description' => 'Description',
            'qty' => 'Quantity',
            'due_date' => 'Due Date',
            'name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'phone_no' => 'Phone Number',
            'state_name' => 'State',
            'country_name' => 'Country',
            'status' => 'Status',
            'date_add' => 'Date Added',
            'assigned_to' => 'Assigned To',
            'notes' => 'Notes',
            'created_at' => 'Created At'
        ];
    }

    public function createLead($data)
    {
        
        $this->attributes = $data; // Assign values to model attributes

        if ($this->save()) { 
            return $this->lead_id; // Return lead_id if saved successfully
        } else {
            return false; // Return false if save fails
        }
    }

    public static function GetCountValuesAdmin(){
          $admin = Yii::app()->user->getId();
          $month  = empty($_POST['month']) ? 0 : $_POST['month']; 

          if($month):
                $all_date = getMonthdDate($month); 
                $start_date = $all_date['start_date'];
                $end_date = $all_date['end_date'];
            else:
                $currentYear = empty($_POST['year']) ?  date('Y')  : $_POST['year'];
                $startDate = new DateTime("$currentYear-01-01"); // First day of the month
                $endDate = new DateTime("$currentYear-12-01"); // Sta
                $start_date = $startDate->format('Y-m-d'); 
                $end_date = $endDate->format('Y-m-d'); 
            endif ;

             $today_date = date('Y-m-d');

            $all_leads =  Yii::app()->db->createCommand("SELECT COUNT(DISTINCT tbl.lead_id) FROM tbl_leads AS tbl LEFT JOIN tbl_leads_multiple AS tm ON tm.lead_id = tbl.lead_id WHERE (tbl.assigned_to ='$admin' OR tm.sale_rep='$admin') AND tbl.status !=5 AND DATE(tbl.created_at) BETWEEN '$start_date' AND '$end_date'")->queryScalar(); 
  
            $new_leads = Yii::app()->db->createCommand("SELECT COUNT(DISTINCT tbl.lead_id) FROM tbl_leads  AS tbl LEFT JOIN  tbl_leads_multiple AS tm ON tm.lead_id = tbl.lead_id WHERE (tbl.assigned_to ='$admin' OR tm.sale_rep='$admin') AND  status=0 AND DATE(tbl.created_at) BETWEEN '$start_date' AND '$end_date'")->queryScalar();
  
           if(!$month){
                 $follow_up = Yii::app()->db->createCommand("SELECT COUNT(DISTINCT tbl.lead_id) FROM tbl_leads AS tbl   LEFT JOIN   tbl_leads_multiple AS tm ON tm.lead_id = tbl.lead_id WHERE (tbl.assigned_to ='$admin' OR tm.sale_rep='$admin') AND  status=1 AND 
                DATE(tbl.status_update_date)='$today_date'")->queryScalar();
           }
           else{
                $follow_up = Yii::app()->db->createCommand("SELECT COUNT(DISTINCT tbl.lead_id) FROM tbl_leads AS tbl   LEFT JOIN   tbl_leads_multiple AS tm ON tm.lead_id = tbl.lead_id WHERE (tbl.assigned_to ='$admin' OR tm.sale_rep='$admin') AND  status=1 AND DATE(tbl.created_at) BETWEEN '$start_date' AND '$end_date'")->queryScalar();
           }
           
  
            $closed =   Yii::app()->db->createCommand("SELECT COUNT(DISTINCT tbl.lead_id) FROM tbl_leads AS tbl   LEFT JOIN    tbl_leads_multiple AS tm ON tm.lead_id = tbl.lead_id WHERE (tbl.assigned_to ='$admin' OR tm.sale_rep='$admin') AND status=2 AND DATE(tbl.created_at) BETWEEN '$start_date' AND '$end_date'")->queryScalar();
  
            $hold =     Yii::app()->db->createCommand("SELECT COUNT(DISTINCT tbl.lead_id) FROM tbl_leads  AS tbl   LEFT JOIN  tbl_leads_multiple AS tm ON tm.lead_id = tbl.lead_id WHERE (tbl.assigned_to ='$admin' OR tm.sale_rep='$admin') AND  status=3 AND DATE(tbl.created_at) BETWEEN '$start_date' AND '$end_date'")->queryScalar();
            
            $rejected = Yii::app()->db->createCommand("SELECT COUNT(DISTINCT tbl.lead_id) FROM tbl_leads  AS tbl   LEFT JOIN   tbl_leads_multiple AS tm ON tm.lead_id = tbl.lead_id WHERE (tbl.assigned_to ='$admin' OR tm.sale_rep='$admin') AND status=4 AND DATE(tbl.created_at) BETWEEN '$start_date' AND '$end_date'")->queryScalar();


          $data =[$all_leads ,$new_leads ,$follow_up ,$closed ,$hold ,$rejected]; 
          return $data ;  
    }


    public static function GetCountValues(){
        $month =  empty($_POST['month']) ? 0 :$_POST['month'] ;
        $currentYear = empty($_POST['year']) ? date('Y') : $_POST['year'];
       
        $startDate = new DateTime("$currentYear-01-01"); // First day of the month
        $endDate = new DateTime("$currentYear-12-30"); // Start with the first day of the month
        
         if($month):
                $all_date = getMonthdDate($month); 
                $start_date = $all_date['start_date'];
                $end_date = $all_date['end_date'];
         else:
            $start_date = $startDate->format('Y-m-d'); 
            $end_date = $endDate->format('Y-m-d'); 
        endif ; 

        $state_name =  $_POST['state_name'] ? $_POST['state_name'] : 0;
        $today_date = date('Y-m-d');
   
        // echo "SELECT COUNT(*) FROM tbl_leads WHERE status!=5 AND DATE(created_at) BETWEEN '$start_date' AND '$end_date'" ;
        if($state_name){
        $all_leads =  Yii::app()->db->createCommand("SELECT COUNT(DISTINCT lead_id) FROM tbl_leads WHERE status!=5 AND DATE(created_at) BETWEEN '$start_date' AND '$end_date' AND state_name='$state_name'")->queryScalar(); 
        $new_leads = Yii::app()->db->createCommand("SELECT COUNT(*) FROM tbl_leads Where  status=0 AND DATE(created_at) BETWEEN '$start_date' AND '$end_date' AND state_name='$state_name' " )->queryScalar();
        $follow_up = Yii::app()->db->createCommand("SELECT COUNT(*) FROM tbl_leads Where  status=1 AND DATE(created_at) BETWEEN '$start_date' AND '$end_date' AND state_name='$state_name' ")->queryScalar();
        $closed =   Yii::app()->db->createCommand("SELECT COUNT(*) FROM tbl_leads Where   status=2 AND DATE(created_at) BETWEEN '$start_date' AND '$end_date' AND state_name='$state_name' ")->queryScalar();
        $hold =     Yii::app()->db->createCommand("SELECT COUNT(*) FROM tbl_leads Where   status=3 AND DATE(created_at) BETWEEN '$start_date' AND '$end_date' AND state_name='$state_name' ")->queryScalar();
        $rejected = Yii::app()->db->createCommand("SELECT COUNT(*) FROM tbl_leads Where   status=4 AND DATE(created_at) BETWEEN '$start_date' AND '$end_date' AND state_name='$state_name' ")->queryScalar();
        $data =[$all_leads ,$new_leads ,$follow_up ,$closed ,$hold ,$rejected]; 
        }else{
         
            $all_leads =  Yii::app()->db->createCommand("SELECT COUNT(DISTINCT lead_id) FROM tbl_leads WHERE status!=5 AND DATE(created_at) BETWEEN '$start_date' AND '$end_date' ")->queryScalar(); 
            
            $new_leads = Yii::app()->db->createCommand("SELECT COUNT(*) FROM tbl_leads Where  status=0 AND DATE(created_at) BETWEEN '$start_date' AND '$end_date'" )->queryScalar();
            if(!$month){
                $follow_up = Yii::app()->db->createCommand("SELECT COUNT(*) FROM tbl_leads Where  status=1 AND DATE(status_update_date)='$today_date'")->queryScalar();
             }else{
               $follow_up = Yii::app()->db->createCommand("SELECT COUNT(*) FROM tbl_leads Where  status=1 AND DATE(created_at) BETWEEN '$start_date' AND '$end_date'")->queryScalar();
             }

            $closed =   Yii::app()->db->createCommand("SELECT COUNT(*) FROM tbl_leads Where   status=2 AND DATE(created_at) BETWEEN '$start_date' AND '$end_date'")->queryScalar();
            $hold =     Yii::app()->db->createCommand("SELECT COUNT(*) FROM tbl_leads Where   status=3 AND DATE(created_at) BETWEEN '$start_date' AND '$end_date'")->queryScalar();
            $rejected = Yii::app()->db->createCommand("SELECT COUNT(*) FROM tbl_leads Where   status=4 AND DATE(created_at) BETWEEN '$start_date' AND '$end_date'")->queryScalar();
            $data =[$all_leads ,$new_leads ,$follow_up ,$closed ,$hold ,$rejected]; 
        }
        return $data ;  
  }


  public static function GetCountryNameByOrder(){
      $country = Yii::app()->db->createCommand("SELECT  DISTINCT country_name ,priority FROM tbl_country ORDER BY  priority ASC")->queryAll();  
      return $country ; 
  }

    public static function GetStateName($id){
  
        $state = Yii::app()->db->createCommand("SELECT * FROM tbl_country Where id='$id'")->queryRow(); 
        return $state ; 
    }

    // public static function getPagination($currentPage , $totalCount){
    //     $pageSize = PAGINATION_LIMIT; 
    //     $totalPages = ceil($totalCount / $pageSize); 
    //     $offset = ($currentPage - 1) * $pageSize; 
    //     $start_number = $currentPage ==1 ? 1 : ($pageSize * $currentPage) -5;
    //     // $end_number = $currentPage ==1  ? $pageSize : $pageSize * $currentPage ; 
    //     $end_number = min($currentPage * $pageSize, $totalCount);
    //     return ['pageSize'=>$pageSize , 'offset'=>$offset , 'totalPages'=>$totalPages ,'currentPage'=>$currentPage ,'start_number' =>$start_number ,'end_number'=>$end_number] ; 
    // } 


      public static function getPagination($currentPage, $totalCount, $is_api = false)
    {
        $pageSize = PAGINATION_LIMIT;
        $totalPages = ceil($totalCount / $pageSize);
        $offset = ($currentPage - 1) * $pageSize;
        $start_number = $currentPage == 1 ? 1 : ($pageSize * $currentPage) - 5;
        // $end_number = $currentPage ==1  ? $pageSize : $pageSize * $currentPage ; 
        $end_number = min($currentPage * $pageSize, $totalCount);
        if ($is_api) {
            return ['total_items' => $totalCount, 'current_page' => $currentPage, 'page_size' => $pageSize, 'total_pages' => $totalPages, 'offset' => $offset];
        } else {
            return ['pageSize' => $pageSize, 'offset' => $offset, 'totalPages' => $totalPages, 'currentPage' => $currentPage, 'start_number' => $start_number, 'end_number' => $end_number];
        }
    }

    public static function getSalesPersonDetails($username){
        $data = Yii::app()->db->createCommand("SELECT * FROM user where username='$username'   AND enable=1")->queryRow(); 
        return $data; 
    }
    
    public static function GetMultipleSalesRepArr($id){
         $data = Yii::app()->db->createCommand("SELECT sale_rep FROM tbl_leads_multiple Where lead_id= $id")->queryColumn(); 
         return $data ; 
    }

    public static function  getNotification(){

         $NewUser = strtolower(Yii::app()->user->id); 
  
         if(Yii::app()->user->getState('userGroup')==2 && $NewUser!="dcote"){
            $sales_person = Yii::app()->user->getId();
            $notification = Yii::app()->db->createCommand("SELECT 
            lc.id AS id , 
            lc.lead_id AS lead_id , 
            lc.sales_rep AS sales_rep , 
            lc.comment AS comment , 
            lc.status AS status , 
            lc.created_at AS created_at 
           FROM leads_comment  As lc  LEFT JOIN tbl_leads AS tbl ON  tbl.lead_id =lc.lead_id LEFT JOIN tbl_leads_multiple AS tl ON tl.lead_id = lc.lead_id  Where tbl.status!=5 AND (tbl.assigned_to='$sales_person' OR tl.sale_rep ='$sales_person') GROUP BY tbl.lead_id  ORDER BY lc.created_at DESC")->queryAll();
         }else{

            // $notification = Yii::app()->db->createCommand("SELECT DISTINCT lc.id , lc.* FROM leads_comment AS lc LEFT JOIN tbl_leads tbl ON tbl.lead_id= lc.lead_id Where tbl.status !=5 ORDER BY lc.created_at DESC")->queryAll();  

             $user_id = TblLeads::GetLogggedinUserId(Yii::app()->user->id);

            // $notification = Yii::app()->db->createCommand("SELECT DISTINCT lc.id , lc.* FROM leads_comment AS lc LEFT JOIN tbl_leads tbl ON tbl.lead_id= lc.lead_id Where tbl.status !=5 AND lc.status=1 AND lc.user_id='$user_id' ORDER BY lc.created_at DESC")->queryAll();

            $sql = "SELECT DISTINCT lc.*
                    FROM leads_comment lc
                    INNER JOIN tbl_leads tl ON tl.lead_id = lc.lead_id
                    WHERE tl.status != 5
                    AND lc.status != 0
                    AND (
                    lc.deleted_by IS NULL
                    OR lc.deleted_by = ''
                    OR FIND_IN_SET(:user_id, lc.deleted_by) = 0
                    )
                    ORDER BY lc.created_at DESC
                    ";

                $notification = Yii::app()->db->createCommand($sql)
                    ->bindValue(':user_id', (int)$user_id)
                    ->queryAll();
         }

         return $notification  ;
    }

    public static function GetPriceDetails($id){
          $data = Yii::app()->db->createCommand("SELECT prod_name FROM tbl_product WHERE prod_id ='" . $id . "'")->queryScalar();
          return $data ; 
    }


    // for assigmning query manually ------------
    public static function AssignLeadAutoMetic($is_contact=false){
      
       if($is_contact==true){
          $state_name = $_POST['input_10'];
          $country = $_POST['input_11'];
        }else{
          $state_name = $_POST['input_16'];
          $country = $_POST['input_17'];
        }

           $countryLower=strtolower($country); 
         if($countryLower != "usa" &&
            $countryLower != "united states" &&
            $countryLower != "united state" &&
            $countryLower != "canada" &&
            $countryLower != "ca"){
                    $state_name = $country ; 
                   $country_sql = "SELECT country_name FROM  tbl_country  where state_name ='$state_name' LIMIT 1"; 
                   $country = Yii::app()->db->createCommand($country_sql)->queryScalar(); 

                //  $assigned_international=TblLeads::AssignSpecialCase(true);
                // if($assigned_international):
                //     return $assigned_international ;
                //     exit ; 
                // endif; 
            }else{
                $inquery_about  = $_POST['input_24'] ?? NULL ;
                // if (!empty($inquery_about) && stripos($inquery_about, 'Adult Hockey') !== false) {
                //     $special_case = TblLeads::AssignSpecialCase(false);
                //     if($special_case):
                //         return $special_case ;
                //         exit;
                //     endif; 
                // }elseif(in_array(strtolower($state_name), ['wisconsin', 'wi'], true)){
                //        $special_case = TblLeads::AssignSpecialCase(false);
                //     if($special_case):
                //         return $special_case ;
                //         exit;
                //     endif;
                // }

            }
        

        if(strlen($state_name) <= 2){
            $state_id  = Yii::app()->db->createCommand("SELECT id FROM tbl_country Where state_code  LIKE '%$state_name%' AND country_name LIKE '%$country%'")->queryScalar(); 
        }
        else{ 
            $state_id  = Yii::app()->db->createCommand("SELECT id FROM tbl_country Where state_name LIKE '%$state_name%'  AND country_name LIKE '%$country%'")->queryScalar(); 
        }


          try{
            $all_region_sales_person = Yii::app()->db->createCommand("SELECT * FROM lead_sales Where state_name = '$state_id' and country_name  LIKE '%$country%'  ORDER BY sales_priority ASC")->queryAll();
           //  echo '<pre>'; 
           //  print_r($all_region_sales_person);
           //  die; 
          

            if(count($all_region_sales_person)){
                   $is_assigned =TblLeads::AssignedToSalesPerson($state_id ,$country ,$state_name,$is_contact);
                   if(!$is_assigned){
                       foreach($all_region_sales_person as $key=>$value){ 
                           $update_sale_person_leads = Yii::app()->db->createCommand("UPDATE lead_sales SET assigned_lead=0 Where lead_sales_id = ".$value['lead_sales_id']."")->execute();
                       }

                       $is_assigned =TblLeads::AssignedToSalesPerson($state_id ,$country ,$state_name ,$is_contact);      
                   }
           }else{

                 $special_case = TblLeads::AssignSpecialCase(false ,$state_id);
                    if($special_case):
                        return $special_case ;
                        exit;
                    endif; 

                return TblLeads::AsssignLeadManual($is_contact ,$state_id);
           }

            return json_encode(['status'=>200 , 'Msg' => 'query assigned automatically']);
            exit ;
        
           }catch(Exception $e){
                 return json_encode (['status'=>503 , 'msg' =>'Something went wrong']);
                 exit ;
           }
     
        
    }


    //  public static function AssignSpecialCase($is_international = false)
        // {
        //     // -----------------------------
        //     // Normalize inputs (UTF-8 SAFE)
        //     // -----------------------------
        //     $inquery_about = trim($_POST['input_24'] ?? '');
        //     $inquery_about = mb_strtolower($inquery_about, 'UTF-8');

        //     $state   = mb_strtolower(trim($_POST['input_16'] ?? ''), 'UTF-8');
        //     $country = mb_strtolower(trim($_POST['input_17'] ?? ''), 'UTF-8');

        //     $assignedTo = null;
        //     $multipleSalesRep = null;

        //     $sameCondition =  " AND date(created_at) > '2026-02-08' " ;

        //     $isUSAorCanada = (
        //         strpos($country, 'usa') !== false ||
        //         strpos($country, 'united states') !== false ||
        //         strpos($country, 'united state') !== false ||
        //         strpos($country, 'canada') !== false ||
        //         strpos($country, 'ca') !== false
        //     );

        //     $isAdultHockey = (mb_strpos($inquery_about, 'adult hockey') !== false);

        //     // =========================================================
        //     // 1️⃣ Wisconsin always goes to Jgroll (TOP PRIORITY)
        //     // =========================================================
        //     if (in_array($state, ['wisconsin', 'wi'], true) && !$isAdultHockey && $isUSAorCanada) {
            
        //         $assignedTo = 'Jgroll';
        //     }

        //     // =========================================================
        //     // 2️⃣ Adult Hockey – USA / Canada (60 : 40)
        //     // =========================================================

        //     elseif ($isAdultHockey && !$is_international && $isUSAorCanada) {
            
        //         // -----------------------------
        //         // CONFIG
        //         // -----------------------------
        //         $cycleSize   = 10; // total cycle
        //         $brianSlots  = 6;  // Brian gets first 6
                

        //         // -----------------------------
        //         // Count existing Adult Hockey (USA/Canada) leads
        //         // -----------------------------
        //                 $totalLeads = (int) Yii::app()->db->createCommand("
        //             SELECT COUNT(*)
        //             FROM tbl_leads
        //             WHERE LOWER(inquery_about) LIKE '%adult hockey%'
        //             AND (
        //                     LOWER(country_name) LIKE '%usa%'
        //                 OR LOWER(country_name) LIKE '%united state%'
        //                 OR LOWER(country_name) LIKE '%canada%'
        //                 OR LOWER(country_name) = 'ca'
        //             )
        //                 AND status!=5
        //                  $sameCondition
        //         ")->queryScalar();

        //         // -----------------------------
        //         // Position in repeating cycle (0–9)
        //         // -----------------------------
        //         $position = $totalLeads % $cycleSize;

        //         // -----------------------------
        //         // Assign lead
        //         // -----------------------------
        //         if ($position < $brianSlots) {
        //             $assignedTo = 'BrianKreft';
        //         } else {
        //             $assignedTo = 'nkaiser';
        //         }
        //     } elseif (!$isAdultHockey && !$is_international && $isUSAorCanada) {
                
        //         $sequence = [
        //             'Jgroll',
        //             'Jgroll',
        //             'Jgroll',
        //             'Jgroll',
        //             'Jgroll', 
        //             'ameyers',
        //             'ameyers',
        //             'ameyers',               
        //             'nkaiser',                                  
        //             'mcortes'                                  
        //         ];

        //         $sequenceCount = count($sequence); // 10

        //         static $localCounter = null;

        //         if ($localCounter === null) {
        //             $localCounter = (int) Yii::app()->db->createCommand("
        //             SELECT COUNT(*)
        //             FROM tbl_leads
        //             WHERE assigned_to IS NOT NULL
        //             AND LOWER(inquery_about) NOT LIKE '%adult hockey%'
        //             AND (LOWER(country_name) LIKE '%usa%' OR LOWER(country_name) LIKE '%canada%' OR LOWER(country_name) LIKE '%ca%' OR 
        //             LOWER(country_name) LIKE '%united states%' )
        //             AND status != 5
        //              $sameCondition
        //         ")->queryScalar();
        //         }

                
        //         // $assignedTo = $sequence[$localCounter % $sequenceCount];
        //         // $localCounter++; // 🔥 THIS is the key
        //         $assignedTo = $sequence[$localCounter % $sequenceCount];

        //         $localCounter++; // advance counter for next lead
        //     }


        //     // =========================================================
        //     // 3️⃣ NON-Adult Hockey – USA / Canada (5-3-1-1)
        //     // =========================================================
        //     elseif (!$isAdultHockey && !$is_international && $isUSAorCanada) {
                
        //         $sequence = [
        //             'Jgroll',
        //             'Jgroll',
        //             'Jgroll',
        //             'Jgroll',
        //             'Jgroll',
        //             'ameyers',
        //             'ameyers',
        //             'ameyers',
        //             'nkaiser',
        //             'mcortes'
        //         ];

        //         $totalAssigned = Yii::app()->db->createCommand("
        //         SELECT COUNT(*)
        //         FROM tbl_leads
        //         WHERE assigned_to IS NOT NULL
        //           AND LOWER(inquery_about) NOT LIKE '%adult hockey%'
        //           AND (LOWER(country_name) LIKE '%usa%' OR LOWER(country_name) LIKE '%canada%' OR LOWER(country_name) LIKE '%united states%' OR LOWER(country_name) LIKE '%ca%')
        //           AND status!=5
        //            $sameCondition
        //     ")->queryScalar();

        //         $assignedTo = $sequence[$totalAssigned % 10];
        //     }

        //     // =========================================================
        //     // 4️⃣ Dealer + International
        //     // =========================================================
        //     elseif (

        //         mb_strpos($inquery_about, 'dealer') !== false &&
        //         $is_international
        //     ) {
            
        //         $assignedTo = 'Krwhitcomb';
        //         $multipleSalesRep = 'dcote';
        //     }

        //     // =========================================================
        //     // 5️⃣ International – default (6-3-1)
        //     // =========================================================
        //     else {
        //         echo "case:2  for international sales jhon-6 adrin-3 monica-2 | ";

        //         $sequence = [
        //             'Jgroll',
        //             'Jgroll',
        //             'Jgroll',
        //             'Jgroll',
        //             'Jgroll',
        //             'Jgroll',
        //             'ameyers',
        //             'ameyers',
        //             'ameyers',
        //             'mcortes'
        //         ];

        //         $totalAssigned = Yii::app()->db->createCommand("
        //         SELECT COUNT(*)
        //         FROM tbl_leads
        //         WHERE assigned_to IS NOT NULL
        //           AND (LOWER(country_name) NOT LIKE '%usa%'
        //           OR LOWER(country_name) NOT LIKE '%canada%'
        //           OR LOWER(country_name) NOT LIKE '%united states%'
        //           OR LOWER(country_name) NOT LIKE '%ca%')
        //           AND status!=5
        //            $sameCondition
        //     ")->queryScalar();

            
        //         $assignedTo = $sequence[$totalAssigned % 10];
        //     }

        //     // =========================================================
        //     // SAVE LEAD
        //     // =========================================================
        //     if (!$assignedTo) {
        //         return false;
        //     }

        //     $name = !empty($_POST['input_7']) ?  trim($_POST['input_7'])  : $_POST['input_7_3'] ;
        //     $phone_number =  !empty($_POST['input_15']) ?  trim($_POST['input_15']) : $_POST['input_3']; 
        //     $product_name  = !empty($_POST['input_9']) ? trim($_POST['input_9']) : $_POST['input_26'] ; 

        //     $tbl_leads = new TblLeads();
        //     $tbl_leads->pro_name       = $product_name ?? null;
        //     $tbl_leads->TAC_name       = $_POST['input_10'] ?? null;
        //     $tbl_leads->description   = $_POST['input_11'] ?? null;
        //     $tbl_leads->email         = $_POST['input_2'] ?? null;
        //     $tbl_leads->name          = $name ?? null;
        //     $tbl_leads->last_name     = $_POST['input_7_6'] ?? null;
        //     $tbl_leads->state_name    = $_POST['input_16'] ?? null;
        //     $tbl_leads->country_name  = $_POST['input_17'] ?? null;
        //     $tbl_leads->city          = $_POST['input_19'] ?? null;
        //     $tbl_leads->phone_no      = $phone_number ?? '';
        //     $tbl_leads->work_with_jog = trim($_POST['input_29'] ?? '');
        //     $tbl_leads->qty           = $_POST['input_13'] ?? 0;
        //     $tbl_leads->due_date      = date('Y-m-d' ,strtotime($_POST['input_14'])) ?? null;

        //     $tbl_leads->inquery_about = $_POST['input_24'] ?? null;
        //     $tbl_leads->assigned_to   = $assignedTo;
        //     $tbl_leads->created_at    = date('Y-m-d H:i:s');
        //     $tbl_leads->lead_type     = 2;




        //     if (!$tbl_leads->save()) {
        //         return false;
        //     }



        //     if ($multipleSalesRep) {
        //         $multi = new Multipleleads();
        //         $multi->lead_id    = $tbl_leads->lead_id;
        //         $multi->sale_rep   = $multipleSalesRep;
        //         $multi->created_at = date('Y-m-d H:i:s');
        //         $multi->updated_at = date('Y-m-d H:i:s');
        //         $multi->save();
        //     }

        //     TblLeads::SendAutomaticAssignedMail($tbl_leads);
        
        //     return json_encode(['status'=>200 ,'msg'=>'Lead assiged successfully']);

    // }




       public static function AssignSpecialCase($is_international=false ,$state_id=0){
           
        $inquery_about = trim($_POST['input_24'] ?? '');
        $inquery_about = mb_strtolower($inquery_about, 'UTF-8');

        $state   = mb_strtolower(trim($_POST['input_16'] ?? ''), 'UTF-8');
        $country = mb_strtolower(trim($_POST['input_17'] ?? ''), 'UTF-8');

        $assignedTo = null;
        $multipleSalesRep = null;

        $workWithJog = $_POST['input_29'] ?? NULL ; 

        $isUSAorCanada = (
        strpos($country, 'usa') !== false ||
        strpos($country, 'united states') !== false ||
        strpos($country, 'canada') !== false ||
        strpos($country, 'ca') !== false
        );

        $isAdultHockey = (mb_strpos($inquery_about, 'adult hockey') !== false);
        $sameCondition =  " AND date(created_at) > '2026-02-08' " ;


             // =========================================================
                 // 1️⃣ Wisconsin always goes to Jgroll (TOP PRIORITY)
             // =========================================================
                if (in_array($state, ['wisconsin', 'wi'], true) && !$isAdultHockey && $isUSAorCanada) {
                
                    $assignedTo = 'Jgroll';
                }
            // =========================================================
            // 2️⃣ Adult Hockey – USA / Canada (60 : 40)
            // =========================================================
            elseif ($isAdultHockey && !$is_international && $isUSAorCanada) {

                $salesConfig = [
                    ['name' => 'BrianKreft', 'capacity' => 6],
                    ['name' => 'nkaiser',    'capacity' => 4],
                ];

                $where = "
                    AND LOWER(inquery_about) LIKE '%adult hockey%'
                    AND (
                        LOWER(country_name) LIKE '%usa%'
                        OR LOWER(country_name) LIKE '%united state%'
                        OR LOWER(country_name) LIKE '%canada%'
                        OR LOWER(country_name) = 'ca'
                    )
                    $sameCondition
                ";

                $assignedTo =  TblLeads::assignLeadByCapacity($salesConfig, $where);
            }

            // =========================================================
            // 3️⃣ NON-Adult Hockey – USA / Canada (5-3-1-1)
            // =========================================================
            elseif (!$isAdultHockey && !$is_international && $isUSAorCanada) {

                $salesConfig = [
                    ['name' => 'Jgroll',  'capacity' => 5],
                    ['name' => 'ameyers', 'capacity' => 3],
                    ['name' => 'nkaiser', 'capacity' => 1],
                    ['name' => 'mcortes', 'capacity' => 1],
                ];

                $where = "
                    AND LOWER(inquery_about) NOT LIKE '%adult hockey%'
                    AND (
                        LOWER(country_name) LIKE '%usa%'
                        OR LOWER(country_name) LIKE '%canada%'
                        OR LOWER(country_name) LIKE '%united states%'
                        OR LOWER(country_name) LIKE '%ca%'
                    )
                    $sameCondition
                ";

                $assignedTo = TblLeads::assignLeadByCapacity($salesConfig, $where);
            }

                // =========================================================
                // 4️⃣ Dealer + International — unchanged
                // =========================================================
                elseif (mb_strpos($inquery_about, 'dealer') !== false && $is_international) {

                    $assignedTo         = 'Krwhitcomb';
                    $multipleSalesRep   = 'dcote';
                }

                // =========================================================
                // 5️⃣ International – default (6-3-1)
                // =========================================================
                else {

                    $salesConfig = [
                        ['name' => 'Jgroll',  'capacity' => 6],
                        ['name' => 'ameyers', 'capacity' => 3],
                        ['name' => 'mcortes', 'capacity' => 1],
                    ];

                    $where = "
                        AND LOWER(country_name) NOT LIKE '%usa%'
                        AND LOWER(country_name) NOT LIKE '%canada%'
                        AND LOWER(country_name) NOT LIKE '%united states%'
                        AND LOWER(country_name) NOT LIKE '%ca%'
                        $sameCondition
                    ";

                    $assignedTo = TblLeads::  assignLeadByCapacity($salesConfig, $where);
                }






         // =========================================================
             // SAVE LEAD
        // =========================================================
        if (!$assignedTo) {
            return false;
        }


        
        $name = !empty($_POST['input_7']) ?  trim($_POST['input_7'])  : $_POST['input_7_3'] ;
        $phone_number =  !empty($_POST['input_15']) ?  trim($_POST['input_15']) : $_POST['input_3']; 
        $product_name  = !empty($_POST['input_9']) ? trim($_POST['input_9']) : $_POST['input_26'] ; 

        $tbl_leads = new TblLeads();
        $tbl_leads->pro_name       = $product_name ?? null;
        $tbl_leads->TAC_name       = $_POST['input_10'] ?? null;
        $tbl_leads->description   = $_POST['input_11'] ?? null;
        $tbl_leads->email         = $_POST['input_2'] ?? null;
        $tbl_leads->name          = $name ?? null;
        $tbl_leads->last_name     = $_POST['input_7_6'] ?? null;
        $tbl_leads->state_name    = $_POST['input_16'] ?? null;
        $tbl_leads->country_name  = $_POST['input_17'] ?? null;
        $tbl_leads->city          = $_POST['input_19'] ?? null;
        $tbl_leads->phone_no      = trim($phone_number ?? '');
        $tbl_leads->work_with_jog = trim($_POST['input_29'] ?? '');
        $tbl_leads->qty           = $_POST['input_13'] ?? 0;
        $tbl_leads->due_date      = date('Y-m-d' ,strtotime($_POST['input_14'])) ?? null;

        $tbl_leads->inquery_about = $_POST['input_24'] ?? null;
        $tbl_leads->assigned_to   = $assignedTo;
        $tbl_leads->created_at    = date('Y-m-d H:i:s');
        $tbl_leads->lead_type     = 2;

        $tbl_leads->existing_customer = $_POST['input_31'] ?? NULL ; 
        $tbl_leads->work_with_jog_status = $_POST['input_28'] ?? NULL ; 





        if (!$tbl_leads->save()) {
            return false;
        }



        if ($multipleSalesRep) {
            $multi = new Multipleleads();
            $multi->lead_id    = $tbl_leads->lead_id;
            $multi->sale_rep   = $multipleSalesRep;
            $multi->created_at = date('Y-m-d H:i:s');
            $multi->updated_at = date('Y-m-d H:i:s');
            $multi->save();
        }

        TblLeads::UpdateWorkWithJog($workWithJog ,$tbl_leads ,$state_id) ;
        TblLeads::SendAutomaticAssignedMail($tbl_leads);

        return json_encode(['status'=>200 ,'msg'=>'Lead assiged successfully']);

     }

    public static function UpdateWorkWithJog($work_with_jog ,$tbl_leads ,$state_id=0){
                 // Sql for find the name of sales rep (work with jog)
        $workWithJog =NULL ;
        if(!empty($work_with_jog)){
           
             $sql  ="SELECT username from user Where fullname LIKE '%$work_with_jog%' and enable=1 And (user_group_id = 2 OR user_group_id =1)";
             $workWithJog = Yii::app()->db->createCommand($sql)->queryScalar();
        }


         if ($workWithJog) {
             $lead_id = $tbl_leads->lead_id; 
            // First Check if delar exists for that particulat state and country 
            $sql = "SELECT sales_name FROM  lead_sales Where state_name = '$state_id' AND sales_name= '$workWithJog' "; 
            $is_dealer_state = Yii::app()->db->createCommand($sql)->queryScalar(); 

            // Check if the sales rep is already assign to the lead then do not need to update that 
            $sql = "SELECT tl.lead_id FROM tbl_leads AS tl LEFT JOIN  tbl_leads_multiple AS tml  ON tl.lead_id = tml.lead_id Where tl.lead_id = '$lead_id' AND (tl.assigned_to = '$workWithJog' OR tml.sale_rep= '$workWithJog') ";
            $is_assigned = Yii::app()->db->createCommand($sql)->queryScalar(); 

            if($is_dealer_state && empty($is_assigned)){
                $multi = new Multipleleads();
                $multi->lead_id    = $tbl_leads->lead_id;
                $multi->sale_rep   = $workWithJog;
                $multi->created_at = date('Y-m-d H:i:s');
                $multi->updated_at = date('Y-m-d H:i:s');
                $multi->save();
             }
        }

        return true ; 
    }


    // Function for assigned the sales person - Fill Capacity First Assignment

    public static function assignLeadByCapacity($salesConfig, $whereCondition) {
            $assignedCounts = [];

            foreach ($salesConfig as $person) {
                $count = Yii::app()->db->createCommand("
                    SELECT COUNT(*)
                    FROM tbl_leads
                    WHERE status != 5
                    AND assigned_to = :name
                    $whereCondition
                ")
                ->bindValue(':name', $person['name'])
                ->queryScalar();

                $assignedCounts[$person['name']] = (int)$count;
            }

            $totalAssignedLeads = array_sum($assignedCounts);
            $totalCycleCapacity = array_sum(array_column($salesConfig, 'capacity'));
            $completedCycles    = floor($totalAssignedLeads / $totalCycleCapacity);

            foreach ($salesConfig as $person) {
                $name       = $person['name'];
                $capacity   = $person['capacity'];
                $maxAllowed = ($completedCycles + 1) * $capacity;

                if ($assignedCounts[$name] < $maxAllowed) {
                    return $name;
                }
            }

            return null; // fallback
    }

    public static function SendAutomaticAssignedMail($tbl_leads_or_id)
    {
           $lead_id = $tbl_leads_or_id['lead_id'] ?? $tbl_leads_or_id; 

          $sql = "SELECT assigned_to AS username
            FROM tbl_leads
            WHERE lead_id = :lead_id

            UNION

            SELECT sale_rep AS username
            FROM tbl_leads_multiple
            WHERE lead_id = :lead_id
            ";

          $salesRep = Yii::app()->db
            ->createCommand($sql)
            ->bindValue(':lead_id', (int)$lead_id)
            ->queryColumn(); // returns flat array
            
         
            $usernames = (array) $salesRep;
            $placeholders = [];
            $params = [];
 
          
         

            foreach ($usernames as $i => $name) {
                $ph = ':u' . $i;
                $placeholders[] = $ph;
                $params[$ph] = $name;
            }

            $sql = "SELECT email , fullname FROM user WHERE username IN (" . implode(',', $placeholders) . ")";

            $email = Yii::app()->db
            ->createCommand($sql)
            ->bindValues($params)
            ->queryAll();

            if (empty($email) && !empty($tbl_leads_or_id)) {
                return false;
            }

            
            $sales_details = TblLeads::getSalesPersonDetails($name); 
            $salesName = $sales_details['fullname'] ?? ""; 
            $userEmail = $tbl_leads_or_id['email'] ?? "" ; 
          

         
            

          foreach($email as $key=>$val){
    
          $mail = $val['email'];
        //   $mail= 'kalpana@jogdigitalinnovations.com';
          $subject = "JOG CRM-Lead has been assigned to ".$salesName;

        // Render HTML from view file (LIKE Laravel)
        $message = Yii::app()->controller->renderPartial(
            'application.views.leads.AssignedLeadEmail',
            [
                'salesRep' => $val['fullname'] , 
                'data'   => $tbl_leads_or_id ,
             ],
            true // IMPORTANT: return as string
        );

        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8\r\n";
        $headers .= "From: JOG Sportswear <no-reply@jog-joinourgame.com>\r\n";
        $headers .= "Reply-To: $userEmail\r\n";
        $headers .= "CC: dcote@jogsportswear.com\r\n";
        $headers .= "BCC: ravish@jogsportswear.com\r\n";


        return mail($mail, $subject, $message, $headers);
          
        }
    }


     public static function sendLeadUnassignedLeadMessage($sales_person , $lead_id ,$date){
         $tbl_lead_details = Yii::app()->db->createCommand("SELECT * FROM tbl_leads Where lead_id = '$lead_id'")->queryRow();
         $sales_person_details = TblLeads::getSalesPersonDetails($sales_person);
          
         $email = $sales_person_details['email'] ?? NULL;
         $name = $sales_person_details['fullname'] ?? NULL ; 

    
         if(empty($email)){
              return false ; 
         } 

         
       
        //  $email = 'kalpana@jogdigitalinnovations.com';
         $subject = "JOG CRM-Lead Assignment Change Notice – ".$tbl_lead_details['name'] ?? ''."";

           // Render HTML from view file (LIKE Laravel)
        $message = Yii::app()->controller->renderPartial(
            'application.views.leads.Un_AssignedLeadEmail',
            [
                'salesRep' => $name , 
                'data'   => $tbl_lead_details ,
                'date' => $date ,
             ],
            true // IMPORTANT: return as string
        );

        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8\r\n";
        $headers .= "From: JOG Sportswear <no-reply@jog-joinourgame.com>\r\n";
        $headers .= "Reply-To: dcote@jogsportswear.com\r\n";
        $headers .= "CC: dcote@jogsportswear.com\r\n";
        $headers .= "BCC: ravish@jogsportswear.com\r\n"; 

        return mail($email, $subject, $message, $headers);



          
    }


    public static function AssignedToSalesPerson($state_id ,$country ,$state_name,$is_contact=false){
        $all_region_sales_person = Yii::app()->db->createCommand("SELECT * FROM lead_sales Where state_name = '$state_id' and country_name  LIKE '%$country%' ORDER BY sales_priority ASC")->queryAll(); 

        $state_code = TblLeads::getStateCode($state_name); 
   
        try{
           
                foreach($all_region_sales_person as $key=>$value){
                    // echo $value['lead_capacity']  . '........' . $value['assigned_lead'] ; 

                    if($value['lead_capacity'] != $value['assigned_lead']){
                        
                        $assigned_upgrate = $value['assigned_lead']+1; 

                        $inquery_about  = $_POST['input_24'] ?? NULL ;
                        $product_name = $_POST['input_26'] ?? NULL ;  
                        $name = $_POST['input_7_3'] ?? NULL ; 
                        $last_name = $_POST['input_7_6'] ?? NULL;
                        $phone_number = $_POST['input_3'] ?? NULL; 
                        $sales_person_name = $_POST['input_29'] ?? NULL; 
                        $existing_customer = $_POST['input_31'] ?? NULL ; 
                        $work_with_jog_status = $_POST['input_28'] ?? NULL ;

                        $tbl_leads = new TblLeads(); 
                        
                         if($is_contact==true){
                                $tbl_leads->TAC_name = $_POST['input_4'];
                                $tbl_leads->con_subject = $_POST['input_5'];
                                $tbl_leads->referral_name =$_POST['input_8'];
                                $tbl_leads->description = $_POST['input_6'];
                                $tbl_leads->email = $_POST['input_2'];
                                $tbl_leads->name=$_POST['input_7.3'];
                                $tbl_leads->last_name = $_POST['last_name'];
                                $tbl_leads->state_name =$_POST['input_10'] ; 
                                $tbl_leads->country_name =$_POST['input_11'] ; 
                                $tbl_leads->phone_no = trim($_POST['input_3']);
                                $tbl_leads->city  = $_POST['input_19'];


                        }else{
                            $tbl_leads->pro_name = $_POST['input_9'] ?? $product_name ;
                            $tbl_leads->TAC_name = $_POST['input_10']; 
                            $tbl_leads->description = $_POST['input_11'];
                            $tbl_leads->qty = $_POST['input_13'];
                            $tbl_leads->due_date = date('Y-m-d' ,strtotime($_POST['input_14'])) ?? null;

                            $tbl_leads->name = $_POST['input_7'] ?? $name;
                            // $tbl_leads->last_name = $_POST['last_name'];
                            $tbl_leads->last_name = $last_name ; 
                            $tbl_leads->email = $_POST['input_2'];
                            $tbl_leads->phone_no = $_POST['input_15'] ?? $phone_number ;
                             $tbl_leads->state_name =$_POST['input_16'] ; 
                            $tbl_leads->country_name =$_POST['input_17'] ; 
                            $tbl_leads->city  = $_POST['input_19'];

                        }

            
                        $tbl_leads->inquery_about = $inquery_about ; 
                        $tbl_leads->work_with_jog = $sales_person_name ;
                        $tbl_leads->work_with_jog_status = $work_with_jog_status ; 
                        $tbl_leads->existing_customer = $existing_customer ;  

                        $tbl_leads->status = 0 ;
                        $tbl_leads->assigned_to = $value['sales_name'];
                        $tbl_leads->created_at =date('Y-m-d H:i:s');
                        $tbl_leads->lead_type =2;

                        if($state_code){
                            $tbl_leads->state_code =$state_code;
                        }

                        $tbl_leads->save();
                         
                        TblLeads::UpdateWorkWithJog($sales_person_name ,$tbl_leads ,$state_id); 
                        TblLeads::SendAutomaticAssignedMail($tbl_leads);
                
                        $update_sale_person_leads = Yii::app()->db->createCommand("UPDATE lead_sales SET assigned_lead=$assigned_upgrate Where lead_sales_id = ".$value['lead_sales_id']."")->execute();

                        $value['lead_sales_id'];
                        return  $is_assigned = true   ;
                        }else{ 
                           
                            $is_assigned =false ; 
                    }
                    
                }
    
         

        return $is_assigned ;
    }catch(Exception $e){
         echo 'can not insert the data' ;
    }
         
    }
     //---------------------End the manual query assignment 

     public static function AsssignLeadManual($is_contact=false ,$state_id=0){
        $state_code = TblLeads::getStateCode($_POST['input_16']); 
            $tbl_leads = new TblLeads(); 

            // $tbl_leads->last_name = $_POST['last_name'];
            
            $inquery_about  = $_POST['input_24'] ?? NULL ;
            $product_name = $_POST['input_26'] ?? NULL ;  
            $name = $_POST['input_7_3'] ?? NULL ; 
            $last_name = $_POST['input_7_6'] ?? NULL;
            $phone_number = $_POST['input_3'] ?? NULL; 
            $sales_person_name = $_POST['input_29'] ?? NULL; 

            $existing_customer = $_POST['input_31'] ?? NULL ; 
            $work_with_jog_status = $_POST['input_28'] ?? NULL ;

            
            $tbl_leads->name = $_POST['input_7'] ?? $name;
            $tbl_leads->email = $_POST['input_2'];
            $tbl_leads->phone_no = $_POST['input_15'] ?? $phone_number;

             if($is_contact){
                 $tbl_leads->TAC_name = $_POST['input_4'];
                 $tbl_leads->con_subject = $_POST['input_5'];
                 $tbl_leads->referral_name =$_POST['input_8'];
                 $tbl_leads->description = $_POST['input_6'];
                 $tbl_leads->state_name =$_POST['input_10'] ; 
                 $tbl_leads->country_name =$_POST['input_11'] ;
                 $tbl_leads->phone_no = trim($_POST['input_3']);
                 $tbl_leads->city = $_POST['input_19'];

             }else{
                 $tbl_leads->TAC_name = $_POST['input_10'];
                 $tbl_leads->pro_name = $_POST['input_9']  ?? $product_name;
                 $tbl_leads->description = $_POST['input_11'];
                 $tbl_leads->qty = $_POST['input_13'];
                 $tbl_leads->due_date = $_POST['input_14'];
                 $tbl_leads->state_name =$_POST['input_16'] ; 
                 $tbl_leads->country_name =$_POST['input_17'] ; 
                 $tbl_leads->city = $_POST['input_19'];
             }


              
            $tbl_leads->inquery_about = $inquery_about ; 
            $tbl_leads->work_with_jog = $sales_person_name ; 
             $tbl_leads->work_with_jog_status = $work_with_jog_status ; 
            $tbl_leads->existing_customer = $existing_customer ; 
 
            $tbl_leads->status = 0 ;
            $tbl_leads->assigned_to = '';
            $tbl_leads->created_at =date('Y-m-d H:i:s');
            $tbl_leads->lead_type =2;

         if($state_code){
             $tbl_leads->state_code =$state_code;
         }

         $tbl_leads->save();

         
            if ($tbl_leads->save()):
                  TblLeads::UpdateWorkWithJog($sales_person_name ,$tbl_leads ,$state_id);  
                  TblLeads::SendAutomaticAssignedMail($tbl_leads);
                return json_encode(['status' => 200 ,'msg'=>'data  inserted successfully']);
            else:
                return json_encode(['status' => 503 ,'msg'=>'Can not insert']);
            endif;
       
        
  }

     
    // On add and delete update the count of total assigned lead of sales person 
    public static function UpdateAssignLeadCount($sales_person , $lead_id, $type){
        $sql = "SELECT state_name , country_name  FROM tbl_leads  Where  status != 5 And lead_id = '$lead_id'";
        $lead_details = Yii::app()->db->createCommand($sql)->queryRow();
        
        $state_name = $lead_details['state_name'] ?? NULL ; 
        $country = $lead_activity['country_name'] ?? NULL;


        if (strlen($state_name) <= 2) {
            $state_id  = Yii::app()->db->createCommand("SELECT id FROM tbl_country Where state_code  LIKE '%$state_name%' AND country_name LIKE '%$country%'")->queryScalar();
        } else {
            $state_id  = Yii::app()->db->createCommand("SELECT id FROM tbl_country Where state_name LIKE '%$state_name%'  AND country_name LIKE '%$country%'")->queryScalar();
        }

        // Get the sales person details according to state and country 
         $sql = "SELECT lead_sales_id ,sales_name ,assigned_lead FROM lead_sales Where state_name ='$state_id' AND sales_name ='$sales_person' "; 
         $salesPersonDetails = Yii::app()->db->createCommand($sql)->queryRow();
         $totalAssignedLeads = $salesPersonDetails['assigned_lead'] ?? 0; 
         $lead_sales_id =  $salesPersonDetails['lead_sales_id'] ?? 0;
        
        if($type=='Add'){
              $updated_val = $totalAssignedLeads + 1;
              $newUpdated_val = $updated_val > $totalAssignedLeads ?  $totalAssignedLeads  : $updated_val ;
              $sql = "UPDATE lead_sales SET  assigned_lead = '$newUpdated_val' Where lead_sales_id = '$lead_sales_id'" ; 
        }elseif($type=='Remove'){
                $updated_val = $totalAssignedLeads - 1; 
               $sql = "UPDATE lead_sales SET  assigned_lead = '$updated_val' Where lead_sales_id = '$lead_sales_id'" ; 
        }  

        $exe = Yii::app()->db->createCommand($sql)->execute();
        if($exe){
             return true; 
        }else{
             return false ; 
        }

    }

    public static function getLeadSalesState(){
       

        $countryName = $_POST['countryName']; 
        $state_name = $_POST['stateName']; 
        $state_code = $_POST['stateCode'];
        $country_name  = array_search($countryName, CountryCodeMap);
         $NewUser = strtolower(Yii::app()->user->id) ; 


        
       try{
            // $sql  =   "SELECT state_name FROM tbl_country  Where state_code = '$state_code' AND country_name = '$country_name' ";
            // $state_name = Yii::app()->db->createCommand($sql)->queryScalar(); 

            if($state_name):
                 $str_name = TblLeads::getStateNameChar($state_name); 
                 
                //  echo $str_name ; 
                
                  if(Yii::app()->user->getState('userGroup') == 2  && $NewUser!="dcote"):
                      $admin = Yii::app()->user->getId(); 
                       if($str_name){
                        $sql = "SELECT COUNT(DISTINCT tbl.lead_id) FROM tbl_leads  AS tbl   
                        LEFT JOIN tbl_leads_multiple AS tlm ON tlm.lead_id = tbl.lead_id 
                        Where (tbl.assigned_to ='$admin' OR tlm.sale_rep ='$admin') AND state_name LIKE '%$state_name%'  OR state_code LIKE '%$str_name%'  AND status!=5";
                       }else{
                        $sql = "SELECT COUNT(DISTINCT tbl.lead_id) FROM tbl_leads  AS tbl   
                        LEFT JOIN tbl_leads_multiple AS tlm ON tlm.lead_id = tbl.lead_id 
                        Where (tbl.assigned_to ='$admin' OR tlm.sale_rep ='$admin') AND state_name LIKE '%$state_name%'   AND status!=5";
                       }
                     
                       
                      
                        $leads_count = Yii::app()->db->createCommand($sql)->queryScalar(); 
                        echo json_encode(['state_name' =>$state_name , 'leads_count'=>$leads_count]); 
                    
                  else:
                    if($str_name){
                        $sql= "SELECT COUNT(*) FROM tbl_leads Where state_name LIKE '%$state_name%' OR state_code LIKE '%$str_name%' AND country_name LIKE '%$countryName%' AND status!=5";
                    }else{
                        $sql= "SELECT COUNT(*) FROM tbl_leads Where state_name LIKE '%$state_name%'   AND status!=5";
                    }
                   
                    $leads_count = Yii::app()->db->createCommand($sql)->queryScalar(); 
                    echo json_encode(['state_name' =>$state_name , 'leads_count'=>$leads_count ,'sql'=>$sql]); 
                        
                   endif ;
           else:

               if($countryName == 'United States'){
                     $countryName= 'US';
               }
                 
               if(Yii::app()->user->getState('userGroup') == 2 && $NewUser!="dcote"):
                $admin = Yii::app()->user->getId(); 
                $leads_count = Yii::app()->db->createCommand("SELECT COUNT(DISTINCT tbl.lead_id) FROM tbl_leads  AS tbl   
                LEFT JOIN tbl_leads_multiple AS tlm ON tlm.lead_id = tbl.lead_id 
                Where (tbl.assigned_to ='$admin' OR tlm.sale_rep ='$admin') AND country_name LIKE '%$countryName%'  AND status!=5")->queryScalar(); 
                echo json_encode(['country_name' =>$countryName , 'leads_count'=>$leads_count]); 

               else:
                $leads_count = Yii::app()->db->createCommand("SELECT COUNT(*) FROM tbl_leads Where country_name LIKE '%$countryName%'  AND status!=5")->queryScalar(); 
                echo json_encode(['country_name' =>$countryName , 'leads_count'=>$leads_count]); 
               endif; 

            endif ;

        } catch(Exception $e){
            echo json_encode(['status'=>'error']);
        }



       
    }




    public static function getLeadSalesStateBACUP07042025(){
       

         $country_code = $_POST['country_code']; 
         $state_code = $_POST['stateCode']; 
         $country_name  = array_search($country_code, CountryCodeMap);
         
         if($country_name){
             $sql  =   "SELECT state_name FROM tbl_country  Where state_code = '$state_code' AND country_name = '$country_name' ";
             $state_name = Yii::app()->db->createCommand($sql)->queryScalar(); 

             if(Yii::app()->user->getState('userGroup') == 2):
                $admin = Yii::app()->user->getId(); 
                $leads_count = Yii::app()->db->createCommand("SELECT COUNT(DISTINCT tbl.lead_id) FROM tbl_leads  AS tbl   
                LEFT JOIN tbl_leads_multiple AS tlm ON tlm.lead_id = tbl.lead_id 
                Where (tbl.assigned_to ='$admin' OR tlm.sale_rep ='$admin') AND state_name = '$state_name' AND country_name = '$country_name' AND status!=5")->queryScalar(); 
                echo json_encode(['state_name' =>$state_name , 'leads_count'=>$leads_count]); 
                
            else:
                 $leads_count = Yii::app()->db->createCommand("SELECT COUNT(*) FROM tbl_leads Where state_name = '$state_name' AND country_name = '$country_name' AND status!=5")->queryScalar(); 
                 echo json_encode(['state_name' =>$state_name , 'leads_count'=>$leads_count]); 
                  
            endif ;

         } else{
             echo json_encode(['status'=>'error']);
         }



        
    }


       // assigned automatic to sales person for multiple leds 
     
    public static function MultipleSalesPersonAssigned($state_name , $country , $lead_id){
        if (strlen($state_name) <= 2) {
            $state_id  = Yii::app()->db->createCommand("SELECT id FROM tbl_country Where state_code  LIKE '%$state_name%' AND country_name LIKE '%$country%'")->queryScalar();
        } else {
            $state_id  = Yii::app()->db->createCommand("SELECT id FROM tbl_country Where state_name LIKE '%$state_name%'  AND country_name LIKE '%$country%'")->queryScalar();
        }     

        try {
            $all_region_sales_person = Yii::app()->db->createCommand("SELECT * FROM lead_sales Where state_name = '$state_id' and country_name  LIKE '%$country%'  ORDER BY sales_priority ASC")->queryAll();

            if (count($all_region_sales_person)) {
                $is_assigned = TblLeads::AssignedToMultipleSalesPerson($state_id ,$country,$state_name ,$lead_id);
                if (!$is_assigned) {
                    foreach ($all_region_sales_person as $key => $value) {
                        $update_sale_person_leads = Yii::app()->db->createCommand("UPDATE lead_sales SET assigned_lead=0 Where lead_sales_id = " . $value['lead_sales_id'] . "")->execute();
                    }
                    $is_assigned = TblLeads::AssignedToMultipleSalesPerson($state_id, $country, $state_name, $lead_id);
                }
            }else{
                return true;
            }

      
        } catch (Exception $e) {
            echo ' Something went wrong';
        }
 
    }

    public static function AssignedToMultipleSalesPerson($state_id ,$country ,$state_name ,$lead_id){
          try{ 
               $update = false; 
                $all_region_sales_person = Yii::app()->db->createCommand("SELECT * FROM lead_sales Where state_name = '$state_id' and country_name  LIKE '%$country%' ORDER BY sales_priority ASC")->queryAll();
                $state_code = TblLeads::getStateCode($state_name);

            
                foreach ($all_region_sales_person as $key => $value) {
                  $sql = "UPDATE tbl_leads SET assigned_to = '".$value['sales_name']."' WHERE lead_id = '$lead_id'";
                  $update = Yii::app()->db->createCommand($sql)->execute(); 
                }
              return $update ;
          }catch(Exception $e){
              die($e->getMessage());
          }
    }

    public static function GetSalesPersonNotification(){
        $sales_person = Yii::app()->user->getId();
        $sql = "SELECT lc.sales_rep AS sales_rep , tbl.name AS name ,  la.* FROM lead_activity AS la 
                        LEFT JOIN tbl_leads AS tbl ON tbl.lead_id = la.lead_id  
                        LEFT JOIN tbl_leads_multiple tlm ON tlm.lead_id = tbl.lead_id  
                        LEFT JOIN leads_comment AS lc  ON lc.lead_id = tbl.lead_id 
                        Where tbl.status!=5 AND (tbl.assigned_to='$sales_person' OR tlm.sale_rep ='$sales_person') GROUP BY tbl.lead_id  ORDER BY created_at DESC";

        $notification = Yii::app()->db->createCommand($sql)->queryAll();
         
        return $notification; 


    }



    public static function getCountryData($is_dashboard=false){
        if($is_dashboard==true){
            $data = Yii::app()->db->createCommand("SELECT cm.*  FROM country_master AS cm GROUP BY cm.country_code ORDER BY priority ASC")->queryAll(); 
        }else{
           $data = Yii::app()->db->createCommand("SELECT cm.*  FROM country_master AS cm  ORDER BY priority ASC")->queryAll(); 

        }
         return $data ; 
    }

     public static function updateCountryName(){
         $id = $_POST['cou_id']; 
         $name = $_POST['country_name']; 

         $sql = "UPDATE country_master SET country_name = '$name' Where id = '$id'";
         $update = Yii::app()->db->createCommand($sql)->execute(); 

         $update_country = Yii::app()->db->createCommand("UPDATE tbl_country SET country_name ='$name' Where country_id='$id'")->execute(); 
         return json_encode(['success' =>'true','status'=>200 ]);

     }

     public static function getCountryCountValue($country ,$is_same=false){
          
         $NewUser = strtolower(Yii::app()->user->id) ; 

        if(Yii::app()->user->getState('userGroup') == 2 && $NewUser!="dcote"){
          $admin =  Yii::app()->user->getId();

          $count = Yii::app()->db->createCommand("SELECT COUNT(*) FROM tbl_leads AS tbl LEFT JOIN tbl_leads_multiple AS tlm ON tlm.lead_id = tbl.lead_id Where (tbl.assigned_to='$admin' OR tlm.sale_rep='$admin') AND tbl.country_name LIKE  '%$country%' AND tbl.status!=5   GROUP BY tbl.lead_id ")->queryScalar(); 
           
        }else{
            if($is_same==true){
                 $country = 'us';
            }
            $count = Yii::app()->db->createCommand("SELECT COUNT(*) FROM tbl_leads Where country_name LIKE  '%$country%' AND status!=5")->queryScalar(); 
        }
         return  $count ;  
   }

    public static function getStateNameChar($state_name){
        $state_code = Yii::app()->db->createCommand("SELECT state_code from  tbl_country where state_name = '$state_name'")->queryScalar();
        $arr = explode("-" ,$state_code); 
    
        $first_characters=false;
        if(count($arr)>1){
            $first_characters = $arr[1];
        }
    
        return  $first_characters ; 
    }

    public static function getStateCode($state_name){
      

        // Use regular expression to find two consecutive uppercase letters
        preg_match('/\b([A-Z]{2})\b/', $state_name, $matches);
        
        // Check if there are any matches and return the result
        if (isset($matches[1])) {
            // echo "Found uppercase: " . $matches[1];
            return $matches[1];
        } else {
            // echo "No uppercase pair found.";
            return false; 
        }

 
    }


    public static function FindSalesRep($username ,$lead_id){
        $sql = " SELECT * FROM tbl_leads_multiple WHERE sale_rep = '$username' AND lead_id = '$lead_id'";
        $data = Yii::app()->db->createCommand($sql)->queryRow(); 
        return ['data' =>$data , 'sql' =>$sql] ;
   }

    public static function GetAssignedSalesPerson($lead_id){
        $sql = "SELECT assigned_to FROM tbl_leads  where lead_id = '$lead_id'"; 
        $data = Yii::app()->db->createCommand($sql)->queryScalar(); 
    
        if(!$data){
            $sql  = "SELECT sale_rep FROM tbl_leads_multiple WHERE lead_id = '$lead_id' order by created_at ASC LIMIT 1"; 
            $data = Yii::app()->db->createCommand($sql)->queryScalar(); 
        
        }
        return $data ; 

    }

    public  static function AlreadyExists($lead_id ,$state ,$country=false){
          $data  = Yii::app()->db->createCommand("SELECT * FROM lead_sales Where lead_sales_id='$lead_id'")->queryRow();
          $sales_person = $data['sales_name'] ?? ''; 
          if($country){
              $already_exists = Yii::app()->db->createCommand("SELECT * FROM  lead_sales Where state_name='$state' AND country_name='$country' AND sales_name='$sales_person' AND  lead_sales_id!='$lead_id'")->queryRow(); 
          }else{
              $already_exists = Yii::app()->db->createCommand("SELECT * FROM  lead_sales Where state_name='$state'  AND sales_name='$sales_person'
              AND  lead_sales_id!='$lead_id'")->queryRow(); 
          }
        
          return  $already_exists ;    
    }

    public static function UpateSalesPerPriority($state ,$all_state=false){
        try{
            if(!$all_state && $state):
                $sql = "SELECT * FROM lead_sales Where state_name='$state'"; 
                $data = Yii::app()->db->createCommand($sql)->queryAll();
                $priorirty = 0;
                foreach($data as $key=>$value){
                    $priorirty++;
                    $update_sql = "UPDATE lead_sales SET sales_priority='$priorirty' Where lead_sales_id ='".$value['lead_sales_id']."'";
                    $update = Yii::app()->db->createCommand($update_sql)->execute();
                
                } 

                return true ; 
            elseif(!empty($all_state)):
                  foreach($all_state as $key=>$value){
                       $update_sql = "UPDATE lead_sales SET sales_priority='$value' Where lead_sales_id ='$key'";
                       $update = Yii::app()->db->createCommand($update_sql)->execute();
                  }
                return false ;
            else:
             return false ; 
            endif ; 
        }catch(Exception $e){
             return false ;
        }
    }


    
    public static function getAllCRMNotification($is_count=false){
           
           $NewUser= strtolower(Yii::app()->user->id); 

            if(Yii::app()->user->getState('userGroup')==2  && $NewUser!="dcote"){
                $sales_person = Yii::app()->user->getId();
                $new_condition = "";
                if($is_count){
                      $new_condition= " AND la.status!=2" ;
                  }
                $sql =  "SELECT la.id AS id ,  
                          la.lead_status , 
                          tl.lead_id AS lead_id ,
                          la.action_type AS action_type , 
                          la.status AS status , 
                          la.created_at As created_at , 
                          la.updated_at As updated_at ,
                           tl.name  AS name , 
                            la.status AS act_status ,
                         tl.status AS status
                  FROM lead_activity AS la LEFT JOIN tbl_leads AS tl  ON la.lead_id=tl.lead_id LEFT JOIN tbl_leads_multiple AS tlm ON tlm.lead_id=tl.lead_id Where (tlm.sale_rep=:sales_person OR tl.assigned_to=:sales_person) AND tl.status!=5  AND la.status!=0 AND la.action_type!=5 $new_condition GROUP BY la.id";

                  
                 
                $data = Yii::app()->db->createCommand($sql)->bindValue(':sales_person', $sales_person)->queryAll();
        
            }else{
                 $sql =  "SELECT * FROM lead_activity AS la LEFT JOIN tbl_leads AS tl ON tl.lead_id = la.lead_id  Where tl.status!=5";
                 $data = Yii::app()->db->createCommand($sql)->queryAll(); 

            }
         return  $data ; 
    }

    public static function GetAllAssignedSalesRepCount($lead_id){
        //    $totalAssigned = Yii::app()->db->createCommand("
        //                                     SELECT 
        //                                     (CASE WHEN tl.assigned_to !='' THEN 1 ELSE 0 END)
        //                                     + 
        //                                     IFNULL(multi.cnt, 0) AS total_count
        //                                     FROM tbl_leads AS tl
        //                                     LEFT JOIN (
        //                                     SELECT lead_id, COUNT(*) AS cnt
        //                                     FROM tbl_leads_multiple
        //                                     WHERE lead_id = '" .$lead_id. "'
        //                                     ) AS multi ON multi.lead_id = tl.lead_id
        //                                     WHERE tl.lead_id = '" .$lead_id. "'
        //                                     ")->queryScalar();
         $totalAssigned = Yii::app()->db->createCommand("SELECT 
            (CASE WHEN u1.username IS NOT NULL THEN 1 ELSE 0 END) 
            + IFNULL(multi.cnt, 0) AS total_count
            FROM tbl_leads tl
            LEFT JOIN user u1 
            ON tl.assigned_to = u1.username AND u1.enable = 1
            LEFT JOIN (
            SELECT lm.lead_id, COUNT(*) AS cnt
            FROM tbl_leads_multiple lm
            INNER JOIN user u2 
                ON lm.sale_rep = u2.username AND u2.enable = 1
            WHERE lm.lead_id = :lead_id
            ) AS multi ON multi.lead_id = tl.lead_id
            WHERE tl.lead_id = :lead_id
            ")->bindValue(':lead_id', $lead_id)->queryScalar();
              return  $totalAssigned ;                          
    }

    // ----------------------------------------------------------------Sales CRM API ----------------------------------------------------------------------



       //  Sales CRM API 

    // ---Dashboard API ----------------------------------------------------------

    public static function GetAdminDashboardCount($user=false)
    {
        $sales_person = Yii::app()->user->getId();
        $start_date = $_GET['start_date'] ?? '';
        $end_date = $_GET['end_date'] ?? '';
        $timestamp = strtotime($start_date);
        $prev_month_start = date('Y-m-01', strtotime('-1 month', $timestamp));
        $prev_month_end   = date('Y-m-t', strtotime('-1 month', $timestamp));
        $user_group = $user->user_group_id;
        $more_condition = "";
        
        $userGroup = $user ? $user['user_group_id'] : 0; 
        $username = $user ? $user['username'] : '' ; 

        

        $salesCondition = '';
        $params = [
            ':start_date' => $start_date,
            ':end_date' => $end_date,
        ];

        if ($userGroup==2) {
            $username = $user['username'] ?? ''; 
            $salesCondition = "AND (tbl.assigned_to = :sales_person OR tbl_multiple.sale_rep = :sales_person)";
            $params[':sales_person'] = $username;
        }

        $baseQuery = "
                FROM tbl_leads tbl
                LEFT JOIN tbl_leads_multiple tbl_multiple ON tbl.lead_id = tbl_multiple.lead_id
                WHERE tbl.status != 5 
                $salesCondition
                AND DATE(tbl.created_at) BETWEEN :start_date AND :end_date
            ";
        $sql = "SELECT COUNT(DISTINCT tbl.lead_id) $baseQuery";


        $total_lead = Yii::app()->db->createCommand($sql)
            ->bindValues($params)
            ->queryScalar();


        $prevParams = [
            ':start_date' => $prev_month_start,
            ':end_date' => $prev_month_end,
        ];
        if ($userGroup==2){
            $username = $user['username'] ?? ''; 
            $prevParams[':sales_person'] = $username;
        }

        $last_month_total_leads = Yii::app()->db->createCommand("SELECT COUNT(DISTINCT tbl.lead_id) $baseQuery")
            ->bindValues($prevParams)
            ->queryScalar();



        // Lead counts by status

        $new_leads = TblLeads::getLeadsByStatus(0, $start_date, $end_date, $salesCondition, $userGroup, $username);

        $last_month_new_leads = TblLeads::getLeadsByStatus(0, $prev_month_start, $prev_month_end, $salesCondition, $userGroup, $username);

        $converted_leads = TblLeads::getLeadsByStatus(2, $start_date, $end_date, $salesCondition, $userGroup, $username);
        $last_month_converted_leads = TblLeads::getLeadsByStatus(2, $prev_month_start, $prev_month_end, $salesCondition, $userGroup, $username);

        $lost_leads = TblLeads::getLeadsByStatus(4, $start_date, $end_date, $salesCondition, $userGroup, $username);
        $last_month_lost_leads = TblLeads::getLeadsByStatus(4, $prev_month_start, $prev_month_end, $salesCondition, $userGroup, $username);

        // Country list
        $country = Yii::app()->db->createCommand("SELECT DISTINCT country_name FROM tbl_country ORDER BY country_name ASC")->queryAll();

        // Percentage calculation (safe with 0-division handling)



        $all_lead_percent = TblLeads::calculatePercent($total_lead, $last_month_total_leads);
        $new_leads_percent = TblLeads::calculatePercent($new_leads, $last_month_new_leads);
        $converted_leads_percent = TblLeads::calculatePercent($converted_leads, $last_month_converted_leads);
        $lost_leads_percent = TblLeads::calculatePercent($lost_leads, $last_month_lost_leads);



        $Count_arr = [
            'total_leads' => $total_lead,
            'new_leads' => $new_leads,
            'converted_leads' => $converted_leads,
            'lost_leads' => $lost_leads,
            'total_leads_percent' => number_format($all_lead_percent, 2),
            'new_leads_percent' => number_format($new_leads_percent, 2),
            'lost_leads_percent' => number_format($lost_leads_percent, 2),
            'converted_leads_percent' =>  number_format($converted_leads_percent, 2),
        ];


        return $Count_arr;
    }

    public static function calculatePercent($current, $previous)
    {
        $percent =   $previous  > 0 ? (($current - $previous) * 100 / $previous) : $current - $previous;
        $updated_percent  =  $percent == -100 ?  0  : $percent;
        return  $updated_percent;
    }


    public static function  getLeadsByStatus($status, $start, $end_dt, $salesCondition, $userGroup, $userId)
    {
        $query = "
                SELECT COUNT(DISTINCT tbl.lead_id)
                FROM tbl_leads tbl
                LEFT JOIN tbl_leads_multiple tbl_multiple ON tbl.lead_id = tbl_multiple.lead_id
                WHERE tbl.status = :status 
                $salesCondition
                AND DATE(tbl.created_at) BETWEEN :start_date AND :end_date
            ";
        $params = [
            ':status' => $status,
            ':start_date' => $start,
            ':end_date' => $end_dt,
        ];
        if ($userGroup == 2) {
            $params[':sales_person'] = $userId;
        }
        return Yii::app()->db->createCommand($query)->bindValues($params)->queryScalar();
    }

    public static function GetCountryCountLeads($user=false)
    {
        $start_date = $_GET['start_date'] ?? 0;
        $end_date = $_GET['end_date'] ?? 0;

        $sql = "SELECT *  FROM country_master  GROUP BY country_code  ORDER BY priority ";
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        $final_arr = [];



        foreach ($data as $key => $value) {
            $country_name = $value['country_name'];
            $country_code = $value['country_code'];
            $new_count = 0;

            $base_sql = "SELECT COUNT(DISTINCT tl.lead_id) FROM tbl_leads AS tl LEFT JOIN  tbl_leads_multiple AS tlm ON tlm.lead_id = tl.lead_id WHERE (tl.country_name LIKE '%$country_name%' OR tl.country_name LIKE '%$country_code%')  AND tl.status!=5  ";
            $count_base_sql = "SELECT COUNT(DISTINCT tl.lead_id) FROM tbl_leads AS tl LEFT JOIN  tbl_leads_multiple AS tlm ON tlm.lead_id = tl.lead_id   WHERE (country_name LIKE '%$country_name%' OR country_name LIKE '%$country_code%')  AND status=0  ";

            if ($start_date && $end_date) {
                $base_sql .= "AND DATE(tl.created_at) BETWEEN '$start_date' AND '$end_date'";
                $count_base_sql .= "AND DATE(tl.created_at) BETWEEN '$start_date' AND '$end_date'";
            }
            if ($user &&  $user['user_group_id'] == 2) {
                $username = $user['username'];
                $base_sql .= "AND (tl.assigned_to = '$username' OR tlm.sale_rep = '$username') ";
                $count_base_sql .= "AND (tl.assigned_to = '$username' OR tlm.sale_rep = '$username') ";
            }

            $count_val = Yii::app()->db->createCommand($base_sql)->queryScalar();
            $new_count = Yii::app()->db->createCommand($count_base_sql)->queryScalar();
            $final_arr[] = ['country' => $country_name, 'total' => $count_val, 'new' => $new_count];
        }

        return $final_arr;
    }

    //API for get upcoming follow up  
    public static function GetFollowUpData()
    {
        $userGroup = Yii::app()->user->getState('userGroup');
        $userId = Yii::app()->user->getId();
        $today_date = date('Y-m-d');
        $end_date = date('y-m-d', strtotime("+ 7 days"));
        $product = Product_Query;

        $base_sql = "SELECT tbl.lead_id AS lead_id , 
                       tbl.status_update_date AS date , 
                       $product ,
                       tbl.TAC_name As comp_name , 
                       tbl.name AS name ,
                       tbl.phone_no AS number,
                       ls.action_type AS action_type  
                       FROM tbl_leads AS tbl  LEFT JOIN  tbl_leads_multiple AS tlm ON tbl.lead_id = tlm.lead_id LEFT JOIN  leads_status AS ls ON tbl.lead_id =ls.lead_id LEFT JOIN tbl_product AS tbl_pro ON tbl_pro.prod_id = tbl.pro_name   Where tbl.status=1 AND DATE(tbl.status_update_date) BETWEEN '$today_date' AND '$end_date'  ";
        if ($userGroup == 2) {
            $base_sql .= "AND (tbl.assigned_to = '$userId' OR tbl_multiple.sale_rep = '$userId') ";
        }
        $base_sql .= " GROUP BY tbl.lead_id  ORDER BY tbl.created_at ";

        $data = Yii::app()->db->createCommand($base_sql)->queryAll();
        return $data;
    }

    public static function GetUpdateData($user=false)
    {
      
       
        
        // $status_name = Status_Name_Query;
        $status_name = "CASE 
                WHEN la.lead_status = 1 THEN 'Follow up'
                WHEN la.lead_status = 2 THEN 'Won'
                WHEN la.lead_status = 3 THEN 'Pending'
                WHEN la.lead_status = 4 THEN 'Lost'
            ELSE '' 
            END AS status
            "; 

        $base_sql = "SELECT 
    CASE
        WHEN la.action_type = 1 THEN 'Edited'
        WHEN la.action_type = 2 THEN 'Assigned Leads'
        WHEN la.action_type = 3 THEN 'Status Updated'
        WHEN la.action_type = 4 THEN 'Comment'
        ELSE ''
            END AS action_ty,
            la.action_type AS action_type,
            tbl.name AS name,
            la.id AS id,
            la.created_at AS date,
            $status_name,
            CASE
                WHEN la.lead_status = 1 THEN 'Follow up'
                WHEN la.lead_status = 2 THEN 'Won'
                WHEN la.lead_status = 3 THEN 'Pending'
                WHEN la.lead_status = 4 THEN 'Lost'
                ELSE ''
            END AS status,
            CASE
                WHEN la.action_type = 4 THEN lc.comment
                ELSE ''
            END AS comment,
            tbl.lead_id AS lead_id
        FROM lead_activity AS la
        LEFT JOIN tbl_leads AS tbl ON tbl.lead_id = la.lead_id
        LEFT JOIN tbl_leads_multiple AS tlm ON tlm.lead_id = tbl.lead_id
        LEFT JOIN leads_comment AS lc ON lc.lead_id = tbl.lead_id
        WHERE tbl.status != 5";

        if ($user && $user['user_group_id']==2) {
            $username = $user['fullname'];
            $base_sql .= " AND ('$username' IN (tbl.assigned_to, tlm.sale_rep))";
        }



        $base_sql .= "  GROUP BY la.id
        ORDER BY la.created_at DESC
        LIMIT 10";
        // print_r($base_sql);
        $data = Yii::app()->db->createCommand($base_sql)->queryAll();
        return $data;
    }


public static function GetCountryStateCount($user=false)
{
    $country = $_GET['country'];

    $start_date = $_GET['start_date']; 
    $end_date = $_GET['end_date']; 

    if (!$country) {
        return ['msg' => 'Please enter country name'];
    }

   $sql = "SELECT 
        COALESCE(tlc.state_name, tbl.state_name) AS state,
        COUNT(*) AS count
        FROM tbl_leads AS tbl
        LEFT JOIN tbl_country AS tlc
            ON tbl.state_name LIKE CONCAT('%', tlc.state_name, '%')
            OR tbl.state_name LIKE CONCAT('%', tlc.state_code, '%')
            AND  tlc.country_name = '$country'
        LEFT JOIN tbl_leads_multiple AS tlm ON tlm.lead_id = tbl.lead_id
        WHERE tbl.country_name LIKE :country 
        AND tbl.status != 5
        " ;

        
        if ($user && $user['user_group_id']==2) {
            $username = $user['username'];
            $sql .= " AND ('$username' IN (tbl.assigned_to, tlm.sale_rep))";
        }

        if($start_date  && $end_date){
             $sql.  " AND  DATE(tbl.created_at) BETWEEN '$start_date' AND '$end_date'";
        }
        $sql .=" GROUP BY tbl.lead_id" ; 

    $data = Yii::app()->db->createCommand($sql)
        ->bindValue(':country', "%$country%")
        ->queryAll();

   
   

    return  $data ;
  

}








    //----------------------------------------------------------

    // Gloabal function for CRM -----------------------
    public static function GetProductList()
    {
        $data =  Yii::app()->db->createCommand("SELECT prod_id ,prod_name ,prod_type FROM tbl_product ORDER BY sort ASC;")->queryAll();
        return $data;
    }

    public static function GetCountryList()
    {
        $data = Yii::app()->db->createCommand("SELECT DISTINCT country_name  FROM `tbl_country`")->queryAll();
        return $data;
    }

    public static function GetStateList()
    {
        $country = $_GET['country'] ??  0;
        $state = $_GET['state'] ?? 0;

        $sql_base = "SELECT id ,country_name ,state_name FROM tbl_country WHERE country_name LIKE '$country' ";
        if ($state) {
            $sql_base .= "AND state_name='$state'";
        }
        $sql_base  .= " ORDER BY state_name ASC";

        $data = Yii::app()->db->createCommand($sql_base)->queryAll();
        return $data;
    }

    //----------------------------------

    // ------------- API for Leads ------------

    public static function GetAllLeadsData()
    {
        $status_name = Status_Name_Query;
        $product = Product_Query;
        $base_sql = "
            SELECT  
            tbl.lead_id,  
            tbl.created_at AS date, 
            CASE 
              WHEN tbl.due_date IS NULL OR tbl.due_date = '' THEN NULL
               ELSE tbl.due_date
            END AS dueDate,
            CONCAT(tbl.name, ' ', tbl.last_name) AS name, 
            tbl.phone_no AS number, 
            tbl.email As email,
            tbl.country_name AS country, 
            tbl.qty AS qty, 
            $product, 
            $status_name,
            COALESCE(GROUP_CONCAT(tlm.sale_rep SEPARATOR ', '), tbl.assigned_to) AS assignTo
            FROM tbl_leads AS tbl  
            LEFT JOIN tbl_leads_multiple AS tlm ON tlm.lead_id = tbl.lead_id 
            LEFT JOIN tbl_product AS tbl_pro ON tbl_pro.prod_id = tbl.pro_name  
            WHERE tbl.status != 5
            ";


        $region = $_GET['region'] ?? 0;
        $lead_type = $_GET['lead_type'] ?? 0;
        $month = $_GET['month'] ?? date('m');
        $year = $_GET['year'] ?? date('Y');
        $sales_person = $_GET['sales_rep'] ?? 0;
        $currentPage =   $_GET['page'] ?? 1;

        $both_date = getMonthdDate($month, $year);
        $start_date = $both_date['start_date'];
        $end_date = $both_date['end_date'];
        $my_leads = $_GET['user_name'] ?? 0;
        $status = $_GET['status'] ?? 'All';
        $search = $_GET['search'] ?? NUll;

        if ($region) {
            $base_sql .= " AND tbl.country_name LIKE '%$region%' ";
        }

        if ($lead_type) {
            $base_sql .= " AND tbl.lead_type = '$lead_type'";
        }
        if ($start_date && $end_date) {
            $base_sql .= " AND DATE(tbl.created_at) BETWEEN '$start_date' AND '$end_date'";
        }
       

        if ($sales_person || $my_leads) {
           
            // $sales_rep = !empty($sales_person) ? $sales_person : '';
            // $sales_rep = !empty($my_leads) ? $my_leads : '';
            $sales_rep = !empty($sales_person) 
                ? $sales_person 
                : (!empty($my_leads) ? $my_leads : '');


            $base_sql .= " AND (tbl.assigned_to='$sales_rep' OR tlm.sale_rep='$sales_rep') ";
        }

         if ($status != 'All') {
            $base_sql .= " AND tbl.status = '$status'";
        }

        if ($search) {
            $base_sql .= "AND(
                tbl.qty LIKE '% " . $search . " %'
                OR tbl.due_date LIKE '%" . $search . "%'
                OR tbl.name LIKE  '%" . $search . "%'
                OR tbl.last_name LIKE '%" . $search . "%'
                OR tbl.email LIKE '%" . $search . "%'
                OR tbl.phone_no LIKE '%" . $search . "%'
                OR tbl.state_name LIKE '%" . $search . "%'
                OR tbl.assigned_to LIKE '%" . $search . "%'
                OR tbl.country_name LIKE '%" . $search . "%' 
                OR prod_name LIKE '%" . $search . "%' 
                OR tbl.pro_name LIKE '%" . $search . "%')
                 ";
        }

        //pagination
        // echo $base_sql ; 
        $base_sql .= "GROUP BY tbl.lead_id";
        //  echo $base_sql ; 
        $data = Yii::app()->db->createCommand($base_sql)->queryAll();
        $totalCount = count($data);

        $pagination_arr = TblLeads::getPagination($currentPage, $totalCount, $is_api = true);



        $base_sql .= " ORDER BY tbl.created_at DESC  LIMIT  " . $pagination_arr['page_size'] . "   OFFSET " . $pagination_arr['offset'] . "";

        // echo $base_sql ; 
        $totalRecentLeads = Yii::app()->db->createCommand($base_sql)->queryAll();

        // print_r($totalRecentLeads);

        $data = [];
        foreach ($totalRecentLeads as $key => $val) {

            if (!empty($val['assignTo'])) {
                $assignToArray = array_unique(array_map('trim', explode(',', $val['assignTo'] ?? '')));
                $val['assignTo'] = $assignToArray;
            } else {
                $val['assignTo'] = NULl;
            }

            $data[] = $val;
        }




        $dt = [
            'status' => 200,
            'data' => $data,
            'pagination' => $pagination_arr
        ];
        // $dt = array_merge($totalRecentLeads ,['pagination'=>$pagination_arr] );

        return  $dt;
    }

    public static function GetSingleLead($id = false)
    {
        $lead_id = isset($_GET['lead_id']) ? $_GET['lead_id'] : $id;
        $status_name = Status_Name_Query;
        $product = Product_Query;
            

            $base_sql = "SELECT  
        tbl.lead_id,  
        tbl.created_at AS date, 
        tbl.due_date AS dueDate, 
        CONCAT(NULLIF(tbl.name, ''), ' ',tbl.last_name) AS name, 
        NULLIF(tbl.country_name, '') AS country, 
        NULLIF(tbl.TAC_name, '') AS team_name, 
        NULLIF(tbl.phone_no, '') AS number, 
        NULLIF(tbl.email, '') AS email, 
        NULLIF(tbl.state_name, '') AS state,
        NULLIF(tbl.description, '') AS project_overview,
        NULLIF(tbl.qty, '') AS qty, 
        $product,
        $status_name,
        CASE 
            WHEN tbl.lead_type = 1 THEN 'Offline'
            WHEN tbl.lead_type = 2 THEN 'Online'
            ELSE NULL
        END AS origin,
            COALESCE(GROUP_CONCAT(NULLIF(tlm.sale_rep, '') SEPARATOR ', '), NULLIF(tbl.assigned_to, '')) AS assignTo
        FROM tbl_leads AS tbl  
        LEFT JOIN tbl_leads_multiple AS tlm ON tlm.lead_id = tbl.lead_id 
        LEFT JOIN tbl_product AS tbl_pro ON tbl_pro.prod_id = tbl.pro_name  
        WHERE tbl.status != 5 
        AND tbl.lead_id = '$lead_id'";

        $data = Yii::app()->db->createCommand($base_sql)->queryRow();
        if (!empty($data['assignTo'])) {
            $data['assignTo'] = array_map('trim', explode(',', $data['assignTo']));
        } else {
            $data['assignTo'] = null;
        }
        return $data;
    }

    public static function AddEditLeads($user=null)
    {

        $rawBody = file_get_contents("php://input");
        $input = json_decode($rawBody, true); // decode as assoc array

        if (!$input) {
            return ['status' => 400, 'msg' => 'Invalid JSON payload'];
        }



        $id = $input['lead_id'] ?? 0;
        $team_name = $input['team_name'] ?? '';
        $product = $input['product'] ?? '';
        $name = $input['name'] ?? '';
        $last_name = $input['last_name'] ?? '';
        $phone_number = $input['number'] ?? '';
        $email = $input['email'] ?? '';
        $country = $input['country'] ?? '';
        $state = $input['state'] ?? '';
        $qty = $input['qty'] ?? '';
        $due_date = empty($input['dueDate']) ? '' : $input['dueDate'];
        $project_overview = $input['project_overview']  ?? '';
        $assigned_val = $input['assigned_val'];
        $assigned_to = $input['assignTo'];
        $salesPerson = '';
        if(!empty($user) && $user['user_group_id']==2 && $assigned_val==0){
            $salesPerson = $user['username'];
        }
        if($assigned_val == '1' && !empty($assigned_to)) {
            $salesPerson = $assigned_to[0];
        }
      
        
        // $multiple_sales_person = $input['assignTo'];




        $tbl_leads = $id  ? TblLeads::model()->find('lead_id=:id', array(':id' => $id)) : new TblLeads();
        $tbl_leads->TAC_name = $team_name;
        $tbl_leads->pro_name = $product;
        $tbl_leads->description = $project_overview;
        $tbl_leads->qty = $qty;
        $tbl_leads->due_date = $due_date;
        $tbl_leads->name = $name;
        $tbl_leads->last_name = $last_name;
        $tbl_leads->email = $email;
        $tbl_leads->phone_no = $phone_number;
        $tbl_leads->state_name = $state;
        $tbl_leads->country_name = $country;
        $tbl_leads->status = 0;
        $tbl_leads->assigned_to = $salesPerson;
        $tbl_leads->lead_type = 1;
        $tbl_leads->created_at = date('Y-m-d H:i:s');
        $tbl_leads->save();
        $leadId =  $id ? $id : $tbl_leads->lead_id;

        if ($leadId) {
            if (!empty($assigned_to) && $assigned_val == '2') {


                $check_exists_sql = "SELECT * FROM tbl_leads_multiple As tblm Where lead_id='$leadId'";
                $data = Yii::app()->db->createCommand($check_exists_sql)->queryAll();
                // print_r($data); 
                foreach ($data as $key => $val) {
                    $sql = "DELETE FROM tbl_leads_multiple WHERE id = :id";
                    Yii::app()->db->createCommand($sql)
                        ->bindParam(':id', $val['id'], PDO::PARAM_INT)
                        ->execute();
                }
                foreach ($assigned_to as $rep) {
                    $multiple_lead = new Multipleleads();
                    $multiple_lead->lead_id = $leadId;
                    $multiple_lead->sale_rep = $rep;
                    $multiple_lead->save();
                }
            }

            if($id){
                   $lead_activity = ActivityLog::AddLeadActivity($id ,1);
            }

            $msg = $id ?  'Data updated succesfully' : 'Data saved successfully';
            $data = TblLeads::GetSingleLead($leadId);
            if ($data):
                $result =  ['status' => 200, 'msg' => $msg, 'data' => $data];
            else:
                $result = ['status' => 404, 'msg' => 'No records found', 'data' => $data];

            endif;
            return $result;
        }
    }

    public static function DeleteLeads()
    {
        $id = $_GET['lead_id'];
        $is_permanent = $_GET['is_permanent'] ?? false;
        if(!empty($is_permanent) && $is_permanent==true){
           
              return TblLeads::DeletePermanent();
        }

        $date = date('Y-m-d H:i:s');
        $userId = Yii::app()->user->getId();
        $user = Yii::app()->db->createCommand("SELECT username FROM user Where id='$userId'")->queryScalar();
       
        $sql = "UPDATE  tbl_leads SET tbl_leads.status = 5  , tbl_leads.deleted_by = '$user' , tbl_leads.deleted_date= '$date' Where lead_id = '$id'  ";
        $deleted = Yii::app()->db->createCommand($sql)->execute();
        $activity_log = ActivityLog::AddLeadActivity($id ,6, $user); 
        $msg =  $deleted ? 'Lead deleted successfully'  : 'Something went wrong';

        return ['msg' => $msg];
    }
    //------------------------------


    //--------------------Lead View details ------
    public static function GetLeadsViewDetails()
    {
        $id = $_GET['id'] ?? 0;
        if (!$id) {
            return [];
        }
        $condition = 'true AS is_cmt';
         $NewUser = strtolower(Yii::app()->user->id) ; 

        if (Yii::app()->user->getState('userGroup') == 2  && $NewUser!="dcote") {
            $sales_person = $_GET['sales_person'];
            $condition = "CASE 
                    WHEN tbl.assigned_to = '$sales_person' OR tlm.sale_rep = '$sales_person' 
                    THEN true 
                    ELSE false 
                    END AS is_cmt";
        }

        $status_name = Status_Name_Query;
        $product = Product_Query;

        $base_sql = "SELECT tbl.lead_id , 
        $product ,
        tbl.TAC_name As team_name , 
        tbl.description As description  , 
        tbl.created_at AS created_at , 
        tbl.due_date As dueDate, 
        tbl.name AS name , 
        tbl.phone_no AS number,
        tbl.email AS email ,
        tbl.state_name AS state , 
        tbl.country_name As country,
        CASE 
         WHEN tbl.lead_type=1 THEN 'Offline'
         WHEN tbl.lead_type=2 THEN 'Online'
        ELSE ''
        END AS origion,
        $status_name , 
        $condition 
        FROM tbl_leads AS tbl LEFT JOIN  tbl_leads_multiple  AS tlm ON tlm.lead_id = tbl.lead_id 
        LEFT JOIN tbl_product AS tbl_pro ON tbl_pro.prod_id = tbl.pro_name
        Where tbl.lead_id='$id' ";


        $lead_details = Yii::app()->db->createCommand($base_sql)->queryRow();
        $lead_sales_person = Yii::app()->db->createCommand("
                    (
                        SELECT 
                        tlm.id, 
                        tlm.lead_id, 
                        tlm.sale_rep 
                        FROM tbl_leads_multiple AS tlm
                        WHERE tlm.lead_id = '$id'
                    )
                    UNION ALL
                    (
                        SELECT 
                        NULL AS id, 
                        tl.lead_id, 
                        tl.assigned_to AS sale_rep
                        FROM tbl_leads AS tl
                        WHERE tl.lead_id = '$id' AND tl.assigned_to IS NOT NULL
                    )")->queryAll();



        $comment = Yii::app()->db->createCommand("SELECT * FROM leads_comment As lc Where lc.lead_id='$id'")->queryAll();
        $follow_up_sql = "SELECT * FROM leads_status As ls Where ls.lead_id='$id' AND ls.action_type IS NOT NULL ";
        $follow_up_details = Yii::app()->db->createCommand($follow_up_sql)->queryAll();
        if (!empty($lead_details)):
            $data = array_merge(
                $lead_details,
                [
                    'Assigned_leads' => $lead_sales_person,
                    'comment' => $comment,
                    'follow_up_details' => $follow_up_details
                ]
            );
        else:
            $data = [];
        endif;


        return $data;
    }

    public static function UpdateStatus()
    {

        $input = file_get_contents("php://input");
        $data = json_decode($input, true);

        if (!$data) {
            return ['status' => 400, 'msg' => 'Invalid JSON input'];
        }


        $follow_up_date = $data['date'];
        $action_type = $data['action_type'] ?? 0;
        $Notes = $data['note'];
        $status = $data['status'];
        $lead_id = $data['lead_id'];
        $today_date = date('Y-m-d H:i:s');

        $tbl_status = new LeadsStatus();
        $tbl_status->lead_id = $lead_id;
        $tbl_status->status_update_date = $follow_up_date;
        $tbl_status->action_type = $action_type ? $action_type : NULL;
        $tbl_status->note = $Notes;
        $tbl_status->status = $status;
        $tbl_status->created_at = $today_date;
        $tbl_status->save();

        $tbl_leads = TblLeads::model()->find('lead_id=:id', array(':id' => $lead_id));
        $tbl_leads->status = $status;
        $tbl_leads->status_update_date = $today_date;
        $tbl_leads->save();

        $lead_activity = ActivityLog::AddLeadActivity($lead_id ,3 ,$status);
        $data = $action_type ?   TblLeads::GetFollowUpDetails($tbl_status->id) : $status;
        return ['status' => 200, 'msg' => 'Status Updated successfully', 'data' => $data];
    }

    public static function GetComments($id = false)
    {
        $lead_id = $_GET['lead_id'] ?? 0;
        $condition = $id ?  "lc.id='$id'"   : "lc.lead_id='$lead_id'";
        $sql  = "SELECT  
         id , 
         lead_id,
         sales_rep, 
         comment AS cmt, 
         created_at
        FROM leads_comment As lc Where $condition  order by created_at DESC";

        $comment = $id ?   Yii::app()->db->createCommand($sql)->queryRow()  : Yii::app()->db->createCommand($sql)->queryAll();
        return $comment;
    }

    public static function AddComment()
    {
        $model = new LeadComment;
        $input = file_get_contents("php://input");
        $data = json_decode($input, true);
        $cmt_id = $model->addComment($data);
        $data = TblLeads::GetComments($cmt_id);
        // print_r($data); die ; 
        return ['status' => 200, 'data' => $data, 'msg' => 'Comment Added successfully'];
    }

    public static function SharedLeadsData()
    {
        $lead_id = $_GET['lead_id'];
        $search = $_GET['search'] ?? 0;
        $base_sql = "SELECT 
                        user.username AS username,
                        user.fullname AS name, 
                        tl.lead_id,
                        CASE 
                            WHEN user.username = tl.assigned_to 
                                OR EXISTS (
                                    SELECT 1 
                                    FROM tbl_leads_multiple AS t 
                                    WHERE t.lead_id = '$lead_id' AND t.sale_rep = user.username
                                )
                            THEN 'true' 
                            ELSE 'false' 
                        END AS is_assigned
                    FROM 
                        user
                    LEFT JOIN 
                        tbl_leads AS tl ON tl.lead_id = '$lead_id'
                    WHERE 
                        1=1
                    ";

        if ($search) {
            $base_sql .= " AND user.username LIKE '%$search%'";
        }

        $base_sql  .= " GROUP BY user.id ";
        $data  =  Yii::app()->db->createCommand($base_sql)->queryAll();
        return $data;
    }

    public static function  UpdateSharedLeads()
    {
        $id = $_POST['lead_id'];
        $sales_person = "'" . implode("','", $_POST['sales_person']) . "'";
        $assigned_sales_person = Yii::app()->db->createCommand("SELECT COUNT(*) AS count 
                            FROM tbl_leads_multiple 
                            WHERE sale_rep IN ($sales_person) 
                            AND lead_id = '$id'")->queryScalar();
        if ($assigned_sales_person > 0) {
            return ['exsists' => true, 'msg' => 'The sales person is already assigned to this lead'];
        }

        $sales_person = $_POST['sales_person'];
        $save_multiple_person = false;
        foreach ($sales_person as $key => $value) {
            $multiple_lead = new Multipleleads();
            $multiple_lead->lead_id = $id;
            $multiple_lead->sale_rep = $value;
            $multiple_lead->created_at = date('Y-m-d  H:i:s');
            $multiple_lead->updated_at = date('Y-m-d H:i:s');
            $multiple_lead->save();
            $lead_activity = ActivityLog::AddLeadActivity($id, 2);
            $save_multiple_person = $id;
        }

        if ($save_multiple_person) {
            return ['insert' => true, 'msg' => 'Sales person assigned successfully'];
        } else {
            return ['insert' => true, 'msg' => 'Somethig went wrong'];
        }
    }

    public static function GetFollowUpDetails($id = false)
    {
        $lead_id = $_GET['lead_id'] ?? 0;
        $condition = $id ? "id= '$id'" :  "lead_id='$lead_id'";

        $sql = "SELECT 
        id , 
        lead_id,
        status_update_date AS date , 
        action_type , 
        note,
        created_at
         FROM leads_status Where $condition AND action_type IS NOT NULL";
        $data =  $id ?   Yii::app()->db->createCommand($sql)->queryRow()  : Yii::app()->db->createCommand($sql)->queryAll();
        return  $data;
    }



    //-----------------------------------// Activity Log -------------------
    


            public static function GetActivityLog($user=false , $is_notification=false)
        {
            $current_page = $_GET['page'] ?? 1;
            $statusQuery = Status_Name_Query;
            $is_read = $notification = $condition =''; 
           
            if($is_notification==true){
                $username = $user ? $user['username'] : NUll ;
                $is_read =  "COALESCE(una.is_read, 0) AS is_read,
                                COALESCE(una.is_deleted, 0) AS is_deleted ,";
                $notification = "
                            LEFT JOIN crm_notification_actions una 
                            ON una.activity_id = la.id 
                            AND una.user_name = '$username'";
                $condition =  " AND COALESCE(una.is_deleted, 0) = 0";
            }
 
            $sql = "SELECT  
                la.id AS id , 
                la.lead_id AS lead_id , 
                user.fullname AS sales_person , 
                la.updated_at AS updated_at,
                COALESCE(tbl.name ,la.lead_name) AS lead_name,
                la.action_type,
                $is_read
               CASE 
                    WHEN la.lead_status = 1  THEN 'Follow up'
                    WHEN la.lead_status = 2  THEN 'Won'
                    WHEN la.lead_status = 3  THEN 'Pending'
                    WHEN la.lead_status = 4  THEN 'Lost'
                ELSE NULL
               END AS status ,
               CASE 
                    WHEN la.action_type = 1 THEN 'Edit'
                    WHEN la.action_type = 2 THEN 'Assigned'
                    WHEN la.action_type = 3 THEN 'Status Updated'
                    WHEN la.action_type = 4 THEN 'Comment'
                    WHEN la.action_type = 5 THEN 'Unassigned Sales Person'
                    WHEN la.action_type = 6 THEN 'Delete Lead'
                    WHEN la.action_type = 7 THEN 'Permanent Delete'

                ELSE '' 
                END AS action_name, 
                CASE 
                    WHEN la.action_type = 4 THEN lc.comment
                    ELSE '' 
                END AS comment
            FROM lead_activity AS la 
            $notification 
            LEFT JOIN tbl_leads AS tbl 
                ON tbl.lead_id = la.lead_id 
            LEFT JOIN tbl_leads_multiple AS tlm 
                ON tlm.lead_id = tbl.lead_id  
            LEFT JOIN leads_comment AS lc 
                ON lc.id = (
                    SELECT id 
                    FROM leads_comment 
                    WHERE lead_id = la.lead_id 
                    AND created_at = la.created_at
                    ORDER BY created_at DESC 
                    
                ) 
                LEFT JOIN user  AS user ON 
                user.username = la.sales_rep
                " 
            ;

            // echo $sql ; die ;
            $current_month = getMonthdDate(date('m') ,date('Y')); 
           

            $start_date = $_GET['start_date'] ?? $current_month['start_date'];
            $end_date =  $_GET['end_date'] ?? $current_month['end_date'];

          

            if ($start_date && $end_date) {
                $sql .= " WHERE DATE(la.updated_at) BETWEEN '$start_date' AND '$end_date' $condition";
            }


            if (Yii::app()->user->getState('userGroup') &&   (Yii::app()->user->getState('userGroup') != 1  || Yii::app()->user->getState('userGroup') != 99)) {
                $sales_person =  Yii::app()->user->getId();
                $sql .= "AND  tbl.assigned_to = '$sales_person' OR tlm.sale_rep = '$sales_person'";
            }

            $sql .= " GROUP BY la.id";

               
            // echo $sql ; 
            // die;

            // print_r($sql); 
            // die; 
            //   echo  $sql ;
            $data = Yii::app()->db->createCommand($sql)->queryAll();
            $totalCount = count($data);

            $pagination_arr = TblLeads::getPagination($current_page, $totalCount, $is_api = true);

            $sql .= " ORDER BY la.updated_at DESC  LIMIT  " . $pagination_arr['page_size'] . "   OFFSET " . $pagination_arr['offset'] . "";
        

            $data = Yii::app()->db->createCommand($sql)->queryAll();
            $finalData =[];
            $str = ''; 
            $heading = '';
            foreach($data as $key=>$val){
                if($val['action_type']==1){
                    $heading = "Lead Edited";
                    $str = "The lead ". $val['lead_name'] . " is edited  ";
                }elseif($val['action_type'] ==2){
                    $heading = "Lead is Assigned";
                    $str = "Lead ". $val['lead_name'] . " is assigned to ".$val['sales_person'];
                }elseif($val['action_type']==3){
                    $heading = "Status Updated";
                     $str = $val['lead_name'] . " Status  changed to ".$val['status'];
                }elseif($val['action_type']==4){
                    $heading = "Comment added";
                    $str = "Comment ".$val['comment'] . " is added to lead " . $val['lead_name'];
                }elseif($val['action_type']==5){
                    $heading = "Sales Person Unassigned";
                    $str =  $val['sales_person'] . " is  unassigned from " .$val['lead_name'];   
                }elseif($val['action_type'] ==6){
                    $heading = "Lead Deleted";
                    $str = $val['lead_name'] . " Deleted by " .$val['sales_person'];
                }elseif($val['action_type']==7){
                    $heading = "Lead Permanent Deleted";
                     $str  = $val['lead_name'] . " Deleted permanent";
                }

                $dt = [

                    'id' =>$val['id'], 
                    'comment' =>$str, 
                    'heading' => $heading ,
                    'type' =>$val['action_name'], 
                    'date' =>$val['updated_at'],     
                ];
                if($is_notification==true){
                     $dt['is_read'] = $val['is_read'] ?? 0;
                }

                $finalData[] = $dt;

            }
            
            return ['status' => 200, 'data' => $finalData, 'pagination' => $pagination_arr];
        }
    //-----------------------------------Manage Sales person -----------------------------------//
        public static function UpdateLeadDistribution($is_get = false)
        {
            if ($is_get == true):
                $data = Yii::app()->db->createCommand("SELECT status FROM lead_distribution Where id='1'")->queryRow();
                return $data;
                exit;
            endif;

            $status = $_POST['status'];
            $sql = "UPDATE lead_distribution SET status = $status Where id = 1";
            $data = Yii::app()->db->createCommand($sql)->execute();
            return ['status' => 200, 'udpate' => $data];
        }

    public static function GetSalesAssignSalesPerson()
    {
        $sql = "SELECT 
                        ls.lead_sales_id AS id , 
                        tc.id AS state_id,
                        cm.id AS country_id , 
                        cm.country_name AS country_name , 
                        ls.sales_name AS sales_name , 
                        user.fullname AS name ,
                        tc.state_name AS state_name , 
                        ls.state_priority AS s_p, 
                        ls.sales_priority AS sale_pr
                        FROM lead_sales AS ls 
                        LEFT JOIN tbl_country AS tc ON tc.id = ls.state_name
                        LEFT JOIN country_master AS cm ON cm.country_name = ls.country_name
                        LEFT JOIN user AS user ON user.username = ls.sales_name  
                        WHERE ls.state_name != '' AND ls.country_name !=''
                        ORDER BY cm.priority ASC,  ls.state_priority ASC , ls.sales_priority ASC ";

        $rows = Yii::app()->db->createCommand($sql)->queryAll();
        //  $output = [];
        // $output = ["data" => []];
        $countryMap = []; // map countries by name


        foreach ($rows as $row) {
            $countryName = $row['country_name'];
            $stateId     = $row['state_id'];
            $country_id =  $row['country_id'];

            // ✅ If country not yet added
            if (!isset($countryMap[$countryName])) {
                $countryMap[$countryName] = [
                    // "id" =>  count($countryMap) + 1, // or real country_id if you have one
                    "id" => (string)$country_id,
                    "name" => $countryName,
                    "states" => []
                ];
            }

            // ✅ Reference states inside this country
            $stateMap = &$countryMap[$countryName]['states'];

            // If state not yet added
            if (!isset($stateMap[$stateId])) {
                $stateMap[$stateId] = [
                    "id" => (string)$stateId,
                    "name" => $row['state_name'],
                    "priority" => $row['s_p'],

                    "salesPersons" => []
                ];
            }

            // ✅ Add salesperson
            $stateMap[$stateId]["salesPersons"][] = [
                "id" => $row['id'],
                "userName" => $row['sales_name'],
                "name" => $row['name'],
                'priority' => $row['sale_pr'],
            ];
        }

        // Convert state maps to arrays
        foreach ($countryMap as &$country) {
            $country['states'] = array_values($country['states']);
        }


        $output = ["country" => array_values($countryMap)];
        // foreach ($countryMap as &$country) {
        //     $output['country'] = array_values($countryMap);
        // }


        return $output;
    }


        public static function GetManageSalesPersonDetails()
        {
            $id = $_GET['id'];
            $sql  = "SELECT 
                ls.lead_sales_id AS id , 
                ls.sales_name As username , 
                user.fullname AS name, 
                ls.sales_priority AS sales_priority, 
                ls.lead_capacity AS lead_capacity,
                tc.state_name  AS state_name
                FROM lead_sales AS ls 
                LEFT JOIN user AS user ON user.username = ls.sales_name
                LEFT JOIN tbl_country AS tc ON tc.id = ls.state_name    
                Where lead_sales_id='$id'";
            $data = Yii::app()->db->createCommand($sql)->queryRow();
            return $data;
        }

        public static function AddEditSalesPerson()
        {
         
            $input = file_get_contents("php://input");
             $data = json_decode($input, true);
            $id = $data['id'] ?? 0;
            $state_ids = $data['state_ids'] ?? [];
            $country_name = $data['country_name'] ?? '';
            $sales_rep  = $data['sales_rep'] ??  [];
            $output = [];

            if(empty($country_name)){
                $output = ['status' => 403, 'data' => [] , 'msg' => 'The country name is missing!'];
                return $output ; 

            }


            if ($id):
                $state_ids = $state_ids[0]; 
               
                $priority  = $data['priority'] ?? 0;
                $capcity = $data['capacity'] ??  0;
                $sales_person = Yii::app()->db->createCommand("SELECT sales_name FROM lead_sales Where lead_sales_id='$id'")->queryScalar();


                $checkExists = "SELECT * FROM lead_sales Where  state_name = '$state_ids' AND country_name ='$country_name' AND sales_name='$sales_person' AND lead_sales_id!='$id'";
                $data = Yii::app()->db->createCommand($checkExists)->queryAll();
                if (!empty($data)) {
                    return ['status' => 503, 'msg' => 'Sales Person already assigned to this state'];
                }

                $update_sql  = "UPDATE lead_sales SET state_name = '$state_ids'  , sales_priority =  '$priority' , lead_capacity = '$capcity' Where lead_sales_id = '$id' ";

                $update = Yii::app()->db->createCommand($update_sql)->execute();
                $data = TblLeads::GetManageSalesPerson($id);
                $output = ['status' => 200, 'data' => $data, 'msg' => 'Sales person updated successfully'];
            else:
                if (!empty($state_ids)):
                    foreach ($state_ids as $state) {
                        foreach ($sales_rep as $key => $sales_name) {
                            $is_exits = Yii::app()->db->createCommand("SELECT * FROM lead_sales WHERE state_name ='$state'and sales_name ='$sales_name'")->queryScalar();
                            $sales = $is_exits ? Null  : new LeadSales;
                            if ($sales):
                                $sales->sales_name = $sales_name;
                                $sales->state_name = $state;
                                $sales->country_name = $country_name;
                                $sales->sales_priority = $key + 1;
                                $sales->lead_capacity = 1;
                                $sales->status = 1;
                                $sales->save();
                            endif;
                        }



                        $update_state = TblLeads::UpateSalesPerPriority($state);
                    }
                endif;
                $main_id =  $id ? $id : $sales->lead_sales_id;
                $data = TblLeads::GetManageSalesPerson($main_id);
                $output = ['status' => 200, 'data' => $data, 'msg' => 'Sales person added successfully'];
            endif;

            return  $output;
        }

        public static function GetManageSalesPerson($main_id = 0)
        {
            $id = $main_id ? $main_id : $_GET['id'];
            $sql = "SELECT 
                ls.lead_sales_id AS id , 
                ls.state_name As state_id , 
                ls.country_name  AS country_name, 
                ls.sales_priority As priority, 
                ls.lead_capacity AS capacity, 
                tc.state_name AS state_name 
                FROM  lead_sales AS ls  LEFT JOIN  tbl_country AS tc ON tc.id = ls.state_name Where lead_sales_id = '$id' ";
            $data = Yii::app()->db->createCommand($sql)->queryRow();
            return $data;
        }

        public static function DeleteAssignedSalesPerson()
        {
            $id = $_GET['id'] ?? 0;
            if ($id) {
                $delete  =  Yii::app()->db->createCommand("DELETE  FROM lead_sales Where lead_sales_id = '$id' ")->execute();
                return ['status' => 200, 'msg' => 'Sales Person deleted successfully'];
            } else {
                return ['status' => 503, 'msg' => 'Something went wrong'];
            }
        }

        public static function UpdateStatePriority()
        {
            $id = (int)$_POST['id'];            // state_name (id of state)
            $newPriority = (int)$_POST['new_index'];
            $country_name = $_POST['country_name'];



            $sql = "SELECT Distinct state_name, state_priority
                FROM jogjoino_salesrep_test.lead_sales
                WHERE country_name = '$country_name' AND state_name != ''
                GROUP BY state_name
                ORDER BY state_priority ASC";


            $allStates = Yii::app()->db->createCommand($sql)->queryAll();


            // 3. Build array of states
            $states = [];
            foreach ($allStates as $row) {
                $states[] = [
                    "id" => $row['state_name'],
                    "priority" => (int)$row['state_priority']
                ];
            }

            // 4. Remove target state
            $target = null;
            foreach ($states as $key => $s) {
                if ($s['id'] == $id) {
                    $target = $s;
                    unset($states[$key]);
                    break;
                }
            }

            if (!$target) {
                return ["status" => "error", "message" => "State not found"];
            }

            // 5. Insert target state into new position
            $newStates = [];
            $i = 1;
            foreach ($states as $s) {
                if ($i == $newPriority) {
                    $newStates[] = ["id" => $target['id'], "priority" => $newPriority];
                    $i++;
                }
                $newStates[] = ["id" => $s['id'], "priority" => $i];
                $i++;
            }

            // If new priority is last
            if ($newPriority > count($states)) {
                $newStates[] = ["id" => $target['id'], "priority" => $newPriority];
            }



            // 6. Update database with new priorities
            foreach ($newStates as $s) {
                Yii::app()->db->createCommand()->update(
                    "lead_sales",
                    ["state_priority" => $s['priority']],
                    "country_name = :country_name AND state_name = :state_name",
                    [
                        ":country_name" => $country_name,
                        ":state_name" => $s['id']
                    ]
                );
            }

            return ["status" => "success", "data" => [], 'msg' => 'Data update successfully'];
        }

    public static function UpdateSalesPersonPriority()
    {
        $fromCountry = $_POST['fromCountry'];
        $fromState   = $_POST['fromStateId'];
        $toCountry   = $_POST['toCountry'];
        $toState     = $_POST['toStateId'];
        $salesPerson = $_POST['salesPerson']; // ID of moved salesperson
        $newPosition = $_POST['toIndex'];     // Position where salesperson is dropped
        $salesId = $_POST['salesPersonId'];

        $db = Yii::app()->db;

        if (!empty($fromCountry) && !empty($fromState)) :
            $checkExists = "SELECT * FROM lead_sales Where  state_name = '$toState' AND country_name ='$toCountry' AND sales_name='$salesPerson'";
            $data = Yii::app()->db->createCommand($checkExists)->queryAll();
            if (!empty($data)) {
                return ['status' => 503, 'msg' => 'Sales Person already assigned to this state'];
            }
        endif;

        // Get all salespersons from source state
        if (!empty($fromCountry) && !empty($fromState)) {
            $fromSql = "SELECT * FROM lead_sales 
                    WHERE country_name = :country AND state_name = :state 
                    ORDER BY sales_priority ASC";
            $fromData = $db->createCommand($fromSql)
                ->queryAll(true, [":country" => $fromCountry, ":state" => $fromState]);


            // 1. Remove salesperson from source list
            $fromData = array_filter($fromData, function ($row) use ($salesPerson) {
                return $row['sales_name'] != $salesPerson;
            });
            $fromData = array_values($fromData);
        }


        // Get all salespersons from destination state
        // $toSql = "SELECT * FROM lead_sales 
        //     WHERE country_name = :country AND state_name = :state 
        //     ORDER BY sales_priority ASC";
        // $toData = $db->createCommand($toSql)
        //     ->queryAll(true, [":country" => $toCountry, ":state" => $toState]);


        // // 2. Insert salesperson into destination list at given position
        // $newSales = [
        //     "sales_name" => $salesPerson,
        //     "country_name" => $toCountry,
        //     "state_name" => $toState,
        //     'lead_sales_id' => $salesId,
        // ];
        // array_splice($toData, $newPosition - 1, 0, [$newSales]);


        // First update salesperson's country & state
        $sql = "UPDATE lead_sales 
                SET state_name = :state, country_name = :country 
                WHERE lead_sales_id = :id";
        $db->createCommand($sql)->execute([
            ":state"   => $toState,
            ":country" => $toCountry,
            ":id"      => $salesId
        ]);

        // Now re-fetch fresh destination list (including moved salesperson)
        $toSql = "SELECT * FROM lead_sales 
                    WHERE country_name = :country AND state_name = :state 
                    ORDER BY sales_priority ASC";
        $toData = $db->createCommand($toSql)
            ->queryAll(true, [":country" => $toCountry, ":state" => $toState]);

        // Reorder: move selected salesperson to given position

        usort($toData, function ($a, $b) {
            return $a['sales_priority'] <=> $b['sales_priority'];
        });


        $index = array_search($salesId, array_column($toData, 'lead_sales_id'));
        if ($index !== false) {
            $item = $toData[$index];
            array_splice($toData, $index, 1); // remove old position
            array_splice($toData, $newPosition - 1, 0, [$item]); // insert new position
        }



        // echo"from data "; 
        // print_r($fromData); 

        // echo "to data"; 
        // print_r($toData); 
        // die ; 

        // 3. Reassign priorities for source state
        if (!empty($fromData)) {
            foreach ($fromData as $i => $row) {
                $priority = $i + 1;
                $updateSql = "UPDATE lead_sales 
                        SET sales_priority = :priority 
                        WHERE sales_name = :sales AND country_name = :country  AND state_name = :state";
                $db->createCommand($updateSql)->execute([
                    ":priority" => $priority,
                    ":sales" => $row['sales_name'],
                    ":country" => $fromCountry,
                    ":state" => $fromState
                ]);
            }
        }

        // echo '<pre>';
        // print_r($toData); 
        // die;


        $sql = "UPDATE lead_sales SET state_name='$toState' , country_name='$toCountry'  Where lead_sales_id = '$salesId'";
        // echo $sql ; 
        $udpate = Yii::app()->db->createCommand($sql)->execute();

        // 4. Reassign priorities for destination state
        // foreach ($toData as $i => $row) {
        //     if($row['status']):
        //     $priority = $i+1;
        //     $lead_sales_id = $row['lead_sales_id'];
        //     $update_sql = "UPDATE lead_sales SET sales_priority='$priority'  Where lead_sales_id='$lead_sales_id'";
        //     $update = Yii::app()->db->createCommand($update_sql)->execute();
        //     endif;
        // }


        foreach ($toData as $i => $row) {
            $priority = $i + 1;
            $update_sql = "UPDATE lead_sales SET sales_priority = :priority  
                        WHERE lead_sales_id = :id";
            $db->createCommand($update_sql)->execute([
                ":priority" => $priority,
                ":id"       => $row['lead_sales_id']
            ]);
        }


        return ['status' => 200, 'msg' => "Priorities updated successfully!"];
    }





    //-----------------------------// --------------- Deleted leads --------------------

    public static function GetDeletedLeads()
    {
        $start_date =  isset($_GET['start_date']) ? $_GET['start_date']  : 0;
        $end_date  = isset($_GET['end_date']) ? $_GET['end_date'] : 0;
        $page= $_GET['page'] ?? 1; 
       

        $sql  = "SELECT 
         tbl.lead_id AS lead_id , 
         tbl.pro_name AS product , 
         tbl.TAC_name AS team_name , 
         CONCAT(IFNULL(tbl.name, ''), ' ', tbl.last_name, '') AS name, 
         tbl.email,
         tbl.phone_no AS number, 
         tbl.state_name AS state, 
         tbl.country_name AS country,
         tbl.qty AS qty,
         COALESCE(GROUP_CONCAT(tlm.sale_rep SEPARATOR ', '), tbl.assigned_to) AS assignTo,
         tbl.deleted_date AS date ,
         user.fullname AS deleted_by 
        FROM tbl_leads as tbl LEFT JOIN tbl_leads_multiple AS tlm ON  tbl.lead_id= tlm.lead_id LEFT JOIN user AS user ON user.username = tbl.deleted_by   Where tbl.status=5";

        // if ($start_date && $end_date) {
        //     $sql .= "  AND DATE(tbl.deleted_date) BETWEEN '$start_date' AND '$end_date'";
        // }

        $sql .=" GROUP BY tbl.lead_id";


        // echo $sql ; 
        $AllData = Yii::app()->db->createCommand($sql)->queryAll();
        $totalCount = count($AllData);
        $pagination_arr = TblLeads::getPagination($page, $totalCount, $is_api = true);
        $sql .= " ORDER BY tbl.deleted_date DESC  LIMIT  " . $pagination_arr['page_size'] . "   OFFSET " . $pagination_arr['offset'] . "";

        // print_r($sql);
        $AllData = Yii::app()->db->createCommand($sql)->queryAll();

        
        $data = [];
        foreach ($AllData as $key => $val) {

            if (!empty($val['assignTo'])) {
                $assignToArray = array_unique(array_map('trim', explode(',', $val['assignTo'] ?? '')));
                $val['assignTo'] = $assignToArray;
            } else {
                $val['assignTo'] = NULl;
            }

            $data[] = $val;
        }
        return ['status'=>200 , 'data'=> $data ,'pagination'=>$pagination_arr];
    }

    public static function DeletePermanent()
    {
        $id = $_GET['id'];
        // echo $id ; die;
        $lead_name = Yii::app()->db->createCommand("SELECT name FROM tbl_leads Where lead_id='$id'")->queryScalar();
        $delete_lead  =  Yii::app()->db->createCommand("DELETE  FROM tbl_leads Where lead_id = '$id' ")->execute();
        $sales_assigned = Yii::app()->db->createCommand("DELETE FROM tbl_leads_multiple Where lead_id = '$id'")->execute();
        $delete_comment =  Yii::app()->db->createCommand("DELETE FROM leads_comment Where lead_id = '$id'")->execute();
        $delete_status = Yii::app()->db->createCommand("DELETE FROM leads_status  Where lead_id = '$id'")->execute();
        
       $activity_log  = ActivityLog::AddLeadActivity($id , 7 ,$lead_name);
       $update_log = Yii::app()->db->createCommand("UPDATE lead_activity SET lead_name='$lead_name' Where lead_id='$id'")->execute(); 
 
        return ['msg' => 'Lead deleted successfully'];
    }

    public static function RecoverLeads()
    {
        $id = $_POST['id'];
        $sql = "UPDATE tbl_leads SET status =0 , created_at = '" . date('Y-m-d H:i:s') . "' where lead_id = '$id'";
        $data = Yii::app()->db->createCommand($sql)->execute();
        $msg  = $data ?  'Lead recovered successfully'  :  'Something went wrong';
        return  $msg;
    }
    
    //----------------------------------- Notification ---------------------

    public static function GetCRMNotification($user=false)
    {
        $data = TblLeads::GetActivityLog($user , true);
        return  $data;
    }


    public static function MarkNotificationRead($user = false, $is_delete = false)
    {
        // Get logged-in user
        $username = $user ? $user['username'] : Null;

        // Parse PUT data (Yii doesn’t fill $_PUT automatically, so you may need raw input)
        if ($is_delete) {
            $activityIds = isset($_GET['ids']) ? (array)$_GET['ids'] : TblLeads::GetLoggedInPersonNotification($user);
        } else {
            $input = file_get_contents("php://input");
            $_PUT = json_decode($input, true);
            $activityIds = isset($_PUT['ids']) ? (array)$_PUT['ids'] : TblLeads::GetLoggedInPersonNotification($user);
        }




        if (empty($activityIds)) {
            return ['status' => 400, 'msg' => 'No activity IDs provided'];
        }


        foreach ($activityIds as $activityId) {
            // Check if row exists
            $exists = Yii::app()->db->createCommand()
                ->select('id')
                ->from('crm_notification_actions')
                ->where('user_name = :user_name AND activity_id = :activity_id', [
                    ':user_name' => $username,
                    ':activity_id' => $activityId
                ])->queryScalar();

            if ($exists) {
                // Update (mark as read)
                Yii::app()->db->createCommand()->update(
                    'crm_notification_actions',

                    [
                        'is_read' => $is_delete ? 0 : 1,
                        'is_deleted' => $is_delete ? 1 : 0,
                        'updated_at' => new CDbExpression('NOW()')
                    ],
                    'id = :id',
                    [':id' => $exists]
                );
            } else {
                // Insert new row
                Yii::app()->db->createCommand()->insert('crm_notification_actions', [
                    'user_name' => $username,
                    'activity_id' => $activityId,
                    'is_read' => $is_delete ?  0 : 1,
                    'is_deleted' => $is_delete ? 1 : 0,
                    'updated_at' => new CDbExpression('NOW()')
                ]);
            }
        }

        return ['msg' => $is_delete ?  'Notification delete successfully'  : 'Notifications marked as read'];
    }

public static function GetLoggedInPersonNotification($user){
     if($user && $user['username']){
        $username = $user['username']; 
          if($user['user_group_id']==2):
           $sql  = "SELECT la.id AS ids FROM lead_activity AS la   LEFT JOIN tbl_leads AS tbl ON tbl.lead_id=la.lead_id LEFT JOIN tbl_leads_multiple AS tlm ON tlm.lead_id = la.lead_id   Where (tbl.assigned_to = '$username' OR tlm.sale_rep='$username')  GROUP BY la.id"; 
          else:
            $sql  = "SELECT la.id AS ids FROM lead_activity AS la   LEFT JOIN tbl_leads AS tbl ON tbl.lead_id=la.lead_id LEFT JOIN tbl_leads_multiple AS tlm ON tlm.lead_id = la.lead_id   GROUP BY la.id"; 
          endif ; 
        //    echo $sql ;
           $data = Yii::app()->db->createCommand($sql)->queryAll(); 
           $ids = array_column($data, 'ids');

           return $ids ;  
        

     }
}


// ----------------------- Product performance for power bi dashboard -----------------
    public static function GetProductPerformance(){
            
         $sql =  "SELECT *  FROM  tbl_cost_calc AS tc LEFT JOIN  tbl_item AS  ti ON ti.item_id = tc.item_id where ti.enable!=0  GROUP BY tc.calc_id "; 
        $costCal = Yii::app()->db->createCommand($sql)->queryAll();
        $costArr = []; 
        foreach($costCal as $key=>$val){
           

            $cost_details = explode('-' ,$val['calculations']); 
            //  echo '<pre>'; 
            // print_r($cost_details); 
            $costArr[]= [
                'calc_id' => $val['calc_id'] , 
                'item_id' => $val['item_id'] , 
                'item_name' => $val['item_name'] , 
                'draft_name' => $val['draft_name'], 
                'calculations' => $cost_details[39] ?? 0, 
            ]; 
        }

        return $costArr ; 
        
    }


      // ==================

    
    public static function GetLogggedinUserId($username){
            $sql = "SELECT id FROM user WHERE username = :username";

            $id = Yii::app()->db
                ->createCommand($sql)
                ->bindValue(':username', $username)
                ->queryScalar();

            return $id !== false ? (int)$id : 0;
    }  

}
