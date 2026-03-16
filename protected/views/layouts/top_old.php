<style type="text/css">
#cart_inner{
    max-height: 450px;
    overflow-y: scroll;
}
.tbl-cart-info{
    width: 98%;
    margin: 5px;
}
.tbl-cart-info th{
    background-color: #AFA;
    outline: 1px solid #DDD;
    padding:2px;
}
.tbl-cart-info td{
    font-size: 11px;
    word-wrap:break-word;
    vertical-align: middle;
    background-color: #FFF;
    outline: 1px solid #DDD;
    text-align: left;
    padding:2px;
}
.tbl-cart-info tr:hover td{
    background-color: #EEE;
}
.tbl-addi-info th{
    background-color: #AAF;
    outline: 1px solid #DDD;
    padding:5px;
    color: #000;
}
.tbl-addi-info td{
    font-size: 11px;
    word-wrap:break-word;
    vertical-align: middle;
    background-color: #FFF;
    outline: 1px solid #DDD;
    text-align: left;
    padding:2px;
}
.tbl-addi-info tr:hover td{
    background-color: #EEE;
}

.addi-btn{
    padding: 2px 5px; 
}
#quote_head{
    border-bottom: 2px solid #EEE;
    padding-bottom: 0px;
}
#quote_head img{
    max-height: 180px;
    max-width: 180px;
}
#quote_head h2{
    font-size: 28px;
    font-weight: bold;
    color: #000;
}
#quote_head pre, #quote_body pre{
    font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;
    border:0px;
    background-color: #FFF;
    font-size: 14px;
    color: #000;
    line-height: 1;
    margin: 0px;
}
.est_zone th{
    text-align: right;
    color: #000;
}
.est_zone td{
    text-align: left;
    color: #000;
    padding-left: 10px;
}
.item_zone{
    color: #000;
}
.item_zone th{
    font-size: 15px;
}
.item_zone td{
    font-size: 13px;
}
.total_zone td{
    padding: 10px 0px; 
}

.move_btn{
    cursor: pointer;
    font-size: 16px;
    color: #772;
}
.bell .dropdown-toggle:focus { background-color: transparent
</style>

<?php
$user_group = Yii::app()->user->getState('userGroup');
$user_id = Yii::app()->user->getState('userKey');
$full_name =Yii::app()->user->getState('fullName');
if ($user_group=="99" || $user_group=="1") {
    $chat_type = "A";
}
else{
    $chat_type = "E";
}
?>
<div class="top_nav">

    <div class="nav_menu">
        <nav class="" role="navigation">
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">

                <li class="">
                    <?php
                    $b_show_exit = false;

                    $s_controller = strtolower(Yii::app()->controller->id);
                    $s_method = strtolower(Yii::app()->controller->action->id);
                    //echo "<pre>"; echo $s_controller; echo "</pre>";
                    if( $s_controller=="priceguide" || ( ($s_controller=="priceguidev2") && (!in_array($s_method, array("adminshow","adminshowextra","adminpanel") )) ) ){

                        if(isset($_COOKIE["JOG_CART_Quote"])){

                            $b_show_exit = true;
                            $obj_quote = json_decode($_COOKIE["JOG_CART_Quote"]);
                            ?>
                            <button title="Quotation Add items mode" class="btn btn-warning" style="float: left; margin-right: -50px; margin-left: -230px !important; margin-top: 10px; font-size: 16px;" data-toggle="modal" data-target="#showItemAddedModal" onclick="showItemAddMode(<?php echo $obj_quote->qdoc_id; ?>);">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                (<span id="sp_sum_total_edit"><?php echo $obj_quote->num_item; ?></span>) <?php echo $obj_quote->est_number; ?>
                            </button>
                            <input type="hidden" id="qdoc_id_editing" value="<?php echo $obj_quote->qdoc_id; ?>">
                            <input type="hidden" id="after_approved_editing" value="<?php echo $obj_quote->edit_after_approved; ?>">
                            <?php

                        }else{

                            $sum_total = 0;
                            if(isset($_COOKIE["JOG_CART_info"]) && $_COOKIE["JOG_CART_info"]!=""){

                                $sql_select = " SELECT * FROM tbl_cart_temp WHERE cart_tmp_id='".$_COOKIE["JOG_CART_info"]."'; ";
                                $a_tmp_obj = Yii::app()->db->createCommand($sql_select)->queryAll();
                                if(sizeof($a_tmp_obj)>0){
                                    $s_tmp_obj = base64_decode($a_tmp_obj[0]["obj_tmp"]);

                                    $obj_cart_info = json_decode($s_tmp_obj);
                                    //$obj_cart_info = json_decode($_COOKIE["JOG_CART_info"]); 
                                    
                                    $a_tmp_item = (array)$obj_cart_info->item;

                                    $sum_total = sizeof($a_tmp_item);
                                }
                            }
                            /*if(isset($_COOKIE["JOG_CART_extra"])){
                                $obj_cart_extra = json_decode($_COOKIE["JOG_CART_extra"]); 

                                $a_cart_extra = (array)$obj_cart_extra->data;
                                
                                $sum_total += sizeof($a_cart_extra);
                            }*/
                            ?>
                             <button class="btn btn-primary" style="float: left; margin-right: -50px; margin-left: -175px !important; margin-top: 10px; width: 100px; font-size: 16px;" data-toggle="modal" data-target="#cartV2Modal" onclick="showCartV2(1);">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                (<span id="sp_sum_total"><?php echo $sum_total; ?></span>)
                            </button>
                            <input type="hidden" id="after_approved_editing" value="no">
                            <?php
                        }
                    }
                    ?>
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/jog_athl.png" alt=""><?php echo Yii::app()->user->getState('fullName'); ?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                        <li><a href="#" data-toggle="modal" data-target="#profileModal" id="profile-top" user-key="<?php echo Yii::app()->user->getState('userKey'); ?>">  Profile</a>
                        </li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/site/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                        </li>
                    </ul>

                </li>
                <li class="dropdown bell">
            <a href="#" class="dropdown-toggle inbox" data-toggle="dropdown">
              <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-ios7-bell-outline-128.png" height="30" width="30" class=" avatar-img img-square">
              <?php
              $user_id = Yii::app()->user->getState('userKey');
              $noti_sql = "SELECT COUNT(*) as total_noti FROM notifications WHERE employee_id='$user_id' AND noti_status='0'";
              $noti_quoute = Yii::app()->db->createCommand($noti_sql)->queryAll();
              if($noti_quoute[0]['total_noti']!=0){
              ?>
              <span class="badge badge-notify noti_main"><?=$noti_quoute[0]['total_noti']?></span>
          <?php } ?>
            </a>
            <ul class="dropdown-menu bell" style="overflow-y: scroll;height: 400px;" role="menu">
                <?php
                $noti_sql = "SELECT noti_id,user.fullname AS from_emp_name,tbl_quote_doc.est_number AS est_num,notifications.doc_id as doc_id,notifications.noti_date as noti_date,noti_status FROM notifications JOIN tbl_quote_doc ON tbl_quote_doc.qdoc_id=notifications.doc_id JOIN user ON user.id=notifications.noti_from_employee WHERE notifications.employee_id='$user_id' ORDER BY notifications.noti_date DESC";
                $noti_quoute = Yii::app()->db->createCommand($noti_sql)->queryAll();
                foreach ($noti_quoute as $noti_data) {
                ?>
              <li style="display: flex;" id="noti_id_<?=$noti_data['noti_id']?>">
                <input type="checkbox" title="Mark Read" noti_id="<?=$noti_data['noti_id']?>" class="noti_checkbox" <?php
                if ($noti_data['noti_status']==1) {
                    echo "checked";
                }
                ?> style="margin-top: 15px;margin-left: 10px;">
                <a href="javascript:void(0);" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotation(<?=$noti_data['doc_id']?>,'vp');"><span class="label label-warning"><?=$noti_data['noti_date']?></span><span class="notify-link">  <?=$noti_data['from_emp_name']?> Commented on Estimate Number <?=$noti_data['est_num']?></span></a>
                <span class="glyphicon glyphicon-trash noti_delete" noti_id="<?=$noti_data['noti_id']?>" title="Delete Notification" style="margin-top:12px;margin-right: 10px "></span>
              </li>
              <li class="divider"></li>
          <?php } ?>
              <li>
                <div class="container text-center">
                    <button class="btn btn-primary mark_all_noti">Mark All Read</button>
                    <button class="btn btn-primary delete_all_noti">Delete All</button>
                </div>
              </li>
            </ul>
          </li>

            </ul>


        </nav>
    </div>
    <!-- <pre id="test_msg"></pre> -->
</div>

<script>
$(document).ready(function(){
    $(".noti_checkbox").change(function() {
        var noti_id = $(this).attr('noti_id');
        var noti_status = 0;
        if(this.checked) {
            noti_status = 1;
        }
        $.ajax({
            type:'POST',
            data:{
                noti_id:noti_id,
                noti_status:noti_status
            },
            url:'<?php echo Yii::app()->request->baseUrl; ?>/quotation/markNoti',
            success:function(response){
                var response = JSON.parse(response);
                if (response.status="success") {
                    $('.noti_main').text(response.msg);
                }
                else{
                    alert('Something Went Wrong');
                }
            }
        })
    });
})

$(document).on('click','.noti_delete',function(){
    var noti_id = $(this).attr('noti_id');
    $.ajax({
        type:'POST',
        data:{
            noti_id:noti_id
        },
        url:'<?php echo Yii::app()->request->baseUrl; ?>/quotation/deleteSingleNoti',
        success:function(response){
            var response = JSON.parse(response);
            if (response.status="success") {
                $('.noti_main').text(response.msg);
                $('#noti_id_'+noti_id).remove();
            }
            else{
                alert('Something Went Wrong');
            }
        }
    })
})

function viewQuotation(qdoc_id,action_from){

    $('#main_qdoc_id').val(qdoc_id);
    $('#view_doc_id').val(btoa(qdoc_id));
    $('#quote_approve_bar').show();

    $('#d_quote_body').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');

    $('#head_selector_app').hide();
    $('#btn_approve').hide();
    $('#btn_reject').hide();
    $('#btn_print').hide();
    $('#btn_refresh_date').hide();
    $('#d_quote_below').hide();
    $('#sp_remark').hide();

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/showQuoteView" ,
        data:{
            "qdoc_id":qdoc_id,
            "action_from":action_from
        },
        success: function(resp){ 
            $('#d_quote_body').html(resp.inner_content); 

            $('#quote_history').hide();
            
            $('#d_approval_comment').html(window.atob(resp.approval_comment));

            if(resp.show_approve=="yes"){
                $('#btn_approve').show();
                $('#d_quote_below').show();
                $('#sp_remark').show();
                //$('.subnvat').hide();

                if(action_from=='va'){
                    $('#head_selector_app').show();
                    $('#head_selector_app').val(resp.comp_id);
                    $('#note_text').val(window.atob(resp.qnote_text));
                    changeQuoteHeadApp();
                }

                //alert(resp.history_inner);
                if(resp.history_inner!=""){
                    $('#quote_history').show();
                    $('#select_history').html(resp.history_inner);
                }
                
            }
            if(resp.show_reject=="yes"){
                $('#btn_reject').show();
                $('#sp_remark').show();
            }
            if( resp.show_print=="yes" ){
                //if(action_from=="vp"){
                    $('#btn_print').show();
                    $('#btn_refresh_date').show();
                //}
                
            }

                $.ajax({
        type:'POST',
        data:{
            chat_type:"<?=$chat_type?>",
            doc_id:qdoc_id,
            emp_id:"<?=$user_id?>",
        },
        url:'<?php echo Yii::app()->request->baseUrl; ?>/quotation/fetchChats',
        success:function(response){
            var response = JSON.parse(response);
            if (response.status==1) {
                var html = '';
                html = atob(response.msg);
                $('#d_approval_comment').append(html);
            }
        }
    })

                $.ajax({
                    type:'POST',
                    data:{
                        doc_id:qdoc_id
                    },
                    url:'<?php echo Yii::app()->request->baseUrl; ?>/quotation/fetchSalesNotes',
                    success:function(response){
                        
                        var response = JSON.parse(response);
                        if (response.status=="0") {
                            $('#notes_modal_div').hide();
                        }
                        else{
                            $('#pre_sale_note_modal').html(response.note);
                            $('#notes_modal_div').show();
                        }
                    }
                })

        }  
    });
}

