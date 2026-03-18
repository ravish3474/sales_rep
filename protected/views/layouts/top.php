<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style type="text/css">
    #cart_inner {
        max-height: 450px;
        overflow-y: auto;
        overflow-x: auto;
        
    }

    .select2-container--default {
        width: auto !important;
    }

    #quoteV2Modal .select2-container--default {
        width: 100% !important;
    }

    #quoteV2Modal .select2-selection__rendered {
        line-height: 32px;
        border-radius: 2px !important;
    }

    .select2.select2-container.select2-container--default {
        max-width: 50% !important;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    #quoteV2Modal .select2-container .select2-selection--single {
        height: 34px !important;
    }

    .addRowIcon {
        color: green;
        border: 2px solid green;
        border-radius: 50%;
        /* Make the icon circular */
        padding: 5px;
        /* Increase padding for spacing */
        margin-right: 5px;
        /* Adjust margin as needed */
    }

    .deleteRowIcon {
        color: red;
        border: 2px solid red;
        border-radius: 50%;
        /* Make the icon circular */
        padding: 5px;
        /* Increase padding for spacing */
    }

    .tbl-cart-info {
        width: 100%;
        margin: 5px;
    }

    .tbl-cart-info th {
        background-color: #AFA;
        outline: 1px solid #DDD;
        padding: 2px;
    }

    .tbl-cart-info td {
        font-size: 11px;
        word-wrap: break-word;
        vertical-align: middle;
        background-color: #FFF;
        outline: 1px solid #DDD;
        text-align: left;
        padding: 2px;
    }

    .tbl-cart-info tr:hover td {
        background-color: #EEE;
    }

    .tbl-addi-info th {
        background-color: #AAF;
        outline: 1px solid #DDD;
        padding: 5px;
        color: #000;
    }

    .tbl-addi-info td {
        font-size: 11px;
        word-wrap: break-word;
        vertical-align: middle;
        background-color: #FFF;
        outline: 1px solid #DDD;
        text-align: left;
        padding: 2px;
    }

    .tbl-addi-info tr:hover td {
        background-color: #EEE;
    }

    .addi-btn {
        padding: 2px 5px;
    }

    #quote_head {
        border-bottom: 2px solid #EEE;
        padding-bottom: 0px;
    }

    #quote_head img {
        max-height: 180px;
        max-width: 180px;
    }

    #quote_head h2 {
        font-size: 28px;
        font-weight: bold;
        color: #000;
    }

    #quote_head pre,
    #quote_body pre {
        font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;
        border: 0px;
        background-color: #FFF;
        font-size: 14px;
        color: #000;
        line-height: 1;
        margin: 0px;
    }

    .est_zone th {
        text-align: right;
        color: #000;
    }

    .est_zone td {
        text-align: left;
        color: #000;
        padding-left: 10px;
    }

    .item_zone {
        color: #000;
    }

    .item_zone th {
        font-size: 15px;
    }

    .item_zone td {
        font-size: 13px;
    }

    .total_zone td {
        padding: 10px 0px;
    }

    .move_btn {
        cursor: pointer;
        font-size: 16px;
        color: #772;
    }

    .bell .dropdown-toggle:focus {
        background-color: transparent
    }

    #cartV2Modal .modal-dialog {
        width: 70% !important;
        transition: .5s ease-in-out;
    }

    #cartV2Modal.fullscreen .modal-dialog {
        width: 100% !important;
        max-width: 100% !important;
        display: flex;
        height: 100%;
        overflow: hidden;
    }

    #tbl_cart_info td select {
        min-width: 100%;
    }

    #cartV2Modal.fullscreen .modal-dialog #formCart {
        height: 90vh;
        padding-bottom: 5vw;

    }

    #cartV2Modal.fullscreen .modal-dialog #cart_inner {
        max-height: 100% !important;
    }

    #quoteDocModal #product_list input {
        width: 100%;
        padding: 0 2px;
    }

    #quoteDocModal #product_list select {
        width: 100%;
        padding: 0;
        height: auto;
    }


    #quoteConvertModal .modal-dialog {
        width: 50%;
    }

    #quoteConvertModal .form-horizontal .control-label {
        margin-top: 8px;
        margin-bottom: 0;
        font-size: 14px;
        padding: 0 10px;
    }

    #quoteConvertModal .select2.select2-container.select2-container--default,
    #quoteConvertModal .select2-search__field {
        max-width: 100% !important;
        width: 100% !important;
        min-height: 120px;
        margin-bottom: 10px;
    }

    #quoteConvertModal .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #1479B81A;
        border: 1px solid #1479B8;
    }

    #quoteConvertModal .select2-container .select2-selection--multiple .select2-selection__rendered {
        position: absolute;
        top: 10px;
        left: 10px;
    }

    #quoteConvertModal select {
        width: 100%;
        padding: 6px;
        border: 1px solid #d7d7d7;
    }

    #quoteConvertModal input {
        width: 100%;
        padding: 2px 6px;
        border: 1px solid #d7d7d7;
    }

    .addRowIcon {
        padding: 3px 4px;
        margin: 0 auto;
    }

    .deleteRowIcon {
        padding: 3px 4px;
        margin: 0 auto;
    }

    /*  */
    #quoteV2Modal {
        overflow-y: scroll;
        scrollbar-width: none;
    }

    #quoteV2Modal select {
        background: #e6eff6;
        border: none;
        text-align: left;
        padding: 8px 10px !important;
        width: auto !important;
    }

    #quoteDocModal .alert-success a {
        color: #FFF !important;
        font-size: 14px;
        text-transform: capitalize;
    }

    #quoteV2Modal #quote_head select {
        width: 50%;
        padding: 8px 10px !important;
        font-size: 13px;
    }

    #quoteV2Modal .container {
        width: 100%;
        padding: 0 10px;
    }

    #quoteV2Modal .item_zone th {
        font-size: 12px;
    }

    #quoteV2Modal .total_zone input {
        padding: 5px;
        margin-bottom: 5px;
    }

    #quoteV2Modal .est_zone input {
        width: 100% !important;
    }

    #quoteV2Modal .modal-dialog {
        width: 80% !important;
    }

    .modal.in table th {
        font-size: 12px;
    }

    /* #quoteV2Modal .total_zone th {
        background: none;
    } */

    #quoteV2Modal .total_zone select {
        font-size: 12px;
    }

    #cartV2Modal .modal-dialog {
        width: 70% !important;
    }


    /* 20-Nov  */

    #newCustomerForm {
        background: none;
        border: 1px solid #DDD;
        padding: 20px;
        border-radius: 4px;
        margin-top: 10px;
        padding-top: 20px;
        width: 100%;
    }

    #newCustomerForm #updateCustomerAjax {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    #newCustomerForm .submitBtn {
        background: #5CB85C;
        border: 2px solid #5CB85C;
        color: #FFF;
        padding: 8px 10px;
        margin: 5px 0;
        width: 100%;
        border-radius: 3px;
        height: 40px;
    }

    #quoteV2Modal #cust_selector {
        height: 38px !important;
        cursor: pointer;

    }

    .tooltip-button {
        position: relative;
        top: 2px;
    }


    .tooltip-button:hover::after {
        content: "Add New Customer";
        position: absolute;
        top: -35px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #54626F;
        color: white;
        padding: 5px 20px;
        border-radius: 3px;
        font-size: 14px;
        white-space: nowrap;
        z-index: 100;
        font-size: 13px;
    }

    #newCustomerForm input,
    #newCustomerForm textarea {
        margin: 5px 0;
        background: #EEEEEE;
        border: 1px solid #DDD;
        padding: 10px;
        color: #2A3F54;
        width: 100%;
        min-width: 100%;
        max-width: 100%;
        height: 40px;
        max-width: 110px;
        min-height: 40px;
    }

    .ck.ck-editor__top.ck-reset_all {
        position: sticky;
        top: 0;
        z-index: 1;
    }

    .ck.ck-editor__main ul {
        padding-left: 25px;
    }

    .ck.ck-reset.ck-editor.ck-rounded-corners {
        min-width: 250px;
        height: 150px;
        overflow-y: scroll;
    }

    #cartV2Modal #tbl_cart_info td select {
        min-height: 150px;
        padding: 0;
        overflow-y: auto;

    }

    #cartV2Modal {
        padding-right: 0 !important;
    }

    #cartV2Modal .modal-content {
        width: 100%;
    }

    #cartV2Modal .btn.btn-danger {
        padding: 1px 10px;
        font-size: 12px;
        font-weight: 600;
    }

    #cartV2Modal #tbl_cart_info td textarea {
        height: 150px;
    }

    .stickyheader {
        position: sticky;
        top: 0;
        z-index: 1001;
    }

    .stickyheader th {
        padding: 10px 15px !important;
    }

    #cartV2Modal #tbl_cart_info option {
        padding: 4px 5px;
        border-bottom: 1px solid #FFF;
    }


    #cartV2Modal.fullscreen #tbl_cart_info td textarea {
        min-width: 18vw !important;
        width: 100%;

    }

    /* 20-Nov  */
    #cartV2Modal #tbl_cart_info td select {
        min-width: 240px;
    }

    .FullscreenBtn {
        border: none;
        background: #1479B8;
        padding: 3px 7px;
        color: #FFF;
        float: right;
        position: absolute;
        right: 45px;
        top: 13px;
        cursor: pointer;
    }

    #quoteV2ModalForm #head_selector {
        padding: 8px 10px !important;
        width: auto;
        margin-bottom: 10px;
    }

    .modal.in h1 {
        font-size: 15px;
    }

    #customerForm input {
        border: 1px solid #D9E4EE !important;
    }

    #editCustomerModalLive .smallModal,
    #updateCustomerModalLive .smallModal {
        max-width: 40vw !important;
        HEIGHT: 100%;
        display: flex;
        align-items: center;
    }

    #editCustomerModalLive,
    #updateCustomerModalLive {
        background: #1c1e20d1;
    }

    #editCustomerModalLive .smallModal label,
    #updateCustomerModalLive .smallModal label {
        color: #14171a;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 10px;
        display: block;
        margin: 10px 0;
    }

    /*  */

    .smallModal .modal-content {
        border-radius: 8px !important;
        overflow: hidden;
        width: 100% !important;
    }

    .smallModal input,
    .smallModal select,
    .smallModal textarea {
        padding: 10px;
        box-shadow: none;
        border-radius: 4px !important;
        color: #999999;
        border: 1px solid #D9E4EE !important;
        background: #FFFFFF !important;
        font-weight: 400;
        width: 100%;
    }

    @media screen and (max-width:1500px) {
        #quoteDocModal .modal-dialog {
            width: 90% !important;
        }

        div#d_quote_body {
            overflow: scroll;
        }
    }

    @media screen and (max-width:1400px) {
        #cartV2Modal .modal-dialog {
            width: 90% !important;
        }

    }

    @media screen and (max-width:1052px) {
        #quoteDocModal .modal-dialog {
            width: 100% !important;
        }


    }

    @media screen and (max-width:1300px) {
        #cartV2Modal .modal-dialog {
            width: 80% !important;
        }
    }

    @media screen and (max-width:1252px) {
        #quoteDocModal .modal-dialog {
            width: 95% !important;
        }

        #editCustomerModalLive .smallModal {
            max-width: 50vw !important;
        }
    }

    @media screen and (max-width:520px) {
        #cartV2Modal form {
            overflow: hidden;
        }

        #quoteDocModal .modal-dialog {
            width: 100% !important;
        }

        #cart_inner {
            overflow-x: scroll;
        }

        #cartV2Modal .modal-dialog {
            width: 100% !important;
        }
    }



    @media screen and (max-width:520px) {

        #quoteV2Modal .modal-dialog {
            width: 100% !important;
        }

        #quoteV2Modal form {
            overflow: hidden;
        }

        #quoteConvertModal form {
            width: 100%;
            overflow: hidden;
        }

        #quoteConvertModal .col-md-12 {
            float: unset;
        }

        #quoteConvertModal .form-horizontal .control-label {
            width: 100%;
        }

        #quoteConvertModal .modal.in table th {
            padding: 6px 6px !important;
            text-align: center !important;
        }

        #quoteConvertModal select,
        input {
            font-size: 11px;
            padding: 7px 0;
        }
    }

    .loader_container {
        padding: 0;
        position: fixed;
        height: 100%;
        width: 100%;
        background: #3e39399e;
        /* z-index: 0; */
        top: 0;
        bottom: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        display: none;
        z-index: 6000;

    }

    .loader {
        width: 50px;
        height: 50px;
        border-radius: 100%;
        position: relative;
        margin: 0 auto;

    }

    #loader-1:before,
    #loader-1:after {
        content: "";
        position: absolute;
        top: -10px;
        left: -10px;
        width: 100%;
        height: 100%;
        border-radius: 100%;
        border: 10px solid transparent;
        border-top-color: #3498db;
    }

    #loader-1:before {
        z-index: 100;
        animation: spin 1s infinite;
    }

    #loader-1:after {
        border: 10px solid #ccc;
    }

    @keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    .notification_dropdown h1 {
        background:
            #FFF;
        box-shadow: rgb(0 0 0 / 8%) 0px 5px 15px;
        font-size: 18px;
        padding:
            15px 20px;
        margin:
            0 0 15px 0;
        position: sticky !important;
        top: 0px;
        z-index: 1000;
    }

    .top_nav .label-warning {
        margin-right: 8px;
    }

    .dropdown-menu.bell.notification_dropdown {
        min-width: 550px;
    }

    .top_nav .dropdown-menu li a {
        font-size: 13px;
        border-bottom: 1px solid #5555551f;
    }

    .dropdown-menu.bell.notification_dropdown .notify-link {
        white-space: normal;
    }

    .dropdown-menu.bell.notification_dropdown .notify-link strong {
        text-transform: capitalize;
    }

    .dropdown-menu span {
        font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;
    }

    .top_nav .label-warning {
        font-size: 12px;
    }

    .glyphicon {
        font-family: 'Glyphicons Halflings' !important;
    }

    .mention-tag {
        background-color: #34495e;
        color: #fff;
        padding: 2px 6px;
        margin: 0 2px;
        border-radius: 4px;
        display: inline-block;
        text-align: left;
    }

    /* Add this to your global CSS */
    #tbl_cart_info select[multiple] option:checked {
        background-color: #0a4e97ff !important;
        color: white !important;
    }

    #tbl_cart_info select[multiple]:focus option:checked {
        background-color: #0a4e97ff !important;
    }

    #add_comment_drive textarea {
        width: 100% !important;

    }

    #add_comment_drive .select2.select2-container.select2-container--default {
        max-width: 100% !important;
    }

    #add_comment_drive #select2-selector_gdrive-container {
        padding: 10px;
    }

     #d_approval_comment .fa-trash-o{
         display: none !important;
    }
</style>


<?php

$user_group = Yii::app()->user->getState('userGroup');

$user_id = Yii::app()->user->getState('userKey');

$full_name = Yii::app()->user->getState('fullName');

if ($user_group == "99" || $user_group == "1") {

    $chat_type = "A";
} else {

    $chat_type = "E";
}

/* ✅ Currency mapping array */
$currency_map = [
    7 => '(USD)',
    3 => '(CAD)',
    1 => '(THB)',
    9 => '(SGD/USD)'
];

?>

