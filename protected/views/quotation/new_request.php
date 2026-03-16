<style type="text/css">
	.glyphicon.spinning {
		animation: spin 1s infinite linear;
		-webkit-animation: spin2 1s infinite linear;
	}

	@keyframes spin {
		from {
			transform: scale(1) rotate(0deg);
		}

		to {
			transform: scale(1) rotate(360deg);
		}
	}

	@-webkit-keyframes spin2 {
		from {
			-webkit-transform: rotate(0deg);
		}

		to {
			-webkit-transform: rotate(360deg);
		}
	}

	.tbl_content th {
		background-color: <?php echo $head_color; ?>;
		color: #FFF;
		padding: 5px;
		text-align: center;
		border: 1px solid #ccc;
		/* Add this line for the border */
	}

	.tbl_content tr:hover td {
		background-color: #EEE;
	}

	.tbl_content td {
		padding: 5px;
		border: 1px solid #ccc;
		/* Add this line for the border */
	}

	#quote_doc_head {
		border-bottom: 2px solid #EEE;
		padding-bottom: 0px;
	}

	#quote_doc_head img {
		max-height: 180px;
		max-width: 180px;
	}

	#quote_doc_head h2 {
		font-size: 28px;
		font-weight: bold;
		color: #000;
	}

	.show_date_reject {
		border: solid 1px #EA6153;
		background-color: #EA6153;
		border-radius: 5px;
		padding: 2px 2px;
		margin: 0px 3px;
		font-size: 11px;
		font-weight: bold;
		color: #FFF;
		height: 18px;
		line-height: 15px;
		vertical-align: middle;
	}

	.show_date_approve {
		background-color: #5CB85C;
		border-radius: 5px;
		padding: 4px 3px;
		margin: 5px 0 5px 0;
		font-size: 12px;
		color: #FFF;
		text-align: center;
		line-height: 1;
		vertical-align: middle;
	}

	.btn {
		font-weight: bold;
		margin: 0 0 2px 0;
		font-size: 11px;
	}

	.cnt_inv {
		font-style: italic;
		font-weight: bold;
		padding: 4px;
		white-space: nowrap;
	}

	.btn_edit_inv {
		font-size: 18px;
		cursor: pointer;
	}

	.label-success {
		font-size: 25px;
		padding: 3px 10px;
	}

	.label-primary {
		font-size: 12px;
		margin: 1px 0;
		padding: 5px 7px !important;
	}

	/*#quote_doc_head pre, #quote_doc_body pre{

    border:0px;
    background-color: #FFF;
    font-size: 14px;
    color: #000;
    line-height: 1;
    margin: 0px;
 
	.edit_ap {
		font-size: 18px;
		color: #F00;
		cursor: pointer;
	}

	.edit_req_by {
		font-size: 16px;
		color: #F00;
		cursor: pointer;
	}


	/*  */
	input#search_word {
		width: 100%;
		height: 38px;
		padding: 10px 45px 10px 20px;
		border-radius: 20px;
		font-size: 15px;
		border: 2px solid #337ab77d;
	}

	form#form_search {
		display: flex;
		align-items: center;
		position: relative;
		justify-content: space-evenly;
		max-width: 300px;
		margin-left: auto;
	}

	form#form_search .btn {
		position: absolute;
		right: 4px;
		top: 0;
		background: #337AB7;
		height: 37px;
		color: #FFF;
		width: 40px;
		border-radius: 50%;
	}

	.page-selecting-total-page {
		background: #999955;
		padding: 4px 20px;
		color: #FFF;
		font-size: 14px;
		border-radius: 20px;
	}

	.page-selecting {
		width: 400px;
		display: flex;
		text-transform: capitalize;
		background: #eee;
		font-size: 15px;
		border-radius: 4px;
		align-items: center;
		justify-content: space-between;
		padding: 5px 15px;
		height: 45px;
	}

	.x_title {
		padding: 15px 0;
		margin-bottom: 10px;
		display: grid;
		grid-template-columns: 1fr 1fr 1fr;
		gap: 10px;
		justify-content: space-between;
	}

	select#page_select {
		/* background: #999955 !important; */
		padding: 4px 5px;
		min-width: 60px;
		text-align: center;
		color: #444;
		border: none;
		border-radius: 20px;
	}

	.x_content {
		padding: 0;
		width: 100%;
		overflow-x: auto;
	}

	#requestByEditModal select {
		height: 40px;
	}

	#requestByEditModal .btn {
		font-size: 15px;
		font-weight: bold;
		padding: 6px 20px;
		margin: 1px;
	}

	#freebModal .form-control {
		font-size: 14px;
		padding: 3px;
		background: #E6EFF6;
		color: #4b555e;
		margin: 10px 0;
	}

	#freebModal input::file-selector-button {
		background: #337AB7;
		color: #FFF;
		border: none;
		padding: 5px 10px;

		font-size: 14px;
		margin-right: 30px;
	}

	input[type=file]:focus,
	input[type=checkbox]:focus,
	input[type=radio]:focus {
		outline: thin dotted;
		outline: navajowhite;
		outline-offset: -2px;
	}

	#freebModal label {
		font-weight: 500;
		font-size: 14px;

	}

	#quoteConvertModal .modal-content {
		overflow-y: scroll;
		overflow-x: hidden;
	}

	#freebModal .btn {
		font-size: 13px;
		font-weight: bold;
		padding: 3px 20px;
		margin: 1px;
		float: inline-end;
	}

	#quoteDocModal select {
		height: 40px;
		width: 100%;
		padding: 6px 10px;
		margin: 12px 0;
	}

	#editINVModal input#inv_value {
		height: 40px;
		width: 100%;
		padding: 6px 10px;
		margin: 12px 0;
	}

	.modal.in img {
		text-align: center;
		margin: 0 auto;
		display: flex;
	}

	#formCart textarea {
		padding: 5px !important;
		font-size: 12px;
	}



	#tbl_cart_info select[multiple],
	select[size] {
		height: 90px !important;
		width: 100%;

	}

	#formCart option[value] {
		padding: 2px;
		/* width: 130px; */
		font-size: 12px;

	}

	#quoteConvertModal .form-control {
		padding: 20px;
	}

	/* #quoteConvertModal .select2-container--default .select2-selection--multiple{
		height:50px;
	} */
	#quoteConvertModal .flex-custom {
		display: flex;
		justify-content: start;
	}

	#quoteConvertModal span.select2.select2-container.select2-container--default {
		width: 100% !important;
	}

	#quoteConvertModal select,
	input {
		/* width: 100%; */
		padding: 6px;
	}


	#quoteConvertModal .checkbox input[type=checkbox],
	.checkbox-inline input[type=checkbox],
	.radio input[type=radio],
	.radio-inline input[type=radio] {
		position: absolute;
		left: 0;
		top: 6px;
		width: 50px;
	}

	#quoteConvertModal .form-horizontal .control-label {
		text-align: left;
		margin-bottom: 9px;
		font-size: 16px;
		font-weight: 500;
		text-transform: uppercase;
	}

	.select2-container .select2-selection--multiple .select2-selection__rendered {
		position: absolute;
		top: 0;
		left: 0;
	}

	.form-horizontal .checkbox,
	.form-horizontal .radio {
		margin-right: 30px;
	}

	.select2-container--default .select2-selection--multiple {
		height: 75px;
	}

	.modal-dialog .col-sm-offset-2 {
		margin: 0 auto;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	#freebModal .modal-content {
		width: 50%;
	}

	form#upload_sample {
		box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
	}

	#freebModal .modal-title {
		font-size: 17px;
	}

	iframe#pdf_source {
		height: 50vh;
	}

	#freebModal .modal-body {
		position: relative;
		padding: 15px;
		width: 100%;
		display: inline-block;
		align-items: center;
		justify-content: center;
		flex-direction: row;


	}

	#freebModal .modal-dialog {
		transition: .5s ease-in-out;
		margin: 0 auto;
		max-width: 100% !important;
		width: 100%;
	}

	form#upload_sample {
		align-self: flex-start;
		padding: 20px;
		margin: 20px 0;
		/* border: 1px solid #00000052; */
	}

	iframe#pdf_source iframe#pdf_source {
		width: 50%;
	}


	#requestByEditModal select {
		width: 100%;
		padding: 10px;
	}

	.form-side {
		width: auto;
	}

	.pdf-side .card {
		box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
	}

	.x_content .btn {
		margin: 0 0 2px 0;
		font-size: 11px;
		padding: 6px 8px;
	}

	#cartV2Modal .CartTextarea {
		width: 100%;
	}

	.tbl_content th:nth-child(4) {
		width: 200px;
	}

	.POnumberForApproved {
		/* display: -webkit-box;
		width: 124px;
		overflow-x: scroll;
		scrollbar-width: none;
		height: 115px;
		border: none !important;
		border-top: 1px solid #CCC !important;
		word-break: break-word !important; */

		word-break: break-word !important;
		grid-template-columns: 1fr;
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

	#quoteDocModal #btn_approve {
		margin-right: 10px;
	}

	#cartV2Modal #cart_inner {
		overflow: scroll;
		scrollbar-width: thin !important;
	}

	#cartV2Modal #cart_inner .alert.alert-danger {
		position: sticky;
		width: 100%;
		left: 0;
		top: 0;
	}

	#cartV2Modal #cart_inner .tbl-cart-info {
		margin: 0;
	}

	.actionGridBtns {
		min-width: 130px; 
		    display: flex;
    flex-wrap: wrap; 
    gap: 2px;
    justify-content: end;
	}
	.actionGridBtns .btn {
		padding: 4px;
	}


	@media screen and (min-device-width: 520px) and (max-device-width: 1400px) {
		/* .tbl_content td {
			padding: 0 0 0 5px;
			text-align: center;
		} */

		.show_date_approve {
			padding: 8px 1px;
			margin: 5px 1px;
			font-size: 11px;
		}

		.label-primary {
			padding: 8px 1px;
			margin: 0 1px;
			font-size: 11px;
			font-size: 11px;
		}


		.tbl_content th {
			font-size: 12px;
			padding: 3px;
		}

		.label-success {
			padding: 5px 9px;
		}
	}

	@media screen and (max-width:1320px) {
		/* .tbl_content td {
			font-size: 11px;
		} */

		.x_content .tbl_content span.label.label-success {
			font-weight: 100 !important;
			font-size: 11px !important;
			padding: 4px 5px;
		}

		.x_content .tbl_content .btn-success {
			font-weight: 100 !important;
			font-size: 11px !important;
			padding: 4px 5px;
		}

		.show_date_approve {
			padding: 5px 1px;
			margin: 4px 1px;
			font-size: 11px;
			font-weight: 400 !important;
		}

		.label-success {
			line-height: 25px;
		}
	}

	@media screen and (max-width:1220px) {
		#quoteConvertModal .modal-dialog {
			width: 70%;
		}
	}

	@media screen and (max-width:520px) {
		.x_title {
			flex-direction: column;
			padding: 0 0 30px 0;
			align-items: flex-start;

		}

		.tbl_content td {
			font-size: 11px;
			white-space: nowrap;
		}

		.tbl_content td .btn {

			font-size: 10px;
			padding: 2px;
		}

		.tbl_content th {

			padding: 8px;
			font-size: 11px;
			white-space: pre;
			font-weight: 500;
		}

		form#form_search .btn {
			height: 33px;
			width: 33px;
		}

		input#search_word {
			height: 33px;
			padding: 15px 12px;
			font-size: 12px;
		}




		.x_title h2 {
			width: 100%;
			font-size: 14px;
		}

		.show_date_reject {
			height: auto !important;
			font-weight: 400;
		}

		#quoteConvertModal .modal-dialog {
			width: 100%;
		}

		#freebModal .modal-body {
			flex-direction: column;
		}

		form#upload_sample {
			width: 100%;
			padding: 20px;
			margin: 20px 0;
		}

		iframe#pdf_source {
			width: 100%;
		}

		.modal-body .h4,
		.h5,
		.h6,
		h4,
		h5,
		h6 {
			line-height: 30px;
		}

		#freebModal label {
			font-size: 13px;
		}

		#freebModal .form-control {

			margin: 5px 0;
		}

		.page-selecting {
			width: 100%;
			margin: 0 0 10px 0;
			font-size: 13px;
		}

		.modal-title {
			font-size: 18px;
		}



		#college-table {
			overflow-x: scroll;
		}

		#quote_approve_bar .btn {
			margin: 5px 0 5px 10px;
		}

		#app_quote textarea {
			min-height: 100px !important;
			width: 100% !important;
		}

		.modal.in table td {
			width: 300px;
		}

		.x_content {
			margin: 0;
		}

		.page-selecting-total-page {
			border-radius: 2px;
			height: 25px;
			font-size: 12px;
		}

		select#page_select {
			border-radius: 2px;
			height: 25px;
			font-size: 12px;
		}

		#formCart textarea {

			font-size: 14px;
		}

		#freebModal .modal-content {
			width: 100%;
		}
	}

	#quoteDocModal .modal-content {
		height: 100vh;
		overflow: scroll;
	}

	.btn-sort {
		color: #337AB7;
		font-size: 20px;
		padding: 2px;
		cursor: pointer;
	}

	.sortDiv {
		display: flex;
		flex-direction: column;
	}

	/*  */