$(document).on('click','.delete_all_noti',function(){
    $.ajax({
        type:'GET',
        url:'<?php echo Yii::app()->request->baseUrl; ?>/quotation/DeleteAllNoti',
        success:function(response){
            var response  = JSON.parse(response);
            if (response.result=="success") {
                $('.dropdown-menu').empty();
                $('.badge-notify').hide();
            }
            else{
                alert(response.result);
            }
        }
    })
})

$(document).on('click','.mark_all_noti',function(){
    $.ajax({
        type:'GET',
        url:'<?php echo Yii::app()->request->baseUrl; ?>/quotation/MarkAllNoti',
        success:function(response){
            var response  = JSON.parse(response);
            if (response.result=="success") {
                $('.badge-notify').hide();
            }
            else{
                alert(response.result);
            }
        }
    })
})
</script>
<script type="text/javascript">
    $(document).on('click','#reply_btn',function(){
        $(this).hide();
        $('#reply_to_comment').show();
    })

    $(document).on('click','#cancel_btn',function(){
        $('#reply_to_comment').hide();
        $('#reply_btn').show();
    })

    $(document).on('submit','#reply_to_comment',function(e){
        e.preventDefault();
        var form = $(this);
        var formData = new FormData(form[0]);
        var text = $('#text_comment').val();
        $.ajax({
            type:'POST',
            data:formData,
            processData:false,
            contentType:false,
            url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/AddChat" ,
            success:function(response){
                var response = JSON.parse(response)
                if (response.result=="success") {
                var html = '';
                html = '<div><center><pre class="alert" style="text-align:right; width:100%; height:100%; max-width:900px; overflow-x:auto; color:#FFF; background-color:#990;">'+text+'</pre></center></div>'
                $('#d_approval_comment').append(html);
                $('#text_comment').val("");
                }
                else{
                    alert(response.result);
                }
            }
        })
    })
</script>
<!-- Quotation DOC -->
<div class="modal fade" id="quoteDocModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:1000px; ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title">Quotation for Approval</h4>
           
                <h4 style="float: right; margin: 0px 15px 0px 0px; " id="quote_history">History:
                    <select id="select_history" onchange="return showQuoteHistory();">
                        
                    </select>
                    <input type="hidden" id="main_qdoc_id">
                </h4>
            </div>
            <div id="quote_content" class="modal-body" style="overflow-y: auto; max-height: 500px;" >
                <div id="d_approval_comment"></div>
                <div>
                    <center>
                <form id="reply_to_comment" style="display: none;">
                    <textarea style="width:95%;resize:none;" id="text_comment" name="text_comment"></textarea>
                    <input type="hidden" name="doc_id" id="view_doc_id">
                    <input type="hidden" name="chat_type" value="<?=base64_encode($chat_type)?>">
                    <input type="hidden" name="emp_id" value="<?=base64_encode($user_id)?>">
                    <input type="hidden" name="full_name" value="<?=base64_encode($full_name)?>">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <span class="btn btn-warning" id="cancel_btn">Cancel</span>
                </form>
                <?php if(Yii::app()->controller->action->id!="newRequest"){?>
                <button class="btn btn-primary" id="reply_btn">Comment</button>
            <?php } ?>
        </center>
                        </div>
                <div id="notes_modal_div" style="display: none;">
                    <center>
                    Salesman Notes (<font color="red">Not shown in Quotation</font>)<br><pre class="alert alert-success" style="width:100%; height:100%; max-width:700px; overflow-x:auto;" id="pre_sale_note_modal"></pre>
                    </center>
                </div>
                <form id="app_quote">
                <select id="head_selector_app" name="head_selector_app" onchange="return changeQuoteHeadApp();">
                    <?php
                    $a_hide_comp_info = array();
                    $sql_comp = "SELECT tbl_comp_info.*,tbl_quote_note.qnote_text FROM tbl_comp_info LEFT JOIN tbl_quote_note ON tbl_comp_info.comp_id=tbl_quote_note.comp_id WHERE tbl_comp_info.enable=1; ";
                    $a_comp = Yii::app()->db->createCommand($sql_comp)->queryAll();

                    foreach($a_comp as $key => $row_comp){
                        echo '<option value="'.$row_comp["comp_id"].'" >'.$row_comp["comp_name"].'</option>';
                        $a_hide_comp_info[($row_comp["comp_id"])] = json_encode($row_comp);
                    }
                    ?>
                </select>
                <?php
                foreach($a_hide_comp_info as $comp_id => $data_comp ){
                    ?>
                    <input type="hidden" id="hide_comp_info_app<?php echo $comp_id; ?>" value="<?php echo base64_encode($data_comp); ?>">
                    <?php
                }
                ?>
                <div id="d_quote_body"></div>
                <div id="d_quote_below" >
                <?php
                
                    
                if( $user_group=="1" || $user_group=="99" ){
                ?>
                    <textarea name="note_text" id="note_text" style="width: 100%; height: 141px; min-height: 140px; margin: 3px;"></textarea>
                <?php
                }
                ?>
                </div>
                </form>
            </div>
            <div id="quote_content_his" class="modal-body" style="overflow-y: scroll; max-height: 500px; display: none;" ></div>
            <div id="quote_approve_bar" class="modal-footer">
                <!-- <button style="float:right;" type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                <?php

                if( $user_group=="1" || $user_group=="99" ){
                ?>
                <button style="float:right;" id="btn_reject" type="button" class="btn btn-danger" onclick="return quotationReject();">Reject</button>
                <button style="float:right;" id="btn_approve" type="button" class="btn btn-success" onclick="return quotationApprove();">Approve</button>
                
                <div id="sp_remark" style="display: none; float:right;"><font color=green>*Everything's update for Approve case. </font><br><font color=red>*Only Notes will update for Reject case.</font></div>
                <?php
                }else{
                    echo '<span id="btn_approve"></span><span id="btn_reject"></span>';
                }
                ?>
                <button style="float:right;" id="btn_print" type="button" class="btn btn-warning" onclick="printQuotation();">Print</button>
                <button style="float:right;" id="btn_refresh_date" type="button" class="btn btn-secondary" onclick="refreshDate();">Refresh Date</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="is_front" value="0">

