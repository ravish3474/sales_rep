<?php

class LeadsController extends AuthController
{
    // Action to display the Sales Dashboard
    public function actionDashboard()
    {
        $sales_person = Yii::app()->user->getId(); 

        $month = date('m'); 
        $currentDate = new DateTime();
        $currentDate->modify('first day of last month');
        $lastMonth = $currentDate->format('m'); 
        $date = getMonthdDate($month); 
        $lastDate = getMonthdDate($lastMonth);
       
        $lead_query =  "SELECT COUNT(DISTINCT tbl.lead_id) 
        FROM tbl_leads tbl 
        LEFT JOIN tbl_leads_multiple tbl_multiple
        ON tbl.lead_id = tbl_multiple.lead_id 
        WHERE (tbl.assigned_to = :sales_person OR tbl_multiple.sale_rep = :sales_person) 
            AND tbl.status !=5 AND DATE(tbl.created_at) BETWEEN :start_date AND :end_date" ;

        $lead_query_status =  "SELECT COUNT(DISTINCT tbl.lead_id) 
        FROM tbl_leads tbl 
       LEFT JOIN tbl_leads_multiple tbl_multiple
        ON tbl.lead_id = tbl_multiple.lead_id 
        WHERE (tbl.assigned_to = :sales_person OR tbl_multiple.sale_rep = :sales_person) 
            AND tbl.status=:status AND DATE(tbl.created_at) BETWEEN :start_date AND :end_date" ; 

       
        $total_lead = Yii::app()->db->createCommand($lead_query)->bindValues([
        ':sales_person' => $sales_person,
        ':start_date' => $date['start_date'],
        ':end_date' => $date['end_date']
        ])->queryScalar();
       

        $last_month_total_leads =  Yii::app()->db->createCommand($lead_query)->bindValues([
              ':sales_person' =>$sales_person , 
              ':start_date' =>$lastDate['start_date'], 
              ':end_date' => $lastDate['end_date']
        ])->queryScalar(); 


        
        $new_leads = Yii::app()->db->createCommand($lead_query_status)->bindValues([
               ':sales_person' =>$sales_person , 
              ':start_date' =>$date['start_date'], 
              ':end_date' => $date['end_date'], 
              ':status' => '0'
        ])->queryScalar(); 


        $last_month_new_leads = Yii::app()->db->createCommand($lead_query_status)->bindValues([
                                            ':sales_person' =>$sales_person , 
                                            ':start_date' =>$lastDate['start_date'], 
                                            ':end_date' => $lastDate['end_date'], 
                                            ':status' => '0'
             ])->queryScalar();

       
        $converted_leads =  Yii::app()->db->createCommand($lead_query_status)->bindValues([
                            ':sales_person' =>$sales_person , 
                            ':start_date' =>$date['start_date'], 
                            ':end_date' => $date['end_date'], 
                            ':status' => '2'
              ])->queryScalar(); 

        $last_month_converted_leads =  Yii::app()->db->createCommand($lead_query_status)->bindValues([
                                            ':sales_person' =>$sales_person , 
                                            ':start_date' =>$lastDate['start_date'], 
                                            ':end_date' => $lastDate['end_date'], 
                                            ':status' => '2'
                            ])->queryScalar();  
        

        $lost_leads =Yii::app()->db->createCommand($lead_query_status)->bindValues([
                                    ':sales_person' =>$sales_person , 
                                    ':start_date' =>$date['start_date'], 
                                    ':end_date' => $date['end_date'], 
                                    ':status' => '4'
              ])->queryScalar(); 

        $last_month_lost_leads =   Yii::app()->db->createCommand($lead_query_status)->bindValues([
                                    ':sales_person' =>$sales_person , 
                                    ':start_date' =>$lastDate['start_date'], 
                                    ':end_date' => $lastDate['end_date'], 
                                    ':status' => '4'
               ])->queryScalar(); 

        $country = Yii::app()->db->createCommand("SELECT DISTINCT country_name FROM tbl_country ORDER BY 'country_name' ASC")->queryAll(); 

         

      
            
      



        // count in percent 
        $all_lead_percent = $last_month_total_leads >0 ? ($total_lead - $last_month_total_leads *100 / $last_month_total_leads) : $total_lead -$last_month_total_leads ; 
        $new_leads_percent = $last_month_new_leads >0 ? ($new_leads - $last_month_new_leads *100 / $last_month_new_leads) : $new_leads -$last_month_new_leads ;
        $lost_leads_percent = $last_month_lost_leads >0 ? ($lost_leads - $last_month_lost_leads *100 / $last_month_lost_leads) : $lost_leads -$last_month_lost_leads ;
        $converted_leads_percent = $last_month_converted_leads >0 ? ($converted_leads - $last_month_converted_leads *100 / $last_month_converted_leads) : $converted_leads -$last_month_converted_leads ;

     
         

        $Count_arr =['total_leads'=> $total_lead ,
                     'new_leads' => $new_leads,  
                     'converted_leads'=>$converted_leads,
                     'lost_leads'=>$lost_leads    ,
                     'total_leads_percent'=>$all_lead_percent ,
                     'new_leads_percent'=>$new_leads_percent , 
                     'lost_leads_percent'=>$lost_leads_percent, 
                     'coverted_leads_percent'=>$converted_leads_percent , 
                    ];

           
        $notification = TblLeads::getNotification();


        $this->render('dashboard', array('count_arr' => $Count_arr  ,'lead_status'=>LEAD_STATUS ,'country'=>$country ,'notification'=>$notification));
    }

    // Action to manage Sales Leads
    public function actionLeads()
    {
            $sq = "SELECT * FROM `tbl_leads`";
            $adminLeads = Yii::app()->db->createCommand($sq)->queryAll();
            $country = "SELECT DISTINCT country_name  FROM `tbl_country`  WHere country_name Not like '%USA-open%' ";
            $countryName = Yii::app()->db->createCommand($country)->queryAll();
            $product = Yii::app()->db->createCommand("SELECT * FROM tbl_product ORDER BY sort ASC;")->queryAll();
            $sales_person = User::GetAlluser();
            $this->render('lead', array('adminLeads' => $adminLeads , 'countryName' => $countryName ,'salesPerson'=>$sales_person ,'product'=>$product));
    }

    public function actionAdminDashboard()
    {

        //     $update_sql = "
        //     UPDATE tbl_leads tl
        //     JOIN user u ON tl.assigned_to = u.username
        //     SET tl.assigned_to = ''
        //     WHERE u.user_group_id NOT IN (1, 99)
        // ";
        // Yii::app()->db->createCommand("UPDATE lead_sales SET assigned_lead = 0")->execute();
        
        // $update_sql = Yii::app()->db->createCommand($update_sql)->execute();

        $month = date('m'); 
        $currentDate = new DateTime();
        $currentDate->modify('first day of last month');
        $lastMonth = $currentDate->format('m'); // 'Y-m' gives you the year and month in the format YYYY-MM
        $date = getMonthdDate($month); 
        $lastDate = getMonthdDate($lastMonth);

        // echo '<pre>'; 
        // print_r($date); 
        // print_r($lastDate); 
        // die ; 
       
        $total_lead = Yii::app()->db->createCommand("SELECT  COUNT(*) FROM tbl_leads WHERE DATE(created_at) BETWEEN  '".$date['start_date']."' AND '".$date['end_date']."' ")->queryScalar();     
        $last_month_total_leads =  Yii::app()->db->createCommand("SELECT  COUNT(*) FROM tbl_leads WHERE DATE(created_at) BETWEEN  '".$lastDate['start_date']."' AND '".$lastDate['end_date']."' ")->queryScalar(); 
        
        $new_leads = Yii::app()->db->createCommand("SELECT COUNT(*) FROM tbl_leads WHERE status='0' AND DATE(created_at) BETWEEN  '".$date['start_date']."' AND '".$date['end_date']."'")->queryScalar(); 
        $last_month_new_leads = Yii::app()->db->createCommand("SELECT COUNT(*) FROM tbl_leads WHERE status='0' AND DATE(created_at) BETWEEN  '".$lastDate['start_date']."' AND '".$lastDate['end_date']."'")->queryScalar();

        //closed leads 
        $converted_leads = Yii::app()->db->createCommand("SELECT COUNT(*) FROM tbl_leads WHERE status='2' AND DATE(created_at) BETWEEN  '".$date['start_date']."' AND '".$date['end_date']."'")->queryScalar();  
        $last_month_converted_leads =  Yii::app()->db->createCommand("SELECT COUNT(*) FROM tbl_leads WHERE status='2' AND DATE(created_at) BETWEEN  '".$lastDate['start_date']."' AND '".$lastDate['end_date']."'")->queryScalar();  
        

        $lost_leads = Yii::app()->db->createCommand("SELECT COUNT(*) FROM tbl_leads WHERE status='4' AND DATE(created_at) BETWEEN  '".$date['start_date']."' AND '".$date['end_date']."'")->queryScalar();
        $last_month_lost_leads =  Yii::app()->db->createCommand("SELECT COUNT(*) FROM tbl_leads WHERE status='4' AND DATE(created_at) BETWEEN  '".$lastDate['start_date']."' AND '".$lastDate['end_date']."'")->queryScalar();

        // count in percent 
        // echo $last_month_total_leads . '  ' .$total_lead ; 
        // die; 
    
        $all_lead_percent = $last_month_total_leads >0 ? (($total_lead - $last_month_total_leads) *100 / $last_month_total_leads) : $total_lead -$last_month_total_leads ; 
        $new_leads_percent = $last_month_new_leads >0 ? (($new_leads - $last_month_new_leads) *100 / $last_month_new_leads) : $new_leads -$last_month_new_leads ;
        $lost_leads_percent = $last_month_lost_leads >0 ? (($lost_leads - $last_month_lost_leads) *100 / $last_month_lost_leads) : $lost_leads -$last_month_lost_leads ;
        $converted_leads_percent = $last_month_converted_leads >0 ? (($converted_leads - $last_month_converted_leads) *100 / $last_month_converted_leads) : $converted_leads -$last_month_converted_leads ;

     
         

        $Count_arr =['total_leads'=> $total_lead ,
                     'new_leads' => $new_leads,  
                     'converted_leads'=>$converted_leads,
                     'lost_leads'=>$lost_leads    ,
                     'total_leads_percent'=>(int)$all_lead_percent ,
                     'new_leads_percent'=>(int)$new_leads_percent , 
                     'lost_leads_percent'=>(int)$lost_leads_percent, 
                     'coverted_leads_percent'=>(int)$converted_leads_percent , 
                    ];
        
           $country = Yii::app()->db->createCommand("SELECT DISTINCT country_name FROM tbl_country ORDER BY 'country_name' ASC")->queryAll(); 

           $notification = TblLeads::getNotification();

         $this->render('adminDashboard', array('count_arr' => $Count_arr ,'month_filter'=>MONTH_FILTER ,'lead_status'=>LEAD_STATUS ,'country'=>$country ,'notification'=>$notification));
    }


    public function actionAdminLeads()
    {
     
        $country = "SELECT DISTINCT country_name  FROM `tbl_country`  Where country_name Not like '%USA-open%'";
        $countryName = Yii::app()->db->createCommand($country)->queryAll();
        $sales_person = User::GetAlluser();   
        $product = Yii::app()->db->createCommand("SELECT * FROM tbl_product ORDER BY sort ASC;")->queryAll();
        $data_count = TblLeads::GetCountValuesAdmin(); 
        $this->render('adminLeads', array('countryName' => $countryName ,'salesPerson'=>$sales_person ,'product'=>$product , 'data_count'=>$data_count ));
    }

    public function actionManageSales()
    {
        $country = TblLeads::GetCountryNameByOrder();  
        $this->render('adminManageSales', array('country'=>$country));
    }

    public function actionAdminTeamLeads()
    {
        $country = "SELECT DISTINCT country_name  FROM `tbl_country`  WHere country_name Not like '%USA-open%'";
        $countryName = Yii::app()->db->createCommand($country)->queryAll();
        $product = Yii::app()->db->createCommand("SELECT * FROM tbl_product ORDER BY sort ASC;")->queryAll();
        $sales_person = User::GetAlluser();

        $this->render('adminTeamLeads', array('countryName' => $countryName ,'salesPerson'=>$sales_person ,'product'=>$product));
    }


    public function actionCreateLead()
    { 
        if (isset($_POST['TblLeads'])) {
            $model = new TblLeads;
            $_POST['TblLeads']['created_at'] = date('Y-m-d H:i:s'); 
            $isAdminTeamLead = isset($_POST['is_admin_team_lead']) ? $_POST['is_admin_team_lead'] : 0; 
            $sendMail = true;

         // if($isAdminTeamLead):
            //          $leadId = $model->createLead($_POST['TblLeads']);
            // else:
            //         if(empty($_POST['TblLeads']['assigned_to'])){
            //             $_POST['TblLeads']['assigned_to'] = Yii::app()->user->getId(); 
            //          }
            //         //  print_r($_POST['TblLeads']); die;
            //          $leadId = $model->createLead($_POST['TblLeads']);
            // endif ;
           
           
              
                 
                        if(empty($_POST['TblLeads']['assigned_to'])){
                              $sendMail =false;
                              $_POST['TblLeads']['assigned_to'] = Yii::app()->user->getId(); 
                            }
                        
                            $leadId = $model->createLead($_POST['TblLeads']);
                 
                         


            if ($leadId) {   
                $multiple_rep = $_POST['multipleAssignedTo'];
                if(!empty($multiple_rep)){
                    foreach($multiple_rep as $rep){
                        $multiple_lead = new Multipleleads(); 
                        $multiple_lead->lead_id = $leadId;
                        $multiple_lead->sale_rep = $rep;
                        $multiple_lead->save();
                    } 
                }
                
                //===========send mail for assigned sales person==================
                 $details = Multipleleads::GetLeadDetailsById($leadId); 
                 if($sendMail){
                      TblLeads::SendAutomaticAssignedMail($details); 
                 }
                //============================================

                  
                if(Yii::app()->user->getState('userGroup')==2){
                      $this->redirect(array('salesLeads')) ;
                }

              $isAdminTeamLead ?   $this->redirect(array('adminTeamLeads'))   :  $this->redirect(array('adminLeads'));
            } else {
                $this->redirect(array('adminLeads'));
            }
        }
    }


    public function actionCreateSales()
    {
        
        // echo '<pre>'; 
        // print_r($_POST); 
        // die ; 
        $state_name = $_POST['state_name'];
        $country_name = $_POST['country_name'];    
        $state_name_hidden = $_POST['state_name_hidden']; 
        $sales_Person =  $_POST['sales_name'];

       
        $is_exits = false ;
            foreach ($state_name as $state) {
                foreach ($sales_Person as $key => $sales_name) {
                    $is_exits = Yii::app()->db->createCommand("SELECT * FROM lead_sales WHERE state_name ='$state'and sales_name ='$sales_name' AND status!=0")->queryScalar(); 
                    $sales = $is_exits ? Null  :new LeadSales();
                    if($sales):
                        $sales->sales_name = $sales_name;            
                        $sales->state_name = $state;
                        $sales->country_name = $country_name;
                        $sales->sales_priority = $key + 1;
                        $sales->lead_capacity = 1;
                        $sales->status = 1;
                        $sales->save();     
                    endif ; 
                }
            }

        $update_state = TblLeads::UpateSalesPerPriority($state);
        $this->redirect(array('manageSales'));        
    }