<div class="top_nav">



    <div class="nav_menu">

        <nav class="" role="navigation">

            <div class="nav toggle">

                <a id="menu_toggle"><i class="fa fa-bars"></i></a>

            </div>



            <ul class="nav navbar-nav navbar-right">

                <li class="cart-side"><?php
                                        $b_show_exit = false;

                                        $s_controller = strtolower(Yii::app()->controller->id);
                                        $s_method = strtolower(Yii::app()->controller->action->id);
                                        //echo "<pre>"; echo $s_controller; echo "</pre>";
                                        if ($s_controller == "priceguide" || (($s_controller == "priceguidev2") && (!in_array($s_method, array("adminshow", "adminshowextra", "adminpanel"))))) {

                                            if (isset($_COOKIE["JOG_CART_Quote"])) {

                                                $b_show_exit = true;
                                                $obj_quote = json_decode($_COOKIE["JOG_CART_Quote"]);
                                        ?>
                            <button title="Estimate Add items mode" class="btn btn-warning" style="float: left; margin-right: -50px; margin-left: -230px !important; margin-top: 10px; font-size: 16px;" data-toggle="modal" data-target="#showItemAddedModal" onclick="showItemAddMode(<?php echo $obj_quote->qdoc_id; ?>);">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                (<span id="sp_sum_total_edit"><?php echo $obj_quote->num_item; ?></span>) <?php echo $obj_quote->est_number; ?>
                            </button>
                            <input type="hidden" id="qdoc_id_editing" value="<?php echo $obj_quote->qdoc_id; ?>">
                            <input type="hidden" id="after_approved_editing" value="<?php echo $obj_quote->edit_after_approved; ?>">
                        <?php

                                            } else {

                                                $sum_total = 0;
                                                if (isset($_COOKIE["JOG_CART_info"]) && $_COOKIE["JOG_CART_info"] != "") {

                                                    $sql_select = " SELECT * FROM tbl_cart_temp WHERE cart_tmp_id='" . $_COOKIE["JOG_CART_info"] . "'; ";
                                                    $a_tmp_obj = Yii::app()->db->createCommand($sql_select)->queryAll();
                                                    if (sizeof($a_tmp_obj) > 0) {
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
                            <?php
                                                if (Yii::app()->user->getState('quotePermission') == 1) {
                            ?>
                                <button class="btn btn-primary cart-btn" style="float: left;" data-toggle="modal" data-target="#cartV2Modal" onclick="showCartV2(1);">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    (<span id="sp_sum_total"><?php echo $sum_total; ?></span>)
                                </button>
                            <?php } ?>
                            <input type="hidden" id="after_approved_editing" value="no">
                    <?php
                                            }
                                        }
                    ?>
                </li>



                <li class="dropdown bell">

                    <a href="#" class="dropdown-toggle inbox" data-toggle="dropdown">

                        <img src="https://sales.jog-joinourgame.com/images/568181.png" height="30" width="30" class=" avatar-img img-square">

                        <?php

                        $user_id = Yii::app()->user->getState('userKey');

                        $noti_sql = "SELECT COUNT(*) as total_noti FROM notifications WHERE employee_id='$user_id' AND noti_status='0'";

                        $noti_quoute = Yii::app()->db->createCommand($noti_sql)->queryAll();

                        if ($noti_quoute[0]['total_noti'] != 0) {

                        ?>

                            <span class="badge badge-notify noti_main"><?= $noti_quoute[0]['total_noti'] ?></span>

                        <?php } ?>

                    </a>

                    <ul class="dropdown-menu bell" style="overflow-y: scroll;height: 400px;margin-top:0;min-width: 500px;" role="menu">
                        <li>

                            <div class="container text-center notification-btns">

                                <button class="btn btn-primary mark_all_noti">Mark All Read</button>

                                <button class="btn btn-primary delete_all_noti">Delete All</button>

                            </div>

                        </li>
                        <?php

                        $noti_sql = "SELECT noti_id,user.fullname AS from_emp_name,tbl_quote_doc.est_number AS est_num,notifications.doc_id as doc_id,notifications.noti_date as noti_date,notifications.noti_detail as noti_detail,noti_status,item_id,link_id FROM notifications LEFT JOIN tbl_quote_doc ON tbl_quote_doc.qdoc_id=notifications.doc_id JOIN user ON user.id=notifications.noti_from_employee WHERE notifications.employee_id='$user_id' ORDER BY notifications.noti_date DESC";

                        $noti_quoute = Yii::app()->db->createCommand($noti_sql)->queryAll();

                        foreach ($noti_quoute as $noti_data) {

                        ?>

                            <li style="display: flex;" id="noti_id_<?= $noti_data['noti_id'] ?>">

                                <input type="checkbox" title="Mark Read" noti_id="<?= $noti_data['noti_id'] ?>" class="noti_checkbox" <?php

                                                                                                                                        if ($noti_data['noti_status'] == 1) {

                                                                                                                                            echo "checked";
                                                                                                                                        }

                                                                                                                                        ?> style="margin-top: 15px;margin-left: 10px;">

                                <?php

                                if ($noti_data['doc_id'] == 0) {

                                ?>

                                    <a href="javascript:void(0);" onclick="gdriveNoti(<?= $noti_data['item_id'] ?>,<?= $noti_data['link_id'] ?>)"><span class="label label-warning"><?= $noti_data['noti_date'] ?></span><span class="notify-link"> <?= $noti_data['from_emp_name'] ?> Commented on Gdrive Link.</span></a>

                                    <?php

                                } else {
                                    if ($noti_data['noti_detail'] == 'Private Comment') {
                                    ?>
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotation(<?= $noti_data['doc_id'] ?>,'vp');"><span class="label label-warning"><?= $noti_data['noti_date'] ?></span><span class="notify-link"> <?= $noti_data['from_emp_name'] ?> added a Private Note on Estimate Number <?= $noti_data['est_num'] ?></span></a>
                                    <?php
                                    } else {
                                    ?>

                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotation(<?= $noti_data['doc_id'] ?>,'vp');"><span class="label label-warning"><?= $noti_data['noti_date'] ?></span><span class="notify-link"> <?= $noti_data['from_emp_name'] ?> Commented on Estimate Number <?= $noti_data['est_num'] ?></span></a>

                                <?php
                                    }
                                }

                                ?>

                                <span class="glyphicon glyphicon-trash noti_delete" noti_id="<?= $noti_data['noti_id'] ?>" title="Delete Notification" style="margin-top:12px;margin-right: 10px "></span>

                            </li>

                            <li class="divider"></li>

                        <?php } ?>



                    </ul>

                </li>


                <li class="dropdown bell  comment_notification_box"></li>


                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/jog_athl.png" alt=""><?php echo Yii::app()->user->getState('fullName'); ?>

                        <span class=" fa fa-angle-down"></span>

                    </a>

                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">

                        <li><a href="#" data-toggle="modal" data-target="#profileModal" id="profile-top" user-key="<?php echo Yii::app()->user->getState('userKey'); ?>"> Profile</a>

                        </li>

                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/site/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>

                        </li>

                    </ul>



                </li>

            </ul>





        </nav>

    </div>

    <!-- <pre id="test_msg"></pre> -->

</div>



<script>
    $(document).ready(function() {

        $(".noti_checkbox").change(function() {

            var noti_id = $(this).attr('noti_id');

            var noti_status = 0;

            if (this.checked) {

                noti_status = 1;

            }

            $.ajax({

                type: 'POST',

                data: {

                    noti_id: noti_id,

                    noti_status: noti_status

                },

                url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/markNoti',

                success: function(response) {

                    var response = JSON.parse(response);

                    if (response.status = "success") {

                        $('.noti_main').text(response.msg);

                    } else {

                        alert('Something Went Wrong');

                    }

                }

            })

        });

    })



    $(document).on('click', '.noti_delete', function() {

        var noti_id = $(this).attr('noti_id');

        $.ajax({

            type: 'POST',

            data: {

                noti_id: noti_id

            },

            url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/deleteSingleNoti',

            success: function(response) {

                var response = JSON.parse(response);

                if (response.status = "success") {

                    $('.noti_main').text(response.msg);

                    $('#noti_id_' + noti_id).remove();

                } else {

                    alert('Something Went Wrong');

                }

            }

        })

    })



    function viewQuotationDraft(qdoc_id, action_from) {



        $('#main_qdoc_id').val(qdoc_id);

        $('#view_doc_id').val(btoa(qdoc_id));

        $('#quote_approve_bar').show();



        $('#d_quote_body').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');



        $('#head_selector_app').hide();

        $('#btn_approve').hide();

        $('#btn_save').hide();

        $('#btn_reject').hide();

        $('#btn_print').hide();

        $('#btn_refresh_date').hide();

        $('#d_quote_below').hide();

        $('#sp_remark').hide();



        $.ajax({

            type: "POST",

            dataType: "json",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/showQuoteViewDraft",

            data: {

                "qdoc_id": qdoc_id,

                "action_from": action_from

            },

            success: function(resp) {

                $('#d_quote_body').html(resp.inner_content);



                $('#quote_history').hide();



                $('#d_approval_comment').html(window.atob(resp.approval_comment));

                $('#btn_approve').hide();

                $('#btn_save').hide();

                $('#btn_reject').hide();

                $('#btn_print').show();

                // if(resp.show_approve=="yes"){

                //     $('#btn_approve').show();

                //     $('#d_quote_below').show();

                //     $('#sp_remark').show();

                //     //$('.subnvat').hide();



                //     if(action_from=='va'){

                //         $('#head_selector_app').show();

                //         $('#head_selector_app').val(resp.comp_id);

                //         $('#note_text').val(window.atob(resp.qnote_text));

                //         changeQuoteHeadApp();

                //     }



                //     //alert(resp.history_inner);

                //     if(resp.history_inner!=""){

                //         $('#quote_history').show();

                //         $('#select_history').html(resp.history_inner);

                //     }



                // }

                // if(resp.show_reject=="yes"){

                //     $('#btn_reject').show();

                //     $('#sp_remark').show();

                // }

                // if( resp.show_print=="yes" ){

                //     //if(action_from=="vp"){

                //         $('#btn_print').show();

                //         $('#btn_refresh_date').show();

                //     //}



                // }



                $.ajax({

                    type: 'POST',

                    data: {

                        chat_type: "<?= $chat_type ?>",

                        doc_id: qdoc_id,

                        emp_id: "<?= $user_id ?>",

                    },

                    url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/fetchChats',

                    success: function(response) {

                        var response = JSON.parse(response);

                        if (response.status == 1) {

                            $('#d_approval_comment').append(response.msg);

                        }

                    }

                })



                $.ajax({

                    type: 'POST',

                    data: {

                        doc_id: qdoc_id

                    },

                    url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/fetchSalesNotes',

                    success: function(response) {



                        var response = JSON.parse(response);

                        if (response.status == "0") {

                            $('#notes_modal_div').hide();

                        } else {

                            $('#pre_sale_note_modal').html(response.note);

                            $('#notes_modal_div').show();

                        }

                    }

                })



            }

        });

    }



    function viewQuotation(qdoc_id, action_from, openby = '') {


        if(openby == 'Approve'){
            $('.byapprove').show();
        }else{
            $('.byapprove').hide();
        }
        
        $('#main_qdoc_id').val(qdoc_id);

        $('#view_doc_id').val(btoa(qdoc_id));

        $('#quote_approve_bar').show();



        $('#d_quote_body').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');



        $('#head_selector_app').hide();

        $('#btn_approve').hide();

        $('#btn_save').hide();

        $('#btn_reject').hide();

        $('#btn_print').hide();

        $('#btn_refresh_date').hide();

        $('#d_quote_below').hide();

        $('#sp_remark').hide();



        $.ajax({

            type: "POST",

            dataType: "json",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/showQuoteView",

            data: {

                "qdoc_id": qdoc_id,

                "action_from": action_from

            },

            success: function(resp) {

                $('#d_quote_body').html(resp.inner_content);



                $('#quote_history').hide();



                $('#d_approval_comment').html(window.atob(resp.approval_comment));

                if (resp.save_quote == "1") {
                    $('#btn_save').text('Saved Data');
                    $('#btn_save').addClass('btn-warning');
                    $('#btn_save').removeClass('btn-primary');
                } else {
                    $('#btn_save').text('Save Data');
                    $('#btn_save').removeClass('btn-warning');
                    $('#btn_save').addClass('btn-primary');
                }

                if (resp.show_approve == "yes") {

                    $('#btn_approve').show();

                    $('#btn_save').show();

                    $('#d_quote_below').show();

                    $('#sp_remark').show();

                    //$('.subnvat').hide();



                    if (action_from == 'va') {

                        $('#head_selector_app').show();

                        $('#head_selector_app').val(resp.comp_id);

                        $('#note_text').val(window.atob(resp.qnote_text));

                        changeQuoteHeadApp();

                    }

                     if(action_from == 'vb'){
                        $('#head_selector_app').show();

                        $('#head_selector_app').val(resp.comp_id);

                       $('#note_text').val(window.atob(resp.qnote_text));

                       changeQuoteHeadApp();
                   }



                    //alert(resp.history_inner);

                    if (resp.history_inner != "") {

                        $('#quote_history').show();

                        $('#select_history').html(resp.history_inner);

                    }



                }

                if (action_from == "vp") {

                    $('#cust_selector').hide();

                }

                if (resp.show_reject == "yes") {

                    $('#btn_reject').show();

                    $('#sp_remark').show();

                }

                if (resp.show_print == "yes") {

                    //if(action_from=="vp"){

                    $('#btn_print').show();

                    $('#btn_refresh_date').show();

                    //}



                }
                if (action_from != "vp") {
                    <?php
                    if ($user_id != "21") {
                    ?>
                        $('#cust_selector').select2({
                            dropdownParent: $("#quoteDocModal")
                        });
                    <?php
                    }
                    ?>
                }

                $(document).on("change", "input[name='allow_comm']", function() {
                    let total = 0;

                    if ($(this).is(":checked")) {
                        $(".comm_val_cell").each(function() {
                            let val = parseFloat($(this).data("comm-value")) || 0;
                            $(this).text(val.toFixed(2));
                            total += val;
                        });
                    } else {
                        $(".comm_val_cell").each(function() {
                            $(this).text("0");
                        });
                        total = 0;
                    }

                    // Update the total cell
                    $("#td_comm_total").text(total.toFixed(2));
                });



                $.ajax({

                    type: 'POST',

                    data: {

                        chat_type: "<?= $chat_type ?>",

                        doc_id: qdoc_id,

                        emp_id: "<?= $user_id ?>",

                    },

                    url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/fetchChats',

                    success: function(response) {

                        var response = JSON.parse(response);

                        if (response.status == 1) {

                            $('#d_approval_comment').append(response.msg);

                        }

                    }

                })



                $.ajax({

                    type: 'POST',

                    data: {

                        doc_id: qdoc_id

                    },

                    url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/fetchSalesNotes',

                    success: function(response) {



                        var response = JSON.parse(response);

                        if (response.status == "0") {

                            $('#notes_modal_div').hide();

                        } else {

                            $('#pre_sale_note_modal').html(response.note);

                            $('#notes_modal_div').show();

                        }

                    }

                })



            }

        });

    }

    function deletcom(chat_id) {

        if (confirm('Are you sure want to delete?')) {

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/deleteChat",
                data: {
                    "chat_id": chat_id,
                },
                success: function(resp) {
                    $('#dltdiv' + chat_id).hide();
                }
            })

        }

    }


    $(document).on('change', '#viewQuotationNew', function() {

        var qdoc_id = $(this).attr("qdoc_id");

        var action_from = $(this).attr("action_from");

        var symbol = $('option:selected', this).attr('curr_symbol');

        var curr_id = $(this).val();

        var old_curr_id = $('#old_curr_id').val();

        $('#main_qdoc_id').val(qdoc_id);

        $('#view_doc_id').val(btoa(qdoc_id));

        $('#quote_approve_bar').show();



        $('#d_quote_body').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');



        $('#head_selector_app').hide();

        $('#btn_approve').hide();

        $('#btn_save').hide();

        $('#btn_reject').hide();

        $('#btn_print').hide();

        $('#btn_refresh_date').hide();

        $('#d_quote_below').hide();

        $('#sp_remark').hide();



        $.ajax({

            type: "POST",

            dataType: "json",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/showQuoteViewCurrChange",

            data: {

                "qdoc_id": qdoc_id,

                "action_from": action_from,

                "symbol": symbol,

                "curr_id": curr_id,

                "old_curr_id": old_curr_id

            },

            success: function(resp) {

                $('#d_quote_body').html(resp.inner_content);



                $('#quote_history').hide();



                $('#d_approval_comment').html(window.atob(resp.approval_comment));



                if (resp.show_approve == "yes") {

                    $('#btn_approve').show();

                    $('#btn_save').show();

                    $('#d_quote_below').show();

                    $('#sp_remark').show();

                    //$('.subnvat').hide();



                    if (action_from == 'va') {

                        $('#head_selector_app').show();

                        $('#head_selector_app').val(resp.comp_id);

                        $('#note_text').val(window.atob(resp.qnote_text));

                        changeQuoteHeadApp();

                    }



                    //alert(resp.history_inner);

                    if (resp.history_inner != "") {

                        $('#quote_history').show();

                        $('#select_history').html(resp.history_inner);

                    }



                }

                if (resp.show_reject == "yes") {

                    $('#btn_reject').show();

                    $('#sp_remark').show();

                }

                if (resp.show_print == "yes") {

                    //if(action_from=="vp"){

                    $('#btn_print').show();

                    $('#btn_refresh_date').show();

                    //}



                }



                $.ajax({

                    type: 'POST',

                    data: {

                        chat_type: "<?= $chat_type ?>",

                        doc_id: qdoc_id,

                        emp_id: "<?= $user_id ?>",

                    },

                    url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/fetchChats',

                    success: function(response) {

                        var response = JSON.parse(response);

                        if (response.status == 1) {

                            $('#d_approval_comment').append(response.msg);

                        }

                    }

                })



                $.ajax({

                    type: 'POST',

                    data: {

                        doc_id: qdoc_id

                    },

                    url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/fetchSalesNotes',

                    success: function(response) {



                        var response = JSON.parse(response);

                        if (response.status == "0") {

                            $('#notes_modal_div').hide();

                        } else {

                            $('#pre_sale_note_modal').html(response.note);

                            $('#notes_modal_div').show();

                        }

                    }

                })



            }

        });

    })



    $(document).on('click', '.delete_all_noti', function() {
        let is_crm = $(this).data('is_crm'); 
      

        $.ajax({

            type: 'GET',

             data: { is_crm : is_crm } ,

            url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/DeleteAllNoti',

            success: function(response) {

                var response = JSON.parse(response);

                if (response.result == "success") {

                    $('.dropdown-menu').empty();

                    $('.badge-notify').hide();

                } else {

                    alert(response.result);

                }

            }

        })

    })



    $(document).on('click', '.mark_all_noti', function() {
    let is_crm = $(this).data('is_crm'); 

        $.ajax({

            type: 'GET',
             data: { is_crm : is_crm } ,

            url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/MarkAllNoti',

            success: function(response) {

                var response = JSON.parse(response);

                if (response.result == "success") {

                    $('.badge-notify').hide();

                } else {

                    alert(response.result);

                }

            }

        })

    })
</script>

<script type="text/javascript">
    $(document).on('click', '#reply_btn', function() {

        $(this).hide();

        $('#reply_to_comment').show();

    })



    $(document).on('click', '#cancel_btn', function() {

        $('#reply_to_comment').hide();

        $('#reply_btn').show();

    })



    $(document).on('click', '.email_submit', function() {
        let contentEditableDiv = $('#text_comment');
        let text = contentEditableDiv.html().trim();

        if (text.length > 0) {
            let mentioned = [];

            const $emailBtn = $(this);
            $emailBtn.prop('disabled', true).text('Sending...');
            // 1. Get mentions from styled <span class="mention-tag" data-user="...">
            contentEditableDiv.find('.mention-tag').each(function() {
                let val = $(this).data('user');
                if (val && !mentioned.includes(val)) {
                    mentioned.push(val);
                }
            });

            // 2. Also extract raw #mentions from plain text (like #email@example.com)
            let rawMentions = text.match(/#([\w\.\-@]+)/g) || [];
            rawMentions.forEach(function(tag) {
                let clean = tag.replace('#', '').trim();
                if (!mentioned.includes(clean)) {
                    mentioned.push(clean);
                }
            });

            // Set the plain text content to hidden input
            $('#text_comment_hidden').val(text);

            // Prepare form data
            let data = $('#reply_to_comment').serializeArray();
            data.push({
                name: 'mentions',
                value: JSON.stringify(mentioned)
            });

            $.ajax({
                type: 'POST',
                data: $.param(data),
                url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/AddChatEmail',
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.result == "success") {
                        var html = '<div><center><pre class="alert" style="text-align:right; width:100%; height:100%; max-width:900px; overflow-x:auto; color:#FFF; background-color:#990;">' + text + '</pre></center></div>';
                        $('#d_approval_comment').append(html);
                        contentEditableDiv.html(""); // Clear
                        $('#text_comment_hidden').val("");
                    } else {
                        alert(response.result);
                    }
                },
                complete: function() {
                    $emailBtn.prop('disabled', false).text('Submit & Send Email');
                }
            });
        } else {
            alert('Please type something to continue');
        }
    });





    $(document).on('submit', '#reply_to_comment', function(e) {

        e.preventDefault();

        const $submitBtn = $(this).find('button[type="submit"]');
        $submitBtn.prop('disabled', true).text('Submitting...');

        var form = $(this);

        var text = $('#text_comment').html().trim();
        // Put the text into the hidden input so it gets submitted
        $('#text_comment_hidden').val(text);

        var formData = new FormData(form[0]);

        $.ajax({

            type: 'POST',

            data: formData,

            processData: false,

            contentType: false,

            url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/AddChat",

            success: function(response) {

                var response = JSON.parse(response)

                if (response.result == "success") {

                    var html = '';

                    html = '<div><center><pre class="alert" style="text-align:right; width:100%; height:100%; max-width:900px; overflow-x:auto; color:#FFF; background-color:#990;">' + text + '</pre></center></div>'

                    $('#d_approval_comment').append(html);

                    $('#text_comment_hidden').val("");
                    $('#text_comment').text("");

                } else {

                    alert(response.result);

                }

            },
            complete: function() {
                // Re-enable submit button
                $submitBtn.prop('disabled', false).text('Submit');
            }

        })

    })



    $(document).on('submit', '#conv_estimate', function(e) {

        e.preventDefault();

        var form = $(this);

        var formData = new FormData(form[0]);

        $.ajax({

            type: 'POST',

            data: formData,

            processData: false,

            contentType: false,

            url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/CheckExistingQuote",

            success: function(response) {

                var response = JSON.parse(response);

                if (response.status == 1) {

                    if (confirm('Quotation request already exists. Do you still want to send the request?')) {

                        $.ajax({

                            type: 'POST',

                            data: formData,

                            processData: false,

                            contentType: false,

                            url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/ConvEstimate",

                            success: function(response) {

                                var response = JSON.parse(response);

                                if (response.status == 1) {

                                    var url = "<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate";

                                    window.location.href = url;

                                } else {

                                    alert('Something Went Wrong');

                                }

                            }

                        })

                    }

                } else {

                    $.ajax({

                        type: 'POST',

                        data: formData,

                        processData: false,

                        contentType: false,

                        url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/ConvEstimate",

                        success: function(response) {

                            var response = JSON.parse(response);

                            if (response.status == 1) {

                                var url = "<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate";

                                window.location.href = url;

                            } else {

                                alert('Something Went Wrong');

                            }

                        }

                    })

                }

            }

        })

    })


    function convertQuotation(qdoc_id, salesrep_id) {
        $.ajax({
            type: 'POST',
            data: {
                qdoc_id: qdoc_id,
            },
            url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/CheckCustData",
            success: function(response) {

                var response = JSON.parse(response);

                if (response.status == 1) {

                    $.ajax({

                        type: 'POST',

                        data: {

                            qdoc_id: qdoc_id,

                            salesrep_id: salesrep_id

                        },

                        url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/fetchOrderNum',

                        success: function(response) {

                            var response = JSON.parse(response);

                            if (response.status == 1) {

                                $('#sales_quote_name').val(response.salesrep_name);

                                $('#sales_quote_id').val(response.salesrep_id);

                                $('#qdoci_id_conv').val(qdoc_id);

                                var html = '';

                                for (var i = 0; i < response.order_num.length; i++) {

                                  html += '<option value="' + response.order_num[i].order_main_code + '">' +
                                        response.order_num[i].order_main_code + ' - ' + 
                                        response.order_num[i].order_main_name + 
                                        '</option>';


                                }

                                $('#ex_th_code').empty();

                                $('#ex_th_code').append(html);

                                var text = '';

                                text += '<option selected value="' + response.salesrep_id + '">' + response.salesrep_name + '</option>'

                                $('#est_sales_id').val(response.salesrep_id);

                                $('#first_sales').append(text);

                                if (response.billing_state == 'wisconsin' || response.billing_state == 'pennsylvania' || response.billing_state == 'florida' || response.billing_state == 'Colorado' || response.billing_state == 'WI' || response.billing_state == 'PA' || response.billing_state == 'FL' || response.billing_state == 'CO') {
                                    $('#in_statetext').append('Important: We need to collect the Tax Form.');
                                }

                                $('#quoteConvertModal').modal('show');

                            } else {

                                alert('No EX code to sync');

                            }

                        }

                    })

                } else {
                    //$('#checkcustinfo').modal("show");
                    //$('#showcheckcustinfo').html('Click on edit customer name in estimate and then update the info');
                    edit_cust_modal(response.cust_id, response.qdoc_id, response.cust_name);
                    $('#showcheckcustinfo').html('Please complete the customer information.');
                    $('#editCustname').val('editCustname');

                }

            }
        })
    }
    // function convertQuotation(qdoc_id, salesrep_id) {

    //     $.ajax({

    //         type: 'POST',

    //         data: {

    //             qdoc_id: qdoc_id,

    //             salesrep_id: salesrep_id

    //         },

    //         url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/fetchOrderNum',

    //         success: function(response) {

    //             var response = JSON.parse(response);

    //             if (response.status == 1) {

    //                 $('#sales_quote_name').val(response.salesrep_name);

    //                 $('#sales_quote_id').val(response.salesrep_id);

    //                 $('#qdoci_id_conv').val(qdoc_id);

    //                 var html = '';

    //                 for (var i = 0; i < response.order_num.length; i++) {

    //                     html += '<option value="' + response.order_num[i].order_main_code + '">' + response.order_num[i].order_main_code + '</option>';

    //                 }

    //                 $('#ex_th_code').empty();

    //                 $('#ex_th_code').append(html);

    //                 var text = '';

    //                 text += '<option selected value="' + response.salesrep_id + '">' + response.salesrep_name + '</option>'

    //                 $('#est_sales_id').val(response.salesrep_id);

    //                 $('#first_sales').append(text);

    //                 $('#quoteConvertModal').modal('show');

    //             } else {

    //                 alert('No EX code to sync');

    //             }

    //         }

    //     })

    // }