/* ============= Customer logs style  */

	/*-----------customer log  */
	.switch {
		position: relative;
		display: inline-block;
		width: 60px;
		height: 25px;
	}

	.switch input {
		opacity: 0;
		width: 0;
		height: 0;
	}

	input:checked+.slider {
		background-color: #2196F3;
	}

	input:focus+.slider {
		box-shadow: 0 0 1px #2196F3;
	}

	input:checked+.slider:before {
		-webkit-transform: translateX(26px);
		-ms-transform: translateX(26px);
		transform: translateX(26px);
	}

	.slider {
		position: absolute;
		cursor: pointer;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: #ccc;
		-webkit-transition: .4s;
		transition: .4s;
	}

	.slider.round {
		border-radius: 34px;
	}

	.slider.round:before {
		border-radius: 50%;
	}

	.slider:before {
		position: absolute;
		content: "";
		height: 20px;
		width: 20px;
		left: 4px;
		bottom: 3px;
		background-color: white;
		-webkit-transition: .4s;
		transition: .4s;
	}

	.customer_log_container .d-none {
		display: none !important;
	}



	.customer-name {
		font-weight: bold;
		margin: 15px 0;
		font-size: 15px;
	}



	.total-row {
		background: #666;
		font-weight: bold;
		text-align: right;
		padding: 12px;
		border-radius: 3px;
	}

	.total-row td {
		margin-left: 20px;
		color: #fff;

	}

	.customer_log_tbl {
		border-collapse: separate;
		border: 1px solid #D9E4EE;
		border-radius: 5px;
		/* border-spacing: 7px !important; */
	}

	.customer_log_tbl thead {
		border: none !important;
		background-color: #324556;
		height: 40px;
	}

	.customer_log_tbl thead th {
		background: transparent !important;
		border-right: none !important;
		font-size: 15px !important;
		font-weight: 700;
		
	}
	.customer_log_tbl thead th {
		 color: #fff !important;
	}

	.customer_log_tbl tr td {
		/* border: none !important; */
		/* width: 68px; */
		border-color: #D9E4EE !important;
		color: #2A3F54 !important;
	}

	.customer_log_tbl .year_box td {
		border: 1px solid #000 !important;
	}

	/* tool tip for customer log  */