<!-- Profile -->
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Profile</h4>
            </div>
            <div class="modal-body">
                <?php echo $this->renderPartial('/user/profile');  ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="edit-submit-profile">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Cart -->
<div class="modal fade" id="cartV2Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:1200px; ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="cart_title">Cart</h4>
            </div>
            <div id="cart_body" class="modal-body" >
                <div style="text-align: left;">
                    Currency: <span id="sp_currency"></span>
                </div>
                <form id="formCart" name="formCart" method="post">
                    <div id="cart_inner"></div>
                    <input type="hidden" name="curr_inner" id="curr_inner">
                    <input type="hidden" name="num_item" id="num_item">
                    <input type="hidden" name="draft_name" id="draft_name">
                    <input type="hidden" name="is_draft" id="is_draft" value="no">
                    <input type="hidden" id="edit_after_approved" value="no">
                </form>
            </div>
            <div class="modal-footer">
                <button style="float: left;" type="button" class="btn btn-success" id="btn_save_cart" onclick="saveCartDraftV2();">Save</button>
                <div style="float: left;" id="d_select_carts_id">
                    <select id="select_carts_id" onchange="loadCartV2();">
                        <option class="default_option" value="0">== Load into Cart ==</option>
                        <?php
                        $tmp_user_id = Yii::app()->user->getState('userKey');
                        Yii::app()->db->createCommand("DELETE FROM tbl_cart_save WHERE user_id='".$tmp_user_id."' AND is_draft=0 AND save_time<'".date("Y-m-d H:i:s", strtotime("-7 days"))."'; ")->execute();

                        $a_load_save = array();
                        $sql_load = "SELECT * FROM tbl_cart_save WHERE user_id='".$tmp_user_id."' ORDER BY save_time DESC; ";
                        $a_load = Yii::app()->db->createCommand($sql_load)->queryAll();
                        
                        foreach($a_load as $key_tmp_load => $row_load){
                            $show_draft_name = "";
                            if($row_load["is_draft"]=="1"){
                                $show_draft_name = $row_load["draft_name"];
                            }else{
                                $show_draft_name = $row_load["save_time"];
                            }
                            echo '<option value="'.$row_load["carts_id"].'">'.$show_draft_name.'</option>';
                        }
                        ?>
                    </select>
                    &nbsp;
                    <font style="font-size: 16px; color: #F00;">
                        <b><i style="cursor: pointer;" onclick="return deleteSaveV2();" class="fa fa-times-circle-o" aria-hidden="true" title="Delete selected draft."></i></b>
                    </font>
                    <span id="sp_show_loading"></span>
                    <br><font style="font-size: 10px; color: #F00;"><b>*Auto save will be deleted in a week.</b></font>
                </div>


                
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                
                <div style="float: right;">
                    <button type="button" style="display:none;" class="btn btn-danger" id="btn_exit_edit_mode" onclick="exitEditMode();">Exit Edit Mode</button>
                    
                    <button type="button" style="display:none;" class="btn btn-warning" id="btn_add_all_to_cart" onclick="addAllToCart();">Add Item</button>
                    
                    <button type="button" style="display:none;" class="btn btn-info" id="add_item_row" onclick="addItemRowV2();">Add Row</button>
                    <button type="button" style="display:none;" class="btn btn-warning" id="clear_cart" onclick="clearCartV2();">Clear Cart</button>
                    <button type="button" style="display:none;" class="btn btn-primary" id="build_quote" onclick="return showQuoteFormV2();">Create New Quotation</button>

                    <button type="button" style="display:none;" class="btn btn-primary" id="btn_save_edit_quote" onclick="return saveQuoteData();">Save Data</button>
                    <button type="button" style="display:none;" class="btn btn-primary" id="btn_save_edit_reject_quote" onclick="return saveRejectQuoteData();">Save Data.</button>
                </div>
                <font color="red" style="float: right;" id="remark_text">* Hold down the Ctrl (windows) / Command (Mac) button <br>to select multiple Additionals.</font>

            </div>
        </div>
    </div>
</div>

<!-- Show item (Add items mode) -->
<div class="modal fade" id="showItemAddedModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:1200px; ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add items mode</h4>
            </div>
            <div id="show_item_add_mode_body" class="modal-body" >

            </div>
            <div class="modal-footer">
                
                <div style="float: right;">
                    <button type="button" class="btn btn-danger" id="btn_exit_edit_mode" onclick="exitEditMode();">Exit Add items Mode</button>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Quotation -->
<div class="modal fade" id="quoteV2Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:1000px; ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Quotation Form</h4>
            </div>
            <div class="modal-body" style="overflow-y: scroll; max-height: 500px;">
                <form name="formQuote" id="formQuote" method="post">
                    <div id="quote_head_selector" style="border-bottom: 1px solid #AAA; text-align: left;">
                        <select id="head_selector" name="head_selector" onchange="return changeQuoteHeadV2();">
                            <?php
                            $a_hide_comp_info = array();
                            $sql_comp = "SELECT * FROM tbl_comp_info WHERE enable=1; ";
                            $a_comp = Yii::app()->db->createCommand($sql_comp)->queryAll();
                            echo '<option value="">=Please select header=</option>';
                            foreach($a_comp as $key => $row_comp){
                                echo '<option value="'.$row_comp["comp_id"].'">'.$row_comp["comp_name"].'</option>';
                                $a_hide_comp_info[($row_comp["comp_id"])] = json_encode($row_comp);
                            }
                            ?>
                        </select>
                        <?php
                        foreach($a_hide_comp_info as $comp_id => $data_comp ){
                            ?>
                            <input type="hidden" id="hide_comp_info<?php echo $comp_id; ?>" value="<?php echo base64_encode($data_comp); ?>">
                            <?php
                        }
                        ?>
                    </div>
                    <div id="quote_head" class="container">
                        <div class="row">
                            <div class="col-md-6" style="text-align:left;" id="head_img_logo"></div>
                            <div class="col-md-6" style="text-align:right;">
                                <h2>QUOTATION</h2>
                                Payment Terms: 
                                <select name="payment_term" id="select_payment_term">
                                    <option value="Net 15">Net 15</option>
                                    <option value="Net 30">Net 30</option>
                                    <option value="Payment Due at Order Confirmation">Payment Due at Order Confirmation</option>
                                    <option value="50% Due At Order Confirmation. Balance Due At Delivery">50% Due At Order Confirmation. Balance Due At Delivery</option>
                                </select>
                                <pre style="width:100%;" id="pre_comp_info"></pre>
                            </div>
                        </div>
                    </div>
                    <div id="quote_body" class="container"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btn_request_approve" onclick="return requestApprovalV2();">Request Approval</button>
            </div>
        </div>
    </div>
</div>

<iframe name="hidden_frame" style="display: none;"></iframe>

<!-- Manage Additional -->
<div class="modal fade" id="manageAdditional" tabindex="-1" role="dialog">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> Manage Additional</h4>
            </div>
            <div class="modal-body" >
                <div id="show_product_name"></div>
                <center>
                    New Additional: <input type="text" id="addi_name" style="width: 250px;">  
                    &nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-warning" onclick="return submitNewAdditional();">Add</button>
                    <input type="hidden" id="addi_product_type" value="">
                    <input type="hidden" id="addi_pro_id" value="">
                </center>
                <div id="manage_additional"></div>
            </div>
            
        </div>
    </div>
</div>
<?php //echo "<hr>".Yii::app()->controller->id."<hr>"; //current controller id ?>


<?php //echo Yii::app()->controller->action->id."<hr>"; //current controller action id ?>
<script type="text/javascript">

activePage();
function activePage(){

    setTimeout(function() {
        $.ajax({  
            type: "POST",  
            dataType: "html", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/activePage" ,
            success: function(resp){   
                activePage();
            }  
        });
    }, 300000);//---5 minutes
}

var deleter = [];
var tr_text = [];
var tr_main = [];

$(document).on('click','.deleter',function(){
    var tr_id = $(this).attr('tr_id');
    var tr_full = $(this).attr('tr_full');
    var tr_main_id = $(this).attr('tr_main');
    if (confirm('Do you really want to delete it ?')) {
        deleter.push(tr_id);
        tr_text.push(tr_full);
        tr_main.push(tr_main_id);
        var del = "tr_"+tr_full+tr_id;
        $('#'+del).remove();
        //alert(deleter);
    }
})


$('#cartModal').on("hide.bs.modal", function() {

    if($('#is_front').val()==1){
        var curr_id = $('#curr_id').val();
        if(curr_id!=null){
           $.ajax({  
                type: "POST",  
                dataType: "json", 
                url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/updateCart?curr_id="+curr_id ,
                data: $('#formCart').serialize() ,
                success: function(resp){ 

                    if(resp.result=="updated"){

                        $('#sp_sum_total').html(resp.num_item);

                        //alert(resp.num_item);
                        
                    }else{
                        //alert(resp.result);
                    }
                }
            });
        }
        
    }

});