</script>



<!--Quote Conversion Modal> -->

<div class="modal fade" id="quoteConvertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="flex-header modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 style="float: left;" class="modal-title">Convert Estimate to Quotation </h4>

            </div>

            <div class="modal-body">

                <form class="form-horizontal" id="conv_estimate">

                    <div class="form-group">

                        <label class="control-label col-md-12 col-sm-12" for="sales_quote_name">Sales Rep :</label>

                        <div class="col-md-12 col-sm-12">

                            <input type="text" class="form-control" name="sales_quote_name" id="sales_quote_name" readonly>

                            <input type="hidden" name="sales_quote_id" class="form-control" id="sales_quote_id" readonly>

                            <input type="hidden" name="qdoci_id" class="form-control" id="qdoci_id_conv" readonly>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="control-label col-md-12 col-sm-12" for="ex_th_code">Available EX/TH Codes:</label>

                        <div class="col-md-12 col-sm-12">

                            <select class="form-control js-example-basic-multiple" name="codes[]" id="ex_th_code" multiple="multiple">



                            </select>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="control-label col-md-4 col-sm-12" for="college-order">Is this a collegiate order?</label>

                        <div class="col-md-6 col-sm-12 flex-custom">

                            <div class="radio">

                                <label>

                                    <input type="radio" checked name="college" id="college-no" value="No"> No

                                </label>

                            </div>

                            <div class="radio">

                                <label>

                                    <input type="radio" name="college" id="college-yes" value="Yes"> Yes

                                </label>

                            </div>

                        </div>

                    </div>



                    <div id="college-table" style="display: none;">

                        <table class="table" style="border:1px solid black;">

                            <thead>

                                <tr>

                                    <th>Licensing Company</th>

                                    <th>Royalty Bearing</th>

                                    <th>Non Royalty Bearing</th>

                                    <th>No Report/Non Licensed</th>

                                </tr>

                            </thead>

                            <tbody>

                                <tr>

                                    <td><select name="college_name">

                                            <option value="" disabled>Select College</option>
                                            <option value="Not Licensed">Not Licensed</option>
                                            <option value="Affinity">Affinity</option>

                                            <option value="CLC">CLC</option>

                                            <option value="Exemplar">Exemplar</option>

                                            <option value="Fanatics">Fanatics</option>
                                            <option value="Grand Canyon">Grand Canyon</option>
                                            <option value="Indiana">Indiana</option>

                                            <option value="Iowa">Iowa</option>

                                            <option value="Nexus">Nexus</option>
                                            <option value="Princeton">Princeton</option>
                                            <option value="UMass">UMass</option>

                                        </select></td>

                                    <td class="text-center"><input type="checkbox" name="royalty_bearing"></td>

                                    <td class="text-center"><input type="checkbox" name="non_royalty_bearing"></td>

                                    <td class="text-center"><input type="checkbox" name="no_report"></td>

                                </tr>

                            </tbody>

                        </table>

                    </div>



                    <div class="form-group">

                        <label class="control-label col-md-4 col-sm-12" for="split-comm">Split Commission </label>

                        <div class="col-md-6 col-sm-12 flex-custom">

                            <div class="radio">

                                <label>

                                    <input type="radio" checked name="split_comm" id="split-no" value="No"> No

                                </label>

                            </div>

                            <div class="radio">

                                <label>

                                    <input type="radio" name="split_comm" id="split-yes" value="Yes"> Yes

                                </label>

                            </div>

                        </div>

                    </div>



                    <div id="split-comm-table" style="display: none;">

                        <table class="table" style="border:1px solid black;">

                            <thead>

                                <tr>

                                    <th>Sales Rep</th>

                                    <th>Commission (In %)</th>

                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody id="salesTable">

                                <tr>

                                    <td><select name="sales_rep_name[]" id="first_sales">



                                        </select>

                                    </td>

                                    <td><input type="text" name="sales_percent[]" class="salesPercentInput"></td>

                                    <td>

                                        <i class="fa fa-plus addRowIcon" onclick="addRowSplit(this)"></i>

                                        <!--<i class="fa fa-minus deleteRowIcon" onclick="deleteRowSplit(this)"></i>-->

                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                    <input type="hidden" value="" id="est_sales_id">

                    <div class="form-group">

                        <label class="control-label col-md-12 col-sm-12" for="payment_terms">Payment Terms:</label>

                        <div class="col-md-12 col-sm-12">

                            <div class="checkbox">

                                <label>

                                    <input type="checkbox" name="credit_net_30" value="Credit Net 30"> Credit Net 30

                                </label>

                            </div>

                            <div class="checkbox">

                                <label>

                                    <input type="checkbox" name="full_payment_b4_ship" value="Full payment before shipping"> Full payment before shipping

                                </label>

                            </div>

                            <div class="checkbox">

                                <label>

                                    <input type="checkbox" name="50_down_payment" value="50% down payment balance due net 30"> 50% down payment balance due net 30

                                </label>

                            </div>

                            <div class="checkbox">

                                <label>

                                    <input type="checkbox" name="credit_card_3" value="Credit card 3%"> Credit card 3%

                                </label>

                            </div>
                            <div class="checkbox">

                                <label>

                                    <input type="checkbox" name="ACH_1_Fee" value="ACH 1% Fee"> ACH 1% Fee

                                </label>

                            </div>
                        </div>

                    </div>



                    <div class="form-group">

                        <label class="control-label col-md-12 col-sm-12" for="pwd">Notes (if any):</label>

                        <div class="col-md-12 col-sm-12">

                            <textarea class="form-control" name="conversion_notes"></textarea>

                        </div>

                    </div>
                    <div class="form-group" style="text-align: center;">
                        <h4 id="in_statetext" style="color: red;"></h4>
                    </div>
                    <div class="form-group">

                        <div class="col-sm-offset-2 col-md-12 col-sm-12">

                            <button type="submit" class="btn btn-success">Submit</button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>







<!-- Quotation DOC -->
<div class="modal fade" id="quoteDocModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" <?php if (Yii::app()->controller->id == "order") {
                                    echo '';
                                } else {
                                    echo '"';
                                } ?>>
        <?php if (Yii::app()->controller->id == "order") { ?>

            <div class="modal-content">
                <div class="flex-header modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php
                    if (Yii::app()->controller->id != "quoteEstimate") {
                    ?>
                        <h4 style="float: left;" class="modal-title">Estimate for Approval</h4>
                    <?php
                    } else {
                    ?>
                        <h4 style="float: left;" class="modal-title">Quotation for Approval</h4>
                    <?php
                    }
                    ?>

                    <h4 style="float: right; margin: 0px 15px 0px 0px; " id="quote_history">History:
                        <select id="select_history" onchange="return showQuoteHistory();">

                        </select>
                        <input type="hidden" id="main_qdoc_id">
                    </h4>
                </div>
                <div id="quote_content" class="modal-body" style=" ">
                    <div id="d_approval_comment"></div>
                    <div>
                        <center>
                            <form id="reply_to_comment" style="display: none;">
                                <div id="text_comment" contenteditable="true" style="width:100%;resize:none;min-height:80px;border:1px solid #ccc;padding:8px;margin-bottom:10px;text-align: left;"></div>
                                <input type="hidden" name="text_comment" id="text_comment_hidden">
                                <!-- <textarea style="width:95%;resize:none;" id="text_comment" name="text_comment"></textarea> -->
                                <input type="hidden" name="doc_id" id="view_doc_id">
                                <input type="hidden" name="chat_type" value="<?= base64_encode($chat_type) ?>">
                                <input type="hidden" name="emp_id" value="<?= base64_encode($user_id) ?>">
                                <input type="hidden" name="full_name" value="<?= base64_encode($full_name) ?>">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <span class="btn btn-primary email_submit">Submit & Send Email</span>
                                <span class="btn btn-warning" id="cancel_btn">Cancel</span>
                            </form>

                            <!-- <button class="btn btn-primary" id="reply_btn">Comment</button> -->

                        </center>
                    </div>
                    <div id="notes_modal_div" style="display: none;">
                        <center style="margin-bottom:10px;">
                            Salesman Notes (<font style="color: #EA6153; padding:10px;line-height: 40px;">Not shown in Estimate</font>)<br>
                            <pre class="alert alert-success" style="width:100%; height:100%; max-width:700px; overflow-x:auto;" id="pre_sale_note_modal"></pre>
                        </center>

                    </div>
                    <form id="app_quote">
                        <select id="head_selector_app" name="head_selector_app" onchange="return changeQuoteHeadApp();">
                            <?php
                            $a_hide_comp_info = array();
                            $sql_comp = "SELECT tbl_comp_info.*,tbl_quote_note.qnote_text FROM tbl_comp_info LEFT JOIN tbl_quote_note ON tbl_comp_info.comp_id=tbl_quote_note.comp_id WHERE tbl_comp_info.enable=1 ORDER BY tbl_comp_info.sort_by ASC ; ";
                            $a_comp = Yii::app()->db->createCommand($sql_comp)->queryAll();

                            foreach ($a_comp as $key => $row_comp) {
                                $comp_id = $row_comp["comp_id"];
                                $comp_name = $row_comp["comp_name"];

                                /* Get currency if exists */
                                $currency_show = isset($currency_map[$comp_id]) ? $currency_map[$comp_id] : '';

                                echo '<option 
                                        value="'.$comp_id.'" 
                                        data-name="'.$comp_name.'"
                                        data-full="'.$comp_name.' '.$currency_show.'">
                                        '.$comp_name.' '.$currency_show.'
                                    </option>';

                                $a_hide_comp_info[$comp_id] = json_encode($row_comp);
                            }
                            
                            ?>
                        </select>
                        <?php
                        foreach ($a_hide_comp_info as $comp_id => $data_comp) {
                        ?>
                            <input type="hidden" id="hide_comp_info_app<?php echo $comp_id; ?>" value="<?php echo base64_encode($data_comp); ?>">
                        <?php
                        }
                        ?>
                        <div id="d_quote_body"></div>
                        <div id="d_quote_below">
                            <?php


                            if ($user_group == "1" || $user_group == "99") {
                            ?>
                                <textarea name="note_text" id="note_text" style="width: 100%; height: 141px; min-height: 140px; margin: 3px;"></textarea>
                            <?php
                            }
                            ?>
                        </div>
                    </form>
                </div>
                <div id="quote_content_his" class="modal-body" style="  display: none;"></div>
                <div id="quote_approve_bar" class="modal-footer">
                    <div id="btn_commission_row" style="display:none; float:left; padding: 4px 0;">
                        <span id="comm_total_label" style="margin-right:10px; font-weight:bold; line-height:32px;"></span>
                        <button id="btn_comm_1" type="button" class="btn btn-warning" onclick="gotoCommission(1);"></button>
                        <button id="btn_comm_2" type="button" class="btn btn-warning" style="display:none; margin-left:5px;" onclick="gotoCommission(2);"></button>
                    </div>
                    <!-- <button style="float:right;" type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                    <?php
                    if (Yii::app()->controller->id != "quoteEstimate") {
                        if ($user_group == "1" || $user_group == "99") {
                    ?>
                            <div class="text-end mb-2">
                                <button id="btn_save" type="button" class="btn btn-primary btn-fixed byapprove" onclick="return saveEstimate();">Save Data</button>
                                <button id="btn_approve" type="button" class="btn btn-success me-2 btn-fixed" onclick="return quotationApprove();">Approve</button>
                                <button id="btn_reject" type="button" class="btn btn-danger me-2 btn-fixed" onclick="return quotationReject();">Reject</button>
                            </div>

                            <div id="sp_remark" class="text-end" style="display: none;">
                                <div class="text-success">*Everything's updated for Approve case.</div>
                                <div class="text-danger">*Only Notes will update for Reject case.</div>
                            </div>
                            <!--<button style="float:right;" id="btn_reject" type="button" class="btn btn-danger" onclick="return quotationReject();">Reject</button>-->
                            <!--<button style="float:right;" id="btn_approve" type="button" class="btn btn-success" onclick="return quotationApprove();">Approve</button>-->

                            <!--<div id="sp_remark" style="display: none; float:right;">-->
                            <!--    <font color=green>*Everything's update for Approve case. </font><br>-->
                            <!--    <font color=red>*Only Notes will update for Reject case.</font>-->
                            <!--</div>-->
                        <?php
                        } else {
                            echo '<span id="btn_approve"></span><span id="btn_reject"></span>';
                        }
                        ?>
                        <button id="btn_save" type="button" class="btn btn-primary btn-fixed byapprove" onclick="return saveEstimate();">Save Data</button>
                        <button style="float:right;" id="btn_print" type="button" class="btn btn-warning" onclick="printQuotation();">Print</button>
                        <button style="float:right;" id="btn_refresh_date" type="button" class="btn btn-secondary" onclick="refreshDate();">Refresh Date</button>
                    <?php
                    } else {
                    ?>
                        <button type="button" class="btn btn-warning" id="btn_reject" onclick="return quotationApproveFinal();">Save Data</button>
                        <button type="button" class="btn btn-success quotationApproveFinalApprove" id="btn_approve">Save & Approve</button>
                        <button style="float:right;" id="btn_print" type="button" class="btn btn-warning" onclick="printQuotation();">Print</button>
                        <button style="float:right;" id="btn_refresh_date" type="button" class="btn btn-secondary" onclick="refreshDate();">Refresh Date</button>
                    <?php
                    }
                    ?>

                </div>
            </div>

        <?php  } else { ?>
            <div class="modal-content">
                <div class="flex-header modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php
                    if (Yii::app()->controller->id != "quoteEstimate") {
                    ?>
                        <h4 style="float: left;" class="modal-title">Estimate for Approval</h4>
                    <?php
                    } else {
                    ?>
                        <h4 style="float: left;" class="modal-title">Quotation for Approval</h4>
                    <?php
                    }
                    ?>

                    <h4 style="float: right; margin: 0px 15px 0px 0px; " id="quote_history">History:
                        <select id="select_history" onchange="return showQuoteHistory();">

                        </select>
                        <input type="hidden" id="main_qdoc_id">
                    </h4>
                </div>
                <div id="quote_content" class="modal-body" style=" ">
                    <div id="d_approval_comment"></div>
                    <div>
                        <center>
                            <form id="reply_to_comment" style="display: none;">
                                <div id="text_comment" contenteditable="true" style="width:100%;resize:none;min-height:80px;border:1px solid #ccc;padding:8px;margin-bottom:10px;text-align: left;"></div>
                                <input type="hidden" name="text_comment" id="text_comment_hidden">
                                <!-- <textarea style="width:95%;resize:none;" id="text_comment" name="text_comment"></textarea> -->
                                <input type="hidden" name="doc_id" id="view_doc_id">
                                <input type="hidden" name="chat_type" value="<?= base64_encode($chat_type) ?>">
                                <input type="hidden" name="emp_id" value="<?= base64_encode($user_id) ?>">
                                <input type="hidden" name="full_name" value="<?= base64_encode($full_name) ?>">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <span class="btn btn-primary email_submit">Submit & Send Email</span>
                                <span class="btn btn-warning" id="cancel_btn">Cancel</span>
                            </form>

                            <button class="btn btn-primary" id="reply_btn">Comment</button>

                        </center>
                    </div>
                    <div id="notes_modal_div" style="display: none;">
                        <center style="margin-bottom:10px;">
                            Salesman Notes (<font style="color: #EA6153; padding:10px;line-height: 40px;">Not shown in Estimate</font>)<br>
                            <pre class="alert alert-success" style="width:100%; height:100%; max-width:700px; overflow-x:auto;" id="pre_sale_note_modal"></pre>
                        </center>

                    </div>
                    <form id="app_quote">
                        <select id="head_selector_app" name="head_selector_app" onchange="return changeQuoteHeadApp();">
                            <?php
                            $a_hide_comp_info = array();
                            $sql_comp = "SELECT tbl_comp_info.*,tbl_quote_note.qnote_text FROM tbl_comp_info LEFT JOIN tbl_quote_note ON tbl_comp_info.comp_id=tbl_quote_note.comp_id WHERE tbl_comp_info.enable=1 ORDER BY tbl_comp_info.sort_by ASC; ";
                            $a_comp = Yii::app()->db->createCommand($sql_comp)->queryAll();

                            foreach ($a_comp as $key => $row_comp) {
                                $comp_id = $row_comp["comp_id"];
                                $comp_name = $row_comp["comp_name"];

                                /* Get currency if exists */
                                $currency_show = isset($currency_map[$comp_id]) ? $currency_map[$comp_id] : '';

                                echo '<option 
                                        value="'.$comp_id.'" 
                                        data-name="'.$comp_name.'"
                                        data-full="'.$comp_name.' '.$currency_show.'">
                                        '.$comp_name.' '.$currency_show.'
                                    </option>';

                                $a_hide_comp_info[$comp_id] = json_encode($row_comp);
                            }
                            ?>
                        </select>
                        <?php
                        foreach ($a_hide_comp_info as $comp_id => $data_comp) {
                        ?>
                            <input type="hidden" id="hide_comp_info_app<?php echo $comp_id; ?>" value="<?php echo base64_encode($data_comp); ?>">
                        <?php
                        }
                        ?>
                        <div id="d_quote_body"></div>
                        <div id="d_quote_below">
                            <?php


                            if ($user_group == "1" || $user_group == "99") {
                            ?>
                                <textarea name="note_text" id="note_text" style="width: 100%; height: 141px; min-height: 140px; margin: 3px;"></textarea>
                            <?php
                            }
                            ?>
                        </div>
                    </form>
                </div>
                <div id="quote_content_his" class="modal-body" style="  display: none;"></div>
                <div id="quote_approve_bar" class="modal-footer">
                    <div id="btn_commission_row" style="display:none; float:left; padding: 4px 0;">
                        <span id="comm_total_label" style="margin-right:10px; font-weight:bold; line-height:32px;"></span>
                        <button id="btn_comm_1" type="button" class="btn btn-warning" onclick="gotoCommission(1);"></button>
                        <button id="btn_comm_2" type="button" class="btn btn-warning" style="display:none; margin-left:5px;" onclick="gotoCommission(2);"></button>
                    </div>
                    <!-- <button style="float:right;" type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                    <?php
                    if (Yii::app()->controller->id != "quoteEstimate") {
                        if ($user_group == "1" || $user_group == "99") {
                    ?>
                            <div class="text-end mb-2">
                                <button id="btn_save" type="button" class="btn btn-primary btn-fixed byapprove" onclick="return saveEstimate();">Save Data</button>
                                <button id="btn_approve" type="button" class="btn btn-success me-2 btn-fixed" onclick="return quotationApprove();">Approve</button>
                                <button id="btn_reject" type="button" class="btn btn-danger me-2 btn-fixed" onclick="return quotationReject();">Reject</button>
                            </div>

                            <div id="sp_remark" class="text-end" style="display: none;">
                                <div class="text-success">*Everything's updated for Approve case.</div>
                                <div class="text-danger">*Only Notes will update for Reject case.</div>
                            </div>
                        <?php
                        } else {
                            echo '<span id="btn_approve"></span><span id="btn_reject"></span>';
                        }
                        ?>
                        <button id="btn_save" type="button" class="btn btn-primary btn-fixed byapprove" onclick="return saveEstimate();">Save Data</button>
                        <button style="float:right;" id="btn_print" type="button" class="btn btn-warning" onclick="printQuotation();">Print</button>
                        <button style="float:right;" id="btn_refresh_date" type="button" class="btn btn-secondary" onclick="refreshDate();">Refresh Date</button>
                    <?php
                    } else {
                    ?>
                        <button type="button" class="btn btn-warning" id="btn_reject" onclick="return quotationApproveFinal();">Save Data</button>
                        <button type="button" class="btn btn-success quotationApproveFinalApprove" id="btn_approve">Save & Approve</button>
                        <button style="float:right;" id="btn_print" type="button" class="btn btn-warning" onclick="printQuotation();">Print</button>
                        <button style="float:right;" id="btn_refresh_date" type="button" class="btn btn-secondary" onclick="refreshDate();">Refresh Date</button>
                    <?php
                    }
                    ?>

                </div>
            </div>
        <?php } ?>
    </div>
