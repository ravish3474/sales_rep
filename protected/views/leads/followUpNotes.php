<? 
                        foreach($data as $key=>$value){
                              ?>
                                        <div class="notesItems">
                                        <ul>
                                            <li class="task">
                                                <p> <strong>Note <? echo $key +1?>:</strong>
                                                   <? echo $value['note'] ?>
                                                </p>
                                                <ul>
                                                 

                                                    <li><strong>on:</strong> <? echo date('d-M-Y' ,strtotime($value['created_at']))  ?> </li>
                                                    <li><strong>Time:</strong> <? echo date('H:i a' ,strtotime($value['created_at'])) ?> </li>
                                                    <li><strong>Deadline:</strong> <? echo date('d-M-Y' ,strtotime($value['status_update_date'])) ?></li>

                                                    <div class="chip greenBtn">
                                                         <? 
                                                            if($value['action_type'] == 'Schedule_Call'):
                                                                ?>
                                                                  <figure><img src="../../images/icons/callWhite.png" alt="" class="iconImg"></figure> <? echo date('M d' ,strtotime($value['created_at'])) ?>
                                                        
                                                                <? 
                                                            elseif($value['action_type'] =='Schedule_Video_Call'):
                                                                  ?>
                                                                      
                                                                          <figure><img src="../../images/icons/vedio.png" alt="" class="iconImg"></figure> <? echo(date('M d' ,strtotime($value['created_at']))) ?>
                                                                   
                                                                  <?
                                                            elseif($value['action_type'] =='Schedule_Message'):
                                                                  ?>
                                                                      
                                                                        <figure><img src="../../images/icons/mailWhite.png" alt="" class="iconImg"></figure> <? echo(date('M d' ,strtotime($value['created_at']))) ?>
                                                                     
                                                                  <?
                                                            endif ;
                                                         ?>
                                                     
                                                    </div>
                                                </ul>
                                            </li>

                                        </ul>
                                    </div>
                              <?
                        }

                    ?>