function showItemAddMode(qdoc_id){

    $('#show_item_add_mode_body').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');

    $.ajax({  
        type: "POST",  
        dataType: "html", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/showItemAddMode" ,
        data:{
            "qdoc_id":qdoc_id
        },
        success: function(resp){

            $('#show_item_add_mode_body').html(resp);

        }
    });

}

function addToCart(p_type,p_id,price,qty,comm_percent){

    var tmp_curr = $('#dynamic_select').val();
    var a_curr = tmp_curr.split("=");
    if(a_curr.length<2){
        alert("Please select currency.");
        return false;
    }

    var currency = a_curr[1];

    if($('#qdoc_id_editing').val()==null){
        
        $.ajax({  
            type: "POST",  
            dataType: "html", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/addToCart" ,
            data:{
                "p_type":p_type,
                "p_id":p_id,
                "price":price,
                "qty":qty,
                "comm_percent":comm_percent,
                "currency":currency
            },
            success: function(resp){ 
                if(resp=="success"){
                    var tmp_sum = parseInt($('#sp_sum_total').html())+1;

                    $('#sp_sum_total').html(tmp_sum);
                }else{
                    alert(resp);
                }  

            }  
        });

    }else{

        var qdoc_id = $('#qdoc_id_editing').val();

        $.ajax({  
            type: "POST",  
            dataType: "html", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/addToQuotation" ,
            data:{
                "qdoc_id":qdoc_id,
                "p_type":p_type,
                "p_id":p_id,
                "price":price,
                "qty":qty,
                "comm_percent":comm_percent,
                "currency":currency
            },
            success: function(resp){ 
                if(resp=="success"){
                    var tmp_sum = parseInt($('#sp_sum_total_edit').html())+1;

                    $('#sp_sum_total_edit').html(tmp_sum);
                }else{
                    alert(resp);
                }  

            }  
        });

    }
    
}

function addToExtraCart(extra_id){

    var tmp_curr = $('#dynamic_select').val();
    var a_curr = tmp_curr.split("=");
    if(a_curr.length<2){
        alert("Please select currency.");
        return false;
    }

    var currency = a_curr[1];

    if(currency!="0"){
        alert("Extra items support only USD North America.");
        return false;
    }

    if($('#qdoc_id_editing').val()==null){

        //alert("extra_id="+extra_id+"\ncurrency="+currency);
        $.ajax({  
            type: "POST",  
            dataType: "html", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/addExtraToCart" ,
            data:{
                "extra_id":extra_id,
                "currency":currency
            },
            success: function(resp){ 
                if(resp=="success"){
                    var tmp_sum = parseInt($('#sp_sum_total').html())+1;

                    $('#sp_sum_total').html(tmp_sum);
                }else{
                    alert(resp);
                }  

            }  
        });

    }else{

        var qdoc_id = $('#qdoc_id_editing').val();

        $.ajax({  
            type: "POST",  
            dataType: "html", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/addExtraToQuotation" ,
            data:{
                "qdoc_id":qdoc_id,
                "extra_id":extra_id
            },
            success: function(resp){ 
                if(resp=="success"){
                    var tmp_sum = parseInt($('#sp_sum_total_edit').html())+1;

                    $('#sp_sum_total_edit').html(tmp_sum);
                }else{
                    alert(resp);
                }  

            }  
        });

    }

}

function saveCart(){

    var curr_inner = window.btoa($('#sp_currency').html());

    var num_item = $('#sp_sum_total').html();

    $('#curr_inner').val(curr_inner);
    $('#num_item').val(num_item);

    $('#is_draft').val("no");

    var curr_id = $('#curr_id').val();

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/saveCart?curr_id="+curr_id ,
        data: $('#formCart').serialize() ,
        success: function(resp){ 
            
            if(resp.result=="success"){

                $('<option value="'+resp.carts_id+'">'+resp.save_time+'</option>').insertAfter('.default_option');
                alert("Saved!!");

                setTimeout(function() { $('#select_carts_id').val(resp.carts_id); }, 1000);
            }

        }  
    });
}

function saveCartDraft(){

    var draft_name = prompt("Please input draft name:");

    if(draft_name==null){
        return false;
    }

    if(draft_name==""){
        alert("Please input draft name.");
        return false;
    }

    var curr_inner = window.btoa($('#sp_currency').html());

    var num_item = $('#sp_sum_total').html();

    $('#curr_inner').val(curr_inner);
    $('#num_item').val(num_item);

    $('#draft_name').val(draft_name);
    $('#is_draft').val("yes");

    var curr_id = $('#curr_id').val();

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/saveCart?curr_id="+curr_id ,
        data: $('#formCart').serialize() ,
        success: function(resp){ 
            
            if(resp.result=="success"){

                $('<option value="'+resp.carts_id+'">'+resp.draft_name+'</option>').insertAfter('.default_option');

                $('#draft_name').val('');
                $('#is_draft').val("no");
                alert("Saved!!");

                setTimeout(function() { $('#select_carts_id').val(resp.carts_id); }, 1000);
            }

        }  
    });
}

function deleteSave(){

    var carts_id = $('#select_carts_id').val();

    if(carts_id!="0"){

        if(confirm("Deleting draft. Confirm?")){

            $.ajax({  
                type: "POST",  
                dataType: "json", 
                url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/deleteCartSave" ,
                data: {
                    "carts_id":carts_id
                } ,
                success: function(resp){ 
                    
                    if(resp.result=="success"){

                        $("#select_carts_id option[value='"+carts_id+"']").remove();
                        showCart();
                        
                    }

                }  
            });
        }

    }

}

function loadCart(){

    if($('#select_carts_id').val()!="0"){

        $('#sp_show_loading').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>');

        var carts_id = $('#select_carts_id').val();

        $.ajax({  
            type: "POST",  
            dataType: "json", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/loadCart" ,
            data:{
                "carts_id":carts_id
            },
            success: function(resp){ 
                //$('#cart_inner').html(resp);
                if(resp.result=="success"){
                    //alert($('#select_carts_id').val());
                    $('#cart_title').html("Cart loaded");

                    $('#btn_add_all_to_cart').hide();
                    $('#btn_exit_edit_mode').hide();


                    $('#add_item_row').show();
                    $('#build_quote').show();
                    

                    $('#sp_show_loading').html('');
                    $('#sp_currency').html(resp.currency);
                    $('#cart_inner').html(window.atob(resp.form_inner));

                    var tmp_html_id = resp.tmp_html_id.split(",");
                    for(var i=0; i<tmp_html_id.length;i++){
                        if(tmp_html_id[i].indexOf("other")<0){
                            calPrice(tmp_html_id[i]);
                        }else{
                            calPrice(tmp_html_id[i],1);
                        }
                    }

                }

            }  
        });
    }
}

function showCart(is_front=0){

    $('#select_carts_id').val(0);

    $('#is_front').val(is_front);

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/showCart" ,
        
        success: function(resp){ 
            
            $('#cart_title').html("Cart");
            $('#build_quote').html('Create New Quotation').attr("disabled",false);

            $('#btn_add_all_to_cart').hide();
            $('#btn_exit_edit_mode').hide();
            $('#btn_save_edit_quote').hide();
            $('#btn_save_edit_reject_quote').hide();

            $('#btn_save_cart').show();
            $('#d_select_carts_id').show();

            if(resp.found_data=="yes"){
                $('#add_item_row').show();
                $('#build_quote').show();
            }else{
                $('#add_item_row').hide();
                $('#build_quote').hide();
            }

            $('#clear_cart').show();
            $('#sp_currency').html(resp.currency);
            $('#cart_inner').html(resp.cart_inner);

        }  
    });

}

function clearCart(){

    if(confirm("Do you want to clear the cart?")){
        $.ajax({  
            type: "POST",  
            dataType: "html", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/clearCart" ,
            
            success: function(resp){ 

                $('#cart_inner').html('');
                $('#sp_sum_total').html(0);
                $('#cartModal').modal("toggle");

            }  
        });
    }

}

function deleteRow(row_id,is_other=0,extra_id=0){
    if(confirm("Confirm delete row?")){
        $('#tr_'+row_id).fadeOut(500).html('');
    }
}

function deleteRow2(row_id,is_other=0,extra_id=0){

    if(confirm("Confirm delete row?")){

        if( is_other==1 || is_other==2 ){
            $('#tr_'+row_id).fadeOut(500).html('');
        }else{
            
            if( is_other==3 ){

                $.ajax({  
                    type: "POST",  
                    dataType: "json", 
                    url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/deleteRowExtra" ,
                    data:{
                        "extra_id":extra_id
                    },
                    success: function(resp){ 

                        if(resp.result=="success"){
                            $('#tr_'+row_id).fadeOut(500).html('');
                            var tmp_sum = parseInt($('#sp_sum_total').html())-1;

                            $('#sp_sum_total').html(tmp_sum);
                        }

                    }  
                });

            }else{

                var product =  $('#product_'+row_id).val();
                var p_id =  $('#id_'+row_id).val();

                $.ajax({  
                    type: "POST",  
                    dataType: "json", 
                    url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/deleteRow" ,
                    data:{
                        "product":product,
                        "p_id":p_id
                    },
                    success: function(resp){ 

                        if(resp.result=="success"){
                            $('#tr_'+row_id).fadeOut(500).html('');
                            var tmp_sum = parseInt($('#sp_sum_total').html())-1;

                            $('#sp_sum_total').html(tmp_sum);
                        }

                    }  
                });
            }
        }

    }

}