</div>
<input type="hidden" id="is_front" value="0">



<div class="modal fade" id="updateCustomerModalLive" tabindex="-1" role="dialog">

    <div class="modal-dialog smallModal ">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title">Edit</h4>

            </div>

            <div class="modal-body">

                <form id="customer_update_live_main">

                    <label for=""> Select Customer :</label>

                    <div id="major_customer" style="text-align: center; ">



                    </div>

                    <input type="hidden" name="qdoc_id" id="qdoc_id_update_customer">

                    <hr>

                    <button type="submit" class="btn btn-primary">Update</button>

                </form>

            </div>

        </div>

    </div>

</div>

<!-- <div class="modal fade" id="checkcustinfo" tabindex="-1" role="dialog">
    <div class="modal-dialog smallModal ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <div style="text-align: center;">
                    <h2 id="showcheckcustinfo"><i class="fa fa-warning"></i> Click on <i class="fa fa-pencil"></i> Edit Customer Name in the estimate and then <i class="fa fa-check" aria-hidden="true"></i> update the info before converting the estimate!</h2>
                </div>
                <div><img src="/images/Screenshot_7.png" alt="" style="width:80%;"></div>
            </div>
        </div>
    </div>
</div> -->

<div class="modal fade" id="editCustomerModalLive" tabindex="-1" role="dialog">
    <div class="modal-dialog smallModal ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit</h4>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <h4 id="showcheckcustinfo" style="color: red;">
                        </h3>
                        <input type="hidden" name="editCustname" id="editCustname">
                </div>
                <form id="customer_update_live">
                    <div>
                        <label for=""> Team / Organization:</label>
                        <input type="hidden" name="edit_cust_id_live" id="edit_cust_id_live">
                        <input type="hidden" name="qdoc_id" id="qdoc_id_live">
                        <input type="text" name="edit_cust_name_live" id="edit_cust_name_live" readonly>
                    </div>
                    <div>
                        <label for=""> Customer Info :</label>
                        <textarea name="edit_cust_info" id="edit_cust_info_live"></textarea>
                    </div>
                    <div>
                        <label for="">Tax ID:</label>
                        <input type="text" name="tax_id" id="edit_tax_id_live" placeholder="">
                    </div>
                    <div>
                        <label for="">State Name:</label>
                        <input type="text" name="billing_state" id="edit_tax_state_name" placeholder="">
                    </div>
                    <div>
                        <label for=""> Sales Tax Exemption: </label>
                        <select name="sales_tax" id="edit_sales_tax_live">
                            <option value="">Select Sales Tax</option>
                            <option value="Exempt">Exempt</option>
                            <option value="Non Exempt">Non Exempt</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer" style="margin-top: 10px;">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

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

