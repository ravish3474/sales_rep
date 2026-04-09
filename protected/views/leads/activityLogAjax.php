<style>
  .heading_div{
  text-align: center;
  margin: 23px;
}
.heading_div span{
  background: aliceblue;
    padding: 6px;
    border-radius: 11px;
}
    .outer_div{
            background: #F9F9F9;
            height: max-content;
            width: 100%;
            border-radius: 2px;
            padding: 11px 15px;
            border-bottom: 1px dashed;     
            margin: 8px;
            overflow: hidden;
    }
    .notificationItems{
        gap: 35px;
    }
   .notificationItems .leftDay{
    padding: 5px;
    height: 30px;
    width: 30px;
  
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
   }
   .notificationItems .leftDay svg{ 
    fill: #fff;
   }

   .notificationItems .rightNote{
        font-size: 14px;
        color: #000;
   } 

   .notificationItems .time{
            margin-left: auto;
            font-size: 14px;
            color: #000;
    } 




</style>
<div>


<? 
  if(count($data)){
  foreach($data as $key=>$value){
      $Lead_name = Yii::app()->db->createCommand("SELECT name ,status  FROM tbl_leads Where lead_id = '".$value['lead_id']."'")->queryAll();
      $lead_details = $Lead_name[0];

      $status  = LEAD_STATUS[$lead_details['status']];

     // for add comment 
     if($value['action_type']==1){
        ?> 

          <div class="outer_div"  data-activity_id ="<?= $value['id'] ?>">
             <a href="<?php echo Yii::app()->createUrl('leads/viewSalesDetails', array('id' => $value['lead_id'])); ?>" target="_blank">
              <div class="notificationItems  d-flex" >
                  <div class="leftDay" style="background-color: #279AC3;">
                     <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256"><path d="M227.32,73.37,182.63,28.69a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H216a8,8,0,0,0,0-16H115.32l112-112A16,16,0,0,0,227.32,73.37ZM136,75.31,152.69,92,68,176.69,51.31,160ZM48,208V179.31L76.69,208Zm48-3.31L79.32,188,164,103.31,180.69,120Zm96-96L147.32,64l24-24L216,84.69Z"></path></svg>
                  </div>
                  <div class="rightNote">
                      <p> <? echo $lead_details['name']  ?> Edited successfully </p>
                  </div>

                  <div class="time"> 
                        <span><? echo date('d-m-Y' ,strtotime($value['created_at'])) ?></span><br>
                        <span> <? echo date('h:i A' ,strtotime($value['created_at'])) ?></span>
                   </div>
               </div>
             </a>
           </div>

        <?
     }elseif($value['action_type'] ==2){
        $assigned_sales_rep  = Yii::app()->db->createCommand("SELECT * FROM tbl_leads_multiple Where lead_id =".$value['lead_id']." AND DATE(created_at) = '".date('Y-m-d' ,strtotime($value['created_at']))."'")->queryAll();
        
           foreach($assigned_sales_rep  as $sale_key => $sale_value){
               $user_details = TblLeads::getSalesPersonDetails($sale_value['sale_rep']);
               ?>
              <div class="outer_div"  data-activity_id ="<?= $value['id'] ?>">
                 <a href="<?php echo Yii::app()->createUrl('leads/viewSalesDetails', array('id' => $value['lead_id'])); ?>" target="_blank">
                    <div class="notificationItems  d-flex">
                          <div class="leftDay"  style="background-color: #DE7213;">
                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24ZM74.08,197.5a64,64,0,0,1,107.84,0,87.83,87.83,0,0,1-107.84,0ZM96,120a32,32,0,1,1,32,32A32,32,0,0,1,96,120Zm97.76,66.41a79.66,79.66,0,0,0-36.06-28.75,48,48,0,1,0-59.4,0,79.66,79.66,0,0,0-36.06,28.75,88,88,0,1,1,131.52,0Z"></path></svg>
                          </div>
                          <div class="rightNote">
                              <p> <? echo $lead_details['name']  ?> Assigned  to @<?echo $user_details['fullname'] ?> </p>
                          </div>

                            <div class="time"> 
                                <span><? echo date('d-m-Y' ,strtotime($value['created_at'])) ?></span><br>
                                <span> <? echo date('h:i A' ,strtotime($value['created_at'])) ?></span>
                          </div>
                    </div>
                   </a>
                </div>
               <?
           }
         ?> 
          
        
         <?
     }elseif($value['action_type'] ==3){
           
        ?>
          <div class="outer_div"  data-activity_id ="<?= $value['id'] ?>">
             <a href="<?php echo Yii::app()->createUrl('leads/viewSalesDetails', array('id' => $value['lead_id'])); ?>" target="_blank">
                        <div class="notificationItems  d-flex">
                            <div class="leftDay"   style="background-color: #5C57EE;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256"><path d="M168,224a8,8,0,0,1-8,8H96a8,8,0,1,1,0-16h64A8,8,0,0,1,168,224Zm-24-88H127l23.7-35.56A8,8,0,0,0,144,88H112a8,8,0,0,0,0,16h17.05l-23.7,35.56A8,8,0,0,0,112,152h32a8,8,0,0,0,0-16Zm77.84,56A15.8,15.8,0,0,1,208,200H48a16,16,0,0,1-13.8-24.06C39.75,166.38,48,139.34,48,104a80,80,0,1,1,160,0c0,35.33,8.26,62.38,13.81,71.94A15.89,15.89,0,0,1,221.84,192ZM208,184c-7.73-13.27-16-43.95-16-80a64,64,0,1,0-128,0c0,36.06-8.28,66.74-16,80Z"></path></svg>
                            </div>
                            <div class="rightNote">
                                <p>Status of <? echo $lead_details['name']  ?> : changed to <? echo $status ?></p>
                            </div>

                                <div class="time"> 
                                <span><? echo date('d-m-Y' ,strtotime($value['created_at'])) ?></span><br>
                                    <span> <? echo date('h:i A' ,strtotime($value['created_at'])) ?></span>
                            </div>
                    </div>
               </a>
          </div>
        <?
     }elseif($value['action_type']==4){
       $comment  = Yii::app()->db->createCommand("SELECT comment FROM leads_comment Where lead_id = ".$value['lead_id']." AND created_at = '".$value['created_at']."'")->queryScalar();
      ?>
      <div class="outer_div"  data-activity_id ="<?= $value['id'] ?>">
          <a href="<?php echo Yii::app()->createUrl('leads/viewSalesDetails', array('id' => $value['lead_id'])); ?>" target="_blank">
      <div class="notificationItems  d-flex">
            <div class="leftDay" style="background-color: #3453ED;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256"><path d="M168,224a8,8,0,0,1-8,8H96a8,8,0,1,1,0-16h64A8,8,0,0,1,168,224Zm-24-88H127l23.7-35.56A8,8,0,0,0,144,88H112a8,8,0,0,0,0,16h17.05l-23.7,35.56A8,8,0,0,0,112,152h32a8,8,0,0,0,0-16Zm77.84,56A15.8,15.8,0,0,1,208,200H48a16,16,0,0,1-13.8-24.06C39.75,166.38,48,139.34,48,104a80,80,0,1,1,160,0c0,35.33,8.26,62.38,13.81,71.94A15.89,15.89,0,0,1,221.84,192ZM208,184c-7.73-13.27-16-43.95-16-80a64,64,0,1,0-128,0c0,36.06-8.28,66.74-16,80Z"></path></svg>
            </div>
            <div class="rightNote">
                <p>New Commented on <? echo $lead_details['name']  ?>  "<? echo $comment ?>" </p>
            </div>

              <div class="time"> 
                   <span><? echo date('d-m-Y' ,strtotime($value['created_at'])) ?></span><br>
                  <span> <? echo date('h:i A' ,strtotime($value['created_at'])) ?></span>
             </div>
     </div>
      </a>
      </div>
     <?php 
    
       }elseif($value['action_type']==5){
           $salesperson =  !empty($value['sales_rep']) ? TblLeads::getSalesPersonDetails($value['sales_rep']) : '' ; 
             if(!empty($salesperson['fullname'])):
           ?>
            <div class="outer_div"  data-activity_id ="<?= $value['id'] ?>">
                <a href="<?php echo Yii::app()->createUrl('leads/viewSalesDetails', array('id' => $value['lead_id'])); ?>" target="_blank">
                <div class="notificationItems  d-flex">
                <div class="leftDay" style="background-color: #3453ED;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256"><path d="M168,224a8,8,0,0,1-8,8H96a8,8,0,1,1,0-16h64A8,8,0,0,1,168,224Zm-24-88H127l23.7-35.56A8,8,0,0,0,144,88H112a8,8,0,0,0,0,16h17.05l-23.7,35.56A8,8,0,0,0,112,152h32a8,8,0,0,0,0-16Zm77.84,56A15.8,15.8,0,0,1,208,200H48a16,16,0,0,1-13.8-24.06C39.75,166.38,48,139.34,48,104a80,80,0,1,1,160,0c0,35.33,8.26,62.38,13.81,71.94A15.89,15.89,0,0,1,221.84,192ZM208,184c-7.73-13.27-16-43.95-16-80a64,64,0,1,0-128,0c0,36.06-8.28,66.74-16,80Z"></path></svg>
                </div>
                <div class="rightNote">
                <p>Unassigned <?= $salesperson['fullname']?? ''  ?> From   "<? echo $lead_details['name'] ?>" </p>
                </div>

                <div class="time"> 
                    <span><? echo date('d-m-Y' ,strtotime($value['created_at'])) ?></span><br>
                    <span> <? echo date('h:i A' ,strtotime($value['created_at'])) ?></span>
                </div>
                </div>
            </a>
            </div>
            

<?
endif;
       }
       
     ?>
    </div> 
    <?    
     }
  ?>
        
<?
 

  }else{
    ?>
     <div>No record found</div>
   <?
  }