function calPrice(row_id,is_other=0){

    var show_uprice = 0.00;
    if(is_other==1){
        show_uprice = $('#uprice_'+row_id).val();
    }else{
        <?php
        /*$user_group = Yii::app()->user->getState('userGroup');
        
        if( $user_group=="1" || $user_group=="99" ){
            ?>
            show_uprice = $('#uprice_'+row_id).val();
            <?php
        }else{*/
        ?>
            show_uprice = $('#show_uprice_'+row_id).html();
        <?php
        //}
        ?>
    }
    
    var qty =  $('#qty_'+row_id).val();

    $('#amount_'+row_id).html((show_uprice*qty).toFixed(2));

}

function showQuoteForm(){

    var found_empty = 0;
    $('.chk_qty').each(function(){
        if( $(this).val()=="" || $(this).val()==0 ){
            found_empty++;
        }
    });

    if(found_empty>0){
        alert("Please input QTY");
        return false;
    }
 
    /*var found_zero = 0;
    $('.chk_uprice').each(function(){
        if( $(this).val()=="" || $(this).val()==0 ){
            found_zero++;
        }
    });

    if(found_zero>0){
        alert("Please input Price");
        return false;
    }*/

    $('#btn_request_approve').prop("disabled",false).html("Request Approval");

    if($('#build_quote').html()=='Create New Quotation'){

        var curr_id = $('#curr_id').val();

        $('#build_quote').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Auto save running').attr("disabled",true);

        $.ajax({  
            type: "POST",  
            dataType: "json", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/saveCart?curr_id="+curr_id ,
            data: $('#formCart').serialize() ,
            success: function(resp2){ 
                
                if(resp2.result=="success"){

                    $('<option value="'+resp2.carts_id+'">'+resp2.save_time+'</option>').insertAfter('.default_option');

                    setTimeout(function() { 

                        $.ajax({  
                            type: "POST",  
                            dataType: "html", 
                            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/showQuoteForm" ,
                            data: $('#formCart').serialize(),
                            success: function(resp){ 

                                $('#quote_body').html(resp);
                                $('#cartModal').modal("toggle");
                                $('#quoteModal').modal("toggle");

                                $('#td_grand_total').html($('#sp_show_gtotal_value').html());

                                setTimeout(function() {

                                    $('.subnvat').hide();

                                    if($('#qdoc_id_old').val()){

                                        $('#td_auto_code').html($('#est_number_old').val());

                                        $('#select_payment_term').val($('#payment_term_old').val());

                                        $('#head_selector').val($('#comp_id_old').val());
                                        changeQuoteHead();

                                        $('#cust_selector').val($('#cust_id_old').val());
                                        changeCustomer();

                                        if($('#inc_vat_old').val()=="yes"){
                                            $('#inc_vat').prop("checked",true);
                                        }else{
                                            $('#inc_vat').prop("checked",false);
                                        }
                                        changeIncludeVAT();
                                    }
                                }, 100);
                            }  
                        });

                    }, 100);
                }

            }  
        });

    }else{

        $.ajax({  
            type: "POST",  
            dataType: "html", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/showQuoteForm" ,
            data: $('#formCart').serialize(),
            success: function(resp){ 

                $('#quote_body').html(resp);
                $('#cartModal').modal("toggle");
                $('#quoteModal').modal("toggle");

                $('#td_grand_total').html($('#sp_show_gtotal_value').html());

                if($('#is_duplicate').val()=="1"){
                    //--ignore
                }else{
                    setTimeout(function() {
                        if($('#qdoc_id_old').val()){

                            $('#td_auto_code').html($('#est_number_old').val());

                            $('#select_payment_term').val($('#payment_term_old').val());

                            $('#head_selector').val($('#comp_id_old').val());
                            changeQuoteHead();

                            $('#cust_selector').val($('#cust_id_old').val());
                            changeCustomer();

                            if($('#inc_vat_old').val()=="yes"){
                                $('#inc_vat').prop("checked",true);
                            }else{
                                $('#inc_vat').prop("checked",false);
                            }
                            changeIncludeVAT();
                        }
                    }, 100);
                }
            }  
        });

    }

}

function showQuoteFormV2(){
    $('#is_front').val('0');
    var found_empty = 0;
    $('.chk_qty').each(function(){
        if( $(this).val()=="" || $(this).val()==0 ){
            found_empty++;
        }
    });

    if(found_empty>0){
        alert("Please input QTY");
        return false;
    }

    $('#btn_request_approve').prop("disabled",false).html("Request Approval");

    if($('#build_quote').html()=='Create New Quotation'){

        var curr_id = $('#curr_id').val();

        $('#build_quote').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Auto save running').attr("disabled",true);

        $.ajax({  
            type: "POST",  
            dataType: "json", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/saveCart" ,
            data: $('#formCart').serialize() ,
            success: function(resp2){ 
                
                if(resp2.result=="success"){

                    $('<option value="'+resp2.carts_id+'">'+resp2.save_time+'</option>').insertAfter('.default_option');

                    setTimeout(function() { 

                        $.ajax({  
                            type: "POST",  
                            dataType: "html", 
                            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/showQuoteForm" ,
                            data: $('#formCart').serialize(),
                            success: function(resp){ 

                                $('#quote_body').html(resp);
                                $('#cartV2Modal').modal("toggle");
                                $('#quoteV2Modal').modal("toggle");

                                $('#td_grand_total').html($('#sp_show_gtotal_value').html());

                                setTimeout(function() {

                                    $('.subnvat').hide();

                                    if($('#qdoc_id_old').val()){

                                        $('#td_auto_code').html($('#est_number_old').val());

                                        $('#select_payment_term').val($('#payment_term_old').val());

                                        $('#head_selector').val($('#comp_id_old').val());
                                        changeQuoteHeadV2();

                                        $('#cust_selector').val($('#cust_id_old').val());
                                        changeCustomerV2();

                                        if($('#inc_vat_old').val()=="yes"){
                                            $('#inc_vat').prop("checked",true);
                                        }else{
                                            $('#inc_vat').prop("checked",false);
                                        }
                                        changeIncludeVATV2();
                                    }
                                }, 100);
                            }  
                        });

                    }, 100);
                }

            }  
        });

    }else{

        $.ajax({  
            type: "POST",  
            dataType: "html", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/showQuoteForm" ,
            data: $('#formCart').serialize(),
            success: function(resp){ 

                $('#quote_body').html(resp);
                $('#cartV2Modal').modal("toggle");
                $('#quoteV2Modal').modal("toggle");

                $('#td_grand_total').html($('#sp_show_gtotal_value').html());

                if($('#is_duplicate').val()=="1"){
                    //--ignore
                }else{
                    setTimeout(function() {
                        if($('#qdoc_id_old').val()){

                            $('#td_auto_code').html($('#est_number_old').val());

                            $('#select_payment_term').val($('#payment_term_old').val());

                            $('#head_selector').val($('#comp_id_old').val());
                            changeQuoteHeadV2();

                            $('#cust_selector').val($('#cust_id_old').val());
                            changeCustomerV2();

                            if($('#inc_vat_old').val()=="yes"){
                                $('#inc_vat').prop("checked",true);
                            }else{
                                $('#inc_vat').prop("checked",false);
                            }
                            changeIncludeVATV2();
                        }
                    }, 100);
                }
            }  
        });

    }

}

function getAdditional(id,product_type){

    $('#addi_pro_id').val(id);
    $('#addi_product_type').val(product_type);

    $('#manage_additional').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');

    $.ajax({  
        type: "POST",  
        dataType: "html", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/getAdditional" ,
        data:{
            "pro_id":id,
            "product_type":product_type
        },
        success: function(resp){ 

            var show_product_name = "<b>Product:</b> "+$('#prod_name'+id).html()+"<br><b>Description:</b> <br>"+$('#prod_desc'+id).html()+"<hr>";
            
            $('#show_product_name').html(show_product_name);

            $('#manage_additional').html(resp);

        }  
    });
}

function submitNewAdditional(){

    if($('#addi_name').val()==""){
        alert("Please input New Additional");
        return false;
    }

    if( $('#addi_pro_id').val()=="" || $('#addi_product_type').val()=="" ){
        alert("ERROR: Invalid Parameter");
        return false;
    }

    $.ajax({  
        type: "POST",  
        dataType: "html", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/submitNewAdditional" ,
        data:{
            "pro_id":$('#addi_pro_id').val(),
            "product_type":$('#addi_product_type').val(),
            "addi_name":window.btoa($('#addi_name').val())
        },
        success: function(resp){ 

            if(resp=="success"){
                getAdditional($('#addi_pro_id').val(),$('#addi_product_type').val());
                $('#addi_name').val('');
            }else{
                alert(resp);
            }

        }  
    });
    
}