    // public function actionUpdatePriorty(){
    //     $newOrder = $_POST['new_order'];
    //     $id = '';
    //     $html = '';
    //         if(empty($newOrder)){
    //             $value = $_POST['value'];
    //             $filedName = $_POST['filedName']; 
    //             $lead_id = $_POST['lead_id'];
    //             $id = $lead_id ;

    //             if($filedName=='state_name'){
    //                    $already_exsits = TblLeads::AlreadyExists($id ,$value) ; 
                       
    //                     if(!empty($already_exsits)){
    //                         echo json_encode(['data'=>true ,'exsists'=>true]); 
    //                         exit ;
    //                     }
    //             }

    //             $sq = "UPDATE lead_sales SET $filedName = '$value'  WHERE lead_sales_id = $lead_id;";
    //             // echo $sq ; die;
            
    //             // Yii::app()->db->createCommand($sq)->execute()
    //             // Yii::app()->db->createCommand($sq)->bindParam('sales_priority', $value, PDO::PARAM_INT)->execute();
    //             Yii::app()->db->createCommand($sq)->bindParam($filedName , $value , PDO::PARAM_INT)->execute();
            
                
    //         }
    //             else{
    //             foreach ($newOrder as $item) {
    //                 $salesId = $item['sales_id'];
    //                 $id = $salesId ;

                    

    //                 $newPriority = $item['new_priority'];
    //                 $newStateName = $item['new_state_name']; // Get the new state name

    //                 // Update the state_name and priority in the database
    //                 $sql = "UPDATE lead_sales 
    //                         SET sales_priority = :priority, state_name = :state 
    //                         WHERE lead_sales_id = :sales_id";
                    
    //                 Yii::app()->db->createCommand($sql)
    //                     ->bindParam(':priority', $newPriority, PDO::PARAM_INT)
    //                     ->bindParam(':state', $newStateName, PDO::PARAM_STR)
    //                     ->bindParam(':sales_id', $salesId, PDO::PARAM_INT)
    //                     ->execute();
    //             }
    //         }

    //       $data = Yii::app()->db->createCommand("SELECT tc.state_name As st_nm , user.fullname As fullname, tc.same_country  As same_country , ls.* FROM lead_sales As ls LEFT JOIN  tbl_country AS tc ON  ls.state_name= tc.id LEFT JOIN user  AS user ON user.username=ls.sales_name  Where ls.lead_sales_id='$id'")->queryRow();  
    //       if($filedName=='state_name'){
    //            $html  = $this->renderPartial('SalesRep_Table', ['data'=>$data] , true);
    //       }
    //        echo json_encode(['status' => 'success' ,'data'=>$data ,'html'=>$html]);
            
    // }

     public function actionUpdatePriorty(){
        $newOrder = $_POST['new_order'];
        $id = '';
        $html = '';
            if(empty($newOrder)){
                $value = $_POST['value'];
                $filedName = $_POST['filedName']; 
                $lead_id = $_POST['lead_id'];
                $id = $lead_id ;
                $old_state = $_POST['old_state'] ?  $_POST['old_state'] : 0; 
                $main_state_arr =$_POST['main_state_arr']; 
                $updated_state =$_POST['updated_state']; 

                if($filedName=='state_name'){

                       $already_exsits = TblLeads::AlreadyExists($id ,$value) ; 
                        
                       
                        if(!empty($already_exsits)){
                            echo json_encode(['data'=>true ,'exsists'=>true]); 
                            exit ;
                        }
                       

                        $update_state = TblLeads::UpateSalesPerPriority(false , $main_state_arr);
                        $update_state1 = TblLeads::UpateSalesPerPriority(false , $updated_state);

                }

                $sq = "UPDATE lead_sales SET $filedName = '$value'  WHERE lead_sales_id = $lead_id";
                // echo $sq ; die;
            
                // Yii::app()->db->createCommand($sq)->execute()
                // Yii::app()->db->createCommand($sq)->bindParam('sales_priority', $value, PDO::PARAM_INT)->execute();
                Yii::app()->db->createCommand($sq)->bindParam($filedName , $value , PDO::PARAM_INT)->execute();
            
                
            }
                else{
                foreach ($newOrder as $item) {
                    $salesId = $item['sales_id'];
                    $id = $salesId ;

                    

                    $newPriority = $item['new_priority'];
                    $newStateName = $item['new_state_name']; // Get the new state name

                    // Update the state_name and priority in the database
                    $sql = "UPDATE lead_sales 
                            SET sales_priority = :priority, state_name = :state 
                            WHERE lead_sales_id = :sales_id";
                    
                    Yii::app()->db->createCommand($sql)
                        ->bindParam(':priority', $newPriority, PDO::PARAM_INT)
                        ->bindParam(':state', $newStateName, PDO::PARAM_STR)
                        ->bindParam(':sales_id', $salesId, PDO::PARAM_INT)
                        ->execute();
                }
            }

          $data = Yii::app()->db->createCommand("SELECT tc.state_name As st_nm , user.fullname As fullname, tc.same_country  As same_country , ls.* FROM lead_sales As ls LEFT JOIN  tbl_country AS tc ON  ls.state_name= tc.id LEFT JOIN user  AS user ON user.username=ls.sales_name  Where ls.lead_sales_id='$id'")->queryRow();  
          if($filedName=='state_name'){
            //    $html  = $this->renderPartial('SalesRep_Table', ['data'=>$data] , true);
                $html  = $this->renderPartial('SalesRep_Table', ['data'=>$data ,'dragged_state'=>$old_state] ,true);
                $html2  = $this->renderPartial('SalesRep_Table', ['data'=>$data ,'dragged_state'=>$value] ,true);
          }
           echo json_encode(['status' => 'success' ,'data'=>$data ,'html'=>$html ,'html2'=>$html2]);
            
    }


    public function actiongetCountyValue(){

        $country_name = $_POST['countryName'];
        $state =  !empty($_POST['state']) ? $_POST['state'] : 0;
        $return_html = '<label for="State" class="blackLabel"> State</label>';
        $return_html .= '<select class=" form-select assignedTo text-left state_dropdown" name="state_name">';
        $sql_cust = "SELECT * FROM tbl_country WHERE country_name LIKE '$country_name'  ORDER BY state_name ASC; ";
		$a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();
		$return_html .= '<option value="">Select State</option>';
		foreach ($a_cust as $tmp_key => $row_cust) {	
            if($state == $row_cust["state_name"]){
                 $return_html .= '<option selected value="' . $row_cust["state_name"] . '">' . $row_cust["state_name"] . '</option>';
            }else{		
		     	$return_html .= '<option value="' . $row_cust["state_name"] . '">' . $row_cust["state_name"] . '</option>';		
            }	
		}
		$return_html .= '</select>';    	        

        echo $return_html;
    }

    
    public function actionGetCountryValueForSalesRep(){
        
        $country_name = $_POST['countryName'];
        $is_same = $_POST['is_same']; 

        $state =  !empty($_POST['state']) ? $_POST['state'] : 0;
        $return_html = '<label for="State" class="blackLabel"> State</label>';
        // $return_html .= '<select class=" form-select assignedTo text-left state_dropdown" name="state_name" required>';
 
        
        if($state){
            $return_html .= '<select class=" form-select assignedTo text-left state_dropdown " data-old_state="'.$state.'" name="state_name" required>';
        }else{
            $return_html .= '<select class=" form-select assignedTo text-left state_dropdown  js-select2"  id="multiple_state_val" multiple="multiple" name="state_name[]" required>';
        }   


        if($is_same==1){
            $sql_cust = "SELECT * FROM tbl_country WHERE country_name LIKE 'USA'  ORDER BY state_name ASC; ";

        }else{
            $sql_cust = "SELECT * FROM tbl_country WHERE country_name LIKE '%$country_name%'  ORDER BY state_name ASC; ";
        }

		$a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();  
		$return_html .= '<option value="">Select State</option>';
		foreach ($a_cust as $tmp_key => $row_cust) {	
            if($state == $row_cust["id"]){
                 $return_html .= '<option selected  data-state="'.$row_cust['state_name'].'" value="' . $row_cust["id"] . '">' . $row_cust["state_name"] . '</option>';
            }else{		
		     	$return_html .= '<option  data-state="'.$row_cust['state_name'].'"  value="' . $row_cust["id"] . '">' . $row_cust["state_name"] . '</option>';		
            }	
		}
		$return_html .= '</select>';    	        

        echo $return_html;  
    }



    public function actionaddStateValue(){
        $stateName = $_POST['stateName'];
        $countryName = $_POST['countryName'];
        $sql_insert = "INSERT INTO `tbl_country`(`country_name`, `state_name`) VALUES ('$countryName','$stateName')";
        if (Yii::app()->db->createCommand($sql_insert)->execute()) {						
			
            $return_html = '<label for="State" class="blackLabel">State</label>';
            $return_html .= '<select class=" form-select assignedTo text-left" name="state_name">';
            $sql_cust = "SELECT * FROM tbl_country WHERE country_name LIKE '$countryName'  ORDER BY state_name ASC; ";
            $a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();
            $return_html .= '<option selected="">Select State</option>';
            foreach ($a_cust as $tmp_key => $row_cust) {			
                $return_html .= '<option value="' . $row_cust["state_name"] . '">' . $row_cust["state_name"] . '</option>';			
            }
            $return_html .= '</select>';    	        

            echo $return_html;


		} else {
			$a_result["result"] = "fail";
			$a_result["msg"] = "Fail to save new note.";
		}
        
    }
   
  
    // public function actionupdateSales(){
    //     // echo '<pre>'; 
    //     // print_r($_POST); die;  
    //       $state_name = $_POST['state'];
    //       $country_name = $_POST['country'];
    //       $lead_capacity = $_POST['capacity'];
    //       $priority= $_POST['salesPriority'];
    //       $id = $_POST['sales_id'];
    //       $old_state = $_POST['old_state'] ? $_POST['old_state'] :  0;

    //       $already_exsits = TblLeads::AlreadyExists($id ,$state_name , $country_name) ; 
        
    //         if(!empty($already_exsits)){
    //             echo json_encode(['data'=>true ,'exsists'=>true]); 
    //             exit ;
    //         }


    //       $sql ="UPDATE lead_sales 
    //          SET sales_priority= :sales_priority, lead_capacity= :lead_capacity, state_name= :state_name, country_name= :country_name
    //          WHERE lead_sales_id= :lead_sales_id";
    //       Yii::app()->db->createCommand($sql)
    //           ->bindParam(':sales_priority', $priority, PDO::PARAM_INT)
    //           ->bindParam(':lead_capacity', $lead_capacity, PDO::PARAM_INT)
    //           ->bindParam(':state_name', $state_name, PDO::PARAM_STR)
    //           ->bindParam(':country_name', $country_name, PDO::PARAM_STR)
    //            ->bindParam(':lead_sales_id', $id, PDO::PARAM_INT)
    //            ->execute();

    //         //    $this->redirect(array('manageSales'));  
    //         if($old_state != $state_name){
    //               TblLeads::UpateSalesPerPriority($state_name);
    //               TblLeads::UpateSalesPerPriority($old_state);
    //         }  
        
    //         $data = Yii::app()->db->createCommand("SELECT tc.state_name As st_nm , user.fullname As fullname, tc.same_country  As same_country , ls.* FROM lead_sales As ls LEFT JOIN  tbl_country AS tc ON  ls.state_name= tc.id LEFT JOIN user  AS user ON user.username=ls.sales_name  Where ls.lead_sales_id='$id'")->queryRow(); 
    //         $html  = $this->renderPartial('SalesRep_Table', ['data'=>$data] , true);
    //          $html2 = NULL; 
    //         if($old_state !=$state_name){
    //                 $html  = $this->renderPartial('SalesRep_Table', ['data'=>$data ,'dragged_state'=>$state_name] ,true);
    //                 $html2  = $this->renderPartial('SalesRep_Table', ['data'=>$data ,'dragged_state'=>$old_state] ,true);
    //         }
        

        
    //         echo json_encode(['status' => 'success' ,'rep_id'=>$id , 'data'=>$data ,'html'=>$html ,'html2'=>$html2]);
    //         exit;
    // }

    public function actionupdateSales(){
        // echo '<pre>'; 
        // print_r($_POST); die;  
          $state_name = $_POST['state'];
          $country_name = $_POST['country'];
          $lead_capacity = $_POST['capacity'];
          $priority= $_POST['salesPriority'];
          $id = $_POST['sales_id'];
          $old_state = $_POST['old_state'] ? $_POST['old_state'] :  0;
         
          $already_exsits = TblLeads::AlreadyExists($id ,$state_name , $country_name) ; 
        
            if(!empty($already_exsits)){
                echo json_encode(['data'=>true ,'exsists'=>true]); 
                exit ;
            }
            
           

          $sql ="UPDATE lead_sales 
             SET sales_priority= :sales_priority, lead_capacity= :lead_capacity, state_name= :state_name, country_name= :country_name
             WHERE lead_sales_id= :lead_sales_id";
          Yii::app()->db->createCommand($sql)
              ->bindParam(':sales_priority', $priority, PDO::PARAM_INT)
              ->bindParam(':lead_capacity', $lead_capacity, PDO::PARAM_INT)
              ->bindParam(':state_name', $state_name, PDO::PARAM_STR)
              ->bindParam(':country_name', $country_name, PDO::PARAM_STR)
               ->bindParam(':lead_sales_id', $id, PDO::PARAM_INT)
               ->execute();

            //    $this->redirect(array('manageSales'));    

             if($old_state != $state_name){
                  TblLeads::UpateSalesPerPriority($state_name);
                  TblLeads::UpateSalesPerPriority($old_state);
            }
        
            $data = Yii::app()->db->createCommand("SELECT tc.state_name As st_nm , user.fullname As fullname, tc.same_country  As same_country , ls.* FROM lead_sales As ls LEFT JOIN  tbl_country AS tc ON  ls.state_name= tc.id LEFT JOIN user  AS user ON user.username=ls.sales_name  Where ls.lead_sales_id='$id'")->queryRow(); 
            $html  = $this->renderPartial('SalesRep_Table', ['data'=>$data] , true);
            $html2 = NULL; 
            if($old_state !=$state_name){
                    $html  = $this->renderPartial('SalesRep_Table', ['data'=>$data ,'dragged_state'=>$state_name] ,true);
                    $html2  = $this->renderPartial('SalesRep_Table', ['data'=>$data ,'dragged_state'=>$old_state] ,true);
            }
    
            echo json_encode(['status' => 'success' ,'rep_id'=>$id , 'data'=>$data ,'html'=>$html ,'html2'=>$html2]);
            exit;

      
    }

