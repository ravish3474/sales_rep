<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<style>
    .encircle {
        border: 1px solid #00000073;
        border-radius: 10px;
        padding: 2px 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 500;
        margin: 4px 0 0 0;
    }

    .inline-form {
        display: flex;
    }

    .inline-form .form-group {
        margin-right: 10px;
    }

    .split_table {
        border: 1px solid black;
        width: 100%;
    }

    #ajax-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.7);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #loader-content {
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    }

    #fixed-btn {
        position: absolute;
        right: 0;
        /* Adjust the right position as needed */
        top: 0;
        /* Adjust the top position as needed */
        transition: position 0.3s ease-in-out;
        /* Add a transition effect for smooth change */
    }

    #fixed-btn.fixed {
        position: fixed;
    }

    .results-container {
        flex-grow: 1;
        max-height: 150px;
        /* Set a maximum height for the results container */
        overflow-y: auto;
        /* Add a scrollbar when content exceeds the maximum height */
        background-color: white;
        border: 1px solid #ccc;
        border-top: none;
    }

    #searchResults .search-result {
        padding: 5px;
        cursor: pointer;
    }

    #searchResults .search-result:hover {
        background-color: #f5f5f5;
    }


    .quote_table th {
        background-color: #5c656d;
        color: white;
        white-space: nowrap;
    }

    .quote_table table {
        white-space: nowrap;
        border: 1px solid #848d94;
    }

    .btn_edit_inv {
        float: right;
        font-size: 18px;
        cursor: pointer;
    }

    .dropdown-menu {
        min-width: inherit;
        /* max-width: -webkit-fill-available; */
    }

    #conv_note_final {
        word-wrap: break-word;
    }

    footer {
        height: auto;
    }

    .form-inline select {
        padding: 3px 10px;
        background: #337ab714;
        border: 1px solid #337ab74d;
        box-shadow: rgb(0 0 0 / 3%) 0px 3px 8px;
        border-radius: 2px;
        margin: 0px 0;
        font-size: 12px;
        width: 150px;
    }



    .grid-form {
        display: grid;
        grid-template-columns: auto auto auto auto;
    }

    .search-month-year .dflex {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        flex-direction: column;
    }

    .search-month-year .form-inline .btn-outline-success {
        margin: 0;
        background: #5CB85C;
        color: #FFF;
        width: 115px;
    }

    .card-title {
        font-size: 15px;
        padding: 0 0;
        color: #337AB7;
    }

    .upload-report .form-group {
        margin-bottom: 10px;
    }

    .form-inline .form-control {
        margin-right: 5px;
    }

    label {
        font-size: 12px;
    }

    .dt-buttons .buttons-copy {
        background: #0F62FE;
    }

    .dt-buttons .buttons-csv {
        background: #EA6153;
    }

    .dt-buttons .buttons-excel {
        background: #107C41;
    }

    .dt-buttons .buttons-print {
        background: #007C89;
    }


    #quote_table button.btn {
        padding: 2px 10px !important;
        margin: 2px 0 0 0 !important;
        font-size: 12px !important;
        width: auto !important;
    }

    button.dt-button,
    div.dt-button,
    a.dt-button,
    input.dt-button {
        color: #FFF;
    }

    .dataTables_wrapper .dataTables_filter input {
        background: #E6EFF6;
        height: 30px;
    }

    .panel-body {
        padding: 5px;
    }

    .panel-body p {
        margin: 0;
    }

    .panel {
        margin-bottom: 2px;
    }

    table.dataTable tbody th,
    table.dataTable tbody td {
        padding: 5px 5px;
    }

    .table>tbody>tr>td,
    .table>tbody>tr>th,
    .table>tfoot>tr>td,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>thead>tr>th {
        vertical-align: middle !important;
    }

    th.sorting {
        font-size: 12px;
        padding-right: 20px;
    }

    button.btn.btn-primary.Go-btn {
        position: absolute;
        bottom: 0;
        right: 0;
    }

    .topHead {
        display: grid;
        grid-template-columns: auto auto;
    }

    /* 2-April-2024 */
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

    .flex-header .modal-title {
        font-size: 17px;
    }

    .default-Modal select#edit_reqby_user_id {
        padding: 5px;
    }



    #quoteDocModal .modal-dialog #app_quote select {
        padding: 5px;

    }

    #freebModal .modal-dialog {
        width: 60% !important;
    }

    #freebModal .form-control {
        padding: 7px;
    }

    #adminCommentModal .modal-dialog {
        width: 60% !important;
    }

    #wave_modal .modal-dialog {
        width: 60% !important;
    }

    #rollbackModal .modal-dialog {
        width: 60% !important;
    }

    #rollbackModal .form-control {
        padding: 5px;
    }

    .grid3 {
        display: grid;
        gap: 1rem;
        grid-template-columns: 1fr 1fr 1fr;
    }

    .grid3 .form-control {
        padding: 5px;
    }

    .Additional-details-div {
        float: unset;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #337AB7 !important;
        color: #FFF !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #337ab7db !important;
        color: #FFF !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        color: #337AB7 !important;

    }

    .panel-body {
        position: relative;
    }

    .panel-body .editIcon {
        cursor: pointer;
        color: #337AB7;
        float: right;
        margin-top: 0px;
        font-size: 19px;
    }

    .panel-body .converToquote {
        background: #E7F1F5;
    }

    .panel-body .converToquote label {
        color: #848484;
    }

    .panel-body .converToquote input {
        margin-left: 6px;
    }

    .panel-body .converToquote h6 {
        color: #337AB7;
        font-weight: 600;
        border-bottom: 1px solid #55555530;
        border-top: 1px solid #55555530;
        text-transform: capitalize;
        padding: 5px;
    }

    .panel-body .converToquote {
        display: none;
        animation: fadeIn 0.5s ease forwards;
    }


    .onlineStoreBtn {
        background: rgb(229, 112, 46);
        border: 1px solid rgba(255, 150, 90, 1);
        border-radius: 4px;
        color: #FFF;
        font-size: 13px;
        font-weight: 500;
    }

    .onlineStoreBtn .fa-upload {
        margin-right: 2px;
    }

    .onlineStoreBtn:hover {
        background: rgb(241, 137, 78);
        border: 1px solid rgb(239, 100, 21);
        color: #FFF;
        transition: .4s all;
    }

    #quote_table_wrapper {
        padding-bottom: 20px;
    }

    #quote_table_paginate {
        margin-top: 5px;
    }

    .btn_link_view {
        color: #FFF;

    }

    .storeName {
        padding: 2px;
        margin: 8px;
    }

    .storeName i {
        color: #337AB7;
    }

    /* splitform */
	.splitGreen {
		background: #FFF;
		border: 1px solid #5CB85C;
		color: #5CB85C;
	}

	.splitdef {
		background: #FFF;
		border: 1px solid #8d8d8d;
		color: #8d8d8d;
	}

	#split {
		padding: 4px 10px;
		margin-right: 10px;
		cursor: pointer;
		border-radius: 2px;
		position: relative;
		z-index: 1;
	}

	.formsplit .form__submit .grid2 {
		display: grid;
		grid-template-columns: auto auto;
		gap: 10px;
		margin: 10px 0;
	}

	.form__submit {
		background: #5CB85C1C;
		padding: 10px 5px;
		border: 1px solid #5CB85C;
		position: relative;
		top: -10px;
		border-radius: 4px;
	}

	.submitFormBtn {

		font-size: 14px !important;
		padding: 3px 10px;
		background: #5CB85C;

	}

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }



    @media screen and (max-width:1500px) {
        #quoteDocModal .modal-dialog {
            max-width: 90% !important;
            width: 90% !important;
        }
    }

    @media screen and (max-width:1200px) {
        #quoteDocModal .modal-dialog {
            max-width: 100% !important;
            width: 100% !important;
        }

        #freebModal .modal-dialog {
            width: 70% !important;
        }

        #adminCommentModal .modal-dialog {
            width: 70% !important;
        }

        #rollbackModal .modal-dialog {
            width: 70% !important;
        }

        #wave_modal .modal-dialog {
            width: 70% !important;
        }
    }

    /* 2-April-2024 */
    @media screen and (max-width:520px) {
        .form-inline select {
            margin: 0 10px;
            width: 73%;
        }

        .grid3 {
            grid-template-columns: 1fr;
            gap: 0;
        }

        #adminCommentModal .modal-dialog {
            width: 100% !important;
        }

        #rollbackModal .modal-dialog {
            width: 100% !important;
        }

        #wave_modal .modal-dialog {
            width: 100% !important;
        }

        #freebModal .modal-dialog {
            width: 100% !important;
        }

        label {
            font-size: 11px;
        }

        .flex-header .close {
            right: 10px;
            top: 14px;
            padding: 2px 6px;
        }

        .flex-header .modal-title {
            font-size: 14px;
        }

        #quoteDocModal .modal-dialog {
            width: 100% !important;
        }

        .top-left-side {
            border: none !important;
            padding: 0 20px;
        }

        .col-sm-4.search-month-year {
            width: 100%;
            padding: 0 20px;
        }


        .form-group {
            display: flex;
            width: 100%;
            align-items: center;
        }

        .search-month-year form.form-inline {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-month-year .form-inline .btn-outline-success {

            width: 90px;
        }

        div#extra_price_content {
            overflow: scroll;
        }

        .search-month-year .form-group {
            margin-bottom: 0;
        }

        button.btn.btn-primary.Go-btn {

            right: 15px;
        }
    }
</style>
<script>
    $(document).ready(function() {
        $('#quote_table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ]
        });
    });
