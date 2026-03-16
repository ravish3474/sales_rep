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

	.lastUpdated {
		background: #ff000012;
		font-size: 11px;
		font-family: unset;
		padding: 5px 20px;
		color: #e84949;
		font-weight: 600;
	}

	.invoiceMainTable,
	.searchBox {
		border: 1px solid #E6E9ED;
		padding: 10px;
		border-radius: 4px;
	}

	.searchFormArea {
		display: grid;
		grid-template-columns: repeat(4, 1fr);
		gap: 20px;
		padding: 20px;
	}

	.searchFormArea label {
		display: block;
		font-weight: 500;
	}

	.column2 {
		grid-column: span 2;
	}

	.searchFormArea .subRow,
	.searchFormArea .subItems {
		display: flex;
		align-items: center;
		gap: 10px;

	}

	.searchFormArea .subItems {
		flex-direction: row-reverse;
	}

	.greenBtn {
		background: #5CB85C !important;
	}

	.searchFormArea .subItems input,
	.searchFormArea .subItems label {
		cursor: pointer;
		margin: 0;
		white-space: nowrap;
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
if (!isset($month_select)) {
	$month_select = "all";
}
if (!isset($year_select)) {
	$year_select = date("Y");
}
?>
<div class="row" id="calculator">

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<div class="d-flex justify-content-between">
					<h2>Invoice</h2>
					<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/FiscalYearInvoice" class="link goBackBtn">
						<i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Go Back
					</a>
				</div>
				<!-- <div class="clearfix"></div> -->
			</div>
			<div class="x_content">

				<div class="d-flex justify-content-between">
					<div>
						<div>
							<?php
							$getDate = Yii::app()->db->createCommand('select MAX(update_date) AS datedata  from calculator where 1 order by id DESC limit 1')->queryAll();

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
							<span class="lastUpdated">Last Update! : <?php echo $date ?><span>
						</div>
						<h2 class="sSize"> <?php echo $year_commission . " Year"; ?>
							<select id="select_month" onchange="changeMonth();" style="width:auto; margin-left: 10px;">
								<option value="01" <?php if ($month_select == "01") {
														echo "selected";
													} ?>>January</option>
								<option value="02" <?php if ($month_select == "02") {
														echo "selected";
													} ?>>Febuary</option>
								<option value="03" <?php if ($month_select == "03") {
														echo "selected";
													} ?>>March</option>
								<option value="04" <?php if ($month_select == "04") {
														echo "selected";
													} ?>>April</option>
								<option value="05" <?php if ($month_select == "05") {
														echo "selected";
													} ?>>May</option>
								<option value="06" <?php if ($month_select == "06") {
														echo "selected";
													} ?>>June</option>
								<option value="07" <?php if ($month_select == "07") {
														echo "selected";
													} ?>>July</option>
								<option value="08" <?php if ($month_select == "08") {
														echo "selected";
													} ?>>August</option>
								<option value="09" <?php if ($month_select == "09") {
														echo "selected";
													} ?>>September</option>
								<option value="10" <?php if ($month_select == "10") {
														echo "selected";
													} ?>>October</option>
								<option value="11" <?php if ($month_select == "11") {
														echo "selected";
													} ?>>November</option>
								<option value="12" <?php if ($month_select == "12") {
														echo "selected";
													} ?>>December</option>
								<option value="all" <?php if ($month_select == "all") {
														echo "selected";
													} ?>>==All==</option>
							</select>

						</h2>
					</div>
					<a href="<?php echo Yii::app()->baseUrl; ?>/pdf/invioceAll/year/<?php echo $year_commission; ?>" class="paf_dowload" target="_blank"> PDF (ALL)</a>

				</div>



				<?php if ($sumtotalUSD != 0 || $sumtotalCAD != 0 || $sumtotalSGD != 0 || $sumtotalTHB != 0) { ?>
					<div class="invoiceMainTable">
						<div id="parent">
							<table id="calculatorHeaderTable" class="table table-striped table-bordered" style="border-collapse: initial;width:100%;">
								<thead>
									<tr>
										<?php if ($sumtotalUSD != 0) {  ?>
											<th colspan="3" class="text-center" style="background-color: rgb(0, 65, 121);color:#fff;font-weight: 700;">
												<span> USD </span>
											</th>
										<?php	}
										if ($sumtotalCAD != 0) {  ?>
											<th colspan="3" class="text-center" style="background-color:rgb(0, 65, 121);color:#fff;font-weight: 700;">
												<span> CAD </span>
											</th>
										<?php	}
										if ($sumtotalSGD != 0) {  ?>
											<th colspan="3" class="text-center" style="background-color:rgb(0, 65, 121);color:#fff;font-weight: 700;">
												<span> SGD </span>
											</th>
										<?php	}
										if ($sumtotalTHB != 0) {  ?>
											<th colspan="3" class="text-center" style="background-color:rgb(0, 65, 121);color:#fff;font-weight: 700;">
												<span> THB </span>
											</th>
										<?php	} ?>
									</tr>
									<tr>
										<?php if ($sumtotalUSD != 0) {  ?>
											<th class="text-center" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;"> Total Sales </th>
											<th class="text-center" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;"> Total commissions Earned </th>
											<th class="text-center" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;"> Balance </th>
										<?php	}
										if ($sumtotalCAD != 0) {  ?>
											<th class="text-center" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;"> Total Sales </th>
											<th class="text-center" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;"> Total commissions Earned </th>
											<th class="text-center" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;"> Balance </th>
										<?php	}
										if ($sumtotalSGD != 0) {  ?>
											<th class="text-center" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;"> Total Sales </th>
											<th class="text-center" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;"> Total commissions Earned </th>
											<th class="text-center" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;"> Balance </th>
										<?php	}
										if ($sumtotalTHB != 0) {  ?>
											<th class="text-center" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;"> Total Sales </th>
											<th class="text-center" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;"> Total commissions Earned </th>
											<th class="text-center" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;"> Balance </th>
										<?php	} ?>
									</tr>
								</thead>
								<tbody>

									<tr>
										<?php if ($sumtotalUSD != 0) {  ?>
											<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;vertical-align: middle;font-weight: 700;">
												<span><?php echo "$ " . number_format($sumtotalUSD, 2); ?> </span>
											</td>
											<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;vertical-align: middle;font-weight: 700;">
												<span><?php echo "$ " . number_format($totalcommissionUSD, 2); ?> </span>
											</td>
											<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;vertical-align: middle;font-weight: 700;">
												<?php if ($commissionPaymentUSD == 0) {	?>
													<span><?php echo "$ " . number_format($commissionPaymentUSD, 2); ?></span>
												<?php } else { ?>
													<span style="color:red;padding:5px 10px;"><?php echo "$ " . number_format($commissionPaymentUSD, 2); ?></span>
												<?php } ?>
											</td>
										<?php	}
										if ($sumtotalCAD != 0) {  ?>
											<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;vertical-align: middle;font-weight: 700;">
												<span><?php echo "$ " . number_format($sumtotalCAD, 2); ?></span>
											</td>
											<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;vertical-align: middle;font-weight: 700;">
												<span><?php echo "$ " . number_format($totalcommissionCAD, 2); ?></span>
											</td>
											<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;vertical-align: middle;font-weight: 700;">
												<?php if ($commissionPaymentCAD == 0) {	?>
													<span><?php echo "$ " . number_format($commissionPaymentCAD, 2); ?></span>
												<?php } else { ?>
													<span style="color:red;padding:5px 10px;"><?php echo "$ " . number_format($commissionPaymentCAD, 2); ?></span>
												<?php } ?>
											</td>
										<?php	}
										if ($sumtotalSGD != 0) {  ?>
											<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;vertical-align: middle;font-weight: 700;">
												<span><?php echo "$ " . number_format($sumtotalSGD, 2); ?> </span>
											</td>
											<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;vertical-align: middle;font-weight: 700;">
												<span><?php echo "$ " . number_format($totalcommissionSGD, 2); ?> </span>
											</td>
											<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;vertical-align: middle;font-weight: 700;">

												<?php if ($commissionPaymentSGD == 0) {	?>
													<span><?php echo "$ " . number_format($commissionPaymentSGD, 2); ?></span>
												<?php } else { ?>
													<span style="color:red;padding:5px 10px;"><?php echo "$ " . number_format($commissionPaymentSGD, 2); ?></span>
												<?php } ?>
											</td>
										<?php	}
										if ($sumtotalTHB != 0) {  ?>
											<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;vertical-align: middle;font-weight: 700;">
												<span><?php echo "฿ " . number_format($sumtotalTHB, 2); ?></span>
											</td>
											<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;vertical-align: middle;font-weight: 700;">
												<span><?php echo "฿ " . number_format($totalcommissionTHB, 2); ?></span>
											</td>
											<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;vertical-align: middle;font-weight: 700;">
												<?php if ($commissionPaymentTHB == 0) {	?>
													<span><?php echo "฿ " . number_format($commissionPaymentTHB, 2); ?></span>
												<?php } else { ?>
													<span style="color:red;padding:5px 10px;"><?php echo "฿ " . number_format($commissionPaymentTHB, 2); ?></span>
												<?php } ?>
											</td>
										<?php	} ?>
									</tr>

								</tbody>
							</table>

						</div>
					</div>
					<br>
					<hr style=" border: 0;height: 1px;background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));">
					<br>
				<?php } ?>
				<div class="col-md-12">

					<div class="searchBox border">
						<h4>SEARCH</h4>

						<form id="form_checkbox1" class="form-horizontal" action="<?php echo Yii::app()->request->baseUrl; ?>/calculator/seachInvoice" method="post">
							<input type="hidden" name="sale_rep" value="<?php //echo $sales_commission; 
																		?>">
							<input type="hidden" name="year_commission" value="<?php echo $year_commission; ?>">

							<div class="row" style="padding-top:10px;">
								<div class="searchFormArea">
									<div class="formItems">
										<label for="">Invoice :</label>
										<?php $db_invoice = Yii::app()->db->createCommand('select invoice from calculator where invoice != "" group by invoice order by invoice ASC')->queryAll(); ?>
										<select name="search_invoice" class="form-control">
											<option hidden></option>
											<?php foreach ($db_invoice as $key => $value) { ?>
												<option value="<?php echo $value['invoice']; ?>" <?php if ($search_invoice == $value['invoice']) {
																										echo "selected";
																									} ?>># <?php echo $value['invoice']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="formItems">
										<label for=""> Date Quarter : </label>
										<input type="text" name="search_dateQuarter" class="form-control" id="search_dateQuarter" value="<?php if (!empty($search_dateQuarter)) {
																																				echo $search_dateQuarter;
																																			} ?>" style="float: left;">

									</div>
									<div class="formItems">
										<label for=""> Order No. :</label>
										<?php $db_orderno = Yii::app()->db->createCommand('select order_no from calculator where order_no != "" group by order_no order by order_no ASC')->queryAll(); ?>

										<select name="search_orderno" class="form-control">
											<option hidden></option>
											<?php foreach ($db_orderno as $key => $value) { ?>
												<option value="<?php echo $value['order_no']; ?>" <?php if ($search_orderno == $value['order_no']) {
																										echo "selected";
																									} ?>># <?php echo $value['order_no']; ?></option>
											<?php } ?>
										</select>

									</div>
									<div class="formItems ">
										<label for="">Order Name</label>
										<input type="text" name="search_ordername" class="form-control" value="<?php if (!empty($search_ordername)) {
																													echo $search_ordername;
																												} ?>">

									</div>
									<div class="formItems">
										<label for="">- </label>
										<select name="search_invoice2" class="form-control">
											<option hidden></option>
											<?php foreach ($db_invoice as $key => $value) { ?>
												<option value="<?php echo $value['invoice']; ?>" <?php if ($search_invoice2 == $value['invoice']) {
																										echo "selected";
																									} ?>># <?php echo $value['invoice']; ?></option>
											<?php } ?>
										</select>
									</div>

									<div class="formItems">
										<label for="">- </label>
										<input type="text" name="search_dateQuarter2" class="form-control" id="search_dateQuarter2" value="<?php if (!empty($search_dateQuarter2)) {
																																				echo $search_dateQuarter2;
																																			} ?>">
									</div>


									<div class="formItems">
										<label for="">-</label>
										<select name="search_orderno2" class="form-control">
											<option hidden></option>
											<?php foreach ($db_orderno as $key => $value) { ?>
												<option value="<?php echo $value['order_no']; ?>" <?php if ($search_orderno2 == $value['order_no']) {
																										echo "selected";
																									} ?>># <?php echo $value['order_no']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="formItems">

									</div>
									<div class="formItems">
										<label for="">Invoice Status:</label>
										<div class="subRow">
											<div class="subItems">
												<label for="invoicePaid" class="subLabel">Paid</label>
												<input id="invoicePaid" class="invoice_status" type="checkbox" name="invoice_status" value="Paid" <?php if ($invoice_status == "Paid") {
																																						echo "checked";
																																					} ?>>




											</div>
											<div class="subItems">
												<label for="Outstanding" class="subLabel">Outstanding</label>

												<input id="Outstanding" class="invoice_status" type="checkbox" name="invoice_status" value="Outstanding" <?php if ($invoice_status == "Outstanding") {
																																								echo "checked";
																																							} ?>>

											</div>
										</div>
									</div>
									<div class="formItems">
										<label for=""> Approved Status</label>
										<div class="subRow">
											<div class="subItems">
												<label for="invoice_status_pending" class="subLabel">Pending</label>
												<input id="invoice_status_pending" class="aproved_status" type="checkbox" name="aproved_status" value="Pending" <?php if ($aproved_status == "Pending") {
																																									echo "checked";
																																								} ?>>
											</div>
											<div class="subItems">
												<label for="invoice_status_approved" class="subLabel">Approved</label>
												<input id="invoice_status_approved" class="aproved_status" type="checkbox" name="aproved_status" value="Approved" <?php if ($aproved_status == "Approved") {
																																										echo "checked";
																																									} ?>>
											</div>
											<div class="subItems">
												<label for="invoice_status_NotApproved" class="subLabel"> Not Approved</label>

												<input id="invoice_status_NotApproved" class="aproved_status" type="checkbox" name="aproved_status" value="Not Approved" <?php if ($aproved_status == "Not Approved") {
																																												echo "checked";
																																											} ?>>
											</div>





										</div>
									</div>
									<div class="formItems">
										<label for="">Commission Status</label>
										<div class="subRow">
											<div class="subItems">
												<label for="commission_status_paid">Paid</label>
												<input id="commission_status_paid" class="commission_status" type="checkbox" name="commission_status" value="Paid" <?php if ($commission_status == "Paid") {
																																										echo "checked";
																																									} ?>>
											</div>

											<div class="subItems">
												<label for="commission_status_outstanding">Outstanding</label>
												<input id="commission_status_paid" class="commission_status" type="checkbox" name="commission_status" value="Outstanding" <?php if ($commission_status == "Outstanding") {
																																												echo "checked";
																																											} ?>>
											</div>

										</div>
									</div>
									<div class="formItems">
										<input type="button" value="Clear" class="btn btn-light" onclick="window.location.href='<?php echo Yii::app()->request->baseUrl; ?>/calculator/Invoice/year/<?php echo $year_commission; ?>'" />
										<input type="submit" value="Submit" class="btn greenBtn">
									</div>
								</div>
							</div>





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
					</div>


				</div>
				<div class="row mt-20" style="margin-left:5px;">
					<div class="col-md-12">
						<div>
							<span>Commission Status : </span>
							<i class="fa fa-square" aria-hidden="true" style="color:green"> Approved </i>&nbsp; &nbsp; <i class="fa fa-square" aria-hidden="true" style="color:red"> Not Approved </i>&nbsp; &nbsp;<i class="fa fa-square" aria-hidden="true" style="color:#e68c00"> Pending </i>
						</div>
						<div>

							<span>Invoice Status : </span>
							<i class="fa fa-square" aria-hidden="true" style="color:green"> Paid </i>&nbsp; &nbsp; <i class="fa fa-square" aria-hidden="true" style="color:red"> Outstanding </i>
						</div>
						<div>
							<span>Invoice Mailing Status : </span>
							<i class="fa fa-envelope"></i> Sent </i>&nbsp;&nbsp;<i class="fa fa-envelope-o"></i> Not Send </i>&nbsp;&nbsp;
						</div>
						<div>
							<span>Sales Responsible : </span>
							<i class="fa fa-user" aria-hidden="true"></i> Sales Manager (M) &nbsp;&nbsp; <i class="fa fa-user" aria-hidden="true"></i> Sales Rep (R) &nbsp;&nbsp; <i class="fa fa-user" aria-hidden="true"></i> Processor (P)
						</div>
					</div>
				</div>
				<div class="row mt-20" style="margin-left:5px;">
					<div class="col-md-12">
						<div class="btn-add">
							<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#addData" data-id="<?php //echo $sales_commission; 
																													?>"><i class="fa fa-plus"></i> Add</a>
						</div>
					</div>
				</div>
				<br>


				<?php

				$currency_curr = array_unique($currency);
				foreach ($currency_curr as $curr) {

					if ($curr == "USD") { ?>
						<div style="margin-bottom:10px;">
							<a href="<?php echo Yii::app()->baseUrl; ?>/pdf/invioceUSD/year/<?php echo $year_commission; ?>" class="paf_dowload" target="_blank"> PDF (USD)</a>
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
									<col style="width:200px;">
									<col style="width:180px;">
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
										<th colspan="" class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Sales Responsible </th>
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
										<th class="bg-blue-light text-center nowrap"> Order Name <br><span style="color:#fd6262;font-size:11px;">** Click Order Name ** <br> for Commission <br>Calculator </span></th>
										<th class="bg-blue-light text-center"> Date/Quarter </th>

										<th class="bg-blue-light text-center"> Invoice Status</th>
										<th class="bg-blue-light text-center"> Amount Received</th>

										<th class="bg-blue-light text-center"> Sales Responsible </th>

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
													<button class="btn btn-danger confirm" del-id="<?php echo $value['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/calculator/deleteInvoiceAll">
														<i class="fa fa-close"></i>
													</button>
												</td>

												<td class="text-left nowrap" style="vertical-align: middle;text-align:left;">
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
															<i class="fa fa-square" aria-hidden="true" style="color:green;display: initial;"></i>&nbsp;
														<?php
														} elseif ($value['invoice_status'] == "Outstanding") { ?>

															<i class="fa fa-square" aria-hidden="true" style="color:red;display: initial;"></i>&nbsp;
														<?php }	?>
													</div>
													<div class="col-md-10" style="vertical-align: middle;"><?php echo nl2br($value['order_name']); ?></div>
												</td>
												<?php
												$_month_name = array(
													"01" => "Jan.",
													"02" => "Feb.",
													"03" => "Mar.",
													"04" => "Apr.",
													"05" => "May.",
													"06" => "Jun.",
													"07" => "Jul.",
													"08" => "Aug.",
													"09" => "Sep.",
													"10" => "Oct.",
													"11" => "Nov.",
													"12" => "Dec."
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
												<td class="text-center nowrap" style="vertical-align: middle;"> <?php echo $date . "/<br>" . $quarter; ?> </td>
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
														if ($value['invoice_amount_received'] != 0) {
															echo "<span > $ " . number_format($value['invoice_amount_received'], 2) . " " . $value['currency'] . "</span><br>";
															if ($value['invoice_date'] != "0000-00-00") {
																$_month_name_int = array(
																	"01" => "Jan.",
																	"02" => "Feb.",
																	"03" => "Mar.",
																	"04" => "Apr.",
																	"05" => "May.",
																	"06" => "Jun.",
																	"07" => "Jul.",
																	"08" => "Aug.",
																	"09" => "Sep.",
																	"10" => "Oct.",
																	"11" => "Nov.",
																	"12" => "Dec."
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
													}
													?>

												</td>
												<td class="text-left nowrap" style="text-align:left;">
													<?php
													if (!empty($commission_status)) {
														$getResponsible = Yii::app()->db->createCommand()
															->select('*')
															->from('calculator c')
															->where('c.invoice = "' . $value['invoice'] . '"')
															->andwhere('c.commisson_payment_status = "' . $commission_status . '"')
															->order('c.sales_status ASC')
															->queryAll();
													} else {
														$getResponsible = Yii::app()->db->createCommand()
															->select('*')
															->from('calculator c')
															->where('c.invoice = "' . $value['invoice'] . '"')
															->order('c.sales_status ASC')
															->queryAll();
													}


													foreach ($getResponsible as $key_res => $value_res) {

														if ($value_res['sales_status'] == "1") { ?>
															<div class="sales_Responsible_manager">

																<button class="btn btn-success" data-toggle="modal" data-target="#editDataMan" data-id="<?php echo $value_res['id']; ?>" style="padding: 0px 3px;font-size: 8px;margin-bottom: 0px;">
																	<i class="fa fa-pencil"></i>
																</button>

																<button class="btn btn-danger confirm" del-id="<?php echo $value_res['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/calculator/deleteInvoiceSeparateSales" style="padding: 0px 3px;font-size: 8px;margin-bottom: 0px;">
																	<i class="fa fa-close"></i>
																</button>

																<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/InvoiceDetail/year/<?php echo $year_commission; ?>/id/<?php echo $value_res['id']; ?>"><?php echo "<span style=\"font-weight: 700;\">M : </span>"; ?><?php echo $value_res['sales_manager'];  ?></a><br>
															</div>

														<?php } elseif ($value_res['sales_status'] == "2") { ?>
															<div class="sales_Responsible_salesrep">
																<button class="btn btn-success" data-toggle="modal" data-target="#editDataRep" data-id="<?php echo $value_res['id']; ?>" style="padding: 0px 3px;font-size: 8px;margin-bottom: 0px;">
																	<i class="fa fa-pencil"></i>
																</button>

																<button class="btn btn-danger confirm" del-id="<?php echo $value_res['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/calculator/deleteInvoiceSeparateSales" style="padding: 0px 3px;font-size: 8px;margin-bottom: 0px;">
																	<i class="fa fa-close"></i>
																</button>

																<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/InvoiceDetail/year/<?php echo $year_commission; ?>/id/<?php echo $value_res['id']; ?>"><?php echo "<span style=\"font-weight: 700;\">R : </span>"; ?>
																	<?php echo $value_res['sales_manager'];  ?></a><br>
															</div>
														<?php } elseif ($value_res['sales_status'] == "3") { ?>
															<div class="sales_Responsible_processor">
																<button class="btn btn-success" data-toggle="modal" data-target="#editDataProcessor" data-id="<?php echo $value_res['id']; ?>" style="padding: 0px 3px;font-size: 8px;margin-bottom: 0px;">
																	<i class="fa fa-pencil"></i>
																</button>

																<button class="btn btn-danger confirm" del-id="<?php echo $value_res['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/calculator/deleteInvoiceSeparateSales" style="padding: 0px 3px;font-size: 8px;margin-bottom: 0px;">
																	<i class="fa fa-close"></i>
																</button>

																<?php echo "<span style=\"font-weight: 700;\">P : </span>"; ?>
																<?php echo $value_res['sales_manager'] . "<br>";  ?>
															</div>
														<?php }
													}
													if (sizeof($getResponsible) != 3) { ?>
														<div class="sales_Responsible_sales">

															<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#addDataMan" data-id="<?php echo $value['invoice']; ?>" style="padding: 0px 3px;font-size: 10px;margin-bottom: 0px;"><i class="fa fa-plus"></i> Add</a>

														</div>
													<?php	} ?>
												</td>

												<td class="text-left nowrap" style="text-align:left;">
													<?php

													foreach ($getResponsible as $key_res => $value_res) {

														$totalsale = ((($value_res['total_sales'] - $value_res['shipping_cost']) - $value_res['creditcard_feecost']) - $value_res['comp_itemcost']);
														if ($value_res['sales_status'] == "1") {
															if ($value_res['total_sales'] != 0) {
																if ($value_res['status_commission'] == "Approved") { ?>
																	<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
																<?php
																} elseif ($value_res['status_commission'] == "Not Approved") { ?>
																	<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
																<?php 				} else {	?>
																	<i class="fa fa-square" aria-hidden="true" style="color:#e68c00"></i>&nbsp;
																<?php 				}

																echo "<span style=\"font-weight: 700;\">M : </span>";
																echo "$ " . number_format($totalsale, 2) . " " . $value_res['currency'] . "<br>";
															} else {
																echo "<span style=\"font-weight: 700;\"> </span><br>";
															}
														} elseif ($value_res['sales_status'] == "2") {
															if ($value_res['total_sales'] != 0) {
																if ($value_res['status_commission'] == "Approved") { ?>
																	<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
																<?php
																} elseif ($value_res['status_commission'] == "Not Approved") { ?>

																	<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
																<?php 				} else {	?>
																	<i class="fa fa-square" aria-hidden="true" style="color:#e68c00"></i>&nbsp;
													<?php }
																echo "<span style=\"font-weight: 700;\">R : </span>";
																echo "$ " . number_format($totalsale, 2) . " " . $value_res['currency'] . "<br>";
															} else {
																echo "<span style=\"font-weight: 700;\"> </span><br>";
															}
														}
													}

													?>
												</td>
												<td class="text-left nowrap" style="text-align:left;">

													<?php
													foreach ($getResponsible as $key_res => $value_res) {
														if ($value_res['sales_status'] == "1") {
															if ($value_res['total_sales'] != 0) {
																echo "<span style=\"font-weight: 700;\">M : </span>";
																echo $value_res['commission_percent'] . "% <br>";
															} else {
																echo "<span style=\"font-weight: 700;\"> </span><br>";
															}
														} elseif ($value_res['sales_status'] == "2") {
															if ($value_res['total_sales'] != 0) {
																echo "<span style=\"font-weight: 700;\">R : </span>";
																echo $value_res['commission_percent'] . "% <br>";
															} else {
																echo "<span style=\"font-weight: 700;\"> </span><br>";
															}
														}
													}
													?>
												</td>
												<td class="text-left nowrap" style="text-align:left;">
													<?php
													foreach ($getResponsible as $key_res => $value_res) {

														if ($value_res['sales_status'] == "1") {
															if ($value_res['total_sales'] != 0) {
																echo "<span style=\"font-weight: 700;\">M : </span>";
																echo "$ " . number_format($value_res['commission'], 2) . " " . $value_res['currency'] . "<br>";
															} else {
																echo "<span style=\"font-weight: 700;\"> </span><br>";
															}
														} elseif ($value_res['sales_status'] == "2") {
															if ($value_res['total_sales'] != 0) {
																echo "<span style=\"font-weight: 700;\">R : </span>";
																echo "$ " . number_format($value_res['commission'], 2) . " " . $value_res['currency'] . "<br>";
															} else {
																echo "<span style=\"font-weight: 700;\"> </span><br>";
															}
														}
													}
													?>
												</td>
												<td class="text-left nowrap" style="text-align:left;">
													<?php
													foreach ($getResponsible as $key_res => $value_res) {
														if ($value_res['sales_status'] != "3") {
															if ($value_res['invoice_status'] == "Paid") {

																if ($value_res['commisson_payment_status'] == "Paid") {

																	if ($value_res['sales_status'] == "1") {

																		echo "<span style=\"font-weight: 700;\">M : </span>";
																		$balance_invoice = $value_res['commission'] - $value_res['pay_for_sales'];

																		if ($balance_invoice != 0) {
																			echo "<span style=\"color:red\">$ " . number_format($balance_invoice, 2) . " " . $value_res['currency'] . "</span><br>";
																		} else {
																			echo "<span>$ " . number_format($balance_invoice, 2) . " " . $value_res['currency'] . "</span><br>";
																		}
																	} elseif ($value_res['sales_status'] == "2") {

																		echo "<span style=\"font-weight: 700;\">R : </span>";

																		$balance_invoice = $value_res['commission'] - $value_res['pay_for_sales'];

																		if ($balance_invoice != 0) {
																			echo "<span style=\"color:red\">$ " . number_format($balance_invoice, 2) . " " . $value_res['currency'] . "</span><br>";
																		} else {
																			echo "<span>$ " . number_format($balance_invoice, 2) . " " . $value_res['currency'] . "</span><br>";
																		}
																	}
																} else {
																	if ($value_res['total_sales'] != 0) {
																		if ($value_res['sales_status'] == "1") {
																			echo "<span style=\"font-weight: 700;\">M : </span>";

																			if ($value_res['commission'] != 0) {
																				echo "<span style=\"color:red\">$ " . number_format($value_res['commission'], 2) . " " . $value_res['currency'] . "</span><br>";
																			} else {
																				echo "<span>$ " . number_format($value_res['commission'], 2) . " " . $value_res['currency'] . "</span><br>";
																			}
																		} elseif ($value_res['sales_status'] == "2") {
																			echo "<span style=\"font-weight: 700;\">R : </span>";

																			if ($value_res['commission'] != 0) {
																				echo "<span style=\"color:red\">$ " . number_format($value_res['commission'], 2) . " " . $value_res['currency'] . "</span><br>";
																			} else {
																				echo "<span>$ " . number_format($value_res['commission'], 2) . " " . $value_res['currency'] . "</span><br>";
																			}
																		}
																	}
																}
															}
														}
													}
													?>
												</td>


												<td class="text-left nowrap" style="text-align:left;">
													<?php
													foreach ($getResponsible as $key_res => $value_res) {
														if ($value_res['sales_status'] != "3") {
															if ($value_res['sales_status'] == "1") {

																echo "<span style=\"font-weight: 700;\">M : </span>";

																if ($value_res['commisson_payment_status'] == "Outstanding") {
																	echo "<span style=\"color:red\">" . $value_res['commisson_payment_status'] . "</span><br>";
																} else {
																	echo "<span> " . $value_res['commisson_payment_status'] . "</span><br>";
																}
															} elseif ($value_res['sales_status'] == "2") {

																echo "<span style=\"font-weight: 700;\">R : </span>";

																if ($value_res['commisson_payment_status'] == "Outstanding") {
																	echo "<span style=\"color:red\">" . $value_res['commisson_payment_status'] . "</span><br>";
																} else {
																	echo "<span> " . $value_res['commisson_payment_status'] . "</span><br>";
																}
															}
														}
													}
													?>
												</td>
												<td class="text-left nowrap" style="text-align:left;">
													<?php
													foreach ($getResponsible as $key_res => $value_res) {
														if ($value_res['sales_status'] != "3") {
															if ($value_res['commisson_payment_status'] == "Paid") {

																if ($value_res['sales_status'] == "1") {
																	echo "<span style=\"font-weight: 700;\">M : </span>";

																	echo "<span > $ " . number_format($value_res['pay_for_sales'], 2) . " " . $value_res['currency'] . "</span><br>";
																	if ($value_res['date_for_sales'] != "0000-00-00") {
																		$_month_name_comm = array(
																			"01" => "Jan.",
																			"02" => "Feb.",
																			"03" => "Mar.",
																			"04" => "Apr.",
																			"05" => "May.",
																			"06" => "Jun.",
																			"07" => "Jul.",
																			"08" => "Aug.",
																			"09" => "Sep.",
																			"10" => "Oct.",
																			"11" => "Nov.",
																			"12" => "Dec."
																		);

																		$commissiondate = $value_res['date_for_sales'];

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
																} elseif ($value_res['sales_status'] == "2") {
																	echo "<span style=\"font-weight: 700;\">R : </span>";

																	echo "<span > $ " . number_format($value_res['pay_for_sales'], 2) . " " . $value_res['currency'] . "</span><br>";

																	if ($value_res['date_for_sales'] != "0000-00-00") {
																		$_month_name_comm = array(
																			"01" => "Jan.",
																			"02" => "Feb.",
																			"03" => "Mar.",
																			"04" => "Apr.",
																			"05" => "May.",
																			"06" => "Jun.",
																			"07" => "Jul.",
																			"08" => "Aug.",
																			"09" => "Sep.",
																			"10" => "Oct.",
																			"11" => "Nov.",
																			"12" => "Dec."
																		);

																		$commissiondate = $value_res['date_for_sales'];

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
															}
														}
													}
													?>
												</td>
												<td class="text-left " style="word-wrap:break-word;text-align:left;">
													<?php
													foreach ($getResponsible as $key_res => $value_res) {
														if ($value_res['sales_status'] != "3") {

															$comments = Yii::app()->db->createCommand()
																->select('*')
																->from('comments com')
																->where('com.invoice = "' . $value_res['id'] . '"')
																->order('com.date_comments DESC')
																->limit('1')
																->queryAll();

															foreach ($comments as $key_co => $value_co) {
																if ($value_res['sales_status'] == "1") {
																	echo "<span style=\"font-weight: 700;\">(M) </span>";

																	if ($value_co['user_group'] == "1") {
																		echo "JOG : ";
																	} elseif ($value_co['user_group'] == "2") {
																	}
																	echo nl2br($value_co['comments']) . "<br>";
																} elseif ($value_res['sales_status'] == "2") {
																	echo "<span style=\"font-weight: 700;\">(R) </span>";

																	if ($value_co['user_group'] == "1") {
																		echo "JOG : ";
																	} elseif ($value_co['user_group'] == "2") {
																	}
																	echo nl2br($value_co['comments']) . "<br>";
																}
															}
														}
													}
													?>
												</td>
												<td class="text-left nowrap" style="word-wrap:break-word;text-align:left;">
													<?php
													foreach ($getResponsible as $key_res => $value_res) {
														if ($value_res['sales_status'] != "3") {
															if ($value_res['sales_status'] == "1") {
																echo "<span style=\"font-weight: 700;\">M : </span>";

																if ($value_res['update_date'] != "0000-00-00") {
																	$_month_name = array("01" => "Jan.", "02" => "Feb.", "03" => "Mar.", "04" => "Apr.", "05" => "May.", "06" => "Jun.", "07" => "Jul.", "08" => "Aug.", "09" => "Sep.", "10" => "Oct.", "11" => "Nov.", "12" => "Dec.");

																	list($year, $momth, $day) = explode("-", $value_res['update_date']);

																	if ($day < 10) {
																		$day = substr($day, 1, 2);
																	}

																	$date = $_month_name[$momth] . " " . $day . ",  " . $year;
													?>
																	<span style="font-size:12px;"><?php echo $date; ?></span><br>
																<?php
																} else {
																	$date = " ";
																?>
																	<span style="font-size:12px;"><?php echo $date; ?></span><br>
																<?php
																}
															} elseif ($value_res['sales_status'] == "2") {
																echo "<span style=\"font-weight: 700;\">R : </span>";

																if ($value_res['update_date'] != "0000-00-00") {
																	$_month_name = array("01" => "Jan.", "02" => "Feb.", "03" => "Mar.", "04" => "Apr.", "05" => "May.", "06" => "Jun.", "07" => "Jul.", "08" => "Aug.", "09" => "Sep.", "10" => "Oct.", "11" => "Nov.", "12" => "Dec.");

																	list($year, $momth, $day) = explode("-", $value_res['update_date']);

																	if ($day < 10) {
																		$day = substr($day, 1, 2);
																	}

																	$date = $_month_name[$momth] . " " . $day . ",  " . $year;
																?>
																	<span style="font-size:12px;"><?php echo $date; ?></span><br>
																<?php
																} else {
																	$date = " ";
																?>
																	<span style="font-size:12px;"><?php echo $date; ?></span><br>
																<?php
																}
															} else {
																echo "<span style=\"font-weight: 700;\">P : </span>";

																if ($value_res['update_date'] != "0000-00-00") {
																	$_month_name = array("01" => "Jan.", "02" => "Feb.", "03" => "Mar.", "04" => "Apr.", "05" => "May.", "06" => "Jun.", "07" => "Jul.", "08" => "Aug.", "09" => "Sep.", "10" => "Oct.", "11" => "Nov.", "12" => "Dec.");

																	list($year, $momth, $day) = explode("-", $value_res['update_date']);

																	if ($day < 10) {
																		$day = substr($day, 1, 2);
																	}

																	$date = $_month_name[$momth] . " " . $day . ",  " . $year;
																?>
																	<span style="font-size:12px;"><?php echo $date; ?></span><br>
																<?php
																} else {
																	$date = " ";
																?>
																	<span style="font-size:12px;"><?php echo $date; ?></span><br>
													<?php
																}
															}
														}
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
					?>
					<?php if ($curr == "CAD") { ?>
						<div style="margin-bottom:10px;">
							<a href="<?php echo Yii::app()->baseUrl; ?>/pdf/invioceCAD/year/<?php echo $year_commission; ?>" class="paf_dowload" target="_blank"> PDF (CAD)</a>
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
									<col style="width:200px;">
									<col style="width:180px;">
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
										<th colspan="" class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Sales Responsible </th>
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
										<th class="bg-blue-light text-center nowrap"> Order Name <br><span style="color:#fd6262;font-size:11px;">** Click Order Name ** <br> for Commission <br>Calculator </span></th>
										<th class="bg-blue-light text-center"> Date/Quarter </th>

										<th class="bg-blue-light text-center"> Invoice Status</th>
										<th class="bg-blue-light text-center"> Amount Received</th>

										<th class="bg-blue-light text-center"> Sales Responsible </th>

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
													<button class="btn btn-danger confirm" del-id="<?php echo $value['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/calculator/deleteInvoiceAll">
														<i class="fa fa-close"></i>
													</button>
												</td>

												<td class="text-left nowrap" style="vertical-align: middle;text-align:left;">
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
												<td class="text-left nowrap" style="vertical-align: middle;text-align:left;">
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
															<i class="fa fa-square" aria-hidden="true" style="color:green;display: initial;"></i>&nbsp;
														<?php
														} elseif ($value['invoice_status'] == "Outstanding") { ?>

															<i class="fa fa-square" aria-hidden="true" style="color:red;display: initial;"></i>&nbsp;
														<?php }	?>
													</div>
													<div class="col-md-10" style="vertical-align: middle;"><?php echo nl2br($value['order_name']); ?></div>
												</td>
												<?php
												$_month_name = array(
													"01" => "Jan.",
													"02" => "Feb.",
													"03" => "Mar.",
													"04" => "Apr.",
													"05" => "May.",
													"06" => "Jun.",
													"07" => "Jul.",
													"08" => "Aug.",
													"09" => "Sep.",
													"10" => "Oct.",
													"11" => "Nov.",
													"12" => "Dec."
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
												<td class="text-center nowrap" style="vertical-align: middle;"> <?php echo $date . "/<br>" . $quarter; ?> </td>
												<td class="text-center nowrap" style="vertical-align: middle;">
													<?php
													if ($value['invoice_status'] == "Outstanding") {
														echo "<span style=\"color:red\">" . $value['invoice_status'] . "</span>";
													} else {
														echo "<span> " . $value['invoice_status'] . "</span>";
													}
													?>

												</td>

												<td class="text-center nowrap" style="vertical-align: middle;text-align:left;">
													<?php
													if ($value['invoice_status'] == "Paid") {
														if ($value['invoice_amount_received'] != 0) {
															echo "<span > $ " . number_format($value['invoice_amount_received'], 2) . " " . $value['currency'] . "</span><br>";
															if ($value['invoice_date'] != "0000-00-00") {
																$_month_name_int = array(
																	"01" => "Jan.",
																	"02" => "Feb.",
																	"03" => "Mar.",
																	"04" => "Apr.",
																	"05" => "May.",
																	"06" => "Jun.",
																	"07" => "Jul.",
																	"08" => "Aug.",
																	"09" => "Sep.",
																	"10" => "Oct.",
																	"11" => "Nov.",
																	"12" => "Dec."
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
													}
													?>

												</td>
												<td class="text-left nowrap" style="text-align:left;">
													<?php
													if (!empty($commission_status)) {
														$getResponsible = Yii::app()->db->createCommand()
															->select('*')
															->from('calculator c')
															->where('c.invoice = "' . $value['invoice'] . '"')
															->andwhere('c.commisson_payment_status = "' . $commission_status . '"')
															->order('c.sales_status ASC')
															->queryAll();
													} else {
														$getResponsible = Yii::app()->db->createCommand()
															->select('*')
															->from('calculator c')
															->where('c.invoice = "' . $value['invoice'] . '"')
															->order('c.sales_status ASC')
															->queryAll();
													}


													foreach ($getResponsible as $key_res => $value_res) {

														if ($value_res['sales_status'] == "1") { ?>
															<div class="sales_Responsible_manager">

																<button class="btn btn-success" data-toggle="modal" data-target="#editDataMan" data-id="<?php echo $value_res['id']; ?>" style="padding: 0px 3px;font-size: 8px;margin-bottom: 0px;">
																	<i class="fa fa-pencil"></i>
																</button>

																<button class="btn btn-danger confirm" del-id="<?php echo $value_res['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/calculator/deleteInvoiceSeparateSales" style="padding: 0px 3px;font-size: 8px;margin-bottom: 0px;">
																	<i class="fa fa-close"></i>
																</button>

																<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/InvoiceDetail/year/<?php echo $year_commission; ?>/id/<?php echo $value_res['id']; ?>"><?php echo "<span style=\"font-weight: 700;\">M : </span>"; ?><?php echo $value_res['sales_manager'];  ?></a><br>
															</div>

														<?php } elseif ($value_res['sales_status'] == "2") { ?>
															<div class="sales_Responsible_salesrep">
																<button class="btn btn-success" data-toggle="modal" data-target="#editDataRep" data-id="<?php echo $value_res['id']; ?>" style="padding: 0px 3px;font-size: 8px;margin-bottom: 0px;">
																	<i class="fa fa-pencil"></i>
																</button>

																<button class="btn btn-danger confirm" del-id="<?php echo $value_res['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/calculator/deleteInvoiceSeparateSales" style="padding: 0px 3px;font-size: 8px;margin-bottom: 0px;">
																	<i class="fa fa-close"></i>
																</button>

																<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/InvoiceDetail/year/<?php echo $year_commission; ?>/id/<?php echo $value_res['id']; ?>"><?php echo "<span style=\"font-weight: 700;\">R : </span>"; ?>
																	<?php echo $value_res['sales_manager'];  ?></a><br>
															</div>
														<?php } elseif ($value_res['sales_status'] == "3") { ?>
															<div class="sales_Responsible_processor">
																<button class="btn btn-success" data-toggle="modal" data-target="#editDataProcessor" data-id="<?php echo $value_res['id']; ?>" style="padding: 0px 3px;font-size: 8px;margin-bottom: 0px;">
																	<i class="fa fa-pencil"></i>
																</button>

																<button class="btn btn-danger confirm" del-id="<?php echo $value_res['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/calculator/deleteInvoiceSeparateSales" style="padding: 0px 3px;font-size: 8px;margin-bottom: 0px;">
																	<i class="fa fa-close"></i>
																</button>

																<?php echo "<span style=\"font-weight: 700;\">P : </span>"; ?>
																<?php echo $value_res['sales_manager'] . "<br>";  ?>
															</div>
														<?php }
													}
													if (sizeof($getResponsible) != 3) { ?>
														<div class="sales_Responsible_sales">

															<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#addDataMan" data-id="<?php echo $value['invoice']; ?>" style="padding: 0px 3px;font-size: 10px;margin-bottom: 0px;"><i class="fa fa-plus"></i> Add</a>

														</div>
													<?php	} ?>
												</td>

												<td class="text-left nowrap" style="text-align:left;">
													<?php

													foreach ($getResponsible as $key_res => $value_res) {

														$totalsale = ((($value_res['total_sales'] - $value_res['shipping_cost']) - $value_res['creditcard_feecost']) - $value_res['comp_itemcost']);
														if ($value_res['sales_status'] == "1") {
															if ($value_res['total_sales'] != 0) {
																if ($value_res['status_commission'] == "Approved") { ?>
																	<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
																<?php
																} elseif ($value_res['status_commission'] == "Not Approved") { ?>
																	<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
																<?php 				} else {	?>
																	<i class="fa fa-square" aria-hidden="true" style="color:#e68c00"></i>&nbsp;
																<?php 				}

																echo "<span style=\"font-weight: 700;\">M : </span>";
																echo "$ " . number_format($totalsale, 2) . " " . $value_res['currency'] . "<br>";
															} else {
																echo "<span style=\"font-weight: 700;\"> </span><br>";
															}
														} elseif ($value_res['sales_status'] == "2") {
															if ($value_res['total_sales'] != 0) {
																if ($value_res['status_commission'] == "Approved") { ?>
																	<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
																<?php
																} elseif ($value_res['status_commission'] == "Not Approved") { ?>

																	<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
																<?php 				} else {	?>
																	<i class="fa fa-square" aria-hidden="true" style="color:#e68c00"></i>&nbsp;
													<?php }
																echo "<span style=\"font-weight: 700;\">R : </span>";
																echo "$ " . number_format($totalsale, 2) . " " . $value_res['currency'] . "<br>";
															} else {
																echo "<span style=\"font-weight: 700;\"> </span><br>";
															}
														}
													}

													?>
												</td>
												<td class="text-left nowrap" style="text-align:left;">

													<?php
													foreach ($getResponsible as $key_res => $value_res) {
														if ($value_res['sales_status'] == "1") {
															if ($value_res['total_sales'] != 0) {
																echo "<span style=\"font-weight: 700;\">M : </span>";
																echo $value_res['commission_percent'] . "% <br>";
															} else {
																echo "<span style=\"font-weight: 700;\"> </span><br>";
															}
														} elseif ($value_res['sales_status'] == "2") {
															if ($value_res['total_sales'] != 0) {
																echo "<span style=\"font-weight: 700;\">R : </span>";
																echo $value_res['commission_percent'] . "% <br>";
															} else {
																echo "<span style=\"font-weight: 700;\"> </span><br>";
															}
														}
													}
													?>
												</td>
												<td class="text-left nowrap" style="text-align:left;">
													<?php
													foreach ($getResponsible as $key_res => $value_res) {

														if ($value_res['sales_status'] == "1") {
															if ($value_res['total_sales'] != 0) {
																echo "<span style=\"font-weight: 700;\">M : </span>";
																echo "$ " . number_format($value_res['commission'], 2) . " " . $value_res['currency'] . "<br>";
															} else {
																echo "<span style=\"font-weight: 700;\"> </span><br>";
															}
														} elseif ($value_res['sales_status'] == "2") {
															if ($value_res['total_sales'] != 0) {
																echo "<span style=\"font-weight: 700;\">R : </span>";
																echo "$ " . number_format($value_res['commission'], 2) . " " . $value_res['currency'] . "<br>";
															} else {
																echo "<span style=\"font-weight: 700;\"> </span><br>";
															}
														}
													}
													?>
												</td>
												<td class="text-left nowrap" style="text-align:left;">
													<?php
													foreach ($getResponsible as $key_res => $value_res) {
														if ($value_res['sales_status'] != "3") {
															if ($value_res['invoice_status'] == "Paid") {

																if ($value_res['commisson_payment_status'] == "Paid") {

																	if ($value_res['sales_status'] == "1") {

																		echo "<span style=\"font-weight: 700;\">M : </span>";
																		$balance_invoice = $value_res['commission'] - $value_res['pay_for_sales'];

																		if ($balance_invoice != 0) {
																			echo "<span style=\"color:red\">$ " . number_format($balance_invoice, 2) . " " . $value_res['currency'] . "</span><br>";
																		} else {
																			echo "<span>$ " . number_format($balance_invoice, 2) . " " . $value_res['currency'] . "</span><br>";
																		}
																	} elseif ($value_res['sales_status'] == "2") {

																		echo "<span style=\"font-weight: 700;\">R : </span>";

																		$balance_invoice = $value_res['commission'] - $value_res['pay_for_sales'];

																		if ($balance_invoice != 0) {
																			echo "<span style=\"color:red\">$ " . number_format($balance_invoice, 2) . " " . $value_res['currency'] . "</span><br>";
																		} else {
																			echo "<span>$ " . number_format($balance_invoice, 2) . " " . $value_res['currency'] . "</span><br>";
																		}
																	}
																} else {
																	if ($totalsale != 0) {
																		if ($value_res['sales_status'] == "1") {
																			echo "<span style=\"font-weight: 700;\">M : </span>";

																			if ($value_res['commission'] != 0) {
																				echo "<span style=\"color:red\">$ " . number_format($value_res['commission'], 2) . " " . $value_res['currency'] . "</span><br>";
																			} else {
																				echo "<span>$ " . number_format($value_res['commission'], 2) . " " . $value_res['currency'] . "</span><br>";
																			}
																		} elseif ($value_res['sales_status'] == "2") {
																			echo "<span style=\"font-weight: 700;\">R : </span>";

																			if ($value_res['commission'] != 0) {
																				echo "<span style=\"color:red\">$ " . number_format($value_res['commission'], 2) . " " . $value_res['currency'] . "</span><br>";
																			} else {
																				echo "<span>$ " . number_format($value_res['commission'], 2) . " " . $value_res['currency'] . "</span><br>";
																			}
																		}
																	}
																}
															}
														}
													}
													?>
												</td>


												<td class="text-left nowrap" style="text-align:left;">
													<?php
													foreach ($getResponsible as $key_res => $value_res) {
														if ($value_res['sales_status'] != "3") {
															if ($value_res['sales_status'] == "1") {

																echo "<span style=\"font-weight: 700;\">M : </span>";

																if ($value_res['commisson_payment_status'] == "Outstanding") {
																	echo "<span style=\"color:red\">" . $value_res['commisson_payment_status'] . "</span><br>";
																} else {
																	echo "<span> " . $value_res['commisson_payment_status'] . "</span><br>";
																}
															} elseif ($value_res['sales_status'] == "2") {

																echo "<span style=\"font-weight: 700;\">R : </span>";

																if ($value_res['commisson_payment_status'] == "Outstanding") {
																	echo "<span style=\"color:red\">" . $value_res['commisson_payment_status'] . "</span><br>";
																} else {
																	echo "<span> " . $value_res['commisson_payment_status'] . "</span><br>";
																}
															}
														}
													}
													?>
												</td>
												<td class="text-left nowrap" style="text-align:left;">
													<?php
													foreach ($getResponsible as $key_res => $value_res) {
														if ($value_res['sales_status'] != "3") {
															if ($value_res['commisson_payment_status'] == "Paid") {

																if ($value_res['sales_status'] == "1") {
																	echo "<span style=\"font-weight: 700;\">M : </span>";

																	echo "<span > $ " . number_format($value_res['pay_for_sales'], 2) . " " . $value_res['currency'] . "</span><br>";
																	if ($value_res['date_for_sales'] != "0000-00-00") {
																		$_month_name_comm = array(
																			"01" => "Jan.",
																			"02" => "Feb.",
																			"03" => "Mar.",
																			"04" => "Apr.",
																			"05" => "May.",
																			"06" => "Jun.",
																			"07" => "Jul.",
																			"08" => "Aug.",
																			"09" => "Sep.",
																			"10" => "Oct.",
																			"11" => "Nov.",
																			"12" => "Dec."
																		);

																		$commissiondate = $value_res['date_for_sales'];

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
																} elseif ($value_res['sales_status'] == "2") {
																	echo "<span style=\"font-weight: 700;\">R : </span>";

																	echo "<span > $ " . number_format($value_res['pay_for_sales'], 2) . " " . $value_res['currency'] . "</span><br>";

																	if ($value_res['date_for_sales'] != "0000-00-00") {
																		$_month_name_comm = array(
																			"01" => "Jan.",
																			"02" => "Feb.",
																			"03" => "Mar.",
																			"04" => "Apr.",
																			"05" => "May.",
																			"06" => "Jun.",
																			"07" => "Jul.",
																			"08" => "Aug.",
																			"09" => "Sep.",
																			"10" => "Oct.",
																			"11" => "Nov.",
																			"12" => "Dec."
																		);

																		$commissiondate = $value_res['date_for_sales'];

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
															}
														}
													}
													?>
												</td>
												<td class="text-left " style="word-wrap:break-word;text-align:left;">
													<?php
													foreach ($getResponsible as $key_res => $value_res) {
														if ($value_res['sales_status'] != "3") {

															$comments = Yii::app()->db->createCommand()
																->select('*')
																->from('comments com')
																->where('com.invoice = "' . $value_res['id'] . '"')
																->order('com.date_comments DESC')
																->limit('1')
																->queryAll();

															foreach ($comments as $key_co => $value_co) {
																if ($value_res['sales_status'] == "1") {
																	echo "<span style=\"font-weight: 700;\">(M) </span>";

																	if ($value_co['user_group'] == "1") {
																		echo "JOG : ";
																	} elseif ($value_co['user_group'] == "2") {
																	}
																	echo nl2br($value_co['comments']) . "<br>";
																} elseif ($value_res['sales_status'] == "2") {
																	echo "<span style=\"font-weight: 700;\">(R) </span>";

																	if ($value_co['user_group'] == "1") {
																		echo "JOG : ";
																	} elseif ($value_co['user_group'] == "2") {
																	}
																	echo nl2br($value_co['comments']) . "<br>";
																}
															}
														}
													}
													?>
												</td>
												<td class="text-left nowrap" style="word-wrap:break-word;text-align:left;">
													<?php
													foreach ($getResponsible as $key_res => $value_res) {
														if ($value_res['sales_status'] != "3") {
															if ($value_res['sales_status'] == "1") {
																echo "<span style=\"font-weight: 700;\">M : </span>";

																if ($value_res['update_date'] != "0000-00-00") {
																	$_month_name = array("01" => "Jan.", "02" => "Feb.", "03" => "Mar.", "04" => "Apr.", "05" => "May.", "06" => "Jun.", "07" => "Jul.", "08" => "Aug.", "09" => "Sep.", "10" => "Oct.", "11" => "Nov.", "12" => "Dec.");

																	list($year, $momth, $day) = explode("-", $value_res['update_date']);

																	if ($day < 10) {
																		$day = substr($day, 1, 2);
																	}

																	$date = $_month_name[$momth] . " " . $day . ",  " . $year;
													?>
																	<span style="font-size:12px;"><?php echo $date; ?></span><br>
																<?php
																} else {
																	$date = " ";
																?>
																	<span style="font-size:12px;"><?php echo $date; ?></span><br>
																<?php
																}
															} elseif ($value_res['sales_status'] == "2") {
																echo "<span style=\"font-weight: 700;\">R : </span>";

																if ($value_res['update_date'] != "0000-00-00") {
																	$_month_name = array("01" => "Jan.", "02" => "Feb.", "03" => "Mar.", "04" => "Apr.", "05" => "May.", "06" => "Jun.", "07" => "Jul.", "08" => "Aug.", "09" => "Sep.", "10" => "Oct.", "11" => "Nov.", "12" => "Dec.");

																	list($year, $momth, $day) = explode("-", $value_res['update_date']);

																	if ($day < 10) {
																		$day = substr($day, 1, 2);
																	}

																	$date = $_month_name[$momth] . " " . $day . ",  " . $year;
																?>
																	<span style="font-size:12px;"><?php echo $date; ?></span><br>
																<?php
																} else {
																	$date = " ";
																?>
																	<span style="font-size:12px;"><?php echo $date; ?></span><br>
																<?php
																}
															} else {
																echo "<span style=\"font-weight: 700;\">P : </span>";

																if ($value_res['update_date'] != "0000-00-00") {
																	$_month_name = array("01" => "Jan.", "02" => "Feb.", "03" => "Mar.", "04" => "Apr.", "05" => "May.", "06" => "Jun.", "07" => "Jul.", "08" => "Aug.", "09" => "Sep.", "10" => "Oct.", "11" => "Nov.", "12" => "Dec.");

																	list($year, $momth, $day) = explode("-", $value_res['update_date']);

																	if ($day < 10) {
																		$day = substr($day, 1, 2);
																	}

																	$date = $_month_name[$momth] . " " . $day . ",  " . $year;
																?>
																	<span style="font-size:12px;"><?php echo $date; ?></span><br>
																<?php
																} else {
																	$date = " ";
																?>
																	<span style="font-size:12px;"><?php echo $date; ?></span><br>
													<?php
																}
															}
														}
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
											<td></td>
											<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
												<span><?php echo "$ " . number_format($sumCommissionPaymaentCAD, 2) . " CAD"; ?> </span>
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
					?>
					<?php if ($curr == "SGD") { ?>
						<div style="margin-bottom:10px;">
							<a href="<?php echo Yii::app()->baseUrl; ?>/pdf/invioceSGD/year/<?php echo $year_commission; ?>" class="paf_dowload" target="_blank"> PDF (SGD)</a>
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
									<col style="width:200px;">
									<col style="width:180px;">
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
										<th colspan="" class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Sales Responsible </th>
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
										<th class="bg-blue-light text-center nowrap"> Order Name <br><span style="color:#fd6262;font-size:11px;">** Click Order Name ** <br> for Commission <br>Calculator </span></th>
										<th class="bg-blue-light text-center"> Date/Quarter </th>

										<th class="bg-blue-light text-center"> Invoice Status</th>
										<th class="bg-blue-light text-center"> Amount Received</th>

										<th class="bg-blue-light text-center"> Sales Responsible </th>

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
													<button class="btn btn-danger confirm" del-id="<?php echo $value['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/calculator/deleteInvoiceAll">
														<i class="fa fa-close"></i>
													</button>
												</td>

												<td class="text-left nowrap" style="vertical-align: middle;text-align:left;">
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
												<td class="text-left nowrap" style="vertical-align: middle;text-align:left;">
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
															<i class="fa fa-square" aria-hidden="true" style="color:green;display: initial;"></i>&nbsp;
														<?php
														} elseif ($value['invoice_status'] == "Outstanding") { ?>

															<i class="fa fa-square" aria-hidden="true" style="color:red;display: initial;"></i>&nbsp;
														<?php }	?>
													</div>
													<div class="col-md-10" style="vertical-align: middle;"><?php echo nl2br($value['order_name']); ?></div>
												</td>
												<?php
												$_month_name = array(
													"01" => "Jan.",
													"02" => "Feb.",
													"03" => "Mar.",
													"04" => "Apr.",
													"05" => "May.",
													"06" => "Jun.",
													"07" => "Jul.",
													"08" => "Aug.",
													"09" => "Sep.",
													"10" => "Oct.",
													"11" => "Nov.",
													"12" => "Dec."
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
												<td class="text-center nowrap" style="vertical-align: middle;"> <?php echo $date . "/<br>" . $quarter; ?> </td>
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
														if ($value['invoice_amount_received'] != 0) {
															echo "<span > $ " . number_format($value['invoice_amount_received'], 2) . " " . $value['currency'] . "</span><br>";
															if ($value['invoice_date'] != "0000-00-00") {
																$_month_name_int = array(
																	"01" => "Jan.",
																	"02" => "Feb.",
																	"03" => "Mar.",
																	"04" => "Apr.",
																	"05" => "May.",
																	"06" => "Jun.",
																	"07" => "Jul.",
																	"08" => "Aug.",
																	"09" => "Sep.",
																	"10" => "Oct.",
																	"11" => "Nov.",
																	"12" => "Dec."
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
													}
													?>

												</td>
												<td class="text-left nowrap" style="text-align:left;">
													<?php
													if (!empty($commission_status)) {
														$getResponsible = Yii::app()->db->createCommand()
															->select('*')
															->from('calculator c')
															->where('c.invoice = "' . $value['invoice'] . '"')
															->andwhere('c.commisson_payment_status = "' . $commission_status . '"')
															->order('c.sales_status ASC')
															->queryAll();
													} else {
														$getResponsible = Yii::app()->db->createCommand()
															->select('*')
															->from('calculator c')
															->where('c.invoice = "' . $value['invoice'] . '"')
															->order('c.sales_status ASC')
															->queryAll();
													}


													foreach ($getResponsible as $key_res => $value_res) {

														if ($value_res['sales_status'] == "1") { ?>
															<div class="sales_Responsible_manager">

																<button class="btn btn-success" data-toggle="modal" data-target="#editDataMan" data-id="<?php echo $value_res['id']; ?>" style="padding: 0px 3px;font-size: 8px;margin-bottom: 0px;">
																	<i class="fa fa-pencil"></i>
																</button>

																<button class="btn btn-danger confirm" del-id="<?php echo $value_res['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/calculator/deleteInvoiceSeparateSales" style="padding: 0px 3px;font-size: 8px;margin-bottom: 0px;">
																	<i class="fa fa-close"></i>
																</button>

																<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/InvoiceDetail/year/<?php echo $year_commission; ?>/id/<?php echo $value_res['id']; ?>"><?php echo "<span style=\"font-weight: 700;\">M : </span>"; ?><?php echo $value_res['sales_manager'];  ?></a><br>
															</div>

														<?php } elseif ($value_res['sales_status'] == "2") { ?>
															<div class="sales_Responsible_salesrep">
																<button class="btn btn-success" data-toggle="modal" data-target="#editDataRep" data-id="<?php echo $value_res['id']; ?>" style="padding: 0px 3px;font-size: 8px;margin-bottom: 0px;">
																	<i class="fa fa-pencil"></i>
																</button>

																<button class="btn btn-danger confirm" del-id="<?php echo $value_res['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/calculator/deleteInvoiceSeparateSales" style="padding: 0px 3px;font-size: 8px;margin-bottom: 0px;">
																	<i class="fa fa-close"></i>
																</button>

																<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/InvoiceDetail/year/<?php echo $year_commission; ?>/id/<?php echo $value_res['id']; ?>"><?php echo "<span style=\"font-weight: 700;\">R : </span>"; ?>
																	<?php echo $value_res['sales_manager'];  ?></a><br>
															</div>
														<?php } elseif ($value_res['sales_status'] == "3") { ?>
															<div class="sales_Responsible_processor">
																<button class="btn btn-success" data-toggle="modal" data-target="#editDataProcessor" data-id="<?php echo $value_res['id']; ?>" style="padding: 0px 3px;font-size: 8px;margin-bottom: 0px;">
																	<i class="fa fa-pencil"></i>
																</button>

																<button class="btn btn-danger confirm" del-id="<?php echo $value_res['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/calculator/deleteInvoiceSeparateSales" style="padding: 0px 3px;font-size: 8px;margin-bottom: 0px;">
																	<i class="fa fa-close"></i>
																</button>

																<?php echo "<span style=\"font-weight: 700;\">P : </span>"; ?>
																<?php echo $value_res['sales_manager'] . "<br>";  ?>
															</div>
														<?php }
													}
													if (sizeof($getResponsible) != 3) { ?>
														<div class="sales_Responsible_sales">

															<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#addDataMan" data-id="<?php echo $value['invoice']; ?>" style="padding: 0px 3px;font-size: 10px;margin-bottom: 0px;"><i class="fa fa-plus"></i> Add</a>

														</div>
													<?php	} ?>
												</td>

												<td class="text-left nowrap" style="text-align:left;">
													<?php

													foreach ($getResponsible as $key_res => $value_res) {

														$totalsale = ((($value_res['total_sales'] - $value_res['shipping_cost']) - $value_res['creditcard_feecost']) - $value_res['comp_itemcost']);
														if ($value_res['sales_status'] == "1") {
															if ($value_res['total_sales'] != 0) {
																if ($value_res['status_commission'] == "Approved") { ?>
																	<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
																<?php
																} elseif ($value_res['status_commission'] == "Not Approved") { ?>
																	<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
																<?php 				} else {	?>
																	<i class="fa fa-square" aria-hidden="true" style="color:#e68c00"></i>&nbsp;
																<?php 				}

																echo "<span style=\"font-weight: 700;\">M : </span>";
																echo "$ " . number_format($totalsale, 2) . " " . $value_res['currency'] . "<br>";
															} else {
																echo "<span style=\"font-weight: 700;\"> </span><br>";
															}
														} elseif ($value_res['sales_status'] == "2") {
															if ($value_res['total_sales'] != 0) {
																if ($value_res['status_commission'] == "Approved") { ?>
																	<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
																<?php
																} elseif ($value_res['status_commission'] == "Not Approved") { ?>

																	<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
																<?php 				} else {	?>
																	<i class="fa fa-square" aria-hidden="true" style="color:#e68c00"></i>&nbsp;
													<?php }
																echo "<span style=\"font-weight: 700;\">R : </span>";
																echo "$ " . number_format($totalsale, 2) . " " . $value_res['currency'] . "<br>";
															} else {
																echo "<span style=\"font-weight: 700;\"> </span><br>";
															}
														}
													}

													?>
												</td>
												<td class="text-left nowrap" style="text-align:left;">

													<?php
													foreach ($getResponsible as $key_res => $value_res) {
														if ($value_res['sales_status'] == "1") {
															if ($value_res['total_sales'] != 0) {
																echo "<span style=\"font-weight: 700;\">M : </span>";
																echo $value_res['commission_percent'] . "% <br>";
															} else {
																echo "<span style=\"font-weight: 700;\"> </span><br>";
															}
														} elseif ($value_res['sales_status'] == "2") {
															if ($value_res['total_sales'] != 0) {
																echo "<span style=\"font-weight: 700;\">R : </span>";
																echo $value_res['commission_percent'] . "% <br>";
															} else {
																echo "<span style=\"font-weight: 700;\"> </span><br>";
															}
														}
													}
													?>
												</td>
												<td class="text-left nowrap" style="text-align:left;">
													<?php
													foreach ($getResponsible as $key_res => $value_res) {

														if ($value_res['sales_status'] == "1") {
															if ($value_res['total_sales'] != 0) {
																echo "<span style=\"font-weight: 700;\">M : </span>";
																echo "$ " . number_format($value_res['commission'], 2) . " " . $value_res['currency'] . "<br>";
															} else {
																echo "<span style=\"font-weight: 700;\"> </span><br>";
															}
														} elseif ($value_res['sales_status'] == "2") {
															if ($value_res['total_sales'] != 0) {
																echo "<span style=\"font-weight: 700;\">R : </span>";
																echo "$ " . number_format($value_res['commission'], 2) . " " . $value_res['currency'] . "<br>";
															} else {
																echo "<span style=\"font-weight: 700;\"> </span><br>";
															}
														}
													}
													?>
												</td>
												<td class="text-left nowrap" style="text-align:left;">
													<?php
													foreach ($getResponsible as $key_res => $value_res) {
														if ($value_res['sales_status'] != "3") {
															if ($value_res['invoice_status'] == "Paid") {

																if ($value_res['commisson_payment_status'] == "Paid") {

																	if ($value_res['sales_status'] == "1") {

																		echo "<span style=\"font-weight: 700;\">M : </span>";
																		$balance_invoice = $value_res['commission'] - $value_res['pay_for_sales'];

																		if ($balance_invoice != 0) {
																			echo "<span style=\"color:red\">$ " . number_format($balance_invoice, 2) . " " . $value_res['currency'] . "</span><br>";
																		} else {
																			echo "<span>$ " . number_format($balance_invoice, 2) . " " . $value_res['currency'] . "</span><br>";
																		}
																	} elseif ($value_res['sales_status'] == "2") {

																		echo "<span style=\"font-weight: 700;\">R : </span>";

																		$balance_invoice = $value_res['commission'] - $value_res['pay_for_sales'];

																		if ($balance_invoice != 0) {
																			echo "<span style=\"color:red\">$ " . number_format($balance_invoice, 2) . " " . $value_res['currency'] . "</span><br>";
																		} else {
																			echo "<span>$ " . number_format($balance_invoice, 2) . " " . $value_res['currency'] . "</span><br>";
																		}
																	}
																} else {
																	if ($totalsale != 0) {
																		if ($value_res['sales_status'] == "1") {
																			echo "<span style=\"font-weight: 700;\">M : </span>";

																			if ($value_res['commission'] != 0) {
																				echo "<span style=\"color:red\">$ " . number_format($value_res['commission'], 2) . " " . $value_res['currency'] . "</span><br>";
																			} else {
																				echo "<span>$ " . number_format($value_res['commission'], 2) . " " . $value_res['currency'] . "</span><br>";
																			}
																		} elseif ($value_res['sales_status'] == "2") {
																			echo "<span style=\"font-weight: 700;\">R : </span>";

																			if ($value_res['commission'] != 0) {
																				echo "<span style=\"color:red\">$ " . number_format($value_res['commission'], 2) . " " . $value_res['currency'] . "</span><br>";
																			} else {
																				echo "<span>$ " . number_format($value_res['commission'], 2) . " " . $value_res['currency'] . "</span><br>";
																			}
																		}
																	}
																}
															}
														}
													}
													?>
												</td>


												<td class="text-left nowrap" style="text-align:left;">
													<?php
													foreach ($getResponsible as $key_res => $value_res) {
														if ($value_res['sales_status'] != "3") {
															if ($value_res['sales_status'] == "1") {

																echo "<span style=\"font-weight: 700;\">M : </span>";

																if ($value_res['commisson_payment_status'] == "Outstanding") {
																	echo "<span style=\"color:red\">" . $value_res['commisson_payment_status'] . "</span><br>";
																} else {
																	echo "<span> " . $value_res['commisson_payment_status'] . "</span><br>";
																}
															} elseif ($value_res['sales_status'] == "2") {

																echo "<span style=\"font-weight: 700;\">R : </span>";

																if ($value_res['commisson_payment_status'] == "Outstanding") {
																	echo "<span style=\"color:red\">" . $value_res['commisson_payment_status'] . "</span><br>";
																} else {
																	echo "<span> " . $value_res['commisson_payment_status'] . "</span><br>";
																}
															}
														}
													}
													?>
												</td>
												<td class="text-left nowrap" style="text-align:left;">
													<?php
													foreach ($getResponsible as $key_res => $value_res) {
														if ($value_res['sales_status'] != "3") {
															if ($value_res['commisson_payment_status'] == "Paid") {

																if ($value_res['sales_status'] == "1") {
																	echo "<span style=\"font-weight: 700;\">M : </span>";

																	echo "<span > $ " . number_format($value_res['pay_for_sales'], 2) . " " . $value_res['currency'] . "</span><br>";
																	if ($value_res['date_for_sales'] != "0000-00-00") {
																		$_month_name_comm = array(
																			"01" => "Jan.",
																			"02" => "Feb.",
																			"03" => "Mar.",
																			"04" => "Apr.",
																			"05" => "May.",
																			"06" => "Jun.",
																			"07" => "Jul.",
																			"08" => "Aug.",
																			"09" => "Sep.",
																			"10" => "Oct.",
																			"11" => "Nov.",
																			"12" => "Dec."
																		);

																		$commissiondate = $value_res['date_for_sales'];

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
																} elseif ($value_res['sales_status'] == "2") {
																	echo "<span style=\"font-weight: 700;\">R : </span>";

																	echo "<span > $ " . number_format($value_res['pay_for_sales'], 2) . " " . $value_res['currency'] . "</span><br>";

																	if ($value_res['date_for_sales'] != "0000-00-00") {
																		$_month_name_comm = array(
																			"01" => "Jan.",
																			"02" => "Feb.",
																			"03" => "Mar.",
																			"04" => "Apr.",
																			"05" => "May.",
																			"06" => "Jun.",
																			"07" => "Jul.",
																			"08" => "Aug.",
																			"09" => "Sep.",
																			"10" => "Oct.",
																			"11" => "Nov.",
																			"12" => "Dec."
																		);

																		$commissiondate = $value_res['date_for_sales'];

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
															}
														}
													}
													?>
												</td>
												<td class="text-left " style="word-wrap:break-word;text-align:left;">
													<?php
													foreach ($getResponsible as $key_res => $value_res) {
														if ($value_res['sales_status'] != "3") {

															$comments = Yii::app()->db->createCommand()
																->select('*')
																->from('comments com')
																->where('com.invoice = "' . $value_res['id'] . '"')
																->order('com.date_comments DESC')
																->limit('1')
																->queryAll();

															foreach ($comments as $key_co => $value_co) {
																if ($value_res['sales_status'] == "1") {
																	echo "<span style=\"font-weight: 700;\">(M) </span>";

																	if ($value_co['user_group'] == "1") {
																		echo "JOG : ";
																	} elseif ($value_co['user_group'] == "2") {
																	}
																	echo nl2br($value_co['comments']) . "<br>";
																} elseif ($value_res['sales_status'] == "2") {
																	echo "<span style=\"font-weight: 700;\">(R) </span>";

																	if ($value_co['user_group'] == "1") {
																		echo "JOG : ";
																	} elseif ($value_co['user_group'] == "2") {
																	}
																	echo nl2br($value_co['comments']) . "<br>";
																}
															}
														}
													}
													?>
												</td>
												<td class="text-left nowrap" style="word-wrap:break-word;text-align:left;">
													<?php
													foreach ($getResponsible as $key_res => $value_res) {
														if ($value_res['sales_status'] != "3") {
															if ($value_res['sales_status'] == "1") {
																echo "<span style=\"font-weight: 700;\">M : </span>";

																if ($value_res['update_date'] != "0000-00-00") {
																	$_month_name = array("01" => "Jan.", "02" => "Feb.", "03" => "Mar.", "04" => "Apr.", "05" => "May.", "06" => "Jun.", "07" => "Jul.", "08" => "Aug.", "09" => "Sep.", "10" => "Oct.", "11" => "Nov.", "12" => "Dec.");

																	list($year, $momth, $day) = explode("-", $value_res['update_date']);

																	if ($day < 10) {
																		$day = substr($day, 1, 2);
																	}

																	$date = $_month_name[$momth] . " " . $day . ",  " . $year;
													?>
																	<span style="font-size:12px;"><?php echo $date; ?></span><br>
																<?php
																} else {
																	$date = " ";
																?>
																	<span style="font-size:12px;"><?php echo $date; ?></span><br>
																<?php
																}
															} elseif ($value_res['sales_status'] == "2") {
																echo "<span style=\"font-weight: 700;\">R : </span>";

																if ($value_res['update_date'] != "0000-00-00") {
																	$_month_name = array("01" => "Jan.", "02" => "Feb.", "03" => "Mar.", "04" => "Apr.", "05" => "May.", "06" => "Jun.", "07" => "Jul.", "08" => "Aug.", "09" => "Sep.", "10" => "Oct.", "11" => "Nov.", "12" => "Dec.");

																	list($year, $momth, $day) = explode("-", $value_res['update_date']);

																	if ($day < 10) {
																		$day = substr($day, 1, 2);
																	}

																	$date = $_month_name[$momth] . " " . $day . ",  " . $year;
																?>
																	<span style="font-size:12px;"><?php echo $date; ?></span><br>
																<?php
																} else {
																	$date = " ";
																?>
																	<span style="font-size:12px;"><?php echo $date; ?></span><br>
																<?php
																}
															} else {
																echo "<span style=\"font-weight: 700;\">P : </span>";

																if ($value_res['update_date'] != "0000-00-00") {
																	$_month_name = array("01" => "Jan.", "02" => "Feb.", "03" => "Mar.", "04" => "Apr.", "05" => "May.", "06" => "Jun.", "07" => "Jul.", "08" => "Aug.", "09" => "Sep.", "10" => "Oct.", "11" => "Nov.", "12" => "Dec.");

																	list($year, $momth, $day) = explode("-", $value_res['update_date']);

																	if ($day < 10) {
																		$day = substr($day, 1, 2);
																	}

																	$date = $_month_name[$momth] . " " . $day . ",  " . $year;
																?>
																	<span style="font-size:12px;"><?php echo $date; ?></span><br>
																<?php
																} else {
																	$date = " ";
																?>
																	<span style="font-size:12px;"><?php echo $date; ?></span><br>
													<?php
																}
															}
														}
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
												<?php if (!empty($sumCommissionPaymaentSGD)) { ?>
													<span><?php echo "$ " . number_format($sumCommissionPaymaentSGD, 2) . " SGD"; ?> </span>
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
					?>
					<?php if ($curr == "THB") { ?>
						<div style="margin-bottom:10px;">
							<a href="<?php echo Yii::app()->baseUrl; ?>/pdf/invioceTHB/year/<?php echo $year_commission; ?>" class="paf_dowload" target="_blank"> PDF (THB)</a>
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
									<col style="width:200px;">
									<col style="width:180px;">
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
										<th colspan="" class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Sales Responsible </th>
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
										<th class="bg-blue-light text-center nowrap"> Order Name <br><span style="color:#fd6262;font-size:11px;">** Click Order Name ** <br> for Commission <br>Calculator </span></th>
										<th class="bg-blue-light text-center"> Date/Quarter </th>

										<th class="bg-blue-light text-center"> Invoice Status</th>
										<th class="bg-blue-light text-center"> Amount Received</th>

										<th class="bg-blue-light text-center"> Sales Responsible </th>

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
													<button class="btn btn-danger confirm" del-id="<?php echo $value['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/calculator/deleteInvoiceAll">
														<i class="fa fa-close"></i>
													</button>
												</td>

												<td class="text-left nowrap" style="vertical-align: middle;text-align:left;">
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
												<td class="text-left nowrap" style="vertical-align: middle;text-align:left;">
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
															<i class="fa fa-square" aria-hidden="true" style="color:green;display: initial;"></i>&nbsp;
														<?php
														} elseif ($value['invoice_status'] == "Outstanding") { ?>

															<i class="fa fa-square" aria-hidden="true" style="color:red;display: initial;"></i>&nbsp;
														<?php }	?>
													</div>
													<div class="col-md-10" style="vertical-align: middle;"><?php echo nl2br($value['order_name']); ?></div>
												</td>
												<?php
												$_month_name = array(
													"01" => "Jan.",
													"02" => "Feb.",
													"03" => "Mar.",
													"04" => "Apr.",
													"05" => "May.",
													"06" => "Jun.",
													"07" => "Jul.",
													"08" => "Aug.",
													"09" => "Sep.",
													"10" => "Oct.",
													"11" => "Nov.",
													"12" => "Dec."
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
												<td class="text-center nowrap" style="vertical-align: middle;"> <?php echo $date . "/<br>" . $quarter; ?> </td>
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
														if ($value['invoice_amount_received'] != 0) {
															echo "<span > ฿ " . number_format($value['invoice_amount_received'], 2) . " " . $value['currency'] . "</span><br>";
															if ($value['invoice_date'] != "0000-00-00") {
																$_month_name_int = array(
																	"01" => "Jan.",
																	"02" => "Feb.",
																	"03" => "Mar.",
																	"04" => "Apr.",
																	"05" => "May.",
																	"06" => "Jun.",
																	"07" => "Jul.",
																	"08" => "Aug.",
																	"09" => "Sep.",
																	"10" => "Oct.",
																	"11" => "Nov.",
																	"12" => "Dec."
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
													}
													?>

												</td>
												<td class="text-left nowrap" style="text-align:left;">
													<?php
													if (!empty($commission_status)) {
														$getResponsible = Yii::app()->db->createCommand()
															->select('*')
															->from('calculator c')
															->where('c.invoice = "' . $value['invoice'] . '"')
															->andwhere('c.commisson_payment_status = "' . $commission_status . '"')
															->order('c.sales_status ASC')
															->queryAll();
													} else {
														$getResponsible = Yii::app()->db->createCommand()
															->select('*')
															->from('calculator c')
															->where('c.invoice = "' . $value['invoice'] . '"')
															->order('c.sales_status ASC')
															->queryAll();
													}


													foreach ($getResponsible as $key_res => $value_res) {

														if ($value_res['sales_status'] == "1") {
															$smanager = "1"; ?>
															<div class="sales_Responsible_manager">

																<button class="btn btn-success" data-toggle="modal" data-target="#editDataMan" data-id="<?php echo $value_res['id']; ?>" style="padding: 0px 3px;font-size: 8px;margin-bottom: 0px;">
																	<i class="fa fa-pencil"></i>
																</button>

																<button class="btn btn-danger confirm" del-id="<?php echo $value_res['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/calculator/deleteInvoiceSeparateSales" style="padding: 0px 3px;font-size: 8px;margin-bottom: 0px;">
																	<i class="fa fa-close"></i>
																</button>

																<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/InvoiceDetail/year/<?php echo $year_commission; ?>/id/<?php echo $value_res['id']; ?>"><?php echo "<span style=\"font-weight: 700;\">M : </span>"; ?><?php echo $value_res['sales_manager'];  ?></a><br>
															</div>

														<?php } elseif ($value_res['sales_status'] == "2") {
															$ssalesrep = "2"; ?>
															<div class="sales_Responsible_salesrep">
																<button class="btn btn-success" data-toggle="modal" data-target="#editDataRep" data-id="<?php echo $value_res['id']; ?>" style="padding: 0px 3px;font-size: 8px;margin-bottom: 0px;">
																	<i class="fa fa-pencil"></i>
																</button>

																<button class="btn btn-danger confirm" del-id="<?php echo $value_res['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/calculator/deleteInvoiceSeparateSales" style="padding: 0px 3px;font-size: 8px;margin-bottom: 0px;">
																	<i class="fa fa-close"></i>
																</button>

																<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/InvoiceDetail/year/<?php echo $year_commission; ?>/id/<?php echo $value_res['id']; ?>"><?php echo "<span style=\"font-weight: 700;\">R : </span>"; ?>
																	<?php echo $value_res['sales_manager'];  ?></a><br>
															</div>
														<?php } elseif ($value_res['sales_status'] == "3") {
															$sprocessor = "3"; ?>
															<div class="sales_Responsible_processor">
																<button class="btn btn-success" data-toggle="modal" data-target="#editDataProcessor" data-id="<?php echo $value_res['id']; ?>" style="padding: 0px 3px;font-size: 8px;margin-bottom: 0px;">
																	<i class="fa fa-pencil"></i>
																</button>

																<button class="btn btn-danger confirm" del-id="<?php echo $value_res['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/calculator/deleteInvoiceSeparateSales" style="padding: 0px 3px;font-size: 8px;margin-bottom: 0px;">
																	<i class="fa fa-close"></i>
																</button>

																<?php echo "<span style=\"font-weight: 700;\">P : </span>"; ?>
																<?php echo $value_res['sales_manager'] . "<br>";  ?>
															</div>
														<?php }
													}
													if (sizeof($getResponsible) != 3) {
														//	if(!empty($smanager) && empty($ssalesrep) && empty($sprocessor) ){
														?>
														<div class="sales_Responsible_sales">

															<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#addDataMan" data-id="<?php echo $value['invoice']; ?>" style="padding: 0px 3px;font-size: 10px;margin-bottom: 0px;"><i class="fa fa-plus"></i> Add</a>

														</div>
													<?php
														//	}elseif(!empty($smanager) && !empty($ssalesrep) && empty($sprocessor) ){

														//	}elseif(empty($smanager) && !empty($ssalesrep) && !empty($sprocessor) ){

														//}
													} ?>
												</td>

												<td class="text-left nowrap" style="text-align:left;">
													<?php

													foreach ($getResponsible as $key_res => $value_res) {

														$totalsale = ((($value_res['total_sales'] - $value_res['shipping_cost']) - $value_res['creditcard_feecost']) - $value_res['comp_itemcost']);
														if ($value_res['sales_status'] == "1") {
															if ($value_res['total_sales'] != 0) {
																if ($value_res['status_commission'] == "Approved") { ?>
																	<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
																<?php
																} elseif ($value_res['status_commission'] == "Not Approved") { ?>
																	<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
																<?php 				} else {	?>
																	<i class="fa fa-square" aria-hidden="true" style="color:#e68c00"></i>&nbsp;
																<?php 				}

																echo "<span style=\"font-weight: 700;\">M : </span>";
																echo "฿ " . number_format($totalsale, 2) . " " . $value_res['currency'] . "<br>";
															} else {
																echo "<span style=\"font-weight: 700;\"> </span><br>";
															}
														} elseif ($value_res['sales_status'] == "2") {
															if ($value_res['total_sales'] != 0) {
																if ($value_res['status_commission'] == "Approved") { ?>
																	<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
																<?php
																} elseif ($value_res['status_commission'] == "Not Approved") { ?>

																	<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
																<?php 				} else {	?>
																	<i class="fa fa-square" aria-hidden="true" style="color:#e68c00"></i>&nbsp;
													<?php }
																echo "<span style=\"font-weight: 700;\">R : </span>";
																echo "฿ " . number_format($totalsale, 2) . " " . $value_res['currency'] . "<br>";
															} else {
																echo "<span style=\"font-weight: 700;\"> </span><br>";
															}
														}
													}

													?>
												</td>
												<td class="text-left nowrap" style="text-align:left;">

													<?php
													foreach ($getResponsible as $key_res => $value_res) {
														if ($value_res['sales_status'] == "1") {
															if ($value_res['total_sales'] != 0) {
																echo "<span style=\"font-weight: 700;\">M : </span>";
																echo $value_res['commission_percent'] . "% <br>";
															} else {
																echo "<span style=\"font-weight: 700;\"> </span><br>";
															}
														} elseif ($value_res['sales_status'] == "2") {
															if ($value_res['total_sales'] != 0) {
																echo "<span style=\"font-weight: 700;\">R : </span>";
																echo $value_res['commission_percent'] . "% <br>";
															} else {
																echo "<span style=\"font-weight: 700;\"> </span><br>";
															}
														}
													}
													?>
												</td>
												<td class="text-left nowrap" style="text-align:left;">
													<?php
													foreach ($getResponsible as $key_res => $value_res) {

														if ($value_res['sales_status'] == "1") {
															if ($value_res['total_sales'] != 0) {
																echo "<span style=\"font-weight: 700;\">M : </span>";
																echo "฿ " . number_format($value_res['commission'], 2) . " " . $value_res['currency'] . "<br>";
															} else {
																echo "<span style=\"font-weight: 700;\"> </span><br>";
															}
														} elseif ($value_res['sales_status'] == "2") {
															if ($value_res['total_sales'] != 0) {
																echo "<span style=\"font-weight: 700;\">R : </span>";
																echo "฿ " . number_format($value_res['commission'], 2) . " " . $value_res['currency'] . "<br>";
															} else {
																echo "<span style=\"font-weight: 700;\"> </span><br>";
															}
														}
													}
													?>
												</td>
												<td class="text-left nowrap" style="text-align:left;">
													<?php
													foreach ($getResponsible as $key_res => $value_res) {
														if ($value_res['sales_status'] != "3") {
															if ($value_res['invoice_status'] == "Paid") {

																if ($value_res['commisson_payment_status'] == "Paid") {

																	if ($value_res['sales_status'] == "1") {

																		echo "<span style=\"font-weight: 700;\">M : </span>";
																		$balance_invoice = $value_res['commission'] - $value_res['pay_for_sales'];

																		if ($balance_invoice != 0) {
																			echo "<span style=\"color:red\">$ " . number_format($balance_invoice, 2) . " " . $value_res['currency'] . "</span><br>";
																		} else {
																			echo "<span>฿ " . number_format($balance_invoice, 2) . " " . $value_res['currency'] . "</span><br>";
																		}
																	} elseif ($value_res['sales_status'] == "2") {

																		echo "<span style=\"font-weight: 700;\">R : </span>";

																		$balance_invoice = $value_res['commission'] - $value_res['pay_for_sales'];

																		if ($balance_invoice != 0) {
																			echo "<span style=\"color:red\">฿ " . number_format($balance_invoice, 2) . " " . $value_res['currency'] . "</span><br>";
																		} else {
																			echo "<span>฿ " . number_format($balance_invoice, 2) . " " . $value_res['currency'] . "</span><br>";
																		}
																	}
																} else {
																	if ($totalsale != 0) {
																		if ($value_res['sales_status'] == "1") {
																			echo "<span style=\"font-weight: 700;\">M : </span>";

																			if ($value_res['commission'] != 0) {
																				echo "<span style=\"color:red\">฿ " . number_format($value_res['commission'], 2) . " " . $value_res['currency'] . "</span><br>";
																			} else {
																				echo "<span>฿ " . number_format($value_res['commission'], 2) . " " . $value_res['currency'] . "</span><br>";
																			}
																		} elseif ($value_res['sales_status'] == "2") {
																			echo "<span style=\"font-weight: 700;\">R : </span>";

																			if ($value_res['commission'] != 0) {
																				echo "<span style=\"color:red\">$ " . number_format($value_res['commission'], 2) . " " . $value_res['currency'] . "</span><br>";
																			} else {
																				echo "<span>฿ " . number_format($value_res['commission'], 2) . " " . $value_res['currency'] . "</span><br>";
																			}
																		}
																	}
																}
															}
														}
													}
													?>
												</td>


												<td class="text-left nowrap" style="text-align:left;">
													<?php
													foreach ($getResponsible as $key_res => $value_res) {
														if ($value_res['sales_status'] != "3") {
															if ($value_res['sales_status'] == "1") {

																echo "<span style=\"font-weight: 700;\">M : </span>";

																if ($value_res['commisson_payment_status'] == "Outstanding") {
																	echo "<span style=\"color:red\">" . $value_res['commisson_payment_status'] . "</span><br>";
																} else {
																	echo "<span> " . $value_res['commisson_payment_status'] . "</span><br>";
																}
															} elseif ($value_res['sales_status'] == "2") {

																echo "<span style=\"font-weight: 700;\">R : </span>";

																if ($value_res['commisson_payment_status'] == "Outstanding") {
																	echo "<span style=\"color:red\">" . $value_res['commisson_payment_status'] . "</span><br>";
																} else {
																	echo "<span> " . $value_res['commisson_payment_status'] . "</span><br>";
																}
															}
														}
													}
													?>
												</td>
												<td class="text-left nowrap" style="text-align:left;">
													<?php
													foreach ($getResponsible as $key_res => $value_res) {
														if ($value_res['sales_status'] != "3") {
															if ($value_res['commisson_payment_status'] == "Paid") {

																if ($value_res['sales_status'] == "1") {
																	echo "<span style=\"font-weight: 700;\">M : </span>";

																	echo "<span > ฿ " . number_format($value_res['pay_for_sales'], 2) . " " . $value_res['currency'] . "</span><br>";
																	if ($value_res['invoice_date'] != "0000-00-00") {
																		$_month_name_comm = array(
																			"01" => "Jan.",
																			"02" => "Feb.",
																			"03" => "Mar.",
																			"04" => "Apr.",
																			"05" => "May.",
																			"06" => "Jun.",
																			"07" => "Jul.",
																			"08" => "Aug.",
																			"09" => "Sep.",
																			"10" => "Oct.",
																			"11" => "Nov.",
																			"12" => "Dec."
																		);

																		$commissiondate = $value_res['invoice_date'];

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
																} elseif ($value_res['sales_status'] == "2") {
																	echo "<span style=\"font-weight: 700;\">R : </span>";

																	echo "<span > ฿ " . number_format($value_res['pay_for_sales'], 2) . " " . $value_res['currency'] . "</span><br>";

																	if ($value_res['date_for_sales'] != "0000-00-00") {
																		$_month_name_comm = array(
																			"01" => "Jan.",
																			"02" => "Feb.",
																			"03" => "Mar.",
																			"04" => "Apr.",
																			"05" => "May.",
																			"06" => "Jun.",
																			"07" => "Jul.",
																			"08" => "Aug.",
																			"09" => "Sep.",
																			"10" => "Oct.",
																			"11" => "Nov.",
																			"12" => "Dec."
																		);

																		$commissiondate = $value_res['date_for_sales'];

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
															}
														}
													}
													?>
												</td>
												<td class="text-left " style="word-wrap:break-word;text-align:left;">
													<?php
													foreach ($getResponsible as $key_res => $value_res) {
														if ($value_res['sales_status'] != "3") {

															$comments = Yii::app()->db->createCommand()
																->select('*')
																->from('comments com')
																->where('com.invoice = "' . $value_res['id'] . '"')
																->order('com.date_comments DESC')
																->limit('1')
																->queryAll();

															foreach ($comments as $key_co => $value_co) {
																if ($value_res['sales_status'] == "1") {
																	echo "<span style=\"font-weight: 700;\">(M) </span>";

																	if ($value_co['user_group'] == "1") {
																		echo "JOG : ";
																	} elseif ($value_co['user_group'] == "2") {
																	}
																	echo nl2br($value_co['comments']) . "<br>";
																} elseif ($value_res['sales_status'] == "2") {
																	echo "<span style=\"font-weight: 700;\">(R) </span>";

																	if ($value_co['user_group'] == "1") {
																		echo "JOG : ";
																	} elseif ($value_co['user_group'] == "2") {
																	}
																	echo nl2br($value_co['comments']) . "<br>";
																}
															}
														}
													}
													?>
												</td>
												<td class="text-left nowrap" style="word-wrap:break-word;text-align:left;">
													<?php
													foreach ($getResponsible as $key_res => $value_res) {
														if ($value_res['sales_status'] != "3") {
															if ($value_res['sales_status'] == "1") {
																echo "<span style=\"font-weight: 700;\">M : </span>";

																if ($value_res['update_date'] != "0000-00-00") {
																	$_month_name = array("01" => "Jan.", "02" => "Feb.", "03" => "Mar.", "04" => "Apr.", "05" => "May.", "06" => "Jun.", "07" => "Jul.", "08" => "Aug.", "09" => "Sep.", "10" => "Oct.", "11" => "Nov.", "12" => "Dec.");

																	list($year, $momth, $day) = explode("-", $value_res['update_date']);

																	if ($day < 10) {
																		$day = substr($day, 1, 2);
																	}

																	$date = $_month_name[$momth] . " " . $day . ",  " . $year;
													?>
																	<span style="font-size:12px;"><?php echo $date; ?></span><br>
																<?php
																} else {
																	$date = " ";
																?>
																	<span style="font-size:12px;"><?php echo $date; ?></span><br>
																<?php
																}
															} elseif ($value_res['sales_status'] == "2") {
																echo "<span style=\"font-weight: 700;\">R : </span>";

																if ($value_res['update_date'] != "0000-00-00") {
																	$_month_name = array("01" => "Jan.", "02" => "Feb.", "03" => "Mar.", "04" => "Apr.", "05" => "May.", "06" => "Jun.", "07" => "Jul.", "08" => "Aug.", "09" => "Sep.", "10" => "Oct.", "11" => "Nov.", "12" => "Dec.");

																	list($year, $momth, $day) = explode("-", $value_res['update_date']);

																	if ($day < 10) {
																		$day = substr($day, 1, 2);
																	}

																	$date = $_month_name[$momth] . " " . $day . ",  " . $year;
																?>
																	<span style="font-size:12px;"><?php echo $date; ?></span><br>
																<?php
																} else {
																	$date = " ";
																?>
																	<span style="font-size:12px;"><?php echo $date; ?></span><br>
																<?php
																}
															} else {
																echo "<span style=\"font-weight: 700;\">P : </span>";

																if ($value_res['update_date'] != "0000-00-00") {
																	$_month_name = array("01" => "Jan.", "02" => "Feb.", "03" => "Mar.", "04" => "Apr.", "05" => "May.", "06" => "Jun.", "07" => "Jul.", "08" => "Aug.", "09" => "Sep.", "10" => "Oct.", "11" => "Nov.", "12" => "Dec.");

																	list($year, $momth, $day) = explode("-", $value_res['update_date']);

																	if ($day < 10) {
																		$day = substr($day, 1, 2);
																	}

																	$date = $_month_name[$momth] . " " . $day . ",  " . $year;
																?>
																	<span style="font-size:12px;"><?php echo $date; ?></span><br>
																<?php
																} else {
																	$date = " ";
																?>
																	<span style="font-size:12px;"><?php echo $date; ?></span><br>
													<?php
																}
															}
														}
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
												<?php if (!empty($sumCommissionPaymaentTHB)) { ?>
													<span><?php echo "฿ " . number_format($sumCommissionPaymaentTHB, 2) . " THB"; ?> </span>
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
					<?php } ?>
				<?php } ?>

				<br>
				<br>
				<div class="btn-add">
					<a href="#" class="btn btn-success" data-toggle="modal" data-target="#editNotes"><i class="fa fa-pencil"></i> Edit</a>
				</div>
				<table id="bankTable" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="bg-blue-light">Notes</th>

						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="word-wrap:break-word;"><?php echo nl2br($notes['notes']); ?></td>

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
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Sales Commission Calculator - Add</h4>
			</div>
			<div class="modal-body">
				<?php echo $this->renderPartial('/calculator/addCalculator');  ?>
			</div>

		</div>
	</div>
</div>
<div class="modal fade" id="addDataMan" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Sales Responsible - Add</h4>
			</div>
			<div class="modal-body">
				<?php echo $this->renderPartial('/calculator/addCalculatorSales');  ?>
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="editData" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Sales Invoice - Edit</h4>
			</div>
			<div class="modal-body">
				<?php

				echo $this->renderPartial('/calculator/editCalculatorInvoice');  ?>
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="editDataMan" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Sales Manager - Edit</h4>
			</div>
			<div class="modal-body">
				<?php //cho $_GET['']  
				?>
				<?php echo $this->renderPartial('/calculator/editCalculatorSalesManager');  ?>
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="editDataRep" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Sales Rep - Edit</h4>
			</div>
			<div class="modal-body">

				<?php echo $this->renderPartial('/calculator/editCalculatorSalesRep');  ?>
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="editDataProcessor" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Processor - Edit</h4>
			</div>
			<div class="modal-body">

				<?php echo $this->renderPartial('/calculator/editCalculatorSalesProcessor');  ?>
			</div>

		</div>
	</div>
</div>
<!-- Edit Notes -->


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
<div class="modal fade" id="editNotes" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Notes</h4>
			</div>
			<div class="modal-body">
				<?php
				$form = $this->beginWidget('CActiveForm', array(
					'id'          => 'edit-notes-form',
					'htmlOptions' => array(
						'class'  => 'form-horizontal form-label-left',
					),
				));

				echo $form->hiddenField($notes, 'type');
				echo $form->textArea($notes, 'notes', array('class' => 'form-control'));

				$this->endWidget();
				?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="edit-submit-note">Save</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function changeMonth() {
		var month = $('#select_month').val();
		window.location.replace("<?php echo Yii::app()->request->baseUrl; ?>/calculator/Invoice/year/<?php echo $year_select; ?>/month/" + month);
	}
</script>