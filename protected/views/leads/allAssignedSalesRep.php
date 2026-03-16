
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
                                                                ?>
                                                                