<style>
	#parent {
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
</style>
<script>
			
	$(document).ready(function() {
		$("#calculatorTable").tableHeadFixer({"left" : 1}); 
	});
	
</script>
<div class="row" id="calculator">
	<div class="row mt-20">
		<div class="col-md-12">
			<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator" class="link"  >
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
					<h2> <i class="fa fa-file-text-o" aria-hidden="true"></i> <?php echo $year_commission." Year"; ?> </h2>
					<br>
					<a href="<?php echo Yii::app()->baseUrl; ?>/pdf/commissionAll/year/<?php echo $year_commission;?>" class="paf_dowload" target="_blank"> PDF </a>
					<div id="parent">
						<table id="calculatorTable" class="table table-striped table-bordered" style="border-collapse: initial;">
							<thead>
								<tr>
									<th class="bg-blue-light text-center" >Sales rep </th>
									<th colspan="3" class="bg-blue-light text-center" > USD</th>
									<th colspan="3"class="bg-blue-light text-center" > CAD</th>
									<th colspan="3" class="bg-blue-light text-center" > SGD</th>
									<th colspan="3" class="bg-blue-light text-center" > THB</th>
									<th colspan="3" class="bg-blue-light text-center" > Update</th>
									
								</tr>
								<tr>
									
									<th class="bg-blue-light text-center" > Name </th>
									<th class="bg-blue-light text-center" > Total Sales</th>
									<th class="bg-blue-light text-center" > Total commissions Earned</th>
									<th class="bg-blue-light text-center" > Balance </th>
									
									<th class="bg-blue-light text-center" > Total Sales </th>
									<th class="bg-blue-light text-center" > Total commissions Earned </th>
									<th class="bg-blue-light text-center" > Balance </th>
									
									<th class="bg-blue-light text-center" > Total Sales </th>
									<th class="bg-blue-light text-center" > Total commissions Earned </th>
									<th class="bg-blue-light text-center" > Balance </th>
									
									<th class="bg-blue-light text-center" > Total Sales </th>
									<th class="bg-blue-light text-center" > Total commissions Earned </th>
									<th class="bg-blue-light text-center" > Balance </th>
									
							
									<th class="bg-blue-light text-center" > Last Update </th>
								
								</tr>
							</thead>
							<tbody>
							<?php
									foreach ($getData as $key => $value) {
											$getSale = Yii::app()->db->createCommand()
									->select('*')
									->from('calculator scal')
									->where('scal.sales_manager = "'.$value['sales_manager'].'"')
									->andwhere('scal.status_commission = "Approved"')
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
								
									foreach ($getSale as $key_sum => $value_sum) {
										
										if($value['sales_manager'] == $value_sum['sales_manager']){
											if($value_sum['currency'] == "USD"){
												if($value_sum['invoice_status'] == "Paid"){

													$sumtotalUSD[$key] +=  (($value_sum['total_sales']-$value_sum['shipping_cost'])-$value_sum['creditcard_feecost']);
													
													$totalcommissionUSD[$key]  +=  $value_sum['commission'];
													$payoutUSD[$key]  +=  $value_sum['pay_for_sales'];
													
													if($value_sum['invoice_status'] == "Paid"){
														$balanceUSD[$key]  = ($totalcommissionUSD[$key]  - $payoutUSD[$key] );
													}else{
														$balanceUSD[$key]  = "0";
													}
												}
											}
											if($value_sum['currency'] == "CAD"){
												if($value_sum['invoice_status'] == "Paid"){

													$sumtotalCAD[$key]  +=  (($value_sum['total_sales']-$value_sum['shipping_cost'])-$value_sum['creditcard_feecost']);
													
													$totalcommissionCAD[$key]  +=  $value_sum['commission'];
													$payoutCAD[$key]  +=  $value_sum['pay_for_sales'];
													
													if($value_sum['invoice_status'] == "Paid"){
														$balanceCAD[$key]  = ($totalcommissionCAD[$key]  - $payoutCAD[$key] );
													}else{
														$balanceCAD[$key]  = "0";
													}
												}	
											}
											if($value_sum['currency'] == "SGD"){
												if($value_sum['invoice_status'] == "Paid"){

													$sumtotalSGD[$key]  +=  (($value_sum['total_sales']-$value_sum['shipping_cost'])-$value_sum['creditcard_feecost']);
													
													$totalcommissionSGD[$key]  +=  $value_sum['commission'];
													$payoutSGD[$key]  +=  $value_sum['pay_for_sales'];
													
													if($value_sum['invoice_status'] == "Paid"){
														$balanceSGD[$key]  = ($totalcommissionSGD[$key]  - $payoutSGD[$key] );
													}else{
														$balanceSGD[$key]  = "0";
													}
												}
											}
											if($value_sum['currency'] == "THB"){
												if($value_sum['invoice_status'] == "Paid"){

													$sumtotalTHB[$key]  +=  (($value_sum['total_sales']-$value_sum['shipping_cost'])-$value_sum['creditcard_feecost']);
													
													$totalcommissionTHB[$key]  +=  $value_sum['commission'];
													$payoutTHB[$key]  +=  $value_sum['pay_for_sales'];
													
													if($value_sum['invoice_status'] == "Paid"){
														$balanceTHB[$key]  = ($totalcommissionTHB[$key]  - $payoutTHB[$key] );
													}else{
														$balanceTHB[$key]  = "0";
													}
												}	
											}
										}
									}
								?>
								<tr>
								<td class="text-left nowrap" > 
								<span>
									<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/showSalesCommission/year/<?php echo $year_commission; ?>/sales/<?php echo $value['sales_manager'];?>"> 
										<i class="fa fa-user" aria-hidden="true"></i> &nbsp;<?php echo $value['sales_manager'];?> 
									</a>
								</span>	
								</td>
								<td class="text-center bg-usd nowrap" >
									<span><?php echo "$ ".number_format($sumtotalUSD[$key] , 2);?> </span> 
								</td>
								<td class="text-center bg-usd nowrap" >
									<span><?php echo "$ ".number_format($totalcommissionUSD[$key] , 2);?></span>
								</td>
								<td class="text-center bg-usd nowrap" >
									<?php 

										if($balanceUSD[$key]  != 0){
											echo "<span style=\"color:red;\">$ ".number_format($balanceUSD[$key] , 2)."</span>";
										}else{
											echo "<span>$ ".number_format($balanceUSD[$key] , 2)."</span>";
										}	
											?>
								</td>
								
								<td class="text-center bg-cad nowrap" >  
									<span><?php echo "$ ".number_format($sumtotalCAD[$key] , 2);?></span>
								</td>
								<td class="text-center bg-cad nowrap" >  
									<span><?php echo "$ ".number_format($totalcommissionCAD[$key] , 2);?></span>
								</td>
								<td class="text-center bg-cad nowrap" > 
									<?php 
										
										
										if($balanceCAD[$key]  != 0){
											echo "<span style=\"color:red;\">$ ".number_format($balanceCAD[$key] , 2)."</span>";
										}else{
											echo "<span>$ ".number_format($balanceCAD[$key] , 2)."</span>";
										}		
									
									?>
								</td>
								
								<td class="text-center bg-usd nowrap" >  
									<span><?php echo "$ ".number_format($sumtotalSGD[$key] , 2);?></span>
								</td>
								<td class="text-center bg-usd nowrap" >  
									<span><?php echo "$ ".number_format($totalcommissionSGD[$key] , 2);?></span>
								</td>
								<td class="text-center bg-usd nowrap" > 
									<?php 
									
										
										if($balanceSGD[$key]  != 0){
											echo "<span style=\"color:red;\">$ ".number_format($balanceSGD[$key] , 2)."</span>";
										}else{
											echo "<span>$ ".number_format($balanceSGD[$key] , 2)."<span>";
										}		
									
									?>
								</td>
								
								<td class="text-center bg-cad nowrap" >  
									<span><?php echo "฿ ".number_format($sumtotalTHB[$key] , 2);?></span>
								</td>
								<td class="text-center bg-cad nowrap" >  
									<span><?php echo "฿ ".number_format($totalcommissionTHB[$key] , 2);?></span>
								</td>
								<td class="text-center bg-cad nowrap" > 
									<?php 
									
										
										if($balanceTHB[$key]  != 0){
											echo "<span style=\"color:red;\">฿ ".number_format($balanceTHB[$key], 2)."</span>";
										}else{
											echo "<span>฿ ".number_format($balanceTHB[$key] , 2)."</span>";
										}		
									
									?>
								</td>
								<td class="text-center bg-usd nowrap" > 
									<?php 
									
										$getLast = Yii::app()->db->createCommand('select MAX(update_date) AS datedata  from calculator where sales_manager = "'.$value['sales_manager'].'" order by id DESC limit 1')->queryAll();
						
										foreach ($getLast as $key_last => $value_last) {
											$datedata = $value_last['datedata'];
										}
										if($datedata != "0000-00-00" ){ 
								
											$_month_name = array("01"=>"Jan.", "02"=>"Feb.", "03"=>"Mar.","04"=>"Apr.", "05"=>"May.", "06"=>"Jun.", "07"=>"Jul.", "08"=>"Aug.", "09"=>"Sep.", "10"=>"Oct.", "11"=>"Nov.", "12"=>"Dec."); 
																							 
														
											list($year_tmp,$month_tmp,$day_tmp) = explode("-",$datedata);
																				
											if ($day_tmp < 10){
												$day_tmp = substr($day_tmp,1,2);
											}
														
											$date = $_month_name[$month_tmp]." ".$day_tmp.",  ".$year_tmp;
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



