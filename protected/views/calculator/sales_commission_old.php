<style>
	#parent {
		height: Auto;
		width: 100%;
	}

	#calculatorHeaderTable {
		width: 100% !important;
	}

	.bg-usd,
	.bg-cad,
	.bg-price {
		text-align: center;
		vertical-align: middle;
	}

	.pre {
		white-space: pre;
	}

	#freezer-Table .table tbody td {
		outline: 1px solid #ddd;
	}

	.text-left {
		text-align: left;
	}

	#addData .modal-dialog {
		width: 50% !important;
	}

	#addData .form-control {
		padding: 5px 10px;
	}

	.flex-header .close span {
		line-height: 30px;
		font-size: 25px;
		font-weight: 600;
	}

	.flex-header .modal-title {
		font-size: 17px;
	}

	.flex-header {
		display: flex;
	}

	.flex-header .close {
		color: #337AB7;
		position: absolute;
		right: 20px;
		top: 12px;
		padding: 1px 10px;
		background: #CED5DB;
	}

	#calculator .go-back-btn {
		position: absolute;
		right: 10px;
		top: 2px;
		background: #337AB7;
		border-radius: 4px;
		padding: 5px 15px;
		color: #FFF;
	}

	#calculator .x_content {
		margin-top: 0;
	}

	select#month_selected {
		width: 200px;
		padding: 2px 10px;
		background: #337ab714;
		font-size: 15px;
		border-radius: 2px;
		border: 2px solid #337ab70f;
		box-shadow: rgb(100 100 111 / 1%) 0px 7px 29px 0px;
	}

	.flex {
		display: flex;
		align-items: center;
		justify-content: space-between;
	}

	#calculator .flex {

		margin: 3px 0 0 0;
	}

	.table {
		margin: 0;
	}

	.search-form-div label {

		margin: 7px 0;
		font-weight: 500;
		font-size: 16px;
	}

	.search-form-div .form-control {
		font-size: 15px;
		padding: 0 10px;
		color: #606c76;
		text-transform: capitalize;
	}

	.search-form-div .button-div {
		text-align: left;
		margin-top: 20px;
	}

	.search-form-div .go-back-btn {
		border: none;
		padding: 6px 30px;
	}

	.search-form-div .submit-btn {
		background: #5CB85C;
		color: #FFF;
	}

	.search-form-div .btn {
		padding: 6px 30px;
	}

	td i.fa.fa-pencil {
		background: none;
	}

	.search-form-div .clear-btn {
		background: #444644;
		color: #FFF;
	}

	.search-form-div input[type=checkbox] {
		margin: 4px 0 0;
		width: 20px;
		height: 20px;
		margin: 0 10px 0 0;
	}

	.d-flex {
		display: flex;
		align-items: center;
	}

	.search-form-div span {
		margin-right: 10px;
		font-family: sans-serif;
	}

	.form-status span {
		font-family: sans-serif;
		font-size: 15px;
	}

	.form-status label {
		width: 300px;
	}

	.relative {
		position: relative;
	}

	.relative .paf_dowload {
		position: absolute;
		top: -30px;
	}

	.last-update {
		color: #FFF;
		font-size: 14px;
		background: #ea6153d6;
		padding: 5px 10px;
		display: inline-block;
		border-radius: 5px;
	}

	.default-tables .btn-warning {
		padding: 5px 20px;
	}

	.tbl-btn-box .btn {}

	.row.form-status {
		border-top: 1px solid #d3cccc;
		border-bottom: 1px solid #d3cccc;
		margin: 15px 0;
		padding: 20px 0;
		background: #fffafa;
	}

	.TableUpperBtns .paf_dowload {
		position: relative;
		top: 7px;
		height: 30px;
		margin: 0;
		font-size: 12px;
		float: unset;
		text-align: center;
	}

	.TableUpperBtns {
		position: static;
		display: grid;
		grid-template-columns: 100px 100px;
		gap: 10px;
	}

	@media screen and (max-width:520px) {
		#addData .modal-dialog {
			width: 100% !important;
		}

		.flex-header .modal-title {
			font-size: 16px;
			width: 80%;
		}
	}
</style>
<script>
	$(document).ready(function() {
		$("#calculatorHeaderTable").tableHeadFixer({
			"left": 0
		});

	});
</script>
<?php
if (isset($_POST['is_modal_open'])) {
	$invoice_num_rav = $_POST['invoice_num'];
	$order_num_rav = $_POST['order_num'];
	$invoice_link_rav = $_POST['invoice_link'];
?>
	<script>
		$(document).ready(function() {
			var invoice_num_rav = '<?= $invoice_num_rav ?>';
			var order_num_rav = '<?= $order_num_rav ?>';
			var invoice_link_rav = '<?= $invoice_link_rav ?>';
			$('#Calculator_invoice').val(invoice_num_rav);
			$('#Calculator_order_no').val(order_num_rav);
			$('#Calculator_inv_link').val(invoice_link_rav);
			$('#addData').modal('show');
		})
	</script>


<?php
}
?>
<?php