<div class="modal fade cartV2Modal" id="cartV2Modal" tabindex="-1" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <button class="FullscreenBtn"><i class="fa fa-expand" style="font-size:16px"></i></button>

                <h4 class="modal-title" id="cart_title">Cart</h4>

            </div>

            <div id="cart_body" class="modal-body">

                <div style="text-align: left;">

                    Currency: <span id="sp_currency"></span>

                </div>

                <form id="formCart" name="formCart" method="post">

                    <div id="cart_inner"></div>

                    <input type="hidden" name="curr_inner" id="curr_inner">

                    <input type="hidden" name="num_item" id="num_item">

                    <input type="hidden" name="draft_name" id="draft_name">

                    <input type="hidden" name="is_draft" id="is_draft" value="no">

                    <input type="hidden" name="dup_from" id="dup_from" value="0">

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

                        Yii::app()->db->createCommand("DELETE FROM tbl_cart_save WHERE user_id='" . $tmp_user_id . "' AND is_draft=0 AND save_time<'" . date("Y-m-d H:i:s", strtotime("-7 days")) . "'; ")->execute();



                        $a_load_save = array();

                        $sql_load = "SELECT * FROM tbl_cart_save WHERE user_id='" . $tmp_user_id . "' ORDER BY save_time DESC; ";

                        $a_load = Yii::app()->db->createCommand($sql_load)->queryAll();



                        foreach ($a_load as $key_tmp_load => $row_load) {

                            $show_draft_name = "";

                            if ($row_load["is_draft"] == "1") {

                                $show_draft_name = $row_load["draft_name"];
                            } else {

                                $show_draft_name = $row_load["save_time"];
                            }

                            echo '<option value="' . $row_load["carts_id"] . '">' . $show_draft_name . '</option>';
                        }

                        ?>

                    </select>

                    &nbsp;

                    <font style="font-size: 16px; color: #F00;">

                        <b><i style="cursor: pointer;" onclick="return deleteSaveV2();" class="fa fa-times-circle-o" aria-hidden="true" title="Delete selected draft."></i></b>

                    </font>

                    <span id="sp_show_loading"></span>

                    <br>

                    <font style="font-size: 10px; color: #F00;"><b>*Auto save will be deleted in a week.</b></font>

                </div>







                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->



                <div style="float: right;">

                    <button type="button" style="display:none;" class="btn btn-danger" id="btn_exit_edit_mode" onclick="exitEditMode();">Exit Edit Mode</button>



                    <button type="button" style="display:none;" class="btn btn-warning" id="btn_add_all_to_cart" onclick="addAllToCart();">Add Item</button>



                    <button type="button" style="display:none;" class="btn btn-info" id="add_item_row" onclick="addItemRowV2();">Add Row</button>

                    <button type="button" style="display:none;" class="btn btn-warning" id="clear_cart" onclick="clearCartV2();">Clear Cart</button>

                    <button type="button" style="display:none;" class="btn btn-primary" id="build_quote" onclick="return showQuoteFormV2();">Create New Estimate</button>



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

            <div id="show_item_add_mode_body" class="modal-body">



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

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="flex-header modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title">Estimate Form</h4>

            </div>

            <div class="modal-body quoteV2Modal-body" style="">
                <div id="quoteV2ModalForm">
                    <form name="formQuote" id="formQuote" method="post">

                        <div id="quote_head_selector" style="border-bottom: 1px solid #AAA; text-align: left;">

                            <select id="head_selector" name="head_selector" onchange="return changeQuoteHeadV2();">

                                <?php

                                $a_hide_comp_info = array();

                                $sql_comp = "SELECT * FROM tbl_comp_info WHERE enable=1 ORDER BY tbl_comp_info.sort_by ASC;";
                                $a_comp = Yii::app()->db->createCommand($sql_comp)->queryAll();
                                

                                echo '<option value="">=Please select header=</option>';

                                foreach ($a_comp as $row_comp) {

                                    $comp_id = $row_comp["comp_id"];
                                    $comp_name = $row_comp["comp_name"];

                                    /* Get currency if exists */
                                    $currency_show = isset($currency_map[$comp_id]) ? $currency_map[$comp_id] : '';

                                    echo '<option 
                                            value="'.$comp_id.'" 
                                            data-name="'.$comp_name.'"
                                            data-full="'.$comp_name.' '.$currency_show.'">
                                            '.$comp_name.' '.$currency_show.'
                                        </option>';

                                    $a_hide_comp_info[$comp_id] = json_encode($row_comp);
                                }
                                ?>

                            </select>


                            <?php

                            foreach ($a_hide_comp_info as $comp_id => $data_comp) {

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

                                    <h1>Estimate </h1>

                                    Payment Terms:

                                    <select name="payment_term" id="select_payment_term">

                                        <option value="Net 15">Net 15</option>

                                        <option value="Net 30">Net 30</option>

                                        <option value="Balance due before ship date">Balance due before ship date</option>

                                        <option value="50% down payment, balance due Net 15">50% down payment, balance due Net 15</option>

                                        <option value="50% down payment, balance due at delivery">50% down payment, balance due at delivery</option>

                                        <!--<option value="Payment Due at Order Confirmation">Payment Due at Order Confirmation</option>-->

                                        <!--<option value="50% Due At Order Confirmation. Balance Due At Delivery">50% Due At Order Confirmation. Balance Due At Delivery</option>-->

                                    </select>

                                    <pre style="width:100%;" id="pre_comp_info"></pre>

                                </div>

                            </div>

                        </div>

                        <div id="quote_body" class="container"></div>

                    </form>
                </div>
                <div id="addNewCustForm" style="display:none;">
                    <div>
                        <span onclick="addnewcust();" class="btn btn-primary">Go Back</span>
                    </div>

                    <div class="container mt-4">
                        <h2 class="text-center">Add Customer Information</h2>
                        <div id="responseMessage"></div>
                        <div class="row justify-content-center">
                            <div class="col-md-12"> <!-- col-6 -->
                                <form id="customerForm" class="p-4 border rounded bg-light grid2">
                                    <div class="col-md-6">
                                        <label class="form-label">Team / Organization:</label>
                                        <input type="text" name="cust_full_name" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Phone No:</label>
                                        <input type="text" name="phone_no" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Email:</label>
                                        <input type="email" name="email" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Full Name:</label>
                                        <input type="text" name="full_name" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Billing Country:</label>
                                        <input type="text" name="billing_country" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Billing State:</label>
                                        <input type="text" name="billing_state" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Billing Zip Code:</label>
                                        <input type="text" name="billing_zip_code" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Sales Tax:</label>
                                        <select name="sales_tax" class="form-control">
                                            <option value="">Select Sales Tax</option>
                                            <option value="Exempt">Exempt</option>
                                            <option value="Non exempt">Non Exempt</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Customer Type:</label>
                                        <select name="customer_type" id="customer_type" class="form-control">
                                            <option value="">Select Customer Type</option>
                                            <option value="Sales Direct">Sales Direct</option>
                                            <option value="Dealer">Dealer</option>
                                            <option value="Factory Direct">Factory Direct</option>
                                            <option value=">Private Label">Private Label</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tax ID:</label>
                                        <input type="text" name="tax_id" class="form-control">
                                    </div>

                                    <!--<div class="col-md-6">-->
                                    <!--    <label class="form-label">State Name:</label>-->
                                    <!--    <input type="text" name="state_name" class="form-control">-->
                                    <!--</div>-->

                                    <div class="col-md-12">
                                        <label class="form-label">Billing Address:</label>
                                        <textarea name="billing_address" class="form-control"></textarea>
                                        <input type="hidden" name="user_id" value="<?php echo Yii::app()->user->getState('userKey'); ?>">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">

                <div id="requestApprovalV2Btn">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btn_request_approve" onclick="return requestApprovalV2();">Request Approval</button>
                </div>
                <div id="addnewcustubmitBtn" style="display: none;">
                    <button type="button" class="btn btn-success" onclick="return addNewCustSubmit();">Save</button>
                </div>
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

            <div class="modal-body">

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



<div class="modal fade" id="GdriveModal" role="dialog">

    <div class="modal-dialog modal-lg">

        <!-- Modal content -->

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Item Preview</h4>

            </div>

            <div class="modal-body">

                <!-- Iframe to display links -->

                <iframe src="" frameborder="0" width="100%" height="400" id="myIframe"></iframe>



                <!-- Buttons to change the iframe source -->

                <div class="text-center" id="iframeLinks">



                </div>



                <!-- Button to open iframe link in a new tab -->

                <div class="text-center">

                    <button class="btn btn-primary" onclick="openInNewTab()">Open in New Tab</button>

                </div>



                <!-- Comments Section -->

                <!--<h4 class="modalTitle1">Comments</h4>-->

                <!--<div id="comments">-->

                    <!-- Comments go here -->

                <!--</div>-->

                <!--<form id="add_comment_drive">-->

                    <!-- Comment Box -->

                <!--    <label class="sSize">Add a Comment</label>-->

                <!--    <textarea class="form-control" name="main_comment" rows="3" id="commentText"></textarea>-->

                <!--    <label class="sSize">Send Email To:</label>-->

                <!--    <select class="form-control" name="user_ids[]" multiple id="selector_gdrive">-->

                <!--        <option value="">No User Selected</option>-->

                        <?php

                        // $user_id = Yii::app()->user->getState('userKey');

                        // $sq = "SELECT * FROM user WHERE id<>'$user_id'";

                        // $check = Yii::app()->db->createCommand($sq)->queryAll();

                        // foreach ($check as $u) {

                        ?>

                            <!--<option value=""></option>-->

                        <?php

                        // }

                        ?>

                <!--    </select>-->

                <!--    <input type="hidden" name="item_id" id="drive_item_id">-->

                <!--    <input type="hidden" name="link_id" id="drive_link_id">-->

                <!--    <br><br>-->

                <!--    <button class="btn btn-success" type="button" id="submit_comment">Comment</button>-->

                <!--</form>-->



            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>

        </div>

    </div>

</div>

<?php //echo "<hr>".Yii::app()->controller->id."<hr>"; //current controller id 

?>





<?php //echo Yii::app()->controller->action->id."<hr>"; //current controller action id 

?>

<!-- Tribute.js CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tributejs/5.1.3/tribute.min.css" />
<!-- Tribute.js JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tributejs/5.1.3/tribute.min.js"></script>

<?php
$users = Yii::app()->db->createCommand("SELECT id, username, fullname, email FROM user WHERE enable = 1")->queryAll();
?>

<script>
    var users = <?php echo json_encode(array_map(function ($user) {
                    return [
                        'key' => $user['username'],           // What gets inserted on match
                        'value' => $user['fullname'],        // Display name in dropdown
                        'email' => $user['email']             // For email notification
                    ];
                }, $users)); ?>;

    var tribute = new Tribute({
        trigger: "#",
        values: users, // users from PHP
        lookup: 'value', // used for displaying in dropdown
        fillAttr: 'key', // <== this makes it insert the username into textarea
        selectTemplate: function(item) {
            if (typeof item === 'undefined') return null;
            // insert styled span into contenteditable div
            return `<span contenteditable="false" class="mention-tag" data-user="${item.original.key}">#${item.original.key}</span>&nbsp;`;
        },
        menuItemTemplate: function(item) {
            return item.original.value + " <small>(@" + item.original.key + ")</small>";
        }
    });

    tribute.attach(document.getElementById("text_comment"));
</script>

<script type="text/javascript">
    function showLoader() {
        $('.loader_container').show();
        $('.loader_container').css('display', 'flex');

    }

    function hideLoader() {
        $('.loader_container').hide();

    }

    function addnewcust() {
        $('#quoteV2ModalForm').toggle();
        $('#addNewCustForm').toggle();

        $('#addnewcustubmitBtn').toggle();
        $('#requestApprovalV2Btn').toggle();
    }

    function addNewCustSubmit() {

        event.preventDefault(); // Prevent form from submitting normally

        $.ajax({
            type: "POST",
            url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/addNewCustd',
            data: $('#customerForm').serialize(),
            dataType: "json",
            success: function(response) {
                if (response.status == "success") {
                    $("#responseMessage").html('<div class="alert alert-success">' + response.message + '</div>');
                    $("#customerForm")[0].reset(); // Reset form fields

                    // Add the new customer to the dropdown
                    var custId = response.cust_id; // You'll need to return this from your PHP
                    var custName = response.cust_name;
                    var custFullName = response.cust_full_name;

                    // Create new option and append to select
                    var newOption = new Option(custName + ' -' + custFullName + '', custId);
                    $('#cust_selector').append(newOption);

                    // Select the newly added customer
                    $('#cust_selector').val(custId);
                    changeCustomerV2();
                } else {
                    $("#responseMessage").html('<div class="alert alert-danger">' + response.message + '</div>');
                }
            },
            error: function() {
                $("#responseMessage").html('<div class="alert alert-danger">Something went wrong!</div>');
            }
        });
    }

    activePage();



    function activePage() {



        setTimeout(function() {

            $.ajax({

                type: "POST",

                dataType: "html",

                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/activePage",

                success: function(resp) {

                    activePage();

                }

            });

        }, 300000); //---5 minutes

    }



    var deleter = [];

    var tr_text = [];

    var tr_main = [];



    $(document).on('click', '.deleter', function() {

        var tr_id = $(this).attr('tr_id');

        var tr_full = $(this).attr('tr_full');

        var tr_main_id = $(this).attr('tr_main');

        if (confirm('Do you really want to delete it ?')) {

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/delteCartItem",
                data: {
                    "qdoci_id": tr_main_id
                },
                success: function(resp) {
                    if (resp.result == "success") {
                        deleter.push(tr_id);

                        tr_text.push(tr_full);

                        tr_main.push(tr_main_id);

                        var del = "tr_" + tr_full + tr_id;

                        $('#' + del).remove();
                    }
                }
            });

        }

    })





    $('#cartModal').on("hide.bs.modal", function() {



        if ($('#is_front').val() == 1) {

            var curr_id = $('#curr_id').val();

            if (curr_id != null) {

                $.ajax({

                    type: "POST",

                    dataType: "json",

                    url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/updateCart?curr_id=" + curr_id,

                    data: $('#formCart').serialize(),

                    success: function(resp) {



                        if (resp.result == "updated") {



                            $('#sp_sum_total').html(resp.num_item);



                            //alert(resp.num_item);



                        } else {

                            //alert(resp.result);

                        }

                    }

                });

            }



        }



    });



    function showItemAddMode(qdoc_id) {



        $('#show_item_add_mode_body').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');



        $.ajax({

            type: "POST",

            dataType: "html",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/showItemAddMode",

            data: {

                "qdoc_id": qdoc_id

            },

            success: function(resp) {



                $('#show_item_add_mode_body').html(resp);



            }

        });



    }



    function addToCart(p_type, p_id, price, qty, comm_percent) {



        var tmp_curr = $('#dynamic_select').val();

        var a_curr = tmp_curr.split("=");

        if (a_curr.length < 2) {

            alert("Please select currency.");

            return false;

        }



        var currency = a_curr[1];



        if ($('#qdoc_id_editing').val() == null) {



            $.ajax({

                type: "POST",

                dataType: "html",

                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/addToCart",

                data: {

                    "p_type": p_type,

                    "p_id": p_id,

                    "price": price,

                    "qty": qty,

                    "comm_percent": comm_percent,

                    "currency": currency

                },

                success: function(resp) {

                    if (resp == "success") {

                        var tmp_sum = parseInt($('#sp_sum_total').html()) + 1;



                        $('#sp_sum_total').html(tmp_sum);

                    } else {

                        alert(resp);

                    }



                }

            });



        } else {



            var qdoc_id = $('#qdoc_id_editing').val();



            $.ajax({

                type: "POST",

                dataType: "html",

                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/addToQuotation",

                data: {

                    "qdoc_id": qdoc_id,

                    "p_type": p_type,

                    "p_id": p_id,

                    "price": price,

                    "qty": qty,

                    "comm_percent": comm_percent,

                    "currency": currency

                },

                success: function(resp) {

                    if (resp == "success") {

                        var tmp_sum = parseInt($('#sp_sum_total_edit').html()) + 1;



                        $('#sp_sum_total_edit').html(tmp_sum);

                    } else {

                        alert(resp);

                    }



                }

            });



        }



    }



    function addToExtraCart(extra_id) {



        var tmp_curr = $('#dynamic_select').val();

        var a_curr = tmp_curr.split("=");

        if (a_curr.length < 2) {

            alert("Please select currency.");

            return false;

        }



        var currency = a_curr[1];



        if (currency != "0") {

            alert("Extra items support only USD North America.");

            return false;

        }



        if ($('#qdoc_id_editing').val() == null) {



            //alert("extra_id="+extra_id+"\ncurrency="+currency);

            $.ajax({

                type: "POST",

                dataType: "html",

                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/addExtraToCart",

                data: {

                    "extra_id": extra_id,

                    "currency": currency

                },

                success: function(resp) {

                    if (resp == "success") {

                        var tmp_sum = parseInt($('#sp_sum_total').html()) + 1;



                        $('#sp_sum_total').html(tmp_sum);

                    } else {

                        alert(resp);

                    }



                }

            });



        } else {



            var qdoc_id = $('#qdoc_id_editing').val();



            $.ajax({

                type: "POST",

                dataType: "html",

                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/addExtraToQuotation",

                data: {

                    "qdoc_id": qdoc_id,

                    "extra_id": extra_id

                },

                success: function(resp) {

                    if (resp == "success") {

                        var tmp_sum = parseInt($('#sp_sum_total_edit').html()) + 1;



                        $('#sp_sum_total_edit').html(tmp_sum);

                    } else {

                        alert(resp);

                    }



                }

            });



        }



    }



    function saveCart() {



        var curr_inner = window.btoa($('#sp_currency').html());



        var num_item = $('#sp_sum_total').html();



        $('#curr_inner').val(curr_inner);

        $('#num_item').val(num_item);



        $('#is_draft').val("no");



        var curr_id = $('#curr_id').val();



        $.ajax({

            type: "POST",

            dataType: "json",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/saveCart?curr_id=" + curr_id,

            data: $('#formCart').serialize(),

            success: function(resp) {



                if (resp.result == "success") {



                    $('<option value="' + resp.carts_id + '">' + resp.save_time + '</option>').insertAfter('.default_option');

                    alert("Saved!!");



                    setTimeout(function() {

                        $('#select_carts_id').val(resp.carts_id);

                    }, 1000);

                }



            }

        });

    }



    function saveCartDraft() {



        var draft_name = prompt("Please input draft name:");



        if (draft_name == null) {

            return false;

        }



        if (draft_name == "") {

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

            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/saveCart?curr_id=" + curr_id,

            data: $('#formCart').serialize(),

            success: function(resp) {



                if (resp.result == "success") {



                    $('<option value="' + resp.carts_id + '">' + resp.draft_name + '</option>').insertAfter('.default_option');



                    $('#draft_name').val('');

                    $('#is_draft').val("no");

                    alert("Saved!!");



                    setTimeout(function() {

                        $('#select_carts_id').val(resp.carts_id);

                    }, 1000);

                }



            }

        });

    }



    function deleteSave() {



        var carts_id = $('#select_carts_id').val();



        if (carts_id != "0") {



            if (confirm("Deleting draft. Confirm?")) {



                $.ajax({

                    type: "POST",

                    dataType: "json",

                    url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/deleteCartSave",

                    data: {

                        "carts_id": carts_id

                    },

                    success: function(resp) {



                        if (resp.result == "success") {



                            $("#select_carts_id option[value='" + carts_id + "']").remove();

                            showCart();



                        }



                    }

                });

            }



        }



    }



    function loadCart() {



        if ($('#select_carts_id').val() != "0") {



            $('#sp_show_loading').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>');



            var carts_id = $('#select_carts_id').val();



            $.ajax({

                type: "POST",

                dataType: "json",

                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/loadCart",

                data: {

                    "carts_id": carts_id

                },

                success: function(resp) {

                    //$('#cart_inner').html(resp);

                    if (resp.result == "success") {

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

                        for (var i = 0; i < tmp_html_id.length; i++) {

                            if (tmp_html_id[i].indexOf("other") < 0) {

                                calPrice(tmp_html_id[i]);

                            } else {

                                calPrice(tmp_html_id[i], 1);

                            }

                        }



                    }



                }

            });

        }

    }



    function showCart(is_front = 0) {



        $('#select_carts_id').val(0);



        $('#is_front').val(is_front);



        $.ajax({

            type: "POST",

            dataType: "json",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/showCart",



            success: function(resp) {



                $('#cart_title').html("Cart");

                $('#build_quote').html('Create New Estimate').attr("disabled", false);



                $('#btn_add_all_to_cart').hide();

                $('#btn_exit_edit_mode').hide();

                $('#btn_save_edit_quote').hide();

                $('#btn_save_edit_reject_quote').hide();



                $('#btn_save_cart').show();

                $('#d_select_carts_id').show();



                if (resp.found_data == "yes") {

                    $('#add_item_row').show();

                    $('#build_quote').show();

                } else {

                    $('#add_item_row').hide();

                    $('#build_quote').hide();

                }



                $('#clear_cart').show();

                $('#sp_currency').html(resp.currency);

                $('#cart_inner').html(resp.cart_inner);



            }

        });



    }



    function clearCart() {



        if (confirm("Do you want to clear the cart?")) {

            $.ajax({

                type: "POST",

                dataType: "html",

                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/clearCart",



                success: function(resp) {



                    $('#cart_inner').html('');

                    $('#sp_sum_total').html(0);

                    $('#cartModal').modal("toggle");



                }

            });

        }



    }



    function deleteRow(row_id, is_other = 0, extra_id = 0) {

        if (confirm("Confirm delete row?")) {

            $('#tr_' + row_id).fadeOut(500).html('');

        }

    }



    function deleteRow2(row_id, is_other = 0, extra_id = 0) {



        if (confirm("Confirm delete row?")) {



            if (is_other == 1 || is_other == 2) {

                $('#tr_' + row_id).fadeOut(500).html('');

            } else {



                if (is_other == 3) {



                    $.ajax({

                        type: "POST",

                        dataType: "json",

                        url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/deleteRowExtra",

                        data: {

                            "extra_id": extra_id

                        },

                        success: function(resp) {



                            if (resp.result == "success") {

                                $('#tr_' + row_id).fadeOut(500).html('');

                                var tmp_sum = parseInt($('#sp_sum_total').html()) - 1;



                                $('#sp_sum_total').html(tmp_sum);

                            }



                        }

                    });



                } else {



                    var product = $('#product_' + row_id).val();

                    var p_id = $('#id_' + row_id).val();



                    $.ajax({

                        type: "POST",

                        dataType: "json",

                        url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/deleteRow",

                        data: {

                            "product": product,

                            "p_id": p_id

                        },

                        success: function(resp) {



                            if (resp.result == "success") {

                                $('#tr_' + row_id).fadeOut(500).html('');

                                var tmp_sum = parseInt($('#sp_sum_total').html()) - 1;



                                $('#sp_sum_total').html(tmp_sum);

                            }



                        }

                    });

                }

            }



        }



    }



    function calPrice(row_id, is_other = 0) {



        var show_uprice = 0.00;

        if (is_other == 1) {

            show_uprice = $('#uprice_' + row_id).val();

        } else {

            <?php

            /*$user_group = Yii::app()->user->getState('userGroup');

        

        if( $user_group=="1" || $user_group=="99" ){

            ?>

            show_uprice = $('#uprice_'+row_id).val();

            <?php

        }else{*/

            ?>

            show_uprice = $('#uprice_' + row_id).val();

            <?php

            //}

            ?>

        }



        var qty = $('#qty_' + row_id).val();



        $('#amount_' + row_id).html((show_uprice * qty).toFixed(2));



    }



    function showQuoteForm() {



        var found_empty = 0;

        $('.chk_qty').each(function() {

            if ($(this).val() == "" || $(this).val() == 0) {

                found_empty++;

            }

        });



        if (found_empty > 0) {

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



        $('#btn_request_approve').prop("disabled", false).html("Request Approval");



        if ($('#build_quote').html() == 'Create New Estimate') {



            var curr_id = $('#curr_id').val();



            $('#build_quote').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Auto save running').attr("disabled", true);



            $.ajax({

                type: "POST",

                dataType: "json",

                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/saveCart?curr_id=" + curr_id,

                data: $('#formCart').serialize(),

                success: function(resp2) {



                    if (resp2.result == "success") {



                        $('<option value="' + resp2.carts_id + '">' + resp2.save_time + '</option>').insertAfter('.default_option');



                        setTimeout(function() {



                            $.ajax({

                                type: "POST",

                                dataType: "html",

                                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/showQuoteForm",

                                data: $('#formCart').serialize(),

                                success: function(resp) {



                                    $('#quote_body').html(resp);

                                    $('#cartModal').modal("toggle");

                                    $('#quoteModal').modal("toggle");



                                    $('#td_grand_total').html($('#sp_show_gtotal_value').html());



                                    setTimeout(function() {



                                        $('.subnvat').hide();



                                        if ($('#qdoc_id_old').val()) {



                                            $('#td_auto_code').html($('#est_number_old').val());



                                            $('#select_payment_term').val($('#payment_term_old').val());



                                            $('#head_selector').val($('#comp_id_old').val());

                                            changeQuoteHead();



                                            $('#cust_selector').val($('#cust_id_old').val());

                                            changeCustomer();



                                            if ($('#inc_vat_old').val() == "yes") {

                                                $('#inc_vat').prop("checked", true);

                                            } else {

                                                $('#inc_vat').prop("checked", false);

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



        } else {



            $.ajax({

                type: "POST",

                dataType: "html",

                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/showQuoteForm",

                data: $('#formCart').serialize(),

                success: function(resp) {



                    $('#quote_body').html(resp);

                    $('#cartModal').modal("toggle");

                    $('#quoteModal').modal("toggle");



                    $('#td_grand_total').html($('#sp_show_gtotal_value').html());



                    if ($('#is_duplicate').val() == "1") {

                        //--ignore

                    } else {

                        setTimeout(function() {

                            if ($('#qdoc_id_old').val()) {



                                $('#td_auto_code').html($('#est_number_old').val());



                                $('#select_payment_term').val($('#payment_term_old').val());



                                $('#head_selector').val($('#comp_id_old').val());

                                changeQuoteHead();



                                $('#cust_selector').val($('#cust_id_old').val());

                                changeCustomer();



                                if ($('#inc_vat_old').val() == "yes") {

                                    $('#inc_vat').prop("checked", true);

                                } else {

                                    $('#inc_vat').prop("checked", false);

                                }

                                changeIncludeVAT();

                            }

                        }, 100);

                    }

                }

            });



        }



    }



    function showQuoteFormV2() {

        $('#is_front').val('0');

        var found_empty = 0;

        $('.chk_qty').each(function() {

            if ($(this).val() == "" || $(this).val() == 0) {

                found_empty++;

            }

        });



        if (found_empty > 0) {

            alert("Please input QTY");

            return false;

        }



        $('#btn_request_approve').prop("disabled", false).html("Request Approval");



        if ($('#build_quote').html() == 'Create New Estimate') {



            var curr_id = $('#curr_id').val();



            $('#build_quote').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Auto save running').attr("disabled", true);



            $.ajax({

                type: "POST",

                dataType: "json",

                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/saveCart",

                data: $('#formCart').serialize(),

                success: function(resp2) {



                    if (resp2.result == "success") {



                        $('<option value="' + resp2.carts_id + '">' + resp2.save_time + '</option>').insertAfter('.default_option');



                        setTimeout(function() {



                            $.ajax({

                                type: "POST",

                                dataType: "html",

                                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/showQuoteForm",

                                data: $('#formCart').serialize(),

                                success: function(resp) {



                                    $('#quote_body').html(resp);

                                    $('#cartV2Modal').modal("toggle");

                                    $('#quoteV2Modal').modal("toggle");
                                    <?php
                                    if ($user_id != "21") {
                                    ?>
                                        $('#cust_selector').select2({
                                            dropdownParent: $("#quoteV2Modal")
                                        });
                                    <?php
                                    }
                                    ?>

                                    $('#td_grand_total').html($('#sp_show_gtotal_value').html());



                                    setTimeout(function() {
                                        <?php
                                        if ($user_id != "21") {
                                        ?>
                                            $('.select2-container').css('width', '50% !important');
                                        <?php
                                        }
                                        ?>

                                        $('.subnvat').hide();



                                        if ($('#qdoc_id_old').val()) {



                                            $('#td_auto_code').html($('#est_number_old').val());



                                            $('#select_payment_term').val($('#payment_term_old').val());



                                            $('#head_selector').val($('#comp_id_old').val());

                                            changeQuoteHeadV2();



                                            $('#cust_selector').val($('#cust_id_old').val());

                                            changeCustomerV2();



                                            if ($('#inc_vat_old').val() == "yes") {

                                                $('#inc_vat').prop("checked", true);

                                            } else {

                                                $('#inc_vat').prop("checked", false);

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



        } else {



            $.ajax({

                type: "POST",

                dataType: "html",

                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/showQuoteForm",

                data: $('#formCart').serialize(),

                success: function(resp) {



                    $('#quote_body').html(resp);

                    $('#cartV2Modal').modal("toggle");

                    $('#quoteV2Modal').modal("toggle");



                    $('#td_grand_total').html($('#sp_show_gtotal_value').html());
                    <?php
                    if ($user_id != "21") {
                    ?>
                        $('#cust_selector').select2({
                            dropdownParent: $("#quoteV2Modal")
                        });
                    <?php
                    }
                    ?>

                    if ($('#is_duplicate').val() == "1") {

                        //--ignore

                    } else {

                        setTimeout(function() {
                            <?php
                            if ($user_id != "21") {
                            ?>
                                $('.select2-container').css('width', '50% !important');
                            <?php
                            }
                            ?>
                            if ($('#qdoc_id_old').val()) {



                                $('#td_auto_code').html($('#est_number_old').val());



                                $('#select_payment_term').val($('#payment_term_old').val());



                                $('#head_selector').val($('#comp_id_old').val());

                                changeQuoteHeadV2();



                                $('#cust_selector').val($('#cust_id_old').val());

                                changeCustomerV2();



                                if ($('#inc_vat_old').val() == "yes") {

                                    $('#inc_vat').prop("checked", true);

                                } else {

                                    $('#inc_vat').prop("checked", false);

                                }

                                changeIncludeVATV2();

                            }

                        }, 100);

                    }

                }

            });



        }



    }



    function getAdditional(id, product_type) {



        $('#addi_pro_id').val(id);

        $('#addi_product_type').val(product_type);



        $('#manage_additional').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');



        $.ajax({

            type: "POST",

            dataType: "html",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/getAdditional",

            data: {

                "pro_id": id,

                "product_type": product_type

            },

            success: function(resp) {



                var show_product_name = "<b>Product:</b> " + $('#prod_name' + id).html() + "<br><b>Description:</b> <br>" + $('#prod_desc' + id).html() + "<hr>";



                $('#show_product_name').html(show_product_name);



                $('#manage_additional').html(resp);



            }

        });

    }



    function submitNewAdditional() {



        if ($('#addi_name').val() == "") {

            alert("Please input New Additional");

            return false;

        }



        if ($('#addi_pro_id').val() == "" || $('#addi_product_type').val() == "") {

            alert("ERROR: Invalid Parameter");

            return false;

        }



        $.ajax({

            type: "POST",

            dataType: "html",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/submitNewAdditional",

            data: {

                "pro_id": $('#addi_pro_id').val(),

                "product_type": $('#addi_product_type').val(),

                "addi_name": window.btoa($('#addi_name').val())

            },

            success: function(resp) {



                if (resp == "success") {

                    getAdditional($('#addi_pro_id').val(), $('#addi_product_type').val());

                    $('#addi_name').val('');

                } else {

                    alert(resp);

                }



            }

        });



    }



    function deleteRowAdditional(id, product_type, addi_id) {



        if (confirm("Confirm to delete this Additional?")) {



            $.ajax({

                type: "POST",

                dataType: "html",

                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/deleteAdditional",

                data: {

                    "addi_id": addi_id

                },

                success: function(resp) {



                    if (resp == "success") {

                        getAdditional(id, product_type);

                    } else {

                        alert("Fail");

                    }



                }

            });





        }

    }



    function editRowAdditional(pro_id, pro_type, addi_id) {



        var addi_0value = $('#addi_0value' + addi_id).html();

        var addi_1value = $('#addi_1value' + addi_id).html();

        var addi_2value = $('#addi_2value' + addi_id).html();

        var addi_3value = $('#addi_3value' + addi_id).html();

        var addi_4value = $('#addi_4value' + addi_id).html();

        var addi_5value = $('#addi_5value' + addi_id).html();



        $('#old_0value' + addi_id).val(addi_0value);

        $('#old_1value' + addi_id).val(addi_1value);

        $('#old_2value' + addi_id).val(addi_2value);

        $('#old_3value' + addi_id).val(addi_3value);

        $('#old_4value' + addi_id).val(addi_4value);

        $('#old_5value' + addi_id).val(addi_5value);



        $('#addi_0value' + addi_id).html('<input type="number" id="edit_addi_0value' + addi_id + '" style="width:100%;" value="' + addi_0value + '">');

        $('#addi_1value' + addi_id).html('<input type="number" id="edit_addi_1value' + addi_id + '" style="width:100%;" value="' + addi_1value + '">');

        $('#addi_2value' + addi_id).html('<input type="number" id="edit_addi_2value' + addi_id + '" style="width:100%;" value="' + addi_2value + '">');

        $('#addi_3value' + addi_id).html('<input type="number" id="edit_addi_3value' + addi_id + '" style="width:100%;" value="' + addi_3value + '">');

        $('#addi_4value' + addi_id).html('<input type="number" id="edit_addi_4value' + addi_id + '" style="width:100%;" value="' + addi_4value + '">');

        $('#addi_5value' + addi_id).html('<input type="number" id="edit_addi_5value' + addi_id + '" style="width:100%;" value="' + addi_5value + '">');



        $('#btn_save_addi' + addi_id).html('<i class="fa fa-floppy-o"></i>');

        $('#btn_cancel_addi' + addi_id).html('<i class="fa fa-ban"></i>');



        $('#btn_save_addi' + addi_id).attr("onclick", "return saveRowAdditional(" + pro_id + ",'" + pro_type + "'," + addi_id + ");");

        $('#btn_cancel_addi' + addi_id).attr("onclick", "return cancelRowAdditional(" + pro_id + ",'" + pro_type + "'," + addi_id + ");");



    }



    function cancelRowAdditional(pro_id, pro_type, addi_id) {



        $('#addi_0value' + addi_id).html($('#old_0value' + addi_id).val());

        $('#addi_1value' + addi_id).html($('#old_1value' + addi_id).val());

        $('#addi_2value' + addi_id).html($('#old_2value' + addi_id).val());

        $('#addi_3value' + addi_id).html($('#old_3value' + addi_id).val());

        $('#addi_4value' + addi_id).html($('#old_4value' + addi_id).val());

        $('#addi_5value' + addi_id).html($('#old_5value' + addi_id).val());



        $('#btn_save_addi' + addi_id).html('<i class="fa fa-pencil"></i>');

        $('#btn_cancel_addi' + addi_id).html('<i class="fa fa-close"></i>');



        $('#btn_save_addi' + addi_id).attr("onclick", "return editRowAdditional(" + pro_id + ",'" + pro_type + "'," + addi_id + ");");

        $('#btn_cancel_addi' + addi_id).attr("onclick", "return deleteRowAdditional(" + pro_id + ",'" + pro_type + "'," + addi_id + ");");



    }



    function saveRowAdditional(pro_id, pro_type, addi_id) {



        var addi_0value = $('#edit_addi_0value' + addi_id).val();

        var addi_1value = $('#edit_addi_1value' + addi_id).val();

        var addi_2value = $('#edit_addi_2value' + addi_id).val();

        var addi_3value = $('#edit_addi_3value' + addi_id).val();

        var addi_4value = $('#edit_addi_4value' + addi_id).val();

        var addi_5value = $('#edit_addi_5value' + addi_id).val();





        $.ajax({

            type: "POST",

            dataType: "json",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/saveEditAdditional",

            data: {

                "addi_id": addi_id,

                "addi_value": addi_0value,

                "addi_value1": addi_1value,

                "addi_value2": addi_2value,

                "addi_value3": addi_3value,

                "addi_value4": addi_4value,

                "addi_value5": addi_5value

            },

            success: function(resp) {



                if (resp.result == "success") {



                    //alert(resp.sql_update);



                    $('#addi_0value' + addi_id).html(resp.addi_value);

                    $('#addi_1value' + addi_id).html(resp.addi_value1);

                    $('#addi_2value' + addi_id).html(resp.addi_value2);

                    $('#addi_3value' + addi_id).html(resp.addi_value3);

                    $('#addi_4value' + addi_id).html(resp.addi_value4);

                    $('#addi_5value' + addi_id).html(resp.addi_value5);



                    $('#btn_save_addi' + addi_id).html('<i class="fa fa-pencil"></i>');

                    $('#btn_cancel_addi' + addi_id).html('<i class="fa fa-close"></i>');



                    $('#btn_save_addi' + addi_id).attr("onclick", "return editRowAdditional(" + pro_id + ",'" + pro_type + "'," + addi_id + ");");

                    $('#btn_cancel_addi' + addi_id).attr("onclick", "return deleteRowAdditional(" + pro_id + ",'" + pro_type + "'," + addi_id + ");");



                } else {

                    alert("Fail to update data!");

                }



            }

        });



    }

    document.addEventListener('DOMContentLoaded', function() {
        const selects = document.querySelectorAll('select[multiple]');

        selects.forEach(select => {
            // Maintain selection highlight
            select.addEventListener('change', function() {
                this.querySelectorAll('option').forEach(option => {
                    option.style.backgroundColor = option.selected ? '#007bff' : '';
                    option.style.color = option.selected ? 'white' : '';
                });
            });

            // Initialize on load
            select.dispatchEvent(new Event('change'));
        });
    });

    function selectAddi(row_id) {



        var uprice = parseFloat($('#old_uprice_' + row_id).val());



        var a_select = $('#select_' + row_id).val();



        var tmp_price = "";

        for (var i = 0; i < a_select.length; i++) {



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

        $('#show_uprice_' + row_id).html(uprice);

        <?php

        //}

        ?>



        calPrice(row_id);



    }



    function changeQuoteHead() {



        var head_select = $('#head_selector').val();

        if (head_select == "") {

            alert("Please select header");

            return false;

        }



        var obj_comp = $.parseJSON(window.atob($('#hide_comp_info' + head_select).val()));



        //alert( window.atob($('#hide_comp_info'+head_select).val()) );

        if (obj_comp.have_vat == "1") {

            $('.subnvat').show();

        } else {

            $('.subnvat').hide();

        }



        var head_img_logo = "";

        if (obj_comp.comp_logo != "" && obj_comp.comp_logo != null) {

            head_img_logo = '<img style="max-height: 180px; max-width: 180px;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/' + obj_comp.comp_logo + '" >';

            $('#head_img_logo').html(head_img_logo);

        } else {

            $('#head_img_logo').html('');

        }



        var pre_comp_info = '<b>' + obj_comp.comp_name + '</b><br>' + obj_comp.comp_info;

        $('#pre_comp_info').html(pre_comp_info);



    }



    function changeCustomer() {



        var cust_id = $('#cust_selector').val();



        $.ajax({

            type: "POST",

            dataType: "html",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/getCustomerInfo",

            data: {

                "cust_id": cust_id

            },

            success: function(resp) {



                $('#pr_show_cust_info').html(resp);



            }

        });

    }



    function addItemRow() {

        var row_no = $('#count_item_row').val();



        var inner_new_row = '';

        inner_new_row += '<tbody id="tr_other' + row_no + '"><tr><td style="text-align:center;">' + row_no;



        if ($('#after_approved_editing').val() == "yes") {

            inner_new_row += '<input name="a_qdoci_id[]" type="hidden" value="new_other" >';

        }



        inner_new_row += '<input name="product_type[]" type="hidden" value="other" id="product_other' + row_no + '">';

        inner_new_row += '<input name="product_id[]" type="hidden" value="ot' + row_no + '" id="id_other' + row_no + '">';

        inner_new_row += '<input name="comm_percent[]" type="hidden" value="" id="comm_percent_other' + row_no + '">';

        inner_new_row += '<input name="qty_note[]" type="hidden" value="" id="qty_note_other' + row_no + '">';

        inner_new_row += '</td>';

        inner_new_row += '<td><textarea style="width:200px; min-height:80px; padding:5px;" name="product_item[]" id="product_item_other' + row_no + '"></textarea></td>';

        inner_new_row += '<td><textarea style="width:100%; min-height:80px; padding:5px;" name="product_desc[]" id="product_desc_other' + row_no + '"></textarea></td>';

        inner_new_row += '<td></td>';

        inner_new_row += '<td></td>';

        inner_new_row += '<td style="text-align:center;">';

        inner_new_row += '<input class="chk_qty" name="qty[]" id="qty_other' + row_no + '" type="number" min="0" style="text-align:center; width:50px;" onchange="return calPrice(\'other' + row_no + '\',1);" onkeyup="return calPrice(\'other' + row_no + '\',1);" value="">';

        inner_new_row += '</td>';



        inner_new_row += '<td style="text-align:center;"><input class="chk_uprice" name="uprice[]" type="number" min="0" id="uprice_other' + row_no + '" style="text-align:center; width:50px; " onchange="return calPrice(\'other' + row_no + '\',1);" onkeyup="return calPrice(\'other' + row_no + '\',1);"></td>';

        inner_new_row += '<td style="text-align:center;" id="amount_other' + row_no + '"></td>';

        inner_new_row += '<td style="text-align:center;"><button type="button" class="btn btn-danger" onclick="return deleteRow(\'other' + row_no + '\',1);">Del</button></td>';

        inner_new_row += '</tr></tbody>';



        $('#tbl_cart_info').append(inner_new_row);



        row_no = parseInt(row_no) + 1;

        $('#count_item_row').val(row_no);

    }



    function changeIncludeVAT() {



        var total_value = 0.0;



        if ($('#inc_vat').prop("checked")) {



            var sub_tt = parseFloat($('#sub_total').val());

            var discount = (parseFloat($('.number_disc').val()) / 100) * sub_tt;

            //var discount = parseFloat($('#actual_disc').val());

            var final_after_disc = (sub_tt - discount).toFixed(2);

            var new_vat = parseFloat((7 / 100) * final_after_disc).toFixed(2);



            $('#sp_show_vat_value').html($('#pre_cost').val() + new_vat);



            //var sub_total = parseFloat($('#sub_total').val());

            total_value = parseFloat(final_after_disc) + parseFloat(new_vat);

            $('#sp_show_total_value').html($('#pre_cost').val() + parseFloat(total_value).toFixed(2));

            $('#total_value').val(parseFloat(total_value).toFixed(2));



            $('#sp_show_gtotal_value').html($('#pre_cost').val() + parseFloat(total_value).toFixed(2));

            $('#gtotal_value').val(parseFloat(total_value).toFixed(2));



            $('#td_grand_total').html($('#pre_cost').val() + parseFloat(total_value).toFixed(2));

        } else {

            $('#sp_show_vat_value').html('');

            var sub_tt = parseFloat($('#sub_total').val());

            var discount = (parseFloat($('.number_disc').val()) / 100) * sub_tt;

            //var discount = parseFloat($('#actual_disc').val());

            var final_after_disc = (sub_tt - discount).toFixed(2);



            total_value = parseFloat(final_after_disc);

            $('#sp_show_total_value').html($('#pre_cost').val() + total_value.toFixed(2));

            $('#total_value').val(total_value);



            $('#sp_show_gtotal_value').html($('#pre_cost').val() + total_value.toFixed(2));

            $('#gtotal_value').val(total_value);



            $('#td_grand_total').html($('#pre_cost').val() + total_value.toFixed(2));

        }



    }



    function requestApproval() {



        if ($('#head_selector').val() == "") {

            alert("Please select Header");

            return false;

        }



        if ($('#cust_selector').val() == "") {

            alert("Please select Customer");

            return false;

        }



        $('#btn_request_approve').prop("disabled", true).html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');



        $.ajax({

            type: "POST",

            dataType: "json",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/requestApprove",

            data: $('#formQuote').serialize(),

            success: function(resp) {



                //$('#quote_body').html(resp);



                if (resp.result == "success") {

                    $.ajax({

                        type: "POST",

                        dataType: "html",

                        url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/clearCart",



                        success: function(resp2) {



                            $('#cart_inner').html('');

                            $('#sp_sum_total').html(0);

                            $('#quoteModal').modal("toggle");

                            alert("Your Estimate Number is : " + resp.est_number + "\nApproval status show in Estimate menu.");



                            window.location.href = "<?php echo Yii::app()->request->baseUrl; ?>/quotation/newRequest";

                        }

                    });

                } else {

                    alert("Error for saving data!");

                }

            }

        });

    }



    function saveQuoteData(id = "") {



        $.ajax({

            type: "POST",

            dataType: "html",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/saveQuoteData",

            data: $('#formCart').serialize(),

            success: function(resp) {



                //$('#cart_inner').append(resp);

                if (resp == "success") {

                    //alert('Culprit found');

                    if (!id || id.trim() === '') {

                        location.reload();

                    }

                } else {

                    alert(resp);

                }



            }

        });



    }



    function saveRejectQuoteData(id = "") {



        var found_empty = 0;

        $('.chk_qty').each(function() {

            if ($(this).val() == "" || $(this).val() == 0) {

                found_empty++;

            }

        });



        // if (found_empty > 0) {

        //     console.log("Please input QTY");

        //     return false;

        // }



        if (deleter.length > 0) {

            for (i = 0; i < deleter.length; i++) {

                var row_id = tr_text[i] + tr_main[i];

                var qdoci_id = tr_main[i];

                var from_page = 'quote_rej';

                deleteFromQuote(row_id, qdoci_id, from_page);

            }

            deleter = [];

            tr_text = [];

            tr_main = [];

        }



        $.ajax({

            type: "POST",

            dataType: "html",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/saveRejectQuoteData",

            data: $('#formCart').serialize(),

            success: function(resp) {



                //$('#cart_inner').append(resp);

                if (resp == "success") {

                    //alert('Culprit Found Again');

                    if (!id || id.trim() === '') {

                        location.reload();

                    }



                } else {

                    alert(resp);

                }



            }

        });

    }



    $('#cartV2Modal').on("hide.bs.modal", function() {



        if ($('#is_front').val() == 1) {



            $.ajax({

                type: "POST",

                dataType: "json",

                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/updateCart",

                data: $('#formCart').serialize(),

                success: function(resp) {



                    //$('#debug_panel').html(resp);



                    if (resp.result == "updated") {



                        $('#sp_sum_total').html(resp.num_item);



                        //alert(resp.num_item);



                    } else {

                        //alert(resp.result);

                    }

                }

            });

        } else if ($('#is_front').val() == 2) {

            saveRejectQuoteData();

        } else if ($('#is_front').val() == 3) {

            saveQuoteData();

        }



    });



    function checkModalState() {

        var isModalActive = $('#cartV2Modal').hasClass('in') && $('#cartV2Modal').css('display') === 'block';



        if (isModalActive) {

            var isDisplayNone = $('#btn_save_edit_quote').css('display') === 'none';



            if (isDisplayNone) {

                // saveRejectQuoteData(1);

            } else {

                // saveQuoteData(1);

                // Perform actions here if the class doesn't have display: none

            }

            // Perform actions if the modal is active

            // ...

        } else {

            console.log('Modal is not active');

            // Perform actions if the modal is not active

            // ...

        }



        // Schedule next check after 10 seconds

        setTimeout(checkModalState, 30000); // Call checkModalState() again after 10 seconds

    }



    function sendToCart(qdoc_id, from_page = "") {

        setTimeout(function() {
            checkModalState();
            // After the initial check, it will continue to check every 10 seconds
        }, 3000);

        $('#cart_inner').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');
        $('#build_quote').html('Recreate Estimate').attr("disabled", false);
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
            url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/sendToCart",
            data: {
                "qdoc_id": qdoc_id,
                "from_page": from_page
            },
            success: function(resp) {
                if (resp.result == "success") {
                    $('#cart_title').html("Estimate Editor: " + resp.est_number);

                    // Show relevant buttons based on from_page
                    if (from_page == "equote") {
                        $('#btn_save_edit_quote').show();
                        $('#edit_after_approved').val("no");
                    } else if (from_page == "quote_rej") { // From rejected page
                        $('#btn_add_all_to_cart').show();
                        $('#build_quote').show();
                        $('#btn_save_edit_reject_quote').show();
                        $('#add_item_row').show();
                        $('#is_front').val('2');
                        $('#edit_after_approved').val("no");
                        $('#edit_reject_quote').val("yes");
                    } else if (from_page == "equote_aa") { // From approved and archived page
                        $('#btn_exit_edit_mode').hide();
                        $('#btn_add_all_to_cart').show();
                        $('#add_item_row').show();
                        $('#build_quote').show();
                        $('#btn_save_edit_quote').show();
                        $('#is_front').val('3');
                        $('#edit_after_approved').val("yes");
                        $('#remark_text').hide();
                    } else {
                        $('#btn_exit_edit_mode').show();
                        if ($('#after_approved_editing').val() == "yes") {
                            $('#btn_save_edit_quote').show();
                        }
                    }

                    $('#sp_currency').html(resp.currency);
                    $('#cart_inner').html(window.atob(resp.form_inner));
                    $('#dup_from').val(resp.dup_from);

                    // Initialize the editors after the AJAX response
                    setTimeout(function() {
                        initializeEditorscart();
                    }, 500);

                    // Calculate prices based on the returned data
                    var tmp_html_id = resp.tmp_html_id.split(",");
                    for (var i = 0; i < tmp_html_id.length; i++) {
                        if (tmp_html_id[i].indexOf("other") < 0) {
                            calPrice(tmp_html_id[i]);
                        } else {
                            calPrice(tmp_html_id[i], 1);
                        }
                    }
                    $(document).ready(function() {
                        DragEsitamateSort();

                    });

                }
            }
        });
    }



    function sortQuoteItem(direction, from_page, qdoci_id) {



        var found_empty = 0;

        $('.chk_qty').each(function() {

            if ($(this).val() == "" || $(this).val() == 0) {

                found_empty++;

            }

        });



        if (found_empty > 0) {

            alert("Please input QTY");

            return false;

        }



        $.ajax({

            type: "POST",

            dataType: "html",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/saveRejectQuoteData",

            data: $('#formCart').serialize(),

            success: function(resp) {



                if (resp == "success") {



                    var qdoci_id2 = 0;

                    if (direction == "up") {

                        qdoci_id2 = $('#record_above' + qdoci_id).val();

                    } else {

                        qdoci_id2 = $('#record_below' + qdoci_id).val();

                    }



                    $.ajax({

                        type: "POST",

                        dataType: "json",

                        url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/sortQuoteItem",

                        data: {

                            "qdoci_id1": qdoci_id,

                            "qdoci_id2": qdoci_id2

                        },

                        success: function(resp2) {



                            if (resp2.result == "success") {

                                sendToCart(resp2.qdoc_id, from_page);

                            } else {

                                alert(resp2.msg);

                            }



                        }

                    });



                } else {

                    alert(resp);

                }



            }

        });



    }



    function addAllToCart() {

        var isDisplayNone = $('#btn_save_edit_quote').css('display') === 'none';



        if (isDisplayNone) {

            saveRejectQuoteData(1);

        } else {

            saveQuoteData(1);

            // Perform actions here if the class doesn't have display: none

        }

        var qdoc_id = $('#edit_quote_id').val();

        var num_item = parseInt($('#count_item_row').val()) - 1;

        var est_number = $('#edit_est_number').val();



        var edit_after_approved = $('#edit_after_approved').val();



        $.ajax({

            type: "POST",

            dataType: "json",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/enableQuoteCart",

            data: {

                "qdoc_id": qdoc_id,

                "num_item": num_item,

                "est_number": est_number,

                "edit_after_approved": edit_after_approved

            },

            success: function(resp) {



                if (resp.result == "success") {

                    window.location.href = "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/show/product/1";

                }



            }

        });



    }



    function exitEditMode() {

        $.ajax({

            type: "POST",

            dataType: "json",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/disableQuoteCart",

            success: function(resp) {



                if (resp.result == "success") {

                    location.reload();

                }



            }

        });

    }



    function deleteFromQuote(row_id, qdoci_id, from_page) {



        // if(confirm("This action will delete item from the Quotation. Confirm?")){



        $.ajax({

            type: "POST",

            dataType: "json",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/deleteItemFromQuote",

            data: {

                "qdoci_id": qdoci_id

            },

            success: function(resp) {



                if (resp.result == "success") {

                    sendToCart(resp.qdoc_id, from_page);

                } else {

                    console.log(resp.msg);

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



    function addDuplicateToCart(qdoc_id) {



        var num_item = parseInt($('#td_num_item' + qdoc_id).html());

        var est_number = 'DUP-' + $('#td_est_number' + qdoc_id).html();





        $.ajax({

            type: "POST",

            dataType: "json",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/enableQuoteCart",

            data: {

                "qdoc_id": qdoc_id,

                "num_item": num_item,

                "est_number": est_number,

                "edit_after_approved": "yes"

            },

            success: function(resp) {



                if (resp.result == "success") {

                    window.location.href = "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/show/product/1";

                }



            }

        });



    }



    function changeCustomerV2() {
        var cust_id = $('#cust_selector').val();

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/getCustomerInfo",
            data: {
                "cust_id": cust_id
            },
            success: function(resp) {
                $('#pr_show_cust_info').html(resp.cust_info);
                $('#add_tax_id').val(resp.tax_id);
                // $('#add_customer_type').val(resp.customer_type);
                $('.bill_to').hide();
                $('#sales_tax').val(resp.sales_tax).change();

                // Populate state dropdown
                var stateDropdown = '<label class="form-label">Location (hidden)</label>';
                stateDropdown += '<select id="billing_state" name="billing_state" class="form-control">';
                stateDropdown += '<option value="">Select State</option>'; // Default option

                if (resp.states && resp.states.length > 0) {
                    $.each(resp.states, function(index, state) {
                        var selected = (state.billing_state === resp.selected_state) ? 'selected' : '';
                        stateDropdown += '<option value="' + state.billing_state + '" ' + selected + '>' + state.billing_state + '</option>';
                    });
                }

                stateDropdown += '</select>';

                $('#pr_showing_state').html(stateDropdown);
            }
        });
    }



    function changeCustomerV3(qdoc_id) {

        var cust_id = $('#cust_selector').val();



        $.ajax({

            type: "POST",

            dataType: "html",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/getCustomerInfoNew",

            data: {

                "cust_id": cust_id

            },

            success: function(response) {

                var response = JSON.parse(response);

                var cust_name = response.data[0].cust_name;

                var cust_info = response.data[0].cust_info;

                $.ajax({

                    type: 'POST',

                    data: {

                        cust_id: cust_id,

                        qdoc_id: qdoc_id,

                        cust_name: cust_name,

                        cust_info: cust_info

                    },

                    url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/updateCustomerInfo',

                    success: function(resp) {

                        $('#td_cust_nam' + qdoc_id).html(response.data[0].cust_name);

                        $('#pr_show_cust_info').html(response.data[0].cust_info);

                        $('.bill_to').hide();

                    }

                })

            }

        });

    }



    function changeQuoteHeadV2() {

        var select = $('#head_selector');
        var head_select = select.val();

        if (head_select == "") {
            alert("Please select header");
            return false;
        }

        /* ✅ RESET all options back to full label */
        select.find('option').each(function () {
            if ($(this).data('full')) {
                $(this).text($(this).data('full'));
            }
        });

        /* ✅ Change selected option to only company name */
        var selectedOption = select.find('option:selected');
        selectedOption.text(selectedOption.data('name'));



        /* ===== YOUR EXISTING CODE BELOW ===== */

        var obj_comp = $.parseJSON(window.atob($('#hide_comp_info' + head_select).val()));

        if (obj_comp.have_vat == "1") {
            $('.subnvat').show();
        } else {
            $('.subnvat').hide();
        }

        var head_img_logo = "";
        if (obj_comp.comp_logo != "" && obj_comp.comp_logo != null) {
            head_img_logo = '<img style="max-height: 180px; max-width: 180px;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/' + obj_comp.comp_logo + '" >';
            $('#head_img_logo').html(head_img_logo);
        } else {
            $('#head_img_logo').html('');
        }

        var pre_comp_info = '<b>' + obj_comp.comp_name + '</b><br>' + obj_comp.comp_info;
        $('#pre_comp_info').html(pre_comp_info);

    }




    function changeIncludeVATV2() {



        var total_value = 0.0;



        if ($('#inc_vat').prop("checked")) {



            $('#sp_show_vat_value').html($('#pre_cost').val() + $('#vat_value').val());



            //var sub_total = parseFloat($('#sub_total').val());



            total_value = parseFloat($('#sub_total').val()) + parseFloat($('#vat_value').val());

            $('#sp_show_total_value').html($('#pre_cost').val() + total_value.toFixed(2));

            $('#total_value').val(total_value);



            $('#sp_show_gtotal_value').html($('#pre_cost').val() + total_value.toFixed(2));

            $('#gtotal_value').val(total_value);



            $('#td_grand_total').html($('#pre_cost').val() + total_value.toFixed(2));

        } else {

            $('#sp_show_vat_value').html('');



            total_value = parseFloat($('#sub_total').val());

            $('#sp_show_total_value').html($('#pre_cost').val() + total_value.toFixed(2));

            $('#total_value').val(total_value);



            $('#sp_show_gtotal_value').html($('#pre_cost').val() + total_value.toFixed(2));

            $('#gtotal_value').val(total_value);



            $('#td_grand_total').html($('#pre_cost').val() + total_value.toFixed(2));

        }



    }



    function requestApprovalV2() {

        if ($('#head_selector').val() == "") {
            alert("Please select Header");
            return false;
        }

        if ($('#cust_selector').val() == "") {
            alert("Please select Customer");
            return false;
        }

        // if ($('#sales_tax').val() == "") {
        //     alert("Please select Sales Tax");
        //     return false;
        // }


        $('#btn_request_approve').prop("disabled", true).html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');



        $.ajax({

            type: "POST",

            dataType: "json",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/requestApprove",

            data: $('#formQuote').serialize(),

            success: function(resp) {



                //$('#quote_body').html(resp);



                if (resp.result == "success") {

                    $.ajax({

                        type: "POST",

                        dataType: "html",

                        url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/clearCart",



                        success: function(resp2) {



                            $('#cart_inner').html('');

                            $('#sp_sum_total').html(0);

                            $('#quoteModal').modal("toggle");

                            alert("Your Estimate Number is : " + resp.est_number + "\nApproval status show in Estimate menu.");



                            window.location.href = "<?php echo Yii::app()->request->baseUrl; ?>/quotation/newRequest";

                        }

                    });

                } else {

                    alert("Error for saving data!");

                    //$('#pr_show_cust_info').html(resp.msg);

                }

            }

        });

    }



    function addItemRowV2() {
        var row_no = $('#count_item_row').val();
        var tr_cls = 'newTr_' + row_no;
        var new_other_ids = 'NewOther' + row_no;

        var inner_new_row = '';

        inner_new_row += '<tbody id="tr_other' + row_no + '"  class="ui-sortable"><tr class="ui-sortable-handle  approved_tr  ' + tr_cls + '"><td style="text-align:center;">';

        // Create the div structure with up/down arrows and row number
        inner_new_row += '<div style="display:flex; flex-direction: column; align-items:center;">';

        inner_new_row += '<span style="cursor:pointer; color:#939393;" class="moveDragImg" onclick="moveRow(\'other' + row_no + '\')">';
        inner_new_row += '<img src="https://sales-test.jog-joinourgame.com/images/icons/dragTable.png" alt="" class="iconImg">';
        inner_new_row += '</span>';

        inner_new_row += '</div>'; // Close the div

        // Add hidden inputs and other fields for the new row
        inner_new_row += '<input name="a_qdoci_id[]" type="hidden" value="" class="' + new_other_ids + '">';
        inner_new_row += '<input name="product_type[]" type="hidden" value="other" id="product_other' + row_no + '">';
        inner_new_row += '<input name="item_id[]" type="hidden" value="ot' + row_no + '" id="id_other' + row_no + '">';
        inner_new_row += '<input name="prg_id[]" type="hidden" value="" >';
        inner_new_row += '<input name="comm_percent[]" type="hidden" value="" id="comm_percent_other' + row_no + '">';
        inner_new_row += '<input name="qty_note[]" type="hidden" value="" id="qty_note_other' + row_no + '">';

        inner_new_row += '</td>';

        // Add other table fields (like description, quantity, etc.)
        inner_new_row += '<td><textarea style="width:200px; min-height:80px; padding:5px;" name="product_item[]" id="product_item_other' + row_no + '"></textarea></td>';
        inner_new_row += '<td><textarea style="width:100%; min-height:80px; padding:5px;" name="product_desc[]" id="product_desc_other' + row_no + '"></textarea></td>';
        inner_new_row += '<td></td>';
        inner_new_row += '<td></td>';

        inner_new_row += '<td style="text-align:center;">';
        inner_new_row += '<input class="chk_qty" name="qty[]" id="qty_other' + row_no + '" type="number" min="0" style="text-align:center; width:50px;padding: 2px 0;" onchange="return calPrice(\'other' + row_no + '\',1);" onkeyup="return calPrice(\'other' + row_no + '\',1);" value="">';
        inner_new_row += '</td>';

        inner_new_row += '<td style="text-align:center;"><input class="chk_uprice" name="uprice[]" type="number" min="0" id="uprice_other' + row_no + '" style="text-align:center; width:50px; padding: 2px 0;" onchange="return calPrice(\'other' + row_no + '\',1);" onkeyup="return calPrice(\'other' + row_no + '\',1);"></td>';

        inner_new_row += '<td style="text-align:center;" id="amount_other' + row_no + '"></td>';

        inner_new_row += '<td style="text-align:center;"><button type="button" class="btn btn-danger" onclick="return deleteRow(\'other' + row_no + '\',1);">Del</button></td>';

        inner_new_row += '</tr></tbody>';

        $('#tbl_cart_info').append(inner_new_row);

        var rows = $('#tbl_cart_info tbody').eq(1).find('tr');
        console.warn("------" + rows.attr('data-commonid'))

        // Update the row number count
        row_no = parseInt(row_no) + 1;

        $('#count_item_row').val(row_no);
        let common_id = rows.attr('data-commonid');

        if (common_id) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/AddMoreRow",
                data: {
                    common_id: common_id
                },


                success: function(resp) {
                    console.log(resp.item.qdoci_id);
                    // let reponse = JSON.parse(resp); 
                    let item = resp.item;
                    console.warn("ITEMMMMM" + item);
                    $('.' + tr_cls).attr('data-sortnumber', item['sort']);
                    $('.' + tr_cls).attr('data-commonid', item['qdoc_id']);
                    $('.' + tr_cls).attr('data-quytoid', item['qdoci_id']);
                    $('.' + new_other_ids).val(item['qdoci_id']);

                }

            });

            DragEsitamateSort();
        } else {
            $('#tbl_cart_info').sortable({
                connectWith: '#tbl_cart_info', // Allow dragging between both tables
                update: function(event, ui) {

                    const draggedRow = ui.item;
                    // let droppedRow ;
                    // let dragPre = draggedRow.prev(); 

                    // if(dragPre.attr('data-status') =='false') { 
                    //     droppedRow=  draggedRow.next();     
                    // }else{
                    //     droppedRow = draggedRow.prev()
                    // }


                }
            }).disableSelection();

        }



    }



    function editUnitPrice(row_id, uprice_ori, qdoci_id) {



        var new_uprice_ori = prompt("Edit the original unit price:", uprice_ori);



        if (new_uprice_ori != null && new_uprice_ori != "") {



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

            $('#uprice_' + row_id).val(new_uprice_ori);

            $('#old_uprice_' + row_id).val(new_uprice_ori);

            $('#select_' + row_id).val("0|0.0");

            selectAddi(row_id);



        }

    }



    $(document).on('keydown', '#actual_disc', function(event) {

        // var $this = $(this);

        // if ((event.which != 46 || $this.val().indexOf('.') != -1) &&

        //   ((event.which < 48 || event.which > 57) &&

        //   (event.which != 0 && event.which != 8))) {

        //       event.preventDefault();

        // }



        // var text = $(this).val();

        // if ((event.which == 46) && (text.indexOf('.') == -1)) {

        //     console.log(text);

        //     setTimeout(function() {

        //         if ($this.val().substring($this.val().indexOf('.')).length > 3) {

        //             $this.val($this.val().substring(0, $this.val().indexOf('.') + 3));

        //         }

        //     }, 1);

        // }



        // if ((text.indexOf('.') != -1) &&

        //     (text.substring(text.indexOf('.')).length > 2) &&

        //     (event.which != 0 && event.which != 8) &&

        //     ($(this)[0].selectionStart >= text.length - 2)) {

        //         event.preventDefault();

        // }



        setTimeout(function() {

            var dInput = parseFloat($('#actual_disc').val());

            if (isNaN(dInput)) {

                dInput = 0;

                $('#actual_disc').val(0);

            }

            var total = parseFloat($('#sub_total').val());

            var prefix = $('#gtotal_value').attr('prefix');

            var final_val = parseFloat(dInput.toFixed(2));

            if (final_val > total) {

                alert('Invalid value');

                $('.number_disc').val(0);

                $('#actual_disc').val(0);

                //$('#sp_show_gtotal_value_discounted').html(prefix+total);

                //$('#gtotal_value_discounted').val(total);

                changeIncludeVAT();

            } else {

                var discounted_value = (total - final_val).toFixed(2);

                var discount_percent = ((dInput / total) * 100).toFixed(2);

                $('.number_disc').val(discount_percent);

                //$('#sp_show_gtotal_value_discounted').html(prefix+discounted_value);

                //$('#gtotal_value_discounted').val(discounted_value);

                //$('#actual_disc').val(final_val);

                changeIncludeVAT();

            }

        }, 0);

    });



    $(document).on('keydown', '.number_disc', function(event) {

        var $this = $(this);

        if ((event.which != 46 || $this.val().indexOf('.') != -1) &&

            ((event.which < 48 || event.which > 57) &&

                (event.which != 0 && event.which != 8))) {

            event.preventDefault();

        }



        var text = $(this).val();

        if ((event.which == 46) && (text.indexOf('.') == -1)) {

            console.log(text);

            setTimeout(function() {

                if ($this.val().substring($this.val().indexOf('.')).length > 3) {

                    $this.val($this.val().substring(0, $this.val().indexOf('.') + 3));

                }

            }, 1);

        }



        if ((text.indexOf('.') != -1) &&

            (text.substring(text.indexOf('.')).length > 2) &&

            (event.which != 0 && event.which != 8) &&

            ($(this)[0].selectionStart >= text.length - 2)) {

            event.preventDefault();

        }



        setTimeout(function() {

            var dInput = parseFloat($('.number_disc').val());

            if (isNaN(dInput)) {

                dInput = 0;

                $('.number_disc').val(0);

            }

            var total = parseFloat($('#sub_total').val());

            var prefix = $('#gtotal_value').attr('prefix');

            var final_val = parseFloat(((dInput / 100) * total).toFixed(2));

            if (final_val > total) {

                alert('Invalid value');

                $('.number_disc').val(0);

                $('#actual_disc').val(0);

                //$('#sp_show_gtotal_value_discounted').html(prefix+total);

                //$('#gtotal_value_discounted').val(total);

                changeIncludeVAT();

            } else {

                var discounted_value = (total - final_val).toFixed(2);

                //$('#sp_show_gtotal_value_discounted').html(prefix+discounted_value);

                //$('#gtotal_value_discounted').val(discounted_value);

                $('#actual_disc').val(final_val);

                changeIncludeVAT();

            }

        }, 0);

    });



    $(document).on('click', '.number_disc', function() {

        $(this).select();

    })





    $(document).ready(function() {

        $('.number_disc').bind("paste", function(e) {

            var text = e.originalEvent.clipboardData.getData('Text');

            if ($.isNumeric(text)) {

                if ((text.substring(text.indexOf('.')).length > 3) && (text.indexOf('.') > -1)) {

                    e.preventDefault();

                    $(this).val(text.substring(0, text.indexOf('.') + 3));

                }

            } else {

                e.preventDefault();

            }

        });

    })



    $(document).on('keydown', '.number_disc_approval', function(event) {

        var $this = $(this);
        var shippingvalue = 0;
        var shippingvalue = $this.data('shipp');

        $('.shippcount1').each(function() {
            var value = parseFloat($(this).text());
            if (!isNaN(value)) {
                shippingvalue += value;
            }
        });
        console.log(shippingvalue);
        if (shippingvalue === undefined) {
            shippingvalue = 0;
        }
        var text = $(this).val();
        var periodCount = 0;
        for (var i = 0; i < text.length; i++) {
            if (text[i] === '.') {
                periodCount++;
            }
        }
        if (periodCount === 1 && event.which == 190) {
            event.preventDefault();
        }
        if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
            ((event.which < 48 || event.which > 57) &&
                (event.which != 0 && event.which != 8) && event.which != 190)) {
            event.preventDefault();
        }



        var text = $(this).val();

        if ((event.which == 46) && (text.indexOf('.') == -1)) {

            setTimeout(function() {

                if ($this.val().substring($this.val().indexOf('.')).length > 3) {

                    $this.val($this.val().substring(0, $this.val().indexOf('.') + 3));

                }

            }, 1);

        }



        if ((text.indexOf('.') != -1) &&

            (text.substring(text.indexOf('.')).length > 2) &&

            (event.which != 0 && event.which != 8) &&

            ($(this)[0].selectionStart >= text.length - 2)) {

            event.preventDefault();

        }

        setTimeout(function() {
    var dInput = parseFloat($('.number_disc_approval').val());

    if (isNaN(dInput)) {
        dInput = 0;
        $('.number_disc_approval').val(0);
    }

    var total = parseFloat($('#sp_app_sub_total').html());
    var prefix = $('#sp_show_gtotal_value_app').attr('prefix');

    // Discount on full total — shippingvalue passed to changeIncludeVATApprove separately
    var final_val = parseFloat(((dInput / 100) * total).toFixed(2));

    if (final_val > total) {
        alert('Invalid value');
        $('.number_disc_approval').val(0);
        $('#actual_disc_approval').val(0);
        changeIncludeVATApprove(shippingvalue);
    } else {
        var discounted_value = (total - final_val).toFixed(2);
        $('#actual_disc_approval').val(final_val);
        changeIncludeVATApprove(shippingvalue);
    }

}, 0);


        // setTimeout(function() {

        //     var dInput = parseFloat($('.number_disc_approval').val());

        //     if (isNaN(dInput)) {

        //         dInput = 0;

        //         $('.number_disc_approval').val(0);

        //     }

        //     var total = parseFloat($('#sp_app_sub_total').html());

        //     var prefix = $('#sp_show_gtotal_value_app').attr('prefix');

        //     var final_val = parseFloat(((dInput / 100) * (total - shippingvalue)).toFixed(2));

        //     if (final_val > total) {

        //         alert('Invalid value');

        //         $('.number_disc_approval').val(0);

        //         $('#actual_disc_approval').val(0);

        //         //$('#sp_show_gtotal_value_discounted').html(prefix+total);

        //         //$('#gtotal_value_discounted').val(total);

        //         changeIncludeVATApprove(shippingvalue);

        //     } else {

        //         var discounted_value = (total - final_val).toFixed(2);

        //         //$('#sp_show_gtotal_value_discounted').html(prefix+discounted_value);

        //         //$('#gtotal_value_discounted').val(discounted_value);

        //         $('#actual_disc_approval').val(final_val);

        //         changeIncludeVATApprove(shippingvalue);

        //     }

        // }, 0);

    });



    $(document).on('click', '.number_disc', function() {

        $(this).select();

    })



    $(document).on('click', '.number_disc_approval', function() {

        $(this).select();

    })

    $(document).on('click', '#actual_disc_approval', function() {
        $(this).select();
    })

    $(document).on('keydown', '#actual_disc_approval', function(event) {

        var $this = $(this);
        //var shippingvalue = $this.data('shipp');
        var shippingvalue = 0;
        $('.shippcount1').each(function() {
            var value = parseFloat($(this).text());
            if (!isNaN(value)) {
                shippingvalue += value;
            }
        });

        if (shippingvalue === undefined) {
            shippingvalue = 0;
        }
        var text = $(this).val();
        var periodCount = 0;
        for (var i = 0; i < text.length; i++) {
            if (text[i] === '.') {
                periodCount++;
            }
        }
        if (periodCount === 1 && event.which == 190) {
            event.preventDefault();
        }
        if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
            ((event.which < 48 || event.which > 57) &&
                (event.which != 0 && event.which != 8) && event.which != 190)) {
            event.preventDefault();
        }



        var text = $(this).val();

        if ((event.which == 46) && (text.indexOf('.') == -1)) {

            setTimeout(function() {

                if ($this.val().substring($this.val().indexOf('.')).length > 3) {

                    $this.val($this.val().substring(0, $this.val().indexOf('.') + 3));

                }

            }, 1);

        }



        if ((text.indexOf('.') != -1) &&

            (text.substring(text.indexOf('.')).length > 2) &&

            (event.which != 0 && event.which != 8) &&

            ($(this)[0].selectionStart >= text.length - 2)) {

            event.preventDefault();

        }



        setTimeout(function() {

            var dInput = parseFloat($('#actual_disc_approval').val());

            if (isNaN(dInput)) {

                dInput = 0;

                $('#actual_disc_approval').val(0);

            }

            var total = parseFloat($('#sp_app_sub_total').html());

            var prefix = $('#sp_show_gtotal_value_app').attr('prefix');

            var final_val = parseFloat(dInput.toFixed(2));

            if (final_val > total) {

                alert('Invalid value');

                $('.number_disc_approval').val(0);

                $('#actual_disc_approval').val(0);

                //$('#sp_show_gtotal_value_discounted').html(prefix+total);

                //$('#gtotal_value_discounted').val(total);

                changeIncludeVATApprove2();

            } else {

                var discounted_value = ((total - shippingvalue) - final_val).toFixed(2);

                var discount_percent = ((dInput / (total - shippingvalue)) * 100).toFixed(2);

                $('.number_disc_approval').val(discount_percent);

                //$('#sp_show_gtotal_value_discounted').html(prefix+discounted_value);

                //$('#gtotal_value_discounted').val(discounted_value);

                //$('#actual_disc_approval').val(final_val);

                changeIncludeVATApprove2();

            }

        }, 0);

    });



    $(document).ready(function() {

        $('.number_disc').bind("paste", function(e) {

            var text = e.originalEvent.clipboardData.getData('Text');

            if ($.isNumeric(text)) {

                if ((text.substring(text.indexOf('.')).length > 3) && (text.indexOf('.') > -1)) {

                    e.preventDefault();

                    $(this).val(text.substring(0, text.indexOf('.') + 3));

                }

            } else {

                e.preventDefault();

            }

        });

    })



    $(document).on('click', '.update_val', function() {

        var curr_id = $(this).attr("val_attr");

        var value = $('#val_' + curr_id).val();

        $('#quote_exchange_div').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');

        $.ajax({

            type: 'POST',

            data: {

                curr_id: curr_id,

                value: value

            },

            url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/updateCurrQuote',

            success: function(response) {

                var response = JSON.parse(response);

                if (response.status == 1) {

                    fetchQuoteCurrency();

                }

            }

        })

    })



    $(document).on('change', '#change_curr_quote', function() {

        var curr_id = $(this).val();

        var symbol = $('option:selected', this).attr('curr_symbol');

        var or_curr_id = $('#or_curr_id').val();

        var post_data = $('#post_data').val();

        $.ajax({

            type: "POST",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/showQuoteFormUpdate",

            data: {

                curr_id: curr_id,

                or_curr_id: or_curr_id,

                post_data: post_data,

                symbol: symbol

            },

            success: function(resp) {

                //console.log(resp);



                $('#quote_body').html(resp);

                //$('#cartV2Modal').modal("toggle");

                //$('#quoteV2Modal').modal("toggle");
                <?php
                if ($user_id != "21") {
                ?>
                    $('#cust_selector').select2({
                        dropdownParent: $("#quoteV2Modal")
                    });
                <?php
                }
                ?>
                $('#td_grand_total').html($('#sp_show_gtotal_value').html());



                setTimeout(function() {



                    $('.subnvat').hide();



                    if ($('#qdoc_id_old').val()) {



                        $('#td_auto_code').html($('#est_number_old').val());



                        $('#select_payment_term').val($('#payment_term_old').val());



                        $('#head_selector').val($('#comp_id_old').val());

                        changeQuoteHeadV2();



                        $('#cust_selector').val($('#cust_id_old').val());

                        changeCustomerV2();



                        if ($('#inc_vat_old').val() == "yes") {

                            $('#inc_vat').prop("checked", true);

                        } else {

                            $('#inc_vat').prop("checked", false);

                        }

                        changeIncludeVATV2();

                    }

                }, 100);

            }

        });



    })



    function change_cust_modal(cust_id, qdoc_id) {

        var cust_id = cust_id;

        var qdoc_id = qdoc_id;

        $.ajax({

            type: 'POST',

            data: {

                cust_id: cust_id,
                qdoc_id: qdoc_id
            },

            url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/getCustomerList',

            success: function(response) {

                $('#major_customer').html(response);

                $('#qdoc_id_update_customer').val(qdoc_id);

                $('#updateCustomerModalLive').modal('show');

            }

        })

    }



    function edit_cust_modal(cust_id, qdoc_id, cust_name) {

        var cust_id = cust_id;

        var qdoc_id = qdoc_id;

        $('#showcheckcustinfo').html('');
        $('#editCustname').val('');
        $.ajax({

            type: 'POST',

            data: {

                cust_id: cust_id,
                qdoc_id: qdoc_id

            },

            url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/getCustomerInfoNew',

            success: function(response) {

                var response = JSON.parse(response);

                if (response.status == 1 && response.sales.length > 0) {

                    $('#edit_cust_id_live').val(response.data[0].cust_id);
                    $('#edit_cust_name_live').val(response.data[0].cust_name);
                    $('#edit_cust_info_live').val(response.data[0].cust_info);
                    $('#edit_sales_tax_live').val(response.data[0].sales_tax);
                    $('#edit_tax_id_live').val(response.data[0].tax_id);
                    $('#edit_tax_state_name').val(response.data[0].billing_state);

                    $('#qdoc_id_live').val(qdoc_id);
                    $('#editCustomerModalLive').modal('show');
                } else {
                    $('#edit_cust_id_live').val('no_cust_id');
                    $('#qdoc_id_live').val(qdoc_id);
                    $('#edit_cust_name_live').val(cust_name);
                    $('#editCustomerModalLive').modal('show');
                }

            }

        })

    }



    $(document).on('submit', '#customer_update_live_main', function(e) {

        e.preventDefault();

        var form = $(this);

        var formData = new FormData(form[0]);

        $.ajax({

            type: 'POST',

            data: formData,

            processData: false,

            contentType: false,

            url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/updateCustomerInModal',

            success: function(response) {

                var response = JSON.parse(response);

                if (response.status == 1) {

                    if ($('#editCustname').val() == 'editCustname') {
                        convertQuotation(qdoc_id, salesrep_id);
                    } else {


                        var cust_name = response.cust_name;

                        var cust_info = response.cust_info;

                        var cust_id = response.cust_id;

                        var qdoc_id = response.qdoc_id;

                        $('#updateCustomerModalLive').modal('hide');

                        viewQuotation(qdoc_id, 'vp');
                    }

                }

            }

        })

    })



    $(document).on('submit', '#customer_update_live', function(e) {

        e.preventDefault();

        var form = $(this);

        var formData = new FormData(form[0]);

        var cust_info = formData.get('edit_cust_info');

        var cust_name = formData.get('edit_cust_name_live');
        var qdoc_id = formData.get('qdoc_id');

        $.ajax({

            type: 'POST',

            data: formData,

            processData: false,

            contentType: false,

            url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/updateCustomerInfoQuote',

            success: function(response) {

                var response = JSON.parse(response);

                if (response.status == 1) {

                    if ($('#editCustname').val() == 'editCustname') {
                        $('#editCustomerModalLive').modal('hide');
                        convertQuotation(qdoc_id, response.salesrep_id);
                    } else {
                        var html = '';

                        html += 'BILL TO<br>' + cust_name + '<pre>' + cust_info + '</br><span id="tax_id_preview"><b>TAX ID:</b> ' + response.tax_id + '</b></span> </pre>';

                        $('.bill_to').empty();

                        $('.bill_to').append(html);
                        $('#sales_tax_preview').html(response.sales_tax);

                        $('#edit_sales_tax_live').val(response.sales_tax);
                        $('#edit_tax_id_live').val(response.tax_id);

                        $('#editCustomerModalLive').modal('hide');
                    }

                }

            }

        })

    })



    $(document).on('change', '#Calculator_comp_itemcost', function() {

        $('#Calculator_online_order_commission').val(0);

    })



    $(document).on('change', '#Calculator_online_order_commission', function() {

        $('#Calculator_comp_itemcost').val(0);

    })



    function gdriveNoti(item_id, link_id) {

        var driver = '';

        var item_id = item_id;

        $.ajax({

            type: 'POST',

            data: {

                item_id: item_id

            },

            url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/fetchGdriveLink',

            success: function(response) {

                var response = JSON.parse(response);



                if (response.status == 1) {

                    var html = '';

                    var count = 0;

                    for (var i = 0; i < response.data.length; i++) {

                        count = i + 1;

                        html += '<button class="btn btn-info" onclick="changeIframeSource(\'' + response.data[i].gdrive_link + '\',' + item_id + ',' + response.data[i].gdrive_id + ')">Link ' + count + '</button>';

                        if (link_id == response.data[i].gdrive_id) {

                            var main_url = response.data[i].gdrive_link;

                        }

                    }

                    $('#iframeLinks').empty();

                    $('#iframeLinks').append(html);

                    $('#drive_item_id').val(item_id);

                    $('#drive_link_id').val(response.data[0].gdrive_id)

                    $('#GdriveModal').modal('show');

                    document.getElementById("myIframe").src = main_url;

                    driver = link_id;

                    $('#comments').empty();

                    $.ajax({

                        type: 'POST',

                        data: {

                            driver: driver

                        },

                        url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/fetchGdriveChats',

                        success: function(response) {

                            var response = JSON.parse(response);

                            if (response.status == 1) {

                                var html = '';

                                html = atob(response.msg);

                                $('#comments').append(html);

                            }

                        }

                    })

                }

            }

        })

    }
</script>



<script>
    $(document).ready(function() {

        $('input[name="college"]').change(function() {

            if ($(this).val() === "Yes") {

                $('#college-table').show();

            } else {

                $('#college-table').hide();

            }

        });

    });



    $(document).ready(function() {

        $('input[name="split_comm"]').change(function() {

            if ($(this).val() === "Yes") {

                $('#split-comm-table').show();

            } else {

                $('#split-comm-table').hide();

            }

        });

    });



    function addRowSplit(element) {

        var sale_id = $('#est_sales_id').val();

        // var newRow = $(element).closest('tr').clone();

        var newRow = $('<tr><td><select name="sales_rep_name[]"><option value="" disabled>--Select Sales Rep--</option></select></td><td><input type="text" name="sales_percent[]" class="salesPercentInput"></td><td><i class="fa fa-plus addRowIcon" onclick="addRowSplit(this)"></i><i class="fa fa-minus deleteRowIcon" onclick="deleteRowSplit(this)"></i></td></tr>');



        // Fetch sales reps using AJAX or pre-fetch them and add the options to the select element

        <?php

        $sql_split = "SELECT * FROM user WHERE (enable=1 AND user_group_id=2) OR id='65' ORDER BY fullname ASC;";

        $fetch_split = Yii::app()->db->createCommand($sql_split)->queryAll();

        foreach ($fetch_split as $main_split) {

        ?>

            newRow.find('select').append('<option value="<?= $main_split['id'] ?>"><?= $main_split['fullname'] ?></option>');

        <?php

        }

        ?>

        newRow.find('select option[value="' + sale_id + '"]').remove();

        newRow.find('.salesPercentInput').val('0'); // Set input value in the new row to '0'

        $('#salesTable').append(newRow);



        // Attach input event listener to the new row's input field

        newRow.find('.salesPercentInput').on('input', function() {

            var input = $(this).val();

            var sanitizedInput = input.replace(/[^0-9.]/g, '');

            var decimalCount = sanitizedInput.split('.').length - 1;



            if (decimalCount > 1) {

                sanitizedInput = sanitizedInput.slice(0, -1);

            }



            $(this).val(sanitizedInput);

        });



        // Set focus and select the '0' value when the input field is clicked

        newRow.find('.salesPercentInput').on('click', function() {

            $(this).val('0').select();

        });

    }



    $(document).ready(function() {

        function handleFocus() {

            $(this).on('focus', function() {

                $(this).val('0').select();

            }).on('input', function(e) {

                if ($(this).val() === '') {

                    $(this).val('0');

                }

            });

        }



        // Attach focus and input event handlers to existing inputs

        $('.salesPercentInput').each(handleFocus);

    })



    function deleteRowSplit(element) {

        var tableRows = $('#salesTable tr');

        if (tableRows.length > 1) {

            $(element).closest('tr').remove();

        } else {

            alert("At least one row must be present.");

        }

    }



    $(document).ready(function() {

        // Initial input sanitization for existing rows

        $('.salesPercentInput').on('input', function() {

            var input = $(this).val();

            var sanitizedInput = input.replace(/[^0-9.]/g, '');

            var decimalCount = sanitizedInput.split('.').length - 1;



            if (decimalCount > 1) {

                sanitizedInput = sanitizedInput.slice(0, -1);

            }



            $(this).val(sanitizedInput);

        });

    });





    $(document).ready(function() {

        $('.js-example-basic-multiple').select2();

    });
</script>
<script>
    $(document).on('click', '#CustomerUpdater', function() {
        var add_cust_name = $('#add_cust_name').val();
        var add_cust_info = $('#add_cust_info').val();
        if (add_cust_name == '' || add_cust_info == '') {
            alert('Please fill both the fields');
        } else {
            $.ajax({
                type: 'POST',
                data: {
                    add_cust_name: add_cust_name,
                    add_cust_info: add_cust_info
                },
                url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/AddNewCustomerAjax',
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status == 1) {
                        var cust_id = response.cust_id;
                        var html = '';
                        html += '<option value="' + cust_id + '">' + add_cust_name + '</option>';
                        $('#cust_selector').append(html);
                        $('#cust_selector').val(cust_id).change();
                        toggleCustomerForm();
                    }
                }
            })
        }
    })

    function toggleCustomerForm() {
        var form = document.getElementById("newCustomerForm");
        if (form.style.display === "none" || form.style.display === "") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }

    $(document).ready(function() {
        // When an <li> is clicked
        $(document).on('click', '#categoryList li', function() {
            const liValue = $(this).attr('value').replace('extra_', ''); // Get the value and normalize
            $('#sel2').val(liValue).change(); // Set the value in the <select>
        });

        // When <select> is changed
        $(document).on('change', '#sel2', function() {
            const selectValue = $(this).val();
            $('#categoryList li').removeClass('selected'); // Remove 'selected' class from all <li>
            $('#categoryList li[value="extra_' + selectValue + '"]').addClass('selected'); // Highlight the corresponding <li>
        });

        // Add some styles for the selected <li>
        $('<style>')
            .prop('type', 'text/css')
            .html(`
                #categoryList li {
                    cursor: pointer; /* Pointer cursor for list items */
                }
                #categoryList li.selected {
                    background-color: #f0f0f0;
                    font-weight: bold;
                }
            `)
            .appendTo('head');
    });
</script>

<script>
    $(document).ready(function() {
        // Event listener for the Fullscreen button
        $('.FullscreenBtn').on('click', function() {
            // Toggle 'fullscreen' class on the modal
            $('#cartV2Modal').toggleClass('fullscreen');
        });
    });
</script>

<script>
    function moveUp(tmp_id) {
        var row = document.getElementById('tr_' + tmp_id);
        var prevRow = row.previousElementSibling;

        if (prevRow) {
            // Move row up
            row.parentNode.insertBefore(row, prevRow);

            // Reassign row numbers and update arrows
            updateRowNumbers();
        }
    }

    function moveDown(tmp_id) {
        var row = document.getElementById('tr_' + tmp_id);
        var nextRow = row.nextElementSibling;

        if (nextRow) {
            // Move row down
            row.parentNode.insertBefore(nextRow, row);

            // Reassign row numbers and update arrows
            updateRowNumbers();
        }
    }

    function updateRowNumbers() {
        var rows = document.querySelectorAll('#tbl_cart_info tbody tr'); // Make sure to select all <tr> rows
        var count = 1;

        rows.forEach(function(row) {
            var rowNumber = row.querySelector('.rowNumber');
            var moveUpArrow = row.querySelector('.moveUpArrow');
            var moveDownArrow = row.querySelector('.moveDownArrow');

            if (rowNumber) {
                rowNumber.innerHTML = count;
                count++;
            }

            if (moveUpArrow && moveDownArrow) {
                // Ensure arrows remain visible
                moveUpArrow.style.display = 'inline';
                moveDownArrow.style.display = 'inline';
            }
        });
    }

    function getCommentNotification() {
        showLoader();
        $.ajax({
            url: '<?php echo Yii::app()->request->baseUrl; ?>/leads/getNotificationIcon',
            method: 'POST',
            data: {
                id: '',
            },
            success: function(response) {
                $('.comment_notification_box').html(response);
                hideLoader();
            },
            error: function(xhr, status, error) {
                connsole.warn("Error" + error);
                hideLoader();

            }

        })
    }

    function NotificationAPP(qdoc_id) {
        $.ajax({
            url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/sendNotifPrivateNotes',
            method: 'POST',
            data: {
                qdoc_id: qdoc_id
            },
            success: function(response) {
                $('#Notifi_private_notes').removeClass('btn-primary');
                $('#Notifi_private_notes').addClass('btn-warning');
            },
            error: function(xhr, status, error) {
                connsole.warn("Error" + error);
            }
        })
    }

    $(document).on('click', '.btn-sort', function() {
        const button = $(this);
        const direction = button.data('action');
        const row = button.closest('tr');
        const currentId = button.data('id');

        let targetRow;
        if (direction === 'up') {
            targetRow = row.prev('tr');
        } else if (direction === 'down') {
            targetRow = row.next('tr');
        }

        if (targetRow.length > 0) {
            if (direction === 'up') {
                row.insertBefore(targetRow);
            } else {
                row.insertAfter(targetRow);
            }

            // Collect all qdoci_id in new order
            let sorted_ids = [];
            $('tr').each(function() {
                const qid = $(this).attr('class');
                if (qid) sorted_ids.push(qid);
            });

            // Send to backend
            $.ajax({
                url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/updateQuoteSort',
                type: 'POST',
                data: {
                    ids: sorted_ids
                },
                success: function(res) {
                    console.log('Sort order updated');
                },
                error: function() {
                    alert('Failed to update sort order');
                }
            });
        }
    });

    $(document).on('change', '.update-est-date', function() {
        var qdoc_id = $(this).closest('td').data('id');
        var est_date = $(this).val();

        $.ajax({
            url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/updateExdudate',
            method: 'POST',
            data: {
                type: 'est_date',
                qdoc_id: qdoc_id,
                date_value: est_date
            },
            success: function(res) {
                console.log('Estimate date updated');
            },
            error: function() {
                alert('Failed to update estimate date');
            }
        });
    });

    $(document).on('change', '.update-exp-date', function() {
        var qdoc_id = $(this).closest('td').data('id');
        var exp_date = $(this).val();

        $.ajax({
            url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/updateExdudate',
            method: 'POST',
            data: {
                type: 'exp_date',
                qdoc_id: qdoc_id,
                date_value: exp_date
            },
            success: function(res) {
                console.log('Due date updated');
            },
            error: function() {
                alert('Failed to update due date');
            }
        });
    });

    $('.comment_notification_box').click(function() {


        $.ajax({
            url: '<?php echo Yii::app()->request->baseUrl; ?>/leads/getNotificationIconDropdown',
            method: 'POST',
            data: {
                id: '',
            },
            success: function(response) {
                $('.notification_dropdown').html(response);

            },
            error: function(xhr, status, error) {
                connsole.warn("Error" + error);
            }

        })

        if ($('.notification_dropdown').is(':visible')) {
            $('.notification_dropdown').hide();
        } else {
            $('.notification_dropdown').show();
        }
    });

    $(document).ready(function() {
        getCommentNotification();
    });

    function DragEsitamateSort() {
        $('#tbl_cart_info').sortable({
            connectWith: '#tbl_cart_info tbody', // Make sure it's only within the same table

            update: function(event, ui) {
                const draggedRow = ui.item;
                let droppedRow = draggedRow.prev().length ? draggedRow.prev() : draggedRow.next();
                //  const droppedRow = draggedRow;

                let dragged_id = draggedRow.data('quytoid');
                let common_id = draggedRow.data('commonid');
                let set_row = '';
                let dropped_id = '';
                let dragged_sort = '';

                let Ids = {};

                $('.approved_tr').each(function(key) {
                    let sort = $(this).data('sortnumber');
                    let commonId = $(this).data('commonid');
                    let quitoId = $(this).data('quytoid');


                    // if(commonId === common_id) {

                    // if(sort && sort !== '') {

                    Ids[quitoId] = key + 1;
                    // }
                    // }

                });



                console.warn(Ids);


                $.ajax({
                    url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/sortQuoteItemNew', // PHP file to process the update
                    type: 'POST',
                    data: {
                        id: Ids,

                    },
                    success: function(response) {
                        console.log("Response " + response);

                    },
                    error: function(xhr, status, error) {
                        console.error('Error moving row: ' + error);
                    }
                });
            }

        }).disableSelection();
    }




     // update quotation estimate ---customer type 
	$(document).on('change' , '.estimate_create_dropdown ,.customer_select_for_quotation' ,function(){
       let customer_id = $(this).val(); 
       let is_quotation = $(this).hasClass('customer_select_for_quotation') ? 1 : 0 ; 
       let is_estimate = $(this).data('estimate') ? 1 : 0;
       if(customer_id.length!=0){
       showLoader();
	   $.ajax({
            type: "POST",
			dataType: "json",
             url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/GetCustomerTypeList",
			data: {				
				 customer_id : customer_id, 
                 is_quotation : is_quotation ,	
                 is_estimate: is_estimate ,		
			},
			success: function(resp) { 
				  if(resp.status==200){
                    var $select ; 
                    if(is_quotation || is_estimate){
                          $select = $('#quoteDocModal').find('#customer_type');
                    }else{
                        
                         $select = $('#quoteV2Modal').find('#add_customer_type');
    
                    }
                    // $select.html(resp.html);
                   // set selected value again
                    if(resp.selected_id){
                          $select.val(resp.selected_id).trigger('change');
                    }
				  }
                  hideLoader();
			} , 
			error : function(xhr ,status , error){
				console.log("error" ,error);
                hideLoader();
			}
          
	   }) ;

       }
  

	});
    


 // Delete Notification for admin 
    
    $(document).on('click' ,'.delete_CRM_notification' ,function(event){
          event.preventDefault();
          event.stopPropagation();
         
         let lead_id = $(this).data('lead_id'); 
         let id = $(this).data('comment_id'); 
         let ele = $(this); 

      $.ajax({
            type: "POST",
			dataType: "json",
             url: "<?php echo Yii::app()->request->baseUrl; ?>/leads/DeleteCRMNotification",
			data: {				
               lead_id : lead_id , 
               id : id 
			},
			success: function(resp) { 
                 $('.notification_dropdown').show();
				  if(resp.status==200){
                      ele.closest('li').remove(); 
                     getCommentNotification();
				  }
                 
			} , 
			error : function(xhr ,status , error){
				console.log("error" ,error);
                
			}
          
	   }) ;

    });
</script>