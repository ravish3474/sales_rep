<style>
    .active_crm{
        border-right: 5px solid #1ABB9C;
    }
    .active_crm .child_menu{
         display: block !important;
    }

    .nav.side-menu>li.active_crm>a {
        background: linear-gradient(#334556, #2C4257), #2A3F54;
        -webkit-box-shadow: rgba(0, 0, 0, 0.25) 0 1px 0, inset rgba(255, 255, 255, 0.16) 0 1px 0;
    }
</style>
<?php
    $uri = Yii::app()->request->requestUri; // or ->getPathInfo()
    $isDesignAdmin = strpos($uri, '/priceGuideV2/designadminShow') !== false;
    $isDesignShow  = strpos($uri, '/priceGuideV2/designShow') !== false;
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
.child_menu {
        display: none;
    }
    /* Highlight active parent */
    .side-menu > li.active > a {
        font-weight: bold;
        color: #007bff;
    }
    /* Highlight active child */
    .child_menu li.active > a {
        font-weight: bold;
        color: #28a745;
    }

    #sidebar-menu-deisgn .fa {
        width: 26px;
        opacity: .99;
        display: inline-block;
        font-family: FontAwesome;
        font-style: normal;
        font-weight: normal;
        font-size: 18px;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    #sidebar-menu-deisgn  span.fa {
        float: right;
        text-align: center;
        margin-top: 5px;
        font-size: 10px !important;
        min-width: inherit;
        color: #C4CFDA;
    }
</style>

