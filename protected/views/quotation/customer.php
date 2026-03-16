<style type="text/css">
	.tbl_customer th {
		text-align: left;
		background-color: #955;
		color: #FFF;
		text-transform: uppercase;
		padding: 10px;
		position: sticky;
		top: 0;
		font-size: 12px;
		z-index: 100;
		white-space: nowrap;
		border: 1px solid #FFFFFF;
	}

	.tbl_customer td {

		background-color: #EEE;
		color: #000;
		padding: 5px;
	}

	.tbl_customer button {
		height: 30px;
		padding: 5px;
		line-height: 15px;
		vertical-align: middle;
	}

	#d_add_edit_zone .card {
		box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
		height: 100%;
		position: sticky;
		top: 0;
		margin-top: 11px;
		padding: 15px 20px !important;
		border-left: solid 1px #AAF;
	}

	#d_add_edit_zone h5 {
		background: #EEE;
		padding: 10px;
		font-size: 15px;
		margin: 0;
		position: sticky;
		font-weight: 500;
		top: 0;
	}

	#d_add_edit_zone input {
		width: 100%;
		border: 1px solid #AAA;
		padding: 10px !important;
		margin: 10px 0;
	}

	#d_add_edit_zone textarea {
		min-height: 150px;
		margin: 13px 0;
		width: 100%;
	}

	.tbl_customer td {
		padding: 5px;
		border: 1px solid #00000014;
	}

	input#search_word {
		height: 40px;
	}

	.page-selecting-total-page {
		background: #999955;
		padding: 4px 20px;
		color: #FFF;
		width: 60px;
		text-align: center;
		height: 30px;
		font-size: 14px;
		border-radius: 20px;
		display: flex;
		align-items: center;
		justify-content: center;
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

	form#form_search {
		display: flex;
		align-items: center;
		position: relative;
		justify-content: space-evenly;
		max-width: 300px;
		margin-left: auto;
	}

	.x_title {
		padding: 15px 0;
		margin-bottom: 10px;
		display: grid;
		grid-template-columns: 1fr 1fr 1fr;
		gap: 10px;
		justify-content: space-between;
	}

	input#search_word {
		width: 100%;
		height: 38px;
		padding: 10px 45px 10px 20px;
		border-radius: 20px;
		font-size: 15px;
	}

	form#form_search {
		position: absolute;
		right: 20px;
		top: 30px;

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

	#editCustomerModal .modal-content {
		width: 800px;
	}

	.modal.in .modal-dialog {
		display: flex;
		align-items: center;
		justify-content: center;
	}

	#editCustomerModal input,
	textarea,
	select {
		/* padding: 20px; */
		width: 100%;
		margin: 12px 0;
	}

	select#page_select {
		background: #999955 !important;
		padding: 4px 5px;
		min-width: 60px;
		text-align: center;
		color: #FFFFFF;
		border: none;
		border-radius: 20px;
	}

	#d_show_customer {
		margin-top: 0;
		padding: 0;
		overflow: auto;
	}

	#d_show_customer table td:nth-child(2) {
		max-width: 100px;
		text-align: left !important;
	}

	#d_show_customer table td:nth-child(3) {
		max-width: 280px;
	}

	#d_show_customer table td:nth-child(4),
	#d_show_customer table td:nth-child(5),
	#d_show_customer table td:nth-child(6) {
		max-width: 150px;
	}



	#d_show_customer pre {
		word-break: unset;
		white-space: pre-line;
		padding: 5px;
		height: 100% !important;
		min-height: 30px;
		font-size: 12px;

	}

	#d_show_customer .btn.btn-danger,
	#d_show_customer .btn.btn-warning {
		height: auto !important;
		width: 100%;
		padding: 2px 5px
	}

	@media screen and (max-width:520px) {
		.row {
			overflow-x: scroll;
		}

		#d_add_edit_zone textarea {
			margin: 13px 2px;
		}

		#d_add_edit_zone {
			width: 100%;
		}

		.x_title {
			padding: 20px 0 30px 0;
			margin-bottom: 10px;
			align-items: self-start;
			flex-direction: column;
		}

		.x_title h2 {
			width: 100%;
		}

		.page-selecting {
			width: 100%;
			margin: 12px 0;
			padding: 10px;
			font-size: 13px;
		}

		form#form_search {
			position: relative;
			right: 0;
			top: 11px;
		}

		.page-selecting-total-page {
			padding: 4px 12px;
		}

		select#page_select {
			padding: 6px 8px;
		}
	}
