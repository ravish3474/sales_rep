<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="
https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css
" rel="stylesheet">
<style type="text/css">
    .calc {
        width: 50%;
    }

    #comments {
        max-height: 300px;
        /* Set a maximum height for the scrollable area */
        overflow-y: scroll;
        /* Add a vertical scroll bar when content overflows */
    }

    /* Make width 100% !important for the specific class */
    .select2.select2-container.select2-container--default.select2-container--focus.select2-container--open.select2-container--above {
        width: 100% !important;
    }

    .select2.select2-container.select2-container--default {
        width: 100% !important;
    }

    .multiselect-container {
        overflow: scroll;
        height: 200px;
    }

    .multiselect-container>li>a>label {
        padding: 4px 20px 3px 20px;
    }

    .first_type {
        border-bottom-left-radius: 5px;
        border-top-left-radius: 5px;
    }

    .last_type {
        border-bottom-right-radius: 5px;
        border-top-right-radius: 5px;
    }

    .sale_type_tab {
        cursor: pointer;
        background-color: #337ab7;
        color: #FFF;
        padding: 5px 10px;
        margin: 5px 0px;
        font-size: 16px;
        border-radius: 4px !important;
    }

    .sale_type_tab:hover {
        background-color: #115895;
        border: 1px solid #005796;
        color: #FFF;
    }

    .sale_type_tab_active {
        background-color: #286090;
        border: 1px solid #204d74;
        color: #FFF;
    }

    .tbl_show_pguide th {
        background-color: #5c656d;
        color: #FFF;
        border: 1px solid #848d94;
        text-align: center;
        padding: 5px;
    }

    .tbl_show_pguide td {
        background-color: #FFF;
        color: #73879C;
        border: 1px solid #848d94;
        text-align: center;
        padding: 5px;
    }

    .tbl_show_pguide tr:hover td {
        background-color: #ffffda !important;
    }

    .tbl_show_pguide tr:hover td.row_group_name {
        color: #000 !important;
    }

    .col_backg1 {
        background-color: #E7F1F5 !important;
        color: #000 !important;
    }

    .col_backg2 {
        background-color: #CCD3D7 !important;
        color: #000 !important;
    }

    .col_backg3 {
        background-color: #D0D0D0 !important;
        color: #000 !important;
    }

    .add-to-cart {
        cursor: pointer;
    }

    .add-to-cart:hover {
        text-decoration: underline;
        color: #00F;
    }

    .add_link {
        cursor: pointer;
        font-size: 18px;
        color: #484;
    }

    .add_link:hover {
        color: #6A6;
    }

    .add_price {
        cursor: pointer;
        font-size: 18px;
        color: #484;
    }

    .add_price:hover {
        color: #6A6;
    }

    .tbl_notes th {
        border: 1px solid #AAA;
        padding: 5px;
    }

    .tbl_notes td {
        border: 1px solid #AAA;
        padding: 5px;
    }

    .cls_tbl_extra tr:hover td {
        background-color: #FFA;
    }

    .xls_btn {
        background-color: #5cb85c;
        padding: 5px 10px;
        border-radius: 4px;
        border: 1px solid #298529;
        float: right;
        margin-bottom: 10px;
        color: #fff;
        margin-left: 10px;
    }

    .xls_btn:hover {
        color: #777;
        background-color: #6DC96D;
        text-decoration: unset;
    }

    .modal select {
        height: 30px;
        text-align: center;
        width: 100%;
        font-size: 12px;
        margin: 0;
        border: 1px solid #44444461;
        border-radius: 3px;
    }

    .modal.in table td {
        vertical-align: middle;
    }

    .tbl-cart-info th {
        background-color: #5CB85C;
        outline: 1px solid #DDD;
        padding: 2px;
        color: #FFF;
        padding: 6px;
    }


    .manage-item-btn {
        float: right;
    }

    .query-title {
        color: #5C656D;
        font-size: 15px;
        background: #EEE;
        text-transform: capitalize;
        padding: 7px 20px;
        border-radius: 20px;
        align-items: 0;
        font-weight: 500;
    }

    .top-flex-head {
        display: flex;
        align-items: center;
        justify-content: space-around;
    }

    .query-title .fa {
        background: #5CB85C;
        color: #FFF !important;
        padding: 6px;
        margin: 0 10px;
        text-align: center;
    }

    #adminManageItemPanelModal .modal-dialog {
        max-width: 1200px !important;
        max-height: 100%;
    }

    #adminManageItemPanelModal .fa {
        background: none !important;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        padding: 0 !important;
        color: #FFF !important;
    }

    #adminManageItemPanelModal select {
        text-align: left;
    }

    #adminManageItemPanelModal .header_panel button,
    select {
        margin: 0px 4px;
        padding: 4px 15px;
        width: auto !important;
    }

    #manage_item_modal_body {
        padding: 30px;
    }

    #manage_item_modal_body .btn-warning {
        background: #5BC0DE;
        border-color: #5BC0DE;
        width: 25px;
        height: 25px;
    }

    #manage_item_modal_body .input-group-btn .btn-danger {
        background: #5BC0DE;
        border-color: #5BC0DE;
        width: 25px;
        height: 25px;
    }

    .btn-danger {
        background: #EA6153;
        border-color: #EA6153;
    }

    #zone_item_add select {
        margin: 0;
    }

    #zone_item_add input {
        height: 40px;
    }

    #zone_item_add textarea {
        height: 80px !important;
    }

    #zone_item_add select {
        height: 40px !important;
    }

    .new_input {
        height: 25px;
        background: #1479b80d;
        box-shadow: rgb(100 100 111 / 1%) 0px 7px 29px 0px;
        border: 1px solid #eee;
        padding: 20px !important;
    }

    #new_prod_item_form .new_input {
        padding: 0 10px !important;
    }

    .form-title {
        text-align: center;
        padding: 20px;
        text-transform: capitalize;
        background: #EEE;
    }

    label {
        margin: 9px 0;
        font-size: 16px;
        font-weight: 500;
    }

    #manage_item_modal_body {
        max-height: 100% !important;
    }

    .flex-header {
        display: flex;
    }

    .flex-header .close {
        color: #337AB7;
        position: absolute;
        right: 20px;
        top: 10px;
        padding: 6px 10px;
        background: #CED5DB;
    }

    #add_cost_calculator h1 {
        background: none !important;
        text-align: center;
        margin: 0 0 10px 0;
        padding: 0 0 10px 0;
        display: flex;
        justify-content: right;
        color: #FFF;
        font-size: 17px;

    }



    input.calc.profit_percentage {
        background: #337AB7 !important;
        color: #FFF !important;
    }

    .flex-header .modal-title {
        font-size: 17px;
    }

    h1 input {
        background: #337ab72e !important;
        text-align: left;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        border: none;
        color: #337AB7;
        font-size: 12px;
        padding: 10px 40px 10px 10px;
        width: auto;
    }

    #add_cost_calculator h1::after {
        display: none;
    }

    #add_cost_calculator h1 input::placeholder {
        color: #FFF;
        font-size: 12px;
        color: #337AB7;
    }

    #add_cost_calculator .table input {

        background: #337ab717;
        border: none;
        box-shadow: rgb(100 100 111 / 0%) 0px 7px 29px 0px;
        border-radius: 2px;
        padding: 5px 10px;
        width: 100% !important;
    }

    #adminEditUpdateColour textarea {
        min-width: 400px;
        min-height: 40px;
    }

    tr.tr_head {
        position: sticky;
        top: 0;
        z-index: 10;
    }

    #adminEditUpdateColour input {
        width: 100%;
        height: 70px;
        margin: 0px 0 0 0;
        position: relative;
    }

    #adminEditUpdateColour .modal-dialog {
        width: 70% !important;

    }

    #add_cost_calculator .modal-dialog {
        width: 70% !important;
    }

    #clone_modal .modal-dialog {
        width: 70% !important;
    }

    #clone_item_modal .modal-dialog {
        width: 50% !important;
    }

    #clone_item_modal .modal-body {
        padding: 30px 20px;
    }

    #clone_item_modal .form-check-label {
        padding-left: 10px;
        font-size: 14px;
    }

    #adminEditUpdateColour .color-edit {
        height: 30px;
        width: 30px;
        margin: 20px 0;
        border-radius: 50%;
        background-color: #EA6153;
        position: absolute;
        right: 20px;
    }

    .x_content {
        margin-top: 10px;
    }

    #adminCopyReplaceExtraItemModal select {
        font-size: 13px;
        border: 1px solid #dfd6d6;
        height: 100%;
        text-align: left;
        width: 100%;
        margin: 0;
    }

    #adminCopyReplaceExtraItemModal #chkveg {
        padding: 0;
    }

    #adminCopyReplaceExtraItemModal option {
        padding: 5px;
        color: #73879C;
    }

    #adminCopyExtraItemCategoryModal select {
        font-size: 13px;
        border: 1px solid #dfd6d6;
        height: 100%;
        text-align: left;
        width: 100%;
        margin: 0;
    }

    #adminCopyExtraItemCategoryModal #category_extra {
        padding: 0;
    }

    #adminCopyExtraItemCategoryModal option {
        padding: 5px;
        color: #73879C;
    }

    #adminCopyExtraItemCategoryModal #checkboxContainer {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    #adminCopyExtraItemCategoryModal #checkboxContainer label {
        font-size: 14px;
    }

    table.tbl_notes.cls_tbl_extra.tbl_content_qty .btn-warning {
        padding: 2px 5px;
    }

    table.tbl_notes.cls_tbl_extra.tbl_content_qty .btn-danger {
        padding: 2px 5px;
    }

    table.tbl_notes.cls_tbl_extra.tbl_content_qty .btn-success {
        padding: 2px 5px;
    }

    table.tbl_notes.cls_tbl_extra.tbl_content_qty label {
        font-size: 13px;
    }

    .tbl_new_extra td>input {
        font-size: 12px;
        padding: 5px;
        border: 1px solid #55555545;
    }

    #extra_cost_modal .modal-dialog {
        max-width: 50% !important;
    }

    .sorting_zone i {
        color: #3578B3 !important;
    }

    tr:hover i.fa.fa-pencil {
        background: none;
    }

    .btn-warning i.fa.fa-pencil {
        font-size: 14px;
        color: #FFF !important;
        background: none;
        padding: 0;
        width: auto;
        height: auto;
    } 
    #EditExtraItemsModal  .modal-dialog{
        max-width: 30% !important ;
    }
    @media screen and (max-width:1300px) {

        .sale_type_tab {
            font-size: 15px;
        }

        #extra_cost_modal .modal-dialog {
            max-width: 60% !important;
        }

        .x_title h2 {
            width: 100%;
        }

        .x_content {
            padding: 0;
        }

        .x_panel {
            padding: 10px;
        }
    }

    @media screen and (max-width:520px) {
        .x_title h2 {
            text-align: center !important;
        }

        #adminCopyReplaceExtraItemModal {
            width: 100% !important;
        }

        #extra_cost_modal .modal-dialog {
            max-width: 100% !important;
        }

        #adminCopyExtraItemCategoryModal {
            width: 100% !important;
        }

        #zone_item_add input {
            height: 35px;
        }

        #zone_item_add select {
            height: 35px !important;
        }

        #edit_price_form {
            overflow: hidden;
        }

        #adminEditUpdateColour .modal-dialog {
            width: 100% !important;
        }

        #clone_item_modal .modal-dialog {
            width: 100% !important;
        }

        #clone_item_modal #clone_submit {
            overflow: hidden !important;
        }

        #zone_item_add label {
            margin: 2px 0;
        }

        #zone_item_add textarea {
            height: 70px !important;
        }

        tr.tr_head {
            position: relative;
        }

        #add_cost_calculator form {
            width: 100%;
            padding: 40px 0;
            overflow-x: scroll;
        }

        .flex-header .modal-title {
            font-size: 16px;
            width: 80%;
        }

        #adminEditUpdateColour textarea {
            min-width: 200px;
            min-height: 40px;
        }

        #adminEditUpdateColour .color-edit {
            height: 20px;
            width: 20px;
            margin: 0;
            right: 14px;
            top: 10px;
        }

        #adminEditUpdateColour input {
            width: 100px;
        }

        #adminEditUpdateColour .btn {
            padding: 4px 20px;
            margin: 0;
        }

        .top_nav .btn-primary {
            width: 50px !important;
            height: 30px;
            padding: 0;
            top: 9px;
            right: 230px;
        }

        .top_nav .badge {
            font-size: 12px;
            padding: 5px 13px;
        }

        #add_cost_calculator .modal-dialog {
            width: 100% !important;
        }

        #clone_modal .modal-dialog {
            width: 100% !important;
        }

        .nav-sm .top_nav .btn-primary {
            padding: 5px 0;
        }

        #add_cost_calculator .table input {
            width: auto !important;
        }

        .nav-sm .top_nav .navbar-right {
            width: 100%;
        }

        form {
            overflow-x: scroll !important;
        }

        .nav-sm .nav>li>a {
            padding: 10px;
        }

        .x_title h2 {
            font-size: 17px;
            white-space: normal;
            width: 100%;
            text-align: left !important;
            line-height: 20px;
            border: 1px solid #00000021;
            padding: 10px;
            margin: 5px 0 11px 0;

        }

        .x_title {
            margin-bottom: 20px;
        }

        .sale_type_tab {
            line-height: 40px;
        }


        select#select_curr_id {
            margin: 6px 0 !important;
            width: 100%;
        }

        .tbl_show_pguide td {
            text-align: left !important;
        }

        table {
            margin: 4px 0 0 0;
        }

        .x_content {
            padding: 0;
        }

        h1 input {
            position: absolute;
            left: 0;
            bottom: 0;
        }

        .top_nav .nav.navbar-nav>li>a {
            font-size: 15px;
        }

        #manage_item_modal_body {
            padding: 20px 10px;
        }

        .top-flex {
            display: block;
            padding: 10px;
        }

        .query-title {
            font-size: 12px;
            padding: 7px 15px;
            line-height: 45px;
        }

        #adminManageItemPanelModal button,
        select {
            padding: 5px 7px !important;
            margin: 5px 7px !important;
        }

        #new_prod_item_form>.row div {
            padding: 0;
        }

        #manage_item_modal_body {
            max-height: 100% !important;
        }

        .form-title {
            padding: 11px;
        }

        #manage_item_modal_body .row {
            margin: 0;
        }

        #manage_item_modal_body .text-left {
            float: unset;
        }
    }

    #extra_price_content {
        scrollbar-width: unset;
        max-height: 700px;
        overflow: scroll;
    }
    #viewColor thead, #adminEditUpdateColour thead {
        position: unset;
    }
    #viewColor tbody td, #adminEditUpdateColour tbody td{
        text-transform: capitalize;
    }
    #viewColor .modal-dialog, #adminEditUpdateColour .modal-dialog { width: 50%;
    }

    #viewColor .modal-dialog table td, #adminEditUpdateColour .modal-dialog table td {
        text-transform: capitalize;
    } 

    #viewColor .modal-header .modal-title,  #adminEditUpdateColour .modal-header .modal-title {
        font-size: 15px;
        color: #5E5E5E;
    }

    #adminNewExtraItemModal .select2.select2-container.select2-container--default,
    #adminEditExtraItemModal .select2.select2-container.select2-container--default
     {
        max-width: 100% !important;
    }
    #adminNewExtraItemModal .select2-search__field,
    #adminEditExtraItemModal .select2-search__field
    {
        width: 100% !important;
        min-height: 30px;
        margin: 0;
        margin-top: 10px;
    }

    #adminNewExtraItemModal .modal-dialog,
    #adminEditExtraItemModal .modal-dialog
    {
        width: 50% !important;
    }
    #adminNewExtraItemModal .select2-container .select2-selection--multiple .select2-selection__rendered,
    #adminEditExtraItemModal .select2-container .select2-selection--multiple .select2-selection__rendered
    { 
        position: relative;
    }
    #categoryList tr {
        cursor: move;
    }

    .ui-sortable-helper {
        display: table;
    }

    .ui-sortable-placeholder {
        visibility: visible !important;
        background: #f5f5f5;
        height: 45px;
    }
    .focusingOnSection a{
        color: #FFF;
        font-size: 13px;
        padding: 6px 10px; 
        text-decoration: none;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 5px;
        border-radius: 10px; 
        justify-content: center;
        white-space: nowrap;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);

    }
    .focusingOnSection .productItemsMainTop{
        background: #2A3F54;
    }.focusingOnSection .productExtraItemsMainBottom{
        background: #337AB7;
    }
    .focusingOnSection .d-none{
        display: none;
    }
    .focusingOnSection{ 
        position: fixed;
        border: 1px solid rgba(255, 255, 255, 0.3);
        bottom:25px;    
        z-index: 10001;
        display: flex;
    }
    .focusingOnSection{
        right:-10px;
        transform:translateX(-50%) translateY(100%);
        opacity:0;
        transition:all .35s ease;
    }

    .focusingOnSection.show{
        transform:translateX(-50%) translateY(0);
        opacity:1;
    }