function deleteRowAdditional(id,product_type,addi_id){

    if(confirm("Confirm to delete this Additional?")){

        $.ajax({  
            type: "POST",  
            dataType: "html", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/deleteAdditional" ,
            data:{
                "addi_id":addi_id
            },
            success: function(resp){ 

                if(resp=="success"){
                    getAdditional(id,product_type);
                }else{
                    alert("Fail");
                }

            }  
        });


    }
}

function editRowAdditional(pro_id,pro_type,addi_id){

    var addi_0value = $('#addi_0value'+addi_id).html();
    var addi_1value = $('#addi_1value'+addi_id).html();
    var addi_2value = $('#addi_2value'+addi_id).html();
    var addi_3value = $('#addi_3value'+addi_id).html();
    var addi_4value = $('#addi_4value'+addi_id).html();
    var addi_5value = $('#addi_5value'+addi_id).html();

    $('#old_0value'+addi_id).val(addi_0value);
    $('#old_1value'+addi_id).val(addi_1value);
    $('#old_2value'+addi_id).val(addi_2value);
    $('#old_3value'+addi_id).val(addi_3value);
    $('#old_4value'+addi_id).val(addi_4value);
    $('#old_5value'+addi_id).val(addi_5value);

    $('#addi_0value'+addi_id).html('<input type="number" id="edit_addi_0value'+addi_id+'" style="width:100%;" value="'+addi_0value+'">');
    $('#addi_1value'+addi_id).html('<input type="number" id="edit_addi_1value'+addi_id+'" style="width:100%;" value="'+addi_1value+'">');
    $('#addi_2value'+addi_id).html('<input type="number" id="edit_addi_2value'+addi_id+'" style="width:100%;" value="'+addi_2value+'">');
    $('#addi_3value'+addi_id).html('<input type="number" id="edit_addi_3value'+addi_id+'" style="width:100%;" value="'+addi_3value+'">');
    $('#addi_4value'+addi_id).html('<input type="number" id="edit_addi_4value'+addi_id+'" style="width:100%;" value="'+addi_4value+'">');
    $('#addi_5value'+addi_id).html('<input type="number" id="edit_addi_5value'+addi_id+'" style="width:100%;" value="'+addi_5value+'">');

    $('#btn_save_addi'+addi_id).html('<i class="fa fa-floppy-o"></i>');
    $('#btn_cancel_addi'+addi_id).html('<i class="fa fa-ban"></i>');
    
    $('#btn_save_addi'+addi_id).attr("onclick","return saveRowAdditional("+pro_id+",'"+pro_type+"',"+addi_id+");");
    $('#btn_cancel_addi'+addi_id).attr("onclick","return cancelRowAdditional("+pro_id+",'"+pro_type+"',"+addi_id+");");

}

function cancelRowAdditional(pro_id,pro_type,addi_id){

    $('#addi_0value'+addi_id).html($('#old_0value'+addi_id).val());
    $('#addi_1value'+addi_id).html($('#old_1value'+addi_id).val());
    $('#addi_2value'+addi_id).html($('#old_2value'+addi_id).val());
    $('#addi_3value'+addi_id).html($('#old_3value'+addi_id).val());
    $('#addi_4value'+addi_id).html($('#old_4value'+addi_id).val());
    $('#addi_5value'+addi_id).html($('#old_5value'+addi_id).val());

    $('#btn_save_addi'+addi_id).html('<i class="fa fa-pencil"></i>');
    $('#btn_cancel_addi'+addi_id).html('<i class="fa fa-close"></i>');
    
    $('#btn_save_addi'+addi_id).attr("onclick","return editRowAdditional("+pro_id+",'"+pro_type+"',"+addi_id+");");
    $('#btn_cancel_addi'+addi_id).attr("onclick","return deleteRowAdditional("+pro_id+",'"+pro_type+"',"+addi_id+");");

}

function saveRowAdditional(pro_id,pro_type,addi_id){

    var addi_0value = $('#edit_addi_0value'+addi_id).val();
    var addi_1value = $('#edit_addi_1value'+addi_id).val();
    var addi_2value = $('#edit_addi_2value'+addi_id).val();
    var addi_3value = $('#edit_addi_3value'+addi_id).val();
    var addi_4value = $('#edit_addi_4value'+addi_id).val();
    var addi_5value = $('#edit_addi_5value'+addi_id).val();


    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/saveEditAdditional" ,
        data:{
            "addi_id":addi_id,
            "addi_value": addi_0value,
            "addi_value1": addi_1value,
            "addi_value2": addi_2value,
            "addi_value3": addi_3value,
            "addi_value4": addi_4value,
            "addi_value5": addi_5value
        },
        success: function(resp){ 

            if(resp.result=="success"){

                //alert(resp.sql_update);

                $('#addi_0value'+addi_id).html(resp.addi_value);
                $('#addi_1value'+addi_id).html(resp.addi_value1);
                $('#addi_2value'+addi_id).html(resp.addi_value2);
                $('#addi_3value'+addi_id).html(resp.addi_value3);
                $('#addi_4value'+addi_id).html(resp.addi_value4);
                $('#addi_5value'+addi_id).html(resp.addi_value5);

                $('#btn_save_addi'+addi_id).html('<i class="fa fa-pencil"></i>');
                $('#btn_cancel_addi'+addi_id).html('<i class="fa fa-close"></i>');
                
                $('#btn_save_addi'+addi_id).attr("onclick","return editRowAdditional("+pro_id+",'"+pro_type+"',"+addi_id+");");
                $('#btn_cancel_addi'+addi_id).attr("onclick","return deleteRowAdditional("+pro_id+",'"+pro_type+"',"+addi_id+");");

            }else{
                alert("Fail to update data!");
            }

        }  
    });

}

function selectAddi(row_id){
    
    var uprice = parseFloat($('#old_uprice_'+row_id).val());
        
    var a_select = $('#select_'+row_id).val();

    var tmp_price = "";
    for(var i=0;i<a_select.length;i++){

        tmp_price = a_select[i].split("|");

        uprice += parseFloat(tmp_price[1]);
    }

    <?php
    /*$user_group = Yii::app()->user->getState('userGroup');
    
    if( $user_group=="1" || $user_group=="99" ){
        ?>
        $('#uprice_'+row_id).val(uprice);
        <?php
    }else{*/
    ?>
        $('#show_uprice_'+row_id).html(uprice);
    <?php
    //}
    ?>

    calPrice(row_id);

}

function changeQuoteHead(){

    var head_select = $('#head_selector').val();
    if(head_select==""){
        alert("Please select header");
        return false;
    }

    var obj_comp = $.parseJSON( window.atob($('#hide_comp_info'+head_select).val()) );

    //alert( window.atob($('#hide_comp_info'+head_select).val()) );
    if(obj_comp.have_vat=="1"){
        $('.subnvat').show();
    }else{
        $('.subnvat').hide();
    }

    var head_img_logo = "";
    if( obj_comp.comp_logo!="" && obj_comp.comp_logo != null){
        head_img_logo = '<img style="max-height: 180px; max-width: 180px;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/'+obj_comp.comp_logo+'" >';
        $('#head_img_logo').html(head_img_logo);
    }else{
        $('#head_img_logo').html('');
    }

    var pre_comp_info = '<b>'+obj_comp.comp_name+'</b><br>'+obj_comp.comp_info;
    $('#pre_comp_info').html(pre_comp_info);

}

function changeCustomer(){

    var cust_id = $('#cust_selector').val();

    $.ajax({  
        type: "POST",  
        dataType: "html", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/getCustomerInfo" ,
        data:{
            "cust_id":cust_id
        },
        success: function(resp){ 

            $('#pr_show_cust_info').html(resp);

        }  
    });
}

function addItemRow(){
    var row_no = $('#count_item_row').val();

    var inner_new_row = '';
    inner_new_row += '<tbody id="tr_other'+row_no+'"><tr><td style="text-align:center;">'+row_no;

    if( $('#after_approved_editing').val()=="yes" ){
        inner_new_row +=  '<input name="a_qdoci_id[]" type="hidden" value="new_other" >';
    }

    inner_new_row +=  '<input name="product_type[]" type="hidden" value="other" id="product_other'+row_no+'">';
    inner_new_row +=  '<input name="product_id[]" type="hidden" value="ot'+row_no+'" id="id_other'+row_no+'">';
    inner_new_row +=  '<input name="comm_percent[]" type="hidden" value="" id="comm_percent_other'+row_no+'">';
    inner_new_row +=  '<input name="qty_note[]" type="hidden" value="" id="qty_note_other'+row_no+'">';
    inner_new_row += '</td>';
    inner_new_row += '<td><textarea style="width:200px; min-height:80px; padding:5px;" name="product_item[]" id="product_item_other'+row_no+'"></textarea></td>';
    inner_new_row += '<td><textarea style="width:405px; min-height:80px; padding:5px;" name="product_desc[]" id="product_desc_other'+row_no+'"></textarea></td>';
    inner_new_row += '<td></td>';
    inner_new_row += '<td></td>';
    inner_new_row += '<td style="text-align:center;">';
    inner_new_row += '<input class="chk_qty" name="qty[]" id="qty_other'+row_no+'" type="number" min="0" style="text-align:center; width:50px;" onchange="return calPrice(\'other'+row_no+'\',1);" onkeyup="return calPrice(\'other'+row_no+'\',1);" value="">';
    inner_new_row += '</td>';
    
    inner_new_row += '<td style="text-align:center;"><input class="chk_uprice" name="uprice[]" type="number" min="0" id="uprice_other'+row_no+'" style="text-align:center; width:50px; " onchange="return calPrice(\'other'+row_no+'\',1);" onkeyup="return calPrice(\'other'+row_no+'\',1);"></td>';
    inner_new_row += '<td style="text-align:center;" id="amount_other'+row_no+'"></td>';
    inner_new_row += '<td style="text-align:center;"><button type="button" class="btn btn-danger" onclick="return deleteRow(\'other'+row_no+'\',1);">Del</button></td>';
    inner_new_row += '</tr></tbody>';

    $('#tbl_cart_info').append(inner_new_row); 

    row_no = parseInt(row_no)+1;
    $('#count_item_row').val(row_no);
}