</style>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">

		<div class="x_panel container">

			<div class="x_title">

				<div>
					<h2>Quotation > Manage Customer</h2>
				</div>
				<div class="page-selecting">
					<div class=" d-flex gap2 nowrapDesktop">
						<h6 class="sSize">Found</h6>
						<font class="page-selecting-total-page"><?php echo number_format($num_data); ?></font>
						<h6 class="sSize">rows</h6>
					</div>
					<div class=" d-flex gap2 nowrapDesktop">
						<h6 class="sSize">Page</h6>
						<select id="page_select" onchange="showCustomer();">
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
					<form id="form_search" method="post" onsubmit="$('#hidden_page_select').val($('#page_select').val());" action="<?php echo Yii::app()->request->baseUrl; ?>/quotation/customer">

						<input type="hidden" name="page" id="hidden_page_select">
						<input type="text" name="search" id="search_word" placeholder="Search" value="<?php echo $search; ?>">
						<button type="submit" class="btn btn-light" style="padding: 3px 6px; margin: 0px 0px 2px 0px;"><i class="fa fa-search"></i></button>
					</form>
				</div>
				<div class="clearfix"></div>

			</div>

			<div class="row">

				<div class="col-md-9" id="d_show_customer">

				</div>
				<div class="col-md-3">
					<div id="d_add_edit_zone" style=" padding: 0 10px;">
						<h5><i class="fa fa-plus"></i> New Customer</h5>
						<div class="card">
							<hr>
							<form name="form1" id="form1" action="<?php echo Yii::app()->request->baseUrl; ?>/quotation/addNewCustomer" target="hidden_frame" method="post">
								<!-- Customer Name :
								<div style="text-align: center; ">
									<input type="text" name="add_cust_name" id="add_cust_name" style="">
								</div>
								Customer Info :
								<div style="text-align: center;">
									<textarea name="add_cust_info" id="add_cust_info" style=""></textarea>
									<input type="hidden" name="user_id" value="<?php echo Yii::app()->user->getState('userKey'); ?>">
								</div> -->
								Team / Organization:
								<div class="mb-3">
									<input type="text" name="cust_full_name" id="add_cust_name" class="form-control">
								</div>
								Phone No:
								<div class="mb-3">
									<input type="text" name="phone_no" class="form-control">
								</div>
								Email:
								<div class="mb-3">
									<input type="email" name="email" class="form-control">
								</div>

								<div class="mb-3">
									<label class="form-label">Full Name:</label>
									<input type="text" name="full_name" class="form-control">
								</div>
								<div class="mb-3">
									<label class="form-label">Billing Country:</label>
									<input type="text" name="billing_country" class="form-control">
								</div>

								<div class="mb-3">
									<label class="form-label">Billing State:</label>
									<input type="text" name="billing_state" class="form-control">
								</div>
								<div class="mb-3">
									<label class="form-label">Billing Zip Code:</label>
									<input type="text" name="billing_zip_code" class="form-control">
								</div>

								<div class="mb-3">
									<label class="form-label">Sales Tax Exemption:</label>
									<select name="sales_tax" id="sales_tax" class="form-control">
										<option value="">Select Sales Tax</option>
										<option value="Exempt">Exempt</option>
										<option value="Non exempt">Non Exempt</option>
									</select>
								</div>
								<div class="md-3">
									<label class="form-label">Customer Type:</label>
									<select name="customer_type" id="customer_type" class="form-control">
										<option value="">Select Customer Type</option>
										<option value="Sales Direct">Sales Direct</option>
										<option value="Dealer">Dealer</option>
										<option value="Factory Direct">Factory Direct</option>
										<option value=">Private Label">Private Label</option>
									</select>
								</div>
								<div class="mb-3" id="Exemption_addnew">
									<label class="form-label">Tax ID:</label>
									<input type="text" name="tax_id" id="tax_id">
								</div>
								<!--<div class="mb-3">-->
								<!--	<label class="form-label">State Name:</label>-->
								<!--	<input type="text" name="state_name" class="form-control">-->

								<!--</div>-->

								<div class="mb-3">
									<label class="form-label">Billing Address:</label>
									<textarea name="billing_address" class="form-control" id="add_cust_info"></textarea>
									<input type="hidden" name="user_id" value="<?php echo Yii::app()->user->getState('userKey'); ?>">
								</div>
							</form>
							<center><br>
								<button type="button" class="btn btn-success" value="Submit" style="width: 80%;" onclick="return addNewCustomer();">Save</button>
							</center>
						</div>
					</div>
				</div>

			</div>

		</div>

	</div>

