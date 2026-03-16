                                          <?php 
                                                       $dragged_state  = !empty($dragged_state) ? $dragged_state  :0 ;
                                                       
                                                       
                                                       if(!$dragged_state){
                                                        $user_details = TblLeads::getSalesPersonDetails($data['sales_name']); 
                                                        $table_row_id =  "sales_".$data['lead_sales_id'] ; 
                                                        
                                                            
                                                            
                                             ?>
                                               
                                                   <tr id="<?=$table_row_id?>" class="sort_tr find_tr_row"  data-lead_id="<? echo $data['lead_sales_id'] ?>" data-country="<? echo $data['country_name']?>"  data-state="<? echo $data['state_name'] ?>">
                                                             <td class="drag_td_row"  data-tr_id ="<?=$table_row_id?>">
                                                                 <figure><img src="../images/icons/dragTable.png" alt="" class="iconImg"></figure>                                                                    
                                                             </td>
                                                             <td class="fullname"><?php echo $user_details['fullname'] ?  $user_details['fullname'] : ''  ; ?></td>

                                                             <td>
                                                                 <select  data-tr_id ="<?=$table_row_id?>"  class="form-select assignedTo text-left  state_select_ele" aria-label="Default select example" 
                                                                 onchange="updateSalesPriority(this.value, <?php echo $data['lead_sales_id']; ?>,'state_name' ,this)"
                                                                 >                                                                 
                                                                 <?php 
                                                                  if($data['same_country']==1){
                                                                     $country_name = 'USA';
                                                                     $sql_cust = "SELECT * FROM tbl_country WHERE country_name LIKE '$country_name'  ORDER BY state_name ASC; ";
                                                                     
                                                                  }else{

                                                                      $country_name = $data['country_name'];
                                                                      $sql_cust = "SELECT * FROM tbl_country WHERE country_name LIKE '%$country_name%'  ORDER BY state_name ASC; ";
                                                                  }

                                                                  $states = Yii::app()->db->createCommand($sql_cust)->queryAll();                                                                                

                                                                  foreach ($states as $stateName) {
                                                                      $state = $stateName['id'];
                                                                       
                                                                      $selected = ($stateName['id'] == $data['state_name']) ? 'selected' : '';
                                                                      echo "<option value=\"$state\" $selected> ".$stateName['state_name']."</option>";
                                                                  }
                                                                    
                                                                 ?>
                                                                 </select>
                                                             </td>
                                                             <td>                                                        
                                                                 <select class="form-select assignedTo text-left sales_priority_select"  
                                                                 data-tr_id ="<?=$table_row_id?>" aria-label="Default select example" id="lead_canada" data-sales-id="<?php echo $data['lead_sales_id']; ?>" onchange="updateSalesPriority(this.value, <?php echo $data['lead_sales_id']; ?>,'sales_priority'  ,this)">
                                                                     <?php                                                                     
                                                                         $sales_priority = [
                                                                             1,2,3,4,5,6,7,8,9,10
                                                                         ];
                                                                         foreach ($sales_priority as $priority) {
                                                                             $selected = ($priority == $data['sales_priority']) ? 'selected' : '';
                                                                             echo "<option value=\"$priority\" $selected>$priority</option>";
                                                                         }
                                                                     ?>                                                                
                                                                 </select>
                                                             </td>
                                                             <td>
                                                                 <select class="form-select assignedTo text-left lead_capcity_select"  aria-label="Default select example" 
                                                                  data-tr_id ="<?=$table_row_id?>"
                                                                  onchange="updateSalesPriority(this.value, <?php echo $data['lead_sales_id']; ?>,'lead_capacity' ,this)"> 
                                                                     <?php                                                                     
                                                                         $lead_capacity = [
                                                                             1,2,3,4,5,6,7,8,9,10
                                                                         ];
                                                                         foreach ($lead_capacity as $capacity) {
                                                                             $selected = ($capacity == $data['lead_capacity']) ? 'selected' : '';
                                                                             echo "<option value=\"$capacity\" $selected>$capacity</option>";
                                                                         }
                                                                     ?>                                                                    
                                                                 </select>
                                                             </td>
                                                             <td>
                                                                 <div class="actionBtns">
                                                                     <button><img src="../images/icons/editBlue.png" alt="" data-toggle="modal" data-target="#editDetailsModal" data-tr_id="<?=$table_row_id?>" onclick="editSalesRepcounty(<?php echo $data['lead_sales_id']; ?>,'<?php echo $data['country_name']; ?>','<?php echo $data['lead_capacity']; ?>','<?php echo $sales['state_name']; ?>',<?php $data['sales_priority']?>,'<?php echo $country_value['is_same'] ?>' ,this)" ></button> 
                                                                     
                                                                     <button class="delete_sale_leads" type="button" data-id_lead ="<?php echo $data['lead_sales_id']; ?>"><img src="../images/icons/deleteBlue.png" alt=""></button>
                                                                 </div>
                                                             </td>
                                                        </tr>

                                                         <?php 
                                                       }else{
                                                            $state_name_arr =  TblLeads::GetStateName($dragged_state)  ;
                                                          
                
                                                            $state_name = $state_name_arr['state_name'];
                                                            $country_name = $state_name_arr['country_name'];
                                                            $data_state = $dragged_state ;
                                                            $sql = "SELECT * FROM lead_sales Where state_name = '$dragged_state' Order by sales_priority";
                                                          
                                                            $state_data = Yii::app()->db->createCommand($sql)->queryAll(); 

                                                        ?>
                                                      

                                                     <?php
                                                       foreach($state_data as $key=>$data){
                                                            $user_details = TblLeads::getSalesPersonDetails($data['sales_name']); 
                                                            $table_row_id =  "sales_".$data['lead_sales_id'] ;
                                                           ?>
                                                             
                                                              <tr id="<?=$table_row_id?>"  data-tr_id ="<?=$table_row_id?>" class="sort_tr find_tr_row"  data-lead_id="<? echo $data['lead_sales_id'] ?>" data-country="<? echo $data['country_name']?>"  data-state="<? echo $data['state_name'] ?>">
                                                             <td class="drag_td_row"  data-tr_id ="<?=$table_row_id?>">
                                                                 <figure><img src="../images/icons/dragTable.png" alt="" class="iconImg"></figure>                                                                    
                                                             </td>
                                                             <td class="fullname"><?php echo $user_details['fullname'] ?  $user_details['fullname'] : ''  ; ?></td>

                                                             <td>
                                                                 <select  data-tr_id ="<?=$table_row_id?>"  class="form-select assignedTo text-left  state_select_ele" aria-label="Default select example" 
                                                                 onchange="updateSalesPriority(this.value, <?php echo $data['lead_sales_id']; ?>,'state_name' ,this)"
                                                                 >                                                                 
                                                                 <?php 
                                                                  if($country_value['is_same']==1){
                                                                     $country_name = 'USA';
                                                                     $sql_cust = "SELECT * FROM tbl_country WHERE country_name LIKE '$country_name'  ORDER BY state_name ASC; ";
                                                                     
                                                                  }else{

                                                                      $country_name = $data['country_name'];
                                                                      $sql_cust = "SELECT * FROM tbl_country WHERE country_name LIKE '%$country_name%'  ORDER BY state_name ASC; ";
                                                                  }

                                                                  $states = Yii::app()->db->createCommand($sql_cust)->queryAll();                                                                                

                                                                  foreach ($states as $stateName) {
                                                                      $state = $stateName['id'];
                                                          
                                                                      $selected = ($stateName['id'] == $data['state_name']) ? 'selected' : '';
                                                                      echo "<option value=\"$state\" $selected> ".$stateName['state_name']."</option>";
                                                                  }
                                                                   
                                                                 ?>
                                                                 </select>
                                                             </td>
                                                             <td>                                                        
                                                                 <select class="form-select assignedTo text-left sales_priority_select"  
                                                                 data-tr_id ="<?=$table_row_id?>" aria-label="Default select example" id="lead_canada" data-sales-id="<?php echo $data['lead_sales_id']; ?>" onchange="updateSalesPriority(this.value, <?php echo $data['lead_sales_id']; ?>,'sales_priority'  ,this)">
                                                                     <?php                                                                     
                                                                         $sales_priority = [
                                                                             1,2,3,4,5,6,7,8,9,10
                                                                         ];
                                                                         foreach ($sales_priority as $priority) {
                                                                             $selected = ($priority == $data['sales_priority']) ? 'selected' : '';
                                                                             echo "<option value=\"$priority\" $selected>$priority</option>";
                                                                         }
                                                                     ?>                                                                
                                                                 </select>
                                                             </td>
                                                             <td>
                                                                 <select class="form-select assignedTo text-left lead_capcity_select"  aria-label="Default select example" 
                                                                  data-tr_id ="<?=$table_row_id?>"
                                                                  onchange="updateSalesPriority(this.value, <?php echo $data['lead_sales_id']; ?>,'lead_capacity' ,this)"> 
                                                                     <?php                                                                     
                                                                         $lead_capacity = [
                                                                             1,2,3,4,5,6,7,8,9,10
                                                                         ];
                                                                         foreach ($lead_capacity as $capacity) {
                                                                             $selected = ($capacity == $data['lead_capacity']) ? 'selected' : '';
                                                                             echo "<option value=\"$capacity\" $selected>$capacity</option>";
                                                                         }
                                                                     ?>                                                                    
                                                                 </select>
                                                             </td>
                                                             <td>
                                                                 <div class="actionBtns">
                                                                     <button><img src="../images/icons/editBlue.png" alt="" data-toggle="modal" data-target="#editDetailsModal" data-tr_id="<?=$table_row_id?>" onclick="editSalesRepcounty(<?php echo $data['lead_sales_id']; ?>,'<?php echo $data['country_name']; ?>','<?php echo $data['lead_capacity']; ?>','<?php echo $data['state_name']; ?>',
                                                                     '<?=$data['sales_priority']?> ',' <?php echo $country_value['is_same'] ?>; ' ,this)" ></button> 
                                                                     
                                                                     <button class="delete_sale_leads" type="button" data-id_lead ="<?php echo $data['lead_sales_id']; ?>"><img src="../images/icons/deleteBlue.png" alt=""></button>
                                                                 </div>
                                                             </td>
                                                         </tr>
                                                              
                                                           <?php
                                                       }
                                                     ?>


                                          <? 

                                                       }
                                                         ?>