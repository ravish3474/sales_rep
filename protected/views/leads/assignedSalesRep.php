                                                
                                                <?  
                                                if(!empty($salesPerson['assigned_to']) || count($data)){
                                                   $loggedIn = Yii::app()->user->getId(); 
                                                   $default_per = TblLeads::getSalesPersonDetails($salesPerson['assigned_to']);
                                                   if(!empty($salesPerson['assigned_to']) && !empty($default_per)){
                                                   ?>
                                                    
                                                    <div class="adminItems">
                                                        <h6 class="adminName"><? echo $default_per['fullname'] ?> 
                                                          <? echo $loggedIn == $salesPerson['assigned_to'] ? '(Me)' :'' ?>
                                                        </h6>
                                                            
                                                          <?
                                                           $NewUser = strtolower(Yii::app()->user->id);
                                                          if(Yii::app()->user->getState('userGroup')!=2 || $NewUser=='dcote'){
                                                        ?> 
                                                            <button class="actionBtns deleteSalesRep" 
                                                           
                                                            data-salesPerson = "<?= $salesPerson['assigned_to'] ?>"
                                                            data-lead_id ="<? echo $salesPerson['lead_id'] ?>">
                                                            <figure><img src="../../images/icons/removeAdmin.png" alt=""></figure>
                                                          </button>
                                                        </div>
       
                                                   <?}
                                                   }
                                                     if(count($data)):
                                                     foreach($data as $key=>$value){
                                                      $sales_rep = TblLeads::getSalesPersonDetails($value['sale_rep']);
                                                       if(!empty($sales_rep)):
                                                    ?>
                                                        <div class="adminItems">
                                                        <h6 class="adminName"><? echo $sales_rep['fullname'] ?> 
                                                          <? echo $loggedIn == $value['sale_rep'] ? '(Me)' :'' ?>
                                                        </h6>
                                                            <button class="actionBtns deleteSalesRep" data-multiple-id="<? echo $value['id'] ?>" 
                                                            data-salesPerson = "<? echo $value['sale_rep']  ?>"
                                                            data-lead_id ="<? echo $value['lead_id'] ?>">
                                                            <figure><img src="../../images/icons/removeAdmin.png" alt=""></figure>
                                                        </button>
                                                        </div>

 
                                                    <? endif;}
                                                 endif; }else{
                                                    ?>
                                                     <h5>No sales rep found</h5>
               
                                                  <?
                                                }
                                              
                                                ?>
                                             