<?php
if ((Yii::app()->user->getState('userGroup') == 7)){
?>
<div id="sidebar-menu-deisgn" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul  class="nav side-menu side-menu-design">
            <li class="<?php echo $isDesignShow ? 'active' : '';?>">
                <a><i class="fa fa-usd"></i> Price Guide <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" >
                    <?php
                    $sql_prod = " SELECT * FROM tbl_product ORDER BY sort ASC;";
                    $a_prod = Yii::app()->db->createCommand($sql_prod)->queryAll();

                    foreach ($a_prod as $key => $value) {
                        if ($value["enable"] == "1") {
                    ?>
                            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/designShow/product/<?php echo $value["prod_id"]; ?>"><?php echo $value["prod_name"]; ?></a></li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </li>
            <li class="<?php echo $isDesignAdmin ? 'active' : '';?>">
                <a><i class="fa fa-wrench" aria-hidden="true"></i>Edit Price Guide <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" >
                    <?php
                    foreach ($a_prod as $key => $value) {
                    ?>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/designadminShow/product/<?php echo $value["prod_id"]; ?>"><?php echo $value["prod_name"]; ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </li> 
        </ul>
    </div>           
</div>           
<?php
}else {            
?>

<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

    <div class="menu_section">
        <h3>General Menu</h3>
        <ul class="nav side-menu">
            
        <?php
            if ((Yii::app()->user->getState('userGroup') == 6)){
            ?>
            <li class="active">
                <a><i class="fa fa-usd"></i> Price Guide <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <?php
                    $sql_prod = " SELECT * FROM tbl_product ORDER BY sort ASC;";
                    $a_prod = Yii::app()->db->createCommand($sql_prod)->queryAll();

                    foreach ($a_prod as $key => $value) {
                        if ($value["enable"] == "1") {
                    ?>
                            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/show/product/<?php echo $value["prod_id"]; ?>"><?php echo $value["prod_name"]; ?></a></li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </li>
            <li id="quote_menu">
                <a><i class="fa fa-file-text"></i> Estimates <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none;">
                    <li id="menu_qnewrequest"><a href="<?php echo Yii::app()->request->baseUrl; ?>/quotation/newRequest">New Request<?php echo $s_alert_new; ?></a></li>
                    <li id="menu_qapprovelist"><a href="<?php echo Yii::app()->request->baseUrl; ?>/quotation/approveList">Approved<?php echo $s_alert_approve; ?></a></li>                    
                </ul>
            </li>
            <?php
            }else {                            
            ?>

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
             <? 
                    $is_view_details = false ; 
                    $cls =''; 

                    $id = empty($_GET['id']) ?  : $_GET['id']; 
                    if(Yii::app()->request->baseUrl.'/leads/viewSalesDetails/'.$id.'' ==  Yii::app()->request->getUrl()){
                        $is_view_details = true ;
                    } 
                     
                    
                    $state_name =  empty($_GET['state_name']) ?  : $_GET['state_name']; 
                    if(Yii::app()->user->getState('userGroup') == 2 ){
                        $base_url = '/leads/salesLeads?state_name=' . urlencode($state_name);
                    }else{
                        $base_url = '/leads/adminTeamLeads?state_name=' . urlencode($state_name);
                    }
                  
                    $current_url = Yii::app()->request->getUrl();
                    $normalized_current_url = urldecode($current_url);
                    $normalized_base_url = urldecode($base_url);
                    if (trim($normalized_current_url) == trim($normalized_base_url)) {
                        $is_view_details = true;
                        $cls = 'current-page';
                    }

  
                 ?>
                 <!-- If condition to hide the CRM  -->
                 <?php 
                //  if(Yii::app()->user->getState('userGroup') == 1){
                 ?>
              <li id="sales_crm" class="<? echo  $is_view_details ==1 ? 'active_crm  active' : ''?>">
                <a><i class="fa fa-cogs" aria-hidden="true"></i> CRM <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu "  style="display: none">
                 <? 
                    $user_name = Yii::app()->user->id; 
                    // echo $user_name ; 
                    

                      if(Yii::app()->user->getState('userGroup') == 2 && strtolower($user_name) != "dcote"):
                            ?>
                                <li id="menu_sales_dashboard"><a href="<?php echo Yii::app()->request->baseUrl; ?>/leads/dashboard"> Sales Dashboard</a></li>
                               
                                <li id="menu_sales_leads" class="<?=$cls?>"><a href="<?php echo Yii::app()->request->baseUrl; ?>/leads/salesLeads">My Leads</a></li>
                            <?php 
                      else:
                            ?>
                            
                            <li id="admin_sales_dashboard"> <a href="<?php echo Yii::app()->request->baseUrl; ?>/leads/adminDashboard"> Admin Dashboard</a> </li>
                            <li id="admin_sales_leads"> <a href="<?php echo Yii::app()->request->baseUrl; ?>/leads/adminLeads"> My Leads</a> </li>
                            <li id="admin_team_leads" class="<?=$cls?>"> <a href="<?php echo Yii::app()->request->baseUrl; ?>/leads/adminTeamLeads"> All Leads</a> </li>
                            <li id="admin_manage_sales"> <a href="<?php echo Yii::app()->request->baseUrl; ?>/leads/manageSales"> Manage Sales Rep.</a> </li>
                            <li id="admin_manage_sales"> <a href="<?php echo Yii::app()->request->baseUrl; ?>/leads/leadActivity"> Activity Log</a> </li>
                            <li id="admin_manage_country"> <a href="<?php echo Yii::app()->request->baseUrl; ?>/leads/manageCountry"> Manage Country</a> </li>


                            <?
                      endif ;
                    
                 ?>

                   
                </ul>
            </li>
            <? // } ?>

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
                    
                    $sql = "SELECT 
                                tbl_quote_doc.approve_status,
                                COUNT(DISTINCT tbl_quote_doc.qdoc_id) AS num_status
                            FROM 
                                tbl_quote_doc
                            LEFT JOIN 
                                user ON tbl_quote_doc.user_id = user.id
                            LEFT JOIN 
                                tbl_quote_item ON tbl_quote_doc.qdoc_id = tbl_quote_item.qdoc_id
                            WHERE 
                                tbl_quote_doc.enable = 1
                                AND tbl_quote_doc.archive = '0'
                                AND tbl_quote_item.enable = 1".$more_condition."
                            GROUP BY 
                                tbl_quote_doc.approve_status
                            ";

                    // $sql = " SELECT tbl_quote_doc.approve_status,COUNT(tbl_quote_doc.qdoc_id) AS num_status FROM tbl_quote_doc LEFT JOIN user ON tbl_quote_doc.user_id=user.id LEFT JOIN tbl_quote_item ON tbl_quote_doc.qdoc_id=tbl_quote_item.qdoc_id WHERE tbl_quote_doc.enable=1 AND tbl_quote_doc.archive='0' AND tbl_quote_item.enable=1".$more_condition." GROUP BY tbl_quote_doc.approve_status;";
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
                            
                              <li id="menu_qproduct"><a href="<?php echo Yii::app()->request->baseUrl; ?>/quotation/productPerformance">Product Performance</a></li>

                    <?php
                        }
                    ?>
                </ul>
            </li>
            <?php } ?>
            <?php
            if (Yii::app()->user->getState('userGroup') != 5) {
            ?>
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
                }
            ?> 
            <?php
            if (Yii::app()->user->getState('userGroup') != 4 && Yii::app()->user->getState('userGroup') != 3 && Yii::app()->user->getState('userGroup') != 5) {
            ?>
            <li id="order_list">
                <a><i class="fa fa-file-text" aria-hidden="true"></i> Orders <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                <?php 
                    if(Yii::app()->user->getState('userGroup') == 1 || Yii::app()->user->getState('userGroup') == 99){
                    ?>
                        <li id="menu_qnewrequest"><a href="<?php echo Yii::app()->request->baseUrl; ?>/order">Orders Import</a></li>
                    <?php
                     }
                    ?>
                    <li id="menu_qnewrequest"><a href="<?php echo Yii::app()->request->baseUrl; ?>/order/list">JOG Code <?php //echo date('Y'); ?></a></li>
                </ul>
            </li> 
            <?php
                }
            ?>          
            <?php
            if (Yii::app()->user->getState('userGroup') != 1 && Yii::app()->user->getState('userGroup') != 99 && Yii::app()->user->getState('userGroup') != 4 && Yii::app()->user->getState('userGroup') != 3 ) {
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
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/managebadges" ><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Manage Badges</a>
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
<?php
}
?>
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

 $(document).ready(function () {
    // Show child_menu of active parent on page load
    $(".side-menu-design li.active > .child_menu").show();

    // Handle parent click
    $(".side-menu-design > li > a").click(function (e) {
        e.preventDefault();

        let parentLi = $(this).parent("li");

        if (parentLi.hasClass("active")) {
            // Collapse if already active
            parentLi.removeClass("active").children(".child_menu").slideUp();
        } else {
            // Collapse all others
            $(".side-menu-design > li").removeClass("active").children(".child_menu").slideUp();

            // Expand clicked one
            parentLi.addClass("active").children(".child_menu").slideDown();
        }
    });

    // Handle child click
    $(".child_menu li > a").click(function () {
        // Remove active from all child items
        $(".child_menu li").removeClass("active");
        // Add active to clicked child
        $(this).parent("li").addClass("active");
    });
});
</script>