    public function actionDeleteSales(){
        $id = $_POST['id'];
        $sql = "DELETE FROM lead_sales WHERE lead_sales_id = :lead_sales_id";
        Yii::app()->db->createCommand($sql)
            ->bindParam(':lead_sales_id', $id, PDO::PARAM_INT)
            ->execute();
        echo json_encode(['status' => 'success']);
    }
   
    public function actionviewSalesDetails(){
        $id = isset($_GET['id']) ? $_GET['id'] :0 ; 
        $sql = "SELECT * FROM tbl_leads WHERE lead_id = $id";
        $lead_view_details = Yii::app()->db->createCommand("SELECT 
                ls.id AS id , 
                ls.status_update_date AS status_update_date , 
                ls.action_type AS action_type , 
                ls.note AS note , 
                ls.created_at AS created_at 
               FROM leads_status ls  Where ls.status=1 AND ls.lead_id='$id'")->queryAll(); 
 
        $latest_follow_up = Yii::app()->db->createCommand("SELECT 
                                                        ls.id AS id , 
                                                        ls.status_update_date AS status_update_date , 
                                                        ls.action_type AS action_type ,  
                                                        ls.note AS note , 
                                                        ls.created_at AS created_at 
                                                        FROM leads_status ls   Where ls.status=1 AND ls.lead_id='$id' AND action_type IS NOT NULl ORDER BY id DESC LIMIT 1")->queryAll(); 
        
        
        $sales = Yii::app()->db->createCommand($sql)->queryRow();
        $is_show_btn = true ;
        $NewUser = strtolower(Yii::app()->user->id); 
        if(Yii::app()->user->getState('userGroup') == 2   && $NewUser != "dcote"){
        
              $sales_person_name  = Yii::app()->user->getId(); 
              $assigned_sales_rep = TblLeads::GetMultipleSalesRepArr($id); 
              if(in_array($sales_person_name ,$assigned_sales_rep) || $sales_person_name==$sales['assigned_to']){
                   $is_show_btn = true ;
              }else{
                  $is_show_btn =false ; 
              }
        }

        $all_sales_person = User::GetAlluser(); 

        $this->render('SaleViewDetails', array('sales' => $sales , 'all_notes'=>$lead_view_details , 'latest_followUp'=>$latest_follow_up , 'show_btn'=>$is_show_btn ,'all_sales_rep'=>$all_sales_person));
    }

     
    public function actionsetLeadStatus(){
        
         $status = $_POST['lead_status'];
         $follow_up_date = $_POST['follow_up_date'];
         $note = $_POST['notes'];
         $id= $_POST['lead_id'];  
         $action = $_POST['action_type'];
        //  print_r($_POST);  die;

         $update_sql = "UPDATE tbl_leads  SET status = :status , status_update_date =:status_update_date   WHERE lead_id = :lead_id";
            Yii::app()->db->createCommand($update_sql)
                ->bindParam(':status', $status, PDO::PARAM_INT)
                ->bindParam(':lead_id', $id, PDO::PARAM_INT)
                ->bindParam(':status_update_date' ,$follow_up_date , PDO::PARAM_STR)
                ->execute();

         $leads_status = new LeadsStatus();
         $leads_status->lead_id = $id;
         $leads_status->action_type = $action ; 
         $leads_status->note = $note;
         $leads_status->created_at = date('Y-m-d H:i:s');
         $leads_status->status_update_date = $follow_up_date ; 
         $leads_status->status = $status ;
         $leads_status->save();
        
         
         if (!$leads_status->save()) {
            echo "Failed to save!";
            print_r($leads_status->errors); die; 
        }

        $html = ''; 
        if($action =='Schedule_Call'):
            $html .= '<div class="chip greenBtn">
                     <figure><img src="../../images/icons/callWhite.png" alt="" class="iconImg"></figure> '.(date("M d" ,strtotime(date('Y-m-d H:i:s')))). '
                   </div> ' ; 

       elseif($action =='Schedule_Video_Call'):
          $html .= '<div class="chip purpleBtn">
                     <figure><img src="../../images/icons/vedio.png" alt="" class="iconImg"></figure>'.(date("M d" ,strtotime(date('Y-m-d H:i:s')))). '
                  </div> '; 

        elseif($action =='Schedule_Message'):
           $html .= '<div class="chip lightPurpleBtn">
                             <figure><img src="../../images/icons/mailWhite.png" alt="" class="iconImg"></figure> '.(date("M d" ,strtotime(date('Y-m-d H:i:s')))). '
                        </div>' ; 
         endif ; 

        $html .= '<div class="followUpDetails">
               <div class="messNotes">
                 <p>'.$note.'</p>
                 <a href="#"  data-toggle="modal"  class="view_all_status_change" data-lead_id ="'.$id.'"  data-target="#messNotesModal"> View...</a>
                </div>
           </div>';

            $lead_activity = ActivityLog::AddLeadActivity($id ,3 ,$status);

           echo json_encode(['status'=>'success' ,'html'=>$html , 'lead_status'=>$status]) ; 
        //  $this->redirect(array('adminLeads'));


    }
  
    public function actionsetOtherLeadStatus(){
      
          $id = $_POST['lead_id']; 
          $status = $_POST['other_lead_status']; 
          $date = $_POST['date']; 
          $remark = $_POST['notes'] ; 
          $is_ajax = isset($_POST['is_ajax']) ?  $_POST['is_ajax'] : 0; 
        //   echo '<pre>'; 
        //   print_r($_POST); die ; 

            $update_sql ="UPDATE tbl_leads  SET status = :status , status_update_date = :status_update_date   WHERE lead_id = :lead_id";
            Yii::app()->db->createCommand($update_sql)
                ->bindParam(':status', $status, PDO::PARAM_INT)
                ->bindParam(':lead_id', $id, PDO::PARAM_INT)
                ->bindParam(':status_update_date' ,$date , PDO::PARAM_STR)
                ->execute();
                
                $leads_status = new LeadsStatus();
                $leads_status->lead_id = $id;
                $leads_status->note = $remark;
                $leads_status->created_at = date('Y-m-d H:i:s');
                $leads_status->status_update_date = $date ; 
                $leads_status->status = $status ;
                $leads_status->save();


                if (!$leads_status->save()) {
                   echo "Failed to save!";
                   print_r($leads_status->errors); die; 
                }

                
                //  return  $is_ajax ?  json_encode(['status' => 'success'])     : $this->redirect(array('adminLeads'));
                  $lead_activity = ActivityLog::AddLeadActivity($id ,3,$status);
                 
                if($is_ajax):
                    echo  json_encode(['status' => 'success' ,'lead_status'=>$status]) ;
                else:
                     $this->redirect(array('adminLeads'));
                endif ;

    }    

    public  function actionupdateLeadSalesRep(){
        //  echo '<pre>'; 
        //  print_r($_POST) ; 
         $id = $_POST['id']; 
         $sales_rep = $_POST['sales_rep'] ; 
       
        
         $query = "UPDATE tbl_leads  SET assigned_to =:assigned_to WHERE lead_id= :lead_id" ; 
       
         Yii::app()->db->createCommand($query)  
           ->bindParam(':assigned_to' , $sales_rep , PDO::PARAM_STR)
           ->bindParam(':lead_id' , $id , PDO::PARAM_INT)
           ->execute();

        echo json_encode(['status'=>'success']);
    }

    // to get a lead data 
    public function actioneditLeadData(){
        $id = $_POST['id'];
        $is_dashboard =  isset($_POST['is_dashboard'])? $_POST['is_dashboard'] : 0 ; 

        $sql = "SELECT * FROM tbl_leads WHERE lead_id = $id"; 
        $sales = Yii::app()->db->createCommand($sql)->queryRow(); 
        $country = "SELECT DISTINCT country_name  FROM `tbl_country`  WHere country_name Not like '%USA-open%'";
        $countryName = Yii::app()->db->createCommand($country)->queryAll();
        $sales_person = User::GetAlluser();   

        $multiple_sales_repo = Yii::app()->db->createCommand("SELECT sale_rep FROM  tbl_leads_multiple where lead_id= :id")
                                    ->bindParam(":id", $id, PDO::PARAM_INT)
                                    ->queryColumn(); 
         

        $product = Yii::app()->db->createCommand("SELECT * FROM tbl_product ORDER BY sort ASC;")->queryAll();
        
        $this->renderPartial('EditTeamLeads', array('sales' => $sales ,'countryName' => $countryName ,'salesPerson'=>$sales_person ,'multiple_sales_person'=>$multiple_sales_repo 
         ,'is_dashboard'=>$is_dashboard ,'product'=>$product), false, true);

    }

    public function actionupdateLeadQuery(){
        

         $company_name = $_POST['company_name']; 
         $country  = $_POST['country'];
         $pro_name  = $_POST['pro_name']; 
         $name = $_POST['name'];
         $l_name = $_POST['l_name']; 
         $phone_number = $_POST['phone_number'];
         $email = $_POST['email']; 
         $state = $_POST['TblLeads']['state_name']; 
         $qty = $_POST['qty']; 
         $due_date =$_POST['due_date']; 
         $description =$_POST['description']; 
         $assigned_to = $_POST['assigned_to'] ;
         $id = $_POST['lead_id']; 
         $multiple_assigned = isset($_POST['']) ? $_POST[''] : 0; 
         $status = $_POST['lead_status'] ; 
         $city = $_POST['city'];


           // get old assigned_to value
        $oldAssigned = Yii::app()->db->createCommand()
        ->select('assigned_to')
        ->from('tbl_leads')
        ->where('lead_id=:lead_id', [':lead_id'=>$id])
        ->queryScalar();


      
        $sql = "UPDATE tbl_leads SET 
          pro_name = :pro_name , 
          TAC_name = :TAC_name , 
          description = :description , 
          qty = :qty, 
          due_date = :due_date , 
          name =:name, 
          last_name =:last_name , 
          email =:email , 
          phone_no =:phone_no , 
          state_name =:state_name, 
          country_name =:country_name , 
          assigned_to =:assigned_to,
          city =:city
          WHERE lead_id =:lead_id 
        ";
       Yii::app()->db->createCommand($sql)
       ->bindParam('pro_name' ,$pro_name , PDO::PARAM_STR)
       ->bindParam('TAC_name' ,$company_name , PDO::PARAM_STR)
       ->bindParam('description' ,$description , PDO::PARAM_STR)
       ->bindParam('qty' ,$qty , PDO::PARAM_INT)
       ->bindParam('due_date' ,$due_date , PDO::PARAM_STR)
       ->bindParam('name' ,$name , PDO::PARAM_STR)
       ->bindParam('last_name' ,$l_name , PDO::PARAM_STR)
       ->bindParam('email' ,$email , PDO::PARAM_STR)
       ->bindParam('phone_no' ,$phone_number , PDO::PARAM_STR)
       ->bindParam('state_name' ,$state , PDO::PARAM_STR)
       ->bindParam('country_name'  ,$country , PDO::PARAM_STR)
       ->bindParam('assigned_to' ,$assigned_to , PDO::PARAM_STR)
       ->bindParam('city' ,$city , PDO::PARAM_STR)
       ->bindParam('lead_id' ,$id , PDO::PARAM_STR)
       ->execute(); 
       

          $lead_activity = ActivityLog::AddLeadActivity($id ,1);

        // send email to assigned or updated sales rep 
         
        $details = Multipleleads::GetLeadDetailsById($id);
         // send email only if assigned_to changed and not empty
            if(!empty($assigned_to) && $assigned_to != $oldAssigned){

                TblLeads::SendAutomaticAssignedMail($details);

            }
        //=============================
  
     
         echo json_encode(['status'=>'success' ,'is_dashboard' =>$_POST['is_dashboard']]); 
    
    }

    public function actiondeleteLeads(){
          $id= $_POST['id']; 
          $sql ="DELETE  FROM  tbl_leads WHERE lead_id=:lead_id"; 
          Yii::app()->db->createCommand($sql)->bindParam('lead_id' ,$id , PDO::PARAM_INT)->execute(); 
          Yii::app()->db->createCommand("DELETE FROM tbl_leads_multiple WHERE lead_id =:lead_id")->bindParam('lead_id' ,$id , PDO::PARAM_INT)->execute(); 
          Yii::app()->db->createCommand("DELETE FROM leads_status WHERE lead_id =:lead_id")->bindParam('lead_id' ,$id , PDO::PARAM_INT)->execute(); 
          Yii::app()->db->createCommand("DELETE FROM leads_comment WHERE lead_id =:lead_id")->bindParam('lead_id' ,$id , PDO::PARAM_INT)->execute(); 

          
          echo json_encode(['status'=>'success']);

    }

  
    public function actiongetAjaxTable(){
       
        $status = isset($_POST['status']) ? $_POST['status'] : 0;
        $month =  empty($_POST['month']) ? 0 : $_POST['month'];
        $salesPerson = $_POST['sales_person'];
        $today_date = date('Y-m-d'); 

        if(!empty($salesPerson)){
            $user  =  $_POST['sales_person'];
        }else{
             $user = Yii::app()->user->getId(); 
        }
        $admin  = Yii::app()->user->getId(); 
        $search = $_POST['search'];
        
        $currentYear = $_POST['year'];
        $startDate = new DateTime("$currentYear-01-01"); // First day of the month
        $endDate = new DateTime("$currentYear-12-01"); // Start with the first day of the month
                                 
        if($month){
              $all_date = getMonthdDate($month ,$currentYear); 
              $start_date = $all_date['start_date'];
              $end_date = $all_date['end_date'];
        }else{
            $start_date = $startDate->format('Y-m-d'); 
            $end_date = $endDate->format('Y-m-d'); 
        }

        $state_name =  $_POST['state_name'] ? $_POST['state_name'] : 0;

       

        $sql ="SELECT  tbl.lead_id,tm.sale_rep AS sale_rep ,  COALESCE(product.prod_name, tbl.pro_name) AS prod_name  , 
                   tbl.*  FROM `tbl_leads` AS tbl LEFT  JOIN tbl_leads_multiple AS tm ON tm.lead_id = tbl.lead_id LEFT JOIN tbl_product product ON product.prod_id = tbl.pro_name WHERE " ; 
      
                    $sql .=  " tbl.status!=5 AND (tbl.assigned_to ='$admin' OR tm.sale_rep='$admin')  " ;  
         

            if($search){
                $sql .= "AND(tbl.TAC_name LIKE '%".$search."%' 
                OR  tbl.qty LIKE '% ".$search." %'
                OR tbl.due_date LIKE '%".$search."%'
                OR tbl.name LIKE  '%".$search."%'
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


        $condition = []; 
        if($status =='All'):
               if($salesPerson):
                   $condition[]  = "DATE(tbl.created_at)  BETWEEN '$start_date' AND '$end_date' OR (tbl.assigned_to = '$salesPerson' OR tm.sale_rep = '$salesPerson') ";
               else:
                  $condition[]  = "DATE(tbl.created_at)  BETWEEN '$start_date' AND '$end_date' ";
               endif ; 
        elseif($status=='1' && !$month):
              $condition[] = "tbl.status_update_date = '$today_date' AND tbl.status=1"  ;
        elseif($month && $salesPerson && $status!='All'):
               $condition[] = "tbl.status=$status AND DATE(tbl.created_at)  BETWEEN '$start_date' AND '$end_date'  AND (tbl.assigned_to = '$salesPerson' OR tm.sale_rep = '$salesPerson')";
        elseif($salesPerson && $status!='All'):
               $condition[] = "tbl.status=$status AND  (tbl.assigned_to = '$salesPerson' OR tm.sale_rep = '$salesPerson')";
        elseif($month && $status !='All'):
               $condition[] = "tbl.status=$status AND DATE(tbl.created_at)  BETWEEN '$start_date' AND '$end_date' ";
        else:
               $condition[] = " tbl.status=$status  ";
        endif ;
     
   
            if($state_name){
                $str_name = TblLeads::getStateNameChar($state_name); 
                if($str_name){
                    $condition[] = "tbl.state_name LIKE '%$state_name%' OR tbl.state_code LIKE '%$str_name%'";
                }else{
                    $condition[] = "tbl.state_name LIKE '%$state_name%'";
                }
            }


          $sql .= (count($condition) > 0 ? " AND ". implode(" AND ", $condition) : " ");
        

          $sql .= "  GROUP BY tbl.lead_id  "; 

          $count_data = Yii::app()->db->createCommand($sql)->queryAll();

          $totalCount = count($count_data);
        //   echo  'count ' . $totalCount ;

        // $totalCount = Yii::app()->db->createCommand($totalCountQuery)->queryScalar(); 
        $currentPage =    isset($_POST['page']) ? (int)$_POST['page'] : 1; 
         
        $pagination_arr = TblLeads::getPagination($currentPage ,$totalCount);
      
        $sql .= " ORDER BY created_at DESC  LIMIT  ".$pagination_arr['pageSize']."   OFFSET ".$pagination_arr['offset']."";
        // echo $sql ;
        $adminLeads = Yii::app()->db->createCommand($sql)->queryAll();
        
        $sales_person = User::GetAlluser(); 
        $data_count = TblLeads::GetCountValuesAdmin(); 
      
        // echo '<pre>'; 
        // print_r($adminLeads);

        $htmlContent = $this->renderPartial('Datatable', [
            'lead_status' => LEAD_STATUS,
            'lead_classes' => LEAD_CLASSES,
            'adminLeads' => $adminLeads,
            'salesPerson' => $sales_person,
            'total_count'=> count($adminLeads) ,  
            'totalPages' => $pagination_arr['totalPages'], 
            'currentPage' => $pagination_arr['currentPage'],
            'totalDataCounnt' =>$totalCount ,
            'start_number' =>$pagination_arr['start_number'] ,
            'end_number' =>$pagination_arr['end_number']

        ], true);

        echo json_encode([
            'html' => $htmlContent,
            'data_count' => $data_count,
            'sql'=>$sql ,
        ]);

        Yii::app()->end();



        // $this->renderPartial('Datatable' , array('lead_status'=>LEAD_STATUS ,'lead_classes'=>LEAD_CLASSES , 'adminLeads'=>$adminLeads ,'salesPerson'=>$sales_person , 'data_count'=>$data_count) , false , true) ; 

    }


    public function actiongetAjaxTableBACKUP202504(){
       
        $status = isset($_POST['status']) ? $_POST['status'] : 0;
        $month =  empty($_POST['month']) ? 0 : $_POST['month'];
        $salesPerson = $_POST['sales_person'];

        if(!empty($salesPerson)){
            $user  =  $_POST['sales_person'];
        }else{
             $user = Yii::app()->user->getId(); 
        }

       
        $search = $_POST['search'];
        
        $currentYear = $_POST['year'];
        $startDate = new DateTime("$currentYear-01-01"); // First day of the month
        $endDate = new DateTime("$currentYear-12-01"); // Start with the first day of the month
                                 
        if($month){
              $all_date = getMonthdDate($month); 
              $start_date = $all_date['start_date'];
              $end_date = $all_date['end_date'];
        }else{
            $start_date = $startDate->format('Y-m-d'); 
            $end_date = $endDate->format('Y-m-d'); 
        }

       

        $sql ="SELECT  tbl.lead_id,tm.sale_rep AS sale_rep ,  COALESCE(product.prod_name, tbl.pro_name) AS prod_name  , 
                   tbl.*  FROM `tbl_leads` AS tbl LEFT  JOIN tbl_leads_multiple AS tm ON tm.lead_id = tbl.lead_id LEFT JOIN tbl_product product ON product.prod_id = tbl.pro_name WHERE " ; 
      
                    $sql .=  "tbl.status!=5 AND (tbl.assigned_to ='$user' OR tm.sale_rep='$user')  " ;  
         

            if($search){
                $sql .= "AND(tbl.TAC_name LIKE '%".$search."%' 
                OR  tbl.qty LIKE '% ".$search." %'
                OR tbl.due_date LIKE '%".$search."%'
                OR tbl.name LIKE  '%".$search."%'
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


        $condition = []; 
        if($status =='All'):
               
                  $condition[]  = "DATE(tbl.created_at)  BETWEEN '$start_date' AND '$end_date' ";
        elseif($month && $salesPerson && $status!='All'):
               $condition[] = "tbl.status=$status AND DATE(tbl.created_at)  BETWEEN '$start_date' AND '$end_date'";
        elseif($salesPerson && $status!='All'):
               $condition[] = "tbl.status=$status";
        elseif($month && $status !='All'):
               $condition[] = "tbl.status=$status AND DATE(tbl.created_at)  BETWEEN '$start_date' AND '$end_date' ";
        else:
               $condition[] = "tbl.status=$status";
        endif ;
     

          $sql .= (count($condition) > 0 ? " AND ". implode(" AND ", $condition) : "");
        

          $sql .= "GROUP BY tbl.lead_id"; 

          $count_data = Yii::app()->db->createCommand($sql)->queryAll();

          $totalCount = count($count_data);
        //   echo  'count ' . $totalCount ;

        // $totalCount = Yii::app()->db->createCommand($totalCountQuery)->queryScalar(); 
        $currentPage =    isset($_POST['page']) ? (int)$_POST['page'] : 1; 
         
        $pagination_arr = TblLeads::getPagination($currentPage ,$totalCount);
      
        $sql .= " ORDER BY created_at DESC  LIMIT  ".$pagination_arr['pageSize']."   OFFSET ".$pagination_arr['offset']."";
        // echo $sql ;
        $adminLeads = Yii::app()->db->createCommand($sql)->queryAll();
        
        $sales_person = User::GetAlluser(); 
        $data_count = TblLeads::GetCountValuesAdmin(); 
      
        // echo '<pre>'; 
        // print_r($adminLeads);

        $htmlContent = $this->renderPartial('Datatable', [
            'lead_status' => LEAD_STATUS,
            'lead_classes' => LEAD_CLASSES,
            'adminLeads' => $adminLeads,
            'salesPerson' => $sales_person,
            'total_count'=> count($adminLeads) ,  
            'totalPages' => $pagination_arr['totalPages'], 
            'currentPage' => $pagination_arr['currentPage'],
            'totalDataCounnt' =>$totalCount ,
            'start_number' =>$pagination_arr['start_number'] ,
            'end_number' =>$pagination_arr['end_number']

        ], true);

        echo json_encode([
            'html' => $htmlContent,
            'data_count' => $data_count,
            'sql'=>$sql ,
        ]);

        Yii::app()->end();



        // $this->renderPartial('Datatable' , array('lead_status'=>LEAD_STATUS ,'lead_classes'=>LEAD_CLASSES , 'adminLeads'=>$adminLeads ,'salesPerson'=>$sales_person , 'data_count'=>$data_count) , false , true) ; 

    }

    public function actiongetAjaxTableAdminTeamBACKUP(){
          $status = $_POST['status']; 
          $month =  $_POST['month'];
          $salesPerson = $_POST['sales_person'];
          $currentYear = $_POST['year'];
        $today_date = date('Y-m-d');
         
          
          
        //   $currentYear = date('Y'); // Get the current year
          $startDate = new DateTime("$currentYear-$month-01"); // First day of the month
          $endDate = new DateTime("$currentYear-$month-01"); // Start with the first day of the month
          $endDate->modify('last day of this month');        // Get the last day of the month
  
  
          $start_date = $startDate->format('Y-m-d'); 
          $end_date = $endDate->format('Y-m-d'); 

      
            $sqlBase = " SELECT * FROM `tbl_leads` tbl WHERE tbl.status!=5 ";

            // $conditions = [];

            // if($status=='All'){
            //      if($salesPerson){
            //         $conditions[] = "tbl.due_date BETWEEN '$start_date' AND '$end_date'  AND  tbl.assigned_to = '$salesPerson'"; 
            //      }else{
            //         $conditions[] = "tbl.due_date BETWEEN '$start_date' AND '$end_date'";
            //      }
         
            // }
            // elseif ($month && $salesPerson && $status!='all') {
            //     $conditions[] = "tbl.due_date BETWEEN '$start_date' AND '$end_date' AND tbl.status = $status AND  tbl.assigned_to = '$salesPerson'";
            // } elseif ($salesPerson && $status!='All') {
            //     $conditions[] = "tbl.status = $status AND tbl.assigned_to = '$salesPerson'";
            // } elseif ($month && $status!='All') {
            //     $conditions[] = "tbl.status = $status AND tbl.due_date BETWEEN '$start_date' AND '$end_date'";
            // } elseif($status!="All") {
            //     $conditions[] = "tbl.status = $status";
            // }else{
            //     $conditions = [];
            // }


               $conditions = [];

            // Decide which date column to use
            $dateColumn = ($status == 1) ? 'tbl.status_update_date' : 'tbl.created_at';

            // Status filter
            if ($status !== 'All') {
                $conditions[] = "tbl.status = '$status'";
            }

            // Sales person
            if (!empty($salesPerson)) {
                $conditions[] = "(tbl.assigned_to = '$salesPerson' OR tlm.sale_rep = '$salesPerson')";
            }

            // State
            if (!empty($state_name)) {
                $conditions[] = "tbl.state_name = '$state_name'";
            }

            // Search
            if (!empty($search)) {
                $conditions[] = "(tbl.customer_name LIKE '%$search%' OR tbl.order_no LIKE '%$search%')";
            }

            // Date range
            if (!empty($date_range_start) && !empty($date_range_end)) {
                $conditions[] = "DATE($dateColumn) BETWEEN '$date_range_start' AND '$date_range_end'";
            }
            // Month + Year
            elseif (!empty($month) && !empty($currentYear)) {
                // $conditions[] = "MONTH($dateColumn) = '$month' AND YEAR($dateColumn) = '$year'";
                 $conditions[] = " DATE($dateColumn) BETWEEN '$start_date' AND '$end_date'";
            }
            elseif(empty($month) && empty($date_range_start) && empty($date_range_end)){
                 $conditions[] = " DATE($dateColumn) BETWEEN '$start_date' AND '$end_date'";
                 
            }
            // Special case: status = 1 and no date filter → today only
            elseif ($status == 1) {
                $conditions[] = "DATE(tbl.status_update_date) = $today_date";
             }


            $sql = $sqlBase . (count($conditions) > 0 ?  implode(" AND ", $conditions) : "") . " ORDER BY created_at DESC";
        

          $sales_person = User::GetAlluser();

        //   $pagination = new ActiveDataProvider([
        //    'query' => $adminLeads,
        //     'pagination' => [
        //         'pageSize' => 5,
        //     ],
        // ]);

        // $posts = $pagination->getModels();

        //    $dataProvider = new CActiveDataProvider('TblLeads', [
            //     'criteria' => [],
            //     'pagination' => [
                //         'pageSize' => $pageSize, // Number of items per page
                //     ],
                // ]);
                
              
           
        

           $totalCountQuery = "SELECT COUNT(*) FROM `tbl_leads` tbl WHERE status!=5" . (count($conditions) > 0 ? implode(" AND ", $conditions) : "");
           $totalCount = Yii::app()->db->createCommand($totalCountQuery)->queryScalar(); // Get total count of leads
           

            // Pagination setup
            $page = isset($_POST['page']) ? (int)$_POST['page'] : 1; // Get current page
            $pageSize = 10; // Page size (can be customized)
            $offset = ($page - 1) * $pageSize; // Offset for SQL query
            $sql .= " LIMIT $pageSize OFFSET $offset";


            $adminLeads = Yii::app()->db->createCommand($sql)->queryAll(); 
             

            // Create the pagination links using the total count
            $pagination = new CPagination($totalCount);
            $pagination->pageSize = $pageSize;
            $pagination->currentPage = $page - 1; // Zero-indexed page
            // $pagination->applyLimit(count($adminLeads)); // Apply the limit

            $paginationLinks = $this->widget('CLinkPager', array(
                'pages' => $pagination,
                'pageSize' => $pageSize,
                'header' => '',
                'firstPageLabel' => 'First',
                'prevPageLabel' => 'Prev',
                'nextPageLabel' => 'Next',
                'lastPageLabel' => 'Last',
                'htmlOptions' => array('class' => 'pagination'),
              
            
            ), true);


            $data_count = TblLeads::GetCountValues(); 
            $htmlContent =$this->renderPartial('Datatable' , array('lead_status'=>LEAD_STATUS ,'lead_classes'=>LEAD_CLASSES ,  'adminLeads'=>$adminLeads ,'salesPerson'=>$sales_person ,'total_count'=> count($adminLeads) , 'pagination'=>$paginationLinks) , true) ; 
           echo json_encode(
            [ 'html' =>$htmlContent ,
              'data_count'=>$data_count,
              'pagination' => $paginationLinks
            ]
           ); 


        //   $this->renderPartial('Datatable' , array('lead_status'=>LEAD_STATUS ,'lead_classes'=>LEAD_CLASSES ,  'adminLeads'=>$adminLeads ,'salesPerson'=>$sales_person) , false , true) ; 

    }

    
    public function actiongetAjaxTableAdminTeam(){
      


        $status = $_POST['status']; 
        $month =  empty($_POST['month']) ? 0 :$_POST['month'] ;
        $salesPerson = $_POST['sales_person'];
        $currentYear = $_POST['year'];
        $search = trim($_POST['search']);
        $today_date = date('Y-m-d');

         $date_range_arr = !empty($_POST['date_range']) ? explode('to' , $_POST['date_range']) : NULL;
        $date_range_start = $date_range_end = 0; 
       
        if(!empty($date_range_arr)){
             $date_range_start = trim($date_range_arr[0]) ; 
             $date_range_end = trim($date_range_arr[1]) ; 
         }

        
      //   $currentYear = date('Y'); // Get the current year
        $startDate = new DateTime("$currentYear-01-01"); // First day of the month
        $endDate = new DateTime("$currentYear-12-01"); // Start with the first day of the month
        $state_name =  $_POST['state_name'] ? $_POST['state_name'] : 0;

         if($month):
                $all_date = getMonthdDate($month ,$currentYear); 
                $start_date = $all_date['start_date'];
                $end_date = $all_date['end_date'];
         else:
            $start_date = $startDate->format('Y-m-d'); 
            $end_date = $endDate->format('Y-m-d'); 

        endif ; 


    
          $sqlBase = "SELECT  tbl.lead_id AS lead_id,  
                        tbl.pro_name AS pro_name, 
                        tbl.TAC_name AS TAC_name, 
                        tbl.description AS description, 
                        tbl.qty AS qty , 
                        tbl.due_date AS due_date, 
                        tbl.status_update_date AS status_update_date, 
                        tbl.name AS name, 
                        tbl.last_name AS last_name, 
                        tbl.email AS email, 
                        tbl.phone_no AS phone_no, 
                        tbl.state_name AS state_name,
                        tbl.country_name AS country_name, 
                        tbl.status AS status, 
                        tbl.date_add AS date_add, 
                        tbl.assigned_to AS assigned_to, 
                        tbl.created_at AS created_at, 
                        tbl.deleted_by AS deleted_by, 
                        tbl.deleted_date AS deleted_date, 
                        tbl.city ,
                        tbl.lead_type AS lead_type  ,
                       COALESCE(product.prod_name, tbl.pro_name) AS prod_name 
                            FROM `tbl_leads`  AS tbl
                            LEFT JOIN tbl_product product ON  tbl.pro_name =product.prod_id 
                            LEFT JOIN tbl_leads_multiple AS tlm ON tlm.lead_id = tbl.lead_id 
                            WHERE tbl.status!=5  AND  ";
            if($search){
                // echo $search ;
                 $sqlBase .= "(tbl.TAC_name LIKE '%".$search."%' 
                OR  tbl.qty LIKE '% ".$search." %'
                OR tbl.due_date LIKE '%".$search."%'
                OR tbl.name LIKE  '%".$search."%'
                OR tbl.last_name LIKE '%" . $search . "%'
                OR tbl.email LIKE '%" . $search . "%'
                OR tbl.phone_no LIKE '%" . $search . "%'
                OR tbl.state_name LIKE '%" . $search . "%'
                OR tbl.assigned_to LIKE '%" . $search . "%'
                OR tbl.country_name LIKE '%" . $search . "%' 
                OR prod_name LIKE '%" . $search . "%' 
                OR tbl.pro_name LIKE '%" . $search . "%')
                                
                                AND ";
            }


        //   $conditions = [];

        //   if($status=='All'){
        //        if($salesPerson){
        //           $conditions[] = "DATE(tbl.created_at) BETWEEN '$start_date' AND '$end_date'  AND (tbl.assigned_to = '$salesPerson' OR tlm.sale_rep='$salesPerson')"; 
        //        }else{
        //           $conditions[] = "DATE(tbl.created_at) BETWEEN '$start_date' AND '$end_date'";
        //        }
       
        //   }elseif($status=='1' && !$month){
        //       $conditions[] = "tbl.status_update_date = '$today_date' AND tbl.status=1"  ;
        //   }
        //   elseif ($month && $salesPerson && $status!='all') {
        //       $conditions[] = "DATE(tbl.created_at)  BETWEEN '$start_date' AND '$end_date' AND tbl.status = $status AND  (tbl.assigned_to = '$salesPerson' OR tlm.sale_rep='$salesPerson')";
        //   } elseif ($salesPerson && $status!='All') {
        //       $conditions[] = "tbl.status = $status AND (tbl.assigned_to = '$salesPerson' OR tlm.sale_rep='$salesPerson') ";
        //   } elseif ($month && $status!='All') {
        //       $conditions[] = "tbl.status = $status AND DATE(tbl.created_at) BETWEEN '$start_date' AND '$end_date'";
        //   } elseif($status!="All") {
        //       $conditions[] = "tbl.status = $status  ";
        //   }
        //   else{
        //       $conditions = [];
        //   }

        
        

        

            $conditions = [];

            // Decide which date column to use
            $dateColumn = ($status == 1) ? 'tbl.status_update_date' : 'tbl.created_at';

            // Status filter
            if ($status !== 'All') {
                $conditions[] = "tbl.status = '$status'";
            }

            // Sales person
            if (!empty($salesPerson)) {
                $conditions[] = "(tbl.assigned_to = '$salesPerson' OR tlm.sale_rep = '$salesPerson')";
            }

            // State
            if (!empty($state_name)) {
                $conditions[] = "tbl.state_name = '$state_name'";
            }

            // Search
            if (!empty($search)) {
                $conditions[] = "(tbl.customer_name LIKE '%$search%' OR tbl.order_no LIKE '%$search%')";
            }

            // Date range
            if (!empty($date_range_start) && !empty($date_range_end)) {
                $conditions[] = "DATE($dateColumn) BETWEEN '$date_range_start' AND '$date_range_end'";
            }
            // Month + Year
            elseif (!empty($month) && !empty($currentYear)) {
                // $conditions[] = "MONTH($dateColumn) = '$month' AND YEAR($dateColumn) = '$year'";
                 $conditions[] = " DATE($dateColumn) BETWEEN '$start_date' AND '$end_date'";
            }
            elseif(empty($month) && empty($date_range_start) && empty($date_range_end)){
                 $conditions[] = " DATE($dateColumn) BETWEEN '$start_date' AND '$end_date'";
                 
            }
            // Special case: status = 1 and no date filter → today only
            elseif ($status == 1) {
                $conditions[] = "DATE(tbl.status_update_date) = $today_date";
             }


        if($state_name){
            $str_name = TblLeads::getStateNameChar($state_name); 
            if($str_name){
                $conditions[] = "tbl.state_name LIKE '%$state_name%' OR tbl.state_code LIKE '%$str_name%'";
            }else{
                $conditions[] = "tbl.state_name LIKE '%$state_name%'";
            }
        }

      
          $sql = $sqlBase . (count($conditions) > 0 ?  implode(" AND ", $conditions) : "") ;
          $sql .= ' GROUP BY tbl.lead_id '; 


          $adminLeads = Yii::app()->db->createCommand($sql)->queryAll(); 
          $sales_person = User::GetAlluser();


         $totalCountQuery = "SELECT COUNT(*) FROM `tbl_leads` tbl WHERE " . (count($conditions) > 0 ? implode(" AND ", $conditions) : "");

         $totalCount = count($adminLeads);
         $currentPage =    isset($_POST['page']) ? (int)$_POST['page'] : 1; 
         $pagination_arr = TblLeads::getPagination($currentPage ,$totalCount);

          $sql .= " ORDER BY created_at DESC  LIMIT  ".$pagination_arr['pageSize']."   OFFSET ".$pagination_arr['offset']."";

          $adminLeads = Yii::app()->db->createCommand($sql)->queryAll(); 
           
          
          $data_count = TblLeads::GetCountValues(); 
          $htmlContent =$this->renderPartial('Datatable' , ['lead_status'=>LEAD_STATUS ,
                                                            'lead_classes'=>LEAD_CLASSES ,  
                                                            'adminLeads'=>$adminLeads ,
                                                            'salesPerson'=>$sales_person ,
                                                            'total_count'=> count($adminLeads) , 
                                                             'totalPages' => $pagination_arr['totalPages'], 
                                                             'currentPage' => $pagination_arr['currentPage'] ,
                                                             'totalDataCounnt' =>$totalCount ,
                                                             'start_number' =>$pagination_arr['start_number'] ,
                                                             'end_number' =>$pagination_arr['end_number']
                                               ] ,true) ; 

               
         echo json_encode(
          [ 'html' =>$htmlContent ,
            'data_count'=>$data_count,
            'sql' =>$sql 
          ]
         ); 


      //   $this->renderPartial('Datatable' , array('lead_status'=>LEAD_STATUS ,'lead_classes'=>LEAD_CLASSES ,  'adminLeads'=>$adminLeads ,'salesPerson'=>$sales_person) , false , true) ; 

  }

  public function actiongetRecentLeads(){
        $week = $_POST['week'] ? $_POST['week'] :0;

        $currentDate = new DateTime();
        $firstDayOfMonth = new DateTime($currentDate->format('Y-m-01'));
        $firstDayOfWeek = $firstDayOfMonth->modify('previous sunday');

        if($week):
        if($week==3){
            $week_date =  getWeekDate($week , $firstDayOfWeek);   //function inside main (config)
        }else{
            $week_date =  getWeekDateNew($week);   //function inside main (config)
                
        }
        $start_date = $week_date['start'];  
        $end_date  =   $week_date['end']; 
        else:
            $end_date  = date('Y-m-d'); 
            $start_date = date('Y-m-d' ,strtotime($end_date . ' -7 days ')); 
        endif; 
   
        // echo $start_date .' ' .$end_date ; 
    $tab_value = $_POST['tab_value']; 
   
    //  username condition for only Dev Cote user 
    $NewUser = strtolower(Yii::app()->user->id); 

    if(Yii::app()->user->getState('userGroup') == 2  && $NewUser != "dcote"):
       $salesPerson = Yii::app()->user->getId();   
                 
               if($tab_value=="online"){
                  $sql= "SELECT DISTINCT tbl.lead_id , tbl.* FROM tbl_leads  tbl LEFT JOIN tbl_leads_multiple tbl_multiple
                                   ON tbl.lead_id = tbl_multiple.lead_id 
                                   WHERE (tbl.assigned_to = '$salesPerson' OR tbl_multiple.sale_rep = '$salesPerson') 
                                   AND tbl.status !=5 AND
                                   DATE(tbl.created_at) BETWEEN '$start_date' AND '$end_date' AND tbl.lead_type ='2'";
           }elseif($tab_value=="offline"){
                                    $sql= "SELECT DISTINCT tbl.lead_id ,tbl.* FROM tbl_leads  tbl LEFT JOIN tbl_leads_multiple tbl_multiple
                                   ON tbl.lead_id = tbl_multiple.lead_id 
                                   WHERE (tbl.assigned_to = '$salesPerson' OR tbl_multiple.sale_rep = '$salesPerson') 
                                   AND tbl.status !=5 AND tbl.lead_type ='1' AND
                                   DATE(tbl.created_at) BETWEEN '$start_date' AND '$end_date'";
           }
           else{
                       $sql= "SELECT DISTINCT tbl.lead_id ,tbl.* FROM tbl_leads  tbl LEFT JOIN tbl_leads_multiple tbl_multiple
                                ON tbl.lead_id = tbl_multiple.lead_id  
                                   WHERE (tbl.assigned_to = '$salesPerson' OR tbl_multiple.sale_rep = '$salesPerson') 
                                   AND tbl.lead_type =1 AND tbl.status !=5 AND DATE(tbl.created_at) BETWEEN '$start_date' AND '$end_date'";
             }
   
   else:
          if($tab_value=="online"){
           $sql= "SELECT * FROM tbl_leads  WHERE status!='5' AND lead_type='2' AND DATE(created_at) BETWEEN '$start_date' AND '$end_date'";
       }elseif($tab_value=="offline"){
           $sql= "SELECT * FROM tbl_leads  WHERE status!='5' AND lead_type='1' AND DATE(created_at) BETWEEN '$start_date' AND '$end_date'";
       }
       else{
           $sql= "SELECT * FROM tbl_leads  WHERE status!='5' AND lead_type='1' AND DATE(created_at) BETWEEN '$start_date' AND '$end_date'";
       }
    endif ; 
   
    
    $data = Yii::app()->db->createCommand($sql)->queryAll();
    $totalCount = count($data); 
    $currentPage =    isset($_POST['page']) ? (int)$_POST['page'] : 1; 
    $pagination_arr = TblLeads::getPagination($currentPage ,$totalCount);
  
   

    $sql .= " ORDER BY created_at DESC  LIMIT  ".$pagination_arr['pageSize']."   OFFSET ".$pagination_arr['offset']."";
    $totalRecentLeads = Yii::app()->db->createCommand($sql)->queryAll(); 


    $sales_person = Yii::app()->db->createCommand("SELECT * FROM user where user_group_id='2' ORDER BY user.fullName ASC")->queryAll();
    $this->renderPartial('DashboardDataTable' , ['data'=>$totalRecentLeads ,
                                                'lead_status'=>LEAD_STATUS ,'salesPerson'=>$sales_person , 
                                                'total_count'=> $totalCount ,  
                                                'totalPages' => $pagination_arr['totalPages'], 
                                                'currentPage' => $pagination_arr['currentPage']
                                                ] 
                                           , false , true) ; 

}  

    
    public function actiongetUnassignedLeads(){
        $week = $_POST['week'] ? $_POST['week'] :0;

        $currentDate = new DateTime();
        $firstDayOfMonth = new DateTime($currentDate->format('Y-m-01'));
        $firstDayOfWeek = $firstDayOfMonth->modify('previous sunday');

        if($week):
                $week_date =  getWeekDate($week , $firstDayOfWeek);   //function inside main (config)
                $start_date = $week_date['start'];  
                $end_date  =   $week_date['end']; 
        else:
                $end_date  = date('Y-m-d'); 
                $start_date = date('Y-m-d' ,strtotime($end_date . ' -7 days ')); 
        endif; 
  
    
        //   $sql = " SELECT * FROM tbl_leads WHERE assigned_to='' AND status !=5 AND  DATE(created_at) BETWEEN  '$start_date' AND '$end_date'"; 
         $sql = "SELECT tl.*
                FROM tbl_leads AS tl
                LEFT JOIN tbl_leads_multiple AS tlm ON tlm.lead_id = tl.lead_id
                WHERE 
                    (tl.assigned_to='' AND tlm.sale_rep IS NULL)
                    AND tl.status != 5
                    AND DATE(tl.created_at) BETWEEN '$start_date' AND '$end_date'
                GROUP BY tl.lead_id 
                ORDER BY tl.created_at DESC
                ";
      
          $data = Yii::app()->db->createCommand($sql)->queryAll(); 
          $sales_person = User::GetAlluser(); 

          $this->renderPartial('DashboardDataTable' , array('data'=>$data ,'lead_status'=>LEAD_STATUS ,'salesPerson'=>$sales_person) , false , true) ; 

    }

    public function actiondashboardCountFilter(){ 
        $month = isset($_POST['month']) ? $_POST['month'] : 0; 
        $previousMonth = ((int)$month > 1) ? (int)$month - 1 : 12;
        $lastMonth = str_pad($previousMonth, 2, '0', STR_PAD_LEFT);  
    
        $date = getMonthdDate($month); 
        $lastDate = getMonthdDate($lastMonth);
        $status = $_POST['status']; 

        $NewUser = strtolower(Yii::app()->user->id); 
       
        if(Yii::app()->user->getState('userGroup') == 2  && $NewUser != "dcote"):
                    $sales_person = Yii::app()->user->getId() ; 

                    $sql_without_status = "SELECT COUNT(DISTINCT tbl.lead_id) 
                                            FROM tbl_leads tbl 
                                            JOIN tbl_leads_multiple tbl_multiple
                                            ON tbl.lead_id = tbl_multiple.lead_id 
                                            WHERE (tbl.assigned_to = :sales_person OR tbl_multiple.sale_rep = :sales_person) 
                                            AND DATE(tbl.created_at) BETWEEN :start_date AND :end_date"; 

                    $sql_with_status = "SELECT COUNT(DISTINCT tbl.lead_id) 
                                        FROM tbl_leads tbl 
                                        JOIN tbl_leads_multiple tbl_multiple
                                        ON tbl.lead_id = tbl_multiple.lead_id 
                                        WHERE (tbl.assigned_to = :sales_person OR tbl_multiple.sale_rep = :sales_person) 
                                        AND tbl.status = :status AND   DATE(tbl.created_at) BETWEEN :start_date AND :end_date" ; 

                    if($status=="toal_leads"):

                            $count = Yii::app()->db->createCommand($sql_without_status)->bindValues([
                            'sales_person'=> $sales_person , 
                            ':start_date' =>$date['start_date'], 
                            ':end_date' => $date['end_date']
                            ])->queryScalar();

                            $last_month_count = Yii::app()->db->createCommand($sql_without_status)->bindValues([
                            'sales_person'=> $sales_person , 
                            ':start_date' =>$lastDate['start_date'], 
                            ':end_date' =>$lastDate['start_date']  
                            ])->queryScalar(); 

                    elseif($status=="new_leads"):
                            $count = Yii::app()->db->createCommand($sql_with_status)->bindValues([
                            'sales_person'=> $sales_person , 
                            ':start_date' =>$date['start_date'], 
                            ':end_date' => $date['end_date'], 
                            ':status' =>0
                            ])->queryScalar(); 

                            $last_month_count = Yii::app()->db->createCommand($sql_with_status)->bindValues([
                            'sales_person'=> $sales_person , 
                            ':start_date' =>$lastDate['start_date'], 
                            ':end_date' =>$lastDate['start_date']  ,
                            ':status' =>0
                            ])->queryScalar(); 


                    elseif($status =="converted_leads"): 
                            $count = Yii::app()->db->createCommand($sql_with_status)->bindValues([
                            'sales_person'=> $sales_person , 
                            ':start_date' =>$date['start_date'], 
                            ':end_date' => $date['end_date'], 
                            ':status' =>2
                            ])->queryScalar(); 

                            $last_month_count = Yii::app()->db->createCommand($sql_with_status)->bindValues([
                            'sales_person'=> $sales_person , 
                            ':start_date' =>$lastDate['start_date'], 
                            ':end_date' =>$lastDate['start_date']  ,
                            ':status' =>2
                            ])->queryScalar(); 

                    elseif($status=="lost_leads"):
                            $count = Yii::app()->db->createCommand($sql_with_status)->bindValues([
                            'sales_person'=> $sales_person , 
                            ':start_date' =>$date['start_date'], 
                            ':end_date' => $date['end_date'], 
                            ':status' =>4
                            ])->queryScalar(); 

                            $last_month_count = Yii::app()->db->createCommand($sql_with_status)->bindValues([
                            'sales_person'=> $sales_person , 
                            ':start_date' =>$lastDate['start_date'], 
                            ':end_date' =>$lastDate['start_date']  ,
                            ':status' =>4
                            ])->queryScalar(); 

                    else:
                            $count = Yii::app()->db->createCommand("SELECT COUNT(DISTINCT tbl.lead_id) 
                            FROM tbl_leads tbl 
                            JOIN tbl_leads_multiple tbl_multiple
                            ON tbl.lead_id = tbl_multiple.lead_id 
                            WHERE (tbl.assigned_to = :sales_person OR tbl_multiple.sale_rep = :sales_person)")->bindValues([
                            'sales_person'=> $sales_person])->queryScalar(); 

                            $last_month_count = Yii::app()->db->createCommand("SELECT COUNT(DISTINCT tbl.lead_id) 
                            FROM tbl_leads tbl 
                            JOIN tbl_leads_multiple tbl_multiple
                            ON tbl.lead_id = tbl_multiple.lead_id 
                            WHERE (tbl.assigned_to = :sales_person OR tbl_multiple.sale_rep = :sales_person)")->bindValues([
                            'sales_person'=> $sales_person])->queryScalar();  
                    endif ; 

                    $percent = $last_month_count > 0 ? (($count- $last_month_count) *100/$last_month_count) : $count- $last_month_count ; 


        else:
                if($status=="toal_leads"):
                    $sql = "SELECT COUNT(*) FROM tbl_leads WHERE status != 5 AND DATE(created_at) BETWEEN '".$date['start_date']."'  AND '" .$date['end_date']."'"; 
                    $last_month_sql = "SELECT COUNT(*) FROM tbl_leads WHERE DATE(created_at) BETWEEN '".$lastDate['start_date']."'  AND '" .$lastDate['end_date']."'"; 

                elseif($status=="new_leads"):
                    $sql = "SELECT COUNT(*) FROM tbl_leads WHERE status=0 AND DATE(created_at) BETWEEN '".$date['start_date']."'  AND '" .$date['end_date']."'";
                    $last_month_sql = "SELECT COUNT(*) FROM tbl_leads WHERE status=0 AND DATE(created_at) BETWEEN '".$lastDate['start_date']."'  AND '" .$lastDate['end_date']."'";  

                elseif($status =="converted_leads"): 
                    $sql = "SELECT COUNT(*) FROM tbl_leads WHERE status=2 AND DATE(created_at) BETWEEN '".$date['start_date']."'  AND '" .$date['end_date']."'";
                    $last_month_sql = "SELECT COUNT(*) FROM tbl_leads WHERE status=2 AND DATE(created_at) BETWEEN '".$lastDate['start_date']."'  AND '" .$lastDate['end_date']."'";

                elseif($status=="lost_leads"):
                    $sql = "SELECT COUNT(*) FROM tbl_leads WHERE status=4 AND DATE(created_at) BETWEEN '".$date['start_date']."'  AND '" .$date['end_date']."'";
                    $last_month_sql = "SELECT COUNT(*) FROM tbl_leads WHERE status=4 AND DATE(created_at) BETWEEN '".$lastDate['start_date']."'  AND '" .$lastDate['end_date']."'";

                else:
                    $sql = "SELECT COUNT(*) FROM tbl_leads";
                    $last_month_sql = "SELECT COUNT(*) FROM tbl_leads";
                endif ; 
            
                $count = Yii::app()->db->createCommand($sql)->queryScalar(); 
                $last_month_count = Yii::app()->db->createCommand($last_month_sql)->queryScalar(); 

                if($count==0 && $last_month_count>0):
                     $percent =0;
                else:
                    $percent = $last_month_count > 0 ? (($count- $last_month_count) *100/$last_month_count) : $count- $last_month_count ; 
                endif ;

                endif ; 


        
        echo json_encode(['status'=>'success' ,'count'=>$count , 'percent' =>(int)$percent ]); 
         
    }

    public function actiongetCountrySalesRepOLD(){
           $id  = $_POST['id'];
           $data = Yii::app()->db->createCommand("SELECT * FROM lead_sales WHERE lead_sales_id =$id")->queryAll(); 
           $country = TblLeads::GetCountryNameByOrder();      
 

          $this->renderPartial('salesRepAjax' , array('country'=>$country ,'data'=>$data) , false , true) ; 
          
    }

    public function actiongetCountrySalesRep(){
        $sq = "SELECT * FROM `lead_sales`  where status =1 ";
        $adminSales = Yii::app()->db->createCommand($sq)->queryAll();

        $groupedSales = [];

       

        foreach ($adminSales as $sale) {
                $state = $sale['state_name'];
                $country = $sale['country_name'];  
                $priority = $sale['state_priority'];

                // If state does not exist, create parent array
                if (!isset($groupedSales[$state])) {
                    $groupedSales[$state] = [
                    'state_name'   => $state,
                    'country_name' => $country,
                    'priority'     => $priority,
                    'data'         => []
                    ];
                }

                // ✅ FIX: Update country_name if currently empty and new value is not empty
                if (
                    empty($groupedSales[$state]['country_name']) &&
                    !empty($country)
                ) {
                    $groupedSales[$state]['country_name'] = $country;
                }

                  unset($sale['state_name']); 
                   $groupedSales[$state]['data'][] = $sale;
            }

      

        // $country = TblLeads::GetCountryNameByOrder();     
        $country = TblLeads::getCountryData();     

 
        // Yii::app()->db->createCommand("UPDATE tbl_country  SET same_country='1' Where country_name = 'USA-close' OR country_name = 'USA'")->execute(); 


      $this->renderPartial('salesRepAjax' ,  array('adminSales' => $groupedSales ,'country'=>$country) , false , true) ; 
       
 }



//  public function actionUpdateQueryRaw(){
//      $id = $_POST['id']; 
//      $country = $_POST['country']; 
//      $state = $_POST['droppedState']; 
//     //  print_r($_POST);
//     //  echo $state ; echo $country ; die;

//      $sql ="UPDATE lead_sales SET state_name=:state ,country_name=:country WHERE lead_sales_id=:lead_sales_id"; 
      
//      Yii::app()->db->createCommand($sql)
//      ->bindParam(':state', $state, PDO::PARAM_STR)
//      ->bindParam(':country', $country, PDO::PARAM_STR)
//      ->bindParam(':lead_sales_id' ,$id , PDO::PARAM_INT)
//      ->execute();
  
//      echo json_encode(['status'=>'success']); 

//  }



 public function actionUpdateQueryRaw(){
     $id = $_POST['id']; 
     $country = $_POST['country'] ?? NULL; 
     $state = $_POST['droppedState']; 
     $dropped_state_arr = $_POST['dropped_state_arr'];
     $dragged_state_arr =$_POST['dragged_state_arr'];
     $dragged_state = $_POST['draggedState'];
     $dropped_state = $_POST['droppedState'] ?? 0 ;
   
     
    //  print_r($_POST);
  
    // if(empty($country)){
    //       echo json_encode(['data'=>[] ,'reponse'=>false]);
    //       exit;
    // }

      
     if(!$country){
         $sql = "SELECT country_name FROM  tbl_country where id='$dropped_state'" ; 
         $country = Yii::app()->db->createCommand($sql)->queryScalar(); 
     }

    $already_exsits = TblLeads::AlreadyExists($id ,$dropped_state) ;              
    if(!empty($already_exsits)){
        echo json_encode(['data'=>true ,'exsists'=>true]); 
        exit ;
    }

     $sql ="UPDATE lead_sales SET state_name=:state ,country_name=:country WHERE lead_sales_id=:lead_sales_id"; 
      
     Yii::app()->db->createCommand($sql)
     ->bindParam(':state', $state, PDO::PARAM_STR)
     ->bindParam(':country', $country, PDO::PARAM_STR)
     ->bindParam(':lead_sales_id' ,$id , PDO::PARAM_INT)
     ->execute();

     $update_state = TblLeads::UpateSalesPerPriority(false , $dropped_state_arr);
     $update_state1 = TblLeads::UpateSalesPerPriority(false , $dragged_state_arr);

     
     $data = Yii::app()->db->createCommand("SELECT tc.state_name As st_nm , user.fullname As fullname, tc.same_country  As same_country , ls.* FROM lead_sales As ls LEFT JOIN  tbl_country AS tc ON  ls.state_name= tc.id LEFT JOIN user  AS user ON user.username=ls.sales_name  Where ls.lead_sales_id='$id'")->queryRow();  
     $html2 =Null ; 
     $html  = $this->renderPartial('SalesRep_Table', ['data'=>$data ,'dragged_state'=>$dragged_state] ,true);
     if($dragged_state !=$dropped_state){
        $html2  = $this->renderPartial('SalesRep_Table', ['data'=>$data ,'dragged_state'=>$dropped_state] ,true);
     }
   
     $check_drop_state = Yii::app()->db->createCommand("SELECT COUNT(*) FROM lead_sales  Where state_name='$dropped_state'")->queryScalar(); 
        
     echo json_encode(['status'=>'success' ,'html'=>$html , 'html2'=>$html2 ,'data'=>$data ,'count_val'=>$check_drop_state]); 
 
 }

 public function actiongetCommentAjax(){

      $lead_id = $_POST['id'];
      $sql = "SELECT * FROM leads_comment WHERE lead_id=$lead_id  ORDER BY created_at DESC" ;
      $data = Yii::app()->db->createCommand($sql)->queryAll();   
      
      $this->renderPartial('leadsCommentAjax' , array('data'=>$data ,'id'=>$_POST['id']) , false , true) ; 
 }

 public function actionaddComment(){ 
       $model = new LeadComment;
       $cmt_id = $model->addComment($_POST); 
       if($cmt_id){
          echo json_encode(['status'=>'success']);
       }else{
           echo json_encode(['status'=>'Failed']);
       }
 }

  public function actiongetNotificationAjax(){
         $selected_value = $_POST['selected_val']; 
   
         if(empty($selected_value)): 
         else : 
                foreach($selected_value as $key=>$value){
                     $sql = "UPDATE leads_comment SET status =:status WHERE id=:id ";
                    Yii::app()->db->createCommand($sql)
                     ->bindValue(":id", $value, PDO::PARAM_INT)
                     ->bindValue(':status' ,1 , PDO::PARAM_INT)
                     ->execute(); 

                    }

                    // if(Yii::app()->user->getState('userGroup') == 2):
                    //     $salesPerson = Yii::app()->user->getId() ; 
                    //     $data = Yii::app()->db->createCommand("SELECT 
                    //     lc.id AS id , 
                    //     lc.lead_id AS lead_id , 
                    //     lc.sales_rep AS sales_rep , 
                    //     lc.comment AS comment , 
                    //     lc.status AS status , 
                    //     lc.created_at AS created_at 
                    //    FROM leads_comment  As lc  LEFT JOIN tbl_leads AS tbl ON  tbl.lead_id =lc.lead_id LEFT JOIN jogjoino_salesrep_test.tbl_leads_multiple AS tl ON tl.lead_id = lc.lead_id  Where (tbl.assigned_to='$salesPerson' OR tl.sale_rep ='$salesPerson') ORDER BY lc.created_at DESC")->queryAll();
                     

                    // else:
                    //     $data = Yii::app()->db->createCommand("SELECT DISTINCT lc.id , lc.* FROM leads_comment AS lc LEFT JOIN tbl_leads tbl ON tbl.lead= lc.lead_id ORDER BY status ASC")->queryAll(); 

                    // endif;

                    $data = TblLeads::getNotification(); 
                
                    $this->renderPartial('dashboardNotification' ,array('notification'=>$data) , false ,true) ;
                   
         endif ; 
  }

  public function actiondeleteNotificationAjax(){
      $selected_value = $_POST['selected_val']; 
      
      if(empty($selected_value)) : 
        else : 
             
               foreach($selected_value as $key=>$value){
                    $sql = "DELETE FROM  leads_comment WHERE id=:id ";
                   Yii::app()->db->createCommand($sql)
                    ->bindValue(":id", $value, PDO::PARAM_INT)
                    ->execute(); 

                   }
                   $data = TblLeads::getNotification(); 
               
                   $this->renderPartial('dashboardNotification' ,array('notification'=>$data) , false ,true) ;
                  
        endif ; 
  }

   public function actiongetNotificationIcon(){
    //  if(Yii::app()->user->getState('userGroup')==2):
    //     $salesPerson = Yii::app()->user->getId() ; 
    //     $count = Yii::app()->db->createCommand("SELECT COUNT(DISTINCT lc.id) FROM leads_comment  As lc  LEFT JOIN tbl_leads AS tbl ON  tbl.lead_id =lc.lead_id LEFT JOIN jogjoino_salesrep_test.tbl_leads_multiple AS tl ON tl.lead_id = lc.lead_id  Where (tbl.assigned_to='$salesPerson' OR tl.sale_rep ='$salesPerson') ORDER BY lc.created_at DESC")->queryScalar();
    //  else:
    //     $count = count(TblLeads::getNotification());
    //  endif ; 

         $NewUser =strtolower(Yii::app()->user->id) ; 
        if(Yii::app()->user->getState('userGroup')==2 && $NewUser!='dcote'){
                $count  = count(TblLeads::getAllCRMNotification($is_count=true)); 
                
        }else{
            $count = count(TblLeads::getNotification());
        }

        $baseUrl= Yii::app()->request->baseUrl .'/images/icons/Comment_icon_new.png'; 
        

        $ele = '<img src="'.$baseUrl.'" height="24px" width="24px" class=" avatar-img img-square">' ;
        
        if($count):
            $ele.= '<span class="badge badge-notify noti_main">'.$count.'</span> ' ;
        endif; 
        $ele .= ' <ul class="dropdown-menu bell notification_dropdown" style="overflow-y: scroll;height: 400px;margin-top:0;" role="menu">

                </ul>
                      '; 
        echo $ele ; 
   }

    public function actiongetNotificationIconDropdown(){
    $ele = '<h1>CRM Notification</h1> ';
    
    $ele.= ' <div class="" style="margin-left:6px;">
          <button class="btn btn-sm btn-primary mark_all_noti" data-is_crm=true > Mark Read </button>
          <button class="btn btn-sm btn-primary  delete_all_noti" data-is_crm= true > Delete All </button>
     </div>' ;


      $NewUser =strtolower(Yii::app()->user->id) ; 
      if(Yii::app()->user->getState('userGroup')==2 && $NewUser!='dcote'):

      $count  = TblLeads::getAllCRMNotification(); 
      $str ='';
      foreach($count  as $key=>$value){
       $status =LEAD_STATUS[$value['lead_status']];
        //   echo '<pre>';
        //   print_r($count);
        //   die;

           $is_checked = $value['act_status']==2 ? 'checked' : '' ;
           $style = "style=width:24px; " ;
      
          if($value['action_type']==1){
            
            
            $str =  '<li> 
            <input type="checkbox" name="" class="crm_notification_all"  data-notification_id = "'.$value['id'].'"  data-lead_id="'.$value['lead_id'].'"  '.$is_checked.' '.$style.'  />    
               <a href="'.Yii::app()->createUrl('leads/viewSalesDetails', array('id' => $value['lead_id'])).'">
              <span class="label label-warning">'.$value['created_at'].'</span>
              <span class="notify-link"> <strong>  '.$value['name'].'  : </strong>  Edited successfully </span></a>


                <button type="button"
                    class="glyphicon glyphicon-trash delete_CRM_notification"
                    data-comment_id="'.$value['id'].'"
                    data-lead_id="'.$value['lead_id'].'"
                    title="Delete Notification">
                    </button>
            
            </li>';
           }
           if($value['action_type']==2){
            $str = '
                <li>  
                <input type="checkbox" name="" class="crm_notification_all"  data-notification_id = "'.$value['id'].'"  data-lead_id="'.$value['lead_id'].'"  '.$is_checked.' '.$style.'  />   
                 <a href="'.Yii::app()->createUrl('leads/viewSalesDetails', array('id' => $value['lead_id'])).'">
                 <span class="label label-warning">'.$value['created_at'].'</span>
                 <span class="notify-link"> <strong>  '.$value['name'].'  :  </strong>  Assigned to You </span></a>

                   <button type="button"
                    class="glyphicon glyphicon-trash delete_CRM_notification"
                    data-comment_id="'.$value['id'].'"
                    data-lead_id="'.$value['lead_id'].'"
                    title="Delete Notification">
                    </button>
              </li>';
           }
           if($value['action_type']==3){
            $str = '
                <li> 
                <input type="checkbox" name="" class="crm_notification_all"  data-notification_id = "'.$value['id'].'"  data-lead_id="'.$value['lead_id'].'"  '.$is_checked.' '.$style.'  />    
                 <a href="'.Yii::app()->createUrl('leads/viewSalesDetails', array('id' => $value['lead_id'])).'">
                 <span class="label label-warning">'.$value['created_at'].'</span>
                 <span class="notify-link"> <strong>  '.$value['name'].'  : changed to '.$status.'</strong>  </span></a>

                   <button type="button"
                    class="glyphicon glyphicon-trash delete_CRM_notification"
                    data-comment_id="'.$value['id'].'"
                    data-lead_id="'.$value['lead_id'].'"
                    title="Delete Notification">
                    </button>
              </li>';
           }
           if($value['action_type']==4){
        
             $comment  = Yii::app()->db->createCommand("SELECT comment FROM leads_comment Where lead_id = ".$value['lead_id']." AND created_at = '".$value['created_at']."'")->queryScalar();
            

            $str = '<li>
            <input type="checkbox" name="" class="crm_notification_all"  data-notification_id = "'.$value['id'].'"  data-lead_id="'.$value['lead_id'].'"  '.$is_checked.' '.$style.'  />   
              <a href="'.Yii::app()->createUrl('leads/viewSalesDetails', array('id' => $value['lead_id'])).'"><span class="label label-warning">'.$value['created_at'].'</span>
              <span class="notify-link"> <strong>  New Commented on : </strong> '. $value['name']. ' ' .$comment. ' </span></a>

                <button type="button"
                    class="glyphicon glyphicon-trash delete_CRM_notification"
                    data-comment_id="'.$value['id'].'"
                    data-lead_id="'.$value['lead_id'].'"
                    title="Delete Notification">
                    </button>
              </li>';
           }
           
          

              $ele .= $str;
      } 

      else:
        $count = TblLeads::getNotification();
        
        foreach($count as $key=>$value){
             $is_checked = $value['status']==2 ? 'checked' : '' ;
              $ele .= '<li>
               <input type="checkbox" name="" class="crm_notification_all"  data-notification_id = "'.$value['id'].'"  data-lead_id="'.$value['lead_id'].'" '.$is_checked.' style="width:25px;" />  

              <a href="'.Yii::app()->createUrl('leads/viewSalesDetails', array('id' => $value['lead_id'])).'"><span class="label label-warning">'.$value['created_at'].'</span>
              <span class="notify-link"> <strong> '.$value['sales_rep'].' Commented  : </strong> '.$value['comment'].' this on  Lead '.$value['name'].'</span></a>

                 <button type="button"
                    class="glyphicon glyphicon-trash delete_CRM_notification"
                    data-comment_id="'.$value['id'].'"
                    data-lead_id="'.$value['lead_id'].'"
                    title="Delete Notification">
                    </button>
              </li>
              ';
        }


      endif ;
      

        echo $ele ; 
   }


   public function actionGetAssignedSalesRep(){
    $id = $_POST['id']; 
    $data = Yii::app()->db->createCommand("SELECT * FROM tbl_leads_multiple Where lead_id = $id")->queryAll(); 
    $leads = Yii::app()->db->createCommand("SELECT * FROM tbl_leads Where lead_id = $id")->queryRow(); 
    $salesPerson  = User::GetAlluser(); 
    $multiple_sales=  TblLeads::GetMultipleSalesRepArr($id); 

 
  
    $assigned_sales_rep = $this->renderPartial('assignedSalesRep' ,  ['data' =>$data ,'salesPerson' =>$leads] , true) ;
    $all_sales_rep = $this->renderPartial('allAssignedSalesRep' ,  ['leads' =>$leads , 'salesPerson'=>$salesPerson ,'multiple_sales'=>$multiple_sales ,'act_lead_id' =>$id] ,true) ;

    echo json_encode([
         'assigned_sales_rep' =>$assigned_sales_rep , 
         'all_sales_rep' =>$all_sales_rep ,
    ]) ; 
}

//    public function actionSavemultipleSalesRep(){
//         $id = Multipleleads::SavemultipleSalesRep(); 
//         echo json_encode(['status'=>'success' ,'id'=>$id]);
//    }

        public function actionSavemultipleSalesRep(){
            $id = Multipleleads::SavemultipleSalesRep(); 
            
            echo json_encode(['status'=>'success' ,'id'=>$id]);
        } 

   public function actionGetallStatusData(){
        $id = $_POST['id']; 
    
        $lead_view_details = Yii::app()->db->createCommand("SELECT 
                ls.id AS id , 
                ls.status_update_date AS status_update_date , 
                ls.action_type AS action_type , 
                ls.note AS note , 
                ls.created_at AS created_at 
                FROM leads_status ls  Where ls.status=1 AND ls.action_type IS NOT NULL AND ls.lead_id='$id' ORDER BY ls.created_at DESC")->queryAll();

        $this->renderPartial('followUpNotes' ,  ['data' =>$lead_view_details ] , false , true);
   }

   public function actiondeleteSalesPerson(){
    $multiple_id = isset($_POST['multiple_id']) ? $_POST['multiple_id'] : 0;
    $lead_id =  isset($_POST['lead_id']) ? $_POST['lead_id'] : 0;
    $salesPerson = isset($_POST['salesPerson']) ? $_POST['salesPerson']:0;


     
    if($multiple_id  || $_POST['id']){
        $id = isset($_POST['id']) ? $_POST['id'] :  $_POST['multiple_id']; 
         $asigned_to = ActivityLog::AddLeadActivity($id ,5 ,$salesPerson);
        Yii::app()->db->createCommand("DELETE FROM tbl_leads_multiple WHERE id=:id")->bindValue(':id' ,$id ,PDO::PARAM_INT)->execute(); 
        TblLeads::sendLeadUnassignedLeadMessage($salesPerson ,$lead_id , date('Y-m-d'));

         TblLeads::UpdateAssignLeadCount($salesPerson ,$lead_id , 'Remove');

        echo json_encode(['status'=>'success' ,'id'=>$id]);

    }else{
         $id = $_POST['lead_id'] ?? 0; 
      Yii::app()->db->createCommand("UPDATE tbl_leads  SET assigned_to = NULL  WHERE lead_id=:lead_id")->bindValue(':lead_id' ,$lead_id ,PDO::PARAM_INT)->execute(); 
     $asigned_to = ActivityLog::AddLeadActivity($id ,5 ,$salesPerson);
     TblLeads::sendLeadUnassignedLeadMessage($salesPerson ,$lead_id , date('Y-m-d'));

      TblLeads::UpdateAssignLeadCount($salesPerson ,$lead_id , 'Remove');

      echo json_encode(['status'=>'success' ,'id'=>$id]);
    }

     
 }



   public function actiongetAttentionLeads(){
    $sales_person = Yii::app()->user->getId(); 
    $week = $_POST['week'] ? $_POST['week'] :0;

    $currentDate = new DateTime();
    $firstDayOfMonth = new DateTime($currentDate->format('Y-m-01'));
    $firstDayOfWeek = $firstDayOfMonth->modify('previous sunday');

    if($week):
            $week_date =  getWeekDate($week , $firstDayOfWeek);   //function inside main (config)
            $start_date = $week_date['start'];  
            $end_date  =   $week_date['end']; 
    else:
            $end_date  = date('Y-m-d'); 
            $start_date = date('Y-m-d' ,strtotime($end_date . ' -7 days ')); 
    endif; 

    // echo  'start date' .$start_date  .'end_date' .$end_date;
    
     $sql =  "SELECT DISTINCT tbl.lead_id , tbl.* 
                FROM tbl_leads tbl 
               LEFT JOIN tbl_leads_multiple tbl_multiple
                ON tbl.lead_id = tbl_multiple.lead_id 
                WHERE (tbl.assigned_to = :sales_person OR tbl_multiple.sale_rep = :sales_person) 
                AND tbl.status = :status AND DATE(tbl.created_at) BETWEEN :start_date AND :end_date" ;
   
    $data = Yii::app()->db->createCommand($sql)->bindValues([':sales_person' =>$sales_person , ':status' => '1' , ':start_date'=>"$start_date" , ':end_date'=>$end_date])->queryAll(); 
    $sales_person = User::GetAlluser(); 
    $this->renderPartial('DashboardDataTable' , array('data'=>$data ,'lead_status'=>LEAD_STATUS ,'salesPerson'=>$sales_person) , false , true) ; 

   }

    public function actiongetallAssignedSalesRep(){
         $lead_id = $_POST['lead_id']; 
         $sales_person = $_POST['salesPerson'];
         $search  = $_POST['search']; 
        
         if($search) {
            

            $alluser = Yii::app()->db->createCommand()
                ->select('*')
                ->from('user')
                ->where(
                    'fullname LIKE :search 
         AND enable = 1 
         AND (
                (
                    user_group_id = 2 
                    AND id NOT IN (9,24,38,10,48,47,5,39,8,33,41 ,12)
                )
                OR id IN (26,28,65,76,44,40)
             )',
                    array(':search' => '%' . $search . '%')
                )
                ->queryAll();
          
        }else{
            $alluser = User::GetAlluser(); 
        }
        
        $selected_value = TblLeads::GetMultipleSalesRepArr($lead_id); 
        $OtherDetails = TblLeads::GetOtherSalesRep($lead_id) ;

        $this->renderPartial('allAssignedSalesRep' ,  ['salesPerson' =>$alluser , 'multiple_sales'=>$selected_value ,'assigned_to'=>$sales_person ,'lead_id' =>$lead_id ,'OtherDetails' => $OtherDetails] , false , true);
         

   }

   
   // sales leads 
    
   public function actionsalesLeads(){
    $country = "SELECT DISTINCT country_name  FROM `tbl_country`  WHere country_name Not like '%USA-open%'";
    $countryName = Yii::app()->db->createCommand($country)->queryAll();
    $sales_person = User::GetAlluser();   
    $product = Yii::app()->db->createCommand("SELECT * FROM tbl_product ORDER BY sort ASC;")->queryAll();

       $this->render('salesLeads' ,array('countryName' => $countryName ,'salesPerson'=>$sales_person ,'product'=>$product  ));
   }


   public function actionSoftdeleteLeads(){
        $id  = $_POST['id']; 
        $date = date('Y-m-d H:i:s');
        $user = Yii::app()->user->getId(); 

        $sql = "UPDATE  tbl_leads SET tbl_leads.status = 5  , tbl_leads.deleted_by = '$user' , tbl_leads.deleted_date= '$date' Where lead_id = '$id'  ";
        $deleted = Yii::app()->db->createCommand($sql)->execute(); 
        echo json_encode(['staus'=>'success' ,'id'=>$id]);


   }

   public function actiongetDeletedLeads(){
    $week = $_POST['week'] ? $_POST['week'] :0;

    $currentDate = new DateTime();
    $firstDayOfMonth = new DateTime($currentDate->format('Y-m-01'));
    $firstDayOfWeek = $firstDayOfMonth->modify('previous sunday');

    if($week):
            $week_date =  getWeekDate($week , $firstDayOfWeek);   //function inside main (config)
            $start_date = $week_date['start'];  
            $end_date  =   $week_date['end']; 
    else:
            $end_date  = date('Y-m-d'); 
            $start_date = date('Y-m-d' ,strtotime($end_date . ' -7 days ')); 
    endif; 

    // echo $start_date . 'ddd' .$end_date; 
        $sql = "SELECT * FROM tbl_leads Where status = 5 AND DATE(deleted_date) BETWEEN '$start_date' AND '$end_date'";
        $data = Yii::app()->db->createCommand($sql)->queryAll(); 
        $alluser = User::GetAlluser(); 

        $totalCount = count($data); 
        $currentPage =    isset($_POST['page']) ? (int)$_POST['page'] : 1; 
        $pagination_arr = TblLeads::getPagination($currentPage ,$totalCount);
        $sql .= " ORDER BY created_at DESC  LIMIT  ".$pagination_arr['pageSize']."   OFFSET ".$pagination_arr['offset']."";
        $data = Yii::app()->db->createCommand($sql)->queryAll(); 


        $this->renderPartial('deletedLeads' ,  ['salesPerson' =>$alluser , 'data'=>$data , 
                                                'total_count'=> $totalCount ,  
                                                'totalPages' => $pagination_arr['totalPages'], 
                                                'currentPage' => $pagination_arr['currentPage']
                                            ] , false , true);
        
   }

   public function actionrecoverLeads(){
       $id = $_POST['id']; 
        try{
            $sql = "UPDATE tbl_leads SET status =0 , created_at = '".date('Y-m-d H:i:s')."' where lead_id = '$id'"; 
            $data = Yii::app()->db->createCommand($sql)->execute(); 
            echo json_encode(['status'=>'success']);
        }catch(Exception $e){
              echo json_encode(['status'=>'failed' ,'error'=>$e]);
        }
     

   }

   public function actionGetMapData(){
       //   foreach($leads as $key=>$value){
       //       if(!in_array($value['country' ]))
       //   }

        $leads = Yii::app()->db->createCommand("SELECT * FROM  tbl_leads")->queryAll(); 
        $new_arr =[];
        $country  = Yii::app()->db->createCommand("SELECT DISTINCT country_name , state_name FROM tbl_country")->queryAll(); 
        echo json_encode(['country' =>$country]); 

   }

   public function actionenableLeadAssignment(){

        $status = $_POST['status'];  
        $update_status = $status == 'true'  ? 1 :0; 
      
        $sql ="UPDATE lead_distribution SET status = $update_status Where id = 1"; 
        $data = Yii::app()->db->createCommand($sql)->execute(); 
        
        echo json_encode(['status' =>'success' ,'data'=>$data]);
   }

  


   public function actionleadActivity(){
       $title = 'activity log' ;
       $this->render('activityLog' ,['title' =>$title]);
   }

   public function actiongetActivityLogs(){ 
        $data = ActivityLog::getActivityLog(); 
        $today_data = ActivityLog::getTodayData(); 

        $html = $this->renderPartial('activityLogAjax' ,  ['data'=>$data['data'] , 
                                                'total_count'=> $data['total_count'],
                                                'totalPages' =>$data['totalPages'],
                                                'currentPage' =>$data['currentPage']
                                            ] ,true);

        $other_info =  'Null' ;
        $html1 =  $this->renderPartial('activityLogAjax' ,['data'=>$today_data['data']] ,true) ;

        echo json_encode([
             'html' =>$html , 
             'html1'=>$html1,
             'other' =>$other_info ,
        ]); 
   }


   public function actiongetLeadSalesState(){
       return TblLeads::getLeadSalesState(); 
   }


   public function actionmanageCountry(){  
      $this->render('manageCountry' ,array('title'=>'title'));
   }

   public function actiongetCountryData(){
        $country_data = TblLeads::getCountryData(); 

            $html = $this->renderPartial('manageCountryAjax' ,  ['data'=>$country_data] ,true);
            $other_info =  'Null' ;
 

        echo json_encode([
        'html' =>$html , 
        'other' =>$other_info ,
    ]); 

   }

   public function actionupdateCountryName(){
     return TblLeads::updateCountryName(); 
   }

    public function actionUpdateStatePriorrity(){
        
         $country = $_POST['country']; 
         $all_state = $_POST['all_state']; 
         $priority = $_POST['priority']; 
         $state = $_POST['state']; 
    
          foreach($all_state as $key=>$value){
              $sql =  "UPDATE lead_sales SET state_priority='$value' where state_name='$key' AND country_name='$country'"; 
              $update = Yii::app()->db->createCommand($sql)->execute(); 
         }
         echo json_encode(['status'=>200 , 'update'=>$update]);

    }


    public function actiondeleteAllLeads(){
        try{
         $ids=  $_POST['all_ids']; 
         if(!empty($ids)){
             foreach($ids as $key=>$value){
                 $id  = $value; 
                 $date = date('Y-m-d H:i:s');
                 $user = Yii::app()->user->getId(); 

                $sql = "UPDATE  tbl_leads SET tbl_leads.status = 5  , tbl_leads.deleted_by = '$user' , tbl_leads.deleted_date= '$date' Where lead_id = '$id'  ";
                 $deleted = Yii::app()->db->createCommand($sql)->execute(); 
             }
             echo json_encode(['status'=>200 ,'deleted'=>true]);
             exit;
             
         }else{
             echo json_encode(['status'=>404 , 'deleted'=>False]);
         }
        }catch(Exception $e){
              echo json_encode(['status'=>500 , 'deleted'=>False]);
        }
    }

    public function  actiondeleteAllLeadsParmanet(){
          try{  
            $ids=  $_POST['all_ids']; 
           if(!empty($ids)){
             foreach($ids as $key=>$value){
                 $id  = $value; 
                $sql ="DELETE  FROM  tbl_leads WHERE lead_id=:lead_id"; 
                Yii::app()->db->createCommand($sql)->bindParam('lead_id' ,$id , PDO::PARAM_INT)->execute(); 
                Yii::app()->db->createCommand("DELETE FROM tbl_leads_multiple WHERE lead_id =:lead_id")->bindParam('lead_id' ,$id , PDO::PARAM_INT)->execute(); 
                Yii::app()->db->createCommand("DELETE FROM leads_status WHERE lead_id =:lead_id")->bindParam('lead_id' ,$id , PDO::PARAM_INT)->execute(); 
                Yii::app()->db->createCommand("DELETE FROM leads_comment WHERE lead_id =:lead_id")->bindParam('lead_id' ,$id , PDO::PARAM_INT)->execute(); 
                Yii::app()->db->createCommand("DELETE FROM lead_activity WHERE lead_id =:lead_id")->bindParam('lead_id' ,$id , PDO::PARAM_INT)->execute();
             }
             echo json_encode(['status'=>200 ,'deleted'=>true]);
             exit;
             
            }else{
                echo json_encode(['status'=>404 , 'deleted'=>False]);
                exit ;
            }
          }catch(Exception $e){
               echo json_encode(['status'=>500 , 'deleted'=>False]);
          } 
    }


    //multiple sales person assigned 

    public function actionAssignedMultipleSalesPerson(){
         $datafilter = $_POST['date_range'];
         $start_date = NUll ; 
         $end_date= Null;
         if($datafilter==1){
             $start_date = date('Y-m-d'); 
             $end_date = date('Y-m-d');
         }
         elseif($datafilter==2){
             $data = CurrentWeekData(); 
             $start_date = $data[0]; 
             $end_date = $data[1];
         }elseif($datafilter==3){
              $data = getMonthdDate(date('m'));
              $start_date = $data['start_date']; 
              $end_date = $data['end_date'];
         }elseif($datafilter==4){
              $year = date('Y');
              $start_date= date("$year-01-01");
              $end_date = date("$year-12-31");
         }

        $sql = "SELECT tl.lead_id AS lead_id , tl.* FROM tbl_leads AS tl LEFT JOIN tbl_leads_multiple AS tlm ON tlm.lead_id = tl.lead_id Where 
       ( tl.assigned_to='' OR tlm.sale_rep IS NULL)"; 
       
       if($start_date && $end_date){
          $sql .= "AND (Date(tl.created_at) BETWEEN '$start_date' AND '$end_date' ) ";
       }

       $sql .= "GROUP BY tl.lead_id";
       $result = Yii::app()->db->createCommand($sql)->queryAll(); 
       
        if(!empty($result)):
            foreach($result  as $key=>$val){
                    TblLeads::MultipleSalesPersonAssigned($val['state_name'] ,$val['country_name'] ,$val['lead_id']);
            }
            echo json_encode(['status'=>200 ,'assigned'=>true]);
            exit ; 
        else:
            echo  json_encode(['status'=>200 , 'empty'=>true]);
            exit;
        endif ; 
        
    }



    //==========
    public function actionDeleteCRMNotification(){
    $commentId = (int)($_POST['id'] ?? 0);

    $username = Yii::app()->user->id;
    $userId   = TblLeads::GetLogggedinUserId($username);
  
      if (Yii::app()->user->getState('userGroup') == 2 && $username!="dcote"):
       
            $Id = $_POST['id'] ?? 0; 
       
         $sql = "UPDATE lead_activity set status=0 , user_id = '$userId' Where id='$Id'";
         $exe=  Yii::app()->db->createCommand($sql)->execute();
         if($exe){
             echo json_encode(['status'=>200 , 'msg'=>'success']);
         }else{
             echo json_encode(['status'=>200 , 'msg'=>'fail']);

         }

         exit; 

      else:
    // =============== Delete for admin  ========================
    $sql = "UPDATE leads_comment
        SET deleted_by = 
            CASE 
                WHEN deleted_by IS NULL OR deleted_by = ''
                THEN :user_id
                ELSE CONCAT(deleted_by, ',', :user_id)
            END
        WHERE id = :id
    ";
 exit ;



    $updated = Yii::app()->db->createCommand($sql)->bindValues([
        ':id'      => $commentId,
        ':user_id' => (int)$userId,
    ])->execute();

    echo json_encode([
        'status'  => $updated ? 200 : 403,
        'Updated' => (bool)$updated
    ]);

   
    endif ; 
}
  

public function actionExportExcel()
{
           
        $status = isset($_POST['status']) ? $_POST['status'] : 0;
        $month =  empty($_POST['month']) ? 0 : $_POST['month'];
        $salesPerson = $_POST['sales_person'];
        $today_date = date('Y-m-d'); 

        if(!empty($salesPerson)){
            $user  =  $_POST['sales_person'];
        }else{
             $user = Yii::app()->user->getId(); 
        }

        $admin  = Yii::app()->user->getId(); 
        $search = $_POST['search'];
        
        $currentYear = $_POST['year'];
        $startDate = new DateTime("$currentYear-01-01"); // First day of the month
        $endDate = new DateTime("$currentYear-12-01"); // Start with the first day of the month

         $NewUser = strtolower(Yii::app()->user->id); 
       
                                 
        if($month){
              $all_date = getMonthdDate($month ,$currentYear); 
              $start_date = $all_date['start_date'];
              $end_date = $all_date['end_date'];
        }else{
            $start_date = $startDate->format('Y-m-d'); 
            $end_date = $endDate->format('Y-m-d'); 
        }

        $state_name =  $_POST['state_name'] ? $_POST['state_name'] : 0;

       

        $sql ="SELECT  tbl.lead_id,tm.sale_rep AS sale_rep ,  COALESCE(product.prod_name, tbl.pro_name) AS prod_name  , 
                   tbl.*  FROM `tbl_leads` AS tbl LEFT  JOIN tbl_leads_multiple AS tm ON tm.lead_id = tbl.lead_id LEFT JOIN tbl_product product ON product.prod_id = tbl.pro_name WHERE " ; 
      
            $sql .=  " tbl.status!=5  " ;  

           if(Yii::app()->user->getState('userGroup') == 2   && $NewUser != "dcote"){    
              $sql .= "AND (tbl.assigned_to ='$admin' OR tm.sale_rep='$admin') " ;
           }

            if($search){
                $sql .= "AND(tbl.TAC_name LIKE '%".$search."%' 
                OR  tbl.qty LIKE '% ".$search." %'
                OR tbl.due_date LIKE '%".$search."%'
                OR tbl.name LIKE  '%".$search."%'
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


        $condition = []; 
        if($status =='All'):
               if($salesPerson):
                   $condition[]  = "DATE(tbl.created_at)  BETWEEN '$start_date' AND '$end_date' OR (tbl.assigned_to = '$salesPerson' OR tm.sale_rep = '$salesPerson') ";
               else:
                  $condition[]  = "DATE(tbl.created_at)  BETWEEN '$start_date' AND '$end_date' ";
               endif ; 
        elseif($status=='1' && !$month):
              $condition[] = "tbl.status_update_date = '$today_date' AND tbl.status=1"  ;
        elseif($month && $salesPerson && $status!='All'):
               $condition[] = "tbl.status=$status AND DATE(tbl.created_at)  BETWEEN '$start_date' AND '$end_date'  AND (tbl.assigned_to = '$salesPerson' OR tm.sale_rep = '$salesPerson')";
        elseif($salesPerson && $status!='All'):
               $condition[] = "tbl.status=$status AND  (tbl.assigned_to = '$salesPerson' OR tm.sale_rep = '$salesPerson')";
        elseif($month && $status !='All'):
               $condition[] = "tbl.status=$status AND DATE(tbl.created_at)  BETWEEN '$start_date' AND '$end_date' ";
        else:
               $condition[] = " tbl.status=$status  ";
        endif ;
     
   
            if($state_name){
                $str_name = TblLeads::getStateNameChar($state_name); 
                if($str_name){
                    $condition[] = "tbl.state_name LIKE '%$state_name%' OR tbl.state_code LIKE '%$str_name%'";
                }else{
                    $condition[] = "tbl.state_name LIKE '%$state_name%'";
                }
            }


          $sql .= (count($condition) > 0 ? " AND ". implode(" AND ", $condition) : " ");
        

          $sql .= "  GROUP BY tbl.lead_id  "; 

            
        $sql .= " ORDER BY created_at DESC ";



       
        $adminLeads = Yii::app()->db->createCommand($sql)->queryAll();  
  
      
       
     

        $this->renderPartial('report_xls', ['adminLeads' => $adminLeads , 'LEAD_STATUS'=>LEAD_STATUS]);
  

   

}


}