function changeIncludeVAT(){

    var total_value = 0.0;

    if($('#inc_vat').prop("checked")){

        $('#sp_show_vat_value').html($('#pre_cost').val()+$('#vat_value').val());

        //var sub_total = parseFloat($('#sub_total').val());

        total_value = parseFloat($('#sub_total').val())+parseFloat($('#vat_value').val());
        $('#sp_show_total_value').html($('#pre_cost').val()+total_value.toFixed(2));
        $('#total_value').val(total_value);

        $('#sp_show_gtotal_value').html($('#pre_cost').val()+total_value.toFixed(2));
        $('#gtotal_value').val(total_value);

        $('#td_grand_total').html($('#pre_cost').val()+total_value.toFixed(2));
    }else{
        $('#sp_show_vat_value').html('');

        total_value = parseFloat($('#sub_total').val());
        $('#sp_show_total_value').html($('#pre_cost').val()+total_value.toFixed(2));
        $('#total_value').val(total_value);

        $('#sp_show_gtotal_value').html($('#pre_cost').val()+total_value.toFixed(2));
        $('#gtotal_value').val(total_value);

        $('#td_grand_total').html($('#pre_cost').val()+total_value.toFixed(2));
    }

}

function requestApproval(){

    if($('#head_selector').val()==""){
        alert("Please select Header");
        return false;
    }

    if($('#cust_selector').val()==""){
        alert("Please select Customer");
        return false;
    }

    $('#btn_request_approve').prop("disabled",true).html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/requestApprove" ,
        data: $('#formQuote').serialize(),
        success: function(resp){ 

            //$('#quote_body').html(resp);
            
            if(resp.result=="success"){
                $.ajax({  
                    type: "POST",  
                    dataType: "html", 
                    url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/clearCart" ,
                    
                    success: function(resp2){ 

                        $('#cart_inner').html('');
                        $('#sp_sum_total').html(0);
                        $('#quoteModal').modal("toggle");
                        alert("Your Estimate Number is : "+resp.est_number+"\nApproval status show in Quotation menu.");

                        window.location.href = "<?php echo Yii::app()->request->baseUrl; ?>/quotation/newRequest";
                    }  
                });
            }else{
                alert("Error for saving data!");
            }
        }  
    });
}

function saveQuoteData(){

    $.ajax({  
        type: "POST",  
        dataType: "html", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/saveQuoteData" ,
        data: $('#formCart').serialize(),
        success: function(resp){ 

            //$('#cart_inner').append(resp);
            if(resp=="success"){

                location.reload();

            }else{
                alert(resp);
            }

        }  
    });

}

function saveRejectQuoteData(){

    var found_empty = 0;
    $('.chk_qty').each(function(){
        if( $(this).val()=="" || $(this).val()==0 ){
            found_empty++;
        }
    });

    if(found_empty>0){
        alert("Please input QTY");
        return false;
    }

    if (deleter.length>0) {
        for(i=0;i<deleter.length;i++){
            var row_id = tr_text[i]+tr_main[i];
            var qdoci_id = tr_main[i];
            var from_page = 'quote_rej';
            deleteFromQuote(row_id,qdoci_id,from_page);
        }
        deleter = [];
        tr_text = [];
        tr_main = [];
    }

    $.ajax({  
        type: "POST",  
        dataType: "html", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/saveRejectQuoteData" ,
        data: $('#formCart').serialize(),
        success: function(resp){ 

            //$('#cart_inner').append(resp);
            if(resp=="success"){

                location.reload();

            }else{
                alert(resp);
            }

        }  
    });
}

$('#cartV2Modal').on("hide.bs.modal", function() {
    
    if($('#is_front').val()==1){
        
       $.ajax({  
            type: "POST",  
            dataType: "json", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/updateCart" ,
            data: $('#formCart').serialize() ,
            success: function(resp){ 

                //$('#debug_panel').html(resp);

                if(resp.result=="updated"){

                    $('#sp_sum_total').html(resp.num_item);

                    //alert(resp.num_item);
                    
                }else{
                    //alert(resp.result);
                }
            }
        });
    }
    else if($('#is_front').val()==2){
        saveRejectQuoteData();
    }
    else if($('#is_front').val()==3){
        saveQuoteData();
    }

});

function sendToCart(qdoc_id,from_page=""){
    
    //alert(from_page);

    $('#cart_inner').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');
    $('#build_quote').html('Recreate Quotation').attr("disabled",false);

    $('#btn_save_cart').hide();
    $('#d_select_carts_id').hide();
    
    $('#clear_cart').hide();

    $('#btn_exit_edit_mode').hide();
    $('#btn_add_all_to_cart').hide();
    $('#add_item_row').hide();
    $('#build_quote').hide();
    $('#btn_save_edit_quote').hide();
    $('#btn_save_edit_reject_quote').hide();

    $('#remark_text').show();

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/sendToCart" ,
        data:{
            "qdoc_id":qdoc_id,
            "from_page":from_page
        },
        success: function(resp){ 
            
            //$('#cart_inner').html(resp);

            
            if(resp.result=="success"){

                $('#cart_title').html("Quotation Editor: "+resp.est_number);
                
                if(from_page=="equote"){
                    
                    $('#btn_save_edit_quote').show();

                    $('#edit_after_approved').val("no");

                }else if(from_page=="quote_rej"){//---From rejected page
                    //$('#btn_exit_edit_mode').hide();
                    $('#btn_add_all_to_cart').show();
                    $('#build_quote').show();
                    $('#btn_save_edit_reject_quote').show();
                    $('#add_item_row').show();
                    $('#is_front').val('2');

                    $('#edit_after_approved').val("no");
                    $('#edit_reject_quote').val("yes");

                }else if(from_page=="equote_aa"){//---From approved and archived page
                    //$('#btn_exit_edit_mode').hide();
                    //$('#btn_add_all_to_cart').show();
                    //$('#add_item_row').show();
                    //$('#build_quote').show();
                    $('#btn_save_edit_quote').show();
                    $('#is_front').val('3');

                    $('#edit_after_approved').val("yes");

                    $('#remark_text').hide();

                }else{

                    $('#btn_exit_edit_mode').show();
                    //$('#btn_add_all_to_cart').hide();
                    //$('#add_item_row').show();

                    if( $('#after_approved_editing').val()=="yes" ){

                        $('#btn_save_edit_quote').show();
                    }else{

                        //$('#build_quote').show();
                    }
                    
                }
                //$('#btn_save_edit_quote').show();

                $('#sp_currency').html(resp.currency);
                $('#cart_inner').html(window.atob(resp.form_inner));

                /*if( $('#is_duplicate').val()=="1" ){
                    $('#btn_save_edit_quote').show();
                    $('#build_quote').show();
                }*/

                var tmp_html_id = resp.tmp_html_id.split(",");
                for(var i=0; i<tmp_html_id.length;i++){
                    if(tmp_html_id[i].indexOf("other")<0){
                        calPrice(tmp_html_id[i]);
                    }else{
                        calPrice(tmp_html_id[i],1);
                    }
                }

            }
            

        }  
    });
    
}

function sortQuoteItem(direction,from_page,qdoci_id){

    var found_empty = 0;
    $('.chk_qty').each(function(){
        if( $(this).val()=="" || $(this).val()==0 ){
            found_empty++;
        }
    });

    if(found_empty>0){
        alert("Please input QTY");
        return false;
    }

    $.ajax({  
        type: "POST",  
        dataType: "html", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/saveRejectQuoteData" ,
        data: $('#formCart').serialize(),
        success: function(resp){ 

            if(resp=="success"){

                var qdoci_id2 = 0;
                if(direction=="up"){
                    qdoci_id2 = $('#record_above'+qdoci_id).val();
                }else{
                    qdoci_id2 = $('#record_below'+qdoci_id).val();
                }

                $.ajax({  
                    type: "POST",  
                    dataType: "json", 
                    url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/sortQuoteItem" ,
                    data:{
                        "qdoci_id1":qdoci_id,
                        "qdoci_id2":qdoci_id2
                    },
                    success: function(resp2){ 

                        if(resp2.result=="success"){
                            sendToCart(resp2.qdoc_id,from_page);
                        }else{
                            alert(resp2.msg);
                        }

                    }
                });

            }else{
                alert(resp);
            }

        }  
    });

}

