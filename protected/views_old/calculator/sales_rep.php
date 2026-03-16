<style>
	#parent {
		/*height: 500px;*/
		height: Auto;
		width: 100%;
	}
		
	#calculatorTable {
		width: 100% !important;
	}
	.bg-usd, .bg-cad, .bg-price{
		text-align: center;
		vertical-align: middle;
	}
	.pre {
		white-space: pre;
	}
	.text-right{
		text-align: right;
	}
	.text-left{
		text-align: left;
	}
</style>
<script>
			
	$(document).ready(function() {
		$("#calculatorTable").tableHeadFixer({"left" : 1}); 
	});
	
</script>

<div class="row" id="calculator">
	<div class="row mt-20">
		<div class="col-md-12">
			<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/FiscalYear" class="link"  >
				<i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Go Back
			</a>
		</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Sales Rep</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
                <h2> <i class="fa fa-file-text-o" aria-hidden="true"></i> <?php echo $year_commission." Year"; ?>
				
					<a href="<?php echo Yii::app()->baseUrl; ?>/pdf/commissionAll/year/<?php echo $year_commission;?>" class="paf_dowload" style="float: right;" target="_blank"> PDF </a>
					 </h2>
					
					<br>
					
					<div class="btn-add">
						<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#addData"><i class="fa fa-plus"></i> Add</a>
					</div>
				
				<div id="parent">
					<table id="calculatorTable" class="table table-striped table-bordered" style="border-collapse: initial;">
						<thead>
							<tr>
								<th class="bg-blue-light text-center" >Sales Rep </th>
								<th colspan="5" class="bg-blue-light text-center" > USD</th>
								<th colspan="5" class="bg-blue-light text-center" > CAD</th>
								<th colspan="5" class="bg-blue-light text-center" > SGD</th>
								<th colspan="5" class="bg-blue-light text-center" > THB</th>
								<th class="bg-blue-light text-center" > Update</th>
								
							</tr>
							<tr>
								<th class="bg-blue-light text-center" > Name </th>
								<th class="bg-blue-light text-center" > Total Sales</th>
								<th class="bg-blue-light text-center" > Total commissions Earned</th>
								<th class="bg-blue-light text-center" > Balance </th>
								<th class="bg-blue-light text-center" >Payment received<br>from customer</th>
								<th class="bg-blue-light text-center" >Remaining Credit<br>owe to JOG</th>
								
								<th class="bg-blue-light text-center" > Total Sales</th>
								<th class="bg-blue-light text-center" > Total commissions Earned </th>
								<th class="bg-blue-light text-center" > Balance </th>
								<th class="bg-blue-light text-center" >Payment received<br>from customer</th>
								<th class="bg-blue-light text-center" >Remaining Credit<br>owe to JOG</th>
								
								<th class="bg-blue-light text-center" > Total Sales</th>
								<th class="bg-blue-light text-center" > Total commissions Earned</th>
								<th class="bg-blue-light text-center" > Balance </th>
								<th class="bg-blue-light text-center" >Payment received<br>from customer</th>
								<th class="bg-blue-light text-center" >Remaining Credit<br>owe to JOG</th>
								
								<th class="bg-blue-light text-center" > Total Sales </th>
								<th class="bg-blue-light text-center" > Total commissions Earned </th>
								<th class="bg-blue-light text-center" > Balance </th>
								<th class="bg-blue-light text-center" >Payment received<br>from customer</th>
								<th class="bg-blue-light text-center" >Remaining Credit<br>owe to JOG</th>
								
								<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;" > Last Update </th>
								
								
							</tr>
						</thead>
						<tbody>
							<?php
								
								foreach ($getData as $key => $value) {
								
								
									$getSale = Yii::app()->db->createCommand()
									->select('*')
									->from('calculator scal')
									->where('scal.sales_manager = "'.$value['sales_manager'].'"')
									->andwhere('scal.date_quarter LIKE "'.$year_commission.'%" ')
									->order('scal.id ASC')
									->queryAll();
									
								
								$sumtotalUSD[$key] = 0;
								$sumtotalCAD[$key] = 0;
								$sumtotalSGD[$key] = 0;
								$sumtotalTHB[$key] = 0;
								$totalcommissionUSD[$key] = 0;
								$totalcommissionCAD[$key] = 0;
								$totalcommissionSGD[$key] = 0;
								$totalcommissionTHB[$key] = 0;
								$payoutUSD[$key] = 0;
								$payoutCAD[$key] = 0;
								$payoutSGD[$key] = 0;
								$payoutTHB[$key] = 0;
								$balanceUSD[$key] = 0;
								$balanceCAD[$key] = 0;
								$balanceSGD[$key] = 0;
								$balanceTHB[$key] = 0;

								$sumfcusUSD[$key] = 0;
								$sumfcusCAD[$key] = 0;
								$sumfcusSGD[$key] = 0;
								$sumfcusTHB[$key] = 0;

								$sumPayCreditUSD[$key] = 0;
								$sumPayCreditCAD[$key] = 0;
								$sumPayCreditSGD[$key] = 0;
								$sumPayCreditTHB[$key] = 0;
								
								
								//$test_num = 0;
									foreach ($getSale as $key_sum => $value_sum) {

										//$test_num++;
										//echo $value['sales_manager'] ."==". $value_sum['sales_manager']."<br>";
										//if($value['sales_manager'] == $value_sum['sales_manager']){
											if($value_sum['currency'] == "USD"){
												
													//echo $sumtotalUSD[$key] ."-----". $value_sum['total_sales']."<br>";
													$sumtotalUSD[$key] +=  (($value_sum['total_sales']-$value_sum['shipping_cost'])-$value_sum['creditcard_feecost']);
													
													$totalcommissionUSD[$key]  +=  $value_sum['commission'];
													$payoutUSD[$key]  +=  $value_sum['pay_for_sales'];

													$sumfcusUSD[$key] += $value_sum['pay_by_customer'];

												if($value_sum['invoice_status'] == "Paid"){	
													if($value_sum['invoice_status'] == "Paid"){
														$balanceUSD[$key]  += ($value_sum['commission']  - $value_sum['pay_for_sales'] );

														$sumPayCreditUSD[$key] += $value_sum['pay_by_credit'];
													}else{
														$balanceUSD[$key]  += $value_sum['commission'];
													}
												}
											}
											if($value_sum['currency'] == "CAD"){
												
												
													$sumtotalCAD[$key]  +=  (($value_sum['total_sales']-$value_sum['shipping_cost'])-$value_sum['creditcard_feecost']);
													
													$totalcommissionCAD[$key]  +=  $value_sum['commission'];
													$payoutCAD[$key]  +=  $value_sum['pay_for_sales'];

													$sumfcusCAD[$key] += $value_sum['pay_by_customer'];

												if($value_sum['invoice_status'] == "Paid"){	
													if($value_sum['invoice_status'] == "Paid"){
														$balanceCAD[$key]  += ($value_sum['commission']  - $value_sum['pay_for_sales'] );

														$sumPayCreditCAD[$key] += $value_sum['pay_by_credit'];
													}else{
														$balanceCAD[$key]  += $value_sum['commission'];
													}
												}	
											}
											if($value_sum['currency'] == "SGD"){
												
												

													$sumtotalSGD[$key]  +=  (($value_sum['total_sales']-$value_sum['shipping_cost'])-$value_sum['creditcard_feecost']);
													
													$totalcommissionSGD[$key]  +=  $value_sum['commission'];
													$payoutSGD[$key]  +=  $value_sum['pay_for_sales'];

													$sumfcusSGD[$key] += $value_sum['pay_by_customer'];

												if($value_sum['invoice_status'] == "Paid"){	
													if($value_sum['invoice_status'] == "Paid"){
														$balanceSGD[$key]  += ($value_sum['commission']  - $value_sum['pay_for_sales'] );

														$sumPayCreditSGD[$key] += $value_sum['pay_by_credit'];
													}else{
														$balanceSGD[$key]  += $value_sum['commission'];
													}
												}	
											}
											if($value_sum['currency'] == "THB"){
												
												

													$sumtotalTHB[$key]  +=  (($value_sum['total_sales']-$value_sum['shipping_cost'])-$value_sum['creditcard_feecost']);
													
													$totalcommissionTHB[$key]  +=  $value_sum['commission'];
													$payoutTHB[$key]  +=  $value_sum['pay_for_sales'];

													$sumfcusTHB[$key] += $value_sum['pay_by_customer'];

												if($value_sum['invoice_status'] == "Paid"){	
													if($value_sum['invoice_status'] == "Paid"){
														$balanceTHB[$key]  += ($value_sum['commission']  - $value_sum['pay_for_sales'] );

														$sumPayCreditTHB[$key] += $value_sum['pay_by_credit'];
													}else{
														$balanceTHB[$key]  += $value_sum['commission'];
													}
												}	
											}
										//}
									}
							?>
							<tr>
								<td class="text-left nowrap" > 
								<span>
									<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/SalesCommission/year/<?php echo $year_commission; ?>/sales/<?php echo $value['sales_manager'];?>"> 
										<i class="fa fa-user" aria-hidden="true"></i> &nbsp;<?php echo $value['sales_manager'];?> 
									</a>
								</span>	
								</td>
								<td class="text-right bg-usd nowrap" >
									<span><?php echo "$ ".number_format($sumtotalUSD[$key] , 2);?> </span> 
									
								</td>
								<td class="text-right bg-usd nowrap" >
									<span><?php echo "$ ".number_format($totalcommissionUSD[$key] , 2);?></span>
								</td>
								<td class="text-right bg-usd nowrap" >
									<?php 
										$totalUSD=$balanceUSD[$key]-$sumPayCreditUSD[$key];
										if($totalUSD < 0){
											echo "<span style=\"color:red;\">$ ".number_format($totalUSD , 2)."</span>";
										}else{
											echo "<span>$ ".number_format($totalUSD , 2)."</span>";
										}	
											?>
								</td>
								<td class="text-right bg-usd nowrap" >
									<?php
										if($sumfcusUSD[$key] != 0){
											echo "<span style=\"color:red;\">$ ".number_format($sumfcusUSD[$key] , 2)."</span>";
										}else{
											echo "<span>$ ".number_format($sumfcusUSD[$key] , 2)."</span>";
										}
									?>
								</td>
								<td class="text-right bg-usd nowrap" >
									<?php
										$sumcreditUSD=$sumfcusUSD[$key]-$sumPayCreditUSD[$key];

										if($sumcreditUSD > 0){
											echo "<span style=\"color:red;\">$ ".number_format($sumcreditUSD , 2)."</span>";
										}else{
											echo "<span>$ ".number_format($sumcreditUSD , 2)."</span>";
										}
									?>
								</td>
								
								<td class="text-right bg-cad nowrap" >  
									<span><?php echo "$ ".number_format($sumtotalCAD[$key] , 2);?></span>
								</td>
								<td class="text-right bg-cad nowrap" >  
									<span><?php echo "$ ".number_format($totalcommissionCAD[$key] , 2);?></span>
								</td>
								<td class="text-right bg-cad nowrap" > 
									<?php 
										$totalCAD=$balanceCAD[$key]-$sumPayCreditCAD[$key];
										if($totalCAD < 0){
											echo "<span style=\"color:red;\">$ ".number_format($totalCAD , 2)."</span>";
										}else{
											echo "<span>$ ".number_format($totalCAD , 2)."</span>";
										}		
									
									?>
								</td>
								<td class="text-right bg-cad nowrap" >
									<?php
										if($sumfcusCAD[$key] != 0){
											echo "<span style=\"color:red;\">$ ".number_format($sumfcusCAD[$key] , 2)."</span>";
										}else{
											echo "<span>$ ".number_format($sumfcusCAD[$key] , 2)."</span>";
										}
									?>
								</td>
								<td class="text-right bg-cad nowrap" >
									<?php
										$sumcreditCAD=$sumfcusCAD[$key]-$sumPayCreditCAD[$key];

										if($sumcreditCAD > 0){
											echo "<span style=\"color:red;\">$ ".number_format($sumcreditCAD , 2)."</span>";
										}else{
											echo "<span>$ ".number_format($sumcreditCAD , 2)."</span>";
										}
									?>
								</td>
								
								<td class="text-right bg-usd nowrap" >  
									<span><?php echo "$ ".number_format($sumtotalSGD[$key] , 2);?></span>
								</td>
								<td class="text-right bg-usd nowrap" >  
									<span><?php echo "$ ".number_format($totalcommissionSGD[$key] , 2);?></span>
								</td>
								<td class="text-right bg-usd nowrap" > 
									<?php 
										$totalSGD=$balanceSGD[$key]-$sumPayCreditSGD[$key];
										if($totalSGD < 0){
											echo "<span style=\"color:red;\">$ ".number_format($totalSGD , 2)."</span>";
										}else{
											echo "<span>$ ".number_format($totalSGD , 2)."<span>";
										}		
									
									?>
								</td>
								<td class="text-right bg-usd nowrap" >
									<?php
										if($sumfcusSGD[$key] != 0){
											echo "<span style=\"color:red;\">$ ".number_format($sumfcusSGD[$key] , 2)."</span>";
										}else{
											echo "<span>$ ".number_format($sumfcusSGD[$key] , 2)."</span>";
										}
									?>
								</td>
								<td class="text-right bg-usd nowrap" >
									<?php
										$sumcreditSGD=$sumfcusSGD[$key]-$sumPayCreditSGD[$key];

										if($sumcreditSGD > 0){
											echo "<span style=\"color:red;\">$ ".number_format($sumcreditSGD , 2)."</span>";
										}else{
											echo "<span>$ ".number_format($sumcreditSGD , 2)."</span>";
										}
									?>
								</td>
								
								<td class="text-right bg-cad nowrap" >  
									<span><?php echo "฿ ".number_format($sumtotalTHB[$key] , 2);?></span>
								</td>
								<td class="text-right bg-cad nowrap" >  
									<span><?php echo "฿ ".number_format($totalcommissionTHB[$key] , 2);?></span>
								</td>
								<td class="text-right bg-cad nowrap" > 
									<?php 
										$totalTHB=$balanceTHB[$key]-$sumPayCreditTHB[$key];
										if($totalTHB < 0){
											echo "<span style=\"color:red;\">฿ ".number_format($totalTHB, 2)."</span>";
										}else{
											echo "<span>฿ ".number_format($totalTHB , 2)."</span>";
										}		
									
									?>
								</td>
								<td class="text-right bg-cad nowrap" >
									<?php
										if($sumfcusTHB[$key] != 0){
											echo "<span style=\"color:red;\">$ ".number_format($sumfcusTHB[$key] , 2)."</span>";
										}else{
											echo "<span>$ ".number_format($sumfcusTHB[$key] , 2)."</span>";
										}
									?>
								</td>
								<td class="text-right bg-cad nowrap" >
									<?php
										$sumcreditTHB=$sumfcusTHB[$key]-$sumPayCreditTHB[$key];

										if($sumcreditTHB > 0){
											echo "<span style=\"color:red;\">$ ".number_format($sumcreditTHB , 2)."</span>";
										}else{
											echo "<span>$ ".number_format($sumcreditTHB , 2)."</span>";
										}
									?>
								</td>

								<td class="text-left bg-cad nowrap" > 
									<?php 
									
										$getLast = Yii::app()->db->createCommand('select MAX(update_date) AS datedata  from calculator where sales_manager = "'.$value['sales_manager'].'" order by id DESC limit 1')->queryAll();
						
										foreach ($getLast as $key_last => $value_last) {
											$datedata = $value_last['datedata'];
										}
										if($datedata != "0000-00-00" ){ 
								
											$_month_name = array("01"=>"Jan.", "02"=>"Feb.", "03"=>"Mar.","04"=>"Apr.", "05"=>"May.", "06"=>"Jun.", "07"=>"Jul.", "08"=>"Aug.", "09"=>"Sep.", "10"=>"Oct.", "11"=>"Nov.", "12"=>"Dec."); 
																							 
														
											list($year,$momth,$day) = explode("-",$datedata);
																				
											if ($day < 10){
												$day = substr($day,1,2);
											}
														
											$date = $_month_name[$momth]." ".$day.",  ".$year;
										}else{
											$date = " - ";
										}	
									?>
									<span><?php echo $date; ?><span>
									
									
								</td>
							</tr>
								<?php } ?>
						</tbody>
					</table>
				</div>
				<br>
				<br>
			
				<div class="btn-add">
							<a href="#" class="btn btn-success" data-toggle="modal" data-target="#editNotes"><i class="fa fa-pencil"></i> Edit</a>
						</div>
					<table id="notesTable" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="bg-blue-light" >Notes</th>
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

<!-- Add PriceGuide -->
<div class="modal fade" id="addData" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Sales Commission Calculator - Add</h4>
			</div>
			<div class="modal-body">
                <?php echo $this->renderPartial('/calculator/addCalculatorFiscalYear');  ?>
			</div>
			<?php /*
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="submit-calculator">Save</button>
			</div>
			**/
			?>
		</div>
	</div>
</div>
<!--<div class="modal fade" id="editData" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Sales Commission Calculator- Edit</h4>
			</div>
			<div class="modal-body">
                <?php //echo $this->renderPartial('/calculator/editCalculator');  ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="edit-submit-calculator">Save</button>
			</div>
		</div>
	</div>
</div>-->
<!-- Edit Notes -->
<div class="modal fade" id="editNotes" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Notes</h4>
			</div>
			<div class="modal-body">
            <?php 
            	$form=$this->beginWidget('CActiveForm', array(
					'id'          => 'edit-notes-form',
					'htmlOptions' => array(
						'class'  => 'form-horizontal form-label-left',
						),
					));

                echo $form->hiddenField($notes, 'type');
                echo $form->textArea($notes, 'notes', array('class'=>'form-control'));

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