if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] == Yii::app()->getBaseUrl(true) . '/order/list') { ?>
	<script>
		$(document).ready(function() {

			$('#addData').modal('show');
		})
	</script>
<?php }   ?>
<div class="row" id="calculator">

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<div class="row mt-20">
					<div class="col-md-12 ">
						<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/sales/year/<?php echo $year_commission; ?>" class="link go-back-btn">
							<i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Go Back
						</a>
					</div>
				</div>
				<div>
					<h2>Invoice</h2>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<h2 class="flex"> <?php echo $sales_commission . " - " . $year_commission . " "; ?>
					<select id="month_selected" onchange="return changeMonthSelected();">
						<option value="">==All==</option>
						<?php
						if (!isset($month_commission)) {
							$month_commission = "";
						}
						for ($i = 1; $i <= 12; $i++) {
							$tmp_month = "";
							if ($i < 10) {
								$tmp_month .= "0";
							}
							$tmp_month .= $i;
							$tmp_date = "2020-" . $tmp_month . "-01";
							$show_month = date("F", strtotime($tmp_date));
						?>
							<option value="<?php echo $tmp_month; ?>" <?php if ($tmp_month == $month_commission) {
																			echo "selected";
																		} ?>><?php echo $show_month; ?></option>
						<?php
						}
						?>
					</select>
					<script type="text/javascript">
						function changeMonthSelected() {

							var month_selected = $('#month_selected').val();

							window.location.href = '<?php echo Yii::app()->baseUrl; ?>/calculator/SalesCommission/year/<?php echo $year_commission; ?>/sales/<?php echo $sales_commission; ?>/month/' + month_selected;
						}
					</script>
				</h2>

				<!--<a href="<?php echo Yii::app()->baseUrl; ?>/pdf/commissionSale/year/<?php echo $year_commission; ?>/sale/<?php echo $sales_commission; ?>" class="paf_dowload" target="_blank"> PDF (ALL)</a>-->

				<div>
					<?php
					$getDate = Yii::app()->db->createCommand('select MAX(update_date) AS datedata  from calculator where sales_manager = "' . $sales_commission . '" order by id DESC limit 1')->queryAll();

					foreach ($getDate as $key_date => $value_date) {
						$datedata = $value_date['datedata'];
					}

					if ($datedata != "0000-00-00") {

						$_month_name = array("01" => "January", "02" => "February", "03" => "March", "04" => "April", "05" => "May", "06" => "June", "07" => "July", "08" => "August", "09" => "September", "10" => "October", "11" => "November", "12" => "December");

						list($year, $momth, $day) = explode("-", $datedata);

						if ($day < 10) {
							$day = substr($day, 1, 2);
						}

						$date = $_month_name[$momth] . " " . $day . ",  " . $year;
					} else {
						$date = " - ";
					}
					?>
					<h6 class="last-update">Last Update! : <?php echo $date ?><span>
				</div>
				<?php /*
						foreach ($getData as $key_data => $value_data) {	
						
						$getSale = Yii::app()->db->createCommand()
						->select('*')
						->from('calculator scal')
						->where('scal.sales_manager = "'.$value_data['sales_manager'].'"')
						->andwhere('scal.status_commission = "Approved"')
						//->andwhere('scal.commisson_payment_status = "Paid"')
						->andwhere('scal.currency = "'.$value_data['currency'].'"')
						->order('scal.update_date DESC')
						->queryAll();
						
						foreach ($getSale as $key => $value) {
							
							if($value['currency'] == "USD"){
								
								if($value['invoice_status'] == "Paid"){	
									//$result['sumtotalUSD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
									//$sumCommissionPaymaentUSD += $value_data['pay_for_sales'];
									
									//$totalcommissionUSD +=  $value['commission'];
									//$payoutUSD +=  $value['pay_for_sales'];
									/*
									if($value['commisson_payment_status'] == "Paid"){
										$commissionPaymentUSD +=  $value['commission'] - $value['pay_for_sales'];
									}else{
										$commissionPaymentUSD += $value['commission'];
									}
									*/	/*								
								}
							}
							if($value['currency'] == "CAD"){
								
								if($value['invoice_status'] == "Paid"){	

									//$result['sumtotalCAD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
									//$sumCommissionPaymaentCAD += $value_data['pay_for_sales'];
									//$totalcommissionCAD +=  $value['commission'];
									//$payoutCAD +=  $value['pay_for_sales'];
									/*
									if($value['commisson_payment_status'] == "Paid"){
										$commissionPaymentCAD +=  $value['commission'] - $value['pay_for_sales'];
									}else{
										$commissionPaymentCAD += $value['commission'];
									}
									*//*
								}		
							}
							if($value['currency'] == "SGD"){
								
								if($value['invoice_status'] == "Paid"){	

									//$result['sumtotalSGD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
									//$sumCommissionPaymaentSGD += $value_data['pay_for_sales'];
									//$totalcommissionSGD +=  $value['commission'];
								//	$payoutSGD +=  $value['pay_for_sales'];
								/*	
									if($value['commisson_payment_status'] == "Paid"){
										$commissionPaymentSGD +=  $value['commission'] - $value['pay_for_sales'];
									}else{
										$commissionPaymentSGD += $value['commission'];
									}
									*//*
								}		
							}
							if($value['currency'] == "THB"){
								
								if($value['invoice_status'] == "Paid"){	

									//$result['sumtotalTHB'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
									//$sumCommissionPaymaentTHB += $value_data['pay_for_sales'];
									//$totalcommissionTHB +=  $value['commission'];
									//$payoutTHB +=  $value['pay_for_sales'];
								/*	
									if($value['commisson_payment_status'] == "Paid"){
										$commissionPaymentTHB +=  $value['commission'] - $value['pay_for_sales'];
									}else{
										$commissionPaymentTHB += $value['commission'];
									}
									*//*
								}		
							}
							
							
						}
					}*/
				?>
				<?php if ($sumtotalUSD != 0 || $sumtotalCAD != 0 || $sumtotalSGD != 0 || $sumtotalTHB != 0) { ?>
					<div id="parent">
						<table id="calculatorHeaderTable" class="table table-striped table-bordered" style="border-collapse: initial;">
							<thead>
								<tr>
									<?php if ($sumtotalUSD != 0) {  ?>
										<th colspan="5" class="text-left" style="background-color: #337AB7;color:#fff;font-weight: 700;">
											<span> USD </span>
										</th>
									<?php	}
									if ($sumtotalCAD != 0) {  ?>
										<th colspan="5" class="text-left" style="background-color:#337AB7;color:#fff;font-weight: 700;">
											<span> CAD </span>
										</th>
									<?php	}
									if ($sumtotalSGD != 0) {  ?>
										<th colspan="5" class="text-left" style="background-color:#337AB7;color:#fff;font-weight: 700;">
											<span> SGD </span>
										</th>
									<?php	}
									if ($sumtotalTHB != 0) {  ?>
										<th colspan="5" class="text-left" style="background-color:#337AB7;color:#fff;font-weight: 700;">
											<span> THB </span>
										</th>
									<?php	} ?>
								</tr>
								<tr>
									<?php if ($sumtotalUSD != 0) {  ?>
										<th class="nowrap" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;font-weight: 500;">Total Sales</th>
										<th class="nowrap" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;font-weight: 500;">Total commissions<br>Earned</th>
										<th class="nowrap" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;font-weight: 500;">Balance</th>
										<th class="nowrap" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;font-weight: 500;">Payment received<br>from customer<br>/ Adjustment</th>
										<th class="nowrap" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;font-weight: 500;">Remaining Credit<br>owe to JOG</th>
									<?php	}
									if ($sumtotalCAD != 0) {  ?>
										<th class="nowrap" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;font-weight: 500;">Total Sales</th>
										<th class="nowrap" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;font-weight: 500;">Total commissions<br>Earned</th>
										<th class="nowrap" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;font-weight: 500;">Balance</th>
										<th class="nowrap" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;font-weight: 500;">Payment received<br>from customer<br>/ Adjustment</th>
										<th class="nowrap" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;font-weight: 500;">Remaining Credit<br>owe to JOG</th>
									<?php	}
									if ($sumtotalSGD != 0) {  ?>
										<th class="nowrap" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;font-weight: 500;">Total Sales</th>
										<th class="nowrap" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;font-weight: 500;">Total commissions<br>Earned</th>
										<th class="nowrap" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;font-weight: 500;">Balance</th>
										<th class="nowrap" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;font-weight: 500;">Payment received<br>from customer<br>/ Adjustment</th>
										<th class="nowrap" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;font-weight: 500;">Remaining Credit<br>owe to JOG</th>
									<?php	}
									if ($sumtotalTHB != 0) {  ?>
										<th class="nowrap" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;font-weight: 500;">Total Sales</th>
										<th class="nowrap" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;font-weight: 500;">Total commissions<br>Earned</th>
										<th class=" nowrap" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;font-weight: 500;">Balance</th>
										<th class="nowrap" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;font-weight: 500;">Payment received<br>from customer<br>/ Adjustment</th>
										<th class="nowrap" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;font-weight: 500;">Remaining Credit<br>owe to JOG</th>
									<?php	} ?>
								</tr>
							</thead>
							<tbody>

								<tr>
									<?php if ($sumtotalUSD != 0) {
										if (!isset($totalPayByCustomerUSD)) {
											$totalPayByCustomerUSD = 0;
										}
										if (!isset($payCreditUSD)) {
											$payCreditUSD = 0;
										}
									?>
										<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">
											<span><?php echo "$ " . number_format($sumtotalUSD, 2); ?> </span>
										</td>
										<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">
											<span><?php echo "$ " . number_format($totalcommissionUSD, 2); ?> </span>
										</td>
										<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">
											<?php if ($commissionPaymentUSD == 0) { ?>
												<span><?php echo "$ " . number_format($commissionPaymentUSD, 2); ?></span>
											<?php } else { ?>
												<span style="color:#c50202;padding:5px 10px;font-weight: 700;"><?php echo "$ " . number_format($commissionPaymentUSD, 2); ?></span>
											<?php } ?>
										</td>
										<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">
											<span><?php echo "$ " . number_format($totalPayByCustomerUSD, 2); ?> </span>
										</td>
										<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">
											<?php
											$remain_credit = $totalPayByCustomerUSD - $payCreditUSD;
											echo '<span style="color:#c50202;padding:5px 10px;font-weight: 700;">$ ' . number_format($remain_credit, 2) . '</span>';
											?>
										</td>
									<?php	}
									if ($sumtotalCAD != 0) {
										if (!isset($totalPayByCustomerCAD)) {
											$totalPayByCustomerCAD = 0;
										}
										if (!isset($payCreditCAD)) {
											$payCreditCAD = 0;
										}
									?>
										<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">
											<span><?php echo "$ " . number_format($sumtotalCAD, 2); ?></span>
										</td>
										<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">
											<span><?php echo "$ " . number_format($totalcommissionCAD, 2); ?></span>
										</td>
										<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">

											<?php if ($commissionPaymentCAD == 0) { ?>
												<span><?php echo "$ " . number_format($commissionPaymentCAD, 2); ?></span>
											<?php } else { ?>
												<span style="color:#c50202;padding:5px 10px;font-weight: 700;"><?php echo "$ " . number_format($commissionPaymentCAD, 2); ?></span>
											<?php } ?>
										</td>
										<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">
											<span><?php echo "$ " . number_format($totalPayByCustomerCAD, 2); ?> </span>
										</td>
										<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">
											<?php
											$remain_credit = $totalPayByCustomerCAD - $payCreditCAD;
											echo '<span style="color:#c50202;padding:5px 10px;font-weight: 700;">$ ' . number_format($remain_credit, 2) . '</span>';
											?>
										</td>
									<?php	}
									if ($sumtotalSGD != 0) {
										if (!isset($totalPayByCustomerSGD)) {
											$totalPayByCustomerSGD = 0;
										}
										if (!isset($payCreditSGD)) {
											$payCreditSGD = 0;
										}
									?>
										<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">
											<span><?php echo "$ " . number_format($sumtotalSGD, 2); ?> </span>
										</td>
										<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">
											<span><?php echo "$ " . number_format($totalcommissionSGD, 2); ?> </span>
										</td>
										<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">

											<?php if ($commissionPaymentSGD == 0) { ?>
												<span><?php echo "$ " . number_format($commissionPaymentSGD, 2); ?></span>
											<?php } else { ?>
												<span style="color:#c50202;padding:5px 10px;font-weight: 700;"><?php echo "$ " . number_format($commissionPaymentSGD, 2); ?></span>
											<?php } ?>
										</td>
										<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">
											<span><?php echo "$ " . number_format($totalPayByCustomerSGD, 2); ?> </span>
										</td>
										<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">
											<?php
											$remain_credit = $totalPayByCustomerSGD - $payCreditSGD;
											echo '<span style="color:#c50202;padding:5px 10px;font-weight: 700;">$ ' . number_format($remain_credit, 2) . '</span>';
											?>
										</td>
									<?php	}
									if ($sumtotalTHB != 0) {
										if (!isset($totalPayByCustomerTHB)) {
											$totalPayByCustomerTHB = 0;
										}
										if (!isset($payCreditTHB)) {
											$payCreditTHB = 0;
										}
									?>
										<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">
											<span><?php echo "฿ " . number_format($sumtotalTHB, 2); ?></span>
										</td>
										<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">
											<span><?php echo "฿ " . number_format($totalcommissionTHB, 2); ?></span>
										</td>
										<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">

											<?php if ($commissionPaymentTHB == 0) { ?>
												<span><?php echo "฿ " . number_format($commissionPaymentTHB, 2); ?></span>
											<?php } else { ?>
												<span style="color:#c50202;padding:5px 10px;font-weight: 700;"><?php echo "฿ " . number_format($commissionPaymentTHB, 2); ?></span>
											<?php } ?>
										</td>
										<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">
											<span><?php echo "$ " . number_format($totalPayByCustomerTHB, 2); ?> </span>
										</td>
										<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">
											<?php
											$remain_credit = $totalPayByCustomerTHB - $payCreditTHB;
											echo '<span style="color:#c50202;padding:5px 10px;font-weight: 700;">$ ' . number_format($remain_credit, 2) . '</span>';
											?>
										</td>
									<?php	} ?>
								</tr>

							</tbody>
						</table>

					</div>
					<br>
				<?php } ?>
				<div class="col-md-12 search-form-div">

					<form id="form_checkbox1" class="form-horizontal" action="<?php echo Yii::app()->request->baseUrl; ?>/calculator/seach" method="post">
						<input type="hidden" name="sale_rep" value="<?php echo $sales_commission; ?>">
						<input type="hidden" name="year_commission" value="<?php echo $year_commission; ?>">

						<h4 style="font-weight: 700; color:#337AB7;border-bottom: 1px solid #d3cccc;padding-bottom:10px;">SEARCH :</h4>
						<div class="row">
							<div class="col-md-6">
								<label> Invoice : </label>
								<div>
									<input type="text" name="search_invoice" class="form-control" value="<?php echo isset($search_invoice) ? $search_invoice : ""; ?>">
									<input type="hidden" name="search_invoice2" value="">
								</div>
							</div>

							<div class="col-md-6">
								<label> Order No. : </label>
								<div>
									<input type="text" name="search_orderno" class="form-control" value="<?php echo isset($search_orderno) ? $search_orderno : ""; ?>">
									<input type="hidden" name="search_orderno2" value="">
								</div>
							</div>
							<div class="col-md-6">
								<label> Date Quarter : </label>
								<div>
									<input type="text" name="search_dateQuarter" class="form-control" id="search_dateQuarter" value="<?php if (!empty($search_dateQuarter)) {
																																			echo $search_dateQuarter;
																																		} ?>" style="float: left;" onfocus="blur()">
								</div>
							</div>
							<div class="col-md-6">
								<label> - </label>
								<div>
									<input type="text" name="search_dateQuarter2" class="form-control" id="search_dateQuarter2" value="<?php if (!empty($search_dateQuarter2)) {
																																			echo $search_dateQuarter2;
																																		} ?>" onfocus="blur()">
								</div>
							</div>
							<div class="col-md-12">
								<label> Order Name : </label>
								<div>
									<input type="text" name="search_ordername" class="form-control" value="<?php if (!empty($search_ordername)) {
																												echo $search_ordername;
																											} ?>">
								</div>
							</div>
							<div class="col-md-4">
								<label> Invoice Status: </label>
								<div class="d-flex">
									<input class="invoice_status" type="checkbox" name="invoice_status" value="Paid" <?php if ($invoice_status == "Paid") {
																															echo "checked";
																														} ?>> <span>Paid</span>
									<input class="invoice_status" type="checkbox" name="invoice_status" value="Outstanding" <?php if ($invoice_status == "Outstanding") {
																																echo "checked";
																															} ?>> <span> Outstanding</span>
								</div>
							</div>
							<div class="col-md-4">
								<label>Approved Status:</label>
								<div class="d-flex">
									<input class="aproved_status" type="checkbox" name="aproved_status" value="Pending" <?php if ($aproved_status == "Pending") {
																															echo "checked";
																														} ?>> <span>Pending</span>
									<input class="aproved_status" type="checkbox" name="aproved_status" value="Approved" <?php if ($aproved_status == "Approved") {
																																echo "checked";
																															} ?>> <span>Approved</span>
									<input class="aproved_status" type="checkbox" name="aproved_status" value="Not Approved" <?php if ($aproved_status == "Not Approved") {
																																	echo "checked";
																																} ?>> <span>Not Approved</span>
								</div>
							</div>
							<div class="col-md-4">
								<label>Commission Status:</label>
								<div class="d-flex">
									<input class="commission_status" type="checkbox" name="commission_status" value="Paid" <?php if ($commission_status == "Paid") {
																																echo "checked";
																															} ?>> <span>Paid</span>
									<input class="commission_status" type="checkbox" name="commission_status" value="Outstanding" <?php if ($commission_status == "Outstanding") {
																																		echo "checked";
																																	} ?>> <span>Outstanding</span>
								</div>
							</div>
							<div class="col-md-12 button-div">
								<input type="button" value="Clear" class="btn clear-btn" onclick="window.location.href='<?php echo Yii::app()->request->baseUrl; ?>/calculator/SalesCommission/year/<?php echo $year_commission; ?>/sales/<?php echo $sales_commission; ?>'" />
								<input type="submit" value="Submit" class=" btn submit-btn">
							</div>

						</div>

				</div>



				<div class="row">

					</form>
					<script type="text/javascript">
						$(function() {

							$(".invoice_status").click(function() { // เมื่อคลิก checkbox  ใดๆ  
								if ($(this).prop("checked") == true) { // ตรวจสอบ property  การ ของ   
									var indexObj = $(this).index(".invoice_status"); //   
									$(".invoice_status").not(":eq(" + indexObj + ")").prop("checked", false); // ยกเลิกการคลิก รายการอื่น  
								}
							});

							$(".aproved_status").click(function() { // เมื่อคลิก checkbox  ใดๆ  
								if ($(this).prop("checked") == true) { // ตรวจสอบ property  การ ของ   
									var indexObj = $(this).index(".aproved_status"); //   
									$(".aproved_status").not(":eq(" + indexObj + ")").prop("checked", false); // ยกเลิกการคลิก รายการอื่น  
								}
							});

							$(".commission_status").click(function() { // เมื่อคลิก checkbox  ใดๆ  
								if ($(this).prop("checked") == true) { // ตรวจสอบ property  การ ของ   
									var indexObj = $(this).index(".commission_status"); //   
									$(".commission_status").not(":eq(" + indexObj + ")").prop("checked", false); // ยกเลิกการคลิก รายการอื่น  
								}
							});



						});
					</script>
					<br>

				</div>

				<div class="row form-status">
					<div class="col-md-12">
						<div class="">
							<span>Commission Status : </span>
							<i class="fa fa-square" aria-hidden="true" style="color:#5CB85C; font-weight: 600;font-size: 15px;"> Approved </i>&nbsp; &nbsp; <i class="fa fa-square" aria-hidden="true" style="color:#E65E52; font-weight: 600;font-size: 15px;"> Not Approved </i>&nbsp; &nbsp;<i class="fa fa-square" aria-hidden="true" style="color:#fd9c04; font-weight: 600;font-size: 15px;"> Pending </i>
						</div>
						<div>

							<span>Invoice Status : </span>
							<i class="fa fa-square" aria-hidden="true" style="color:#5CB85C; font-weight: 600;font-size: 15px;"> Paid </i>&nbsp; &nbsp; <i class="fa fa-square" aria-hidden="true" style="color:#E65E52; font-weight: 600;font-size: 15px;"> Outstanding </i>
						</div>
						<div>
							<span>Invoice Mailing Status : </span>
							<i class="fa fa-envelope"></i> Sent </i>&nbsp;&nbsp;<i class="fa fa-envelope-o"></i> Not Send </i>&nbsp;&nbsp;
						</div>
						<div>
							<span>Position Responsible : </span>
							<a href="<?php echo Yii::app()->baseUrl; ?>/calculator/SalesPosition/year/<?php echo $year_commission; ?>/sales/<?php echo $sales_commission; ?>/positions/All"><i class="fa fa-user" aria-hidden="true"></i> ALL </a> &nbsp;&nbsp;
							<a href="<?php echo Yii::app()->baseUrl; ?>/calculator/SalesPosition/year/<?php echo $year_commission; ?>/sales/<?php echo $sales_commission; ?>/positions/1"><i class="fa fa-user" aria-hidden="true"></i> Sales Manager (M)</a> &nbsp;&nbsp;
							<a href="<?php echo Yii::app()->baseUrl; ?>/calculator/SalesPosition/year/<?php echo $year_commission; ?>/sales/<?php echo $sales_commission; ?>/positions/2"><i class="fa fa-user" aria-hidden="true"></i> Sales Rep (R)</a> &nbsp;&nbsp;
							<a href="<?php echo Yii::app()->baseUrl; ?>/calculator/SalesPosition/year/<?php echo $year_commission; ?>/sales/<?php echo $sales_commission; ?>/positions/3"><i class="fa fa-user" aria-hidden="true"></i> Processor (P) </a>
						</div>
					</div>
				</div>
				<div class="row default-tables">
					<div class="col-md-12">
						<div class="btn-add">
							<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#addData" data-id="<?php echo $sales_commission; ?>"><i class="fa fa-plus"></i> Add</a>
							<?php
							$is_search_by_date = false;
							if ((Yii::app()->controller->action->id == "seach") && ($search_dateQuarter != "") && ($search_dateQuarter2 != "")) {

								$is_search_by_date = true;
							?>
								<form id="form_search_pdf" target="_blank" action="" method="post">
									<input type="hidden" name="search_date_start" id="search_date_start" value="">
									<input type="hidden" name="search_date_end" id="search_date_end" value="">
									<input type="hidden" name="search_invoice_form" id="search_invoice_form" value="<?php echo isset($search_invoice) ? $search_invoice : ""; ?>">
									<input type="hidden" name="search_orderno_form" id="search_orderno_form" value="<?php echo isset($search_orderno) ? $search_orderno : ""; ?>">
									<input type="hidden" name="search_ordername_form" id="search_ordername_form" value="<?php if (!empty($search_ordername)) {
																															echo $search_ordername;
																														} ?>">
									<input type="hidden" name="invoice_status_form" id="invoice_status_form" value="<?php echo isset($invoice_status) ? $invoice_status : ""; ?>">
									<input type="hidden" name="aproved_status_form" id="aproved_status_form" value="<?php echo isset($aproved_status) ? $aproved_status : ""; ?>">
									<input type="hidden" name="commission_status_form" id="commission_status_form" value="<?php echo isset($commission_status) ? $commission_status : ""; ?>">
								</form>
								<script type="text/javascript">
									function showPDFSearchResult(curr_name) {

										if ($('#search_dateQuarter').val() == "" || $('#search_dateQuarter2').val() == "") {
											alert("Please fill Date Quarter.");
											return false;
										} else {

											$('#form_search_pdf').attr("action", "<?php echo Yii::app()->baseUrl; ?>/pdf/commissionSale" + curr_name + "/year/<?php echo $year_commission; ?>/sale/<?php echo $sales_commission; ?>");

											$('#search_date_start').val($('#search_dateQuarter').val());
											$('#search_date_end').val($('#search_dateQuarter2').val());

											$('#form_search_pdf').submit();

										}


									}
								</script>
							<?php
							}
							?>
						</div>
					</div>
				</div>


				<?php
				$currency_curr = array_unique($currency);

				foreach ($currency_curr as $curr) {

					if ($curr == "USD") { ?>
						<div class="relative" style="">
							<?php
							if ($is_search_by_date) {
							?>
								<a style="cursor: pointer;" class="paf_dowload" onclick="return showPDFSearchResult('USD');"> PDF (USD)</a>
							<?php
							} else {
							?>
							
								<a href="<?php echo Yii::app()->baseUrl; ?>/pdf/commissionSaleUSD/year/<?php echo $year_commission; ?>/sale/<?php echo $sales_commission; ?>/month/<?php echo $month_commission; ?>" class="paf_dowload" target="_blank"> PDF (USD)</a>
								<a href="<?php echo Yii::app()->baseUrl; ?>/pdf/commissionSaleUSDEX/year/<?php echo $year_commission; ?>/sale/<?php echo $sales_commission; ?>/month/<?php echo $month_commission; ?>" class="btn btn-info paf_dowload" target="_blank" style="margin-left: 100px;"> Excel (USD) </a>
								<div>
								</div>
							<?php
							}
							?>
						</div>
						<br>
						<div class="text-center" style="background-color:rgb(169, 185, 199);color:rgb(51, 67, 80);padding: 10px 0">
							<h4 style="font-weight: 700;"><?php echo  $curr; ?> </h4>
						</div>
						<div id="freezer-Table" style="margin:0">
							<table id="calculatorUSDcomTable" class="table table-striped table-bordered data_invoice table-condensed table-freeze-multi" style="border-collapse: initial;" data-scroll-max-height="600" data-cols-number="5">
								<colgroup>
									<col>
									<col style="width:150px;">
									<col style="width:120px;">
									<col style="width:150px;">
									<col style="width:100px;">
									<col style="width:80px;">
									<col style="width:120px;">
									<col style="width:120px;">
									<col style="width:160px;">
									<col style="width:100px;">
									<col style="width:160px;">
									<col style="width:160px;">
									<col style="width:100px;">
									<col style="width:150px;">
									<col style="width:200px;">
									<col style="width:110px;">
								</colgroup>
								<thead>

									<tr>
										<th colspan="" class="" style="background-color:#89939c;color:rgb(51, 67, 80);text-align:left;"> </th>
										<th colspan="4" class="" style="background-color:#89939c;color:rgb(51, 67, 80);text-align:left;"> Invoice </th>
										<th colspan="2" class="" style="background-color:#89939c;color:rgb(51, 67, 80);text-align:left;"> Invoice Payment Status </th>
										<th colspan="" class="" style="background-color:#89939c;color:rgb(51, 67, 80);text-align:left;"> Position Responsible </th>
										<th colspan="4" class="" style="background-color:#89939c;color:rgb(51, 67, 80);text-align:left;"> Commission Calculator</th>

										<th colspan="2" class="" style="background-color:#89939c;color:rgb(51, 67, 80);text-align:left;"> Commission Payment Status </th>
										<th colspan="" class="" style="background-color:#89939c;color:rgb(51, 67, 80);text-align:left;"> Comment </th>
										<th colspan="" class="" style="background-color:#89939c;color:rgb(51, 67, 80);text-align:left;"> Update
										</th>
									</tr>
									<tr>
										<th class="bg-blue-light text-center" style="text-align: left;"> </th>
										<th class="bg-blue-light " style="text-align: left;"> Invoice # </th>
										<th class="bg-blue-light text-center" style="text-align: left;"> Order No. </th>
										<th class="bg-blue-light text-center" style="text-align: left;"> Order Name <br><span style="color:#fd6262;font-size:11px;">** Click Order Name ** <br> for Commission Calculator </span></th>
										<th class="bg-blue-light text-center" style="text-align: left;"> Date/Quarter </th>

										<th class="bg-blue-light text-center" style="text-align: left;"> Invoice Status</th>
										<th class="bg-blue-light text-center" style="text-align: left;"> Amount Received</th>

										<th class="bg-blue-light text-center" style="text-align: left;"> Position</th>

										<th class="bg-blue-light text-center" style="text-align: left;"> Total Sales </th>
										<th class="bg-blue-light text-center" style="text-align: left;"> Commission% </th>
										<th class="bg-blue-light text-center" style="text-align: left;"> Commission </th>
										<th class="bg-blue-light text-center" style="text-align: left;"> Balance </th>

										<th class="bg-blue-light text-center" style="text-align: left;"> Commission Status</th>
										<th class="bg-blue-light text-center" style="text-align: left;"> Commission Payment</th>

										<th class="bg-blue-light text-center" style="text-align: left;"> Comments </th>
										<th class="bg-blue-light text-center" style="text-align: left;"> Last Update </th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($getData as $key => $value) {
										if ($value['currency'] ==   $curr) {


									?>
											<tr style="background: #ffffff;">

												<td class="tbl-btn-box nowrap" style="vertical-align: middle;">
													<button class=" btn btn-success uu" data-toggle="modal" data-target="#editData" data-id="<?php echo $value['id']; ?>">
														<i class="fa fa-pencil"></i>
													</button>
													<button class="btn btn-danger confirm" del-id="<?php echo $value['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/calculator/deleteInvoice">
														<i class="fa fa-close"></i>
													</button>
												</td>

												<td class="text-left nowrap" style="vertical-align: middle;">
													<?php if ($value['file_path'] != "Array" && $value['file_path'] != "") { ?>
														<a href="<?php echo Yii::app()->request->baseUrl; ?>/invoice/docs/<?php echo $value['file_path']; ?>" target="_blank">
															<?php echo $value['invoice']; ?>
														</a>
													<?php } else { ?>
														<span style="color:red;">
															<?php echo $value['invoice']; ?>
														</span>
													<?php
													} ?>
													<?php if ($value['invoice_mail_status'] == "Send") { ?>
														&nbsp; <a href="#" data-toggle="modal" data-target="#editSendMail" data-id="<?php echo $value['id']; ?>" title="Send E-mail to Customer"><i class="fa fa-envelope"></i></a>
													<?php } else { ?>
														&nbsp; <a href="#" data-toggle="modal" data-target="#editSendMail" data-id="<?php echo $value['id']; ?>" title="Send E-mail to Customer"><i class="fa fa-envelope-o"></i></a>
													<?php }

													if ($value['inv_link'] != "") {
													?>
														&nbsp; <a href="<?php echo $value['inv_link']; ?>" target="_blank" title="Invoice link"><i class="fa fa-link"></i></a>
													<?php
													}
													?>
												</td>
												<td class="text-left nowrap" style="vertical-align: middle;text-align: left">
													<div class="col-md-12" style="vertical-align: middle;">
														<?php
														$data_order_no = str_replace(" ", '<br />', $value['order_no']);
														echo $data_order_no;
														?>
													</div>
												</td>
												<td class="text-left " style="vertical-align: middle;">
													<div class="col-md-1" style="vertical-align: middle;text-align:left;">
														<?php
														if ($value['invoice_status'] == "Paid") { ?>
															<i class="fa fa-square" aria-hidden="true" style="color:green;display: initial;"></i>&nbsp;
														<?php
														} elseif ($value['invoice_status'] == "Outstanding") { ?>

															<i class="fa fa-square" aria-hidden="true" style="color:red;display: initial;"></i>&nbsp;
														<?php }	?>
													</div>
													<div class="col-md-10" style="vertical-align: middle;text-align:left;">
														<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/commission/year/<?php echo $year_commission; ?>/id/<?php echo $value['id']; ?>"><?php echo nl2br($value['order_name']); ?> </a>
													</div>
												</td>
												<?php
												$_month_name = array(
													"01" => "Jan.",  "02" => "Feb.",  "03" => "Mar.",
													"04" => "Apr.",  "05" => "May.",  "06" => "Jun.",
													"07" => "Jul.",  "08" => "Aug.",  "09" => "Sep.",
													"10" => "Oct.", "11" => "Nov.",  "12" => "Dec."
												);

												$vardate = $value['date_quarter'];
												list($year, $momth, $day) = explode("-", $vardate);
												$yy = $year;
												$mm = $momth;
												$dd = $day;

												if ($dd < 10) {
													$dd = substr($dd, 1, 2);
												}
												$date = $_month_name[$mm] . " " . $dd . ",  " . $yy;
												if ($mm == "01" || $mm == "02" || $mm == "03") {
													$quarter = "QTR 1";
												} elseif ($mm == "04" || $mm == "05" || $mm == "06") {
													$quarter = "QTR 2";
												} elseif ($mm == "07" || $mm == "08" || $mm == "09") {
													$quarter = "QTR 3";
												} elseif ($mm == "10" || $mm == "11" || $mm == "12") {
													$quarter = "QTR 4";
												}
												//echo $date;
												?>
												<td class="text-center " style="vertical-align: middle;"> <?php echo $date . "/<br>" . $quarter; ?> </td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['invoice_status'] == "Outstanding") {
														echo "<span style=\"color:red\">" . $value['invoice_status'] . "</span>";
													} else {
														echo "<span> " . $value['invoice_status'] . "</span>";
													}
													?>

												</td>

												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['invoice_status'] == "Paid") {
														if (!empty($value['invoice_amount_received'])) {
															echo "<span > $ " . number_format($value['invoice_amount_received'], 2) . " " . $value['currency'] . "</span><br>";
														}
														if ($value['invoice_date'] != "0000-00-00") {
															$_month_name_int = array(
																"01" => "Jan.",  "02" => "Feb.",  "03" => "Mar.",
																"04" => "Apr.",  "05" => "May.",  "06" => "Jun.",
																"07" => "Jul.",  "08" => "Aug.",  "09" => "Sep.",
																"10" => "Oct.", "11" => "Nov.",  "12" => "Dec."
															);

															$invoicedate = $value['invoice_date'];

															list($year_int, $momth_int, $day_int) = explode("-", $invoicedate);

															$yy_int = $year_int;
															$mm_int = $momth_int;
															$dd_int = $day_int;
															if ($dd_int < 10) {
																$dd_int = substr($dd_int, 1, 2);
															}
															$date_int = $_month_name_int[$mm_int] . " " . $dd_int . ",  " . $yy_int;

															echo "<span style=\"font-size:11px\">(Date : " . $date_int . ")</span><br>";
														}
													}
													?>

												</td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['sales_status'] == "1") {
														echo "<span style=\"font-weight: 700;\">Sales Manager</span>";
													} elseif ($value['sales_status'] == "2") {
														echo "<span style=\"font-weight: 700;\">Sales Rep</span>";
													} elseif ($value['sales_status'] == "3") {
														echo "<span style=\"font-weight: 700;\">Processor</span>";
													}
													?>
												</td>
												<td class="text-l nowrap" style="vertical-align: middle;">
													<?php
													$totalsale = ((($value['total_sales'] - $value['shipping_cost']) - $value['creditcard_feecost']) - $value['comp_itemcost']);

													if ($value['total_sales'] != 0) {
														if ($value['status_commission'] == "Approved") { ?>
															<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
														<?php
														} elseif ($value['status_commission'] == "Not Approved") { ?>

															<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
														<?php } else {	?>
															<i class="fa fa-square" aria-hidden="true" style="color:#e68c00"></i>&nbsp;
													<?php }

														echo "$ " . number_format($totalsale, 2) . " " . $value['currency'];
													} else {
														echo "";
													}
													?>
												</td>
												<td class="text-center nowrap" style="vertical-align: middle;">

													<?php

													if ($value['total_sales'] != 0) {
														echo $value['commission_percent'] . "%";
													} else {
														echo "";
													}
													?>
												</td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php

													if ($value['total_sales'] != 0) {
														echo "$ " . number_format($value['commission'], 2) . " " . $value['currency'];
													} else {
														echo "";
													}
													?>
												</td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['invoice_status'] == "Paid") {
														if ($value['commisson_payment_status'] == "Paid") {

															$balance_invoice = ($value['commission'] - $value['pay_for_sales']) - $value['pay_by_credit'];
															if ($balance_invoice != 0) {
																echo "<span style=\"color:red\"> $ " . number_format($balance_invoice, 2) . " " . $value['currency'] . "</span>";
															} else {
																echo "<span> $ " . number_format($balance_invoice, 2) . " " . $value['currency'] . "</span>";
															}
														} else {
															if ($totalsale != 0) {
																if ($value['commission'] != 0) {
																	echo "<span style=\"color:red\"> $ " . number_format($value['commission'], 2) . " " . $value['currency'] . "</span>";
																} else {
																	echo "<span> $ " . number_format($value['commission'], 2) . " " . $value['currency'] . "</span>";
																}
															}
														}
													}
													?>
												</td>


												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['commisson_payment_status'] == "Outstanding") {
														echo "<span style=\"color:red\">" . $value['commisson_payment_status'] . "</span>";
													} else {
														echo "<span> " . $value['commisson_payment_status'] . "</span>";
													}
													?>
												</td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['commisson_payment_status'] == "Paid") {
														$comm_payment = $value['pay_for_sales'] + $value['pay_by_credit'];
														if ($value['pay_by_credit'] != 0) {
															$style = 'style="color:red"';
														} else {
															$style = '';
														}

														echo "<span " . $style . "> $ " . number_format($comm_payment, 2) . " " . $value['currency'] . "</span><br>";

														if ($value['date_for_sales'] != "0000-00-00") {
															$_month_name_comm = array(
																"01" => "Jan.",  "02" => "Feb.",  "03" => "Mar.",
																"04" => "Apr.",  "05" => "May.",  "06" => "Jun.",
																"07" => "Jul.",  "08" => "Aug.",  "09" => "Sep.",
																"10" => "Oct.", "11" => "Nov.",  "12" => "Dec."
															);

															$commissiondate = $value['date_for_sales'];

															list($year_comm, $momth_comm, $day_comm) = explode("-", $commissiondate);

															$yy_comm = $year_comm;
															$mm_comm = $momth_comm;
															$dd_comm = $day_comm;

															if ($dd_comm < 10) {
																$dd_comm = substr($dd_comm, 1, 2);
															}
															$date_comm = $_month_name_comm[$mm_comm] . " " . $dd_comm . ",  " . $yy_comm;

															echo "<span style=\"font-size:11px\">(Date : " . $date_comm . ")</span><br>";
														}
													}
													?>
												</td>
												<td class="text-center" style="word-wrap:break-word;vertical-align: middle;">
													<?php
													$comments = Yii::app()->db->createCommand()
														->select('*')
														->from('comments com')
														->where('com.invoice = "' . $value['id'] . '"')
														->order('com.date_comments DESC')
														->limit('1')
														->queryAll();

													foreach ($comments as $key_co => $value_co) {
														if ($value_co['user_group'] == "1") {
															echo "JOG : ";
														} elseif ($value_co['user_group'] == "2") {
															echo "Sale : ";
														}
														echo nl2br($value_co['comments']);
													}
													?>
												</td>
												<td class="text-center" style="word-wrap:break-word;vertical-align: middle;">
													<?php
													if ($value['update_date'] != "0000-00-00") {
														$_month_name = array("01" => "Jan.", "02" => "Feb.", "03" => "Mar.", "04" => "Apr.", "05" => "May.", "06" => "Jun.", "07" => "Jul.", "08" => "Aug.", "09" => "Sep.", "10" => "Oct.", "11" => "Nov.", "12" => "Dec.");

														list($year, $momth, $day) = explode("-", $value['update_date']);

														if ($day < 10) {
															$day = substr($day, 1, 2);
														}

														$date = $_month_name[$momth] . " " . $day . ",  " . $year;
													?>
														<span style="font-size:12px;"><?php echo $date; ?></span>
													<?php
													} else {
														$date = " ";
													?>
														<span style="font-size:12px;"><?php echo $date; ?></span>
													<?php
													}
													?>
												</td>
											</tr>
									<?php }
									} ?>
									<?php if ($sumtotalUSD != 0) {  ?>

										<tr style="background-color: #c1ffe6;">
											<td colspan=""></td>
											<td colspan=""></td>
											<td colspan=""></td>
											<td colspan=""></td>
											<td colspan=""></td>
											<td colspan=""></td>
											<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
												<span><?php echo "$ " . number_format($sumAmountReceivedUSD, 2) . " USD"; ?> </span>
											</td>
											<td colspan=""></td>

											<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
												<span><?php echo "$ " . number_format($sumtotalUSD, 2) . " USD"; ?> </span>
											</td>
											<td></td>
											<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
												<span><?php echo "$ " . number_format($totalcommissionUSD, 2) . " USD"; ?> </span>
											</td>
											<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
												<?php if ($commissionPaymentUSD == 0) {	?>
													<span><?php echo "$ " . number_format($commissionPaymentUSD, 2) . " USD"; ?></span>
												<?php } else { ?>
													<span style="color:red;padding:5px 10px;"><?php echo "$ " . number_format($commissionPaymentUSD, 2) . " USD"; ?></span>
												<?php } ?>
											</td>
											<td></td>
											<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
												<?php if (!empty($sumCommissionPaymaentUSD)) { ?>
													<span><?php echo "$ " . number_format($sumCommissionPaymaentUSD, 2) . " USD"; ?> </span>
												<?php } ?>
											</td>
											<td></td>
											<td></td>
										</tr>
									<?php	} ?>
								</tbody>
							</table>
						</div>
						<br>
					<?php }
				}
				foreach ($currency_curr as $curr) {
					if ($curr == "CAD") { ?>
						<div style="margin-bottom:10px;">
							<?php
							if ($is_search_by_date) {
							?>
								<a style="cursor: pointer;" class="paf_dowload" onclick="return showPDFSearchResult('CAD');"> PDF (CAD)</a>
							<?php
							} else {
							?>
								<div class="TableUpperBtns ">
									<a href="<?php echo Yii::app()->baseUrl; ?>/pdf/commissionSaleCAD/year/<?php echo $year_commission; ?>/sale/<?php echo $sales_commission; ?>/month/<?php echo $month_commission; ?>" class="paf_dowload" target="_blank"> PDF (CAD)</a>
									<a href="<?php echo Yii::app()->baseUrl; ?>/pdf/commissionSaleCADEX/year/<?php echo $year_commission; ?>/sale/<?php echo $sales_commission; ?>/month/<?php echo $month_commission; ?>" class="btn btn-info paf_dowload" target="_blank"> Excel (CAD) </a>
								</div>
							<?php
							}
							?>
						</div>
						<br>
						<div class="text-center" style="background-color:rgb(169, 185, 199);color:rgb(51, 67, 80);padding: 10px 0">
							<h4 style="font-weight: 700;"><?php echo  $curr; ?> </h4>
						</div>
						<div id="freezer-Table" style="margin:0">
							<table id="calculatorCADcomTable" class="table table-striped table-bordered data_invoice table-condensed table-freeze-multi" style="border-collapse: initial;" data-scroll-max-height="600" data-cols-number="5">
								<colgroup>
									<col>
									<col style="width:150px;">
									<col style="width:120px;">
									<col style="width:150px;">
									<col style="width:100px;">
									<col style="width:80px;">
									<col style="width:120px;">
									<col style="width:120px;">
									<col style="width:160px;">
									<col style="width:100px;">
									<col style="width:160px;">
									<col style="width:160px;">
									<col style="width:100px;">
									<col style="width:150px;">
									<col style="width:200px;">
									<col style="width:110px;">
								</colgroup>
								<thead>

									<tr>
										<th colspan="" class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> </th>
										<th colspan="4" class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Invoice </th>
										<th colspan="2" class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Invoice Payment Status </th>

										<th colspan="" class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Position Responsible </th>

										<th colspan="4" class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Commission Calculator</th>
										<th colspan="2" class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Commission Payment Status </th>

										<th colspan="" class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Comment </th>
										<th colspan="" class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Update
										</th>
									</tr>
									<tr>
										<th class="bg-blue-light text-center"> </th>
										<th class="bg-blue-light text-center"> Invoice # </th>
										<th class="bg-blue-light text-center"> Order No. </th>
										<th class="bg-blue-light text-center"> Order Name <br><span style="color:#fd6262;font-size:11px;">** Click Order Name ** <br> for Commission Calculator </span></th>
										<th class="bg-blue-light text-center"> Date/Quarter </th>

										<th class="bg-blue-light text-center"> Invoice Status</th>
										<th class="bg-blue-light text-center"> Amount Received</th>

										<th class="bg-blue-light text-center"> Position</th>

										<th class="bg-blue-light text-center"> Total Sales </th>
										<th class="bg-blue-light text-center"> Commission% </th>
										<th class="bg-blue-light text-center"> Commission </th>
										<th class="bg-blue-light text-center"> Balance </th>

										<th class="bg-blue-light text-center"> Commission Status</th>
										<th class="bg-blue-light text-center"> Commission Payment</th>

										<th class="bg-blue-light text-center"> Comments </th>
										<th class="bg-blue-light text-center"> Last Update </th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($getData as $key => $value) {
										if ($value['currency'] ==   $curr) {
									?>
											<tr style="background: #ffffff;">

												<td class="tbl-btn-box nowrap" style="vertical-align: middle;">
													<button class="btn btn-success" data-toggle="modal" data-target="#editData" data-id="<?php echo $value['id']; ?>">
														<i class="fa fa-pencil"></i>
													</button>
													<button class="btn btn-danger confirm" del-id="<?php echo $value['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/calculator/deleteInvoice">
														<i class="fa fa-close"></i>
													</button>
												</td>

												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php if ($value['file_path'] != "Array" && $value['file_path'] != "") { ?>
														<a href="<?php echo Yii::app()->request->baseUrl; ?>/invoice/docs/<?php echo $value['file_path']; ?>" target="_blank">
															<?php echo $value['invoice']; ?>
														</a>
													<?php } else { ?>
														<span style="color:red;">
															<?php echo $value['invoice']; ?>
														</span>
													<?php
													} ?>
													<?php if ($value['invoice_mail_status'] == "Send") { ?>
														&nbsp; <a href="#" data-toggle="modal" data-target="#editSendMail" data-id="<?php echo $value['id']; ?>" title="Send E-mail to Customer"><i class="fa fa-envelope"></i></a>
													<?php } else { ?>
														&nbsp; <a href="#" data-toggle="modal" data-target="#editSendMail" data-id="<?php echo $value['id']; ?>" title="Send E-mail to Customer"><i class="fa fa-envelope-o"></i></a>
													<?php }

													if ($value['inv_link'] != "") {
													?>
														&nbsp; <a href="<?php echo $value['inv_link']; ?>" target="_blank" title="Invoice link"><i class="fa fa-link"></i></a>
													<?php
													}
													?>
												</td>
												<td class="text-left " style="vertical-align: middle;text-align:left;">
													<div class="col-md-12" style="vertical-align: middle;">
														<?php
														$data_order_no = str_replace(" ", '<br />', $value['order_no']);
														echo $data_order_no;
														?>
													</div>
												</td>
												<td class="" style="vertical-align: middle;text-align:left;">
													<div class="col-md-1" style="vertical-align: middle;">
														<?php
														if ($value['invoice_status'] == "Paid") { ?>
															<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
														<?php
														} elseif ($value['invoice_status'] == "Outstanding") { ?>

															<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
														<?php }	?>
													</div>
													<div class="col-md-10" style="vertical-align: middle;">
														<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/commission/year/<?php echo $year_commission; ?>/id/<?php echo $value['id']; ?>"><?php echo nl2br($value['order_name']); ?> </a>
													</div>
												</td>
												<?php
												$_month_name = array(
													"01" => "Jan.",  "02" => "Feb.",  "03" => "Mar.",
													"04" => "Apr.",  "05" => "May.",  "06" => "Jun.",
													"07" => "Jul.",  "08" => "Aug.",  "09" => "Sep.",
													"10" => "Oct.", "11" => "Nov.",  "12" => "Dec."
												);

												$vardate = $value['date_quarter'];
												list($year, $momth, $day) = explode("-", $vardate);
												$yy = $year;
												$mm = $momth;
												$dd = $day;

												if ($dd < 10) {
													$dd = substr($dd, 1, 2);
												}
												$date = $_month_name[$mm] . " " . $dd . ",  " . $yy;
												if ($mm == "01" || $mm == "02" || $mm == "03") {
													$quarter = "QTR 1";
												} elseif ($mm == "04" || $mm == "05" || $mm == "06") {
													$quarter = "QTR 2";
												} elseif ($mm == "07" || $mm == "08" || $mm == "09") {
													$quarter = "QTR 3";
												} elseif ($mm == "10" || $mm == "11" || $mm == "12") {
													$quarter = "QTR 4";
												}
												//echo $date;
												?>
												<td class=" text-center" style="vertical-align: middle;"> <?php echo $date . "/ <br>" . $quarter; ?> </td>

												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['invoice_status'] == "Outstanding") {
														echo "<span style=\"color:red\">" . $value['invoice_status'] . "</span>";
													} else {
														echo "<span> " . $value['invoice_status'] . "</span>";
													}
													?>

												</td>

												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['invoice_status'] == "Paid") {
														if (!empty($value['invoice_amount_received'])) {
															echo "<span > $ " . number_format($value['invoice_amount_received'], 2) . " " . $value['currency'] . "</span><br>";
														}
														if ($value['invoice_date'] != "0000-00-00") {
															$_month_name_int = array(
																"01" => "Jan.",  "02" => "Feb.",  "03" => "Mar.",
																"04" => "Apr.",  "05" => "May.",  "06" => "Jun.",
																"07" => "Jul.",  "08" => "Aug.",  "09" => "Sep.",
																"10" => "Oct.", "11" => "Nov.r",  "12" => "Dec."
															);

															$invoicedate = $value['invoice_date'];

															list($year_int, $momth_int, $day_int) = explode("-", $invoicedate);

															$yy_int = $year_int;
															$mm_int = $momth_int;
															$dd_int = $day_int;
															if ($dd_int < 10) {
																$dd_int = substr($dd_int, 1, 2);
															}
															$date_int = $_month_name_int[$mm_int] . " " . $dd_int . ",  " . $yy_int;

															echo "<span style=\"font-size:11px\">(Date : " . $date_int . ")</span><br>";
														}
													}
													?>

												</td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['sales_status'] == "1") {
														echo "<span style=\"font-weight: 700;\">Sales Manager</span>";
													} elseif ($value['sales_status'] == "2") {
														echo "<span style=\"font-weight: 700;\">Sales Rep</span>";
													} elseif ($value['sales_status'] == "3") {
														echo "<span style=\"font-weight: 700;\">Processor</span>";
													}
													?>
												</td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													$totalsale = ((($value['total_sales'] - $value['shipping_cost']) - $value['creditcard_feecost']) - $value['comp_itemcost']);

													if ($value['total_sales'] != 0) {
														if ($value['status_commission'] == "Approved") { ?>
															<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
														<?php
														} elseif ($value['status_commission'] == "Not Approved") { ?>

															<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
														<?php } else {	?>
															<i class="fa fa-square" aria-hidden="true" style="color:#e68c00"></i>&nbsp;
													<?php }

														echo "$ " . number_format($totalsale, 2) . " " . $value['currency'];
													} else {
														echo "";
													}
													?>
												</td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['total_sales'] != 0) {
														echo $value['commission_percent'] . "%";
													}
													?>
												</td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php

													if ($value['total_sales'] != 0) {
														echo "$ " . number_format($value['commission'], 2) . " " . $value['currency'];
													} else {
														echo "";
													}
													?>
												</td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['invoice_status'] == "Paid") {
														if ($value['commisson_payment_status'] == "Paid") {

															$balance_invoice = ($value['commission'] - $value['pay_for_sales']) - $value['pay_by_credit'];
															if ($balance_invoice != 0) {
																echo "<span style=\"color:red\"> $ " . number_format($balance_invoice, 2) . " " . $value['currency'] . "</span>";
															} else {
																echo "<span> $ " . number_format($balance_invoice, 2) . " " . $value['currency'] . "</span>";
															}
														} else {
															if ($totalsale != 0) {
																if ($value['commission'] != 0) {
																	echo "<span style=\"color:red\"> $ " . number_format($value['commission'], 2) . " " . $value['currency'] . "</span>";
																} else {
																	echo "<span> $ " . number_format($value['commission'], 2) . " " . $value['currency'] . "</span>";
																}
															}
														}
													}
													?>
												</td>


												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['commisson_payment_status'] == "Outstanding") {
														echo "<span style=\"color:red\">" . $value['commisson_payment_status'] . "</span>";
													} else {
														echo "<span> " . $value['commisson_payment_status'] . "</span>";
													}
													?>
												</td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['commisson_payment_status'] == "Paid") {
														$comm_payment = $value['pay_for_sales'] + $value['pay_by_credit'];
														if ($value['pay_by_credit'] != 0) {
															$style = 'style="color:red"';
														} else {
															$style = '';
														}

														echo "<span " . $style . "> $ " . number_format($comm_payment, 2) . " " . $value['currency'] . "</span><br>";

														if ($value['date_for_sales'] != "0000-00-00") {
															$_month_name_comm = array(
																"01" => "Jan.",  "02" => "Feb.",  "03" => "Mar.",
																"04" => "Apr.",  "05" => "May.",  "06" => "Jun.",
																"07" => "Jul.",  "08" => "Aug.",  "09" => "Sep.",
																"10" => "Oct.", "11" => "Nov.",  "12" => "Dec."
															);

															$commissiondate = $value['date_for_sales'];

															list($year_comm, $momth_comm, $day_comm) = explode("-", $commissiondate);

															$yy_comm = $year_comm;
															$mm_comm = $momth_comm;
															$dd_comm = $day_comm;

															if ($dd_comm < 10) {
																$dd_comm = substr($dd_comm, 1, 2);
															}
															$date_comm = $_month_name_comm[$mm_comm] . " " . $dd_comm . ",  " . $yy_comm;

															echo "<span style=\"font-size:11px\">(Date : " . $date_comm . ")</span><br>";
														}
													}
													?>
												</td>
												<td class="text-center" style="word-wrap:break-word;vertical-align: middle;">
													<?php
													$comments = Yii::app()->db->createCommand()
														->select('*')
														->from('comments com')
														->where('com.invoice = "' . $value['id'] . '"')
														->order('com.date_comments DESC')
														->limit('1')
														->queryAll();

													foreach ($comments as $key_co => $value_co) {
														if ($value_co['user_group'] == "1") {
															echo "JOG : ";
														} elseif ($value_co['user_group'] == "2") {
															echo "Sale : ";
														}
														echo nl2br($value_co['comments']);
													}
													?>
												</td>
												<td class="text-center" style="word-wrap:break-word;vertical-align: middle;">
													<?php
													if ($value['update_date'] != "0000-00-00") {
														$_month_name = array("01" => "Jan.", "02" => "Feb.", "03" => "Mar.", "04" => "Apr.", "05" => "May.", "06" => "Jun.", "07" => "Jul.", "08" => "Aug.", "09" => "Sep.", "10" => "Oct.", "11" => "Nov.", "12" => "Dec.");

														list($year, $momth, $day) = explode("-", $value['update_date']);

														if ($day < 10) {
															$day = substr($day, 1, 2);
														}

														$date = $_month_name[$momth] . " " . $day . ",  " . $year;
													?>
														<span style="font-size:12px;"><?php echo $date; ?></span>
													<?php
													} else {
														$date = " ";
													?>
														<span style="font-size:12px;"><?php echo $date; ?></span>
													<?php
													}
													?>
												</td>
											</tr>
									<?php }
									} ?>
									<?php if ($sumtotalCAD != 0) {  ?>

										<tr style="background-color: #c1ffe6;">
											<td colspan=""></td>
											<td colspan=""></td>
											<td colspan=""></td>
											<td colspan=""></td>
											<td colspan=""></td>
											<td colspan=""></td>

											<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
												<span><?php echo "$ " . number_format($sumAmountReceivedCAD, 2) . " CAD"; ?> </span>
											</td>

											<td colspan=""></td>

											<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
												<span><?php echo "$ " . number_format($sumtotalCAD, 2) . " CAD"; ?> </span>
											</td>
											<td></td>
											<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
												<span><?php echo "$ " . number_format($totalcommissionCAD, 2) . " CAD"; ?> </span>
											</td>
											<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
												<?php if ($commissionPaymentCAD == 0) {	?>
													<span><?php echo "$ " . number_format($commissionPaymentCAD, 2) . " CAD"; ?></span>
												<?php } else { ?>
													<span style="color:red;padding:5px 10px;"><?php echo "$ " . number_format($commissionPaymentCAD, 2) . " CAD"; ?></span>
												<?php } ?>
											</td>
											<td colspan=""></td>
											<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
												<?php if (!empty($sumCommissionPaymaentCAD)) {	?>
													<span><?php echo "$ " . number_format($sumCommissionPaymaentCAD, 2) . " CAD"; ?></span>
												<?php } ?>
											</td>
											<td colspan=""></td>
											<td colspan=""></td>
										</tr>
									<?php	} ?>
								</tbody>
							</table>
						</div>
						<br>
					<?php }
				}
				foreach ($currency_curr as $curr) {
					if ($curr == "SGD") { ?>
						<div style="margin-bottom:10px;">
							<?php
							if ($is_search_by_date) {
							?>
								<a style="cursor: pointer;" class="paf_dowload" onclick="return showPDFSearchResult('SGD');"> PDF (SGD)</a>
							<?php
							} else {
							?>
								<a href="<?php echo Yii::app()->baseUrl; ?>/pdf/commissionSaleSGD/year/<?php echo $year_commission; ?>/sale/<?php echo $sales_commission; ?>/month/<?php echo $month_commission; ?>" class="paf_dowload" target="_blank"> PDF (SGD)</a>
							<?php
							}
							?>
						</div>
						<br>
						<div class="text-center" style="background-color:rgb(169, 185, 199);color:rgb(51, 67, 80);padding: 10px 0">
							<h4 style="font-weight: 700;"><?php echo  $curr; ?> </h4>
						</div>
						<div id="freezer-Table" style="margin:0">
							<table id="calculatorSGDcomTable" class="table table-striped table-bordered data_invoice table-condensed table-freeze-multi" style="border-collapse: initial;" data-scroll-max-height="600" data-cols-number="5">
								<colgroup>
									<col>
									<col style="width:150px;">
									<col style="width:120px;">
									<col style="width:150px;">
									<col style="width:100px;">
									<col style="width:80px;">
									<col style="width:120px;">
									<col style="width:120px;">
									<col style="width:160px;">
									<col style="width:100px;">
									<col style="width:160px;">
									<col style="width:160px;">
									<col style="width:100px;">
									<col style="width:150px;">
									<col style="width:200px;">
									<col style="width:110px;">
								</colgroup>
								<thead>
									<tr>
										<th colspan="" class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> </th>
										<th colspan="4" class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Invoice </th>
										<th colspan="2" class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Invoice Payment Status </th>

										<th colspan="" class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Position Responsible </th>

										<th colspan="4" class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Commission Calculator</th>
										<th colspan="2" class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Commission Payment Status </th>

										<th colspan="" class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Comment </th>
										<th colspan="" class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Update
										</th>
									</tr>
									<tr>
										<th class="bg-blue-light text-center"> </th>
										<th class="bg-blue-light text-center"> Invoice # </th>
										<th class="bg-blue-light text-center"> Order No. </th>
										<th class="bg-blue-light text-center"> Order Name <br><span style="color:#fd6262;font-size:11px;">** Click Order Name ** <br> for Commission Calculator </span></th>
										<th class="bg-blue-light text-center"> Date/Quarter </th>

										<th class="bg-blue-light text-center"> Invoice Status</th>
										<th class="bg-blue-light text-center"> Amount Received</th>

										<th class="bg-blue-light text-center"> Position</th>

										<th class="bg-blue-light text-center"> Total Sales </th>
										<th class="bg-blue-light text-center"> Commission% </th>
										<th class="bg-blue-light text-center"> Commission </th>
										<th class="bg-blue-light text-center"> Balance </th>

										<th class="bg-blue-light text-center"> Commission Status</th>
										<th class="bg-blue-light text-center"> Commission Payment</th>
										<th class="bg-blue-light text-center"> Comments </th>
										<th class="bg-blue-light text-center"> Last Update </th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($getData as $key => $value) {
										if ($value['currency'] ==   $curr) {
									?>
											<tr style="background: #ffffff;">

												<td class="tbl-btn-box nowrap" style="vertical-align: middle;">
													<button class="btn btn-success" data-toggle="modal" data-target="#editData" data-id="<?php echo $value['id']; ?>">
														<i class="fa fa-pencil"></i>
													</button>
													<button class="btn btn-danger confirm" del-id="<?php echo $value['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/calculator/deleteInvoice">
														<i class="fa fa-close"></i>
													</button>
												</td>

												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php if ($value['file_path'] != "Array" && $value['file_path'] != "") { ?>
														<a href="<?php echo Yii::app()->request->baseUrl; ?>/invoice/docs/<?php echo $value['file_path']; ?>" target="_blank">
															<?php echo $value['invoice']; ?>
														</a>
													<?php } else { ?>
														<span style="color:red;">
															<?php echo $value['invoice']; ?>
														</span>
													<?php
													} ?>
													<?php if ($value['invoice_mail_status'] == "Send") { ?>
														&nbsp; <a href="#" data-toggle="modal" data-target="#editSendMail" data-id="<?php echo $value['id']; ?>" title="Send E-mail to Customer"><i class="fa fa-envelope"></i></a>
													<?php } else { ?>
														&nbsp; <a href="#" data-toggle="modal" data-target="#editSendMail" data-id="<?php echo $value['id']; ?>" title="Send E-mail to Customer"><i class="fa fa-envelope-o"></i></a>
													<?php }

													if ($value['inv_link'] != "") {
													?>
														&nbsp; <a href="<?php echo $value['inv_link']; ?>" target="_blank" title="Invoice link"><i class="fa fa-link"></i></a>
													<?php
													}
													?>
												</td>
												<td class="text-left " style="vertical-align: middle;text-align:left;">
													<div class="col-md-12" style="vertical-align: middle;">
														<?php
														$data_order_no = str_replace(" ", '<br />', $value['order_no']);
														echo $data_order_no;
														?>
													</div>
												</td>
												<td class="" style="vertical-align: middle;text-align:left;">
													<div class="col-md-1" style="vertical-align: middle;">
														<?php
														if ($value['invoice_status'] == "Paid") { ?>
															<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
														<?php
														} elseif ($value['invoice_status'] == "Outstanding") { ?>

															<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
														<?php }	?>
													</div>
													<div class="col-md-1" style="vertical-align: middle;">
														<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/commission/year/<?php echo $year_commission; ?>/id/<?php echo $value['id']; ?>"><?php echo nl2br($value['order_name']); ?> </a>
													</div>
												</td>
												<?php
												$_month_name = array(
													"01" => "Jan.",  "02" => "Feb.",  "03" => "Mar.",
													"04" => "Apr.",  "05" => "May.",  "06" => "Jun.",
													"07" => "Jul.",  "08" => "Aug.",  "09" => "Sep.",
													"10" => "Oct.", "11" => "Nov.",  "12" => "Dec."
												);

												$vardate = $value['date_quarter'];
												list($year, $momth, $day) = explode("-", $vardate);
												$yy = $year;
												$mm = $momth;
												$dd = $day;

												if ($dd < 10) {
													$dd = substr($dd, 1, 2);
												}
												$date = $_month_name[$mm] . " " . $dd . ",  " . $yy;
												if ($mm == "01" || $mm == "02" || $mm == "03") {
													$quarter = "QTR 1";
												} elseif ($mm == "04" || $mm == "05" || $mm == "06") {
													$quarter = "QTR 2";
												} elseif ($mm == "07" || $mm == "08" || $mm == "09") {
													$quarter = "QTR 3";
												} elseif ($mm == "10" || $mm == "11" || $mm == "12") {
													$quarter = "QTR 4";
												}
												//echo $date;
												?>
												<td class="text-center " style="vertical-align: middle;"> <?php echo $date . "/ <br>" . $quarter; ?> </td>

												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['invoice_status'] == "Outstanding") {
														echo "<span style=\"color:red\">" . $value['invoice_status'] . "</span>";
													} else {
														echo "<span> " . $value['invoice_status'] . "</span>";
													}
													?>

												</td>

												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['invoice_status'] == "Paid") {
														if (!empty($value['invoice_amount_received'])) {
															echo "<span > $ " . number_format($value['invoice_amount_received'], 2) . " " . $value['currency'] . "</span><br>";
														}
														if ($value['invoice_date'] != "0000-00-00") {
															$_month_name_int = array(
																"01" => "Jan.",  "02" => "Feb.",  "03" => "Mar.",
																"04" => "Apr.",  "05" => "May.",  "06" => "Jun.",
																"07" => "Jul.",  "08" => "Aug.",  "09" => "Sep.",
																"10" => "Oct.", "11" => "Nov.",  "12" => "Dec."
															);

															$invoicedate = $value['invoice_date'];

															list($year_int, $momth_int, $day_int) = explode("-", $invoicedate);

															$yy_int = $year_int;
															$mm_int = $momth_int;
															$dd_int = $day_int;
															if ($dd_int < 10) {
																$dd_int = substr($dd_int, 1, 2);
															}
															$date_int = $_month_name_int[$mm_int] . " " . $dd_int . ",  " . $yy_int;

															echo "<span style=\"font-size:11px\">(Date : " . $date_int . ")</span><br>";
														}
													}
													?>

												</td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['sales_status'] == "1") {
														echo "<span style=\"font-weight: 700;\">Sales Manager</span>";
													} elseif ($value['sales_status'] == "2") {
														echo "<span style=\"font-weight: 700;\">Sales Rep</span>";
													} elseif ($value['sales_status'] == "3") {
														echo "<span style=\"font-weight: 700;\">Processor</span>";
													}
													?>
												</td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													$totalsale = ((($value['total_sales'] - $value['shipping_cost']) - $value['creditcard_feecost']) - $value['comp_itemcost']);

													if ($value['total_sales'] != 0) {
														if ($value['status_commission'] == "Approved") { ?>
															<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
														<?php
														} elseif ($value['status_commission'] == "Not Approved") { ?>

															<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
														<?php } else {	?>
															<i class="fa fa-square" aria-hidden="true" style="color:#e68c00"></i>&nbsp;
													<?php }

														echo "$ " . number_format($totalsale, 2) . " " . $value['currency'];
													} else {
														echo "";
													}
													?>
												</td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['total_sales'] != 0) {
														echo $value['commission_percent'] . "%";
													}
													?>
												</td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php

													if ($value['total_sales'] != 0) {
														echo "$ " . number_format($value['commission'], 2) . " " . $value['currency'];
													} else {
														echo "";
													}
													?>
												</td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['invoice_status'] == "Paid") {
														if ($value['commisson_payment_status'] == "Paid") {

															$balance_invoice = ($value['commission'] - $value['pay_for_sales']) - $value['pay_by_credit'];
															if ($balance_invoice != 0) {
																echo "<span style=\"color:red\"> $ " . number_format($balance_invoice, 2) . " " . $value['currency'] . "</span>";
															} else {
																echo "<span> $ " . number_format($balance_invoice, 2) . " " . $value['currency'] . "</span>";
															}
														} else {
															if ($totalsale != 0) {
																if ($value['commission'] != 0) {
																	echo "<span style=\"color:red\"> $ " . number_format($value['commission'], 2) . " " . $value['currency'] . "</span>";
																} else {
																	echo "<span> $ " . number_format($value['commission'], 2) . " " . $value['currency'] . "</span>";
																}
															}
														}
													}
													?>
												</td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['commisson_payment_status'] == "Outstanding") {
														echo "<span style=\"color:red\">" . $value['commisson_payment_status'] . "</span>";
													} else {
														echo "<span> " . $value['commisson_payment_status'] . "</span>";
													}
													?>
												</td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['commisson_payment_status'] == "Paid") {
														$comm_payment = $value['pay_for_sales'] + $value['pay_by_credit'];
														if ($value['pay_by_credit'] != 0) {
															$style = 'style="color:red"';
														} else {
															$style = '';
														}

														echo "<span " . $style . "> $ " . number_format($comm_payment, 2) . " " . $value['currency'] . "</span><br>";

														if ($value['date_for_sales'] != "0000-00-00") {
															$_month_name_comm = array(
																"01" => "Jan.",  "02" => "Feb.",  "03" => "Mar.",
																"04" => "Apr.",  "05" => "May.",  "06" => "Jun.",
																"07" => "Jul.",  "08" => "Aug.",  "09" => "Sep.",
																"10" => "Oct.", "11" => "Nov.",  "12" => "Dec."
															);

															$commissiondate = $value['date_for_sales'];

															list($year_comm, $momth_comm, $day_comm) = explode("-", $commissiondate);

															$yy_comm = $year_comm;
															$mm_comm = $momth_comm;
															$dd_comm = $day_comm;

															if ($dd_comm < 10) {
																$dd_comm = substr($dd_comm, 1, 2);
															}
															$date_comm = $_month_name_comm[$mm_comm] . " " . $dd_comm . ",  " . $yy_comm;

															echo "<span style=\"font-size:11px\">(Date : " . $date_comm . ")</span><br>";
														}
													}
													?>
												</td>
												<td class="text-center" style="word-wrap:break-word;vertical-align: middle;">
													<?php
													$comments = Yii::app()->db->createCommand()
														->select('*')
														->from('comments com')
														->where('com.invoice = "' . $value['id'] . '"')
														->order('com.date_comments DESC')
														->limit('1')
														->queryAll();

													foreach ($comments as $key_co => $value_co) {
														if ($value_co['user_group'] == "1") {
															echo "JOG : ";
														} elseif ($value_co['user_group'] == "2") {
															echo "Sale : ";
														}
														echo nl2br($value_co['comments']);
													}
													?>
												</td>
												<td class="text-center" style="word-wrap:break-word;vertical-align: middle;">
													<?php
													if ($value['update_date'] != "0000-00-00") {
														$_month_name = array("01" => "Jan.", "02" => "Feb.", "03" => "Mar.", "04" => "Apr.", "05" => "May.", "06" => "Jun.", "07" => "Jul.", "08" => "Aug.", "09" => "Sep.", "10" => "Oct.", "11" => "Nov.", "12" => "Dec.");

														list($year, $momth, $day) = explode("-", $value['update_date']);

														if ($day < 10) {
															$day = substr($day, 1, 2);
														}

														$date = $_month_name[$momth] . " " . $day . ",  " . $year;
													?>
														<span style="font-size:12px;"><?php echo $date; ?></span>
													<?php
													} else {
														$date = " ";
													?>
														<span style="font-size:12px;"><?php echo $date; ?></span>
													<?php
													}
													?>
												</td>
											</tr>
									<?php }
									} ?>
									<?php if ($sumtotalSGD != 0) {  ?>

										<tr style="background-color: #c1ffe6;">
											<td colspan=""></td>
											<td colspan=""></td>
											<td colspan=""></td>
											<td colspan=""></td>
											<td colspan=""></td>
											<td colspan=""></td>
											<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
												<span><?php echo "$ " . number_format($sumAmountReceivedSGD, 2) . " SGD"; ?> </span>
											</td>
											<td colspan=""></td>

											<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
												<span><?php echo "$ " . number_format($sumtotalSGD, 2) . " SGD"; ?> </span>
											</td>
											<td></td>
											<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
												<span><?php echo "$ " . number_format($totalcommissionSGD, 2) . " SGD"; ?> </span>
											</td>
											<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
												<?php if ($commissionPaymentSGD == 0) {	?>
													<span><?php echo "$ " . number_format($commissionPaymentSGD, 2) . " SGD"; ?></span>
												<?php } else { ?>
													<span style="color:red;padding:5px 10px;"><?php echo "$ " . number_format($commissionPaymentSGD, 2) . " SGD"; ?></span>
												<?php } ?>
											</td>
											<td></td>
											<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
												<?php if (!empty($sumCommissionPaymaentSGD)) {	?>
													<span><?php echo "$ " . number_format($sumCommissionPaymaentSGD, 2) . " SGD"; ?></span>

												<?php } ?>
											</td>
											<td></td>
											<td></td>

										</tr>
									<?php	} ?>
								</tbody>
							</table>
						</div>
						<br>
					<?php }
				}
				foreach ($currency_curr as $curr) {
					if ($curr == "THB") { ?>
						<div style="margin-bottom:10px;">
							<?php
							if ($is_search_by_date) {
							?>
								<a style="cursor: pointer;" class="paf_dowload" onclick="return showPDFSearchResult('THB');"> PDF (THB)</a>
							<?php
							} else {
							?>
								<a href="<?php echo Yii::app()->baseUrl; ?>/pdf/commissionSaleTHB/year/<?php echo $year_commission; ?>/sale/<?php echo $sales_commission; ?>/month/<?php echo $month_commission; ?>" class="paf_dowload" target="_blank"> PDF (THB)</a>
							<?php
							}
							?>
						</div>
						<br>
						<div class="text-center" style="background-color:rgb(169, 185, 199);color:rgb(51, 67, 80);padding: 10px 0">
							<h4 style="font-weight: 700;"><?php echo  $curr; ?> </h4>
						</div>
						<div id="freezer-Table" style="margin:0">
							<table id="calculatorTHBcomTable" class="table table-striped table-bordered data_invoice table-condensed table-freeze-multi" style="border-collapse: initial;" data-scroll-max-height="600" data-cols-number="5">
								<colgroup>
									<col>
									<col style="width:150px;">
									<col style="width:120px;">
									<col style="width:150px;">
									<col style="width:100px;">
									<col style="width:80px;">
									<col style="width:120px;">
									<col style="width:120px;">
									<col style="width:160px;">
									<col style="width:100px;">
									<col style="width:160px;">
									<col style="width:160px;">
									<col style="width:100px;">
									<col style="width:150px;">
									<col style="width:200px;">
									<col style="width:110px;">
								</colgroup>
								<thead>

									<tr>
										<th colspan="" class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> </th>
										<th colspan="4" class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Invoice </th>
										<th colspan="2" class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Invoice Payment Status </th>

										<th colspan="" class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Position Responsible </th>

										<th colspan="4" class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Commission Calculator</th>
										<th colspan="2" class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Commission Payment Status </th>

										<th colspan="" class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Comment </th>
										<th colspan="" class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Update
										</th>
									</tr>
									<tr>
										<th class="bg-blue-light text-center"> </th>
										<th class="bg-blue-light text-center"> Invoice # </th>
										<th class="bg-blue-light text-center"> Order No. </th>
										<th class="bg-blue-light text-center"> Order Name <br><span style="color:#fd6262;font-size:11px;">*** Click Order Name *** <br> for Commission Calculator </span></th>
										<th class="bg-blue-light text-center"> Date/Quarter </th>

										<th class="bg-blue-light text-center"> Invoice Status</th>
										<th class="bg-blue-light text-center"> Amount Received</th>

										<th class="bg-blue-light text-center"> Position</th>

										<th class="bg-blue-light text-center"> Total Sales </th>
										<th class="bg-blue-light text-center"> Commission% </th>
										<th class="bg-blue-light text-center"> Commission </th>
										<th class="bg-blue-light text-center"> Balance </th>

										<th class="bg-blue-light text-center"> Commission Status</th>
										<th class="bg-blue-light text-center"> Commission Payment</th>
										<th class="bg-blue-light text-center"> Comments </th>
										<th class="bg-blue-light text-center"> Last Update </th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($getData as $key => $value) {
										if ($value['currency'] ==   $curr) {
									?>
											<tr style="background: #ffffff;">

												<td class="tbl-btn-box nowrap" style="vertical-align: middle;">
													<button class="btn btn-success" data-toggle="modal" data-target="#editData" data-id="<?php echo $value['id']; ?>">
														<i class="fa fa-pencil"></i>
													</button>
													<button class="btn btn-danger confirm" del-id="<?php echo $value['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/calculator/deleteInvoice">
														<i class="fa fa-close"></i>
													</button>
												</td>

												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php if ($value['file_path'] != "Array" && $value['file_path'] != "") { ?>
														<a href="<?php echo Yii::app()->request->baseUrl; ?>/invoice/docs/<?php echo $value['file_path']; ?>" target="_blank">
															<?php echo $value['invoice']; ?>
														</a>
													<?php } else { ?>
														<span style="color:red;">
															<?php echo $value['invoice']; ?>
														</span>
													<?php
													} ?>
													<?php if ($value['invoice_mail_status'] == "Send") { ?>
														&nbsp; <a href="#" data-toggle="modal" data-target="#editSendMail" data-id="<?php echo $value['id']; ?>" title="Send E-mail to Customer"><i class="fa fa-envelope"></i></a>
													<?php } else { ?>
														&nbsp; <a href="#" data-toggle="modal" data-target="#editSendMail" data-id="<?php echo $value['id']; ?>" title="Send E-mail to Customer"><i class="fa fa-envelope-o"></i></a>
													<?php }

													if ($value['inv_link'] != "") {
													?>
														&nbsp; <a href="<?php echo $value['inv_link']; ?>" target="_blank" title="Invoice link"><i class="fa fa-link"></i></a>
													<?php
													}
													?>
												</td>
												<td class="text-left " style="vertical-align: middle;text-align:left;">
													<div class="col-md-12" style="vertical-align: middle;">
														<?php
														$data_order_no = str_replace(" ", '<br />', $value['order_no']);
														echo $data_order_no;
														?>
													</div>
												</td>
												<td class="" style="vertical-align: middle;text-align:left;">

													<div class="col-md-1" style="vertical-align: middle;">
														<?php
														if ($value['invoice_status'] == "Paid") { ?>
															<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
														<?php
														} elseif ($value['invoice_status'] == "Outstanding") { ?>

															<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
														<?php }	?>
													</div>
													<div class="col-md-10" style="vertical-align: middle;">
														<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/commission/year/<?php echo $year_commission; ?>/id/<?php echo $value['id']; ?>"><?php echo nl2br($value['order_name']); ?> </a>
													</div>
												</td>
												<?php
												$_month_name = array(
													"01" => "Jan.",  "02" => "Feb.",  "03" => "Mar.",
													"04" => "Apr.",  "05" => "May.",  "06" => "Jun.",
													"07" => "Jul.",  "08" => "Aug.",  "09" => "Sep.",
													"10" => "Oct.", "11" => "Nov.",  "12" => "Dec."
												);

												$vardate = $value['date_quarter'];
												list($year, $momth, $day) = explode("-", $vardate);
												$yy = $year;
												$mm = $momth;
												$dd = $day;

												if ($dd < 10) {
													$dd = substr($dd, 1, 2);
												}
												$date = $_month_name[$mm] . " " . $dd . ",  " . $yy;
												if ($mm == "01" || $mm == "02" || $mm == "03") {
													$quarter = "QTR 1";
												} elseif ($mm == "04" || $mm == "05" || $mm == "06") {
													$quarter = "QTR 2";
												} elseif ($mm == "07" || $mm == "08" || $mm == "09") {
													$quarter = "QTR 3";
												} elseif ($mm == "10" || $mm == "11" || $mm == "12") {
													$quarter = "QTR 4";
												}
												//echo $date;
												?>
												<td class="text-center " style="vertical-align: middle;"> <?php echo $date . "/ <br>" . $quarter; ?> </td>

												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['invoice_status'] == "Outstanding") {
														echo "<span style=\"color:red\">" . $value['invoice_status'] . "</span>";
													} else {
														echo "<span> " . $value['invoice_status'] . "</span>";
													}
													?>

												</td>

												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['invoice_status'] == "Paid") {
														if (!empty($value['invoice_amount_received'])) {
															echo "<span > ฿ " . number_format($value['invoice_amount_received'], 2) . " " . $value['currency'] . "</span><br>";
														}


														if ($value['invoice_date'] != "0000-00-00") {
															$_month_name_int = array(
																"01" => "Jan.",  "02" => "Feb.",  "03" => "Mar.",
																"04" => "Apr.",  "05" => "May.",  "06" => "Jun.",
																"07" => "Jul.",  "08" => "Aug.",  "09" => "Sep.",
																"10" => "Oct.", "11" => "Nov.",  "12" => "Dec."
															);

															$invoicedate = $value['invoice_date'];

															list($year_int, $momth_int, $day_int) = explode("-", $invoicedate);

															$yy_int = $year_int;
															$mm_int = $momth_int;
															$dd_int = $day_int;
															if ($dd_int < 10) {
																$dd_int = substr($dd_int, 1, 2);
															}
															$date_int = $_month_name_int[$mm_int] . " " . $dd_int . ",  " . $yy_int;

															echo "<span style=\"font-size:11px\">(Date : " . $date_int . ")</span><br>";
														}
													}
													?>

												</td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['sales_status'] == "1") {
														echo "<span style=\"font-weight: 700;\">Sales Manager</span>";
													} elseif ($value['sales_status'] == "2") {
														echo "<span style=\"font-weight: 700;\">Sales Rep</span>";
													} elseif ($value['sales_status'] == "3") {
														echo "<span style=\"font-weight: 700;\">Processor</span>";
													}
													?>
												</td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													$totalsale = ((($value['total_sales'] - $value['shipping_cost']) - $value['creditcard_feecost']) - $value['comp_itemcost']);

													if ($value['total_sales'] != 0) {
														if ($value['status_commission'] == "Approved") { ?>
															<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
														<?php
														} elseif ($value['status_commission'] == "Not Approved") { ?>

															<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
														<?php } else {	?>
															<i class="fa fa-square" aria-hidden="true" style="color:#e68c00"></i>&nbsp;
													<?php }

														echo "฿ " . number_format($totalsale, 2) . " " . $value['currency'];
													} else {
														echo "";
													}
													?>
												</td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['total_sales'] != 0) {
														echo $value['commission_percent'] . "%";
													}
													?>
												</td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php

													if ($value['total_sales'] != 0) {
														echo "฿ " . number_format($value['commission'], 2) . " " . $value['currency'];
													} else {
														echo "";
													}
													?>
												</td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['invoice_status'] == "Paid") {
														if ($value['commisson_payment_status'] == "Paid") {

															$balance_invoice = ($value['commission'] - $value['pay_for_sales']) - $value['pay_by_credit'];
															if ($balance_invoice != 0) {
																echo "<span style=\"color:red\">฿ " . number_format($balance_invoice, 2) . " " . $value['currency'] . "</span>";
															} else {
																echo "<span> ฿ " . number_format($balance_invoice, 2) . " " . $value['currency'] . "</span>";
															}
														} else {
															if ($totalsale != 0) {
																if ($value['commission'] != 0) {
																	echo "<span style=\"color:red\"> ฿ " . number_format($value['commission'], 2) . " " . $value['currency'] . "</span>";
																} else {
																	echo "<span> ฿ " . number_format($value['commission'], 2) . " " . $value['currency'] . "</span>";
																}
															}
														}
													}
													?>
												</td>


												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['commisson_payment_status'] == "Outstanding") {
														echo "<span style=\"color:red\">" . $value['commisson_payment_status'] . "</span>";
													} else {
														echo "<span> " . $value['commisson_payment_status'] . "</span>";
													}
													?>
												</td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['commisson_payment_status'] == "Paid") {
														$comm_payment = $value['pay_for_sales'] + $value['pay_by_credit'];
														if ($value['pay_by_credit'] != 0) {
															$style = 'style="color:red"';
														} else {
															$style = '';
														}

														echo "<span " . $style . "> ฿ " . number_format($comm_payment, 2) . " " . $value['currency'] . "</span><br>";

														if ($value['date_for_sales'] != "0000-00-00") {
															$_month_name_comm = array(
																"01" => "Jan.",  "02" => "Feb.",  "03" => "Mar.",
																"04" => "Apr.",  "05" => "May.",  "06" => "Jun.",
																"07" => "Jul.",  "08" => "Aug.",  "09" => "Sep.",
																"10" => "Oct.", "11" => "Nov.",  "12" => "Dec."
															);

															$commissiondate = $value['date_for_sales'];

															list($year_comm, $momth_comm, $day_comm) = explode("-", $commissiondate);

															$yy_comm = $year_comm;
															$mm_comm = $momth_comm;
															$dd_comm = $day_comm;

															if ($dd_comm < 10) {
																$dd_comm = substr($dd_comm, 1, 2);
															}
															$date_comm = $_month_name_comm[$mm_comm] . " " . $dd_comm . ",  " . $yy_comm;

															echo "<span style=\"font-size:11px\">(Date : " . $date_comm . ")</span><br>";
														}
													}
													?>
												</td>
												<td class="text-center" style="word-wrap:break-word;vertical-align: middle;">
													<?php
													$comments = Yii::app()->db->createCommand()
														->select('*')
														->from('comments com')
														->where('com.invoice = "' . $value['id'] . '"')
														->order('com.date_comments DESC')
														->limit('1')
														->queryAll();

													foreach ($comments as $key_co => $value_co) {
														if ($value_co['user_group'] == "1") {
															echo "JOG : ";
														} elseif ($value_co['user_group'] == "2") {
															echo "Sale : ";
														}
														echo nl2br($value_co['comments']);
													}
													?>
												</td>
												<td class="text-center" style="word-wrap:break-word;vertical-align: middle;">
													<?php
													if ($value['update_date'] != "0000-00-00") {
														$_month_name = array("01" => "Jan.", "02" => "Feb.", "03" => "Mar.", "04" => "Apr.", "05" => "May.", "06" => "Jun.", "07" => "Jul.", "08" => "Aug.", "09" => "Sep.", "10" => "Oct.", "11" => "Nov.", "12" => "Dec.");

														list($year, $momth, $day) = explode("-", $value['update_date']);

														if ($day < 10) {
															$day = substr($day, 1, 2);
														}

														$date = $_month_name[$momth] . " " . $day . ",  " . $year;
													?>
														<span style="font-size:12px;"><?php echo $date; ?></span>
													<?php
													} else {
														$date = " ";
													?>
														<span style="font-size:12px;"><?php echo $date; ?></span>
													<?php
													}
													?>
												</td>

											</tr>
									<?php }
									} ?>
									<?php if ($sumtotalTHB != 0) {  ?>

										<tr style="background-color: #c1ffe6;">
											<td colspan=""></td>
											<td colspan=""></td>
											<td colspan=""></td>
											<td colspan=""></td>
											<td colspan=""></td>
											<td colspan=""></td>
											<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
												<span><?php echo "฿ " . number_format($sumAmountReceivedTHB, 2) . " THB"; ?> </span>
											</td>
											<td colspan=""></td>

											<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
												<span><?php echo "฿ " . number_format($sumtotalTHB, 2) . " THB"; ?> </span>
											</td>
											<td></td>
											<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
												<span><?php echo "฿ " . number_format($totalcommissionTHB, 2) . " THB"; ?> </span>
											</td>
											<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
												<?php if ($commissionPaymentTHB == 0) {	?>
													<span><?php echo "฿ " . number_format($commissionPaymentTHB, 2) . " THB"; ?></span>
												<?php } else { ?>
													<span style="color:red;padding:5px 10px;"><?php echo "฿ " . number_format($commissionPaymentTHB, 2) . " THB"; ?></span>
												<?php } ?>
											</td>
											<td></td>
											<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
												<?php if (!empty($sumCommissionPaymaentTHB)) {	?>
													<span><?php echo "฿ " . number_format($sumCommissionPaymaentTHB, 2) . " THB"; ?></span>
												<?php } ?>
											</td>
											<td></td>
											<td></td>
										</tr>
									<?php	} ?>
								</tbody>
							</table>
						</div>
						<br>
					<?php } ?>
				<?php } ?>

				<br>
				<?php
				$extra_condition = '';
				if ($search_dateQuarter != "" && $search_dateQuarter2 != "") {
					$extra_condition = ' AND (date_quarter BETWEEN "' . $search_dateQuarter . '" AND "' . $search_dateQuarter2 . '") ';
				} else if ($year_commission != "" && $month_commission != "") {
					$extra_condition = ' AND date_quarter LIKE "' . $year_commission . '-' . $month_commission . '-%" ';
				} else if ($year_commission != "") {
					$extra_condition = ' AND date_quarter LIKE "' . $year_commission . '-%" ';
				}

				$getLoan = Yii::app()->db->createCommand('select * from calculator where sales_manager = "' . $sales_commission . '" ' . $extra_condition . ' AND (pay_by_customer!="0" OR pay_by_credit!=0) order by id DESC')->queryAll();

				if (sizeof($getLoan) > 0) {
				?>
					<div class="text-center" style="background-color:rgb(169, 185, 199);color:rgb(51, 67, 80);padding: 10px 0">
						<h4 style="font-weight: 700;"> Payment Received to Rep </h4>
					</div>
					<div id="freezer-Table" style="margin:0">
						<table id="calculatorLoancomTable" class="table table-striped table-bordered table-condensed table-freeze-multi" style="border-collapse: initial;" data-scroll-max-height="600">
							<thead>
								<tr>
									<th class="bg-blue-light text-center"></th>
									<th class="bg-blue-light text-center">Invoice</th>
									<th class="bg-blue-light text-center">Order No.</th>
									<th class="bg-blue-light text-center">Order Name<br><span style="color:#fd6262;font-size:11px;">*** Click Order Name *** <br> for Commission Calculator </span> </th>
									<th class="bg-blue-light text-center">Date/Quarter</th>
									<th class="bg-blue-light text-center">Invoice Status</th>
									<th class="bg-blue-light text-center">Amount Received</th>
									<th class="bg-blue-light text-center">Comm PO by JOG</th>
									<th class="bg-blue-light text-center">Payment received<br>from customer</th>
									<th class="bg-blue-light text-center">Comm PO by Credit</th>
									<th class="bg-blue-light text-center">Currency</th>
								</tr>
							</thead>
							<tbody>
								<?php

								foreach ($getLoan as $key_loan => $value_loan) {
								?>
									<tr>
										<td class="text-center">
											<a class="btn btn-success" href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/commission/year/<?php echo $year_commission; ?>/id/<?php echo $value_loan['id']; ?>">
												<i class="fa fa-pencil"></i>
											</a>
										</td>
										<td class="text-center nowrap" style="vertical-align: middle;">
											<span><?php echo $value_loan['invoice']; ?></span>
										</td>
										<td class="text-left " style="vertical-align: middle;text-align:left;">
											<div class="col-md-12" style="vertical-align: middle;">
												<?php
												$data_order_no = str_replace(" ", '<br />', $value_loan['order_no']);
												echo $data_order_no;
												?>
											</div>
										</td>
										<td class="" style="vertical-align: middle;text-align:left;">

											<?php
											if ($value_loan['invoice_status'] == "Paid") {
												echo '<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;';
											} elseif ($value_loan['invoice_status'] == "Outstanding") {
												echo '<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;';
											}
											?>
											<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/commission/year/<?php echo $year_commission; ?>/id/<?php echo $value_loan['id']; ?>"><?php echo nl2br($value_loan['order_name']); ?> </a>
										</td>
										<?php
										$_month_name = array(
											"01" => "Jan.",  "02" => "Feb.",  "03" => "Mar.",
											"04" => "Apr.",  "05" => "May.",  "06" => "Jun.",
											"07" => "Jul.",  "08" => "Aug.",  "09" => "Sep.",
											"10" => "Oct.", "11" => "Nov.",  "12" => "Dec."
										);

										$vardate = $value_loan['date_quarter'];
										list($year, $momth, $day) = explode("-", $vardate);
										$yy = $year;
										$mm = $momth;
										$dd = $day;

										if ($dd < 10) {
											$dd = substr($dd, 1, 2);
										}
										$date = $_month_name[$mm] . " " . $dd . ",  " . $yy;
										if ($mm == "01" || $mm == "02" || $mm == "03") {
											$quarter = "QTR 1";
										} elseif ($mm == "04" || $mm == "05" || $mm == "06") {
											$quarter = "QTR 2";
										} elseif ($mm == "07" || $mm == "08" || $mm == "09") {
											$quarter = "QTR 3";
										} elseif ($mm == "10" || $mm == "11" || $mm == "12") {
											$quarter = "QTR 4";
										}
										//echo $date;
										?>
										<td class="text-center " style="vertical-align: middle;"> <?php echo $date . "/ <br>" . $quarter; ?> </td>

										<td class="text-center nowrap" style="vertical-align: middle;">
											<?php
											if ($value_loan['invoice_status'] == "Outstanding") {
												echo "<span style=\"color:red\">" . $value_loan['invoice_status'] . "</span>";
											} else {
												echo "<span> " . $value_loan['invoice_status'] . "</span>";
											}
											?>

										</td>

										<td class="text-center nowrap" style="vertical-align: middle;">
											<?php
											if ($value_loan['currency'] == 'THB') {
												$cicon = '฿';
											} else {
												$cicon = '$';
											}
											if ($value_loan['invoice_status'] == "Paid") {
												if (!empty($value_loan['invoice_amount_received'])) {

													echo "<span > " . $cicon . " " . number_format($value_loan['invoice_amount_received'], 2) . " " . $value_loan['currency'] . "</span><br>";
												}


												if ($value_loan['invoice_date'] != "0000-00-00") {
													$_month_name_int = array(
														"01" => "Jan.",  "02" => "Feb.",  "03" => "Mar.",
														"04" => "Apr.",  "05" => "May.",  "06" => "Jun.",
														"07" => "Jul.",  "08" => "Aug.",  "09" => "Sep.",
														"10" => "Oct.", "11" => "Nov.",  "12" => "Dec."
													);

													$invoicedate = $value_loan['invoice_date'];

													list($year_int, $momth_int, $day_int) = explode("-", $invoicedate);

													$yy_int = $year_int;
													$mm_int = $momth_int;
													$dd_int = $day_int;
													if ($dd_int < 10) {
														$dd_int = substr($dd_int, 1, 2);
													}
													$date_int = $_month_name_int[$mm_int] . " " . $dd_int . ",  " . $yy_int;

													echo "<span style=\"font-size:11px\">(Date : " . $date_int . ")</span><br>";
												}
											}
											?>

										</td>
										<td class="text-center nowrap" style="vertical-align: middle;"><span> <?php echo '$ ' . number_format($value_loan['pay_for_sales']) . ' ' . $value_loan['currency']; ?> </span></td>
										<td class="text-center nowrap" style="vertical-align: middle;">
											<?php
											if ($value_loan['pay_by_customer'] != 0) {
												$style = 'style="color:#c50202;padding:5px 10px;font-weight: 700;"';
											} else {
												$style = '';
											}
											echo '<span ' . $style . '>' . $cicon . ' ' . number_format($value_loan['pay_by_customer'], 2) . ' ' . $value_loan['currency'] . '</span> '; ?>
										</td>
										<td class="text-center nowrap" style="vertical-align: middle;">
											<?php
											if ($value_loan['pay_by_credit'] != 0) {
												$style = 'style="color:#c50202;padding:5px 10px;font-weight: 700;"';
											} else {
												$style = '';
											}
											echo '<span ' . $style . '>' . $cicon . ' ' . number_format($value_loan['pay_by_credit'], 2) . ' ' . $value_loan['currency'] . '</span>';

											?>
										</td>
										<td class="text-center nowrap" style="vertical-align: middle;"> <span> <?php echo $value_loan['currency']; ?> </span> </td>
									</tr>
								<?php
								}

								$sumLoan = Yii::app()->db->createCommand('select SUM(pay_by_credit) AS SumPBC, SUM(pay_by_customer) AS SumPC from calculator where sales_manager = "' . $sales_commission . '" ' . $extra_condition . ' AND (pay_by_customer!="0" OR pay_by_credit!=0) order by id DESC')->queryAll(); //--AND date_quarter LIKE "'.$_GET['year'].'%"
								foreach ($sumLoan as $key_sum_loan => $value_sum_loan) {
								?>
									<tr style="background-color: #c1ffe6;">
										<td class="text-center"></td>
										<td class="text-center"></td>
										<td class="text-center"></td>
										<td class="text-center"></td>
										<td class="text-center"></td>
										<td class="text-center"></td>
										<td class="text-center"></td>
										<td class="text-center"></td>
										<td class="text-center"><span style="color:red;padding:5px 10px;"><b><?php echo $cicon . ' ' . number_format($value_sum_loan['SumPC'], 2); ?></b></span></td>
										<td class="text-center"><span style="color:red;padding:5px 10px;"><b><?php echo $cicon . ' ' . number_format($value_sum_loan['SumPBC'], 2); ?></b></span></td>
										<td class="text-center"></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				<?php
				}

				?>
				<br>
				<!-- <div class="btn-add">
					<a href="#" class="btn btn-success" data-toggle="modal" data-target="#editBank"><i class="fa fa-pencil"></i> Edit</a>
				</div> -->
				<table id="bankTable" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="bg-blue-light" style="width:50%">Notes</th>
							<th class="bg-blue-light" style="width:50%"><!-- Bank Account Details: --></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="word-wrap:break-word;"><?php echo nl2br($notes['notes']); ?></td>
							<td style="word-wrap:break-word;">
								<?php
								/*
								<div><span style="font-weight: 700;" >Bank Name : </span><?php echo $bankAccount['bank_name']; ?></div>
								<div><span style="font-weight: 700;" >Account Name : </span><?php echo $bankAccount['bank_account_name']; ?></div>
								<div><span style="font-weight: 700;" >Account Number : </span><?php echo $bankAccount['bank_number']; ?></div>
								<div><span style="font-weight: 700;" >Swift Code : </span><?php echo $bankAccount['bank_swift_code']; ?></div>
								<div><span style="font-weight: 700;" >Make check payable to : </span><?php echo $bankAccount['bank_name_check']; ?></div>
								<div><span style="font-weight: 700;" >Mailing Address : </span><?php echo $bankAccount['bank_mailing_address']; ?></div>
								<div><span style="font-weight: 700;" >Other : </span><?php echo $bankAccount['bank_other']; ?></div>
								*/
								?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>

<div class="modal fade" id="addData" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="flex-header modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Sales Commission Calculator - Add</h4>
			</div>
			<div class="modal-body">

				<?php echo $this->renderPartial('/calculator/addCalculatorEachSalesRep');  ?>
			</div>

		</div>
	</div>
</div>
<div class="modal fade" id="editData" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Sales Commission Calculator- Edit</h4>
			</div>
			<div class="modal-body">

				<?php
				$a_req = array();
				$a_req["year"] = $year_commission;
				$a_req["sales"] = $sales_commission;
				$a_req["month"] = $month_commission;

				echo $this->renderPartial('/calculator/editCalculator', $a_req);
				?>
			</div>

		</div>
	</div>
</div>
<!-- Edit Notes -->
<?php /*
<div class="modal fade" id="editBank" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Bank Account</h4>
			</div>
			<div class="modal-body">
            <?php 
            	$form=$this->beginWidget('CActiveForm', array(
					'id'          => 'edit-bank-form',
					'htmlOptions' => array(
						'class'  => 'form-horizontal form-label-left',
						),
					));
			?>
				<div class="form-group">
					<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $bankAccount->getAttributeLabel('bank_name'); ?></label>
					<div class="col-md-9 col-sm-6 col-xs-12">
						<?php echo $form->hiddenField($bankAccount, 'fullname'); ?>
						
						<?php echo $form->textField($bankAccount, 'bank_name', array('class'=>'form-control', 'required' => true)); ?>
					</div>
				</div>

                <div class="form-group">
					<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $bankAccount->getAttributeLabel('bank_account_name'); ?></label>
					<div class="col-md-9 col-sm-6 col-xs-12">
						
						<?php echo $form->textField($bankAccount, 'bank_account_name', array('class'=>'form-control', 'required' => true)); ?>
						
					</div>
				</div>

                <div class="form-group">
					<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $bankAccount->getAttributeLabel('bank_number'); ?></label>
					<div class="col-md-9 col-sm-6 col-xs-12">

						<?php echo $form->textField($bankAccount, 'bank_number', array('class'=>'form-control', 'required' => true)); ?>
						
					</div>
				</div>

                <div class="form-group">
					<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $bankAccount->getAttributeLabel('bank_swift_code'); ?></label>
					<div class="col-md-9 col-sm-6 col-xs-12">
						
						<?php echo $form->textField($bankAccount, 'bank_swift_code', array('class'=>'form-control')); ?>
						
					</div>
				</div>

                <div class="form-group">
					<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $bankAccount->getAttributeLabel('bank_name_check'); ?></label>
					<div class="col-md-9 col-sm-6 col-xs-12">
						
						<?php echo $form->textField($bankAccount, 'bank_name_check', array('class'=>'form-control')); ?>
						
					</div>
				</div>

                <div class="form-group">
					<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $bankAccount->getAttributeLabel('bank_mailing_address'); ?></label>
					<div class="col-md-9 col-sm-6 col-xs-12">
						
						<?php echo $form->textArea($bankAccount, 'bank_mailing_address', array('class'=>'form-control')); ?>
						
					</div>
				</div>

                 <div class="form-group">
					<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $bankAccount->getAttributeLabel('bank_other'); ?></label>
					<div class="col-md-9 col-sm-6 col-xs-12">
						
						<?php echo $form->textArea($bankAccount, 'bank_other', array('class'=>'form-control')); ?>
					</div>
				</div>

                
                
			<?php 
				$this->endWidget();
            ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="edit-submit-bank">Save</button>
			</div>
		</div>
	</div>
</div>
*/
?>

<div class="modal fade" id="editSendMail" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Send Mail to Customer</h4>
			</div>
			<div class="modal-body">

				<?php echo $this->renderPartial('/calculator/editSendmail');  ?>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="send-submit-mail">Send</button>
			</div>
		</div>
	</div>
</div>