function addAllToCart(){

    var qdoc_id = $('#edit_quote_id').val();
    var num_item = parseInt($('#count_item_row').val())-1;
    var est_number = $('#edit_est_number').val();

    var edit_after_approved = $('#edit_after_approved').val();

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/enableQuoteCart" ,
        data:{
            "qdoc_id":qdoc_id,
            "num_item":num_item,
            "est_number":est_number,
            "edit_after_approved":edit_after_approved
        },
        success: function(resp){ 

            if(resp.result=="success"){
                window.location.href = "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/show/product/1";
            }

        }  
    });

}

function exitEditMode(){
    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/disableQuoteCart" ,
        success: function(resp){ 

            if(resp.result=="success"){
                location.reload();
            }

        }  
    });
}

function deleteFromQuote(row_id,qdoci_id,from_page){

    // if(confirm("This action will delete item from the Quotation. Confirm?")){

        $.ajax({  
            type: "POST",  
            dataType: "json", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/deleteItemFromQuote" ,
            data:{
                "qdoci_id":qdoci_id
            },
            success: function(resp){ 

                if(resp.result=="success"){
                    sendToCart(resp.qdoc_id,from_page);
                }else{
                    alert(resp.msg);
                }
                /*if(resp.result=="success"){

                    var num_item = parseInt($('#count_item_row').val())-1;
                    $('#count_item_row').val(num_item);

                    $('#tr_'+row_id).fadeOut(500).html('');

                    if($('#sp_sum_total_edit').html()!=null){
                        var tmp_sum = parseInt($('#sp_sum_total_edit').html())-1;

                        $('#sp_sum_total_edit').html(tmp_sum);
                    }
                    
                }*/

            }  
        });

    //}

}

function addDuplicateToCart(qdoc_id){

    var num_item = parseInt($('#td_num_item'+qdoc_id).html());
    var est_number = 'DUP-'+$('#td_est_number'+qdoc_id).html();


    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/enableQuoteCart" ,
        data:{
            "qdoc_id":qdoc_id,
            "num_item":num_item,
            "est_number":est_number,
            "edit_after_approved":"yes"
        },
        success: function(resp){ 

            if(resp.result=="success"){
                window.location.href = "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/show/product/1";
            }

        }  
    });

}

function changeCustomerV2(){

    var cust_id = $('#cust_selector').val();

    $.ajax({  
        type: "POST",  
        dataType: "html", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/getCustomerInfo" ,
        data:{
            "cust_id":cust_id
        },
        success: function(resp){ 

            $('#pr_show_cust_info').html(resp);

        }  
    });
}

function changeQuoteHeadV2(){

    var head_select = $('#head_selector').val();
    if(head_select==""){
        alert("Please select header");
        return false;
    }

    var obj_comp = $.parseJSON( window.atob($('#hide_comp_info'+head_select).val()) );

    //alert( window.atob($('#hide_comp_info'+head_select).val()) );
    if(obj_comp.have_vat=="1"){
        $('.subnvat').show();
    }else{
        $('.subnvat').hide();
    }

    var head_img_logo = "";
    if( obj_comp.comp_logo!="" && obj_comp.comp_logo != null){
        head_img_logo = '<img style="max-height: 180px; max-width: 180px;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/'+obj_comp.comp_logo+'" >';
        $('#head_img_logo').html(head_img_logo);
    }else{
        $('#head_img_logo').html('');
    }

    var pre_comp_info = '<b>'+obj_comp.comp_name+'</b><br>'+obj_comp.comp_info;
    $('#pre_comp_info').html(pre_comp_info);

}

function changeIncludeVATV2(){

    var total_value = 0.0;

    if($('#inc_vat').prop("checked")){

        $('#sp_show_vat_value').html($('#pre_cost').val()+$('#vat_value').val());

        //var sub_total = parseFloat($('#sub_total').val());

        total_value = parseFloat($('#sub_total').val())+parseFloat($('#vat_value').val());
        $('#sp_show_total_value').html($('#pre_cost').val()+total_value.toFixed(2));
        $('#total_value').val(total_value);

        $('#sp_show_gtotal_value').html($('#pre_cost').val()+total_value.toFixed(2));
        $('#gtotal_value').val(total_value);

        $('#td_grand_total').html($('#pre_cost').val()+total_value.toFixed(2));
    }else{
        $('#sp_show_vat_value').html('');

        total_value = parseFloat($('#sub_total').val());
        $('#sp_show_total_value').html($('#pre_cost').val()+total_value.toFixed(2));
        $('#total_value').val(total_value);

        $('#sp_show_gtotal_value').html($('#pre_cost').val()+total_value.toFixed(2));
        $('#gtotal_value').val(total_value);

        $('#td_grand_total').html($('#pre_cost').val()+total_value.toFixed(2));
    }

}

function requestApprovalV2(){

    if($('#head_selector').val()==""){
        alert("Please select Header");
        return false;
    }

    if($('#cust_selector').val()==""){
        alert("Please select Customer");
        return false;
    }

    $('#btn_request_approve').prop("disabled",true).html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/requestApprove" ,
        data: $('#formQuote').serialize(),
        success: function(resp){ 

            //$('#quote_body').html(resp);
            
            if(resp.result=="success"){
                $.ajax({  
                    type: "POST",  
                    dataType: "html", 
                    url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/clearCart" ,
                    
                    success: function(resp2){ 

                        $('#cart_inner').html('');
                        $('#sp_sum_total').html(0);
                        $('#quoteModal').modal("toggle");
                        alert("Your Estimate Number is : "+resp.est_number+"\nApproval status show in Quotation menu.");

                        window.location.href = "<?php echo Yii::app()->request->baseUrl; ?>/quotation/newRequest";
                    }  
                });
            }else{
                alert("Error for saving data!");
                //$('#pr_show_cust_info').html(resp.msg);
            }
        }  
    });
}

function addItemRowV2(){
    var row_no = $('#count_item_row').val();

    var inner_new_row = '';
    inner_new_row += '<tbody id="tr_other'+row_no+'"><tr><td style="text-align:center;">'+row_no;

    if( $('#after_approved_editing').val()=="yes" || $('#edit_reject_quote').val()=="yes"){
        inner_new_row +=  '<input name="a_qdoci_id[]" type="hidden" value="new_other" >';
    }

    inner_new_row +=  '<input name="product_type[]" type="hidden" value="other" id="product_other'+row_no+'">';
    inner_new_row +=  '<input name="item_id[]" type="hidden" value="ot'+row_no+'" id="id_other'+row_no+'">';
    inner_new_row +=  '<input name="prg_id[]" type="hidden" value="" >';
    inner_new_row +=  '<input name="comm_percent[]" type="hidden" value="" id="comm_percent_other'+row_no+'">';
    inner_new_row +=  '<input name="qty_note[]" type="hidden" value="" id="qty_note_other'+row_no+'">';
    inner_new_row += '</td>';
    inner_new_row += '<td><textarea style="width:200px; min-height:80px; padding:5px;" name="product_item[]" id="product_item_other'+row_no+'"></textarea></td>';
    inner_new_row += '<td><textarea style="width:405px; min-height:80px; padding:5px;" name="product_desc[]" id="product_desc_other'+row_no+'"></textarea></td>';
    inner_new_row += '<td></td>';
    inner_new_row += '<td></td>';
    inner_new_row += '<td style="text-align:center;">';
    inner_new_row += '<input class="chk_qty" name="qty[]" id="qty_other'+row_no+'" type="number" min="0" style="text-align:center; width:50px;" onchange="return calPriceV2(\'other'+row_no+'\',1);" onkeyup="return calPrice(\'other'+row_no+'\',1);" value="">';
    inner_new_row += '</td>';
    
    inner_new_row += '<td style="text-align:center;"><input class="chk_uprice" name="uprice[]" type="number" min="0" id="uprice_other'+row_no+'" style="text-align:center; width:50px; " onchange="return calPrice(\'other'+row_no+'\',1);" onkeyup="return calPrice(\'other'+row_no+'\',1);"></td>';
    inner_new_row += '<td style="text-align:center;" id="amount_other'+row_no+'"></td>';
    inner_new_row += '<td style="text-align:center;"><button type="button" class="btn btn-danger" onclick="return deleteRow(\'other'+row_no+'\',1);">Del</button></td>';
    inner_new_row += '</tr></tbody>';

    $('#tbl_cart_info').append(inner_new_row); 

    row_no = parseInt(row_no)+1;
    $('#count_item_row').val(row_no);
}

function editUnitPrice(row_id,uprice_ori,qdoci_id){

    var new_uprice_ori = prompt("Edit the original unit price:",uprice_ori);

    if(new_uprice_ori!=null && new_uprice_ori!=""){

        /*$.ajax({  
            type: "POST",  
            dataType: "json", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/updateUPriceOri" ,
            
            success: function(resp){ 

                if(resp.result=="success"){
                    $('#select_'+row_id).val("0|0.0");
                    selectAddi(row_id);
                }
            }  
        });*/
        $('#uprice_'+row_id).val(new_uprice_ori);
        $('#old_uprice_'+row_id).val(new_uprice_ori);
        $('#select_'+row_id).val("0|0.0");
        selectAddi(row_id);
        
    }

    

}
</script>