</script>
<?php
$user_group = Yii::app()->user->getState('userGroup');
$user_id = Yii::app()->user->getState('userKey');
$full_name = Yii::app()->user->getState('fullName');
?>
<div id="ajax-loader" style="display: none;">
    <div id="loader-content">
        <!-- You can customize the loader content as needed -->
        <div class="spinner"></div>
        <div>Loading...</div>
    </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="container">

            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12 float top-left-side" style="border: 1px solid #eee;">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Quotations</h2>
                            <form class="form-inline" action="" method="POST">
                                <div class="topHead">
                                    <div class="form-group">
                                        <label for="months">Month</label>
                                        <select class="form-select" name="year_month" id="months">
                                            <option value="1" <?php if ($month == 1) echo "selected"; ?>>January</option>
                                            <option value="2" <?php if ($month == 2) echo "selected"; ?>>February</option>
                                            <option value="3" <?php if ($month == 3) echo "selected"; ?>>March</option>
                                            <option value="4" <?php if ($month == 4) echo "selected"; ?>>April</option>
                                            <option value="5" <?php if ($month == 5) echo "selected"; ?>>May</option>
                                            <option value="6" <?php if ($month == 6) echo "selected"; ?>>June</option>
                                            <option value="7" <?php if ($month == 7) echo "selected"; ?>>July</option>
                                            <option value="8" <?php if ($month == 8) echo "selected"; ?>>August</option>
                                            <option value="9" <?php if ($month == 9) echo "selected"; ?>>September</option>
                                            <option value="10" <?php if ($month == 10) echo "selected"; ?>>October</option>
                                            <option value="11" <?php if ($month == 11) echo "selected"; ?>>November</option>
                                            <option value="12" <?php if ($month == 12) echo "selected"; ?>>December</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="years">Year</label>
                                        <select class="form-select" name="year_date" id="years">
                                            <?php
                                            $currentYear = date("Y");
                                            $years = isset($year) ? $year : null; // Assuming you're getting the value from a form

                                            for ($year = $currentYear; $year >= 2020; $year--) {
                                                $selected = ($year == $years) ? "selected" : "";
                                                echo "<option value=\"$year\" $selected>$year</option>";
                                            }
                                            ?>
                                        </select>


                                    </div>
                                </div>
                                <div class="grid-form">
                                    <?php
                                    if ($user_group == "99" || $user_group == "1") {
                                    ?>
                                        <div class="form-group">
                                            <input type="checkbox" <?php
                                                                    if (isset($checked_invoice)) {
                                                                        echo "checked";
                                                                    }
                                                                    ?> name="invoice_nos">
                                            <label>Show Empty Invoice No.</label>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input type="checkbox" <?php
                                                                    if (isset($checked_collegiate_only)) {
                                                                        echo "checked";
                                                                    }
                                                                    ?> name="collegiate_only">
                                            <label>Show Collegiate Orders.</label>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input type="checkbox" <?php
                                                                    if (isset($checked_credit_net_30)) {
                                                                        echo "checked";
                                                                    }
                                                                    ?> name="credit_net_30">
                                            <label>Credit Net 30</label>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input type="checkbox" <?php
                                                                    if (isset($checked_full_payment_b4_ship)) {
                                                                        echo "checked";
                                                                    }
                                                                    ?> name="full_payment_b4_ship">
                                            <label>Full payment before shipping</label>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input type="checkbox" <?php
                                                                    if (isset($checked_50_down_payment)) {
                                                                        echo "checked";
                                                                    }
                                                                    ?> name="50_down_payment">
                                            <label>50% down payment balance due net 30</label>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input type="checkbox" <?php
                                                                    if (isset($checked_credit_card_3)) {
                                                                        echo "checked";
                                                                    }
                                                                    ?> name="credit_card_3">
                                            <label>Credit card 3%</label>
                                        </div>
                                        <br>
                                    <?php } ?>
                                </div>
                                <button type="submit" class="btn btn-primary Go-btn">GO</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4  search-month-year">
                    <div class="card">
                        <div class="card-body dflex">
                            <h2 class="card-title">Search Quotations (Any Month/Year)</h2>
                            <form class="form-inline" action="quoteEstimate/SearchList" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="search" />
                                </div>
                                <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 d-flex justify-content-between upload-report">
                    <div class="form-group text-right">
                        <h2 for="exampleFormControlSelect1" class="card-title"></h2>
                        <button class="btn orangeBtn onlineStoreBtn text-right" onclick="onlineStore(<?= $user_id ?>)"><i class="fa fa-upload" aria-hidden="true"></i>
                            Online Store Report</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 table-responsive">
                    <table class="table table-bordered quote_table" id="quote_table">
                        <thead>
                            <tr>
                                <th colspan="5" style="background-color:black;color:white; text-transform:uppercase;"><?php
                                                                                                                        echo $monthName = strftime('%B', mktime(0, 0, 0, $month));
                                                                                                                        ?></th>
                                <th rowspan="2">Quote</th>
                                <th rowspan="2">Other Quote/Invoice</th>
                                <th rowspan="2">Online Store Report</th>
                                <?php
                                if ($user_group == "1" || $user_group == "99") {
                                ?>
                                    <th rowspan="2">Admin Comments</th>
                                <?php
                                }
                                ?>
                                <th rowspan="2">Invoice #</th>
                                <th rowspan="2">Invoice Link</th>
                                <?php
                                if ($user_group == "1" || $user_group == "99") {
                                ?>
                                    <th rowspan="2">Wave API</th>
                                <?php
                                }
                                ?>
                                <!--<th rowspan="2">Company Shipped</th>-->
                                <!--<th rowspan="2">Verification</th>-->
                                <th rowspan="2">Action</th>
                                <th rowspan="2">Collegiate Order</th>
                            </tr>
                            <tr>
                                <!--<th>#</th>-->
                                <th>Sales Rep</th>
                                <th>JOG Code / Payment Terms(if any)</th>
                                <!--<th>TH #</th>-->
                                <th>Customer Name</th>
                                <th>Conversion Date</th>
                                <th>Estimate No.</th>
                            </tr>
                        </thead>
                        <tbody id="rows">
                            <?php
                            $count = 1;
                            foreach ($quotes as $data) {
                            ?>
                                <tr <?php
                                    if ($data['request_update'] == 1) {
                                        echo "style='background-color:yellow;'";
                                    }
                                    ?> id="<?= $data['conv_id'] ?>_tr">
                                    <!--<td><?= $count ?></td>-->
                                    <td>
                                        <span style="font-family:inherit;" id="full_name_admin_<?= $data['conv_id'] ?>"><?= $data['fullname'] ?></span>
                                        <?php
                                        if ($user_group == "1" || $user_group == "99") {
                                            echo ' <i class="edit_req_by fa fa-pencil" id="full_data_' . $data["conv_id"] . '" data-toggle="modal" data-target="#requestByEditModal" onclick="return showReqByEdit(\'' . $data["conv_id"] . '\',\'' . $data["conv_by_id"] . '\');"></i>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <p class="text-center">
                                            <?php
                                            echo $data['jog_code'];
                                            ?>
                                        </p>
                                        <br>
                                        <?php
                                        // Check if any of the conditions are met
                                        if ($data['credit_net_30'] == 1 || $data['full_payment_b4_ship'] == 1 || $data['50_down_payment'] == 1 || $data['credit_card_3'] == 1) :

                                            // Flag to track if edit icon has been displayed
                                            $editIconDisplayed = false;
                                        ?>
                                            <div id="quote_table" class="panel panel-default" style="border-color:EA6153;">
                                                <div class="panel-body" style="color:#EA6153;padding: 3px; font-weight: 600;">
                                                    <?php if ($data['credit_net_30'] == 1) : ?>
                                                        <div class="payment-term">
                                                            <p>Credit Net 30 &nbsp;
                                                                <?php if (!$editIconDisplayed && ($data['conv_status'] == 0 || $data['conv_status'] == 1 || $user_group == "1" || $user_group == "99")) {
                                                                    $editIconDisplayed = true; ?>
                                                                    <i class="fa fa-pencil-square-o editIcon" aria-hidden="true"></i>
                                                                <?php } ?>
                                                            </p>
                                                            <form action="" class="converToquote">
                                                                <h6>Payment Terms:</h6>
                                                                <input type="hidden" class="conv_id" value="<?php echo $data['conv_id']; ?>">
                                                                <input type="checkbox" class="credit_card_3" name="converToquote" value="<?php echo $data['credit_net_30'] ?>" <?php if ($data['credit_card_3'] == 1) {
                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                } ?>>
                                                                <label for="converToquote">Credit card 3%</label><br>
                                                            </form>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if ($data['full_payment_b4_ship'] == 1) : ?>
                                                        <div class="payment-term">
                                                            <p>Full payment before shipping &nbsp;
                                                                <?php if (!$editIconDisplayed && ($data['conv_status'] == 0 || $data['conv_status'] == 1 || $user_group == "1" || $user_group == "99")) {
                                                                    $editIconDisplayed = true; ?>
                                                                    <i class="fa fa-pencil-square-o editIcon" aria-hidden="true"></i>
                                                                <?php } ?>
                                                            </p>
                                                            <form action="" class="converToquote">
                                                                <h6>Payment Terms:</h6>
                                                                <input type="hidden" class="conv_id" value="<?php echo $data['conv_id']; ?>">
                                                                <input type="checkbox" class="credit_card_3" name="converToquote" value="<?php echo $data['credit_net_30'] ?>" <?php if ($data['credit_card_3'] == 1) {
                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                } ?>>
                                                                <label for="converToquote">Credit card 3%</label><br>
                                                            </form>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if ($data['50_down_payment'] == 1) : ?>
                                                        <div class="payment-term">
                                                            <p>50% down payment, balance due net 30 &nbsp;
                                                                <?php if (!$editIconDisplayed && ($data['conv_status'] == 0 || $data['conv_status'] == 1 || $user_group == "1" || $user_group == "99")) {
                                                                    $editIconDisplayed = true; ?>
                                                                    <i class="fa fa-pencil-square-o editIcon" aria-hidden="true"></i>
                                                                <?php } ?>
                                                            </p>
                                                            <form action="" class="converToquote">
                                                                <h6>Payment Terms:</h6>
                                                                <input type="hidden" class="conv_id" value="<?php echo $data['conv_id']; ?>">
                                                                <input type="checkbox" class="credit_card_3" name="converToquote" value="<?php echo $data['credit_net_30'] ?>" <?php if ($data['credit_card_3'] == 1) {
                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                } ?>>
                                                                <label for="converToquote">Credit card 3%</label><br>
                                                            </form>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if ($data['credit_card_3'] == 1) : ?>
                                                        <div class="payment-term">
                                                            <p>Credit card 3% &nbsp;
                                                                <?php if (!$editIconDisplayed && ($data['conv_status'] == 0 || $data['conv_status'] == 1 || $user_group == "1" || $user_group == "99")) {
                                                                    $editIconDisplayed = true; ?>
                                                                    <i class="fa fa-pencil-square-o editIcon" aria-hidden="true"></i>
                                                                <?php } ?>
                                                            </p>
                                                            <form action="" class="converToquote">
                                                                <h6>Payment Terms:</h6>
                                                                <input type="hidden" class="conv_id" value="<?php echo $data['conv_id']; ?>">
                                                                <input type="checkbox" class="credit_card_3" name="converToquote" value="<?php echo $data['credit_net_30'] ?>" <?php if ($data['credit_card_3'] == 1) {
                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                } ?>>
                                                                <label for="converToquote">Credit card 3%</label><br>
                                                            </form>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php else : ?>
                                            <?php if ($data['conv_status'] == 0 || $data['conv_status'] == 1 || $user_group == "1" || $user_group == "99") {
                                            ?>
                                                <div id="quote_table" class="panel panel-default" style="border-color:EA6153;">
                                                    <div class="panel-body" style="color:#EA6153;padding: 3px; font-weight: 600;">
                                                        <div class="payment-term">
                                                            <p style="color: #5858ef;font-size: 12px;">Add Payment Terms &nbsp;
                                                                <i class="fa fa-pencil-square-o editIcon" aria-hidden="true"></i>
                                                            </p>
                                                            <form action="" class="converToquote">
                                                                <h6>Payment Terms:</h6>
                                                                <input type="hidden" class="conv_id" value="<?php echo $data['conv_id']; ?>">
                                                                <input type="checkbox" class="credit_card_3" name="converToquote" value="<?php echo $data['credit_net_30'] ?>" <?php if ($data['credit_card_3'] == 1) {
                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                } ?>>
                                                                <label for="converToquote">Credit card 3%</label><br>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php endif; ?>


                                        <?php
                                        if ($data['sales_split_id'] != "" || strlen($data['sales_split_id']) != 0) {
                                        ?>
                                            <table class="split_table">
                                                <tr>
                                                    <th class="split_table">Sales</th>
                                                    <th class="split_table">Comm.</th>
                                                </tr>
                                                <?php
                                                $split_name = explode(",", $data['sales_split_id']);
                                                $split_percent = explode(",", $data['sales_split_percent']);
                                                $test = 0;
                                                foreach ($split_name as $splitter) {
                                                    $name_use = "SELECT fullname FROM user WHERE id='$splitter'";
                                                    $name_data = Yii::app()->db->createCommand($name_use)->queryAll();
                                                ?>
                                                    <tr>
                                                        <td class="split_table"><?= $name_data[0]['fullname'] ?></td>
                                                        <td class="split_table"><?= $split_percent[$test] ?>%</td>
                                                    </tr>
                                                <?php
                                                    $test++;
                                                }
                                                ?>
                                            </table>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?= $data['cust_name'] ?>
                                    </td>
                                    <td>
                                        <?= date("Y-M-d", strtotime($data['conv_date'])); ?>
                                    </td>
                                    <td>
                                        <?= $data['est_number']; ?>
                                        <br>
                                        <?php
                                        if ($data['conv_status'] == 0 || $data['conv_status'] == 1) {
                                        } else {
                                        ?>
                                            <button class="btn btn-primary" onclick="return duplicateQuote(<?= $data['qdoci_id'] ?>);">Duplicate</button>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($user_group == "99" || $user_group == "1") {
                                            if ($data['draft_changed'] == 1) {
                                        ?>
                                                <button class="btn btn-success" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotationFinalDraftAdmin('<?= $data['qdoci_id'] ?>','vp','<?= $data['jog_code'] ?>','<?= $data['conv_id'] ?>');">View Approved Estimate</button>
                                            <?php
                                            }
                                            if ($data['conv_status'] == 0 || $data['conv_status'] == 1) {
                                                $tagger = "View & Approve";
                                                $condn_class = "btn btn-primary";
                                            } else {
                                                $tagger = "Approved";
                                                $condn_class = "btn btn-success";
                                            }
                                            ?>
                                            <?php
                                            if ($data['qdoci_id'] == 0 || $data['qdoci_id'] == null) {
                                                if ($data['conv_status'] == 0 || $data['conv_status'] == 1) {
                                                    $tagger = "Confirm Approval";
                                                    $condn_class = "btn btn-primary";
                                                } else {
                                                    $tagger = "Approved";
                                                    $condn_class = "btn btn-success";
                                                }
                                            ?>
                                                <button class="<?= $condn_class ?> online_store_approve" conv_id="<?= $data['conv_id'] ?>"><?= $tagger ?></button>
                                            <?php
                                            } else {
                                            ?>
                                                <button class="btn btn-success" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotationFinal('<?= $data['qdoci_id'] ?>','vp','<?= $data['jog_code'] ?>','<?= $data['conv_id'] ?>');">View</button>
                                                <button class="<?= $condn_class ?>" id="view_approve_<?= $data['conv_id'] ?>" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotationFinal('<?= $data['qdoci_id'] ?>','va','<?= $data['jog_code'] ?>','<?= $data['conv_id'] ?>');"><?= $tagger ?></button>
                                                <?php
                                                if ($data['comm_status'] == 0) {
                                                ?>
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <button class="btn btn-secondary btn-sm" id="comm_btn_<?= $data['conv_id'] ?>" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotationFinal('<?= $data['qdoci_id'] ?>','vc','<?= $data['jog_code'] ?>','<?= $data['conv_id'] ?>');">Comm.</button>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <button class="btn btn-primary btn-sm approve_comm" conv_id="<?= $data['conv_id'] ?>">Approve</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <button class="btn btn-success" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotationFinal('<?= $data['qdoci_id'] ?>','vc','<?= $data['jog_code'] ?>','<?= $data['conv_id'] ?>');">Comm.</button>
                                                <?php
                                                }
                                            }
                                        } elseif ($data['conv_status'] == 2) {
                                            if ($data['qdoci_id'] == 0 || $data['qdoci_id'] == null) {
                                                ?>
                                                <button class="btn btn-success">Approved (ONLINE STORE)</button>
                                            <?php
                                            } else {
                                            ?>
                                                <button class="btn btn-success" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotationFinal('<?= $data['qdoci_id'] ?>','vp','<?= $data['jog_code'] ?>','<?= $data['conv_id'] ?>');">View (Approved)</button>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <!--<button class="btn btn-warning">Awaiting Approval</button>-->
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotationFinal('<?= $data['qdoci_id'] ?>','vp','<?= $data['jog_code'] ?>','<?= $data['conv_id'] ?>');">View (Awaiting Approval)</button>
                                        <?php }
                                        if ($data['conv_notes'] != "") {
                                        ?>
                                            <button class="btn btn-success" onclick="fetchSrNote(<?= $data['conv_id'] ?>)">SR Note</button>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($data['remake'] == "" && $data['remake_notes'] == "") {
                                            $rm_class = "btn-danger";
                                        } else {
                                            $rm_class = "btn-success";
                                        }

                                        if ($data['sample'] == "" && $data['sample_notes'] == "") {
                                            $sm_class = "btn-danger";
                                        } else {
                                            $sm_class = "btn-success";
                                        }

                                        if ($data['complimentary'] == "" && $data['complimentary_notes'] == "") {
                                            $cm_class = "btn-danger";
                                        } else {
                                            $cm_class = "btn-success";
                                        }
                                        ?>
                                        <button data-toggle="modal" data-target="#freebModal" onclick="openQuotationData('1','<?= $data['conv_id'] ?>','<?= $data['remake'] ?>','<?= base64_encode($data['remake_notes']) ?>')" class="btn <?= $rm_class ?> btn-md" style="width:100%">Remake</button>
                                        <button data-toggle="modal" data-target="#freebModal" onclick="openQuotationData('2','<?= $data['conv_id'] ?>','<?= $data['sample'] ?>','<?= base64_encode($data['sample_notes']) ?>')" class="btn <?= $sm_class ?> btn-md" style="width:100%">Sample</button>
                                        <button data-toggle="modal" data-target="#freebModal" onclick="openQuotationData('3','<?= $data['conv_id'] ?>','<?= $data['complimentary'] ?>','<?= base64_encode($data['complimentary_notes']) ?>')" class="btn <?= $cm_class ?> btn-md" style="width:100%">Complimentary</button>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                                <?php
                                                if ($data['online_store'] == "") {
                                                    $os_class = "btn btn-danger";
                                                    $os_txt = "Click To Upload";
                                                } else {
                                                    $os_class = "btn btn-success";
                                                    $os_txt = "View";
                                                }
                                                ?>
                                                <button class="<?= $os_class ?> btn-md" data-toggle="modal" data-target="#freebModal" onclick="openQuotationData('4','<?= $data['conv_id'] ?>','<?= $data['online_store'] ?>','')" style="width:100%"><?= $os_txt ?></button>
                                                <div class="storeName">
                                                    <?php if (!empty($data['online_store_name'])) : ?>
                                                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                                    <?php echo $data['online_store_name']; ?>
                                                    <?php endif; ?>
                                                </div>


                                            </div>
                                        </div>
                                    </td>
                                    <?php
                                    if ($user_group == "99" || $user_group == "1") {
                                    ?>
                                        <td style="text-align:center;">
                                            <?php
                                            if ($user_id == "2" || $user_id == "40") {
                                                if ($data['admin_comments'] == "" || $data['admin_comments'] == null) {
                                            ?>
                                                    <button class="btn btn-primary admin_comment_edit" conv_id="<?= $data['conv_id'] ?>">Add Notes</button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button class="btn btn-success admin_comment_edit" conv_id="<?= $data['conv_id'] ?>">Update Notes</button>
                                                <?php
                                                }
                                            } elseif ($data['admin_comments'] == "" || $data['admin_comments'] == null) {
                                                ?>
                                                <button class="btn btn-danger">No Notes</button>
                                            <?php
                                            } else {
                                            ?>
                                                <button class="btn btn-success admin_comment_edit" conv_id="<?= $data['conv_id'] ?>">View Notes</button>
                                            <?php
                                            }
                                            if ($user_id == 28) {
                                            ?>
                                                <div class="form-inline inline-form">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control ship_<?= $data['conv_id'] ?>" value="<?= $data['shipping_charges'] ?>" placeholder="Input Shipping...">
                                                    </div>
                                                    <span class="btn btn-primary update_shipping" conv_id="<?= $data['conv_id'] ?>">Update</span>
                                                </div>
                                                <div class="form-inline inline-form">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control ship_with_<?= $data['conv_id'] ?>" value="<?= $data['shipping_with'] ?>" placeholder="Shipped With EX...">
                                                    </div>
                                                    <span class="btn btn-primary update_shipping_with" conv_id="<?= $data['conv_id'] ?>">Update</span>
                                                </div>
                                                <?php
                                            } else {
                                                if (!empty($data['shipping_charges'])) {
                                                ?>
                                                    <p class="encircle">Shipping: <?= $data['shipping_charges'] ?> </p>

                                                <?php
                                                }
                                                if (!empty($data['shipping_with'])) {
                                                ?>
                                                    <p class="encircle">Shipped With: <?= $data['shipping_with'] ?> </p>

                                        <?php
                                                }
                                            }
                                        }
                                        ?>
                                        </td>
                                        <td>
                                            <div class="cnt_inv" id="d_inv<?= $data['qdoc_id'] ?>"><?= $data['inv_no'] ?></div>
                                            <?php
                                            if ($user_group == "99" || $user_group == "1") {
                                            ?>
                                                <i class="fa fa-pencil btn_edit_inv" data-toggle="modal" data-target="#editINVModal" onclick="return editInvoice(<?= $data['qdoc_id'] ?>);"></i>
                                            <?php } ?>
                                        </td>
                                        <td id="td_inv_<?= $data['qdoc_id'] ?>">
                                            <?php
                                            if ($data['invoice_link'] == "") {
                                            ?>
                                                <button class="btn btn-danger btn-md btn_link_view btn_<?= $data['qdoc_id'] ?>" style="width:100%">Not Available</button>
                                                <?php } else {
                                                $inv_links = explode(',', $data['invoice_link']);
                                                foreach ($inv_links as $invoiced) {
                                                ?>

                                                    <a href="<?= $invoiced ?>" target="_blank"><button class="btn btn-success btn-md btn_link_view" style="width:100%">View</button></a>
                                                <?php
                                                }
                                            }
                                            if ($user_group == "99" || $user_group == "1") {
                                                ?>
                                                <div class="cnt_inv" style="display:none;" id="d_inv_link<?= $data['qdoc_id'] ?>"><?= $data['invoice_link'] ?></div>
                                                <i class="fa fa-pencil btn_edit_inv" data-toggle="modal" data-target="#editINVNOModal" onclick="return editInvoiceLink(<?= $data['qdoc_id'] ?>);"></i>
                                            <?php } ?>
                                        </td>
                                        <?php
                                        if ($user_group == "1" || $user_group == "99") {
                                        ?>
                                            <td>
                                                <?php
                                                if ($data['conv_status'] == 2) {
                                                ?>
                                                    <button class="btn btn-primary wave_modal_api" conv_id="<?= $data['conv_id'] ?>" jog_code="<?= base64_encode($data['jog_code']) ?>" cust_name="<?= base64_encode($data['cust_name']) ?>" doc_id="<?= $data['qdoci_id'] ?>">Create Invoice</button>
                                                <?php
                                                } else {
                                                ?>
                                                    <p><i>Quote not Approved.</i></p>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                        <?php
                                        }
                                        ?>
                                        <!--<td>-->
                                        <?php
                                        //if($user_group=="99" || $user_group=="1"){
                                        ?>
                                        <!--<select class="form-control ship_comp" conv_id="<?= $data['conv_id'] ?>">-->
                                        <!--    <option selected="" disabled="" value="">Select Shipping</option>-->
                                        <!--    <option value="JOG" <?php if ($data['ship_comp'] == "JOG") {
                                                                        echo "selected";
                                                                    } ?>>JOG</option>-->
                                        <!--    <option value="JS" <?php if ($data['ship_comp'] == "JS") {
                                                                        echo "selected";
                                                                    } ?>>JS</option>-->
                                        <!--    <option value="G2W" <?php if ($data['ship_comp'] == "G2W") {
                                                                        echo "selected";
                                                                    } ?>>G2W</option>-->
                                        <!--    <option value="B2C" <?php if ($data['ship_comp'] == "B2C") {
                                                                        echo "selected";
                                                                    } ?>>B2C</option>-->
                                        <!--    <option value="Local Delivery" <?php if ($data['ship_comp'] == "Local Delivery") {
                                                                                    echo "selected";
                                                                                } ?>>Local Delivery</option>-->
                                        <!--  </select>-->
                                        <?php
                                        //}else{ echo $data['ship_comp']; }
                                        ?>


                                        <!--</td>-->

                                        <td>
                                            <?php
                                            if ($user_group == "99" || $user_group == "1") {
                                                if ($data['request_update'] == 1) {
                                            ?>
                                                    <button class="btn btn-warning" id="btn_upd_<?= $data['conv_id'] ?>" onclick="openRequest('<?= $data['conv_id'] ?>','<?= $data['conv_by_id'] ?>')">Update Requested</button>
                                                <?php
                                                }
                                                ?>
                                                <button class="btn btn-danger rollback" jog_code="<?= $data['jog_code'] ?>" fname="<?= $data['conv_by'] ?>" conv_id="<?= $data['conv_id'] ?>">Rollback</button>
                                                <?php
                                            } else {
                                                if ($data['request_update'] == 0) {
                                                ?>
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#requestUpdateModal" onclick="requestData('<?= $data['jog_code'] ?>','<?= $data['conv_id'] ?>','<?= base64_encode($data['request_text']) ?>')">Request Update</button>
                                                    <button class="btn btn-danger rollback" jog_code="<?= $data['jog_code'] ?>" fname="<?= $data['conv_by'] ?>" conv_id="<?= $data['conv_id'] ?>">Cancel Quotation</button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button class="btn btn-warning" onclick="openRequestUser('<?= $data['conv_id'] ?>','<?= $data['conv_by_id'] ?>')">Update Requested</button>
                                                    <button class="btn btn-danger rollback" jog_code="<?= $data['jog_code'] ?>" fname="<?= $data['conv_by'] ?>" conv_id="<?= $data['conv_id'] ?>">Cancel Quotation</button>
                                                <?php
                                                }
                                                ?>
                                                <button class="btn btn-secondary archiver" conv_id="<?= $data['conv_id'] ?>">Archive</button>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center"><?php
                                                                if ($data['collegiate'] == 1) {
                                                                ?>
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <th><?= $data['college_name'] ?></th>
                                                            <?php
                                                                    if ($data['licensing_company'] != 0) {
                                                                        echo "<th>Licensing Company</th>";
                                                                    }
                                                            ?>
                                                            <?php
                                                                    if ($data['royalty_bearing'] != 0) {
                                                                        echo "<th>Royalty Bearing</th>";
                                                                    }
                                                            ?>
                                                            <?php
                                                                    if ($data['non_royalty_bearing'] != 0) {
                                                                        echo "<th>Non Royalty Bearing</th>";
                                                                    }
                                                            ?>
                                                            <?php
                                                                    if ($data['no_report'] != 0) {
                                                                        echo "<th>No Report/Non Licensed</th>";
                                                                    }
                                                            ?>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            <?php
                                                                } else {
                                                                    echo "-";
                                                                }
                                            ?>
                                        </td>
                                </tr>
                            <?php
                                $count++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '.sync_btn', function() {
        var searchTerm = $('.input-group-addon').text();
        $('#searchInput').val(searchTerm);
        $.ajax({
            url: "<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/SearchWaveCustomers", // Replace with your backend endpoint
            method: "POST",
            data: {
                searchTerm: searchTerm
            },
            success: function(data) {
                const results = JSON.parse(data);
                displayResults(results);
            },
            error: function() {
                console.log("Error in the AJAX request");
            }
        });
    })

    $(document).on('click', '.wave_modal_api', function() {
        var cust_name = $(this).attr('cust_name');
        var jog_code = $(this).attr('jog_code');
        var conv_id = $(this).attr('conv_id');
        var qdoc_id = $(this).attr('doc_id');
        $('#pdfUrlWave').val("");
        $('#invoiceNumberWave').val("");
        $('.input-group-addon').text(atob(cust_name));
        $('#jog-code-wave').val(atob(jog_code));
        $('#qdoc_id_wave').val(qdoc_id);
        $('#conv_id_wave').val(conv_id);
        // Get current date
        var currentDate = new Date();

        // Set current date for "INVOICE DATE" input
        document.getElementById('invoice-date').valueAsDate = currentDate;

        // Calculate due date (current date + 30 days) for "DUE DATE" input
        var dueDate = new Date();
        dueDate.setDate(currentDate.getDate() + 30);
        document.getElementById('due-date').valueAsDate = dueDate;
        $('#wave_modal').modal('show');
    })
</script>

<script type="text/javascript">
    $(document).ready(function() {
        // Listen for input changes in the search input field
        $("#searchInput").on("input", function() {
            let searchTerm = $(this).val();
            if (searchTerm === "") {
                $("#searchResults").empty();
                return;
            }

            // Simulate an AJAX request to fetch results from the backend
            $.ajax({
                url: "<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/SearchWaveCustomers", // Replace with your backend endpoint
                method: "POST",
                data: {
                    searchTerm: searchTerm
                },
                success: function(data) {
                    const results = JSON.parse(data);
                    displayResults(results);
                },
                error: function() {
                    console.log("Error in the AJAX request");
                }
            });
        });

        // Function to display search results

    });

    function displayResults(results) {
        const resultsContainer = $("#searchResults");
        resultsContainer.empty();

        if (results.length > 0) {
            results.forEach(function(result) {
                const resultItem = $("<div class='search-result'></div>");
                resultItem.text(result.name);

                resultItem.click(function() {
                    // When a result is clicked, populate the input and hidden fields
                    $("#searchInput").val(result.name);
                    $("#cust_id_wave").val(result.id);
                    resultsContainer.empty(); // Clear the search results
                    var wave_id = result.id;
                    $('#ajax-loader').show();
                    $.ajax({
                        type: 'POST',
                        data: {
                            wave_id: wave_id
                        },
                        url: '<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/FetchWaveCusData',
                        success: function(response) {
                            $('#ajax-loader').hide();
                            // Create the paragraph content
                            var jsonData = JSON.parse(response);
                            var paragraphContent = jsonData.data.business.name + "<br>" +
                                jsonData.data.business.customer.firstName + " " + jsonData.data.business.customer.lastName + "<br>";

                            if (jsonData.data.business.customer.address) {
                                if (jsonData.data.business.customer.address.addressLine1) {
                                    paragraphContent += jsonData.data.business.customer.address.addressLine1 + "<br>";
                                }

                                if (jsonData.data.business.customer.address.addressLine2) {
                                    paragraphContent += jsonData.data.business.customer.address.addressLine2 + "<br>";
                                }

                                if (jsonData.data.business.customer.address.city) {
                                    paragraphContent += jsonData.data.business.customer.address.city + "<br>";
                                }

                                if (jsonData.data.business.customer.address.province && jsonData.data.business.customer.address.province.name) {
                                    paragraphContent += jsonData.data.business.customer.address.province.name + "<br>";
                                }

                                if (jsonData.data.business.customer.address.country && jsonData.data.business.customer.address.country.name) {
                                    paragraphContent += jsonData.data.business.customer.address.country.name + "<br>";
                                }

                                if (jsonData.data.business.customer.address.postalCode) {
                                    paragraphContent += jsonData.data.business.customer.address.postalCode + "<br>";
                                }
                            }

                            paragraphContent += jsonData.data.business.customer.email;
                            paragraphContent = paragraphContent.replace(/null|undefined/g, '');
                            $('#output-customer').html(paragraphContent);
                        }
                    })
                });

                resultsContainer.append(resultItem);
            });
        } else {
            resultsContainer.text("No results found");
            $("#cust_id_wave").val("");
            $('#output-customer').empty();
        }
    }
</script>

<div class="modal fade default-modal" id="wave_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="flex-header modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title">Generate Wave Invoice</h4>
            </div>
            <div class="modal-body">
                <form id="create_invoice_form">
                    <div class="container">
                        <div class="row ">
                            <div class="grid3">
                                <div class="col-md-12">
                                    <label for="sales-rep-customer">Sales Rep Customer</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <span class="btn btn-primary sync_btn " style="margin: 0;">Sync</span>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <label for="wave-customer">Wave Customer</label>
                                    <div class="input-group">
                                        <input type="text" id="searchInput" name="wave_customer" class="form-control">
                                        <div class="results-container">
                                            <div id="searchResults"></div>
                                        </div>
                                        <span class="input-group-btn" id="fixed-btn">
                                            <span class="btn btn-default" id="refresh-button">
                                                <span class="glyphicon glyphicon-refresh"></span>
                                            </span>
                                        </span>
                                        <input type="hidden" id="cust_id_wave" name="cust_id_wave">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="sales-rep-customer">Bill Details</label>
                                    <p id="output-customer"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="note" style="color:red;">
                                    <i>
                                        1. <strong>Invoice Creation Time:</strong>
                                        <br>Invoice creation time may vary, ranging from 10 seconds to 1 minute, depending on the length of the invoice.
                                        <br><br>
                                        2. <strong>Invoice Verification Process:</strong>
                                        <br>Kindly review the invoice in Wave Software under drafts.
                                        <br>Ensure that the details of the invoice align with the quotes.
                                        <br>Make any necessary changes based on the comparison.
                                        <br><br>
                                        3. <strong>Adding Customers in Wave Software:</strong>
                                        <br>If you encounter difficulty finding a customer, add them to Wave Software first.
                                        <br>To refresh the customer list, click the refresh button located in front of the Wave Customer search bar.
                                    </i>
                                </p>

                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12  Additional-details-div">
                                <h2 class="text-center">ADDITIONAL DETAILS</h2>
                                <div class="grid3">
                                    <div class="form-group">
                                        <label for="jog-code-wave">JOG CODE</label>
                                        <input type="text" class="form-control" id="jog-code-wave" name="jog_code_wave" placeholder="Enter Jog Code">
                                    </div>
                                    <div class="form-group">
                                        <label for="invoice-date">INVOICE DATE</label>
                                        <input type="date" name="invoice_date_wave" class="form-control" required id="invoice-date">
                                    </div>
                                    <div class="form-group">
                                        <label for="due-date">DUE DATE</label>
                                        <input type="date" name="due_date_wave" class="form-control" required id="due-date">
                                        <input type="hidden" name="conv_id" id="conv_id_wave">
                                        <input type="hidden" name="qdoc_id" id="qdoc_id_wave">
                                    </div>

                                    <button class="btn btn-primary" type="submit">Submit</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="pdfUrl">WAVE URL:</label>
                            <input type="text" class="form-control" readonly id="pdfUrlWave">
                        </div>
                        <div class="col-md-6">
                            <label for="invoiceNumber">Invoice Number:</label>
                            <input type="text" class="form-control" readonly id="invoiceNumberWave">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="requestUpdateModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title">Input Updation Request</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="request_update_ajax">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="sales_quote_name_online">JOG Code :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="jog_code" id="jog_code_input" readonly>
                            <input type="hidden" name="conv_id" id="conv_id_update">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Notes:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="update_notes"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Old Request<br>(if any):</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="old_rq_sales" readonly></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editINVModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title">Enter Invoice No.</h4>
            </div>
            <div class="modal-body">
                <input type="text" id="inv_value" name="inv_value" style="width: 100%; text-align: center;">
                <input type="hidden" id="edit_inv_qdoc_id">
                <div style="color: #F00; font-size: 14px; text-align: center; width: 100%; padding: 0px; margin:0px;">* Use "," for separate the Invoice numbers. <br><u>Ex</u>: 00000000,11111111,222222222</div>
            </div>
            <div class="modal-footer">
                <center><button style="" id="btn_submit_edit" type="button" class="btn btn-success" onclick="return submitInvoice();"> Submit </button>
                </center>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editINVNOModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title">Enter Invoice Link</h4>
            </div>
            <div class="modal-body">
                <input type="text" id="inv_link" name="inv_link" style="width: 100%; text-align: center;">
                <input type="hidden" id="edit_inv_link_qdoc_id">
                <div style="color: #F00; font-size: 14px; text-align: center; width: 100%; padding: 0px; margin:0px;">Enter Complete Link to the invoice.* Use "," for separate the Invoice Links. <br><u>Ex</u>: https://www.example.com,https://www.jogsports.com</div>
            </div>
            <div class="modal-footer">
                <center><button style="" id="btn_submit_edit" type="button" class="btn btn-success" onclick="return submitInvoiceLink();"> Submit </button></center>
            </div>
        </div>
    </div>
</div>

<div class="modal fade default-Modal" id="freebModal" tabindex="-1" role="dialog" aria-labelledby="freebModal1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="flex-header modal-header">
                <div class="d-flex">
                    <h3 class="modal-title" style="float:left;" id="freebModal1"></h3>
                    <button style="float:right;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <form id="upload_sample" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Upload File(*EXCEL OR PDF ONLY)</label>
                        <input type="file" class="form-control" name="files_name" id="exampleInputEmail1" accept="application/pdf,application/vnd.ms-excel">
                        <input type="hidden" id="main_conv_id" name="main_conv_id" required class="form-control">
                        <input type="hidden" id="conv_type" name="conv_type">
                    </div>
                    <div id="note_div">

                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <iframe src="" style="display:none;" id="pdf_source" type="frame&amp;vlink=xx&amp;link=xx&amp;css=xxx&amp;bg=xx&amp;bgcolor=xx" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scorlling="yes" width="100%" height="600"></iframe>
                <iframe class="frame_content" id="live_view" style="display:none;" src="" width="100%" height="700" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="rqUpdModal" tabindex="-1" role="dialog" aria-labelledby="convNoteModal12" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex">
                    <h3 class="modal-title" style="float:left;" id="convNoteModal12">Request Update</h3>
                    <button type="button" style="float:right;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="container">
                    <h5 id="req_upd_text"></h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="req_comp_btn">Complete Request</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="rqUpdUserModal" tabindex="-1" role="dialog" aria-labelledby="convNoteModal12User" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex">
                    <h3 class="modal-title" style="float:left;" id="convNoteModal12User">Request Update</h3>
                    <button type="button" style="float:right;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="container">
                    <h5 id="req_upd_text_user"></h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning">Awaiting Request Completion</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="adminCommentModal" tabindex="-1" role="dialog" aria-labelledby="convNoteModal123" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="flex-header modal-header">
                <div class="d-flex">
                    <h3 class="modal-title" style="float:left;" id="convNoteModal123">Admin Comments</h3>
                    <button type="button" style="float:right;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="submit_note_admin">
                    <input type="hidden" value="" name="conv_id" id="conv_id_note_admin">
                    <input type="hidden" value="" name="jog_code" id="jog_code_note_admin">
                    <input type="hidden" value="0" name="is_avail" id="is_avail">
                    <div id="d_admin_comments"></div>
                    <?php
                    if ($user_id == "2" || $user_id == "40" || $user_id == "28") {
                    ?>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Add/Edit:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="admin_comments" id="note_admin_edit"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Update & Send Email</button>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade default-Modal" id="rollbackModal" tabindex="-1" role="dialog" aria-labelledby="convNoteModal1234" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="flex-header modal-header">
                <div class="d-flex">
                    <h3 class="modal-title" style="float:left;" id="convNoteModal1234">Rollback & Notify Sales Rep / Admin</h3>
                    <button type="button" style="float:right;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="rollback_quote">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">JOG Code:</label>
                        <input type="hidden" value="" name="conv_id" id="rollback_conv_id">
                        <div class="col-sm-10">
                            <input type="text" class="form-control" readonly id="rollback_ex">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Sales Rep:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" readonly id="fname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Type Reason:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="rollback_email" id="rollback_email"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-danger">Remove & Send Email</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '#refresh-button', function() {
        if (confirm('This will refresh the customer database of WAVE. Only proceed if you are unable to see the customer while typing.')) {
            // Show the loader
            $('#ajax-loader').show();

            $.ajax({
                type: 'GET',
                url: '<?php echo Yii::app()->request->baseUrl; ?>/QuoteEstimate/refreshWaveCustomers',
                success: function(response) {
                    // Hide the loader when the request is completed
                    $('#ajax-loader').hide();
                    console.log(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle errors and hide the loader
                    $('#ajax-loader').hide();
                    console.error("AJAX Request Failed: " + textStatus, errorThrown);
                }
            });
        }
    });

    $(document).on('submit', '#create_invoice_form', function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = new FormData(form[0]);
        var cust_id = $('#cust_id_wave').val();
        if (cust_id.length == 0) {
            alert('Customer is not correct');
            return;
        }

        if (confirm('Do you really want to create WAVE invoice?')) {
            $('#ajax-loader').show();
            $.ajax({
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                url: "<?php echo Yii::app()->request->baseUrl; ?>/QuoteEstimate/createWaveInvoice",
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status == 1) {
                        $('#pdfUrlWave').val(response.viewUrl);
                        $('#invoiceNumberWave').val(response.inv);
                        $('#ajax-loader').hide();
                    } else {
                        alert('Something Went Wrong ! Contact Programmer');
                        $('#ajax-loader').hide();
                    }
                }
            })
        }
    })


    $(document).on('click', '.rollback', function() {
        var conv_id = $(this).attr('conv_id');
        var jog_code = $(this).attr('jog_code');
        var fname = $(this).attr('fname');
        $('#fname').val(fname);
        $('#rollback_ex').val(jog_code);
        $('#rollback_conv_id').val(conv_id);
        $('#rollbackModal').modal('show');
    })

    $(document).on('submit', '#rollback_quote', function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = new FormData(form[0]);
        for (var p of formData) {
            let name = p[0];
            let value = p[1];

            if (name == "conv_id") {
                var func = "#" + value + "_tr";
            }
        }
        $.ajax({
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            url: "<?php echo Yii::app()->request->baseUrl; ?>/QuoteEstimate/removeConv",
            success: function(response) {
                var response = JSON.parse(response);
                if (response.status == 1) {
                    alert('Quotation Rollback Successfull!');
                    $(func).remove();
                    $('#rollbackModal').modal('hide');
                } else {
                    alert('Something Went Wrong');
                }
            }
        })
    })

    $(document).on('click', '.admin_comment_edit', function() {
        var conv_id = $(this).attr('conv_id');
        $.ajax({
            type: 'POST',
            data: {
                conv_id: conv_id
            },
            url: '<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/FetchComments',
            success: function(response) {
                $('#d_admin_comments').empty();
                var response = JSON.parse(response);
                if (response.status == 1) {
                    if (response.msg == null) {
                        $('#conv_id_note_admin').val(conv_id);
                        $('#jog_code_note_admin').val(response.jog_code);
                        $('#note_admin_edit').val("");
                        $('#is_avail').val(0);
                        $('#adminCommentModal').modal('show');
                    } else {
                        $('#conv_id_note_admin').val(conv_id);
                        //$('#note_admin').val(response.msg);
                        $('#jog_code_note_admin').val(response.jog_code);
                        $('#adminCommentModal').modal('show');
                        $('#is_avail').val(1);
                        var data = "";
                        data = '<div><center><pre class="alert" style="width:100%; height:100%; max-width:900px; overflow-x:auto; color:#FFF; background-color:#990;">Scott Whitcomb comments "' + response.msg + '"</pre></center></div>';
                        $('#d_admin_comments').append(data);
                        $.ajax({
                            type: 'POST',
                            data: {
                                conv_id: conv_id
                            },
                            url: '<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/FetchChats',
                            success: function(response) {
                                var response = JSON.parse(response);
                                if (response.status == 1) {
                                    var html = '';
                                    html = atob(response.msg);
                                    $('#d_admin_comments').append(html);
                                }
                            }
                        })
                        $('#note_admin_edit').val("");
                    }
                }
            }
        })
    })

    $(document).on('submit', '#submit_note_admin', function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = new FormData(form[0]);
        $.ajax({
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            url: "<?php echo Yii::app()->request->baseUrl; ?>/QuoteEstimate/submitNoteAdmin",
            success: function(response) {
                var response = JSON.parse(response);
                if (response.status == 1) {
                    var html = '';
                    var text = atob(response.comment);
                    html += '<div><center><pre class="alert" style="text-align:right; width:100%; height:100%; max-width:900px; overflow-x:auto; color:#FFF; background-color:#990;">' + text + '</pre></center></div>';
                    $('#d_admin_comments').append(html);
                    $('#note_admin_edit').val("");
                } else {
                    alert('Something Went Wrong');
                }
            }
        })
    })

    function showReqByEdit(conv_id, user_id) {

        $('#edit_reqby_qdoc_id').val(conv_id);
        $('#edit_reqby_user_id').val(user_id);

    }

    function submitReqByEdit() {

        if ($('#edit_reqby_qdoc_id').val() == "") {

            alert("Can not update to new user.");
            return false;
        }

        var conv_id = $('#edit_reqby_qdoc_id').val();
        var user_id = $('#edit_reqby_user_id').val();
        var full_name = $("#edit_reqby_user_id option:selected").attr("sales_name")

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/updateUserByAdmin",
            data: {
                "conv_id": conv_id,
                "user_id": user_id,
                "full_name": full_name
            },
            success: function(resp) {
                if (resp.result == "success") {
                    var func = "return showReqByEdit('" + conv_id + "','" + user_id + "')";
                    $('#full_name_admin_' + conv_id).html(full_name);
                    $('#full_data_' + conv_id).attr("onclick", func);
                    $('#requestByEditModal').modal('hide');

                } else {
                    alert(resp.msg);
                }


            }
        });

    }

    $(document).on('click', '.archiver', function() {
        var conv_id = $(this).attr('conv_id');
        if (confirm('Do you really want to archive this quotation?')) {
            $.ajax({
                type: 'POST',
                data: {
                    conv_id: conv_id
                },
                url: '<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/ArchiveQuote',
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status == 1) {
                        alert('Quote Archived');
                        location.reload();
                    } else {
                        alert('Something Went Wrong');
                    }
                }
            })
        }
    })

    $(document).on('click', '#req_comp_btn', function() {
        if (confirm('Do you really want to update the request?')) {
            var conv_id = $(this).attr('conv_id');
            $.ajax({
                type: 'POST',
                data: {
                    conv_id: conv_id
                },
                url: '<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/ReqUpdateFinal',
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status == 1) {
                        alert('Request Completed');
                        $('#btn_upd_' + conv_id).hide();
                        $('#rqUpdModal').modal('hide');
                    } else {
                        alert('Something Went Wrong');
                    }
                }
            })
        }
    })

    function requestData(jog_code, conv_id, req_text) {
        $('#jog_code_input').val(jog_code);
        $('#conv_id_update').val(conv_id);
        $('#old_rq_sales').val(atob(req_text));
    }

    function openRequest(conv_id, emp_id) {
        $.ajax({
            type: 'POST',
            data: {
                conv_id: conv_id
            },
            url: '<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/FetchText',
            success: function(response) {
                var response = JSON.parse(response);
                if (response.status == 1) {
                    $('#req_upd_text').html(response.data);
                    $('#req_comp_btn').attr('conv_id', conv_id);
                    $('#rqUpdModal').modal('show');
                }
            }
        })
    }

    function openRequestUser(conv_id, emp_id) {
        $.ajax({
            type: 'POST',
            data: {
                conv_id: conv_id
            },
            url: '<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/FetchText',
            success: function(response) {
                var response = JSON.parse(response);
                if (response.status == 1) {
                    $('#req_upd_text_user').html(response.data);
                    $('#rqUpdUserModal').modal('show');
                }
            }
        })
    }

    $(document).on('click', '.approve_comm', function() {
        var el = $(this);
        if (confirm('Do you really want to approve commission?')) {
            var conv_id = $(this).attr('conv_id');
            $.ajax({
                type: 'POST',
                data: {
                    conv_id: conv_id
                },
                url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/ApproveCommission',
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status == 1) {
                        $('#comm_btn_' + conv_id).removeClass("btn-secondary");
                        $('#comm_btn_' + conv_id).addClass("btn-success");
                        el.hide();
                    } else {
                        alert('Something Went Wrong');
                    }
                }
            })
        }
    })

    $(document).on('click', '.online_store_approve', function() {
        if (confirm('Do you really want to approve?')) {
            var conv_id = $(this).attr('conv_id');
            $.ajax({
                type: 'POST',
                data: {
                    conv_id: conv_id
                },
                url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/ApproveOnlineStore',
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status == 1) {
                        alert('Approved, please refresh page');
                    } else {
                        alert('Something Went Wrong');
                    }
                }
            })
        }
    })

    $(document).on('submit', '#request_update_ajax', function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = new FormData(form[0]);
        $.ajax({
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            url: "<?php echo Yii::app()->request->baseUrl; ?>/QuoteEstimate/requestUpdateAjax",
            success: function(response) {
                var response = JSON.parse(response);
                if (response.status == 1) {
                    location.reload();
                } else {
                    alert('Something Went Wrong');
                }
            }
        })
    })

    $(document).on('submit', '#conv_estimate_online', function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = new FormData(form[0]);
        $.ajax({
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/ConvEstimateOnline",
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
    })

    function onlineStore(salesrep_id) {
        $.ajax({
            type: 'POST',
            data: {
                salesrep_id: salesrep_id
            },
            url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/fetchOrderNum',
            success: function(response) {
                var response = JSON.parse(response);
                if (response.status == 1) {
                    $('#sales_quote_name_online').val(response.salesrep_name);
                    $('#sales_quote_id_online').val(response.salesrep_id);
                    var html = '';
                    for (var i = 0; i < response.order_num.length; i++) {
                        html += '<option value="' + response.order_num[i].order_main_code + '">' + response.order_num[i].order_main_code + '</option>';
                    }
                    $('#ex_th_code_online').empty();
                    $('#ex_th_code_online').append(html);
                    $('#online_store_modal').modal('show');
                } else {
                    alert('No EX code to sync');
                }
            }
        })
    }
</script>
<div class="modal fade" id="online_store_modal" tabindex="-1" role="dialog" aria-labelledby="freebModal1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex">
                    <h3 class="modal-title" style="float:left;">Online Store Report (DIRECT)</h3>
                    <button style="float:right;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="conv_estimate_online">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="sales_quote_name_online">Sales Rep :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="sales_quote_name" id="sales_quote_name_online" readonly>
                            <input type="hidden" name="sales_quote_id" class="form-control" id="sales_quote_id_online" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="ex_th_code">Available EX/TH Codes:</label>
                        <div class="col-sm-10">
                            <select class="form-control js-example-basic-multiple" name="codes[]" id="ex_th_code_online" multiple="multiple">

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Online Store:</label>
                        <div class="col-sm-10">
                            <select class="form-control" required name="online_store_name">
                                <option value="" selected disabled>==Select Online Store==</option>
                                <option value="TUO">TUO</option>
                                <option value="OptimX">OptimX</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Notes<br>(if any):</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="conversion_notes"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="file_online">Upload File<br>PDF/EXCEL ONLY</label>
                        <div class="col-sm-10">
                            <input type="file" required name="qdoci_id" class="form-control" id="file_online" accept="application/pdf,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<form method="POST" id="salesCalForm" style="display:none;">
    <input type="hidden" name="invoice_num" value="" id="invoice_num_calc">
    <input type="hidden" name="order_num" value="" id="order_num_calc">
    <input type="hidden" name="invoice_link" value="" id="invoice_link_calc">
    <input type="hidden" name="is_modal_open" value="1">
</form>

<div class="modal fade" id="convNoteModal" tabindex="-1" role="dialog" aria-labelledby="convNoteModal1" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex">
                    <h3 class="modal-title" style="float:left;" id="convNoteModal1">Sales Person Note</h3>
                    <button type="button" style="float:right;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="container">
                    <h5 id="conv_note_final">
                        </5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade default-Modal" id="requestByEditModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="flex-header modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title">Select Quotation Request by</h4>
            </div>
            <div class="modal-body" style="max-height: 500px;">

                <input type="hidden" id="edit_reqby_qdoc_id" value="">
                User : <select id="edit_reqby_user_id">
                    <?php
                    $sql_user = " SELECT id,fullname,username FROM user WHERE enable=1 AND user_group_id IN (1,99,2) ORDER BY fullname ASC;";
                    $a_user_data = Yii::app()->db->createCommand($sql_user)->queryAll();
                    for ($i = 0; $i < sizeof($a_user_data); $i++) {
                        echo '<option value="' . $a_user_data[$i]["id"] . '" sales_name="' . $a_user_data[$i]["fullname"] . '">' . $a_user_data[$i]["fullname"] . ' (' . $a_user_data[$i]["username"] . ')</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="modal-footer">
                <button style="float:right;" type="button" class="btn btn-success" onclick="return submitReqByEdit();">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Initially hide all forms
        $(".converToquote").hide();

        $('#quote_table').on('click', '.editIcon', function(event) {
            event.stopPropagation(); // Prevent the event from bubbling up
            // Toggle the specific form related to the clicked icon
            const form = $(this).closest('.payment-term').find('.converToquote');
            form.toggle();
        });

        // Hide the form if clicked outside any payment-term
        $(document).click(function(event) {
            if (!$(event.target).closest('.payment-term').length) {
                $(".converToquote").hide();
            }
        });
    });


    $(document).ready(function() {
        $('#quote_table').on('click', '.credit_card_3', function(event) {
            var $form = $(this).closest('form');
            var conv_id = $form.find('.conv_id').val();
            var credit_card_3 = $(this).is(':checked') ? 1 : 0;
            console.log(conv_id);
            $.ajax({
                url: '<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/updatecreditcard', // Replace with your server URL
                type: 'POST',
                data: {
                    conv_id: conv_id,
                    credit_card_3: credit_card_3
                },
                success: function(response) {
                    console.log('Success:', response);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>
<script>
    function fetchSrNote(conv_id) {
        $.ajax({
            type: 'POST',
            data: {
                conv_id: conv_id
            },
            url: '<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/fetchNote',
            success: function(response) {
                var response = JSON.parse(response);
                if (response.status == 1) {
                    $('#conv_note_final').html(response.msg);
                    $('#convNoteModal').modal('show');
                } else {
                    alert('Something went wrong');
                }
            }
        })
    }

    function deleteConv(conv_id) {
        if (confirm('Do you really want to Delete?')) {
            $.ajax({
                type: 'POST',
                data: {
                    conv_id: conv_id
                },
                url: '<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/deleteConv',
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status == 1) {
                        location.reload();
                    } else {
                        alert('Something Went Wrong');
                    }
                }
            })
        }
    }

    function approveConv(conv_id) {
        if (confirm('Do you really want to approve?')) {
            $.ajax({
                type: 'POST',
                data: {
                    conv_id: conv_id
                },
                url: '<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/approveConv',
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status == 1) {
                        location.reload();
                    } else {
                        alert('Something Went Wrong');
                    }
                }
            })
        }
    }

    function submitCalc(qdoci_id, inv_link, full_name, year, inv_no) {
        $.ajax({
            type: 'POST',
            data: {
                qdoci_id: qdoci_id
            },
            url: '<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/fetchOrderNum',
            success: function(response) {
                var response = JSON.parse(response);
                if (response.status == 1) {
                    var order_num = response.data;
                    $('#invoice_num_calc').val(inv_no);
                    $('#order_num_calc').val(order_num);
                    $('#invoice_link_calc').val(inv_link);
                    var url = "calculator/SalesCommission/year/" + year + "/sales/" + full_name;
                    $('#salesCalForm').attr('action', url);
                    $("#salesCalForm").submit();
                } else {
                    alert('Something Went Wrong');
                }
            }
        })
    }

    $(document).on('submit', '#upload_sample', function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = new FormData(form[0]);
        $.ajax({
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            url: "<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/uploadFreebies",
            success: function(response) {
                var response = JSON.parse(response);
                if (response.status == 1) {
                    location.reload();
                } else {
                    alert('Something Went Wrong');
                }
            }
        })
    })

    function openQuotationData(type, conv_id, file_name, notes) {
        var html = '';
        html += '<div class="form-group">' +
            '<label for="exampleInputEmail111">Notes For Admin <span style="color:red;">* Do not use apostrophes</span></label>' +
            '<textarea class="form-control" name="notes_admin" id="exampleInputEmail111">' + atob(notes) + '</textarea>' +
            '</div>';
        if (type == 1) {
            $('#freebModal1').html('Remake Quote/Invoice');
            $('#exampleInputEmail1').attr('required', false);
            $('#conv_type').val(1);
            $('#note_div').empty();
            $('#note_div').append(html);
        } else if (type == 2) {
            $('#freebModal1').html('Sample Quote/Invoice');
            $('#exampleInputEmail1').attr('required', false);
            $('#conv_type').val(2);
            $('#note_div').empty();
            $('#note_div').append(html);
        } else if (type == 3) {
            $('#freebModal1').html('Complimentary Quote/Invoice');
            $('#exampleInputEmail1').attr('required', false);
            $('#conv_type').val(3);
            $('#note_div').empty();
            $('#note_div').append(html);
        } else {
            $('#freebModal1').html('Online Store Report');
            $('#exampleInputEmail1').attr('required', true);
            $('#conv_type').val(4);
            $('#note_div').empty();
        }
        $('#main_conv_id').val(conv_id);
        if (file_name.length > 0) {
            var fileExt = file_name.split('.').pop();
            if (fileExt == 'pdf') {
                var url = "upload/samples/" + file_name;
                $('#pdf_source').attr('src', url);
                $('#live_view').hide();
                $('#pdf_source').show();
            } else {
                var baseURL = '<?php echo Yii::app()->request->getBaseUrl(true); ?>';
                var url = "https://view.officeapps.live.com/op/embed.aspx?src=" + baseURL + "/upload/samples/" + file_name;
                $('#live_view').attr('src', url);
                $('#pdf_source').hide();
                $('#live_view').show();
            }
        } else {
            $('#pdf_source').hide();
            $('#live_view').hide();
        }
    }

    function changeQuoteHeadApp() {

        var head_select = $('#head_selector_app').val();

        var obj_comp = $.parseJSON(window.atob($('#hide_comp_info_app' + head_select).val()));

        //alert( window.atob($('#hide_comp_info'+head_select).val()) );

        var head_img_logo = "";
        if (obj_comp.comp_logo != "" && obj_comp.comp_logo != null) {
            head_img_logo = '<img style="max-height: 180px; max-width: 180px;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/' + obj_comp.comp_logo + '" >';
            $('#head_img_logo_app').html(head_img_logo);
        } else {
            $('#head_img_logo_app').html('');
        }

        //alert(obj_comp.have_vat);

        if (obj_comp.have_vat == "1") {
            $('.subnvat').show();
        } else {
            $('.subnvat').hide();
        }

        var pre_comp_info = '<b>' + obj_comp.comp_name + '</b><br>' + obj_comp.comp_info;
        $('#pre_comp_info_app').html(pre_comp_info);

        $('#note_text').val(obj_comp.qnote_text);

    }

    $(document).on('click', '.add_row', function() {
        var qdoc_id = $(this).attr("qdoc_id");
        $.ajax({
            type: 'POST',
            data: {
                qdoc_id: qdoc_id
            },
            url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/add_product",
            success: function(response) {
                var response = JSON.parse(response);
                if (response.status == 1) {
                    var qdoci_id = response.qdoci_id;
                    var html = '';
                    html += '<tr>' +
                        '<td style="padding: 10px 0px; text-align: left; display: block; white-space: pre-wrap; word-break: break-all; word-wrap: break-word;">' +
                        '<input type="hidden" name="qdoci_id[]" value="' + qdoci_id + '" /><input style="width: 100%; font-weight: bold;" type="text" name="pro_name[]" value="" /><br />' +
                        '<textarea style="width: 100%; min-height: 70px;" name="pro_desc[]"></textarea>' +
                        '</td>' +
                        '<td style="text-align: center; color: #999;">' +
                        '<input type="hidden" value="' + qdoci_id + '" class="qdoci_id_app" /><input type="hidden" value="0" id="tmp_amount' + qdoci_id + '" />' +
                        '<input name="app_comm_percent[]" onchange="return calComm();" onkeyup="return calComm();" style="width: 60px; text-align: center;" min="0" type="number" value="0" id="comm_percent_app' + qdoci_id + '" />' +
                        '</td>' +
                        '<td style="text-align: center; color: #999;" id="comm_val_app' + qdoci_id + '"></td>' +
                        '<td style="text-align: center;"><input name="app_qty[]" onchange="return calPriceVA();" onkeyup="return calPriceVA();" style="width: 55px; text-align: center;" min="0" type="number" value="1" id="app_qty' + qdoci_id + '" /></td>' +
                        '<td style="text-align: right;"><input name="app_uprice[]" onchange="return calPriceVA();" onkeyup="return calPriceVA();" style="width: 70px; text-align: center;" min="0.00" type="number" value="0" id="app_uprice' + qdoci_id + '" /></td>' +
                        '<td style="text-align: center;">$<span id="sp_app_amount' + qdoci_id + '">0</span></td>' +
                        '<td style="text-align: center;cursor:pointer;" qdoci_id="' + qdoci_id + '"" class="remover"><i style="color: red;" class="fa fa-minus-circle"></i></td>' +
                        '</tr>';
                    $('.number_disc_approval').val(0);
                    $('#actual_disc_approval').val(0);
                    var tr_counter = $('#tr_total').val();
                    var lengther = 5;
                    if (tr_counter == 1) {
                        lengther = 6;
                    }
                    var rowCount = $('#product_list tr').length - lengther;
                    $('#product_list > tbody > tr').eq(rowCount - 3).after(html);
                }
            }

        })
    })

    $(document).on('click', '.remover', function() {
        var el = $(this);
        var qdoci_id = el.attr('qdoci_id');
        if (confirm('Are you sure?')) {
            $.ajax({
                type: 'POST',
                data: {
                    qdoci_id: qdoci_id
                },
                url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/delete_product',
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status == 1) {
                        el.parent("tr:first").remove();
                        calPriceVA();
                        calComm();
                    }
                }
            })
        }
        // $(this).parent("tr:first").remove();
    })

    function calPriceVA() {

        var amount_total = 0.0;
        $('.qdoci_id_app').each(function() {
            var qdoci_id = $(this).val();

            row_qty = $('#app_qty' + qdoci_id).val();
            row_uprice = $('#app_uprice' + qdoci_id).val();

            amount_val = row_qty * row_uprice;

            $('#sp_app_amount' + qdoci_id).html(amount_val.toFixed(2));
            $('#tmp_amount' + qdoci_id).val(amount_val.toFixed(2));

            amount_total += amount_val;
        });

        $('#sp_app_sub_total').html(amount_total.toFixed(2));

        $('#sub_total_app').val(amount_total);
        tmp_vat = amount_total * 0.07;
        $('#vat_value_app').val(tmp_vat);
        $('.number_disc_approval').val(0);
        $('#actual_disc_approval').val(0);
        changeIncludeVATApprove();
        calComm();

    }

    function calComm() {

        var comm_total = 0.0;
        $('.qdoci_id_app').each(function() {
            var row_id = $(this).val();

            tmp_amount = $('#tmp_amount' + row_id).val();
            comm_percent = $('#comm_percent_app' + row_id).val();

            comm_val = (comm_percent / 100) * tmp_amount;

            $('#comm_val_app' + row_id).html(comm_val.toFixed(2));

            comm_total += comm_val;
        });

        $('#td_comm_total').html(comm_total.toFixed(2));

    }

    function formsplit(id) {
		$("#formsplite"+id+"").toggle();		
	}


	function submitForm(qdoci_id) {
		let form = document.getElementsByClassName("form__submit");
		event.preventDefault();
                
		var salesRep1 = $('select[name="sales_rep_1'+qdoci_id+'"]').eq(0).val();
		var salesRep2 = $('select[name="sales_rep_2'+qdoci_id+'"]').eq(0).val();
		var percent1 = $('input[name="split_comm_percent_1'+qdoci_id+'"]').val();
		var percent2 = $('input[name="split_comm_percent_2'+qdoci_id+'"]').val();
		
		
		// Calculate total percentage
		var totalPercent = parseInt(percent1) + parseInt(percent2);

		// Send AJAX request
		$.ajax({
			type: 'POST',
			url: "<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/Splitcomm", // Replace with your server endpoint
			data: {
				sales_rep_1: salesRep1,
				sales_rep_2: salesRep2,
				split_comm_percent1: percent1,
				split_comm_percent2: percent2,
				qdoci_id: qdoci_id
			},
			success: function (response) {
				// Update the app_comm_percent input field
				$('#comm_percent_app'+qdoci_id+'').val(totalPercent);
				console.log(response); // Log the response for debugging
				calComm();
			},
			error: function (error) {
				console.error('Error:', error);
			}
		});
	}

    function changeIncludeVATApprove() {

        var total_value = 0.0;

        if ($('#inc_vat_app').prop("checked")) {

            var vat_value = parseFloat($('#vat_value_app').val());

            var sub_tt = parseFloat($('#sp_app_sub_total').html());
            var discount = (parseFloat($('.number_disc_approval').val()) / 100) * sub_tt;

            var final_after_disc = (sub_tt - discount).toFixed(2);
            var new_vat = parseFloat((7 / 100) * final_after_disc).toFixed(2);
            $('#sp_show_vat_value_app').html($('#pre_cost_app').val() + new_vat);

            //var sub_total = parseFloat($('#sub_total').val());

            total_value = parseFloat(final_after_disc) + parseFloat(new_vat);
            $('#sp_show_total_value_app').html($('#pre_cost_app').val() + parseFloat(total_value).toFixed(2));
            $('#total_value_app').val(parseFloat(total_value).toFixed(2));
            $('#sp_show_gtotal_value_app').html($('#pre_cost_app').val() + parseFloat(total_value).toFixed(2));
            //$('#gtotal_value').val(total_value);
            $('#td_grand_total_app').html($('#pre_cost_app').val() + parseFloat(total_value).toFixed(2));
        } else {
            $('#sp_show_vat_value_app').html('');
            var sub_tt = parseFloat($('#sp_app_sub_total').html());
            var discount = (parseFloat($('.number_disc_approval').val()) / 100) * sub_tt;

            var final_after_disc = (sub_tt - discount).toFixed(2);
            total_value = parseFloat(final_after_disc);
            $('#sp_show_total_value_app').html($('#pre_cost_app').val() + total_value.toFixed(2));
            $('#total_value_app').val(total_value);
            $('#sp_show_gtotal_value_app').html($('#pre_cost_app').val() + total_value.toFixed(2));
            $('#td_grand_total_app').html($('#pre_cost_app').val() + total_value.toFixed(2));
            //$('#gtotal_value').val(total_value);
        }

    }

    function changeIncludeVATApprove2() {

        var total_value = 0.0;

        if ($('#inc_vat_app').prop("checked")) {

            var vat_value = parseFloat($('#vat_value_app').val());

            var sub_tt = parseFloat($('#sp_app_sub_total').html());
            var discount = parseFloat($('#actual_disc_approval').val());

            var final_after_disc = (sub_tt - discount).toFixed(2);
            var new_vat = parseFloat((7 / 100) * final_after_disc).toFixed(2);
            $('#sp_show_vat_value_app').html($('#pre_cost_app').val() + new_vat);

            //var sub_total = parseFloat($('#sub_total').val());

            total_value = parseFloat(final_after_disc) + parseFloat(new_vat);
            $('#sp_show_total_value_app').html($('#pre_cost_app').val() + parseFloat(total_value).toFixed(2));
            $('#total_value_app').val(parseFloat(total_value).toFixed(2));
            $('#sp_show_gtotal_value_app').html($('#pre_cost_app').val() + parseFloat(total_value).toFixed(2));
            //$('#gtotal_value').val(total_value);
            $('#td_grand_total_app').html($('#pre_cost_app').val() + parseFloat(total_value).toFixed(2));
        } else {
            $('#sp_show_vat_value_app').html('');
            var sub_tt = parseFloat($('#sp_app_sub_total').html());
            var discount = parseFloat($('#actual_disc_approval').val());

            var final_after_disc = (sub_tt - discount).toFixed(2);
            total_value = parseFloat(final_after_disc);
            $('#sp_show_total_value_app').html($('#pre_cost_app').val() + total_value.toFixed(2));
            $('#total_value_app').val(total_value);
            $('#sp_show_gtotal_value_app').html($('#pre_cost_app').val() + total_value.toFixed(2));
            $('#td_grand_total_app').html($('#pre_cost_app').val() + total_value.toFixed(2));
            //$('#gtotal_value').val(total_value);
        }

    }

    function viewQuotationFinalDraftAdmin(qdoc_id, action_from, jog_code_main, conv_id) {

        $('#main_qdoc_id').val(qdoc_id);
        $('#view_doc_id').val(btoa(qdoc_id));
        $('#quote_approve_bar').show();

        $('#d_quote_body').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');

        $('#head_selector_app').hide();
        $('#btn_approve').hide();
        $('#btn_reject').hide();
        $('#btn_print').hide();
        $('#btn_refresh_date').hide();
        //$('#d_quote_below').hide();
        $('#sp_remark').hide();
        if (action_from != "va") {
            $('#note_text').hide();
        } else {
            $('#note_text').show();
        }

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/showQuoteViewAdminDraft",
            data: {
                "qdoc_id": qdoc_id,
                "action_from": action_from,
                "jog_code_main": jog_code_main
            },
            success: function(resp) {
                $('#d_quote_body').html(resp.inner_content);

                $('#quote_history').hide();

                $('#d_approval_comment').html(window.atob(resp.approval_comment));
                $('#btn_approve').hide();
                $('#btn_reject').hide();
                $('#btn_print').show();
                // $('#note_text').val(resp.note_text);
                // $('#d_quote_body').html(resp.inner_content); 
                // $('#btn_approve').attr('conv_id',conv_id);
                // $('#quote_history').hide();

                // $('#d_approval_comment').html(window.atob(resp.approval_comment));

                //     if(action_from!="va"){
                //     $('#d_quote_below').show();
                //     $('#sp_remark').show();
                //     $('#btn_print').show();
                //     }
                //     //$('.subnvat').hide();

                //     if(action_from=='va'){
                //         $('#btn_reject').show();
                //         $('#btn_approve').show();
                //         $('#head_selector_app').show();
                //         $('#head_selector_app').val(resp.comp_id);
                //         $('#note_text').val(resp.note_text);
                //         changeQuoteHeadApp();
                //     }

                //     //alert(resp.history_inner);
                //     if(resp.history_inner!=""){
                //         $('#quote_history').show();
                //         $('#select_history').html(resp.history_inner);
                //     }

                // if(resp.show_reject=="yes"){
                //     $('#btn_reject').show();
                //     $('#sp_remark').show();
                // }
                // if( resp.show_print=="yes" ){
                //     //if(action_from=="vp"){
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
                            var html = '';
                            html = atob(response.msg);
                            $('#d_approval_comment').append(html);
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

    function viewQuotationFinal(qdoc_id, action_from, jog_code_main, conv_id) {

        $('#main_qdoc_id').val(qdoc_id);
        $('#view_doc_id').val(btoa(qdoc_id));
        $('#quote_approve_bar').show();

        $('#d_quote_body').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');

        $('#head_selector_app').hide();
        $('#btn_approve').hide();
        $('#btn_reject').hide();
        $('#btn_print').hide();
        $('#btn_refresh_date').hide();
        //$('#d_quote_below').hide();
        $('#sp_remark').hide();
        if (action_from != "va") {
            $('#note_text').hide();
        } else {
            $('#note_text').show();
        }

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/showQuoteView",
            data: {
                "qdoc_id": qdoc_id,
                "action_from": action_from,
                "jog_code_main": jog_code_main
            },
            success: function(resp) {
                $('#note_text').val(resp.note_text);
                $('#d_quote_body').html(resp.inner_content);
                $('#btn_approve').attr('conv_id', conv_id);
                $('#quote_history').hide();

                $('#d_approval_comment').html(window.atob(resp.approval_comment));

                if (action_from != "va") {
                    $('#d_quote_below').show();
                    $('#sp_remark').show();
                    $('#btn_print').show();
                }
                //$('.subnvat').hide();

                if (action_from == 'va') {
                    $('#btn_reject').show();
                    $('#btn_approve').show();
                    $('#head_selector_app').show();
                    $('#head_selector_app').val(resp.comp_id);
                    $('#note_text').val(resp.note_text);
                    changeQuoteHeadApp();
                }

                //alert(resp.history_inner);
                if (resp.history_inner != "") {
                    $('#quote_history').show();
                    $('#select_history').html(resp.history_inner);
                }

                if (resp.show_reject == "yes") {
                    $('#btn_reject').show();
                    $('#sp_remark').show();
                }
                if (resp.show_print == "yes") {
                    //if(action_from=="vp"){
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
                            var html = '';
                            html = atob(response.msg);
                            $('#d_approval_comment').append(html);
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

    $(document).on('change', '#viewQuotationNewFinal', function() {
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
        $('#btn_reject').hide();
        $('#btn_print').hide();
        $('#btn_refresh_date').hide();
        //$('#d_quote_below').hide();
        $('#sp_remark').hide();
        if (action_from != "va") {
            $('#note_text').hide();
        } else {
            $('#note_text').show();
        }

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/showQuoteViewCurrChange",
            data: {
                "qdoc_id": qdoc_id,
                "action_from": action_from,
                "symbol": symbol,
                "curr_id": curr_id,
                "old_curr_id": old_curr_id
            },
            success: function(resp) {
                $('#d_quote_body').html(resp.inner_content);
                $('#note_text').val(resp.note_text);

                $('#quote_history').hide();

                $('#d_approval_comment').html(window.atob(resp.approval_comment));
                if (action_from != "va") {
                    $('#btn_print').show();
                    $('#d_quote_below').show();
                    $('#sp_remark').show();
                }
                //$('.subnvat').hide();

                if (action_from == 'va') {
                    $('#btn_reject').show();
                    $('#btn_approve').show();
                    $('#head_selector_app').show();
                    $('#head_selector_app').val(resp.comp_id);
                    $('#note_text').val(resp.note_text);
                    changeQuoteHeadApp();
                }

                //alert(resp.history_inner);
                if (resp.history_inner != "") {
                    $('#quote_history').show();
                    $('#select_history').html(resp.history_inner);
                }

                if (resp.show_reject == "yes") {
                    $('#btn_reject').show();
                    $('#sp_remark').show();
                }
                if (resp.show_print == "yes") {
                    //if(action_from=="vp"){

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
                            var html = '';
                            html = atob(response.msg);
                            $('#d_approval_comment').append(html);
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

    function editPONumber(qdoc_id) {

        var po_number = $('#sp_po_number' + qdoc_id).html();

        var new_po_number = prompt("PO Number:", po_number);

        if (new_po_number != null) {

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/editPONumber",
                data: {
                    "qdoc_id": qdoc_id,
                    "po_number": window.btoa(new_po_number)
                },
                success: function(resp) {
                    if (resp.result == "success") {

                        $('#sp_po_number' + qdoc_id).html(new_po_number);

                    } else {
                        alert(resp.msg);
                    }


                }
            });
        }

    }

    function quotationApproveFinal() {

        if (confirm("Confirm to save this Quotation?")) {

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/approveQuote",
                data: $('#app_quote').serialize(),
                success: function(resp) {
                    if (resp.result == "success") {
                        $('#quoteDocModal').modal('hide');
                        //location.reload();

                    } else {
                        alert(resp.msg);
                    }
                }
            });

        }

    }

    $(document).on('click', '.quotationApproveFinalApprove', function() {
        var conv_id = $(this).attr('conv_id');
        if (confirm("Confirm to approve this Quotation?")) {

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/approveQuoteFinal",
                data: $('#app_quote').serialize(),
                success: function(resp) {
                    if (resp.result == "success") {
                        $.ajax({
                            type: 'POST',
                            data: {
                                conv_id: conv_id
                            },
                            url: "<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/quoteFinalEmail",
                            success: function(response) {
                                $('#view_approve_' + conv_id).removeClass("btn-primary");
                                $('#view_approve_' + conv_id).addClass("btn-success");
                                $('#view_approve_' + conv_id).text("Approved");
                                $('#quoteDocModal').modal('hide');
                            }
                        })
                    } else {
                        alert(resp.msg);
                    }
                }
            });

        }
    })

    function refreshDate() {
        var qdoc_id = $('#main_qdoc_id').val();
        if (confirm("This action will update Estimate Date and Expire Date permanently. Confirm?")) {

            $('#show_est_date').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>');
            $('#show_exp_date').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>');

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/refreshDate",
                data: {
                    "qdoc_id": qdoc_id
                },
                success: function(resp) {
                    if (resp.result == "success") {

                        $('#show_est_date').html(resp.est_date);
                        $('#show_exp_date').html(resp.exp_date);

                    } else {
                        alert(resp.msg);
                    }


                }
            });
        }

    }

    // function printQuotation(){

    // 	var qdoc_number = $("#qdoc_number").html();
    //     var jog_code    = $('#jog_code').html();
    // 	var divContents = $("#d_quote_body").html();
    //     var printWindow = window.open('', '', 'height=2000,width=1200');
    //     printWindow.document.write('<html><head><title>'+qdoc_number+' '+jog_code+'</title>');
    //     printWindow.document.write('</head><body >');
    //     printWindow.document.write(divContents);
    //     printWindow.document.write('</body></html>');
    //     printWindow.document.close();
    //     printWindow.print();

    // }

    function printQuotation() {
        var qdoc_number = $("#qdoc_number").html();
        var jog_code = $('#jog_code').html();
        var divContents = $("#d_quote_body").clone(); // Create a copy of the content

        // Remove the unwanted anchor tags
        divContents.find("a").remove();
        divContents.find("span:contains('\u2022')").remove();

        var printWindow = window.open('', '', 'height=2000,width=1200');
        printWindow.document.write('<html><head><title>' + qdoc_number + ' ' + jog_code + '</title>');
        printWindow.document.write('</head><body>');
        printWindow.document.write(divContents.html()); // Print the modified content
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }

    function editCommAfterApprove(qdoc_id, qdoci_id, comm_percent) {

        var new_comm = prompt("Edit Commission percent:", comm_percent);

        if (new_comm != null) {
            //alert('qdoc_id='+qdoc_id+',qdoci_id='+qdoci_id+',comm_percent='+comm_percent+',new_comm='+new_comm);

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/editCommAfterApprove",
                data: {
                    "qdoci_id": qdoci_id,
                    "new_comm": new_comm,
                    "qdoc_id": qdoc_id,
                    "comm_percent": comm_percent
                },
                success: function(resp) {
                    if (resp.result == "success") {

                        viewQuotation(qdoc_id, 'vc');

                    } else {
                        alert(resp.msg);
                    }


                }
            });
        }

    }

    function editUPriceAfterApprove(qdoc_id, qdoci_id, uprice) {

        var new_uprice = prompt("Edit Price:", uprice);

        if (new_uprice != null) {

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/editUPriceAfterApprove",
                data: {
                    "qdoc_id": qdoc_id,
                    "qdoci_id": qdoci_id,
                    "new_uprice": new_uprice,
                    "uprice": uprice
                },
                success: function(resp) {
                    if (resp.result == "success") {

                        viewQuotation(qdoc_id, 'vc');

                    } else {
                        alert(resp.msg);
                    }


                }
            });
        }

    }

    function editInvoice(qdoc_id) {

        var inv_show = $('#d_inv' + qdoc_id).html();

        $('#edit_inv_qdoc_id').val(qdoc_id);
        inv_value = inv_show.replace(/<br>/g, ",");

        $('#inv_value').val(inv_value);

    }

    function editInvoiceLink(qdoc_id) {

        var inv_show = $('#d_inv_link' + qdoc_id).html();

        $('#edit_inv_link_qdoc_id').val(qdoc_id);
        inv_value = inv_show.replace(/<br>/g, ",");

        $('#inv_link').val(inv_value);

    }

    function submitInvoiceLink() {

        var qdoc_id = $('#edit_inv_link_qdoc_id').val();
        var inv_value = $('#inv_link').val();

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/submitInvoiceLink",
            data: {
                "qdoc_id": qdoc_id,
                "inv_value": inv_value
            },
            success: function(resp) {
                if (resp.result == "success") {

                    $('#d_inv_link' + qdoc_id).html(resp.inv_show);
                    $('#edit_inv_link_qdoc_id').val('');
                    $('#inv_link').val('');
                    $('#btn_link_view').hide();
                    $('#editINVNOModal').modal("toggle");
                    $('.btn_' + qdoc_id).remove();
                    // Assuming inv_value and qdoc_id are provided correctly in your context
                    var inv_values = inv_value.split(',');

                    // Target the specific table cell by its ID
                    var $target = $('#td_inv_' + qdoc_id);

                    // Remove only anchor tags from the target element
                    $target.find('a').remove();

                    // Iterate over each value from the split
                    inv_values.forEach(function(value) {
                        var trimmedValue = value.trim(); // Trim any extra whitespace
                        if (trimmedValue) {
                            var html = '<a href="' + trimmedValue + '" target="_blank"><button class="btn btn-success btn-md btn_link_view" style="width:100%">View</button></a>';
                            // Prepend the link to the beginning of the target element
                            $target.prepend(html);
                        }
                    });
                } else {
                    alert(resp.msg);
                }


            }
        });

    }

    function submitInvoice() {

        var qdoc_id = $('#edit_inv_qdoc_id').val();
        var inv_value = $('#inv_value').val();

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/submitInvoice",
            data: {
                "qdoc_id": qdoc_id,
                "inv_value": inv_value
            },
            success: function(resp) {
                if (resp.result == "success") {

                    $('#d_inv' + qdoc_id).html(resp.inv_show);
                    $('#edit_inv_qdoc_id').val('');
                    $('#inv_value').val('');

                    $('#editINVModal').modal("toggle");

                } else {
                    alert(resp.msg);
                }


            }
        });

    }

    function duplicateQuote(qdoc_id) {

        if (!confirm("Do you want to duplicate this Quote to Estimate?")) {
            return false;
        }

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/duplicateQuote",
            data: {
                "qdoc_id": qdoc_id
            },
            success: function(resp) {
                if (resp.result == "success") {

                    var url = <?php echo Yii::app()->request->baseUrl; ?> "/quotation/archived";
                    window.location.href = url;

                } else {
                    alert(resp.msg);
                }
            }
        });
    }

    $(document).on('change', '.ship_comp', function() {
        var value = $(this).val();
        var conv_id = $(this).attr("conv_id");
        $.ajax({
            type: 'POST',
            data: {
                value: value,
                conv_id: conv_id
            },
            url: '<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/updateShipping',
            success: function(response) {
                console.log(response);
            }
        })
    })

    $(document).on('click', '.update_shipping', function() {
        var conv_id = $(this).attr('conv_id');
        var value = $('.ship_' + conv_id).val();
        if (value.length == 0) {
            alert('Field can not be left blank!');
            return;
        }
        $.ajax({
            type: 'POST',
            data: {
                conv_id: conv_id,
                value: value
            },
            url: '<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/updateShippingCharges',
            success: function(response) {
                var response = JSON.parse(response);
                if (response.status == 1) {
                    alert('Updated Successfully');
                }
            }
        })
    })

    $(document).on('click', '.update_shipping_with', function() {
        var conv_id = $(this).attr('conv_id');
        var value = $('.ship_with_' + conv_id).val();
        if (value.length == 0) {
            alert('Field can not be left blank!');
            return;
        }
        $.ajax({
            type: 'POST',
            data: {
                conv_id: conv_id,
                value: value
            },
            url: '<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/updateShippingWith',
            success: function(response) {
                var response = JSON.parse(response);
                if (response.status == 1) {
                    alert('Updated Successfully');
                }
            }
        })
    })
</script>