?>



<div class="main_pagination_container d-flex align-items-center" style="justify-content: space-between;">
   
    
    <?php
        $buttonsPerPage = 5;
        $currentBlock = ceil($currentPage / $buttonsPerPage);
        $startPage = ($currentBlock - 1) * $buttonsPerPage + 1;
        $endPage = min($startPage + $buttonsPerPage - 1, $totalPages);
     ?>
     <?php if($endPage>1):?>
    <div class="pagination-container">
        <?php if ($currentPage > 1): ?>
            <!-- <button type="button" href="1" class="paginationBtns">First</button> -->
            <button type="button" href="<?= $currentPage - 1 ?>" class="paginationBtns">Previous</button>
        <?php else: ?>
            <span>First</span>
            <span>Previous</span>
        <?php endif; ?>

        <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
            <button type="button" href="<?= $i ?>" class="paginationBtns <?= $i == $currentPage ? 'active' : '' ?>">
                <?= $i ?>
            </button>
        <?php endfor; ?>

        <?php if ($endPage < $totalPages): ?>
            <p disable class=" dot_text">....</p>
            <button type="button" href="<?= $endPage + 1 ?>"  class="paginationBtns nextBlock">
               <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            </button>
        <?php endif; ?>

        <?php if ($currentPage < $totalPages): ?>
            <button type="button" href="<?= $currentPage + 1 ?>" class="paginationBtns">Next</button>
            <!-- <button type="button" href="<?= $totalPages ?>" class="paginationBtns">Last</button> -->
        <?php else: ?>
            <span>Next</span>
            <span>Last</span>
        <?php endif; ?>
    </div>
    <?endif?>

</div>

</div>