</style>
<?php

$prod_id = $row_product[0]['prod_id'];
$prod_name = $row_product[0]['prod_name'];

?>
<!-- <div id="debug_panel"></div> -->
<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="clearfix" id="productItemsMainTop"></div> 
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $row_product[0]['prod_detail']; ?></h2>
                <button type="button" class="xls_btn" onclick="return downloadToZip('xls');"> ZIP XLS (All Products) </button>
                <button type="button" class="xls_btn" onclick="return downloadToAll('xls');"> XLS (All Products) </button>
                <button type="button" class="paf_dowload" onclick="return downloadToAll('pdf');"> PDF (All Products) </button>
                <button type="button" class="xls_btn" onclick="return downloadTo('xls');"> XLS </button>
                <button type="button" class="paf_dowload" onclick="return downloadTo('pdf');"> PDF </button>
                <form id="download_form" action="" target="_blank" method="post">
                    <input type="hidden" name="dl_prod_id" id="dl_prod_id" value="<?php echo $prod_id; ?>">
                    <input type="hidden" name="dl_sale_type" id="dl_sale_type" value="">
                    <input type="hidden" name="dl_curr_id" id="dl_curr_id" value="">
                    <input type="hidden" name="dl_type" id="dl_type" value="">
                </form>
                <div class="clearfix"></div>
            </div>

            <div class="top-flex">
                <?php
                $user_group = Yii::app()->user->getState('userGroup');
                if ($user_group == "5") {
                ?>
                    <span id="sp_sale_type6" class="sale_type_tab first_type sale_type_tab_active last_type" onclick="return selectSaleType(6);">Factory Direct</span>
                    <input type="hidden" id="select_sale_type_id" value="6">
                    <?php
                } elseif ($user_group != "4") {

                    $n_loop = sizeof($row_sale_type);
                    $default_sat_id = "";

                    if ($sat_id_list != "") {

                        $a_sale_type_selected = explode(",", $sat_id_list);
                        $count_tab = 0;

                        for ($i = 0; $i < $n_loop; $i++) {

                            for ($j = 0; $j < sizeof($a_sale_type_selected); $j++) {

                                if ($a_sale_type_selected[$j] == $row_sale_type[$i]["sat_id"]) {
                                    $extra_class = "";
                                    if ($count_tab == 0) {
                                        $extra_class .= "first_type sale_type_tab_active ";
                                        $default_sat_id = $row_sale_type[$i]["sat_id"];
                                    }
                                    if (($j + 1) == sizeof($a_sale_type_selected)) {
                                        $extra_class .= "last_type";
                                    }

                    ?><span id="sp_sale_type<?php echo $row_sale_type[$i]["sat_id"]; ?>" class="sale_type_tab <?php echo $extra_class; ?>" onclick="return selectSaleType(<?php echo $row_sale_type[$i]["sat_id"]; ?>);"><?php echo $row_sale_type[$i]["sat_name"]; ?> </span>
                        <?php
                                    $count_tab++;
                                }
                            }
                        }
                        ?>
                        <input type="hidden" id="select_sale_type_id" value="<?php echo $default_sat_id; ?>">
                    <?php
                    } else {
                        echo '<h3 style="color:#F00; text-align:center;">Not Found Sale Type</h3></div></div></div></div>';
                        return;
                    }
                } else {
                    ?>
                    <span id="sp_sale_type3" class="sale_type_tab first_type sale_type_tab_active last_type" onclick="return selectSaleType(3);">Dealers</span>
                    <input type="hidden" id="select_sale_type_id" value="3">
                <?php
                }
                ?>
                &nbsp;Currency:
                <?php
                if (Yii::app()->user->getState('userGroup') == "5" || Yii::app()->user->getState('userGroup') == "4") { ?>
                    <select id="select_curr_id" onchange="showPriceGuide(); showExtraV2(); showNoteV2();">
                        <?php
                        for ($i = 0; $i < 2; $i++) {
                            echo '<option value="' . $row_currency[$i]["curr_id"] . '">' . $row_currency[$i]["curr_name"] . ' ' . $row_currency[$i]["curr_desc"] . '</option>';
                        }
                        ?>
                    </select>
                <?php } else { ?>

                    <select id="select_curr_id" onchange="showPriceGuide(); showExtraV2(); showNoteV2();">
                        <?php
                        for ($i = 0; $i < sizeof($row_currency); $i++) {
                            echo '<option value="' . $row_currency[$i]["curr_id"] . '">' . $row_currency[$i]["curr_name"] . ' ' . $row_currency[$i]["curr_desc"] . '</option>';
                        }
                        ?>
                    </select>
                <?php
                }
                if (isset($admin_edit) && $admin_edit == "yes") {
                ?>
                    <span class="query-title">Click on number to edit and <i class="fa fa-plus-circle" style="color:#484;"></i> to add price</span>
                <?php
                }
                ?>
                <?php
                if ($admin_edit == "yes") {
                ?>
                    <button class="btn btn-success manage-item-btn" type="button" data-toggle="modal" data-target="#adminManageItemPanelModal" onclick="return openManagePanel();">
                        <i class="fa fa-file-text-o"></i> Manage Item
                    </button>
                <?php
                }
                ?>
            </div>
            <div class="clearfix"></div>

            <div class="x_content">

                <div id="price_guide_content">

                </div>

            </div>

            <div class="x_content">
                <div class="clearfix" id="productExtraItemsMainBottom"></div> 
                <?php
                if ($admin_edit == "yes") {
                ?>
                    <button type="button" class="btn btn-success" title="New extra item" onclick="return newExtraItem();" data-toggle="modal" data-target="#adminNewExtraItemModal">
                        <i class="fa fa-plus"></i> New extra item
                    </button>

                    <button id="btn_copy_extra" type="button" class="btn btn-info" title="Copy all extra items" onclick="return copyExtraItem();">
                        <i class="fa fa-copy"></i> Copy extra items to
                    </button>

                    <button id="btn_copy_extra" type="button" class="btn btn-info" title="Copy & Replace extra items" onclick="return copyReplaceExtraItem();">
                        <i class="fa fa-copy"></i> Copy & Replace Extra items to
                    </button>

                    <button id="btn_copy_extra" type="button" class="btn btn-info" title="Manage Category" onclick="return manageExtraItems(<?= $prod_id ?>);">
                        <i class="fa fa-copy"></i> Manage Extra Items Category
                    </button>

                    <button id="btn_copy_extra" type="button" class="btn btn-info" title="Copy Category" onclick="return manageExtraItemsCategory(<?= $prod_id ?>);">
                        <i class="fa fa-copy"></i> Copy Extra Items Category
                    </button>
                <?php
                }
                ?>
                <div id="extra_price_content">

                </div>
            </div>

            <div class="x_content">
                <?php
                if ($admin_edit == "yes") {
                ?>
                    <button type="button" id="btn_edit_notes" class="btn btn-warning " title="Edit Notes" onclick="return editNotes();">
                        <i class="fa fa-pencil"></i> Edit Notes
                    </button>
                    <button type="button" id="btn_save_notes" class="btn btn-primary" title="Save Notes" onclick="return saveEditNotes(<?php echo $prod_id; ?>);" style="display:none;">
                        <i class="fa fa-floppy-o"></i> Save Notes
                    </button>
                    <button type="button" id="btn_cancel_edit_notes" class="btn btn-secondary" title="Cancel edit Notes" onclick="return cancelEditNotes();" style="display:none;">
                        Cancel
                    </button>
                <?php
                }
                ?>
                <table class="tbl_notes" style="width: 100%;">
                    <tr>
                        <th class="bg-blue-light">Notes</th>
                    </tr>
                    <tr id="tr_show_notes">
                        <td id="td_show_notes"></td>
                    </tr>
                    <tr id="tr_edit_notes" style="display: none;">
                        <td>
                            <textarea id="txtarea_edit_notes" style="width: 100%; height: 300px;"></textarea>
                            <input type="hidden" id="old_notes" value="<?php echo isset($row_notes["notes"]) ? $row_notes["notes"] : ""; ?>">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="focusingOnSection">
                <a href="#productItemsMainTop" class="productItemsMainTop d-none">Jump to  Products <i class="fa fa-arrow-up" aria-hidden="true"></i></a>   
                <a href="#productExtraItemsMainBottom" class="productExtraItemsMainBottom">Jump to Extra Items  <i class="fa fa-arrow-down" aria-hidden="true"></i> </a>   
            </div>
        </div>
    </div>

</div>

<style type="text/css">
    #tbl_manage_addi td {
        padding: 5px;
        vertical-align: top;
    }

    .dataTables_wrapper .dataTables_filter input {
        text-align: center;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        border: none;
        color: #FFF;
        font-size: 14px;
        padding: 10px 40px;
        width: auto;
    }

    .dataTable input {
        width: 100%;
        background: #EEE;
        border: 1px solid #337ab730;
        box-shadow: rgb(100 100 111 / 1%) 0px 7px 29px 0px;
        padding: 3px 10px;
    }

    .dataTable .btn-primary {
        color: #fff;
        background-color: #337ab7;
        border-color: #2e6da4;
        float: right;
        width: 20%;

    }

    .dataTables_paginate {
        margin: 6px 0;
    }

    div#cloneTable_filter {
        margin: 0 0 15px 0;
    }

    a.paginate_button.current {
        background: #FFF !important;
    }

    a.paginate_button:hover {
        color: #FFF !important;
    }

    #clone_submit select {
        margin: 0 !important;
    }

    #clone_submit .form-control {
        padding: 0 10px;
        height: 30px;
        font-size: 12px;
        text-align: left;
    }

    #clone_submit label {
        margin: 4px 0;
        font-size: 14px;

    }

    #manageAdditionalModal input {
        background: #337ab736;
        border: none;
        padding: 5px 10px;
        margin-bottom: 4px;
        border-radius: 4px;
    }

    .not-found-error b {
        background: #EA6153;
        padding: 10px;
        color: #FFF;
        border-radius: 17px;
        font-size: 11px;
        letter-spacing: 1px;
    }

    .custom-flex {
        display: flex;
        justify-content: space-between;
    }

    #addi_new_form .btn {
        margin: 19px auto 4px 0;
    }

    #manageExtraItemsModal .modal-dialog {
        width: 50%;
    }

    #manageExtraItemsModal .form-control {
        margin-bottom: 20px;
        padding: 5px 10px;
    }

    #manageExtraItemsModal .table-bordered {
        margin-top: 0;
    }
    #manageExtraItemsModal #ExtraItemsDiv thead { 
        top: 0; 
    }
    @media screen and (min-width:520px) {
        #GdriveModal .modal-dialog {
            width: 70% !important;
        }

    }

    @media screen and (max-width:520px) {
        .dataTable .btn-primary {
            width: 100%;
        }

        #addi_new_form .btn {
            margin: 10px auto;
            width: 100px;
        }

        .custom-flex {
            align-items: flex-start;
            flex-direction: column;
            overflow: hidden !important;
        }

        .custom-flex input {
            width: 200px !important;
            float: right;
        }

        .dataTable input {
            width: 200px;
        }

        div#cloneTable_filter label {
            display: flex;
            align-items: center;
            justify-content: left;
            flex-direction: row-reverse;
        }
    }
</style>
<!-- Manage Additional -->
<div class="modal fade" id="manageAdditionalModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="flex-header modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title">Manage Additional Items</h4>
            </div>
            <div class="modal-body" style="max-height: 500px;">
                <table id="tbl_manage_addi" style="width: 100%;">
                    <tr>
                        <td>Item:</td>
                        <td id="addi_show_item_name"></td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td id="addi_show_item_desc"></td>
                    </tr>
                    <tr>
                        <td>Currency:</td>
                        <td id="addi_show_curr_name"></td>
                    </tr>
                </table>
                <hr>

                <form id="addi_sort_form">

                </form>
            </div>
            <div class="modal-footer">
                <form id="addi_new_form" style="text-align: center;">
                    New item:
                    <input type="hidden" name="new_addi_item_id" id="new_addi_item_id">
                    <input type="hidden" name="new_addi_curr_id" id="new_addi_curr_id">
                    <input type="text" name="new_addi_name" id="new_addi_name" maxlength="150" style="width: 210px;">
                    Value: <input type="number" name="new_addi_value" id="new_addi_value" min="0" step="0.1" style="width: 70px;">
                    <button type="button" class="btn btn-success" onclick="return submitNewAddiV2();" style="padding: 2px 15px; margin-left: 10px; margin-top: 3px;"> Add </button>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewColor" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title" id="colour_header_user"></h4>
            </div>
            <div class="modal-body">
                <div class="container table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Color Name</th>
                                <th>Color Code</th>
                            </tr>
                        </thead>
                        <tbody id="customFieldsUser">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- focusingOnSection FOCUS  -->