</div>

<!-- edit Customer Modal -->
<div class="modal fade" id="editCustomerModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Edit</h4>
			</div>
			<div class="modal-body">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<form name="form2" id="form2" action="<?php echo Yii::app()->request->baseUrl; ?>/quotation/editCustomerSubmit" target="hidden_frame" method="post">
							<div class="col-md-6">
								<label class="form-label">Team / Organization:</label>
								<input type="text" name="cust_full_name" id="edit_cust_full_name" class="form-control">
								<input type="hidden" name="cust_id" id="edit_cust_id" class="form-control">
								<input type="hidden" name="user_id" id="user_id" value="<?php echo Yii::app()->user->getState('userKey'); ?>" class="form-control">
							</div>

							<div class="col-md-6">
								<label class="form-label">Phone No:</label>
								<input type="text" name="phone_no" id="edit_phone_no" class="form-control">
							</div>

							<div class="col-md-6">
								<label class="form-label">Email:</label>
								<input type="email" name="email" id="edit_email" class="form-control">
							</div>

							<div class="col-md-6">
								<label class="form-label">Full Name:</label>
								<input type="text" name="full_name" id="edit_full_name" class="form-control">
							</div>
							<div class="col-md-6">
								<label class="form-label">Billing Country:</label>
								<input type="text" name="billing_country" id="edit_billing_country" class="form-control">
							</div>

							<div class="col-md-6">
								<label class="form-label">Billing State:</label>
								<input type="text" name="billing_state" id="edit_billing_state" class="form-control">
							</div>

							<div class="col-md-6">
								<label class="form-label">Sales Tax Exemption:</label>
								<select name="sales_tax" class="form-control" id="edit_sales_tax">
									<option value="">Select Sales Tax</option>
									<option value="Exempt">Exempt</option>
									<option value="Non exempt">Non Exempt</option>
								</select>
							</div>
							<div class="col-md-6">
								<label class="form-label">Customer Type:</label>
								<select name="customer_type" id="edit_customer_type" class="form-control">
									<option value="">Select Customer Type</option>
									<option value="Sales Direct">Sales Direct</option>
									<option value="Dealer">Dealer</option>
									<option value="Factory Direct">Factory Direct</option>
									<option value=">Private Label">Private Label</option>
								</select>
							</div>
							<div class="col-md-6">
								<label class="form-label">Tax ID:</label>
								<input type="text" name="tax_id" id="edit_tax_id" class="form-control">
							</div>
							<!--<div class="col-md-6">-->
							<!--	<label class="form-label">State Name:</label>-->
							<!--	<input type="text" name="state_name" id="edit_state_name" class="form-control">-->
							<!--</div>-->

							<div class="col-md-12">
								<label class="form-label">Billing Address:</label>
								<textarea name="billing_address" id="edit_billing_address" class="form-control"></textarea>
								<input type="hidden" name="user_id" value="<?php echo Yii::app()->user->getState('userKey'); ?>">
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" onclick="return editCustomerCheck();">Save</button>
			</div>
		</div>
	</div>
</div>

<iframe name="hidden_frame" style="display: none;"></iframe>