.tooltip_test {
  position: relative;
  cursor: pointer;
}

/* Tooltip text */
.tooltiptext {
  visibility: hidden; /* Hidden by default */
  width: 130px;
  background-color: black;
  color: #fff;
  text-align: center;
  padding: 5px 0;
  border-radius: 6px;
  position: absolute;
  text-decoration: none;
  z-index: 1; /* Ensure tooltip is displayed above content */
      top: 0;
    left: 0;
}

/* Show the tooltip text on hover */
.tooltip_test:hover .tooltiptext {
  visibility: visible;
}
.action-fields-td .btn {
	padding: 4px;
}
.allBtns{
	    display: flex;
    flex-wrap: wrap; 
    gap: 2px;
	min-width: 130px;
    justify-content: end;
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

?>

<div class="row">







	<div class="col-md-12 col-sm-12 col-xs-12">



		<div class="x_panel">



			<div class="x_title">



				<div>

					<h2>Estimate > <?php echo $page_title; ?></h2>

					<input type="hidden" id="edit_reject_quote" value="no">

				</div>



				<div class="page-selecting">

					<div class=" d-flex gap2 nowrapDesktop">
						<h6 class="sSize">Found</h6>
						<font class="page-selecting-total-page"><?php echo number_format($num_data); ?></font>
						<h6 class="sSize">Rows</h6>
					</div>

					<div class=" d-flex gap2 nowrapDesktop">
						<h6 class="sSize">Page:</h6>
						<select id="page_select" onchange="changePage('<?php echo $act_page; ?>');">

							<?php

							for ($i = 1; $i <= $num_page; $i++) {

								echo '<option value="' . $i . '" ';

								if ($i == $page) {

									echo 'selected';
								}

								echo '>' . $i . '</option>';
							}
							?>
						</select> / <?php echo $num_page; ?>

					</div>
				</div>

				<div>

					<form id="form_search" method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/quotation/searchList">



						<input type="text" name="search" id="search_word" placeholder="Search" value="<?php echo $search; ?>">

						<button type="submit" class="btn btn-light" style="padding: 3px 6px; margin: 0px 0px 2px 0px;"><i class="fa fa-search"></i></button>

					</form>

				</div>



			</div>

			<div class="clearfix"></div>



			<div class="x_content">



				<table class="tbl_content " style="width: 100%;">

					<thead>
						<tr class="tr_head">
							<th>#</th>
							<th>Request by</th>
							<th>Estimate Number</th>
							<th>PO Number</th>
							<th>Customer</th>
							<th>Estimate Date</th>
							<th>EXP. Date</th>
							<th>Items</th>
							<th>QTY</th>
							<th>Grand Total</th>
							<th>Currency</th>
							<th>Status</th>
							<th>Design</th>
							<?php
							if ($act_page == "approveList" || $act_page == "archived" || $act_page == "searchList") {

							?>
								<th>Invoice <br> No.</th>
							<?php
							}
							?>
							<th class="action-fields">Action</th>
						</tr>
					</thead>

					<?php

					$n_count_req_edit = 0;

					$n_count = (($page - 1) * $data_per_page) + 1;

					foreach ($quote_doc as $key1 => $row_quote_doc) {



						$show_status = strtoupper($row_quote_doc["approve_status"]);

						if ($row_quote_doc["approve_status"] == "approve") {

							$show_status = "APPROVED" . '<div class="show_date_approve">' . date("Y-m-d H:i", strtotime($row_quote_doc["approve_date"])) . '</div>';
						} else if ($row_quote_doc["approve_status"] == "reject") {

							$show_status = "REJECTED" . '<div class="show_date_reject">' . date("Y-m-d H:i", strtotime($row_quote_doc["reject_time"])) . '</div>';
						}

					?>

						<tr <?php if ($row_quote_doc["is_editing"] == "1" && ($user_group == "1" || $user_group == "99")) {

								echo 'style="background-color:#FFA;"';
							} else if ($row_quote_doc["is_duplicate"] == "1") {

								echo 'style="background-color:#FAA;"';
							} elseif ($row_quote_doc["is_duplicate"] == "0") {

								if ($row_quote_doc["approve_status"] == "approve") {

									if ($row_quote_doc['quotation_data_count'] == 0) {

										echo 'style="background-color:#fffdd0;"';
									}
								}
							}

							?>>

							<td class="text-center"><?php echo $n_count; ?></td>

							<td>

								<?php

								echo $row_quote_doc["fullname"];

								if ($user_group == "1" || $user_group == "99") {

									echo ' <i class="edit_req_by fa fa-pencil" data-toggle="modal" data-target="#requestByEditModal" onclick="return showReqByEdit(\'' . $row_quote_doc["qdoc_id"] . '\',\'' . $row_quote_doc["user_id"] . '\');"></i>';
								}

								?>



							</td>

							<td id="td_est_number<?php echo $row_quote_doc["qdoc_id"]; ?>"><?php echo $row_quote_doc["est_number"]; ?></td>

							<td class="POnumberForApproved text-center"><?php echo $row_quote_doc["po_number"]; ?></td>

							<td class="text-center" id="td_cust_nam<?php echo $row_quote_doc["qdoc_id"]; ?>"><?php echo $row_quote_doc["cust_name"]; ?></td>

							<td class="text-center"><?php echo date("M. d, Y", strtotime($row_quote_doc["est_date"])); ?></td>

							<td class="text-center"><?php echo date("M. d, Y", strtotime($row_quote_doc["exp_date"])); ?></td>

							<td style="text-align: center;" id="td_num_item<?php echo $row_quote_doc["qdoc_id"]; ?>"><?php echo $row_quote_doc["num_item"]; ?></td>

							<td style="text-align: center;"><?php echo $row_quote_doc["sum_qty"]; ?></td>

							<td style="text-align: center;"><?php echo number_format($row_quote_doc["grand_total"], 2); ?></td>

							<td style="text-align: center;"><?php echo $row_quote_doc["quote_curr"]; ?></td>

							<td style="width: 110px; text-align:center;">

								<?php

								if ($row_quote_doc["dup_from"] == 0) {

									echo '<span class="label label-success" style="font-family: Arial, sans-serif; font-size: 12px; margin-bottom:15px; font-weight: bold;">New</span><br>';
								} elseif ($row_quote_doc["dup_from"] == 1) {

									echo '<div style="font-family: Helvetica, sans-serif; font-size: 14px; line-height: 1.5;">

                                    <span class="label label-warning" style="font-weight: normal; display: inline-block; padding: 5px; background-color: #f0ad4e; color: white; border-radius: 5px;">Not Verified</span><br>'; ?>

									<?php if ($row_quote_doc['old_est_num'] != NULL) { ?>

										<span class="label label-warning old_est_num old_est_num_notveri" style="font-weight: normal; display: inline-block; margin-top: 5px; padding: 5px; background-color: #f0ad4e; color: white; border-radius: 5px;cursor:pointer;"><?= $row_quote_doc['old_est_num'] ?></span>

									<?php

									}

									?>

			</div>

		<?php

								} else {

									echo '<div style="font-family: Helvetica, sans-serif; font-size: 14px; line-height: 1.5;">

                                    <span class="label label-primary" style="font-weight: normal; display: inline-block; padding: 5px;color: white; border-radius: 5px;">Verified</span><br>'; ?>

			<?php if ($row_quote_doc['old_est_num'] != NULL) { ?>

				<span class="label label-primary old_est_num old_est_num_veri" style="font-weight: normal; display: inline-block; margin-top: 5px; padding: 5px; color: white; border-radius: 5px;cursor:pointer;"><?= $row_quote_doc['old_est_num'] ?></span>

		<?php

									}
								}

								// if( ($user_group=="1" || $user_group=="99" ) && $user_id!="65"){

		?>

		<?php echo $show_status; ?></td>

		<td>

			<?php

						if ($row_quote_doc['design_name'] == "" && $row_quote_doc['design_note'] == "") {

							$class_btn = "btn btn-danger";

							$class_name = "Upload Design";
						} else {

							$class_btn = "btn btn-success";

							$class_name = "View Design";
						}

			?>

			<button class="<?= $class_btn ?>" data-target="#freebModal" data-toggle="modal" onclick="openQuotationData('<?= $row_quote_doc["qdoc_id"] ?>','<?= base64_encode($row_quote_doc["design_name"]) ?>','<?= base64_encode($row_quote_doc["design_note"]) ?>')"><?= $class_name ?></button>

		</td>

		<?php

						if ($act_page == "approveList" || $act_page == "archived" || $act_page == "searchList") {



							$s_inv = "";

							if ($row_quote_doc["inv_no"] != "") {

								$s_inv = str_replace(",", "<br>", $row_quote_doc["inv_no"]);
							}

		?>

			<td style="text-align: center;">

				<?php



							if (($user_group == "1" || $user_group == "99") && ($row_quote_doc["approve_status"] != "reject") && ($row_quote_doc["approve_status"] != "new") && ($row_quote_doc["is_duplicate"] == "0")) {



				?>

					<div class="cnt_inv" id="d_inv<?php echo $row_quote_doc["qdoc_id"]; ?>"><?php echo $s_inv; ?></div>

					<i class="fa fa-pencil btn_edit_inv" data-toggle="modal" data-target="#editINVModal" onclick="return editInvoice(<?php echo $row_quote_doc["qdoc_id"]; ?>);"></i>

				<?php

							} else {

								echo $s_inv;
							}

				?>

			</td>

		<?php

						}

		?>

		<td style="text-align: right; padding: 5px 3px;" class="action-fields-td">
			<div class="actionGridBtns">
				<?php
						$user_group = Yii::app()->user->getState('userGroup');
						if ($row_quote_doc["is_duplicate"] == "0") {
							if ($row_quote_doc["approve_status"] == "approve") {
								if ($user_group == 6) {
							?>
							<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotation(<?php echo $row_quote_doc["qdoc_id"]; ?>,'vp');">View</button>
							<?php
								} else {
							?>

							<?php
								if ($row_quote_doc['quotation_data_count'] == 0) {
							?>
								<button type="button" class="btn btn-info" data-toggle="modal" data-target="#cartV2Modal" onclick="sendToCart(<?php echo $row_quote_doc["qdoc_id"]; ?>,'equote_aa');">Edit</button>
							<?php
									}
							?>
							<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotation(<?php echo $row_quote_doc["qdoc_id"]; ?>,'vp');">View</button>
							<?php
								if (($user_group == "1" || $user_group == "99") && $row_quote_doc["approve_status"] != "new" && $user_id != "65") {
								?>
									<button type="button" class="btn btn-info" data-toggle="modal" style="background: #17A2B8;" data-target="#quoteDocModal" onclick="viewQuotation(<?php echo $row_quote_doc["qdoc_id"]; ?>,'va','Approve');">Edit View</button>
								<?php
								}
							?>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotation(<?php echo $row_quote_doc["qdoc_id"]; ?>,'vc');" title="View Commission">Comm.</button>
							<?php
									if ($row_quote_doc['draft_changed'] == 1) {
							?>
								<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotationDraft(<?php echo $row_quote_doc["qdoc_id"]; ?>,'vp');">Original Draft</button>
							<?php
									}
							?>
							<?php
									if ((Yii::app()->controller->action->id == "approveList" || Yii::app()->controller->action->id == "archived" || Yii::app()->controller->action->id == "searchList") && $row_quote_doc['quotation_data_count'] == 0) {
							?>
								<button type="button" class="btn btn-success" onclick="convertQuotation(<?php echo $row_quote_doc["qdoc_id"]; ?>,<?php echo $row_quote_doc["user_id"] ?>);">Convert to Quotation</button>
							<?php

									}
							?>
							<button type="button" class="btn btn-danger" onclick="return deleteQuotation(<?php echo $row_quote_doc["qdoc_id"]; ?>);">Delete</button>
						<?php
								}
							} else if ($row_quote_doc["approve_status"] == "new") {
								if (($user_group == "1" || $user_group == "99") && $user_id != "65") {
								?>
								<div class="text-center">
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotation(<?php echo $row_quote_doc["qdoc_id"]; ?>,'va');">View & Approve</button>
								</div>
								<?php
									} elseif ($user_group == "6") {
								?>
								<div class="text-center">
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotation(<?php echo $row_quote_doc["qdoc_id"]; ?>,'vb');">View</button>
								</div>
								<?php
								} else {
								?>
								<div class="text-center">
									<button type="button" class="btn btn-info" data-toggle="modal" data-target="#cartV2Modal" onclick="sendToCart(<?php echo $row_quote_doc["qdoc_id"]; ?>,'quote_rej');">Edit</button>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotation(<?php echo $row_quote_doc["qdoc_id"]; ?>,'vb');">View </button>
								</div>
								<?php
								}
							} else if ($row_quote_doc["approve_status"] == "reject") {
						?>
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#cartV2Modal" onclick="sendToCart(<?php echo $row_quote_doc["qdoc_id"]; ?>,'quote_rej');">Edit</button>
							<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotation(<?php echo $row_quote_doc["qdoc_id"]; ?>,'v');">View</button>
							<button type="button" class="btn btn-danger" onclick="return deleteQuotation(<?php echo $row_quote_doc["qdoc_id"]; ?>);">Delete</button>
						<?php
							} else {
						?>
						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#cartV2Modal" onclick="sendToCart(<?php echo $row_quote_doc["qdoc_id"]; ?>,'equote_aa');">Edit</button>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotation(<?php echo $row_quote_doc["qdoc_id"]; ?>,'v');">View</button>
					<?php
							}
						}
						if ($row_quote_doc["archive"] == "0" && $row_quote_doc["approve_status"] != "new" && $user_group != 6) {
					?>
					<button type="button" class="btn btn-dark" onclick="saveToArchive(<?php echo $row_quote_doc["qdoc_id"]; ?>);">Archive</button>
					<?php
							if ($row_quote_doc["is_duplicate"] == "0") {
					?>
						<button type="button" class="btn btn-success" onclick="return duplicateQuoteByachv(<?php echo $row_quote_doc["qdoc_id"]; ?>);" title="Duplicate">Dup. </button>
					<?php
							}
					?>
					<?php
						} else if ($row_quote_doc["approve_status"] != "new" && $user_group != 6) {
							if ($row_quote_doc["is_duplicate"] == "0") {
					?>
						<button type="button" class="btn btn-success" onclick="return duplicateQuote(<?php echo $row_quote_doc["qdoc_id"]; ?>);" title="Duplicate">Dup.</button>
					<?php
							} else {
					?>
						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#cartV2Modal" onclick="sendToCart(<?php echo $row_quote_doc["qdoc_id"]; ?>,'quote_rej');">Edit</button>
						<button type="button" class="btn btn-danger" onclick="return deleteQuotation(<?php echo $row_quote_doc["qdoc_id"]; ?>);">Delete</button>
						<!-- <button type="button" class="btn btn-warning" onclick="addDuplicateToCart(<?php echo $row_quote_doc["qdoc_id"]; ?>);">Add To Cart</button> -->

							<button type="button" class="btn btn-info customer_log" data-quto_id="<?= $row_quote_doc['qdoc_id']; ?>"
								data-customer="<?= $row_quote_doc["cust_name"]; ?>">Customer Logs</button>
				<?php
							}
						}
				?>
			</div>
		</td>

		</tr>

	<?php

						$n_count++;
					}

	?>



	</table>



	<?php



	/*foreach ($files as $key => $value) {



				?>



					<li>



						<a href="<?php echo Yii::app()->request->baseUrl; ?>/docs/downloadFile/id/<?php echo $value['id']; ?>">



							<?php echo Helper::getIconFile($value['file_type']) . $value['file_name']; ?>



						</a>



					</li>



				<?php



					}*/



	?>







		</div>



	</div>







</div>



</div>







<!-- Quotation DOC Request Edit-->

<div class="modal fade" id="quoteDocRequestEditModal" tabindex="-1" role="dialog">

	<div class="modal-dialog" style="width:500px;">

		<div class="modal-content">

			<div class="flex-header modal-header">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

				<h4 style="float: left;" class="modal-title">Request for estimate editing: <span id="sp_show_est_number"></span></h4>

			</div>

			<div id="qdoc_edit_content" class="modal-body" style="max-height: 500px;">

				<form id="qdoc_edit_form">

					<input type="hidden" id="edit_qdoc_id" name="edit_qdoc_id">

					Notes:

					<textarea name="edit_note" id="edit_note" style="width: 100%; height: 136px; min-height: 135px; margin: 3px; resize: none;"></textarea>

				</form>

			</div>

			<div id="qdoc_edit_btn_bar" class="modal-footer">

				<button style="float:right;" id="btn_submit_edit" type="button" class="btn btn-success" onclick="return submitRequestEdit();">Submit request</button>

			</div>

		</div>

	</div>

</div>



<!-- Invoice Edit-->

<div class="modal fade" id="editINVModal" tabindex="-1" role="dialog">

	<div class="modal-dialog" style="width:500px;">

		<div class="modal-content">

			<div class="flex-header modal-header">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

				<h4 style="float: left;" class="modal-title">Enter Invoice No.</h4>

			</div>

			<div class="modal-body">

				<input type="text" id="inv_value" name="inv_value" style="width: 100%; text-align: center;">

				<input type="hidden" id="edit_inv_qdoc_id">

				<div style="color: #D9534F; font-size: 14px;  width: 100%; padding: 0px; margin:0px;">* Use "," for separate the Invoice numbers. <br><u>Ex</u>: 00000000,11111111,222222222</div>

			</div>

			<div class="modal-footer">

				<center><button style="" id="btn_submit_edit" type="button" class="btn btn-success" onclick="return submitInvoice();"> Submit </button></center>

			</div>

		</div>

	</div>

</div>



<!-- Edit Request by-->

<div class="modal fade" id="requestByEditModal" tabindex="-1" role="dialog">

	<div class="modal-dialog" style="width:500px;">

		<div class="modal-content">

			<div class="flex-header modal-header">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

				<h4 style="float: left;" class="modal-title">Select new Request by</h4>

			</div>

			<div class="modal-body" style="max-height: 500px;">



				<input type="hidden" id="edit_reqby_qdoc_id" value="">

				<h6 style="font-size:18px;">User : </h6><select id="edit_reqby_user_id">

					<?php

					$sql_user = " SELECT id,fullname,username FROM user WHERE enable=1 AND user_group_id IN (1,99,2) ORDER BY fullname ASC;";

					$a_user_data = Yii::app()->db->createCommand($sql_user)->queryAll();

					for ($i = 0; $i < sizeof($a_user_data); $i++) {

						echo '<option value="' . $a_user_data[$i]["id"] . '">' . $a_user_data[$i]["fullname"] . ' (' . $a_user_data[$i]["username"] . ')</option>';
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



<div class="modal fade" id="freebModal" tabindex="-1" role="dialog" aria-labelledby="freebModal1" aria-hidden="true">

	<div class="modal-dialog" role="document">

		<div class="modal-content">

			<div class="flex-header modal-header">

				<div class="d-flex">

					<h3 class="modal-title" style="float:left;">Design Info</h3>

					<button style="float:right;" type="button" class="close" data-dismiss="modal" aria-label="Close">

						<span aria-hidden="true">&times;</span>

					</button>

				</div>

			</div>

			<div class="modal-body">

				<div class=" form-side">

					<div class="card">

						<form id="upload_sample" enctype="multipart/form-data">

							<div class="form-group">

								<label for="exampleInputEmail1">Upload File(*JPEG,PNG OR PDF ONLY)</label>

								<input type="file" class="form-control" name="files_name[]" id="exampleInputEmail1" accept="application/pdf,image/jpeg,image/png" multiple>

								<input type="hidden" id="main_conv_id" name="main_conv_id" required class="form-control">

							</div>

							<div id="note_div">



							</div>

							<div style="display:flex;">

								<button type="submit" class="btn btn-primary main_submit_btn">Submit</button>

								<button class="btn btn-lg btn-warning submitting_btn" style="display:none;">

									<span class="glyphicon glyphicon-refresh spinning"></span> Submitting...

								</button>

							</div>

							<div class="btn_group">



							</div>

						</form>

					</div>

				</div>



				<div class=" pdf-side">

					<div class="card">

						<iframe src="" style="display:none;" id="pdf_source" type="frame&amp;vlink=xx&amp;link=xx&amp;css=xxx&amp;bg=xx&amp;bgcolor=xx" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scorlling="yes" width="100%" height="600"></iframe>

						<img id="live_view" style="display:none;" src="" width="100%" height="700">

					</div>

				</div>

			</div>

		</div>

	</div>

</div>




<!-- customer logs  -->

<div class="modal fade" id="customerLogs" tabindex="-1" role="dialog">

	<div class="modal-dialog" style="width:750px;">

		<div class="modal-content">

			<div class="flex-header modal-header">

				<button type="button" class="close remove_customer_log" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

				<h4 style="float: left;" class="modal-title">Customer Logs </h4>

			</div>

			<div class="modal-body" style="max-height: 500px;  overflow:scroll ;">
				     
			          <div class="d-flex justify-content-between align-items-center">

			               <label class="switch">
                                <input type="checkbox" id="toggle_checkbox">
                                <span class="slider round"></span>
                            </label>
							<p class="customer-name text-primary"></p>
					  </div>
					<div class="customer_log_div">

					</div>


			</div>

			<div class="modal-footer">

				<!-- <button style="float:right;" type="button" class="btn btn-success" onclick="return submitReqByEdit();">Submit</button> -->

			</div>

		</div>

	</div>

</div>

<!--  -->



<script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
$dupid = Yii::app()->session->get('dupid');
if ($dupid) {
	Yii::app()->session->remove('dupid');
?>
	<script type="text/javascript">
		$(document).ready(function() {
			sendToCart(<?php echo $dupid; ?>, 'quote_rej');
			$('#cartV2Modal').modal("toggle");
		});
	</script>
<?php
}
?>



<script type="text/javascript">
	$(document).on('submit', '#upload_sample', function(e) {

		e.preventDefault();

		var form = $(this);

		var formData = new FormData(form[0]);

		$('.main_submit_btn').hide();

		$('.submitting_btn').show();

		$.ajax({

			type: 'POST',

			data: formData,

			processData: false,

			contentType: false,

			url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/uploadFreebies",

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



	function openQuotationData(conv_id, file_name, notes) {
		var html = '';
		html += '<div class="form-group">' +
			'<label for="exampleInputEmail111">Notes For Admin <span style="color:#D43F3A;">* Do not use apostrophes</span></label>' +
			'<textarea class="form-control" name="notes_admin" id="exampleInputEmail111">' + atob(notes) + '</textarea>' +
			'</div>';
		$('#exampleInputEmail1').attr('required', false);
		$('#conv_type').val(1);
		$('#note_div').empty();
		$('#note_div').append(html);
		$('#main_conv_id').val(conv_id);
		if (file_name.length > 0) {
			var file_name_string = atob(file_name).split(',');
			var html2 = '';
			var count = 1;
			$.each(file_name_string, function(key, val) {
				html2 += '<span class="btn btn-primary view_file" fname="' + btoa(val) + '">File #' + count + '</span>';
				count++;
			});
			$('.btn_group').empty();
			$('.btn_group').append(html2);
			var fileExt = file_name_string[0].split('.').pop();
			if (fileExt == 'pdf') {
				var url = "/upload/new_design/" + file_name_string[0];
				$('#pdf_source').attr('src', url);
				$('#live_view').hide();
				$('#pdf_source').show();
			} else {
				var baseURL = '<?php echo Yii::app()->request->getBaseUrl(true); ?>';
				var url = "/upload/new_design/" + file_name_string[0];
				$('#live_view').attr('src', url);
				$('#pdf_source').hide();
				$('#live_view').show();
			}
		} else {
			$('#pdf_source').hide();
			$('#live_view').hide();
			$('.btn_group').empty();
		}
	}



	$(document).on('click', '.view_file', function() {

		var fname = atob($(this).attr('fname'));

		var fileExt = fname.split('.').pop();

		if (fileExt == 'pdf') {

			var url = "/upload/new_design/" + fname;

			$('#pdf_source').attr('src', url);

			$('#live_view').hide();

			$('#pdf_source').show();

		} else {

			var baseURL = '<?php echo Yii::app()->request->getBaseUrl(true); ?>';

			var url = "/upload/new_design/" + fname;

			$('#live_view').attr('src', url);

			$('#pdf_source').hide();

			$('#live_view').show();

		}

	})



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

						'<td style="text-align:center;">' +
						'<span class="btn-sort" data-action="up" data-id="' + qdoci_id + '"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i></span>' +
						'<span class="btn-sort" data-action="down" data-id="' + qdoci_id + '"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i></span>' +
						'</td>' +

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



	$(document).ready(function() {



		setTimeout(function() {



		}, 2000);



	});

	/*function checkUseNotePattern(){

		if($('#use_note_patt').prop("checked")){

			if(!confirm("Use Note pattern will clearing the text box below. Confirm?")){

				$('#use_note_patt').prop("checked",false);

				return false;

			}

			$('#note_text').val("");

			$('#select_qnote_id').val("");

			$('#select_qnote_id').attr("disabled",false);



		}else{

			$('#select_qnote_id').attr("disabled",true);

		}

	}



	function saveNewNote(){



		if($('#note_text').val()==""){

			alert("Please input note");

			return false;

		}



		var note_name = prompt("Note name :");



		if( note_name=="" || note_name==null ){

			alert("Please input note name");

			return false;

		}



		$.ajax({  

	        type: "POST",  

	        dataType: "json", 

	        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/saveNewNote" ,

	        data:{

	            "note_name":window.btoa(note_name),

	            "note_text":window.btoa($('#note_text').val())

	        },

	        success: function(resp){ 

	            if(resp.result=="success"){



	            	var inner_select = '<option value="'+resp.qnote_id+'">'+window.atob(resp.qnote_name)+'</option>';

	            	$('#select_qnote_id').append(inner_select);

	            	var inner_hidden = '<div id="qnote'+resp.qnote_id+'">'+resp.qnote_text+'</div>';

	            	$('#hidden_note').append(inner_hidden);



	            	alert("Note has been saved.");



	            }else{

	            	alert(resp.msg);

	            }

	        }  

	    });



	}



	function changeNotePattern(){



		var qnote_id = $('#select_qnote_id').val();

		if(qnote_id==""){

			$('#note_text').val("");

		}else{

			$('#note_text').val( window.atob( $('#qnote'+qnote_id).html() ) );

		}



	}*/

	function saveEstimate() {



		if (confirm("Confirm to save this Estimate?")) {

			$.ajax({

				type: "POST",

				dataType: "json",

				url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/saveEstimate",

				data: $('#app_quote').serialize(),

				success: function(resp) {

					if (resp.result == "success") {



						location.reload();



					} else {

						alert(resp.msg);

					}

				}

			});



		}



	}

	function quotationApprove() {



		if (confirm("Confirm to approve this Estimate?")) {



			$.ajax({

				type: "POST",

				dataType: "json",

				url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/approveQuote",

				data: $('#app_quote').serialize(),

				success: function(resp) {

					if (resp.result == "success") {



						location.reload();



					} else {

						alert(resp.msg);

					}

				}

			});



		}



	}



	function quotationReject() {



		if (confirm("Confirm to reject this Estimate?")) {

			//var qdoc_id = $('#qdoc_id').val();

			//var note_text = window.btoa($('#note_text').val());



			$.ajax({

				type: "POST",

				dataType: "json",

				url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/rejectQuote",

				data: $('#app_quote').serialize(),

				success: function(resp) {

					if (resp.result == "success") {



						location.reload();



					} else {

						alert(resp.msg);

					}

				}

			});

		}



	}



	function quotationRejectxx() {



		if (confirm("Confirm to reject this Estimate?")) {

			var qdoc_id = $('#qdoc_id').val();

			var note_text = window.btoa($('#note_text').val());



			$.ajax({

				type: "POST",

				dataType: "json",

				url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/updateQuoteNote",

				data: {

					"qdoc_id": qdoc_id,

					"note_text": note_text,

					"approve_status": "reject"

				},

				success: function(resp) {

					if (resp.result == "success") {



						location.reload();



					} else {

						alert(resp.msg);

					}

				}

			});

		}



	}



	function showQuoteHistory() {



		var qdoc_id = $('#select_history').val();



		if ($('#main_qdoc_id').val() == qdoc_id) {

			viewQuotation(qdoc_id, 'va');

		} else {



			$('#d_quote_body').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');



			$.ajax({

				type: "POST",

				dataType: "json",

				url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/showQuoteView",

				data: {

					"qdoc_id": qdoc_id,

					"action_from": 'v'

				},

				success: function(resp) {

					$('#d_quote_body').html(resp.inner_content);



					$('#d_approval_comment').html(window.atob(resp.approval_comment));



					$('#head_selector_app').hide();

					$('#quote_approve_bar').hide();

					$('#d_quote_below').hide();



				}

			});

		}

	}







	function printQuotation() {
		var qdoc_number = $("#qdoc_number").html();
		var divContents = $("#d_quote_body").clone(); // Create a copy of the content
		// Remove the unwanted anchor tags
		divContents.find("a").remove();

		divContents.find("span:contains('\u2022')").remove();
		divContents.find("select").remove(); // Remove all select dropdowns
		divContents.find(".locatonhead").remove();
		divContents.find(".Private_notes").remove();

		var printWindow = window.open('', '', 'height=2000,width=1200');

		printWindow.document.write('<html><head><title>' + qdoc_number + '</title>');

		printWindow.document.write('</head><body>');

		printWindow.document.write(divContents.html()); // Print the modified content

		printWindow.document.write('</body></html>');

		printWindow.document.close();

		setTimeout(function() {
			printWindow.print();
		}, 1000);

	}



	function changeIncludeVATApprove() {



		var total_value = 0.0;



		if ($('#inc_vat_app').prop("checked")) {



			var vat_value = parseFloat($('#vat_value_app').val());



			var sub_tt = parseFloat($('#sp_app_sub_total').html());


			//var dataShippValue = parseFloat($('.number_disc_approval').data('shipp'));
			var dataShippValue = parseFloat($('.shippcount1').text());
			if (dataShippValue === undefined) {}
			dataShippValue = 0;

			var discount = (parseFloat($('.number_disc_approval').val()) / 100) * (sub_tt - dataShippValue);



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

			//var dataShippValue = parseFloat($('.number_disc_approval').data('shipp'));
			var dataShippValue = parseFloat($('.shippcount1').text());
			if (dataShippValue === undefined) {}
			dataShippValue = 0;

			var discount = (parseFloat($('.number_disc_approval').val()) / 100) * (sub_tt - dataShippValue);



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
		$("#formsplite" + id + "").toggle();
	}


	function submitForm(qdoci_id) {
		let form = document.getElementsByClassName("form__submit");
		event.preventDefault();

		var salesRep1 = $('select[name="sales_rep_1' + qdoci_id + '"]').eq(0).val();
		var salesRep2 = $('select[name="sales_rep_2' + qdoci_id + '"]').eq(0).val();
		var percent1 = $('input[name="split_comm_percent_1' + qdoci_id + '"]').val();
		var percent2 = $('input[name="split_comm_percent_2' + qdoci_id + '"]').val();


		// Calculate total percentage
		var totalPercent = parseInt(percent1) + parseInt(percent2);

		// Send AJAX request
		$.ajax({
			type: 'POST',
			url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/Splitcomm", // Replace with your server endpoint
			data: {
				sales_rep_1: salesRep1,
				sales_rep_2: salesRep2,
				split_comm_percent1: percent1,
				split_comm_percent2: percent2,
				qdoci_id: qdoci_id
			},
			success: function(response) {
				// Update the app_comm_percent input field
				$('#comm_percent_app' + qdoci_id + '').val(totalPercent);
				console.log(response); // Log the response for debugging
				calComm();
			},
			error: function(error) {
				console.error('Error:', error);
			}
		});
	}

	function saveToArchive(qdoc_id) {

		if (confirm("Save this Estimate to Archive?")) {

			$.ajax({

				type: "POST",

				dataType: "json",

				url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/saveToArchive",

				data: {

					"qdoc_id": qdoc_id

				},

				success: function(resp) {

					if (resp.result == "success") {



						location.reload();



					} else {

						alert(resp.msg);

					}

				}

			});

		}

	}



	function changeQuoteHeadApp() {



		var head_select = $('#head_selector_app').val();

		var select = $('#head_selector_app');

		/* ✅ RESET all options back to full label */
        select.find('option').each(function () {
            if ($(this).data('full')) {
                $(this).text($(this).data('full'));
            }
        });

        /* ✅ Change selected option to only company name */
        var selectedOption = select.find('option:selected');
        selectedOption.text(selectedOption.data('name'));

		var obj_comp = $.parseJSON(window.atob($('#hide_comp_info_app' + head_select).val()));



		//alert( window.atob($('#hide_comp_info'+head_select).val()) );



		var head_img_logo = "";

		if (obj_comp.comp_logo != "" && obj_comp.comp_logo != null) {

			head_img_logo = '<img style="max-height: 180px; max-width: 180px; margin:0 auto; display:flex;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/' + obj_comp.comp_logo + '" >';

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







	function deleteQuotation(qdoc_id) {



		if (confirm("Confirm to delete this Estimate?")) {

			$.ajax({

				type: "POST",

				dataType: "json",

				url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/deleteQuote",

				data: {

					"qdoc_id": qdoc_id

				},

				success: function(resp) {

					if (resp.result == "success") {



						location.reload();



					} else {

						alert(resp.msg);

					}

				}

			});

		} else {

			return false;

		}



	}



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



	function changePage(act_page) {



		var page_select = $('#page_select').val();

		window.location.href = "<?php echo Yii::app()->request->baseUrl; ?>/quotation/" + act_page + "?page=" + page_select + "&search=" + window.btoa($('#search_word').val());



	}



	function requestEditQuotation(qdoc_id) {



		$('#edit_qdoc_id').val(qdoc_id);



		$('#sp_show_est_number').html($('#td_est_number' + qdoc_id).html());



	}



	function submitRequestEdit() {



		if ($('#edit_note').val() == "") {

			alert("Please input Notes");

			return false;

		}



		$.ajax({

			type: "POST",

			dataType: "json",

			url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/saveRequestEditNotes",

			data: $('#qdoc_edit_form').serialize(),

			success: function(resp) {

				if (resp.result == "success") {



					location.reload();



				} else {

					alert(resp.msg);

				}

			}

		});

	}



	function setAcknowledge(qdoc_id) {

		$.ajax({

			type: "POST",

			dataType: "json",

			url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/setAcknowledge",

			data: {

				"qdoc_id": qdoc_id

			},

			success: function(resp) {

				if (resp.result == "success") {



					location.reload();



				} else {

					alert(resp.msg);

				}

			}

		});

	}



	function duplicateQuoteByachv(qdoc_id) {

		if (!confirm("Do you want to duplicate " + $('#td_est_number' + qdoc_id).html() + " ?")) {
			return false;
		}
		$.ajax({

			type: "POST",

			dataType: "json",

			url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/duplicateQuoteByachv",

			data: {

				"qdoc_id": qdoc_id

			},
			success: function(resp) {

				if (resp.result == "success") {
					$.ajax({
						type: "POST",
						url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/storeDupIdInSession",
						data: {
							"dupid": resp.new_qdoc_id
						},
						success: function() {
							window.location.href = "<?php echo Yii::app()->request->baseUrl; ?>/quotation/archived";
						}
					});
				} else {
					alert(resp.msg);
				}
			}
		});
	}

	function duplicateQuote(qdoc_id) {



		if (!confirm("Do you want to duplicate " + $('#td_est_number' + qdoc_id).html() + " ?")) {

			return false;

		}



		$.ajax({

			type: "POST",

			dataType: "json",

			url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/duplicateQuote",

			data: {

				"qdoc_id": qdoc_id

			},

			success: function(resp) {

				if (resp.result == "success") {



					location.reload();



				} else {

					alert(resp.msg);

				}

			}

		});

	}



	function editSaleNote(qdoc_id) {



		var sale_note = $('#pre_sale_note' + qdoc_id).html();



		var inner_note = '<textarea style="width:100%; height:100px; color:#000;" id="edit_sale_note">' + sale_note + '</textarea>';



		$('#pre_sale_note' + qdoc_id).html(inner_note);



		$('#btn_edit_sale_note').attr("disabled", true).css("background-color", "#FFF");

		$('#btn_save_sale_note').attr("disabled", false).css("background-color", "#DDD");



	}



	function saveSaleNote(qdoc_id) {



		var edit_sale_note = btoa(unescape(encodeURIComponent($('#edit_sale_note').val())));



		$.ajax({

			type: "POST",

			dataType: "json",

			url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/updateSaleNote",

			data: {

				"qdoc_id": qdoc_id,

				"edit_sale_note": edit_sale_note

			},

			success: function(resp) {

				if (resp.result == "success") {



					$('#pre_sale_note' + qdoc_id).html($('#edit_sale_note').val());



					$('#btn_edit_sale_note').attr("disabled", false).css("background-color", "#DDD");

					$('#btn_save_sale_note').attr("disabled", true).css("background-color", "#FFF");



				} else {

					alert(resp.msg);

				}





			}

		});



	}



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



	function editInvoice(qdoc_id) {



		var inv_show = $('#d_inv' + qdoc_id).html();



		$('#edit_inv_qdoc_id').val(qdoc_id);

		inv_value = inv_show.replace(/<br>/g, ",");



		$('#inv_value').val(inv_value);



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



	function showReqByEdit(qdoc_id, user_id) {



		$('#edit_reqby_qdoc_id').val(qdoc_id);

		$('#edit_reqby_user_id').val(user_id);



	}



	function submitReqByEdit() {



		if ($('#edit_reqby_qdoc_id').val() == "") {



			alert("Can not update to new user.");

			return false;

		}



		var qdoc_id = $('#edit_reqby_qdoc_id').val();

		var user_id = $('#edit_reqby_user_id').val();



		$.ajax({

			type: "POST",

			dataType: "json",

			url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/updateUserByAdmin",

			data: {

				"qdoc_id": qdoc_id,

				"user_id": user_id

			},

			success: function(resp) {

				if (resp.result == "success") {



					location.reload();



				} else {

					alert(resp.msg);

				}





			}

		});



	}



	$(document).ready(function() {
		// Attach click event handler to the span element
		$(".old_est_num_veri").click(function() {
			// Get the text content inside the span
			var searchText = $(this).text();

			// Confirm with the user
			var confirmed = confirm("Are you sure you want to search for: " + searchText + " ?");

			// If user confirms, open the search form in another tab and populate the search input field
			if (confirmed) {
				var searchUrl = "/quoteEstimate/searchList";
				var searchParams = "search=" + encodeURIComponent(searchText);
				var newTab = window.open("", "_blank");
				newTab.document.write('<form id="form_search" method="post" action="' + searchUrl + '">');
				newTab.document.write('Search: <input type="text" name="search" value="' + searchText + '">');
				newTab.document.write('<button type="submit">Submit</button>');
				newTab.document.write('</form>');
				newTab.document.getElementById("form_search").submit();
			}
		});
	});

	$(document).ready(function() {
		// Attach click event handler to the span element
		$(".old_est_num_notveri").click(function() {
			// Get the text content inside the span
			var searchText = $(this).text();

			// Confirm with the user
			var confirmed = confirm("Are you sure you want to search for: " + searchText + " ?");

			// If user confirms, open the search form in another tab and populate the search input field
			if (confirmed) {
				var searchUrl = "/quotation/searchList";
				var searchParams = "search=" + encodeURIComponent(searchText);
				var newTab = window.open("", "_blank");
				newTab.document.write('<form id="form_search" method="post" action="' + searchUrl + '">');
				newTab.document.write('Search: <input type="text" name="search" value="' + searchText + '">');
				newTab.document.write('<button type="submit">Submit</button>');
				newTab.document.write('</form>');
				newTab.document.getElementById("form_search").submit();
			}
		});
	});
</script>




<!-- customer log function -->

 <script>
    // when page loads, call the same function
			<?php $qdoc_id = isset($qdoc_id) ? $qdoc_id : ''; $mode = isset($mode) ? $mode : ''; ?>
			if("<?=$qdoc_id?>"){
		      	window.onload = function() {
			$('#quoteDocModal').modal('show'); 
			    viewQuotation("<?= $qdoc_id ?>", "<?= $mode ?>");
			    console.log("Window load"); 
			}
		    	console.log("IF");
			}else{
			    console.log("ELSE"); 
			}
  </script>


<script>
	$(document).on('click', '.customer_log', function() {
		let quto_id = $(this).data('quto_id');
		let customer = $(this).data('customer');
		$("#customerLogs").find('.customer-name').text(customer);
		let product_name = $('#chart_out_div').find('#product_list').val();

		if (customer == "") {
			alert("No customer data avilable");
			return false;
		}
		FetchCustomerLog(quto_id, customer, product_name);
	});

	function FetchCustomerLog(quto_id, customer, product_name) {
		console.log("fetch customer called");
		let modal = $('#customerLogs');
		let is_checked = modal.find('#toggle_checkbox').is(':checked');
		
		if (!is_checked) {
			product_name = 0;
		}

		showLoader();
		// return;
		$.ajax({
			url: "<?php echo Yii::app()->request->baseUrl ?>/quotation/CustomerLogs",
			type: "GET",
			data: {
				quto_id: quto_id,
				customer: customer,
				product_name: product_name,
			},

			success: function(response) {

				hideLoader();

				modal.modal('show');
				modal.find('.customer_log_div').html(response);
				

				const labelsArr = modal.find('#labels').val();

				const values = JSON.parse(modal.find('#values').val());
				let labels = JSON.parse(labelsArr);
				labels.unshift(0);
				values.unshift(0);

				let table = modal.find(".data-table");
				let chart = modal.find("#chart_out_div");
				if (product_name) {
					chart.removeClass('d-none');
					table.addClass('d-none');
				}

			    const ctx = document.getElementById('myBarChart').getContext('2d');

				new Chart(ctx, {
					type: 'line', // 👈 line chart
					data: {
						labels: labels,
						datasets: [{
							label: 'Yearly Price',
							data: values,
							fill: false, // 👈 important: prevent area fill (keeps it as a line chart)
							borderColor: 'rgba(54, 162, 235, 1)',
							backgroundColor: 'rgba(54, 162, 235, 0.6)',
							borderWidth: 2,
							tension: 0.3 // 👈 smooth curve (set 0 for straight lines)
						}]
					},
					options: {
						responsive: true,
						plugins: {
							legend: {
								display: true
							}
						},
						scales: {
							x: {
								type: 'category',
								offset: false,
								title: {
									display: true,
									text: 'Year'
								},
								ticks: {
									beginAtZero: true // forces X to start at 0 (numeric only)
								}
							},
							y: {
								beginAtZero: true,
								title: {
									display: true,
									text: 'Price'
								}
							}
						}
					}
				})
			},
			error: function(xhr, status, error) {

				hideLoader();
				console.log("Error:", error);
			},
			complete: function(xhr, status) {
			}
		});
	}

	$(document).on('change', '#toggle_checkbox', function() {
		let modal = $('#customerLogs');
		let table = modal.find(".data-table");
		let chart = modal.find("#chart_out_div");


		if ($(this).is(':checked')) {
			table.addClass('d-none');
			chart.removeClass('d-none');


		} else {
             let key_values = getFunctionValue();
		    FetchCustomerLog(key_values[0], key_values[1], 0);
			table.removeClass('d-none');
			chart.addClass('d-none');
		}

	});

	function getFunctionValue() {
		let qudo_id = $('.customer_log_container').find('#quto_id').val();
		let customer = $('#customerLogs').find('.customer-name').text();
		let product = $('#chart_out_div').find('#product_list').val();
		return [qudo_id, customer, product];
	}

	$(document).on('change', '#customerLogs #product_list', function() {
		let key_values = getFunctionValue();
		FetchCustomerLog(key_values[0], key_values[1], key_values[2]);
	}); 

	$(document).on('click' ,'.remove_customer_log' ,function(){
         $('#chart_out_div').find('#product_list').val('');
	     $('#customerLogs').find('#toggle_checkbox').prop('checked', false);
	});

	
</script>


<!--  -->