<script>
    document.querySelectorAll('.focusingOnSection a').forEach(anchor => {

        anchor.addEventListener('click', function(e) {

            e.preventDefault(); // 🚀 stop instant jump

            const targetID = this.getAttribute('href');
            const targetElement = document.querySelector(targetID);

            if (!targetElement) return;

            const offset = 80; // adjust if you have sticky header

            const elementPosition = targetElement.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - offset;

            window.scrollTo({
                top: offsetPosition,
                behavior: "smooth" // ⭐ THIS is the animation
            });

        });

    });


</script>

<script>
    // Function to change the iframe source
    function changeIframeSource(src, item_id, gdrive_id) {
        document.getElementById("myIframe").src = src;
        $('#drive_link_id').val(gdrive_id);
        driver = gdrive_id;
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

    function openInNewTab() {
        var iframeSrc = document.getElementById("myIframe").src;
        window.open(iframeSrc, '_blank');
    }


    $(document).on('click', '#submit_comment', function(e) {
        e.preventDefault(); // Prevent the default form submission
        var form = $('#add_comment_drive')[0]; // Get the form element
        var formData = new FormData(form);
        var commentText = document.getElementById("commentText").value;
        var commentsDiv = document.getElementById("comments");

        if (commentText.trim() === "") {
            alert("Please enter a comment.");
            return;
        }

        $.ajax({
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/AddCommentDrive',
            success: function(response) {
                var response = JSON.parse(response);
                if (response.status == 1) {

                    // Create a new comment element and append it to the comments div
                    var commentElement = document.createElement("div");
                    commentElement.className = "alert alert-info";
                    commentElement.innerHTML = commentText;
                    //commentsDiv.appendChild(commentElement);
                    commentsDiv.insertBefore(commentElement, commentsDiv.firstChild);
                    $("#comments").scrollTop(0);

                    // Clear the comment box
                    document.getElementById("commentText").value = "";
                }
                // Handle the response as needed
            }
        });
    });

    $(document).on('click', '.openGdrive', function() {
        var driver = '';
        var item_id = $(this).attr('item_id');
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
                    }
                    $('#iframeLinks').empty();
                    $('#iframeLinks').append(html);
                    $('#drive_item_id').val(item_id);
                    $('#drive_link_id').val(response.data[0].gdrive_id)
                    $('#GdriveModal').modal('show');
                    document.getElementById("myIframe").src = response.data[0].gdrive_link;
                    driver = response.data[0].gdrive_id;
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
    })
</script>


<script type="text/javascript">
    showPriceGuide();
    showExtraV2();
    showNoteV2();

    function manageAddiV2(item_id) {


        var item_name = $('#sp_item_name' + item_id).html();
        var item_desc = $('#td_item_desc' + item_id).html();

        var curr_name = $('#select_curr_id option:selected').text();

        $('#addi_show_item_name').html(item_name);
        $('#addi_show_item_desc').html(item_desc);
        $('#addi_show_curr_name').html(curr_name);

        $('#new_addi_item_id').val(item_id);
        $('#new_addi_curr_id').val($('#select_curr_id').val());

        showAddiSortForm(item_id);

    }

    function showAddiSortForm(item_id) {
        var curr = $('#select_curr_id').val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/showAddiSortForm",
            data: {
                "item_id": item_id,
                "curr": curr
            },
            success: function(resp) {

                $('#addi_sort_form').html(resp);

                $('#inner_addi_sorting').sortable();
                $('#inner_addi_sorting').disableSelection();

            }
        });
    }

    function saveSortAddi() {

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/saveSortAddi",
            data: $('#addi_sort_form').serialize(),
            success: function(resp) {

                if (resp.result == "success") {
                    showAddiSortForm($('#new_addi_item_id').val());
                } else {
                    alert(resp.msg);
                }

            }
        });

    }
    $(document).ready(function() {

        $(document).on('change', '#sel1', function() {
            console.log('working');
            var value = $(this).val();
            var x = document.getElementById(value);
            x.scrollIntoView({
                behavior: 'instant',
                block: 'center'
            });
        })

        $(document).on('change', '#sel2', function() {
            var value = $(this).val();
            var x = document.getElementById(value);
            x.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        })

        // Your code here
    });

    function submitNewAddiV2() {

        if ($('#new_addi_name').val() == "") {
            alert("Please fill item name.");
            return false;
        }

        if ($('#new_addi_value').val() == "") {
            alert("Please fill value.");
            return false;
        }

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/submitNewAddiV2",
            data: $('#addi_new_form').serialize(),
            success: function(resp) {

                if (resp.result == "success") {
                    showAddiSortForm($('#new_addi_item_id').val());
                    $('#new_addi_name').val('');
                    $('#new_addi_value').val('');
                } else {
                    alert(resp.msg);
                }

            }
        });

    }

    function deleteAddiItemV2(addi_id) {

        if (confirm("Deleting confirm?")) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/deleteAddiV2",
                data: {
                    "addi_id": addi_id
                },
                success: function(resp) {

                    if (resp.result == "success") {
                        $('#tr_addi_row' + addi_id).remove();
                    } else {
                        alert(resp.msg);
                    }

                }
            });
        }

    }



    function downloadTo(dl_type) {

        $('#dl_type').val(dl_type);
        $('#dl_sale_type').val($('#select_sale_type_id').val());
        $('#dl_curr_id').val($('#select_curr_id').val());

        $('#download_form').attr("action", "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/exportTo");
        $('#download_form').submit();

    }

    $(document).ready(function() {
        // Initialize Select2
        $('#selector_gdrive').select2();
    });

    function downloadToAll(dl_type) {

        $('#dl_type').val(dl_type);
        $('#dl_sale_type').val($('#select_sale_type_id').val());
        $('#dl_curr_id').val($('#select_curr_id').val());

        $('#download_form').attr("action", "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/exportToAll");
        $('#download_form').submit();

    }

    function downloadToZip(dl_type) {

        $('#dl_type').val(dl_type);
        $('#dl_sale_type').val($('#select_sale_type_id').val());
        $('#dl_curr_id').val($('#select_curr_id').val());

        $('#download_form').attr("action", "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/exportToAllZip");
        $('#download_form').submit();

    }

    function selectSaleType(sat_id) {
        $('#select_sale_type_id').val(sat_id);

        $('.sale_type_tab').removeClass("sale_type_tab_active");
        $('#sp_sale_type' + sat_id).addClass("sale_type_tab_active");

        showPriceGuide();
    }

    function adminEditUpdateImage(item_id, image = "") {
        $('#img_item_id').val(item_id);
        if (image != "") {
            var img = "/upload/pattern/" + atob(image);
            $('#fabric_img_modal').attr('src', img);
            $('#fabric_img_modal').show();
        } else {
            $('#fabric_img_modal').attr('src', "");
            $('#fabric_img_modal').hide();
        }
    }

    function viewColour(item_id, item_name) {
        $('#colour_header_user').html(atob(item_name) + " " + "Available Colors");
        $.ajax({
            type: 'POST',
            data: {
                item_id: item_id
            },
            url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/fetchColorsUser',
            success: function(response) {
                var response = JSON.parse(response);
                if (response.status == 1) {
                    $('#customFieldsUser').empty();
                    $('#customFieldsUser').append(atob(response.data));
                } else {
                    $('#customFieldsUser').empty();
                }
            }
        })
    }

    function adminEditUpdateLinkNew(item_id) {
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
                    for (var i = 0; i < response.data.length; i++) {
                        html += '<div class="form-group">' +
                            '<label for="usr">G Drive Link:</label>' +
                            '<div class="input-group">' +
                            '<input type="text" id="linker_' + response.data[i].gdrive_id + '" class="form-control" value="' + response.data[i].gdrive_link + '">' +
                            '<span class="input-group-btn">' +
                            '<button type="button" item_id="' + response.data[i].item_id + '" link_id="' + response.data[i].gdrive_id + '" class="btn btn-danger remove-row-new">Remove</button>' +
                            '</span>' +
                            '<span class="input-group-btn"><button type="button" class="btn btn-primary update-row-new" item_id="' + response.data[i].item_id + '" link_id="' + response.data[i].gdrive_id + '">Update</button></span>' + // Add the "Update" button
                            '</div>' +
                            '</div>';
                        $('#dynamic_rows_new').empty();
                        $('#dynamic_rows_new').append(html);
                        $('#add-row-new').attr('item_id', item_id);
                    }
                } else {
                    $('#gdrive_link_text_new').val("");
                }
            }
        })
    }

    function adminEditUpdateLink(item_id) {
        $('#item_id_link').val(item_id);
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
                    for (var i = 0; i < response.data.length; i++) {
                        html += '<div class="form-group">' +
                            '<label for="usr">G Drive Link:</label>' +
                            '<div class="input-group">' +
                            '<input type="text" value="' + response.data[i].gdrive_link + '" class="form-control" name="gdrive_link[]">' +
                            '<span class="input-group-btn">' +
                            '<button type="button" class="btn btn-danger remove-row">Remove</button>' +
                            '</span>' +
                            '</div>' +
                            '</div>';
                        $('#dynamic_rows').empty();
                        $('#dynamic_rows').append(html);
                    }
                } else {
                    $('#gdrive_link_text').val("");
                }
            }
        })
    }

    function adminEditUpdateColour(item_id, item_name) {
        $('#colour_header').html(atob(item_name) + " " + "Available Colors");
        $('#col_item_id').val(item_id);
        $.ajax({
            type: 'POST',
            data: {
                item_id: item_id
            },
            url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/fetchColorsAdmin',
            success: function(response) {
                var response = JSON.parse(response);
                if (response.status == 1) {
                    $('#customFields').empty();
                    $('#customFields').append(atob(response.data));
                } else {
                    $('#customFields').empty();
                }
            }
        })
    }

    function showPriceGuide() {

        var sat_id = $('#select_sale_type_id').val();
        var curr_id = $('#select_curr_id').val();
        var prod_id = <?php echo $prod_id; ?>;

        $('#price_guide_content').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');

        $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/showInner/product/" + prod_id + "/type/" + sat_id + "/curr/" + curr_id<?php if (isset($admin_edit) && $admin_edit == "yes") {
                                                                                                                                                        echo '+"?ade=yes"';
                                                                                                                                                    } ?>,
            success: function(resp) {

                $('#price_guide_content').html(resp);

            }
        });

    }

    function showExtraV2(callback) {
        var curr_id = $('#select_curr_id').val();
        $('#extra_price_content').show();
        $('#extra_price_content').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/showExtra/prod/<?php echo $row_product[0]["prod_id"]; ?>/curr/" + curr_id<?php if (isset($admin_edit) && $admin_edit == "yes") {
                                                                                                                                                        echo '+"?ade=yes"';
                                                                                                                                                    } ?>,
            success: function(resp) {
                if (resp == "empty") {
                    $('#extra_price_content').hide();
                } else {
                    $('#extra_price_content').html(resp);
                }
                // Fire callback after content is rendered
                if (typeof callback === "function") callback();
            }
        });
    }

    function showNoteV2() {

        var curr_id = $('#select_curr_id').val();

        $('#td_show_notes').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');

        $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/showNote/prod/<?php echo $row_product[0]["prod_id"]; ?>/curr/" + curr_id<?php if (isset($admin_edit) && $admin_edit == "yes") {
                                                                                                                                                        echo '+"?ade=yes"';
                                                                                                                                                    } ?>,
            success: function(resp) {
                if (resp == "empty") {
                    $('#td_show_notes').html('<center>Empty!!</center>');
                    $('#txtarea_edit_notes').val('');
                    $('#old_notes').val('');
                } else {
                    $('#td_show_notes').html(resp);
                    resp = resp.replace(/<br \/>/g, "");

                    $('#txtarea_edit_notes').val(resp);
                    $('#old_notes').val(resp);
                }

            }
        });

    }

    function addExtraToCartV2(extra_id, value_id) {

        if ($('#qdoc_id_editing').val() == null) {

            //alert("extra_id="+extra_id+"\ncurrency="+currency);
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/addExtraToCart",
                data: {
                    "extra_id": extra_id,
                    "value_id": value_id
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
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/addExtraToQuotation",
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

    function addToCartV2(prg_id) {

        if ($('#qdoc_id_editing').val() == null) {

            $.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/addToCart",
                data: {
                    "prg_id": prg_id
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
            //alert("AAA="+qdoc_id);

            $.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/addToQuotation",
                data: {
                    "qdoc_id": qdoc_id,
                    "prg_id": prg_id
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

    function showCartV2(is_front = 0) {

        $('#select_carts_id').val(0);

        $('#is_front').val(is_front);

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/showCart",

            success: function(resp) {

                $('#cart_title').html("Cart");
                $('#build_quote').html('Create New Estimate').attr("disabled", false);

                $('#btn_add_all_to_cart').hide();
                $('#btn_exit_edit_mode').hide();
                $('#btn_save_edit_quote').hide();

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

                $(document).ready(function() {
                    // Enable sortable for both tables
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
                });

            }
        });

    }

    function selectAddiV2(row_id) {

        var uprice = parseFloat($('#uprice_' + row_id).val());
        var a_select = $('#select_addi_' + row_id).val();

        var tmp_price = "";
        for (var i = 0; i < a_select.length; i++) {

            tmp_price = a_select[i].split("|");

            uprice += parseFloat(tmp_price[1]);
        }

        $('#show_uprice_' + row_id).html(uprice);

        calPriceV2(row_id);

    }

    function calPriceV2(row_id, is_other = 0) {

        var show_uprice = 0.00;
        if (is_other == 1) {
            show_uprice = $('#uprice_' + row_id).val();
        } else {
            show_uprice = $('#show_uprice_' + row_id).html();
        }

        var qty = $('#qty_' + row_id).val();

        $('#amount_' + row_id).html(show_uprice * qty);

    }

    function deleteRowV2(row_id, is_other = 0, extra_id = 0) {
        if (confirm("Confirm delete row?")) {
            $('#tr_' + row_id).fadeOut(500).html('');
        }
    }

    function clearCartV2() {

        if (confirm("Do you want to clear the cart?")) {
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/clearCart",

                success: function(resp) {

                    $('#cart_inner').html('');
                    $('#sp_sum_total').html(0);
                    $('#cartV2Modal').modal("toggle");

                }
            });
        }

    }



    function saveCartDraftV2() {

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
            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/saveCart",
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

    function deleteSaveV2() {

        var carts_id = $('#select_carts_id').val();

        if (carts_id != "0") {

            if (confirm("Deleting draft. Confirm?")) {

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/deleteCartSave",
                    data: {
                        "carts_id": carts_id
                    },
                    success: function(resp) {

                        if (resp.result == "success") {

                            $("#select_carts_id option[value='" + carts_id + "']").remove();
                            showCartV2(1);

                        }

                    }
                });
            }

        }

    }

    function loadCartV2() {
        if ($('#select_carts_id').val() != "0") {
            $('#sp_show_loading').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>');

            var carts_id = $('#select_carts_id').val();

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/loadCart",
                data: {
                    "carts_id": carts_id
                },
                success: function(resp) {
                    if (resp.result == "success") {
                        $('#cart_title').html("Cart loaded");
                        $('#btn_add_all_to_cart').hide();
                        $('#btn_exit_edit_mode').hide();
                        $('#add_item_row').show();
                        $('#build_quote').show();
                        $('#sp_show_loading').html('');
                        $('#sp_currency').html(resp.currency);

                        // Fixed base64 decoding with UTF-8 support
                        var decodedHtml = decodeBase64UTF8(resp.form_inner);
                        $('#cart_inner').html(decodedHtml);

                        var tmp_html_id = resp.tmp_html_id.split(",");
                        for (var i = 0; i < tmp_html_id.length; i++) {
                            if (tmp_html_id[i].indexOf("other") < 0) {
                                calPriceV2(tmp_html_id[i]);
                            } else {
                                calPriceV2(tmp_html_id[i], 1);
                            }
                        }
                    }
                }
            });
        }
    }

    // Helper function for proper UTF-8 base64 decoding
    function decodeBase64UTF8(str) {
        // Convert Base64 encoded bytes to percent-encoding
        var bytes = atob(str);
        var percentEncodedStr = '';
        for (var i = 0; i < bytes.length; i++) {
            percentEncodedStr += '%' + ('00' + bytes.charCodeAt(i).toString(16)).slice(-2);
        }
        // Decode percent-encoding to get the original string
        return decodeURIComponent(percentEncodedStr);
    }

    // function loadCartV2() {

    //     if ($('#select_carts_id').val() != "0") {

    //         $('#sp_show_loading').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>');

    //         var carts_id = $('#select_carts_id').val();

    //         $.ajax({
    //             type: "POST",
    //             dataType: "json",
    //             url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/loadCart",
    //             data: {
    //                 "carts_id": carts_id
    //             },
    //             success: function(resp) {
    //                 //$('#cart_inner').html(resp);
    //                 if (resp.result == "success") {
    //                     //alert($('#select_carts_id').val());
    //                     $('#cart_title').html("Cart loaded");

    //                     $('#btn_add_all_to_cart').hide();
    //                     $('#btn_exit_edit_mode').hide();


    //                     $('#add_item_row').show();
    //                     $('#build_quote').show();


    //                     $('#sp_show_loading').html('');
    //                     $('#sp_currency').html(resp.currency);
    //                     $('#cart_inner').html(window.atob(resp.form_inner));

    //                     var tmp_html_id = resp.tmp_html_id.split(",");
    //                     for (var i = 0; i < tmp_html_id.length; i++) {
    //                         if (tmp_html_id[i].indexOf("other") < 0) {
    //                             calPriceV2(tmp_html_id[i]);
    //                         } else {
    //                             calPriceV2(tmp_html_id[i], 1);
    //                         }
    //                     }

    //                 }

    //             }
    //         });
    //     }
    // }