<script type="text/javascript">
	showCustomer();

	function addNewCustomer() {

		if ($('#add_cust_name').val() == "") {
			alert("Please input Customer name.");
			return false;
		}

		// if ($('#add_cust_info').val() == "") {
		// 	alert("Please input Customer info.");
		// 	return false;
		// }

		$('#form1').submit();

	}

	function showCustomer() {

		var page = $('#page_select').val();
		if (page == "") {
			page = 1;
		}

		$.ajax({
			type: "POST",
			dataType: "html",
			url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/showCustomer",
			data: {
				"page": page,
				"search": $('#search_word').val()
			},
			success: function(resp) {

				$('#d_show_customer').html(resp);

			}
		});

	}

	function addCustomerSuccess(cust_name) {
		alert('Customer added successfully');
		$('#search_word').val(cust_name);
		showCustomer();

		$("#form1")[0].reset();
	}

	function editCustomer(cust_id) {
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/getCustomerData",
			data: {
				"cust_id": cust_id
			},
			success: function(resp) {

				if (resp && typeof resp === "object") { // Ensure response is an object
					$("#edit_cust_full_name").val(resp.cust_name);
					$("#edit_cust_id").val(resp.cust_id);
					$("#edit_phone_no").val(resp.phone_no);
					$("#edit_email").val(resp.email);
					$("#edit_full_name").val(resp.full_name);
					$("#edit_billing_country").val(resp.billing_country);
					$("#edit_billing_state").val(resp.billing_state);
					$("#edit_sales_tax").val(resp.sales_tax);
					$("#edit_customer_type").val(resp.customer_type);
					$("#edit_tax_id").val(resp.tax_id);
					$("#edit_state_name").val(resp.state_name);
					$("#edit_billing_address").val(resp.billing_address);
				} else {
					console.error("Invalid JSON response:", resp);
				}
			},
			error: function(xhr, status, error) {
				console.error("AJAX Error:", error);
				alert("Error retrieving customer data.");
			}
		});
	}


	function editCustomerCheck() {

		if ($('#edit_cust_name').val() == "") {
			alert("Please input Customer name.");
			return false;
		}

		if ($('#edit_cust_info').val() == "") {
			alert("Please input Customer info.");
			return false;
		}

		$('#form2').submit();

	}

	function editCustomerSuccess(cust_id) {

		$('#editCustomerModal').modal("toggle");

		$.ajax({
			type: "POST",
			dataType: "json",
			url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/getCustomerData",
			data: {
				"cust_id": cust_id
			},
			success: function(resp) {


				if (resp && typeof resp === "object") { // Ensure response is an object
					$('#td_cust_name' + cust_id).html(resp.cust_name);
					$('#pr_cust_info' + cust_id).html(resp.cust_info);
					$("#edit_full_name").html(resp.full_name);
					$('#pr_cust_billing_country' + cust_id).html(resp.billing_country);
					$('#pr_cust_billing_state' + cust_id).html(resp.billing_state);
					$('#pr_cust_sales_tax' + cust_id).html(resp.sales_tax);
				} else {
					console.error("Invalid JSON response:", resp);
				}
			},
			error: function(xhr, status, error) {
				console.error("AJAX Error:", error);
				alert("Error retrieving customer data.");
			}
		});

		// $('#td_cust_name' + cust_id).html($('#edit_cust_full_name').val());
		// $('#pr_cust_info' + cust_id).html(cust_info);

		// $('#pr_cust_billing_country' + cust_id).html($('#edit_billing_country').val());
		// $('#pr_cust_billing_state' + cust_id).html($('#edit_billing_state').val());
		// $('#pr_cust_sales_tax' + cust_id).html($('#edit_sales_tax').val());

		// $('#edit_cust_id').val('');
		// $('#edit_cust_name').val();
		// $('#edit_cust_info').val();

	}

	function deleteCustomer(cust_id) {

		if (confirm("Are you sure?")) {
			$.ajax({
				type: "POST",
				dataType: "json",
				url: "<?php echo Yii::app()->request->baseUrl; ?>/quotation/deleteCustomer",
				data: {
					"cust_id": cust_id
				},
				success: function(resp) {

					if (resp.result == "success") {
						$('#tr_cust' + cust_id).fadeOut(500);
					} else {
						alert(resp.msg);
					}

				}
			});
		}

	}
</script>