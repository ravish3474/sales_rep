
                                                            <?php
                                                               $get_person = [];
                                                       
                                                                  foreach ($salesPerson as $key => $value) { 
                                                                    $all_data = TblLeads::FindSalesRep($value['username'] ,$lead_id);
                                                                    $get_person = $all_data['data'];
                                                                    $data_multiple_id = !empty($get_person) ? $get_person['id'] : '';
                                                                    $lead_Details = Yii::app()->db->createCommand("SELECT *  FROM tbl_leads where lead_id = '$lead_id' AND assigned_to ='".$value['username']."'")->queryRow();

                                                                    $main_id = empty($lead_Details) ? 0  :$lead_Details['lead_id'];
                                                                    ?>
                                                                  
                                                                    <label for="<? echo $value['username'] ?>"  class="checkbox-label">
                                                                    <? echo $value['fullname']?> 
                                                                    <? echo $loggedIn == $value['username'] ? '(Me)' : '' ?>
                                                                      <input type="checkbox" id="<? echo  $value['username'] ?>" class="checkbox-button sales_rep_checkbox"  value="<? echo $value['username']?>"
                                                                      <?php echo in_array($value['username'], $multiple_sales) || $assigned_to==$value['username'] ? 'checked' : ''; ?> 
                                                                        data-multiple_id = "<?=$data_multiple_id?>"
                                                                        data-main_id = "<?=$main_id?>"
                                                                      >
                                                                  
                                                                      </label>

                                                                     <?                                  
                                                                    }

                                                                         $is_other_checked = false ;
                                                                          $name = ""; 
                                                                          $email =""; 
                                                                          $is_sent_mail = false ; 
                                                                          $other_id =0; 
                                                                          if(!empty($OtherDetails)){
                                                                              $is_other_checked = true ; 
                                                                              $name = $OtherDetails['sale_rep']; 
                                                                              $email = $OtherDetails['other_email'] ; 
                                                                              $is_sent_mail = $OtherDetails['is_sent_mail'] ; 
                                                                              $other_id = $OtherDetails['id']; 
                                                                          }
                                                                ?>
                                                                

                                                                   <div class="other_bottom_section">
                                                                     
                                                                        <label for="others" class="checkbox-label" >Others

                                                                          <input type="checkbox" name="" id="other_checkbox" value="" class="checkbox-button"  <?= $is_other_checked ? "checked" :"" ?> >

                                                                        </label>

                                                                          <div class="row d-flex w-90 gap2 <?=$is_other_checked ? "" : "d-none"?>" id="other_sales_person_div" style="padding:5px;" > 
                                                                                <input type="text" name="" id="other_sales_person_name" placeholder="Enter Name" style="width: 124px;" value="<?= $name ?>">
                                                                                <div style="background-color: #fff; padding-right:5px;">
                                                                                  <input type="email" name="" id="other_sales_person_email" placeholder="Enter Email" style="width: 200px; border: none !important; background: none !important;" value="<?= $email ?>" >
                                                                                  <input type="checkbox" name="" id="is_send_email" <?= $is_sent_mail ?  'checked' :"" ?> title="Send Mail" >
                                                                                  
                                                                                </div>
                                                                                <input type="hidden" name="" id="other_sales_id" value="<?= $other_id ?>">
                                                                          </div>
                                                                     </div>
                                                                