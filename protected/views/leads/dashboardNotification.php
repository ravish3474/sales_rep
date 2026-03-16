<? 
foreach($notification as $key=>$value){
    $lead_details = Yii::app()->db->createCommand("SELECT * FROM tbl_leads Where lead_id = '".$value['lead_id']."'")->queryRow();
    

    ?>          
    <div class="d-flex ">
    <div class="notificationItems <? echo $value['status'] == 1 ?  'readNotification' : 'unreadNotification' ?> ">

        <label class="leftDay cursor">
            <input type="checkbox" class="select-item select_notification" value="<?php echo $value['id']; ?>" />
            <span></span> <!-- Span here if you want some extra styling or space for the checkbox -->
            <h6><?php echo date('d', strtotime($value['created_at'])); ?></h6>
            <h5><?php echo date('M', strtotime($value['created_at'])); ?></h5>
        </label>


        <a href="<?php echo Yii::app()->createUrl('leads/viewSalesDetails', array('id' => $value['lead_id'])); ?>" class="rightNote">
            <p>New Comment on [<? echo $lead_details['name'] ?>]: "<? echo $value['sales_rep'] ?> commented: '<? echo $value['comment'] ?>'"</p>
        </a>
    </div>
</div>
    <?
}
?>