</script>
<?php
if (isset($admin_edit) && $admin_edit == "yes") {
?>
    <style type="text/css">
        .tbl_price_info th {
            text-align: right;
            padding: 5px;
        }

        .tbl_price_info td {
            text-align: left;
            padding: 5px;
        }

        .tbl_item_sorting {
            width: 100%;
        }

        .tbl_item_sorting td {
            padding: 5px;
            color: #000;
        }

        .d_item_sortable {
            border: 1px solid #558;
            background-color: #AAF;
            border-radius: 5px;
            margin: 2px;
            cursor: grab;
        }

        .d_item_sortable:active {
            cursor: grabbing;
        }

        /*--CSS style for item management zone--*/
        .manage_panel {
            display: none;
        }

        .footer_panel {
            display: none;
        }

        .footer_btn {
            display: none;
        }

        .header_panel button {
            margin: 0px 6px 5px 6px;
        }

        .header_panel button,
        select {
            padding: 3px 12px;
        }

        .header_panel label {
            font-size: 16px;
            font-weight: bold;
            color: #000;
        }

        .tbl_new_extra td {
            padding: 5px;
        }

        .tbl_new_extra td>input {
            width: 100%;
        }

        #adminManageItemPanelModal .modal-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header_panel button,
        select {
            margin: 5px 10px;
            padding: 7px 20px;
        }

        .modal.in table th {
            padding: 10px !important;
        }

        #adminEditUpdateColour .btn {
            margin: 10px 0;
        }

        #adminEditPriceModal input {
            width: 100%;
        }

        #adminEditUpdateLinkNew .input-group input {
            padding: 10px;
        }

        #adminEditUpdateLinkNew .input-group-btn>.btn {
            margin: 0 0 0 10px;
        }

        #adminEditUpdateLinkNew #add-row-new {
            display: flex;
            margin: 20px auto;
        }

        #adminEditUpdateLinkNew .modal-dialog {
            width: 50%;
        }

        #adminEditUpdateColour {}

        @media screen and (max-width:520px) {
            #adminEditUpdateLinkNew {
                padding: 0 !important;
            }

            #adminEditUpdateLinkNew .modal.in form {
                overflow: hidden !important;
            }

        }
    </style>
    <script>
        $(document).ready(function() {
            $(".addCF").click(function() {
                $("#customFields").append('<tr><td><textarea name="color_desc[]" style="width:100%;"></textarea></td><td><input type="text" name="color_name[]"> <span class="color-edit" style="float: right;clear: both;"></span></td><td><input type="text" name="color_code[]"></td><td><button class="btn btn-danger remCF">Delete</button></td></tr>');
            });
            $("#customFields").on('click', '.remCF', function() {
                $(this).parent().parent().remove();
            });
        });


        $(document).on('click', '.color_submit', function() {
            $('#color_form').submit();
        })

        $(document).on('click', '.update_link_btn', function() {
            $('#update_link').submit();
        })

        $(document).ready(function() {
            $('#update_link').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(form[0]);
                $.ajax({
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/linkUpdate",
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.status == 1) {
                            alert('Changes updated successfully!')
                            location.reload();
                        } else {
                            swal('Oops', 'Something Went Wrong', 'error');
                        }
                    }
                })

            })
        })

        $(document).ready(function() {
            $('#color_form').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(form[0]);
                $.ajax({
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/colorUpdate",
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.status == 1) {
                            alert('Changes updated successfully!')
                            $('#adminEditUpdateColour').modal('hide');
                        } else {
                            swal('Oops', 'Incorrect Dates ! Please check and try again', 'error');
                        }
                    }
                })

            })
        })
    </script>

    <div class="modal fade" id="adminEditUpdateLinkNew" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="flex-header modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 style="float: left;" class="modal-title">Update Link</h4>
                </div>
                <div class="modal-body">
                    <form id="">
                        <!-- Container for dynamic rows -->
                        <div id="dynamic_rows_new">

                        </div>

                        <!-- Button to add a new row -->
                        <button type="button" class="btn btn-primary" item_id="" id="add-row-new">Add Row</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="adminEditUpdateLink" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 style="float: left;" class="modal-title">Update Link</h4>
                </div>
                <div class="modal-body">
                    <form id="update_link">
                        <!-- Container for dynamic rows -->
                        <div id="dynamic_rows">
                            <!-- Initial row -->
                            <div class="form-group">
                                <label for="usr">G Drive Link:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="gdrive_link[]">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-danger remove-row">Remove</button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Button to add a new row -->
                        <button type="button" class="btn btn-primary" id="add-row">Add Row</button>

                        <!-- Hidden field for item_id if needed -->
                        <input type="hidden" name="item_id" id="item_id_link">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update_link_btn">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="adminEditUpdateColour" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="flex-header modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 style="float: left;" class="modal-title" id="colour_header"></h4>
                </div>
                <div class="modal-body">
                    <form id="color_form">
                        <input type="hidden" name="item_id" id="col_item_id">
                        <div class="container table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Color Name</th>
                                        <th>Color Code</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="customFields">

                                </tbody>
                            </table>
                            <div class="d-flex justify-content-between">
                                <span class="btn btn-success addCF">Add Row +</span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary color_submit">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="adminEditUpdateImage" tabindex="-1" role="dialog">
        <div class="modal-dialog" style="width:500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 style="float: left;" class="modal-title">Edit/Upload Image</h4>
                </div>
                <div class="modal-body" style="max-height: 500px;">
                    <form id="upload_fabric_img">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Upload Pattern/Fabric Image<span style="color:red;">(*Please upload image under 500kb Only)</span></label>
                            <input type="file" required name="fab_image" class="form-control" id="exampleInputEmail1" accept="image/png, image/gif, image/jpeg">
                            <input type="hidden" name="item_id" id="img_item_id">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <img src="" style="display:none;max-width:100%;max-height:100%;" id="fabric_img_modal">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Use for Edit & Add Price -->
    <div class="modal fade" id="adminEditPriceModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" style="width:500px;">
            <div class="modal-content">
                <div class="flex-header modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 style="float: left;" class="modal-title" id="edit_price_modal_title">Edit Price</h4>
                </div>
                <div class="modal-body" style="max-height: 500px;">
                    <form id="edit_price_form" onsubmit="">
                        <table class="tbl_price_info">
                            <tr>
                                <th style="width: 20%;">Sale Type:</th>
                                <td id="td_sale_type"></td>
                            </tr>
                            <tr>
                                <th>Currency:</th>
                                <td id="td_currency"></td>
                            </tr>
                            <tr>
                                <th>Product:</th>
                                <td id="td_item_name"></td>
                            </tr>
                            <tr>
                                <th>Title:</th>
                                <td id="td_col_title"></td>
                            </tr>
                            <tr>
                                <th>Commission:</th>
                                <td id="td_comm_value"></td>
                            </tr>
                            <tr>
                                <th>Price:</th>
                                <td>
                                    <input type="number" id="prg_price" min="0" step=".01">
                                    <input type="hidden" id="edit_prg_id">

                                    <input type="hidden" id="add_cell_id">
                                    <input type="hidden" id="add_item_id">
                                    <input type="hidden" id="add_curr_id">
                                    <input type="hidden" id="add_sat_id">
                                    <input type="hidden" id="add_comm_per_id">
                                </td>
                            </tr>
                        </table>

                    </form>
                </div>
                <div class="modal-footer">

                    <button style="float:right;" type="button" class="btn btn-success" id="btn_submit_edit_price" onclick="return adminSubmitEditPrice();">Submit</button>
                    <button style="float:right;" type="button" class="btn btn-danger" id="btn_delete_price" onclick="return adminDeletePrice();">Delete this price</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Use as Item Management panel -->
    <div class="modal fade" id="adminManageItemPanelModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="flex-header modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 style="float: left;" class="modal-title">Manage Items in: <b><?php echo $prod_name; ?></b></h4>
                </div>
                <div id="manage_item_modal_body" class="modal-body" style="max-height: 550px; overflow-y: scroll; min-height: 350px;">

                    <div class="header_panel container" id="header_panel">
                        <div class="row">
                            <div class="col-xl-8 col-md-8 text-center modal-head">
                                <label>Item: </label>
                                <button type="button" id="btn_new_item" class="btn_mitem btn btn-primary" onclick="return newProductItem();">New
                                </button>|<button type="button" id="btn_sorting_item" class="btn_mitem btn btn-info" onclick="return sortItemView();">Sorting
                                </button>or<button id="btn_list_item" type="button" class="btn_mitem btn btn-dark" onclick="return showItemList(); ">List
                                </button>in<select id="select_item_group" class="btn_mitem" onchange="return showItemList();">
                                    <option value="==all==">== All ==</option>

                                    <?php
                                    $have_group = "0";
                                    if (sizeof($a_item_group) > 0) {
                                        $have_group = "1";
                                    ?>

                                        <?php
                                        for ($i = 0; $i < sizeof($a_item_group); $i++) {
                                        ?>
                                            <option value="<?php echo $a_item_group[$i]["item_group_id"]; ?>"><?php echo $a_item_group[$i]["group_name"]; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <option value="==no_group==" <?php if ($have_group == "0") {
                                                                        echo "selected";
                                                                    } ?>>== No Group ==</option>
                                </select>


                                <input type="hidden" name="manage_item_prod_id" id="manage_item_prod_id" value="<?php echo $prod_id; ?>">
                                <input type="hidden" name="have_group" id="have_group" value="<?php echo $have_group; ?>">

                            </div>
                            <div class="col-xl-4 col-md-4 text-center">
                                <label>Group: </label>
                                <button id="btn_new_group" type="button" class="btn_mitem btn btn-primary" onclick="return newItemGroup();">New</button>
                                <button id="btn_sorting_group" type="button" class="btn_mitem btn btn-info" onclick="return sortItemGroupView();">Sorting</button>
                                <button id="btn_list_group" type="button" class="btn_mitem btn btn-dark" onclick="return showGroupList(); ">List</button>

                            </div>
                        </div>
                    </div>

                    <hr style="margin:10px 0px;">

                    <div class="manage_panel" id="zone_item_add">

                    </div>
                    <div class="manage_panel" id="zone_item_edit">

                    </div>
                    <!-- <div class="manage_panel" id="zone_group_add">
                    
                </div>
                <div class="manage_panel" id="zone_group_edit">
                    
                </div> -->
                    <div class="manage_panel" id="zone_item_show">

                    </div>
                    <div class="manage_panel" id="zone_group_show">

                    </div>
                    <div class="manage_panel" id="zone_item_sorting">

                    </div>
                    <div class="manage_panel" id="zone_group_sorting">

                    </div>

                </div>
                <div class="modal-footer footer_panel">
                    <div id="item_add_btn_zone" class="footer_btn">
                        <button type="button" id="btn_item_add_submit" class="btn btn-success" onclick="return submitNewItem();">Submit</button>
                        <button type="button" id="btn_item_add_cancel" class="btn btn-secondary" onclick="return showItemList();">Cancel</button>
                    </div>
                    <div id="item_edit_btn_zone" class="footer_btn">
                        <button type="button" id="btn_item_edit_submit" class="btn btn-success" onclick="return submitEditItem();">Submit</button>
                        <button type="button" id="btn_item_edit_cancel" class="btn btn-secondary" onclick="return cancelEditItem();">Cancel</button>
                    </div>
                    <div id="item_sorting_btn_zone" class="footer_btn">
                        <button type="button" id="btn_item_save_sort" class="btn btn-success" onclick="return saveItemSorting();">Save sorting</button>
                        <button type="button" id="btn_item_sort_cancel" class="btn btn-secondary" onclick="return showItemList();">Cancel</button>
                    </div>

                    <div id="group_sorting_btn_zone" class="footer_btn">
                        <button type="button" id="btn_group_save_sort" class="btn btn-success" onclick="return saveGroupSorting();">Save sorting</button>
                        <button type="button" id="btn_group_sort_cancel" class="btn btn-secondary" onclick="return showGroupList();">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- New extra item -->
    <div class="modal fade" id="adminNewExtraItemModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" style="width:500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 style="float: left;" class="modal-title" id="edit_price_modal_title">New extra item</h4>
                </div>
                <div class="modal-body" style="max-height: 500px;">
                    <form id="new_extra_form" onsubmit="">
                        <table class="tbl_new_extra" style="width: 100%;">
                            <tr>
                                <th style="width: 20%;">Product:</th>
                                <td id="td_show_prod"></td>
                            </tr>
                            <tr>
                                <th>Currency:</th>
                                <td id="td_show_curr"></td>
                            </tr>
                            <tr>
                                <th>Item name:</th>
                                <td><input type="text" id="new_extra_name" name="new_extra_name"></td>
                            </tr>
                            <tr>
                                <th>Description:</th>
                                <td><input type="text" id="new_extra_desc" name="new_extra_desc"></td>
                            </tr>
                            <tr>
                                <th> Item Category</th>
                                <td>
                                    <select name="new_extra_cat[]" id="new_extra_cat" style="width:100%;padding:5px;" multiple>
                                    
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>MSRP:</th>
                                <td><input type="number" id="new_extra_value" name="new_extra_value" min="0" step=".01"></td>
                            </tr>
                            <tr>
                                <th>QTY (15-99):</th>
                                <td><input type="number" id="new_extra_value_1" name="new_extra_value_1" min="0" step=".01"></td>
                            </tr>
                            <tr>
                                <th>QTY (100-299):</th>
                                <td><input type="number" id="new_extra_value_2" name="new_extra_value_2" min="0" step=".01"></td>
                            </tr>
                            <tr>
                                <th>QTY (300+):</th>
                                <td><input type="number" id="new_extra_value_3" name="new_extra_value_3" min="0" step=".01"></td>
                            </tr>

                        </table>
                        <input type="hidden" name="new_extra_prod_id" id="new_extra_prod_id" value="<?php echo $row_product[0]["prod_id"]; ?>">
                        <input type="hidden" name="new_extra_curr_id" id="new_extra_curr_id" value="">
                    </form>
                </div>
                <div class="modal-footer">

                    <button style="float:right;" type="button" class="btn btn-success" id="btn_submit_new_extra" onclick="return adminSubmitNewExtra();">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit extra item -->
    <div class="modal fade" id="adminEditExtraItemModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" style="width:500px;">
            <div class="modal-content">
                <div class="flex-header modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 style="float: left;" class="modal-title" id="edit_price_modal_title">Edit extra item</h4>
                </div>
                <div class="modal-body" style="max-height: 500px;">
                    <form id="edit_extra_form" onsubmit="">
                        <span id="sp_edit_loading" style="display:none;"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...</span>
                        <table class="tbl_new_extra" style="width: 100%;">
                            <tr>
                                <th style="width: 20%;">Product:</th>
                                <td id="td_show_edit_prod"></td>
                            </tr>
                            <tr>
                                <th>Currency:</th>
                                <td id="td_show_edit_curr"></td>
                            </tr>
                            <tr>
                                <th>Item name:</th>
                                <td><input type="text" id="edit_extra_name" name="edit_extra_name"></td>
                            </tr>
                            <tr>
                                <th> Item Category</th>
                                <td>
                                    <select name="edit_extra_cat[]" id="edit_extra_cat" style="width:100%;padding:5px;" multiple>                                    
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Description:</th>
                                <td><input type="text" id="edit_extra_desc" name="edit_extra_desc"></td>
                            </tr>
                            <tr>
                                <th>MSRP:</th>
                                <td><input type="number" id="edit_extra_value" name="edit_extra_value" min="0" step=".01"></td>
                            </tr>
                            <tr>
                                <th>QTY (15-99):</th>
                                <td><input type="number" id="edit_extra_value_1" name="edit_extra_value_1" min="0" step=".01"></td>
                            </tr>
                            <tr>
                                <th>QTY (100-299):</th>
                                <td><input type="number" id="edit_extra_value_2" name="edit_extra_value_2" min="0" step=".01"></td>
                            </tr>
                            <tr>
                                <th>QTY (300+):</th>
                                <td><input type="number" id="edit_extra_value_3" name="edit_extra_value_3" min="0" step=".01"></td>
                            </tr>
                        </table>
                        <input type="hidden" name="edit_extra_id" id="edit_extra_id" value="">
                    </form>
                </div>
                <div class="modal-footer">

                    <button style="float:right;" type="button" class="btn btn-success" id="btn_submit_edit_extra" onclick="return adminSubmitEditExtra();">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Copy extra items -->
    <div class="modal fade" id="adminCopyExtraItemModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" style="width:500px;">
            <div class="modal-content">
                <div class="flex-header modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 style="float: left;" class="modal-title" id="edit_price_modal_title">Copy extra items</h4>
                </div>
                <div class="modal-body" style="max-height: 500px;">
                    <form id="new_extra_form" onsubmit="">
                        <table class="tbl_new_extra" style="width: 100%;">
                            <tr>
                                <th style="width: 20%;">Product:</th>
                                <td id="td_show_copy_prod"></td>
                            </tr>
                            <tr>
                                <th>Copy to:</th>
                                <td>
                                    <select id="copy_to_prod_id">
                                        <?php
                                        for ($i = 0; $i < sizeof($a_row_product); $i++) {
                                            //if($a_row_product[$i]["prod_id"]!=$row_product[0]["prod_id"]){
                                        ?>
                                            <option value="<?php echo $a_row_product[$i]["prod_id"]; ?>"><?php echo $a_row_product[$i]["prod_name"]; ?></option>
                                        <?php
                                            //}
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Currency:</th>
                                <td id="td_show_copy_curr"></td>
                            </tr>
                            <tr id="sp_copy_change_curr" style="display: none;">
                                <td style="text-align: right;"><i class="fa fa-arrow-right"></i></td>
                                <td>
                                    <select id="copy_to_curr_id">
                                        <?php
                                        for ($i = 0; $i < sizeof($row_currency); $i++) {

                                        ?>
                                            <option value="<?php echo $row_currency[$i]["curr_id"]; ?>"><?php echo $row_currency[$i]["curr_name"] . " " . $row_currency[$i]["curr_desc"] . " (Ex.Rate:" . $row_currency[$i]["exchange_from_usd"] . ")"; ?></option>
                                        <?php

                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <input type="hidden" name="copy_extra_prod_id" id="copy_extra_prod_id" value="<?php echo $row_product[0]["prod_id"]; ?>">
                        <input type="hidden" name="copy_extra_curr_id" id="copy_extra_curr_id" value="">
                    </form>
                </div>
                <div class="modal-footer">

                    <button style="float:right;" type="button" class="btn btn-success" id="btn_submit_new_extra" onclick="return adminSubmitCopyExtra();">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Copy & Replace extra item -->
    <div class="modal fade" id="manageExtraItemsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="flex-header modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="">Extra Items Categories</h4>
                </div>
                <div class="modal-body" id="ExtraItemsDiv">

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="EditExtraItemsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="flex-header modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="">Edit Extra Items Categories</h4>
                </div>
                <div class="modal-body" id="EditExtraItemsDiv">

                    <form action="" method="post">
                        <input type="hidden" name="edit_extra_cat_id" id="edit_extra_cat_id" value="">                        
                        <div class="form-group  row">
                            <div class="col-sm-12">
                                <label for="edit_extra_cat_name" class="  col-form-label">Category Name</label> 
                                <input type="text" name="edit_extra_cat_name" id="edit_extra_cat_name" class="form-control">
                            </div>
                        </div>
                        
                    </form>

                </div>

                <div class="modal-footer">
                    <button style="float:right;" type="button" class="btn btn-success" id="btn_submit_edit_extra" onclick="return editCategory();">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Copy & Replace extra item -->
    <div class="modal fade" id="adminCopyReplaceExtraItemModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" style="width:50%;">
            <div class="modal-content">
                <div class="flex-header modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 style="float: left;" class="modal-title" id="edit_price_modal_title">Copy & Replace extra items</h4>
                </div>
                <div class="modal-body" style="max-height: 500px;">
                    <form id="new_copy_replace_extra_form_extra">
                        <table class="tbl_new_extra" style="width: 100%;">
                            <tr>
                                <th style="width: 20%;">Product:</th>
                                <td id="td_show_copy_replace_prod"></td>
                            </tr>
                            <tr>
                                <th>Extra Items (From Product):</th>
                                <td>
                                    <select id="chkveg" multiple="multiple" name="from_product[]">

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Currency:</th>
                                <td id="td_show_copy_replace_curr"></td>
                            </tr>
                            <tr id="sp_copy_replace_change_curr" style="display: none;">
                                <td style="text-align: right;"><i class="fa fa-arrow-right"></i></td>
                                <td>
                                    <select id="copy_replace_to_curr_id" name="curr_id">
                                        <?php
                                        for ($i = 0; $i < sizeof($row_currency); $i++) {

                                        ?>
                                            <option value="<?php echo $row_currency[$i]["curr_id"]; ?>"><?php echo $row_currency[$i]["curr_name"] . " " . $row_currency[$i]["curr_desc"] . " (Ex.Rate:" . $row_currency[$i]["exchange_from_usd"] . ")"; ?></option>
                                        <?php

                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Copy to:</th>
                                <td>
                                    <select id="copy_replace_to_prod_id" name="to_prod_id">
                                        <option value="" selected disabled>Select Product</option>
                                        <?php
                                        for ($i = 0; $i < sizeof($a_row_product); $i++) {
                                            //if($a_row_product[$i]["prod_id"]!=$row_product[0]["prod_id"]){
                                        ?>
                                            <option value="<?php echo $a_row_product[$i]["prod_id"]; ?>"><?php echo $a_row_product[$i]["prod_name"]; ?></option>
                                        <?php
                                            //}
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Extra Items(To Product):</th>
                                <td>
                                    <select id="extra_item_to_product" name="to_product[]" multiple>

                                    </select>
                                </td>
                            </tr>
                        </table>
                        <input type="hidden" name="copy_extra_prod_id" id="copy_replace_extra_prod_id" value="<?php echo $row_product[0]["prod_id"]; ?>">
                        <button style="float:right;" type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Copy extra items -->
    <div class="modal fade" id="adminCopyExtraItemCategoryModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" style="width:50%;">
            <div class="modal-content">
                <div class="flex-header modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 style="float: left;" class="modal-title">Copy Extra Items Category</h4>
                </div>
                <div class="modal-body" style="max-height: 500px;">
                    <form id="new_extra_form" onsubmit="">
                        <table class="tbl_new_extra" style="width: 100%;">
                            <tr>
                                <th style="width: 20%;">Product:</th>
                                <td id="td_show_copy_prod_cat"></td>
                            </tr>
                            <tr>
                                <th>Copy to:</th>
                                <td>
                                    <select id="copy_to_prod_id_cat">
                                        <?php
                                        for ($i = 0; $i < sizeof($a_row_product); $i++) {
                                            //if($a_row_product[$i]["prod_id"]!=$row_product[0]["prod_id"]){
                                        ?>
                                            <option value="<?php echo $a_row_product[$i]["prod_id"]; ?>"><?php echo $a_row_product[$i]["prod_name"]; ?></option>
                                        <?php
                                            //}
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Select Category:</th>
                                <td><select id="category_extra" multiple></select></td>
                            </tr>
                            <tr>
                                <th>Currency:</th>
                                <td id="td_show_copy_curr_cat"></td>
                            </tr>
                            <tr id="sp_copy_change_curr_cat" style="display: none;">
                                <td style="text-align: right;"><i class="fa fa-arrow-right"></i></td>
                                <td>
                                    <select id="copy_to_curr_id_cat">
                                        <?php
                                        for ($i = 0; $i < sizeof($row_currency); $i++) {

                                        ?>
                                            <option value="<?php echo $row_currency[$i]["curr_id"]; ?>"><?php echo $row_currency[$i]["curr_name"] . " " . $row_currency[$i]["curr_desc"] . " (Ex.Rate:" . $row_currency[$i]["exchange_from_usd"] . ")"; ?></option>
                                        <?php

                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Select Action:</th>
                                <td id="checkboxContainer">
                                    <label><input type="checkbox" checked name="action" value="copy"> Copy</label>
                                    <label><input type="checkbox" name="action" value="copy_replace"> Copy and Replace</label>
                                </td>
                            </tr>
                        </table>
                        <input type="hidden" name="copy_extra_prod_id_cat" id="copy_extra_prod_id_cat" value="<?php echo $row_product[0]["prod_id"]; ?>">
                        <input type="hidden" name="copy_extra_curr_id_cat" id="copy_extra_curr_id_cat" value="">
                    </form>
                </div>
                <div class="modal-footer">

                    <button style="float:right;" type="button" class="btn btn-success" id="btn_submit_new_extra" onclick="return adminSubmitCopyExtraCat();">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="clone_modal">
        <div class="modal-dialog modal-xl modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="flex-header modal-header">
                    <h4 class="modal-title" id="clone_heading"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="table-responsive" id="cloner">

                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="clone_item_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="flex-header modal-header">
                    <h4 class="modal-title" id="clone_item_heading"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="clone_submit">
                        <div class="form-group">
                            <label for="selected_item_cloned">Selected Item to be Cloned</label>
                            <input type="text" name="item_name" class="form-control" id="selected_item_cloned">
                            <input type="hidden" name="main_item_id" id="clone_main_item_id" value="">
                        </div>
                        <div class="form-group">
                            <label for="clone_to_product">Clone To Product</label>
                            <select class="form-control" name="prod_id" id="clone_to_product">
                                <option value="" selected disabled>--Select Product--</option>
                                <?php
                                $clone_sql = "SELECT * FROM tbl_product";
                                $cloner = Yii::app()->db->createCommand($clone_sql)->queryAll();
                                foreach ($cloner as $cls) {
                                ?>
                                    <option value="<?= $cls['prod_id'] ?>"><?= $cls['prod_name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="clone_to_group">Select Group</label>
                            <select class="form-control" name="group_id" id="clone_to_group">

                            </select>
                        </div>
                        <?php
                        $sql_sale_type = "SELECT * FROM tbl_sale_type";
                        $slq = Yii::app()->db->createCommand($sql_sale_type)->queryAll();
                        foreach ($slq as $sal_datas) {
                        ?>
                            <div class="form-check">
                                <input class="form-check-input" name="categories[]" type="checkbox" value="<?= $sal_datas['sat_id'] ?>" id="sat_id_<?= $sal_datas['sat_id'] ?>">
                                <label class="form-check-label" for="sat_id_<?= $sal_datas['sat_id'] ?>">
                                    <?= $sal_datas['sat_name'] ?>
                                </label>
                            </div>
                        <?php
                        }
                        ?>
                    </form>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>

                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="add_cost_calculator">
        <div class="modal-dialog modal-xl modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="flex-header modal-header">
                    <h4 class="modal-title" id="cost_add_heading"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="table-responsive" id="drafter">

                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="extra_cost_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="flex-header modal-header">
                    <h4 class="modal-title" id="extra_cost_heading"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="update_ctc">
                        <div class="form-group">
                            <label for="emailss">Input Cost to Company</label>
                            <input type="text" placeholder="Input Cost Here..." class="form-control" name="ctc" id="emailss">
                            <input type="hidden" name="extra_id" id="extra_id_doc">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script type="text/javascript">
        $(document).on('change', '#clone_to_product', function() {
            var prod_id = $(this).val();
            $.ajax({
                type: 'POST',
                data: {
                    prod_id: prod_id
                },
                url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/FetchGroup',
                success: function(response) {
                    var response = JSON.parse(response);
                    var html = '';
                    if (response.status == 1) {
                        for (var i = 0; i < response.data.length; i++) {
                            html += '<option value="' + response.data[i].item_group_id + '#&#' + response.data[i].group_name + '">' + response.data[i].group_name + '</option>';
                        }
                    } else {
                        html += '<option value="==no_group==">No Group Available</option>';
                    }
                    $('#clone_to_group').empty();
                    $('#clone_to_group').append(html);
                }
            })
        })

        $(document).on('click', '.clone_item', function() {
            var item_name = atob($(this).attr('item_name'));
            var item_id = $(this).attr('item_id');
            $('#clone_main_item_id').val(item_id);
            $('#clone_item_heading').html("<b>CLONE </b>" + item_name);
            $('#selected_item_cloned').val(item_name);
            $('#clone_item_modal').modal('show');
        })

        $(document).on('submit', '#clone_submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = new FormData(form[0]);
            $.ajax({
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/CloneSubmit',
                success: function(response) {
                    if (response == "success") {
                        alert('Item Cloned ! Please Refresh');
                        $('#clone_item_modal').modal('hide');
                    }
                }
            })
        })

        $(document).on('submit', '#update_ctc', function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = new FormData(form[0]);
            $.ajax({
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/UpdateCTC',
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status == 1) {
                        $('#extra_cost_modal').modal('hide');
                        showExtraV2();
                    } else {
                        alert('Something Went Wrong');
                    }
                }
            })
        })

        $(document).on('click', '.extra_cost_modal', function() {
            var extra_name = atob($(this).attr('extra_name'));
            var extra_id = $(this).attr('extra_id');
            var ctc = $(this).attr('ctc');
            $('#extra_cost_heading').html("COSTING FOR (" + extra_name + ")");
            $('#emailss').val(ctc);
            $('#extra_id_doc').val(extra_id);
            $('#extra_cost_modal').modal('show');
        })

        $(document).on('click', '.clone_it', function() {
            var calc_id = $(this).attr('calc_id');
            var item_id = $(this).attr('item_id');
            var draft_name = $('#draft_name_' + calc_id).val();
            if (draft_name.length == 0) {
                alert('Please Type Draft Name');
            } else {
                $.ajax({
                    type: 'POST',
                    data: {
                        calc_id: calc_id,
                        item_id: item_id,
                        draft_name: draft_name
                    },
                    url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/CloneCalc',
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.status == 1) {
                            alert('Cloned Successfully');
                            location.reload();
                        } else {
                            alert('Something Went Wrong');
                        }
                    }
                })
            }
        })

        $(document).on('click', '.clone_cost', function() {
            var item_id = $(this).attr('item_id');
            var item_name = atob($(this).attr('item_name'));
            $('#clone_heading').html("CLONE COSTING SHEET FOR (" + item_name + ")");
            $('#cloner').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');
            $.ajax({
                type: 'POST',
                data: {
                    item_id: item_id
                },
                url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/FetchCalcData',
                success: function(response) {
                    $('#cloner').empty();
                    $('#cloner').append(response);
                    $('#clone_modal').modal('show');
                }
            })
        })

        $(document).ready(function() {
            // Event handler for checkbox selection
            $('input[name="action"]').on('change', function() {
                // Uncheck the other checkbox
                $('input[name="action"]').not(this).prop('checked', false);
            });
        });

        $(document).on('click', '.delete_calc', function() {
            var calc_id = $(this).attr('calc_id');
            if (confirm('Are You Sure?')) {
                $.ajax({
                    type: 'POST',
                    data: {
                        calc_id: calc_id,
                    },
                    url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/DeleteCalc',
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.status == 1) {
                            alert('Deleted Successfully!');
                            $('#add_cost_calculator').modal('hide');
                            $('.open_calc_' + calc_id).hide();
                            // location.reload();
                        } else {
                            alert('Something Went Wrong');
                        }
                    }
                })
            }
        })

        $(document).on('submit', '#drafter3', function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = new FormData(form[0]);
            $.ajax({
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/EditCalc',
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status == 1) {
                        $('#add_cost_calculator').modal('hide');
                        alert('Calculations Added Successfully!');
                    } else {
                        alert('Something Went Wrong');
                    }
                }
            })
        })

        $(document).on('submit', '#drafter2', function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = new FormData(form[0]);
            let item_id = formData.get('item_id');
            let item_name = formData.get('item_name');
            let draft_name = formData.get('draft_name');
            $.ajax({
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/AddCalc',
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status == 1) {
                        var html = '';
                        html += '<br><button class="btn btn-success open_calc open_calc_' + response.calc_id + '" item_id="' + item_id + '" item_name="' + item_name + '" calc_id="' + response.calc_id + '">' + draft_name + '</button>';
                        $(html).insertAfter('.add_cost_' + item_id);
                        $('#add_cost_calculator').modal('hide');
                        alert('Calculations Added Successfully!');
                        //location.reload();
                    } else {
                        alert('Something Went Wrong');
                    }
                }
            })
        })

        $(document).on('submit', '#upload_fabric_img', function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = new FormData(form[0]);
            for (var p of formData) {
                let name = p[0];
                let value = p[1];
                if (name === "item_id") {
                    var item_id = value;
                }
            }
            $.ajax({
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/UploadFabricImage',
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status == 1) {
                        alert('Uploaded Successfully');
                        $('#fabric_img_' + item_id).empty();
                        var html = "";
                        html += '<img style="height:100px;" src="/upload/pattern/' + response.file_name + '">';
                        $('#fabric_img_' + item_id).append(html);
                        $('#adminEditUpdateImage').modal('hide');
                    } else {
                        alert("Something Went Wrong");
                    }
                }
            })

        })

        function viewExtraCat(prod_id, cat_ex_id, curr_id) {
            $.ajax({
                type: 'POST',
                data: {
                    prod_id: prod_id,
                    cat_ex_id: cat_ex_id,
                    curr_id: curr_id
                },
                url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/ViewCatExtraItems',
                success: function(response) {
                    $('#ExtraItemsDiv').empty();
                    $('#ExtraItemsDiv').html(response);
                }
            })
        }

        $(document).ready(function() {
            $(document).on('click', '.update-row-new', function() {
                var item_id = $(this).attr('item_id');
                var link_id = $(this).attr('link_id');
                var input = $('#linker_' + link_id).val();
                if (input.length > 0) {
                    $.ajax({
                        type: 'POST',
                        data: {
                            link_id: link_id,
                            input: input
                        },
                        url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/finalUpdateLink',
                        success: function(response) {
                            var response = JSON.parse(response);
                            if (response.status == 1) {
                                alert('URL Updated Successfully');
                            }
                        }
                    })
                } else {
                    alert('Please type the URL');
                }
            })

            $("#add-row-new").click(function() {
                var item_id = $(this).attr('item_id');
                $.ajax({
                    type: 'POST',
                    data: {
                        item_id: item_id
                    },
                    url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/createBlankLink',
                    success: function(response) {
                        var parsedResponse = JSON.parse(response);

                        if (parsedResponse.status == 1) {
                            var newRow = `
                                    <div class="form-group">
                                        <label for="usr">G Drive Link:</label>
                                        <div class="input-group">
                                            <input type="text" id="linker_${parsedResponse.link_id}" class="form-control" value="">
                                            <span class="input-group-btn">
                                                <button type="button" item_id="${item_id}" link_id="${parsedResponse.link_id}" class="btn btn-danger remove-row-new">Remove</button>
                                            </span>
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-primary update-row-new" item_id="${item_id}" link_id="${parsedResponse.link_id}">Update</button>
                                            </span>
                                        </div>
                                    </div>
                                `;
                            $("#dynamic_rows_new").append(newRow);
                        }

                    }
                })
            });

            // Add row
            $("#add-row").click(function() {
                var newRow = `
                    <div class="form-group">
                        <label for="usr">G Drive Link:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="gdrive_link[]">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-danger remove-row">Remove</button>
                            </span>
                        </div>
                    </div>
                `;
                $("#dynamic_rows").append(newRow);
            });


            // Remove row
            $("#dynamic_rows").on("click", ".remove-row", function() {
                if ($("#dynamic_rows .form-group").length === 1) {
                    alert('Last row can not be deleted');
                } else {
                    // More than one row, simply remove the row
                    $(this).closest(".form-group").remove();
                }
            });

            $("#dynamic_rows_new").on("click", ".remove-row-new", function() {
                if ($("#dynamic_rows_new .form-group").length === 1) {
                    // Only one row left, ask for confirmation
                    if (confirm("Are you sure you want to delete the last row?")) {
                        var itemID = $(this).attr('item_id'); // Get the item_id
                        var link_id = $(this).attr('link_id');
                        $.ajax({
                            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/removeDriveLinkUpdate", // Replace with your server-side endpoint
                            type: "POST",
                            data: {
                                item_id: itemID,
                                link_id: link_id
                            },
                            success: function(response) {
                                // Handle the AJAX response here
                                location.reload()
                            },
                            error: function() {
                                // Handle any errors
                                alert("Error deleting row via AJAX");
                            }
                        });
                        $(this).closest(".form-group").remove();
                    }
                } else {
                    if (confirm('Are you sure? It will delete all related comments too.')) {
                        var itemID = $(this).attr('item_id'); // Get the item_id
                        var link_id = $(this).attr('link_id');
                        $.ajax({
                            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/removeDriveLink", // Replace with your server-side endpoint
                            type: "POST",
                            data: {
                                item_id: itemID,
                                link_id: link_id
                            },
                            success: function(response) {
                                // Handle the AJAX response here

                            },
                            error: function() {
                                // Handle any errors
                                alert("Error deleting row via AJAX");
                            }
                        });
                        $(this).closest(".form-group").remove();
                    }
                }
            });
        });

        $(document).on('click', '#submitNewCategory', function() {
            var input = $('#newCategoryName').val();
            var prod_id = $(this).attr('prod_id');
            var curr_id = $(this).attr('curr_id');
            if (input.trim() === "") {
                alert("Category name can't be left blank");
            } else {
                $.ajax({
                    type: 'POST',
                    data: {
                        prod_id: prod_id,
                        cat_name: input,
                        curr_id: curr_id
                    },
                    url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/SubmitExtraItemCat',
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.status == 1) {
                            manageExtraItems(prod_id);
                        } else {
                            alert('Category name already exists for the same currency');
                        }
                    }
                })
            }
        })

        $(document).on('submit', '#new_copy_replace_extra_form_extra', function(e) {
            e.preventDefault();
            var prod_id = <?php echo $prod_id ?>;
            var curr_id = $('#select_curr_id').val();
            var form = $(this);
            var formData = new FormData(form[0]);
            formData.append('prod_id', prod_id);
            formData.append('from_curr_id', curr_id);
            $.ajax({
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/ReplaceCopyExtraSubmit',
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status == 1) {
                        alert('Copied Successfully');
                        location.reload();
                    } else {
                        alert("Cannot copy to the same product and currency.");
                    }
                }
            })
        })

        $(function() {

            //   $('#chkveg').multiselect({
            //     includeSelectAllOption: true
            //   });

            $('#btnget').click(function() {
                alert($('#chkveg').val());
            });
        });


        $(function() {

            $('#zone_group_sorting').sortable();
            $('#zone_group_sorting').disableSelection();

        });

        function openManagePanel() {

            $('.manage_panel').hide();
            $('.footer_panel').hide();
            $('.footer_btn').hide();

            showItemList();

        }

        function showItemList(item_id_focus = 0) {

            var prod_id = $('#manage_item_prod_id').val();
            var group_id = $('#select_item_group').val();
            var have_group = $('#have_group').val();


            $('.manage_panel').hide();
            $('.footer_panel').hide();

            $('#zone_item_show').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');
            $('#zone_item_show').show();

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/showItemList",
                data: {
                    "prod_id": prod_id,
                    "group_id": group_id,
                    "have_group": have_group
                },
                success: function(resp) {

                    if (resp.num_show_item == 0) {
                        $('#btn_sorting_item').attr("disabled", true);
                    } else {
                        $('#btn_sorting_item').attr("disabled", false);
                    }

                    $('#zone_item_show').html(resp.inner_content);
                    if (item_id_focus != 0) {
                        $('#zone_item_show').hide();
                        $('#zone_item_show').fadeIn(function() {

                            var scrollPos = $('#list_item' + item_id_focus).offset().top;
                            $('#manage_item_modal_body').scrollTop((scrollPos - 150));

                        });
                    }

                }
            });
        }

        function deleteProductItem(item_id) {

            if (confirm("Deleting confirm?")) {

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/deleteProductItem",
                    data: {
                        "item_id": item_id
                    },
                    success: function(resp) {

                        if (resp.result == "success") {

                            $('#list_item' + item_id).fadeOut(500);

                        } else {
                            alert(resp.msg);
                        }

                    }
                });

            }

        }

        function editProductItem(item_id) {

            $('.manage_panel').hide();

            $('#zone_item_edit').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');
            $('#zone_item_edit').show();

            $('.footer_btn').hide();
            $('.footer_panel').show();
            $('#item_edit_btn_zone').show();

            $.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/editProductItemForm",
                data: {
                    "item_id": item_id
                },
                success: function(resp) {

                    $('#zone_item_edit').html(resp);

                }
            });
        }

        function cancelEditItem() {

            var item_id = $('#edit_item_id').val();

            showItemList(item_id);

        }

        function submitEditItem() {

            var item_id = $('#edit_item_id').val();

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/editProductItemSubmit",
                data: $('#edit_prod_item_form').serialize(),
                success: function(resp) {

                    if (resp.result == "success") {

                        showItemList(item_id);

                    } else {
                        alert(resp.msg);
                    }
                }
            });

        }

        function sortItemView() {

            var group_id = $('#select_item_group').val();

            if (group_id == "==all==") {
                alert("Please select a group or ==No Group==");
                return false;
            }

            $('.manage_panel').hide();

            $('#zone_item_sorting').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');
            $('#zone_item_sorting').show();

            $('.footer_btn').hide();
            $('.footer_panel').show();
            $('#item_sorting_btn_zone').show();

            var prod_id = $('#manage_item_prod_id').val();

            $.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/sortingItemView",
                data: {
                    "prod_id": prod_id,
                    "group_id": group_id
                },
                success: function(resp) {

                    $('#zone_item_sorting').html(resp);
                    $('#inner_item_sorting').sortable();
                    $('#inner_item_sorting').disableSelection();
                }
            });

        }

        function saveItemSorting() {

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/sortingItemSubmit",
                data: $('#form_item_sorting').serialize(),
                success: function(resp) {

                    if (resp.result == "success") {

                        showItemList();

                    } else {
                        alert(resp.msg);
                    }
                }
            });

        }

        function newProductItem() {

            $('.manage_panel').hide();

            $('#zone_item_add').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');
            $('#zone_item_add').show();

            $('.footer_btn').hide();
            $('.footer_panel').show();
            $('#item_add_btn_zone').show();

            var prod_id = $('#manage_item_prod_id').val();

            $.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/newProductItemForm",
                data: {
                    "prod_id": prod_id
                },
                success: function(resp) {

                    $('#zone_item_add').html(resp);

                }
            });
        }

        function submitNewItem() {

            if ($('#new_item_name').val() == "") {
                alert("Please input item name.");
                return false;
            }

            /*new_item_detail
            new_item_style
            new_item_fabric_opt*/

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/newProductItemSubmit",
                data: $('#new_prod_item_form').serialize(),
                success: function(resp) {

                    if (resp.result == "success") {

                        var tmp_select_group = $('#new_item_group').val();
                        var a_group_id = tmp_select_group.split("#&#");

                        $('#select_item_group').val(a_group_id[0]);

                        showItemList();

                    } else {
                        alert(resp.msg);
                    }
                }
            });

        }

        function showGroupList() {

            var prod_id = $('#manage_item_prod_id').val();

            $('.manage_panel').hide();
            $('.footer_panel').hide();

            $('#zone_group_show').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');
            $('#zone_group_show').show();

            $.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/showGroupList",
                data: {
                    "prod_id": prod_id
                },
                success: function(resp) {

                    $('#zone_group_show').html(resp);

                }
            });

        }

        function editItemGroup(item_group_id) {

            var group_name = prompt("Group name:", $('#td_group_name' + item_group_id).html());

            if (group_name == null) {
                return false;
            } else if (group_name == "") {
                alert("Please input Group name");
                return false;
            } else {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/updateGroupName",
                    data: {
                        "item_group_id": item_group_id,
                        "group_name": window.btoa(group_name)
                    },
                    success: function(resp) {

                        if (resp.result == "success") {
                            $('#td_group_name' + item_group_id).html(group_name);
                        } else {
                            alert(resp.msg);
                        }

                    }
                });
            }

        }

        function newItemGroup() {

            var group_name = prompt("New Group name:", "");

            if (group_name == null) {
                return false;
            } else if (group_name == "") {
                alert("Please input Group name");
                return false;
            } else {

                var prod_id = $('#manage_item_prod_id').val();

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/newGroupName",
                    data: {
                        "prod_id": prod_id,
                        "group_name": window.btoa(group_name)
                    },
                    success: function(resp) {

                        if (resp.result == "success") {
                            /*if($('#have_group').val()=="0"){
                                window.location.reload();
                            }else{*/
                            $('#have_group').val("1");
                            $('#select_item_group').append('<option value="' + resp.item_group_id + '">' + group_name + '</option>');
                            showGroupList();

                            //}


                        } else {
                            alert(resp.msg);
                        }

                    }
                });
            }

        }

        function deleteItemGroup(item_group_id) {

            if (confirm("Deleting group confirm?")) {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/deleteItemGroup",
                    data: {
                        "item_group_id": item_group_id
                    },
                    success: function(resp) {

                        if (resp.result == "success") {
                            $('#list_group' + item_group_id).fadeOut(500);
                        } else {
                            alert(resp.msg);
                        }

                    }
                });
            }

        }

        function sortItemGroupView() {

            $('.manage_panel').hide();

            $('#zone_group_sorting').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');
            $('#zone_group_sorting').show();

            $('.footer_btn').hide();
            $('.footer_panel').show();
            $('#group_sorting_btn_zone').show();

            var prod_id = $('#manage_item_prod_id').val();

            $.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/sortingGroupView",
                data: {
                    "prod_id": prod_id
                },
                success: function(resp) {

                    $('#zone_group_sorting').html(resp);
                    $('#inner_group_sorting').sortable();
                    $('#inner_group_sorting').disableSelection();
                }
            });

        }

        function saveGroupSorting() {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/sortingGroupSubmit",
                data: $('#form_group_sorting').serialize(),
                success: function(resp) {

                    if (resp.result == "success") {

                        showGroupList();

                    } else {
                        alert(resp.msg);
                    }
                }
            });
        }

        function adminEditPrice(prg_id, item_id, curr_id, sat_id, comm_per_id) {

            $('#td_sale_type').html($('#sp_sale_type' + sat_id).html());
            $('#td_item_name').html($('#row_item_name' + item_id).html());
            var col_title = $('#col_title' + comm_per_id).html();
            $('#td_col_title').html(col_title.replace("<br>", " "));
            $('#td_comm_value').html($('#col_comm_percent' + comm_per_id).html());
            $('#td_currency').html($('#select_curr_id option:selected').text());

            $('#prg_price').val($('#prg_price' + prg_id).html());

            $('#edit_prg_id').val(prg_id);

            $('#add_cell_id').val(item_id + "00" + comm_per_id);
            $('#add_item_id').val(item_id);
            $('#add_curr_id').val(curr_id);
            $('#add_sat_id').val(sat_id);
            $('#add_comm_per_id').val(comm_per_id);

            $('#edit_price_modal_title').html("Edit Price");
            $('#edit_price_form').attr("onsubmit", "return adminSubmitEditPrice();");
            $('#btn_submit_edit_price').attr("onclick", "return adminSubmitEditPrice();");

            $('#btn_delete_price').show();

        }

        function adminSubmitEditPrice() {

            var prg_id = $('#edit_prg_id').val();
            var price = $('#prg_price').val();

            if (prg_id == "") {
                alert("Invalid parameter");
                return false;
            }

            if (price == "" || price == 0) {
                alert("Please input price");
                return false;
            }

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/adminSubmitEditPrice",
                data: {
                    "prg_id": prg_id,
                    "price": price
                },
                success: function(resp) {

                    if (resp.result == "success") {

                        $('#prg_price' + prg_id).html(parseFloat(price).toFixed(2));
                        $('#adminEditPriceModal').modal("toggle");
                        $('#prg_price' + prg_id).css("background-color", "#F99").css("font-weight", "bold");
                        setTimeout(function() {
                            $('#prg_price' + prg_id).css("background-color", "transparent").css("font-weight", "normal");
                        }, 3000);

                    } else {
                        alert(resp.msg);
                    }

                }
            });

            return false;

        }

        function adminAddPrice(cell_id, item_id, curr_id, sat_id, comm_per_id) {

            $('#td_sale_type').html($('#sp_sale_type' + sat_id).html());
            $('#td_item_name').html($('#row_item_name' + item_id).html());
            var col_title = $('#col_title' + comm_per_id).html();
            $('#td_col_title').html(col_title.replace("<br>", " "));
            $('#td_comm_value').html($('#col_comm_percent' + comm_per_id).html());
            $('#td_currency').html($('#select_curr_id option:selected').text());

            $('#prg_price').val('');

            $('#add_cell_id').val(cell_id);
            $('#add_item_id').val(item_id);
            $('#add_curr_id').val(curr_id);
            $('#add_sat_id').val(sat_id);
            $('#add_comm_per_id').val(comm_per_id);

            $('#edit_price_modal_title').html("Add Price");
            $('#edit_price_form').attr("onsubmit", "return adminSubmitAddPrice();");
            $('#btn_submit_edit_price').attr("onclick", "return adminSubmitAddPrice();");

            $('#btn_delete_price').hide();

        }

        function adminSubmitAddPrice() {

            var cell_id = $('#add_cell_id').val();
            var item_id = $('#add_item_id').val();
            var curr_id = $('#add_curr_id').val();
            var sat_id = $('#add_sat_id').val();
            var comm_per_id = $('#add_comm_per_id').val();

            if (cell_id == "" || item_id == "" || curr_id == "" || sat_id == "" || comm_per_id == "") {
                alert("Invalid parameter");
                return false;
            }

            var price = $('#prg_price').val();

            if (price == "" || price == 0) {
                alert("Please input price");
                return false;
            }

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/adminSubmitAddPrice",
                data: {
                    "item_id": item_id,
                    "curr_id": curr_id,
                    "sat_id": sat_id,
                    "comm_per_id": comm_per_id,
                    "price": price
                },
                success: function(resp) {

                    if (resp.result == "success") {

                        var prg_id = resp.prg_id;

                        $('#prg_price' + cell_id).removeClass("add_price").addClass("add-to-cart").html(parseFloat(price).toFixed(2));
                        $('#prg_price' + cell_id).attr("onclick", "return adminEditPrice(" + prg_id + "," + item_id + "," + curr_id + "," + sat_id + "," + comm_per_id + ");");
                        $('#prg_price' + cell_id).css("background-color", "#F99").css("font-weight", "bold");
                        $('#prg_price' + cell_id).attr("id", "prg_price" + prg_id);

                        $('#adminEditPriceModal').modal("toggle");

                        setTimeout(function() {
                            $('#prg_price' + prg_id).css("background-color", "transparent").css("font-weight", "normal");
                        }, 3000);

                    } else {
                        alert(resp.msg);
                    }

                }
            });

            return false;

        }

        function adminDeletePrice() {

            var prg_id = $('#edit_prg_id').val();
            if (prg_id == "") {
                alert("Invalid parameter");
                return false;
            }

            if (confirm("Confirm to delete this Price?")) {

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/adminDeletePrice",
                    data: {
                        "prg_id": prg_id
                    },
                    success: function(resp) {

                        if (resp.result == "success") {

                            var cell_id = $('#add_cell_id').val();
                            var item_id = $('#add_item_id').val();
                            var curr_id = $('#add_curr_id').val();
                            var sat_id = $('#add_sat_id').val();
                            var comm_per_id = $('#add_comm_per_id').val();

                            $('#prg_price' + prg_id).removeClass("add-to-cart").addClass("add_price").html('<i class="fa fa-plus-circle"></i>');
                            $('#prg_price' + prg_id).attr("onclick", "return adminAddPrice(" + cell_id + "," + item_id + "," + curr_id + "," + sat_id + "," + comm_per_id + ");");
                            $('#prg_price' + prg_id).css("background-color", "#F99");
                            $('#prg_price' + prg_id).attr("id", "prg_price" + cell_id);

                            $('#adminEditPriceModal').modal("toggle");

                            setTimeout(function() {
                                $('#prg_price' + cell_id).css("background-color", "transparent");
                            }, 3000);

                        } else {
                            alert(resp.msg);
                        }

                    }
                });
            }

            return false;

        }

        function newExtraItem() {

            $('#td_show_prod').html('<?php echo addslashes($row_product[0]["prod_name"]); ?>');
            $('#td_show_curr').html($('#select_curr_id option:selected').text());

            var curr_id = $('#select_curr_id option:selected').val();
            var prod_name = '<?php echo addslashes($row_product[0]["prod_id"]); ?>';
                            
            $.ajax({
                type: 'POST',
                data: {
                    prod_id: prod_name,
                    curr_id: curr_id
                },
                url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/fetchExtraCategory',
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status == 1) {
                        var html = '';
                        for (var i = 0; i < response.data.length; i++) {
                            html += '<option value="' + response.data[i].cat_ex_id + '">' + response.data[i].cat_ex_name + '</option>';
                        }
                        $('#new_extra_cat').empty();
                        $('#new_extra_cat').append(html);
                        $('#new_extra_cat').select2({
                            placeholder: "Select Item Category",
                            width: '100%'
                        });
                    }
                }
            })

            $('#new_extra_name').val("");
            $('#new_extra_desc').val("");
            $('#new_extra_value').val("");

        }

        function copyExtraItem() {

            if ($('#num_extra_item').val() == null) {
                alert("There are no extra items to copy");
            } else {

                var curr_now = $('#select_curr_id').val();

                if (curr_now == "1") {
                    $('#sp_copy_change_curr').show();
                } else {
                    $('#sp_copy_change_curr').hide();
                    $('#copy_to_curr_id').val(curr_now);
                }

                $('#adminCopyExtraItemModal').modal("toggle");

                $('#td_show_copy_prod').html('<?php echo addslashes($row_product[0]["prod_name"]); ?>');
                $('#td_show_copy_curr').html($('#select_curr_id option:selected').text());
            }

        }

        function manageExtraItemsCategory(prod_id) {

            if ($('#num_extra_item').val() == null) {
                alert("There are no extra items to copy");
            } else {

                var curr_now = $('#select_curr_id').val();

                if (curr_now == "1") {
                    $('#sp_copy_change_curr_cat').show();
                } else {
                    $('#sp_copy_change_curr_cat').hide();
                    $('#copy_to_curr_id_cat').val(curr_now);
                }
                $.ajax({
                    type: 'POST',
                    data: {
                        prod_id: prod_id,
                        curr_id: curr_now
                    },
                    url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/fetchExtraCategory',
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.status == 1) {
                            $('#td_show_copy_curr_cat').html($('#select_curr_id option:selected').text());
                            $('#td_show_copy_prod_cat').html('<?php echo addslashes($row_product[0]["prod_name"]); ?>');
                            var html = '';
                            for (var i = 0; i < response.data.length; i++) {
                                html += '<option value="' + response.data[i].cat_ex_id + '" namer="' + response.data[i].cat_ex_name + '">' + response.data[i].cat_ex_name + '</option>';
                            }
                            $('#category_extra').empty();
                            $('#category_extra').append(html);
                            $('#adminCopyExtraItemCategoryModal').modal('show');
                        } else {
                            alert('There are extra items category to copy');
                        }
                    }
                })
            }
        }

        function manageExtraItems(prod_id) {
            var curr_id = $('#select_curr_id').val();
            $.ajax({
                type: 'POST',
                data: {
                    prod_id: prod_id,
                    curr_id: curr_id
                },
                url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/ManageExtraItems',
                success: function(response) {
                    $('#ExtraItemsDiv').html(response);
                    $('#manageExtraItemsModal').modal('show');
                    
                }
            })
        }
        function EditExCategort(cat_ex_id) {    
            $('#manageExtraItemsModal').modal('hide');        
            $.ajax({
                type: 'POST',
                data: {
                    cat_ex_id: cat_ex_id                    
                },
                url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/EditExtraItems',
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status == 1) {
                        $('#edit_extra_cat_name').val(response.data[0].cat_ex_name);
                        $('#edit_extra_cat_id').val(response.data[0].cat_ex_id);

                    }
                    // $('#EditExtraItemsDiv').html(response);
                    $('#EditExtraItemsModal').modal('show');
                    
                }
            })
        }

        

        function copyReplaceExtraItem() {

            if ($('#num_extra_item').val() == null) {
                alert("There are no extra items to copy");
            } else {

                var curr_now = $('#select_curr_id').val();

                if (curr_now == "1") {
                    $('#sp_copy_replace_change_curr').show();
                } else {
                    $('#sp_copy_replace_change_curr').hide();
                    $('#copy_replace_to_curr_id').val(curr_now);
                }

                var prod_id = <?php echo addslashes($row_product[0]["prod_id"]); ?>;
                $.ajax({
                    type: 'POST',
                    data: {
                        prod_id: prod_id,
                        curr_now: curr_now
                    },
                    url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/FetchExtraItems',
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.status == 1) {
                            var html = '';
                            for (var i = 0; i < response.data.length; i++) {
                                html += '<option value="' + response.data[i].extra_id + '" selected>' + response.data[i].extra_name + '</option>';
                            }
                            $('#chkveg').empty();
                            $('#chkveg').append(html);
                            // $('#chkveg').multiselect({
                            //     includeSelectAllOption: true
                            //   });
                            $('#adminCopyReplaceExtraItemModal').modal("toggle");
                            $('#td_show_copy_replace_prod').html('<?php echo addslashes($row_product[0]["prod_name"]); ?>');
                            $('#td_show_copy_replace_curr').html($('#select_curr_id option:selected').text());
                        } else {
                            alert('No Extra Items');
                        }
                    }
                })
            }

        }

        $(document).on('change', '#copy_replace_to_curr_id', function() {
            $("#copy_replace_to_prod_id").val("").change();
            $('#extra_item_to_product').empty();
        })

        $(document).on('change', '#copy_replace_to_prod_id', function() {
            var prod_id = $(this).val();
            var curr_now = $('#copy_replace_to_curr_id').val();
            $.ajax({
                type: 'POST',
                data: {
                    prod_id: prod_id,
                    curr_now: curr_now
                },
                url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/FetchExtraItems',
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status == 1) {
                        var html = '';
                        for (var i = 0; i < response.data.length; i++) {
                            html += '<option value="' + response.data[i].extra_id + '" selected>' + response.data[i].extra_name + '</option>';
                        }
                    }
                    $('#extra_item_to_product').empty();
                    $('#extra_item_to_product').append(html);
                }
            })
        })

        function adminSubmitCopyExtraCat() {
            var from_prod_id = $('#copy_extra_prod_id_cat').val();
            var to_prod_id = $('#copy_to_prod_id_cat').val();
            var from_curr_id = $('#select_curr_id').val();
            var to_curr_id = $('#copy_to_curr_id_cat').val();

            if ((from_prod_id == to_prod_id) && (from_curr_id == to_curr_id)) {
                alert("Cannot copy to the same product and currency.");
                return false;
            }

            var selectedData = [];

            // Get an array of selected options
            var selectedOptions = $('#category_extra').find('option:selected');

            // Loop through each selected option
            selectedOptions.each(function() {
                // Get the value and custom attribute 'namer'
                var value = $(this).val();
                var namer = $(this).attr('namer');

                // Push an object with value and namer to the array
                selectedData.push({
                    value: value,
                    namer: namer
                });
            });

            if (selectedData.length === 0) {
                alert('Please select at least one option.');
                return; // Stop the function
            }

            var selectedCheckboxValue = $('input[name="action"]:checked').val();

            $.ajax({
                url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/copyExtraSubmitCat',
                type: 'POST',
                data: {
                    selectedData: JSON.stringify(selectedData),
                    from_prod_id: from_prod_id,
                    to_prod_id: to_prod_id,
                    from_curr_id: from_curr_id,
                    to_curr_id: to_curr_id,
                    action: selectedCheckboxValue
                },
                success: function(response) {
                    // Handle the response from the server
                    var response = JSON.parse(response);
                    if (response.status == 1) {
                        alert('Successfully Copied!');
                        $('#adminCopyExtraItemCategoryModal').modal('hide');
                    }
                },
                error: function(error) {
                    // Handle errors
                    console.error(error);
                }
            });
        }

        function adminSubmitCopyExtra() {

            var from_prod_id = '<?php echo addslashes($row_product[0]["prod_id"]); ?>';
            var to_prod_id = $('#copy_to_prod_id').val();
            var from_curr_id = $('#select_curr_id').val();
            var to_curr_id = $('#copy_to_curr_id').val();

            if ((from_prod_id == to_prod_id) && (from_curr_id == to_curr_id)) {
                alert("Cannot copy to the same product and currency.");
                return false;
            }

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/copyExtraSubmit",
                data: {
                    "from_prod_id": from_prod_id,
                    "to_prod_id": to_prod_id,
                    "from_curr_id": from_curr_id,
                    "to_curr_id": to_curr_id
                },
                success: function(resp) {

                    if (resp.result == "success") {

                        alert("Copy successful!");
                        $('#adminCopyExtraItemModal').modal("toggle");

                    } else {
                        alert("Copy failure!");
                    }
                }
            });

            //alert("["+from_prod_id+" to "+to_prod_id+"] curr="+from_curr_id+" to "+to_curr_id);

        }
        function editCategory() {

            
            var edit_extra_cat_id = $('#edit_extra_cat_id').val();
            var edit_extra_cat_name = $('#edit_extra_cat_name').val();
            if (edit_extra_cat_name == "") {
                alert("Please input category name.");
                return false;
            }
           

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/EditSubexCategory",
                data: {
                    "edit_extra_cat_id": edit_extra_cat_id,
                    "edit_extra_cat_name": edit_extra_cat_name
                },
                success: function(resp) {                    

                    manageExtraItems('<?php echo addslashes($row_product[0]["prod_id"]); ?>');
                    $('#EditExtraItemsModal').modal('hide');
                }
            });

            //alert("["+from_prod_id+" to "+to_prod_id+"] curr="+from_curr_id+" to "+to_curr_id);

        }

        function adminSubmitNewExtra() {

            if ($('#new_extra_name').val() == "" || $('#new_extra_desc').val() == "" || $('#new_extra_value').val() == "") {
                alert("Please fill all input.");
                return false;
            }

            $('#new_extra_curr_id').val($('#select_curr_id').val());

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/newExtraSubmit",
                data: $('#new_extra_form').serialize(),
                success: function(resp) {

                    if (resp.result == "success") {

                        $('#adminNewExtraItemModal').modal("toggle");
                        showExtraV2();
                        location.reload();

                    } else {
                        alert(resp.msg);
                    }
                }
            });

        }

        function editExtraItem(extra_id) {            
            $('#sp_edit_loading').show();
            $('#td_show_edit_prod').html('<?php echo addslashes($row_product[0]["prod_name"]); ?>');
            $('#td_show_edit_curr').html($('#select_curr_id option:selected').text());

            var curr_id = $('#select_curr_id option:selected').val();
            var prod_name = '<?php echo addslashes($row_product[0]["prod_id"]); ?>';

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/editExtraItem",
                data: {
                    "extra_id": extra_id,
                    "prod_id": prod_name,
                    "curr_id": curr_id
                },
                success: function(resp) {

                    if (resp.result == "success") {

                        $('#edit_extra_id').val(resp.extra_id);
                        $('#edit_extra_name').val(resp.extra_name);
                        $('#edit_extra_desc').val(resp.extra_desc);
                        $('#edit_extra_value').val(resp.extra_value);
                        $('#edit_extra_value_1').val(resp.extra_value_1);
                        $('#edit_extra_value_2').val(resp.extra_value_2);
                        $('#edit_extra_value_3').val(resp.extra_value_3);

                        $('#edit_extra_cat').html('');
                        $('#edit_extra_cat').append(resp.ext_cat);

                        $('#sp_edit_loading').hide();

                        $('#edit_extra_cat').select2({
                            placeholder: "Select Item Category",
                            width: '100%'
                        });

                    } else {
                        alert(resp.msg);
                    }
                }
            });

        }

        function adminSubmitEditExtra() {
    if ($('#edit_extra_id').val() == "") {
        alert("Error loading info.");
        return false;
    }
    if ($('#edit_extra_name').val() == "" || $('#edit_extra_desc').val() == "" || $('#edit_extra_value').val() == "") {
        alert("Please fill all input.");
        return false;
    }
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/editExtraSubmit",
        data: $('#edit_extra_form').serialize(),
        success: function(resp) {
            if (resp.result == "success") {
                const data = resp.data;
                const extraId = data.extra_id; // capture before DOM wipe

                const row = $(`#row_${extraId}`);
                row.find(`#extra_name${extraId}`).text(data.extra_name);
                row.find('td').eq(1).html(data.extra_desc);
                row.find('td').eq(2).text(data.extra_value === "0.00" ? "-" : data.extra_value);
                row.find('td').eq(3).text(data.extra_value_1 === "0.00" ? "-" : data.extra_value_1);
                row.find('td').eq(4).text(data.extra_value_2 === "0.00" ? "-" : data.extra_value_2);
                row.find('td').eq(5).text(data.extra_value_3 === "0.00" ? "-" : data.extra_value_3);

                $('#adminEditExtraItemModal').modal("toggle");

                showExtraV2(function() {
                    const editedRow = document.getElementById(`row_${extraId}`);
                    if (editedRow) {
                        // scrollIntoView works regardless of which container is scrollable
                        editedRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        // highlight flash
                        $(editedRow).css('background-color', '#fff3cd');
                        setTimeout(() => $(editedRow).css('background-color', ''), 1500);
                    }
                });

            } else {
                alert(resp.msg);
            }
        }
    });
}

        function deleteExtraItem(extra_id) {

            if (confirm("Deleting confirm?")) {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/deleteExtra",
                    data: {
                        "extra_id": extra_id
                    },
                    success: function(resp) {

                        if (resp.result == "success") {

                            showExtraV2();

                        } else {
                            alert(resp.msg);
                        }
                    }
                });
            }

        }

        function editNotes() {

            $('#tr_show_notes').hide();
            $('#tr_edit_notes').show();

            $('#btn_edit_notes').hide();
            $('#btn_save_notes').show();
            $('#btn_cancel_edit_notes').show();

        }

        function cancelEditNotes() {

            $('#txtarea_edit_notes').val($('#old_notes').val());

            $('#tr_show_notes').show();
            $('#tr_edit_notes').hide();

            $('#btn_edit_notes').show();
            $('#btn_save_notes').hide();
            $('#btn_cancel_edit_notes').hide();

        }

        function saveEditNotes(prod_id) {

            var notes = window.btoa($('#txtarea_edit_notes').val());
            var curr_id = $('#select_curr_id').val();

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/saveEditNotes",
                data: {
                    "prod_id": prod_id,
                    "curr_id": curr_id,
                    "notes": notes
                },
                success: function(resp) {

                    if (resp.result == "success") {

                        var show_notes = window.atob(resp.show_notes);
                        var old_notes = $('#txtarea_edit_notes').val();

                        $('#txtarea_edit_notes').val(old_notes);
                        $('#old_notes').val(old_notes);

                        $('#td_show_notes').html(show_notes);

                        $('#tr_show_notes').show();
                        $('#tr_edit_notes').hide();

                        $('#btn_edit_notes').show();
                        $('#btn_save_notes').hide();
                        $('#btn_cancel_edit_notes').hide();

                    } else {
                        alert(resp.msg);
                    }
                }
            });

        }

        $(document).on('click', '.open_calc', function() {
            var calc_id = $(this).attr('calc_id');
            var item_id = $(this).attr('item_id');
            var item_name = atob($(this).attr('item_name'));
            $('#cost_add_heading').html("COSTING SHEET (" + item_name + ")");
            $('#drafter').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');
            $.ajax({
                type: 'POST',
                data: {
                    item_id: item_id,
                    calc_id: calc_id,
                    item_name: item_name
                },
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/EditCostCalc",
                success: function(response) {
                    $('#drafter').empty();
                    $('#drafter').append(response);
                }
            })
            $('#add_cost_calculator').modal('show');
        })

        $(document).on('click', '.delete-button', function() {
            var cat_ex_id = $(this).attr('data-id');
            var prod_id = $(this).attr('prod_id');
            if (confirm('Do you really want to delete ?')) {
                $.ajax({
                    type: 'POST',
                    data: {
                        cat_ex_id: cat_ex_id
                    },
                    url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/DeleteExtraCat',
                    success: function(response) {
                        if (response == 1) {
                            manageExtraItems(prod_id);
                        }
                    }
                })
            }
        })

        $(document).on('click', '.add_cost', function() {
            var item_id = $(this).attr('item_id');
            var item_name = atob($(this).attr('item_name'));
            $('#cost_add_heading').html("COSTING SHEET (" + item_name + ")");
            $('#drafter').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');
            $.ajax({
                type: 'POST',
                data: {
                    item_id: item_id,
                    item_name: item_name
                },
                url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/AddCostCalc",
                success: function(response) {
                    $('#drafter').empty();
                    $('#drafter').append(response);
                }
            })
            $('#add_cost_calculator').modal('show');
        })
    </script>
<?php
} //---End admin zone
?>