<?php
    $view = null;
    if (Yii::app()->user->hasState('tblType')) {
        $view = Yii::app()->user->getState('tblType');
    }

    /*$general['hockeyLine'] = "Hockey Line";
    $general['tracksuits'] = "Tracksuits";
    $general['hoodies']    = "Hoodies-Perf. Jackets";
    $general['tshirts']    = "T-Shirts";
    $general['polo']       = "Polo's";
    $general['baseball']   = "Baseball";
    $general['basketball'] = "Basketball";
    $general['soccer']     = "Soccer";
    $general['volleyball'] = "Volleyball / Track & Field";
   

    $management['showHockeyLine'] = "Hockey Line";
    $management['showTracksuits'] = "Tracksuits";
    $management['showHoodies']    = "Hoodies-Perf. Jackets";
    $management['showTshirts']    = "T-Shirts";
    $management['showPolo']       = "Polo's";
    $management['showBaseball']   = "Baseball";
    $management['showBasketball'] = "Basketball";
    $management['showSoccer']     = "Soccer";
    $management['showVolleyball'] = "Volleyball / Track & Field";*/
	
?>
<style type="text/css">
.alert_app_sta{
    float:right; 
    background-color:#993; 
    color:#FFF; 
    border:2px solid rgba(187, 187, 85, .5); 
    border-radius:15px;
    min-width: 18px;
    font-size: 10px;
    font-weight: bold;
    text-align: center;
}
</style>
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

    <div class="menu_section">
        <h3>General Menu</h3>
        <ul class="nav side-menu">
            
            <li class="active">
                <a><i class="fa fa-usd"></i> Price Guide <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <?php
                    $sql_prod = " SELECT * FROM tbl_product ORDER BY sort ASC;";
                    $a_prod = Yii::app()->db->createCommand($sql_prod)->queryAll();

                        foreach ($a_prod as $key => $value) {
                            if($value["enable"]=="1"){
                    ?>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/show/product/<?php echo $value["prod_id"]; ?>"><?php echo $value["prod_name"]; ?></a></li>
                    <?php
                            }
                        }
                    ?>
                </ul>
            </li>
			<?php if(Yii::app()->user->getState('userGroup') == 2 && Yii::app()->user->getState('userKey')!=44 /*|| (Yii::app()->user->getState('userGroup') == 99 || Yii::app()->user->getState('userGroup') == 1)*/){ ?>
            <li>
                <a><i class="fa fa-calculator" aria-hidden="true"></i>Commission Calculator<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
					<?php /*if(Yii::app()->user->getState('userGroup') == 99 || Yii::app()->user->getState('userGroup') == 1){ ?>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/">Fiscal Year</a></li>
					
					<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/ShowFiscalYearInvoice">Invoice</a></li>
					<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/SalesOrdersAll">Sales Orders</a></li>
					<?php }elseif(Yii::app()->user->getState('userGroup') == 2){*/ ?>
					 <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/">Invoice</a></li>
					 <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/SalesOrders">Sales Orders</a></li>
					<?php //} ?>
					
                </ul>
            </li>
			<?php } ?>
			<li>
                <a><i class="fa fa-file-text-o" aria-hidden="true"></i> Documents <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/documents/upload">Upload</a></li>
                </ul>
            </li>
			<li>
                <a><i class="fa fa-download"></i> Download <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/docs/">Documents</a></li>
                </ul>
            </li>
            <?php if(Yii::app()->user->getState('userGroup') == 2 || (Yii::app()->user->getState('userGroup') == 99 || Yii::app()->user->getState('userGroup') == 1)){ 

                    $user_group = Yii::app()->user->getState('userGroup');
                    $user_id = Yii::app()->user->getState('userKey');

                    $more_condition = "";
                    if( $user_group!="1" && $user_group!="99" ){
                    
                        $more_condition = " AND tbl_quote_doc.user_id='".$user_id."' ";
                    }

                    $sql = " SELECT tbl_quote_doc.approve_status,COUNT(tbl_quote_doc.qdoc_id) AS num_status FROM tbl_quote_doc LEFT JOIN user ON tbl_quote_doc.user_id=user.id WHERE tbl_quote_doc.enable=1 AND tbl_quote_doc.archive='0' ".$more_condition." GROUP BY tbl_quote_doc.approve_status;";
                    $quote_status = Yii::app()->db->createCommand($sql)->queryAll();
                    $a_app_status["new"] = 0;
                    $a_app_status["approve"] = 0;
                    $a_app_status["reject"] = 0;
                    foreach($quote_status as $tmp_key => $row_qstatus){
                        $a_app_status[($row_qstatus["approve_status"])] = $row_qstatus["num_status"];
                    }

                    $s_alert_new = '';
                    if($a_app_status["new"]>0){
                        $s_alert_new = '<div class="alert_app_sta">'.$a_app_status["new"].'</div>';
                    }
                    $s_alert_approve = '';
                    if($a_app_status["approve"]>0){
                        $s_alert_approve = '<div class="alert_app_sta">'.$a_app_status["approve"].'</div>';
                    }
                    $s_alert_reject = '';
                    if($a_app_status["reject"]>0){
                        $s_alert_reject = '<div class="alert_app_sta">'.$a_app_status["reject"].'</div>';
                    }

                    if( $user_group!="1" && $user_group!="99" ){
                        $more_condition .= " AND tbl_quote_doc.is_editing='2' ";
                    }else{
                        $more_condition .= " AND tbl_quote_doc.is_editing='1' ";
                    }

                    $sql2 = " SELECT COUNT(tbl_quote_doc.qdoc_id) AS num_redit FROM tbl_quote_doc LEFT JOIN user ON tbl_quote_doc.user_id=user.id WHERE tbl_quote_doc.enable=1 AND tbl_quote_doc.archive='1' ".$more_condition.";";
                    $a_edit_alert = Yii::app()->db->createCommand($sql2)->queryAll();
                    $num_redit = $a_edit_alert[0]["num_redit"];

                    $s_alert_redit = '';
                    if($num_redit>0){
                        $s_alert_redit = '<div class="alert_app_sta">'.$num_redit.'</div>';
                    }

                
            ?>
            <li id="quote_menu">
                <a><i class="fa fa-file-text"></i> Estimates <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none;">
                    <li id="menu_qnewrequest"><a href="<?php echo Yii::app()->request->baseUrl; ?>/quotation/newRequest">New Request<?php echo $s_alert_new; ?></a></li>
                    <li id="menu_qapprovelist"><a href="<?php echo Yii::app()->request->baseUrl; ?>/quotation/approveList">Approved<?php echo $s_alert_approve; ?></a></li>
                    <li id="menu_qrejectlist"><a href="<?php echo Yii::app()->request->baseUrl; ?>/quotation/rejectList">Rejected<?php echo $s_alert_reject; ?></a></li>
                    <li id="menu_qarchived"><a href="<?php echo Yii::app()->request->baseUrl; ?>/quotation/archived">Archived<?php echo $s_alert_redit; ?></a></li>
                    <li id="menu_qcompany"><a href="<?php echo Yii::app()->request->baseUrl; ?>/quotation/company">Company</a></li>
                    <li id="menu_qcustomer"><a href="<?php echo Yii::app()->request->baseUrl; ?>/quotation/customer">Customer</a></li>
                    <?php
                        if (Yii::app()->user->getState('userGroup') == 1 || Yii::app()->user->getState('userGroup') == 99 ) {
                    ?>
                            <li id="menu_qcommreport"><a href="<?php echo Yii::app()->request->baseUrl; ?>/quotation/commReport">Comm. Report</a></li>
                    <?php
                        }
                    ?>
                </ul>
            </li>
            <?php } ?>
            <li id="fresh_quote">
                <a><i class="fa fa-file-text" aria-hidden="true"></i> Quotations <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li class="cpage"><a href="<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate">New Quotations</a></li>
                    <?php
                    if (Yii::app()->user->getState('userGroup') != 1 && Yii::app()->user->getState('userGroup') != 99 ) {
                    ?>
                    <li class="cpage"><a href="<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/archived">Archived Quotations</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </li>
            <?php
            if (Yii::app()->user->getState('userGroup') != 1 && Yii::app()->user->getState('userGroup') != 99 ) {
            ?>
            <li><a><i class="fa fa-wrench"></i>Templates Library <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <?php
                        foreach ($a_prod as $key => $value) {
                    ?>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/userShow/product/<?php echo $value["prod_id"]; ?>"><?php echo $value["prod_name"]; ?></a></li>
                    <?php
                        }
                    ?>
                </ul>
            </li>
            <?php
            }
            ?>
        </ul>
    </div>
    <?php
        if ((Yii::app()->user->getState('userGroup') == 1 || Yii::app()->user->getState('userGroup') == 99) && Yii::app()->user->getState('userKey')!=44 ) {
    ?>
    <div class="menu_section">
        <h3>Management Menu</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-wrench"></i>Edit Price Guide <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <?php
                        foreach ($a_prod as $key => $value) {
                    ?>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/adminShow/product/<?php echo $value["prod_id"]; ?>"><?php echo $value["prod_name"]; ?></a></li>
                    <?php
                        }
                    ?>
                </ul>
            </li>
			<li>
                <a><i class="fa fa-calculator" aria-hidden="true"></i>Commission Calculator<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/FiscalYear">Fiscal Year</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/FiscalYearInvoice">Invoice</a></li>
					<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/SalesOrdersAll">Sales Orders</a></li>
                </ul>
            </li>
            <li>
                <a><i class="fa fa-upload"></i> Upload <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/docs/upload">Documents</a></li>
                </ul>
            </li>
            <li>
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/user/userManagement"><i class="fa fa-user"></i> User Management</a>
            </li>
            <li>
                <a href="#" onclick="showAdminPanel();"><font color="yellow"><i class="fa fa-cog"></i> Administrator Panel</font></a>
            </li>
            
        </ul>
    </div>
    <?php
        }
    ?>
</div>
<script type="text/javascript">
<?php

$s_controller = strtolower(Yii::app()->controller->id);
$s_method = strtolower(Yii::app()->controller->action->id);

if($s_controller=="quotation"){
?>

setTimeout(function() {
    $('#quote_menu').addClass("active");
    $('#quote_menu ul').css("display","block");
    $('#menu_q<?php echo $s_method; ?>').addClass("current-page");
}, 500);

<?php
}

if($s_controller!="quoteEstimate"){
?>

setTimeout(function() {
    $('#fresh_quote').removeClass("active");
    $('#fresh_quote ul').css("display","none");
    $('.cpage').removeClass("current-page");
}, 500);

<?php
}
?>
    
function showAdminPanel(){

    $.ajax({  
        type: "POST",  
        dataType: "html", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/adminPanel" ,
        success: function(resp){ 

            $('#content').html(resp);

        }  
    });
}
</script>