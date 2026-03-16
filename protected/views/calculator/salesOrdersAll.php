<style>
	#parent {
		height: Auto;
		width: 100%;
	}


	#calculatorHeaderTable {
		width: 100% !important;
	}

	#freezer-Table .table tbody td {
		outline: 1px solid #ddd;
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

	@media screen and (max-width:520px) {
		.flex-header .modal-title {
			font-size: 16px;
			width: 80%;
		}

		#addData {
			padding: 0 !important;
		}
	}
</style>

<div class="row" id="calculator">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Sales Orders</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div>
					<h2> <?php //echo $sales_commission." - ". $year_commission." Year"; 
							?> </h2>

					<!--<a href="<?php //echo Yii::app()->baseUrl; 
									?>/pdf/commissionSale/year/<?php //echo $year_commission;
																?>/sale/<?php //echo $sales_commission; 
																		?>" class="paf_dowload" target="_blank"> PDF (ALL)</a>-->
				</div>
				<br>
				<div>
					<?php
					if (!empty($datedata)) {
						if ($datedata != "0000-00-00") {

							$_month_name = array("01" => "January", "02" => "February", "03" => "March", "04" => "April", "05" => "May", "06" => "June", "07" => "July", "08" => "August", "09" => "September", "10" => "October", "11" => "November", "12" => "December");


							list($year, $momth, $day) = explode("-", $datedata);

							if ($day < 10) {
								$day = substr($day, 1, 2);
							}

							$date = $_month_name[$momth] . " " . $day . ",  " . $year;
						} else {
							$date = " ";
						}

						echo "<span style=\"color:red;font-size:12px;\">(Last Update! : " . $date . ")</span>";
					}
					?>
				</div>

				<div style="margin-bottom:10px;">
					<div class="btn-add">
						<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#addData"><i class="fa fa-plus"></i> Add</a>
					</div>
				</div>
				<br>

				<div style="margin:0">
					<table id="salesOrders" class="table table-striped table-bordered table-condensed ">
						<thead>
							<tr>
								<th class="bg-blue-light text-center"> Sales Rep </th>

								<th class="bg-blue-light text-center"> Last Update </th>
							</tr>
						</thead>
						<tbody>
							<?php
							//$num = 1;
							foreach ($litedata as $key => $value) {

							?>
								<tr style="background: #ffffff;">

									<td class="nowrap" style="vertical-align: middle;text-align:center;">
										<a href="<?php echo Yii::app()->baseUrl; ?>/calculator/SalesOrdersOneByOne/sales/<?php echo $value['sales_rep']; ?>"> <?php echo $value['sales_rep']; ?> </a>
										<?php

										$result['sales_repall'] = Yii::app()->db->createCommand()
											->select('status_active')
											->from('sales_orders sa')
											->where('sa.sales_rep = "' . $value['sales_rep'] . '"')
											->andwhere('sa.status_active = "0"')
											->queryAll();

										foreach ($result['sales_repall'] as $key_repall => $value_repall) {
										?>
											<span style="color:red;font-size:9px;"> <i class="fa fa-exclamation-circle" aria-hidden="true" style="color:red;"></i> (UPDATE) </span>
										<?php
										}
										?>
									</td>

									<td class="text-center" style="word-wrap:break-word;vertical-align: middle;">
										<?php
										$result['dateordersall'] = Yii::app()->db->createCommand()
											->select('MAX(date_update) AS maxdatesale')
											->from('sales_orders sodat')
											->where('sodat.sales_rep = "' . $value['sales_rep'] . '"')
											->queryAll();

										foreach ($result['dateordersall'] as $keyall => $valueall) {
											//$result['datedata'] = $valueall['maxdatesale'];


											if ($valueall['maxdatesale'] != "0000-00-00") {
												$_month_name = array("01" => "Jan.", "02" => "Feb.", "03" => "Mar.", "04" => "Apr.", "05" => "May.", "06" => "Jun.", "07" => "Jul.", "08" => "Aug.", "09" => "Sep.", "10" => "Oct.", "11" => "Nov.", "12" => "Dec.");

												list($year, $momth, $day) = explode("-", $valueall['maxdatesale']);

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
										}
										?>
									</td>

								</tr>
							<?php
								//$num++;
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</div>
</div>

<div class="modal fade" id="addData" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="flex-header modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Sales Orders - Add</h4>
			</div>
			<div class="modal-body">
				<?php echo $this->renderPartial('/calculator/addSaleOrders');  ?>
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="editData" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Sales Orders- Edit</h4>
			</div>
			<div class="modal-body">

				<?php echo $this->renderPartial('/calculator/editSaleOrders');  ?>
			</div>

		</div>
	</div>
</div>