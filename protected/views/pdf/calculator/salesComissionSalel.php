<?php


$html = '
<img src="images/jog-logo3.png" class="img-responsive" style="width:30px;margin-bottom:20px;" alt="1">&nbsp; &nbsp;
<img src="images/jog_athl.png" class="img-responsive" style="width:100px;" alt="1">

						
<h2>'.$sale.' - '.$_GET['year'].' Year</h2>					
	<div >';
		$getDate = Yii::app()->db->createCommand('select MAX(update_date) AS datedata  from calculator where sales_manager = "'.$sale.'" ORDER BY `date_quarter` ASC, `invoice` ASC limit 1')->queryAll();
						
			foreach ($getDate as $key_date => $value_date) {
				$datedata = $value_date['datedata'];
			}
	
			if($datedata != "0000-00-00" ){ 
								
				$_month_name = array("01"=>"January", "02"=>"February", "03"=>"March","04"=>"April", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December"); 
																			 
				list($year,$momth,$day) = explode("-",$datedata);
																
				if ($day < 10){
					$day = substr($day,1,2);
				}
										
				$date = $_month_name[$momth]." ".$day.",  ".$year;
				
			}else{
				$date = " - ";
			}	
$html .= '	<span style="color:red;font-size:12px;">Last Update! : '.$date.'<span>
	</div>';
	
		$year_commission = $year;	
		$sumtotalUSD = 0;
		$sumtotalCAD = 0;
		$sumtotalSGD = 0;
		$sumtotalTHB = 0;
		$totalcommissionUSD = 0;
		$totalcommissionCAD = 0;
		$totalcommissionSGD = 0;
		$totalcommissionTHB = 0;
		$payoutUSD = 0;
		$payoutCAD = 0;
		$payoutSGD = 0;
		$payoutTHB = 0;
		$balanceUSD = 0;
		$balanceCAD = 0;
		$balanceSGD = 0;
		$balanceTHB = 0;
		$commissionPaymentUSD = 0;
		$commissionPaymentCAD = 0;
		$commissionPaymentSGD = 0;
		$commissionPaymentTHB = 0;
		
		$sumCommissionPaymaentUSD = 0;
		$sumCommissionPaymaentCAD = 0;
		$sumCommissionPaymaentSGD = 0;
		$sumCommissionPaymaentTHB = 0;
		
		$sumAmountReceivedUSD = 0;
		$sumAmountReceivedCAD = 0;
		$sumAmountReceivedSGD = 0;
		$sumAmountReceivedTHB = 0;
		
		$currency = Array();
		
				$getreprot = Yii::app()->db->createCommand('select * from calculator where date_quarter LIKE "'.$_GET['year'].'%" AND sales_manager = "'.$sale.'" ORDER BY `date_quarter` ASC, `invoice` ASC ')->queryAll();
				
				foreach ($getreprot as $key_report => $value_date_report) {
					
					if($value_date_report['currency'] == "USD"){
							if($value_date_report['invoice_status'] == "Paid"){
								
								$sumAmountReceivedUSD += $value_date_report['invoice_amount_received'];	
								
								if($value_date_report['commisson_payment_status'] == "Paid"){
									$commissionPaymentUSD +=  $value_date_report['commission'] - $value_date_report['pay_for_sales'];
								}else{
									$commissionPaymentUSD += $value_date_report['commission'];
								}	
							}
							
							$sumtotalUSD +=  (($value_date_report['total_sales']-$value_date_report['shipping_cost'])-$value_date_report['creditcard_feecost']);
							
							$sumCommissionPaymaentUSD += $value_date_report['pay_for_sales'];
							$totalcommissionUSD +=  $value_date_report['commission'];
							$payoutUSD +=  $value_date_report['pay_for_sales'];
								
						}
						if($value_date_report['currency'] == "CAD"){
							
							if($value_date_report['invoice_status'] == "Paid"){
								
								$sumAmountReceivedCAD += $value_date_report['invoice_amount_received'];	
								
										
								if($value_date_report['commisson_payment_status'] == "Paid"){
									$commissionPaymentCAD +=  $value_date_report['commission'] - $value_date_report['pay_for_sales'];
								}else{
									$commissionPaymentCAD += $value_date_report['commission'];
								}
							}	
							
							$sumtotalCAD +=  (($value_date_report['total_sales']-$value_date_report['shipping_cost'])-$value_date_report['creditcard_feecost']);
							
							$sumCommissionPaymaentCAD += $value_date_report['pay_for_sales'];
									
							$totalcommissionCAD +=  $value_date_report['commission'];
							$payoutCAD +=  $value_date_report['pay_for_sales'];
							
								
						}
						if($value_date_report['currency'] == "SGD"){
							
							if($value_date_report['invoice_status'] == "Paid"){

								$sumAmountReceivedSGD += $value_date_report['invoice_amount_received'];	
								
								if($value_date_report['commisson_payment_status'] == "Paid"){
									$commissionPaymentSGD +=  $value_date_report['commission'] - $value_date_report['pay_for_sales'];
								}else{
									$commissionPaymentSGD += $value_date_report['commission'];
								}
							}	
							
							$sumtotalSGD +=  (($value_date_report['total_sales']-$value_date_report['shipping_cost'])-$value_date_report['creditcard_feecost']);
							
							$sumCommissionPaymaentSGD += $value_date_report['pay_for_sales'];
							$totalcommissionSGD +=  $value_date_report['commission'];
							$payoutSGD +=  $value_date_report['pay_for_sales'];
								
						}
						if($value_date_report['currency'] == "THB"){
							
							if($value_date_report['invoice_status'] == "Paid"){
								
								$sumAmountReceivedTHB += $value_date_report['invoice_amount_received'];
								if($value_date_report['commisson_payment_status'] == "Paid"){
									$commissionPaymentTHB +=  $value_date_report['commission'] - $value_date_report['pay_for_sales'];
								}else{
									$commissionPaymentTHB += $value_date_report['commission'];
								}
							}		
							$sumtotalTHB +=  (($value_date_report['total_sales']-$value_date_report['shipping_cost'])-$value_date_report['creditcard_feecost']);
							
							$sumCommissionPaymaentTHB += $value_date_report['pay_for_sales'];
							$totalcommissionTHB +=  $value_date_report['commission'];
							$payoutTHB +=  $value_date_report['pay_for_sales'];
	
						}
				$currency[] = $value_date_report['currency'];
					
				}

				
					$balanceUSD = number_format($totalcommissionUSD - $payoutUSD , 2);
					$balanceCAD = number_format($totalcommissionCAD - $payoutCAD , 2);
					$balanceSGD = number_format($totalcommissionSGD - $payoutSGD , 2);
					$balanceTHB = number_format($totalcommissionTHB - $payoutTHB , 2);
					
					$number_sumtotalUSD = number_format($sumtotalUSD , 2);
					$number_sumtotalCAD = number_format($sumtotalCAD , 2);
					$number_sumtotalSGD = number_format($sumtotalSGD , 2);
					$number_sumtotalTHB = number_format($sumtotalTHB , 2);
					
					$number_totalcommissionUSD = number_format($totalcommissionUSD , 2);
					$number_totalcommissionCAD = number_format($totalcommissionCAD , 2);
					$number_totalcommissionSGD = number_format($totalcommissionSGD , 2);
					$number_totalcommissionTHB = number_format($totalcommissionTHB , 2);
					
					
					if($sumtotalUSD != 0 || $sumtotalCAD != 0 || $sumtotalSGD != 0 || $sumtotalTHB != 0){ 
					
$html .= '			
	<div >
		<table style="width: 100%;max-width: 100%;margin-bottom: 20px;border-spacing: 0;border-collapse: collapse;border: 1px solid #ddd;border-collapse: initial;">
			<thead style="display: table-header-group;vertical-align: middle;border-color: inherit;">
				<tr>';
					if($sumtotalUSD != 0 ){  
$html .= '				
						<th colspan="3" style="background-color: rgb(0, 65, 121) !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;">
							<span> USD </span>
						</th>';
					}
					if($sumtotalCAD != 0){  	
$html .= '
						<th colspan="3" style="background-color: rgb(0, 65, 121) !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;">
							<span> CAD </span>
						</th>';
					}
					if($sumtotalSGD != 0){  	
$html .= '
						<th colspan="3" style="background-color: rgb(0, 65, 121) !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;">
							<span> SGD </span>
						</th>';
					}
					if($sumtotalTHB != 0){  
$html .= '
						<th colspan="3" style="background-color: rgb(0, 65, 121) !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;">
							<span> THB </span>
						</th>';
					} 
$html .= '
				</tr>
				<tr>';
				if($sumtotalUSD != 0 ){ 
$html .= '							
					<th style="background-color: #012f5d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Total Sales</th>
					<th style="background-color: #012f5d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Total commissions Earned</th>
					<th style="background-color: #012f5d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Balance </th>';
				}
				if($sumtotalCAD != 0){  	
	$html .= '							
					<th style="background-color: #012f5d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Total Sales </th>
					<th style="background-color: #012f5d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Total commissions Earned </th>
					<th style="background-color: #012f5d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Balance </th>';
				}
				if($sumtotalSGD != 0){  		
	$html .= '							
					<th style="background-color: #012f5d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Total Sales </th>
					<th style="background-color: #012f5d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Total commissions Earned </th>
					<th style="background-color: #012f5d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Balance </th>';
				}
				if($sumtotalTHB != 0){ 
	$html .= '							
					<th style="background-color: #012f5d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Total Sales </th>
					<th style="background-color: #012f5d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Total commissions Earned </th>
					<th style="background-color: #012f5d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Balance  </th>';
									} 				
	$html .= '	</tr>
			</thead>
			<tbody>
				<tr>';
				if($sumtotalUSD != 0 ){  
	$html .= '							
					<td style="background-color: #87c1fb !important;border: 1px solid #848d94 !important;color: #001a33;text-align: center;border: 1px solid #ddd;padding:8px;white-space: nowrap;font-weight: bold;"><span>$ '.$number_sumtotalUSD.'</span>
					</td>
					<td style="background-color: #87c1fb !important;border: 1px solid #848d94 !important;color: #001a33;text-align: center;border: 1px solid #ddd;padding:8px;white-space: nowrap;font-weight: bold;"><span>$ '.$number_totalcommissionUSD.'</span>
					</td>
					<td style="background-color: #87c1fb !important;border: 1px solid #848d94 !important;color: #001a33;text-align: center;border: 1px solid #ddd;padding:8px;white-space: nowrap;font-weight: bold;">';
					if($commissionPaymentUSD == 0){
	$html .= '
					<span>$ '.number_format($commissionPaymentUSD , 2).'</span>';
					}else{
	$html .= '		
					<span style="color:#c50202;padding:5px 10px;font-weight: bold;">$ '.number_format($commissionPaymentUSD , 2).'</span>';
					}
	$html .= '		</td>';
					
				}
				if($sumtotalCAD != 0){  	
	$html .= '							
					<td style="background-color: #87c1fb !important;border: 1px solid #848d94 !important;color: #001a33;text-align: center;border: 1px solid #ddd;padding:8px;white-space: nowrap;font-weight: bold;"><span>$ '.$number_sumtotalCAD.'</span>
					</td>
					<td style="background-color: #87c1fb !important;border: 1px solid #848d94 !important;color: #001a33;text-align: center;border: 1px solid #ddd;padding:8px;white-space: nowrap;font-weight: bold;"><span>$ '.$number_totalcommissionCAD.'</span>
					</td>
					<td style="background-color: #87c1fb !important;border: 1px solid #848d94 !important;color: #001a33;text-align: center;border: 1px solid #ddd;padding:8px;white-space: nowrap;font-weight: bold;">';
					if($commissionPaymentCAD == 0){
	$html .= '
					<span>$ '.number_format($commissionPaymentCAD , 2).'</span>';
					}else{
	$html .= '		
					<span style="color:#c50202;padding:5px 10px;font-weight: bold;">$ '.number_format($commissionPaymentCAD , 2).'</span>';
					}
	$html .= '		</td>';
				}
				if($sumtotalSGD != 0){  
	$html .= '									
					<td style="background-color: #87c1fb !important;border: 1px solid #848d94 !important;color: #001a33;text-align: center;border: 1px solid #ddd;padding:8px;white-space: nowrap;font-weight: bold;"><span>$ '.$number_sumtotalSGD.' </span>
					</td>
					<td style="background-color: #87c1fb !important;border: 1px solid #848d94 !important;color: #001a33;text-align: center;border: 1px solid #ddd;padding:8px;white-space: nowrap;font-weight: bold;"><span>$ '.$number_totalcommissionSGD.'</span>
					</td>
					<td style="background-color: #87c1fb !important;border: 1px solid #848d94 !important;color: #001a33;text-align: center;border: 1px solid #ddd;padding:8px;white-space: nowrap;font-weight: bold;;">';
					if($commissionPaymentSGD == 0){
	$html .= '
					<span>$ '.number_format($commissionPaymentSGD , 2).'</span>';
					}else{
	$html .= '		
					<span style="color:#c50202;padding:5px 10px;font-weight: bold;">$ '.number_format($commissionPaymentSGD , 2).'</span>';
					}
	$html .= '		</td>';
				}
				if($sumtotalTHB != 0){  
	$html .= '
					<td style="background-color: #87c1fb !important;border: 1px solid #848d94 !important;color: #001a33;text-align: center;border: 1px solid #ddd;padding:8px;white-space: nowrap;font-weight: bold;"><span>฿ '.$number_sumtotalTHB.'</span>
					</td>
					<td style="background-color: #87c1fb !important;border: 1px solid #848d94 !important;color: #001a33;text-align: center;border: 1px solid #ddd;padding:8px;white-space: nowrap;font-weight: bold;"><span>฿ '.$number_totalcommissionTHB.'</span>
					</td>
					<td style="background-color: #87c1fb !important;border: 1px solid #848d94 !important;color: #001a33;text-align: center;border: 1px solid #ddd;padding:8px;white-space: nowrap;font-weight: bold;">';
					if($commissionPaymentTHB == 0){
	$html .= '
					<span>฿ '.number_format($commissionPaymentTHB , 2).'</span>';
					}else{
	$html .= '		
					<span style="color:#c50202;padding:5px 10px;font-weight: bold;">฿ '.number_format($commissionPaymentTHB , 2).'</span>';
					}
	$html .= '		</td>';
				} 	
	$html .= '		
				</tr>
			</tbody>
		</table>
	</div>	
	<br>
	<hr style=" border: 0;height: 1px;background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));">
	<br>';
					}
	$html .= '					
					
	<div>
		<span>Commission Status : </span>
			
			<img src="images/green.png" class="img-responsive" style="width:8px;" alt="1"> Approved &nbsp; &nbsp; 
			<img src="images/red.png" class="img-responsive" style="width:8px;" alt="1"> Not Approved &nbsp; &nbsp; 
			<img src="images/oragn.png" class="img-responsive" style="width:8px;" alt="1"> Pending &nbsp; &nbsp; 
	</div>
	<div >
		<span>Invoice Status : </span>
			<img src="images/green.png" class="img-responsive" style="width:8px;" alt="1"> Paid &nbsp; &nbsp; 
			<img src="images/red.png" class="img-responsive" style="width:8px;" alt="1"> Outstanding 
	</div>
	<div >
		<span>Invoice Mailing Status : </span>
			<img src="images/mail-s.png" class="img-responsive" style="width:10px;" alt="1"> Sent &nbsp; &nbsp; 
			<img src="images/mail-ns.png" class="img-responsive" style="width:10px;" alt="1"> Not Send  &nbsp; &nbsp; 
		
	</div>
	<br>';
	
	$currency_curr = array_unique ($currency);
		
foreach($currency_curr as $curr){
	if($curr == "USD"){	

$html .= '		
	<div>
		<table style="width: 100%;max-width: 100%;margin-bottom: 20px;border-spacing: 0;border-collapse: collapse;border: 1px solid #ddd;border-collapse: initial;">
			<thead style="display: table-header-group;vertical-align: middle;border-color: inherit;">
				<tr>
					<th colspan = "14" style="background-color:rgb(169, 185, 199);color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> USD  </th>
				</tr>
				<tr>
					
					<th colspan = "4" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Invoice </th>
					<th colspan = "2" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Invoice Payment Status </th>
					
					<th colspan = "" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Position Responsible </th>
					
					<th colspan = "4" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Commission Calculator</th>
					<th colspan = "2" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Commission Payment Status </th>
					
					<th colspan = "" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Update </th>
				</tr>
				
				<tr>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Invoice # </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Order No. </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Order Name </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Date/Quarter </th>
					
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Invoice Status</th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Amount Received</th>
					
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Position</th>
					
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Total Sales </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Commission% </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Commission </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Balance </th>
					
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Commission Status</th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Commission Payment</th>
					
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Last Update </th>
				</tr>
			</thead>
			<tbody>';
			
			$getData = Yii::app()->db->createCommand('select *  from calculator where sales_manager = "'.$sale.'" ORDER BY `date_quarter` ASC, `invoice` ASC')->queryAll();
					
			foreach ($getData as $key => $value) {
				if($value['currency'] ==  $curr ){
	$html .= '							
				<tr>
					<td style="vertical-align: middle;border: 1px solid #ddd;white-space: nowrap;padding:8px">&nbsp;<span>'.$value['invoice'].'</span>';
										
					if($value['invoice_mail_status'] == "Send"){
	$html .= '			&nbsp; <img src="images/mail-s.png" class="img-responsive" style="width:10px;" alt="1">';
					}else{
	$html .= '			
						&nbsp; <img src="images/mail-ns.png" class="img-responsive" style="width:10px;" alt="1"></i>';
					}	
	$html .= '						
					</td>
					<td style="vertical-align: middle;border: 1px solid #ddd;padding:8px">&nbsp;<span>'.$value['order_no'].'</span> ';
										
	$html .= '						
					</td>
					<td style="vertical-align: middle;text-align: left;border: 1px solid #ddd;padding:8px">';
					if($value['invoice_status'] == "Paid"){ 
	$html .= '										
						<img src="images/green.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
						
					}elseif($value['invoice_status'] == "Outstanding"){ 
	$html .= '									
						<img src="images/red.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
					}	
	$html .= '					
					<span>'.$value['order_name'].'</span>
					</td>';
					
					$_month_name = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
										 "04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
										 "07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
										 "10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
										 
					$vardate= $value['date_quarter'];
					
					list($year,$momth,$day) = explode("-",$vardate);
					
					$yy = $year;
					$mm = $momth;
					$dd = $day; 
					
					if ($dd<10){
						$dd=substr($dd,1,2);
					}
					$date= $_month_name[$mm]." ".$dd.",  ".$yy;
					if($mm == "01" || $mm == "02" || $mm == "03"){
						$quarter = "QTR 1";
					}elseif($mm == "04" || $mm == "05" || $mm == "06"){
						$quarter = "QTR 2";
					}elseif($mm == "07" || $mm == "08" || $mm == "09"){
						$quarter = "QTR 3";
					}elseif($mm == "10" || $mm == "11" || $mm == "12"){
						$quarter = "QTR 4";
					}
	$html .= '									
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px"><span>'.$date.'/ <br>'.$quarter.' </span>
					</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px">'; 
						
					if($value['invoice_status'] == "Outstanding"){
	$html .= '			<span style="color:red">'.$value['invoice_status'].'</span>';
					}else{
	$html .= '			<span> '.$value['invoice_status'].'</span>';
					}
	$html .= '									
					</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px">'; 
						
					if($value['invoice_status'] == "Paid"){
						if(!empty($value['invoice_amount_received'])){
	$html .= '			<span > $ '.number_format($value['invoice_amount_received']  , 2).' '.$value['currency'].'</span><br>';
						}
						if($value['invoice_date'] != "0000-00-00"){	
							$_month_name_int = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
								"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
								"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
								"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
												 
							$invoicedate = $value['invoice_date'];
												 
							list($year_int,$momth_int,$day_int) = explode("-",$invoicedate);
												 
							$yy_int = $year_int;
							$mm_int = $momth_int;
							$dd_int = $day_int; 
							
							if ($dd_int < 10){
								$dd_int = substr($dd_int,1,2);
							}
							
							$date_int = $_month_name_int[$mm_int]." ".$dd_int.",  ".$yy_int;
							
		$html .= '			<span style="font-size:11px">(Date : '.$date_int.')</span><br>';
						}					
					}
	$html .= '									
					</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px">';
										
						if($value['sales_status'] == "1"){
										
	$html .= '				<span style=\"font-weight: bold;\">Sales Manager</span>';
						}elseif($value['sales_status'] == "2"){
	$html .= '				<span style=\"font-weight: bold;\">Sales Rep</span>';						
						}
	$html .= '		</td>
					<td style="vertical-align: middle;text-align: left;border: 1px solid #ddd;white-space: nowrap;padding:8px">';
										
						$totalsale = (($value['total_sales'] - $value['shipping_cost']) - $value['creditcard_feecost']);
						if($value['total_sales']  != 0){
							if($value['status_commission'] == "Approved"){
										
	$html .= '					
								<img src="images/green.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
							}elseif($value['status_commission'] == "Not Approved"){
	$html .= '					<img src="images/red.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
							}else{
	$html .= '					<img src="images/oragn.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
							}
	$html .= '					<span>$ '.number_format($totalsale , 2).' '.$value['currency'].'</span>';
							
						}else{
	$html .= '						';
						}
	$html .= '		</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px" >';
					
					if($value['total_sales'] != 0){
					
	$html .= '			<span>'.$value['commission_percent'].'%</span>';
					}
	$html .= '		</td>
					<td style="vertical-align: middle;text-align: left;border: 1px solid #ddd;white-space: nowrap;padding:8px">';
					
					if($value['commission'] != 0){
						
	$html .= '			<span>$ '.number_format($value['commission'] , 2).' '.$value['currency'].'<span>';
					}
	$html .= '		</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px">';
						
						if($value['invoice_status'] == "Paid"){
							if($value['commisson_payment_status'] == "Paid"){
												
								$balance_invoice = $value['commission'] - $value['pay_for_sales'];
								if($balance_invoice != 0 ){
		$html .= '					<span style="color:red"> $ '.number_format($balance_invoice  , 2).' '.$value['currency'].'</span>';
								}else{
		$html .= '					<span> $ '.number_format($balance_invoice  , 2).' '.$value['currency'].'</span>';
								}
												
							}else{
								if($totalsale  != 0){
		$html .= '					<span style="color:red"> $ '.number_format($value['commission'] , 2).' '.$value['currency'].'</span>';
								}
							}
						}
	$html .= '	
					</td>
					
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px">'; 
						
					if($value['commisson_payment_status'] == "Outstanding"){
	$html .= '			<span style="color:red">'.$value['commisson_payment_status'].'</span>';
					}else{
	$html .= '			<span> '.$value['commisson_payment_status'].'</span>';
					}
	$html .= '									
					</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px">'; 
					
					if($value['commisson_payment_status'] == "Paid"){
	$html .= '			<span > $ '.number_format($value['pay_for_sales']  , 2).' '.$value['currency'].'</span><br>';
						
						if($value['date_for_sales'] != "0000-00-00" ){ 	
							$_month_name_comm = array("01"=>"January",  "02"=>"February",  "03"=>"March",    
								"04"=>"April",  "05"=>"May",  "06"=>"June",    
								"07"=>"July",  "08"=>"August",  "09"=>"September",    
								"10"=>"October", "11"=>"November",  "12"=>"December"); 
												 
							$commissiondate = $value['date_for_sales'];
												 
							list($year_comm,$momth_comm,$day_comm) = explode("-",$commissiondate);
												  
							$yy_comm = $year_comm;
							$mm_comm = $momth_comm;
							$dd_comm = $day_comm; 
												
							if ($dd_comm < 10){
								$dd_comm = substr($dd_comm,1,2);
							}
							$date_comm = $_month_name_comm[$mm_comm]." ".$dd_comm.",  ".$yy_comm;
												  
		$html .= '			<span style="font-size:11px">(Date : '.$date_comm.')</span><br>';
						}
					}
	$html .= '									
					</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px;">'; 
					if($value['update_date'] != "0000-00-00" ){ 
						$_month_name = array("01"=>"January", "02"=>"February", "03"=>"March","04"=>"April", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December"); 
																								 
						list($year,$momth,$day) = explode("-",$value['update_date']);
																					
						if ($day < 10){
							$day = substr($day,1,2);
						}
															
						$date = $_month_name[$momth]." ".$day.",  ".$year;
												
	$html .= '			<span style="font-size:12px;">'.$date.'</span>';
											
					}else{
						$date = " ";
												
	$html .= '			<span style="font-size:12px;">'.$date.'</span>';
					}	
	$html .= '
					</td>
									
				</tr>
				<tr style="background-color: #f9e1bc;">
					<td>Comments : </td>
					<td colspan="13" style="vertical-align: middle;text-align: left;border: 1px solid #ddd;white-space: pre;word-wrap:break-word;padding:8px;">
						<span>';  
										
						$comments = Yii::app()->db->createCommand()
							->select('*')
							->from('comments com')
							->where('com.invoice = "'.$value['id'].'"')
							->order('com.date_comments DESC')
							->limit('1')
							->queryAll();
												
							foreach ($comments as $key_co => $value_co) {
								if($value_co['user_group']== "1"){
	$html .= '						JOG : ';
								}elseif($value_co['user_group']== "2"){
	$html .= '						Sale : ';
								}		
	$html .= '						'.nl2br($value_co['comments']);
							}	
	$html .= '									 
					</span></td>
				</tr>';
			} }	
			if($sumtotalUSD != 0 ){
	$html .= '
				<tr style="background-color: #c1ffe6;">
					<td colspan="5"></td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">
						<span style="font-weight: bold;">$ '.number_format($sumAmountReceivedUSD , 2).' USD  </span>
					</td>
					<td colspan=""></td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">
						<span style="font-weight: bold;">$ '.number_format($sumtotalUSD , 2).' USD  </span>
					</td>
					<td></td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">
						<span style="font-weight: bold;">$ '.number_format($totalcommissionUSD , 2).' USD</span>									  
					</td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">';
						if($commissionPaymentUSD == 0){	
	$html .= '				<span style="font-weight: bold;">$ '.number_format($commissionPaymentUSD , 2).' USD</span>';
						}else{ 
	$html .= '				<span style="color:red;padding:5px 10px;font-weight: bold;">$ '.number_format($commissionPaymentUSD , 2).' USD</span>';
						} 
	$html .= '		</td>
					<td></td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">';
						if(!empty($sumCommissionPaymaentUSD)){	
	$html .= '				<span style="font-weight: bold;">$ '.number_format($sumCommissionPaymaentUSD , 2).' USD</span>';
						} 
	$html .= '		</td>
					
					<td></td>					
				</tr>';
			} 
	$html .= '						
			</tbody>
		</table>
	</div>
	<br>';
	
	}
}
foreach($currency_curr as $curr){
	if($curr == "CAD"){	
		
$html .= '		
	
	<div>
		<table style="width: 100%;max-width: 100%;margin-bottom: 20px;border-spacing: 0;border-collapse: collapse;border: 1px solid #ddd;border-collapse: initial;">
			<thead style="display: table-header-group;vertical-align: middle;border-color: inherit;">
				<tr>
					<th colspan = "14" style="background-color:rgb(169, 185, 199);color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> CAD  </th>
				</tr>
				<tr>
					
					<th colspan = "4" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Invoice </th>
					<th colspan = "2" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Invoice Payment Status </th>
					
					<th colspan = "" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Position Responsible </th>
					
					<th colspan = "4" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Commission Calculator</th>
					<th colspan = "2" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Commission Payment Status </th>
					
					
					<th colspan = "" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Update </th>
				</tr>
				
				<tr>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Invoice # </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Order No. </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Order Name </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Date/Quarter </th>
					
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Invoice Status</th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Amount Received</th>
					
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Position </th>
					
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Total Sales </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Commission% </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Commission </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Balance </th>
					
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Commission Status</th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Commission Payment</th>
					
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Last Update </th>
				</tr>
			</thead>
			<tbody>';
			
			$getData = Yii::app()->db->createCommand('select *  from calculator where sales_manager = "'.$sale.'" ORDER BY `date_quarter` ASC, `invoice` ASC')->queryAll();
					
			foreach ($getData as $key => $value) {
				if($value['currency'] ==  $curr ){
	$html .= '							
				<tr>
					<td style="vertical-align: middle;border: 1px solid #ddd;white-space: nowrap;padding:8px;">&nbsp;<span>'.$value['invoice'].'</span>';
										
					if($value['invoice_mail_status'] == "Send"){
	$html .= '			&nbsp; <img src="images/mail-s.png" class="img-responsive" style="width:10px;" alt="1">';
					}else{
	$html .= '			
						&nbsp; <img src="images/mail-ns.png" class="img-responsive" style="width:10px;" alt="1"></i>';
					}	
	$html .= '						
					</td>
					<td style="vertical-align: middle;border: 1px solid #ddd;white-space: nowrap;padding:8px;">&nbsp;
						<span>'.$value['order_no'].'</span>
					</td>
					<td style="vertical-align: middle;text-align: left;border: 1px solid #ddd;white-space: nowrap;padding:8px;">';
					if($value['invoice_status'] == "Paid"){ 
	$html .= '										
						<img src="images/green.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
						
					}elseif($value['invoice_status'] == "Outstanding"){ 
	$html .= '									
						<img src="images/red.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
					}	
	$html .= '					
					<span>'.$value['order_name'].'</span>
					</td>';
					
					$_month_name = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
										 "04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
										 "07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
										 "10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
										 
					$vardate= $value['date_quarter'];
					
					list($year,$momth,$day) = explode("-",$vardate);
					
					$yy = $year;
					$mm = $momth;
					$dd = $day; 
					
					if ($dd<10){
						$dd=substr($dd,1,2);
					}
					$date= $_month_name[$mm]." ".$dd.",  ".$yy;
					if($mm == "01" || $mm == "02" || $mm == "03"){
						$quarter = "QTR 1";
					}elseif($mm == "04" || $mm == "05" || $mm == "06"){
						$quarter = "QTR 2";
					}elseif($mm == "07" || $mm == "08" || $mm == "09"){
						$quarter = "QTR 3";
					}elseif($mm == "10" || $mm == "11" || $mm == "12"){
						$quarter = "QTR 4";
					}
	$html .= '									
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px;"><span>'.$date.'/ <br>'.$quarter.'</span> 
					</td>
					
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px;">'; 
						
					if($value['invoice_status'] == "Outstanding"){
	$html .= '			<span style="color:red">'.$value['invoice_status'].'</span>';
					}else{
	$html .= '			<span> '.$value['invoice_status'].'</span>';
					}
	$html .= '									
					</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px;">'; 
						
					if($value['invoice_status'] == "Paid"){
						if(!empty($value['invoice_amount_received'])){
	$html .= '			<span > $ '.number_format($value['invoice_amount_received']  , 2).' '.$value['currency'].'</span><br>';
						}
						if($value['invoice_date'] != "0000-00-00"){		
							$_month_name_int = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
								"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
								"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
								"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
												 
							$invoicedate = $value['invoice_date'];
												 
							list($year_int,$momth_int,$day_int) = explode("-",$invoicedate);
												 
							$yy_int = $year_int;
							$mm_int = $momth_int;
							$dd_int = $day_int; 
							
							if ($dd_int < 10){
								$dd_int = substr($dd_int,1,2);
							}
							
							$date_int = $_month_name_int[$mm_int]." ".$dd_int.",  ".$yy_int;
							
		$html .= '			<span style="font-size:11px">(Date : '.$date_int.')</span><br>';
						}					
					}
	$html .= '									
					</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px">';
										
						if($value['sales_status'] == "1"){
										
	$html .= '				<span style=\"font-weight: bold;\">Sales Manager</span>';
						}elseif($value['sales_status'] == "2"){
	$html .= '				<span style=\"font-weight: bold;\">Sales Rep</span>';						
						}
	$html .= '		</td>
					<td style="vertical-align: middle;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px">';
										
						$totalsale = (($value['total_sales'] - $value['shipping_cost']) - $value['creditcard_feecost']);
						if($value['total_sales']  != 0){
							if($value['status_commission'] == "Approved"){
										
	$html .= '					
								<img src="images/green.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
							}elseif($value['status_commission'] == "Not Approved"){
	$html .= '					<img src="images/red.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
							}else{
	$html .= '					<img src="images/oragn.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
							}
	$html .= '					<span>$ '.number_format($totalsale , 2).' '.$value['currency'].'</span>';
							
						}else{
	$html .= '						';
						}
	$html .= '		</td>
					
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px;" >';
						if($value['total_sales'] != 0){
	$html .= '				<span>'.$value['commission_percent'].'%</span>';
						}
	$html .= '				</td>
					<td style="vertical-align: middle;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">';
						if($value['total_sales'] != 0){
	$html .= '				<span>$ '.number_format($value['commission'] , 2).' '.$value['currency'].'</span>';
						}
	$html .= '		</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px;">';
						if($value['invoice_status'] == "Paid"){
							if($value['commisson_payment_status'] == "Paid"){
												
								$balance_invoice = $value['commission'] - $value['pay_for_sales'];
								if($balance_invoice != 0 ){
		$html .= '					<span style="color:red"> $ '.number_format($balance_invoice  , 2).' '.$value['currency'].'</span>';
								}else{
		$html .= '					<span> $ '.number_format($balance_invoice  , 2).' '.$value['currency'].'</span>';
								}
												
							}else{
								if($totalsale  != 0){
		$html .= '					<span style="color:red"> $ '.number_format($value['commission'] , 2).' '.$value['currency'].'</span>';
								}
							}
						}
	$html .= '	
					</td>
					
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px;">'; 
						
					if($value['commisson_payment_status'] == "Outstanding"){
	$html .= '			<span style="color:red">'.$value['commisson_payment_status'].'</span>';
					}else{
	$html .= '			<span> '.$value['commisson_payment_status'].'</span>';
					}
	$html .= '									
					</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px;">'; 
					
					if($value['commisson_payment_status'] == "Paid"){
	$html .= '			<span > $ '.number_format($value['pay_for_sales']  , 2).' '.$value['currency'].'</span><br>';
						
						if($value['date_for_sales'] != "0000-00-00" ){ 	
							$_month_name_comm = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
								"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
								"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
								"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
												 
							$commissiondate = $value['date_for_sales'];
												 
							list($year_comm,$momth_comm,$day_comm) = explode("-",$commissiondate);
												  
							$yy_comm = $year_comm;
							$mm_comm = $momth_comm;
							$dd_comm = $day_comm; 
												
							if ($dd_comm < 10){
								$dd_comm = substr($dd_comm,1,2);
							}
							$date_comm = $_month_name_comm[$mm_comm]." ".$dd_comm.",  ".$yy_comm;
												  
		$html .= '			<span style="font-size:11px">(Date : '.$date_comm.')</span><br>';
						}
					}
	$html .= '									
					</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px;">'; 
					if($value['update_date'] != "0000-00-00" ){ 
						$_month_name = array("01"=>"January", "02"=>"February", "03"=>"March","04"=>"April", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December"); 
																								 
						list($year,$momth,$day) = explode("-",$value['update_date']);
																					
						if ($day < 10){
							$day = substr($day,1,2);
						}
															
						$date = $_month_name[$momth]." ".$day.",  ".$year;
												
	$html .= '			<span style="font-size:12px;">'.$date.'</span>';
											
					}else{
						$date = " ";
												
	$html .= '			<span style="font-size:12px;">'.$date.'</span>';
					}	
	$html .= '
					</td>
									
				</tr>
				<tr style="background-color: #f9e1bc;">
					<td>Comments : </td>
					<td colspan="13" style="vertical-align: middle;text-align: left;border: 1px solid #ddd;white-space: pre;word-wrap:break-word;padding:8px;">
						<span>';  
										
						$comments = Yii::app()->db->createCommand()
							->select('*')
							->from('comments com')
							->where('com.invoice = "'.$value['id'].'"')
							->order('com.date_comments DESC')
							->limit('1')
							->queryAll();
												
							foreach ($comments as $key_co => $value_co) {
								if($value_co['user_group']== "1"){
	$html .= '						JOG : ';
								}elseif($value_co['user_group']== "2"){
	$html .= '						Sale : ';
								}		
	$html .= '						'.nl2br($value_co['comments']);
							}	
	$html .= '									 
					</span></td>
				</tr>';
			} }	
			if($sumtotalCAD != 0 ){
	$html .= '
				<tr style="background-color: #c1ffe6;">
					<td colspan="5"></td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">
						<span style="font-weight: bold;">$ '.number_format($sumAmountReceivedCAD , 2).' CAD  </span>
					</td>
					<td colspan=""></td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">
						<span style="font-weight: bold;">$ '.number_format($sumtotalCAD , 2).' CAD  </span>
					</td>
					<td></td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">
						<span style="font-weight: bold;">$ '.number_format($totalcommissionCAD , 2).' CAD</span>									  
					</td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">';
						if($commissionPaymentCAD == 0){	
	$html .= '				<span style="font-weight: bold;">$ '.number_format($commissionPaymentCAD , 2).' CAD</span>';
						}else{ 
	$html .= '				<span style="color:red;padding:5px 10px;font-weight: bold;">$ '.number_format($commissionPaymentCAD , 2).' CAD</span>';
						} 
	$html .= '		</td>
					<td></td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">';
						if(!empty($sumCommissionPaymaentCAD)){	
	$html .= '				<span style="font-weight: bold;">$ '.number_format($sumCommissionPaymaentCAD , 2).' CAD</span>';
						} 
	$html .= '		</td>					
								
					<td></td>			
				</tr>';
			} 
	$html .= '						
			</tbody>
		</table>
	</div>
	<br>';
	
	}
}	
foreach($currency_curr as $curr){
	if($curr == "SGD"){
			
$html .= '	
	<div>
		<table style="width: 100%;max-width: 100%;margin-bottom: 20px;border-spacing: 0;border-collapse: collapse;border: 1px solid #ddd;border-collapse: initial;">	
			<thead style="display: table-header-group;vertical-align: middle;border-color: inherit;">
				<tr>
					<th colspan = "14" style="background-color:rgb(169, 185, 199);color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> SGD  </th>
				</tr>
				<tr>
					
					<th colspan = "4" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Invoice </th>
					<th colspan = "2" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Invoice Payment Status </th>
					<th colspan = "" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Position Responsible </th>
					
					<th colspan = "4" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Commission Calculator</th>
					<th colspan = "2" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Commission Payment Status </th>
					
					<th colspan = "" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Update </th>
				</tr>
				
				<tr>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Invoice # </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Order No. </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Order Name </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Date/Quarter </th>
					
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Invoice Status</th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Amount Received</th>
					
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Position </th>
					
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Total Sales </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Commission% </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Commission </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Balance </th>
					
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Commission Status</th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Commission Payment</th>
					
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Last Update </th>
				</tr>
			</thead>
			<tbody>';
			
			$getData = Yii::app()->db->createCommand('select *  from calculator where sales_manager = "'.$sale.'" ORDER BY `date_quarter` ASC, `invoice` ASC')->queryAll();
					
			foreach ($getData as $key => $value) {
				if($value['currency'] ==  $curr ){
	$html .= '							
				<tr>
					<td style="vertical-align: middle;border: 1px solid #ddd;white-space: nowrap;">&nbsp;<span>'.$value['invoice'].' </span>';
										
					if($value['invoice_mail_status'] == "Send"){
	$html .= '			&nbsp; <img src="images/mail-s.png" class="img-responsive" style="width:10px;" alt="1">';
					}else{
	$html .= '			
						&nbsp; <img src="images/mail-ns.png" class="img-responsive" style="width:10px;" alt="1"></i>';
					}	
	$html .= '						
					</td>
					<td style="vertical-align: middle;border: 1px solid #ddd;white-space: nowrap;">&nbsp;
						<span>'.$value['order_no'].' </span>
					</td>
					<td style="vertical-align: middle;text-align: left;border: 1px solid #ddd;white-space: nowrap;">';
					if($value['invoice_status'] == "Paid"){ 
	$html .= '										
						<img src="images/green.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
						
					}elseif($value['invoice_status'] == "Outstanding"){ 
	$html .= '									
						<img src="images/red.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
					}		
	$html .= '					
					<span>'.$value['order_name'].'</span>
					</td>';
					
					$_month_name = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
										 "04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
										 "07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
										 "10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
										 
					$vardate= $value['date_quarter'];
					
					list($year,$momth,$day) = explode("-",$vardate);
					
					$yy = $year;
					$mm = $momth;
					$dd = $day; 
					
					if ($dd<10){
						$dd=substr($dd,1,2);
					}
					$date= $_month_name[$mm]." ".$dd.",  ".$yy;
					if($mm == "01" || $mm == "02" || $mm == "03"){
						$quarter = "QTR 1";
					}elseif($mm == "04" || $mm == "05" || $mm == "06"){
						$quarter = "QTR 2";
					}elseif($mm == "07" || $mm == "08" || $mm == "09"){
						$quarter = "QTR 3";
					}elseif($mm == "10" || $mm == "11" || $mm == "12"){
						$quarter = "QTR 4";
					}
	$html .= '									
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;"><span>'.$date.'/ <br>'.$quarter.' 
					</span></td>
					
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;">'; 
						
					if($value['invoice_status'] == "Outstanding"){
	$html .= '			<span style="color:red">'.$value['invoice_status'].'</span>';
					}else{
	$html .= '			<span> '.$value['invoice_status'].'</span>';
					}
	$html .= '									
					</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;">'; 
						
					if($value['invoice_status'] == "Paid"){
						if(!empty($value['invoice_amount_received'])){
	$html .= '			<span > $ '.number_format($value['invoice_amount_received']  , 2).' '.$value['currency'].'</span><br>';
						}
						if($value['invoice_date'] != "0000-00-00"){	
							$_month_name_int = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
								"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
								"07"=>"Jul.",  "08"=>"Aug.t",  "09"=>"Sep.",    
								"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
												 
							$invoicedate = $value['invoice_date'];
												 
							list($year_int,$momth_int,$day_int) = explode("-",$invoicedate);
												 
							$yy_int = $year_int;
							$mm_int = $momth_int;
							$dd_int = $day_int; 
							
							if ($dd_int < 10){
								$dd_int = substr($dd_int,1,2);
							}
							
							$date_int = $_month_name_int[$mm_int]." ".$dd_int.",  ".$yy_int;
							
		$html .= '			<span style="font-size:11px">(Date : '.$date_int.')</span><br>';
						}					
					}
	$html .= '									
					</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px">';
										
						if($value['sales_status'] == "1"){
										
	$html .= '				<span style=\"font-weight: bold;\">Sales Manager</span>';
						}elseif($value['sales_status'] == "2"){
	$html .= '				<span style=\"font-weight: bold;\">Sales Rep</span>';						
						}
	$html .= '		</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;">';
										
						$totalsale = (($value['total_sales'] - $value['shipping_cost']) - $value['creditcard_feecost']);
						
						if($value['total_sales']  != 0){
							if($value['status_commission'] == "Approved"){
										
	$html .= '					
								<img src="images/green.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
							}elseif($value['status_commission'] == "Not Approved"){
	$html .= '					<img src="images/red.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
							}else{
	$html .= '					<img src="images/oragn.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
							}
	$html .= '					<span>$ '.number_format($totalsale , 2).' '.$value['currency'].'</span>';
							
						}else{
	$html .= '						';
						}
	$html .= '		</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;" >';
						if($value['total_sales'] != 0){
	$html .= '				<span>'.$value['commission_percent'].'%</span>';
						}
	$html .= '		</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;">';
						if($value['total_sales'] != 0){
	$html .= '				<span>$ '.number_format($value['commission'] , 2).' '.$value['currency'].'</span>';
						}
	$html .= '		</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;">';
						if($value['invoice_status'] == "Paid"){
							if($value['commisson_payment_status'] == "Paid"){
												
								$balance_invoice = $value['commission'] - $value['pay_for_sales'];
								if($balance_invoice != 0 ){
		$html .= '					<span style="color:red"> $ '.number_format($balance_invoice  , 2).' '.$value['currency'].'</span>';
								}else{
		$html .= '					<span> $ '.number_format($balance_invoice  , 2).' '.$value['currency'].'</span>';
								}
												
							}else{
								if($totalsale  != 0){	
		$html .= '					<span style="color:red"> $ '.number_format($value['commission'] , 2).' '.$value['currency'].'</span>';
								}
							}	
						}
	$html .= '	
					</td>
					
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;">'; 
						
					if($value['commisson_payment_status'] == "Outstanding"){
	$html .= '			<span style="color:red">'.$value['commisson_payment_status'].'</span>';
					}else{
	$html .= '			<span> '.$value['commisson_payment_status'].'</span>';
					}
	$html .= '									
					</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;">'; 
					
					if($value['commisson_payment_status'] == "Paid"){
	$html .= '			<span > $ '.number_format($value['pay_for_sales']  , 2).' '.$value['currency'].'</span><br>';
						
						if($value['date_for_sales'] != "0000-00-00" ){ 	
							$_month_name_comm = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
								"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.e",    
								"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
								"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
												 
							$commissiondate = $value['date_for_sales'];
												 
							list($year_comm,$momth_comm,$day_comm) = explode("-",$commissiondate);
												  
							$yy_comm = $year_comm;
							$mm_comm = $momth_comm;
							$dd_comm = $day_comm; 
												
							if ($dd_comm < 10){
								$dd_comm = substr($dd_comm,1,2);
							}
							$date_comm = $_month_name_comm[$mm_comm]." ".$dd_comm.",  ".$yy_comm;
												  
		$html .= '			<span style="font-size:11px">(Date : '.$date_comm.')</span><br>';
						}
					}
	$html .= '									
					</td>
					
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;">'; 
					if($value['update_date'] != "0000-00-00" ){ 
						$_month_name = array("01"=>"Jan.", "02"=>"Feb.", "03"=>"Mar.","04"=>"Apr.", "05"=>"May.", "06"=>"Jun.", "07"=>"Jul.", "08"=>"Aug.", "09"=>"Sep.", "10"=>"Oct.", "11"=>"Nov.", "12"=>"Dec."); 
																								 
						list($year,$momth,$day) = explode("-",$value['update_date']);
																					
						if ($day < 10){
							$day = substr($day,1,2);
						}
															
						$date = $_month_name[$momth]." ".$day.",  ".$year;
												
	$html .= '			<span style="font-size:12px;">'.$date.'</span>';
											
					}else{
						$date = " ";
												
	$html .= '			<span style="font-size:12px;">'.$date.'</span>';
					}	
	$html .= '
					</td>
									
				</tr>
				<tr style="background-color: #f9e1bc;">
					<td>Comments : </td>
					<td colspan="13" style="vertical-align: middle;text-align: left;border: 1px solid #ddd;white-space: pre;word-wrap:break-word;padding:8px;">
						<span>';  
										
						$comments = Yii::app()->db->createCommand()
							->select('*')
							->from('comments com')
							->where('com.invoice = "'.$value['id'].'"')
							->order('com.date_comments DESC')
							->limit('1')
							->queryAll();
												
							foreach ($comments as $key_co => $value_co) {
								if($value_co['user_group']== "1"){
	$html .= '						JOG : ';
								}elseif($value_co['user_group']== "2"){
	$html .= '						Sale : ';
								}		
	$html .= '						'.nl2br($value_co['comments']);
							}	
	$html .= '									 
					</span></td>
				</tr>
				';
			} }
if($sumtotalSGD != 0 ){
	$html .= '
				<tr style="background-color: #c1ffe6;">
					<td colspan="5"></td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">
						<span style="font-weight: bold;">$ '.number_format($sumAmountReceivedSGD , 2).' SGD  </span>
					</td>
					<td colspan=""></td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">
						<span style="font-weight: bold;">$ '.number_format($sumtotalSGD , 2).' SGD  </span>
					</td>
					<td></td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">
						<span style="font-weight: bold;">$ '.number_format($totalcommissionSGD , 2).' SGD</span>									  
					</td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">';
						if($commissionPaymentSGD == 0){	
	$html .= '				<span style="font-weight: bold;">$ '.number_format($commissionPaymentSGD , 2).' SGD</span>';
						}else{ 
	$html .= '				<span style="color:red;padding:5px 10px;font-weight: bold;">$ '.number_format($commissionPaymentSGD , 2).' SGD</span>';
						} 
	$html .= '		</td>
					<td></td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">';
						if(!empty($sumCommissionPaymaentSGD)){	
	$html .= '				<span style="font-weight: bold;">$ '.number_format($sumCommissionPaymaentSGD , 2).' SGD</span>';
						} 
	$html .= '		</td>
								
					<td></td>			
				</tr>';
			} 			
	$html .= '						
			</tbody>
		</table>
	</div>	
	<br>';
	
		}
	}	
	foreach($currency_curr as $curr){
		if($curr == "THB"){	
		
$html .= '		
	<div>
		<table style="width: 100%;max-width: 100%;margin-bottom: 20px;border-spacing: 0;border-collapse: collapse;border: 1px solid #ddd;border-collapse: initial;">
			<thead style="display: table-header-group;vertical-align: middle;border-color: inherit;">
				<tr>
					<th colspan = "14" style="background-color:rgb(169, 185, 199);color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> THB  </th>
				</tr>
				<tr>
					
					<th colspan = "4" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Invoice </th>
					<th colspan = "2" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Invoice Payment Status </th>
					
					<th colspan = "" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Position Responsible </th>
					
					<th colspan = "4" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Commission Calculator</th>
					<th colspan = "2" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Commission Payment Status </th>
					
					
					<th colspan = "" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Update </th>
				</tr>
				
				<tr>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Invoice # </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Order No. </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Order Name </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Date/Quarter </th>
					
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Invoice Status</th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Amount Received</th>
					
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Position </th>
					
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Total Sales </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Commission% </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Commission </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Balance </th>
					
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Commission Status</th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Commission Payment</th>
					
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Last Update </th>
				</tr>
			</thead>
			<tbody>';
			
			$getData = Yii::app()->db->createCommand('select *  from calculator where sales_manager = "'.$sale.'" ORDER BY `date_quarter` ASC, `invoice` ASC')->queryAll();
					
			foreach ($getData as $key => $value) {
				if($value['currency'] ==  $curr ){
	$html .= '							
				<tr>
					<td style="vertical-align: middle;border: 1px solid #ddd;white-space: nowrap;">&nbsp;'.$value['invoice'].' <i class="fa fa-file-text-o" aria-hidden="true"></i>';
										
					if($value['invoice_mail_status'] == "Send"){
	$html .= '			&nbsp; <img src="images/mail-s.png" class="img-responsive" style="width:10px;" alt="1">';
					}else{
	$html .= '			
						&nbsp; <img src="images/mail-ns.png" class="img-responsive" style="width:10px;" alt="1"></i>';
					}	
	$html .= '						
					</td>
					<td style="vertical-align: middle;border: 1px solid #ddd;white-space: nowrap;">&nbsp;
						<span>'.$value['order_no'].'</span> 		
					</td>
					<td style="vertical-align: middle;text-align: left;border: 1px solid #ddd;white-space: nowrap;">';
					if($value['invoice_status'] == "Paid"){ 
	$html .= '										
						<img src="images/green.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
						
					}elseif($value['invoice_status'] == "Outstanding"){ 
	$html .= '									
						<img src="images/red.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
					}	
	$html .= '					
					<span>'.$value['order_name'].'</span>
					</td>';
					
					$_month_name = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
										 "04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
										 "07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
										 "10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
										 
					$vardate= $value['date_quarter'];
					
					list($year,$momth,$day) = explode("-",$vardate);
					
					$yy = $year;
					$mm = $momth;
					$dd = $day; 
					
					if ($dd<10){
						$dd=substr($dd,1,2);
					}
					$date= $_month_name[$mm]." ".$dd.",  ".$yy;
					if($mm == "01" || $mm == "02" || $mm == "03"){
						$quarter = "QTR 1";
					}elseif($mm == "04" || $mm == "05" || $mm == "06"){
						$quarter = "QTR 2";
					}elseif($mm == "07" || $mm == "08" || $mm == "09"){
						$quarter = "QTR 3";
					}elseif($mm == "10" || $mm == "11" || $mm == "12"){
						$quarter = "QTR 4";
					}
	$html .= '									
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;">'.$date.'/ <br>'.$quarter.' 
					</td>
					
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;">'; 
						
					if($value['invoice_status'] == "Outstanding"){
	$html .= '			<span style="color:red">'.$value['invoice_status'].'</span>';
					}else{
	$html .= '			<span> '.$value['invoice_status'].'</span>';
					}
	$html .= '									
					</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;">'; 
						
					if($value['invoice_status'] == "Paid"){
						if(!empty($value['invoice_amount_received'])){
	$html .= '			<span > ฿ '.number_format($value['invoice_amount_received']  , 2).' '.$value['currency'].'</span><br>';
						}
						if($value['invoice_date'] != "0000-00-00"){	
							$_month_name_int = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
								"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
								"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
								"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
												 
							$invoicedate = $value['invoice_date'];
												 
							list($year_int,$momth_int,$day_int) = explode("-",$invoicedate);
												 
							$yy_int = $year_int;
							$mm_int = $momth_int;
							$dd_int = $day_int; 
							
							if ($dd_int < 10){
								$dd_int = substr($dd_int,1,2);
							}
							
							$date_int = $_month_name_int[$mm_int]." ".$dd_int.",  ".$yy_int;
							
		$html .= '			<span style="font-size:11px">(Date : '.$date_int.')</span><br>';
						}					
					}
	$html .= '									
					</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px">';
										
						if($value['sales_status'] == "1"){
										
	$html .= '				<span style=\"font-weight: bold;\">Sales Manager</span>';
						}elseif($value['sales_status'] == "2"){
	$html .= '				<span style=\"font-weight: bold;\">Sales Rep</span>';						
						}
	$html .= '		</td>
					
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;">';
										
						$totalsale = (($value['total_sales'] - $value['shipping_cost']) - $value['creditcard_feecost']);
							if($value['total_sales']  != 0){
							if($value['status_commission'] == "Approved"){
										
	$html .= '					
								<img src="images/green.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
							}elseif($value['status_commission'] == "Not Approved"){
	$html .= '					<img src="images/red.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
							}else{
	$html .= '					<img src="images/oragn.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
							}
	$html .= '					<span>฿ '.number_format($totalsale , 2).' '.$value['currency'].'</span>';
							
						}else{
	$html .= '						';
						}
	$html .= '		</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;" >';
						if($value['total_sales'] != 0){
	$html .= '			'.$value['commission_percent'].'%';
						}	
	$html .= '		</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;">';
						if($value['commission']  != 0){	
	$html .= '					฿ '.number_format($value['commission'] , 2).' '.$value['currency'];
						}
	$html .= '		</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;">';
						if($value['invoice_status'] == "Paid"){
							if($value['commisson_payment_status'] == "Paid"){
												
								$balance_invoice = $value['commission'] - $value['pay_for_sales'];
								if($balance_invoice != 0 ){
		$html .= '					<span style="color:red"> ฿ '.number_format($balance_invoice  , 2).' '.$value['currency'].'</span>';
								}else{
		$html .= '					<span> ฿ '.number_format($balance_invoice  , 2).' '.$value['currency'].'</span>';
								}
												
							}else{
								if($totalsale  != 0){	
		$html .= '				<span style="color:red"> ฿ '.number_format($value['commission'] , 2).' '.$value['currency'].'</span>';
								}
							}
						}
	$html .= '	
					</td>
					
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;">'; 
						
					if($value['commisson_payment_status'] == "Outstanding"){
	$html .= '			<span style="color:red">'.$value['commisson_payment_status'].'</span>';
					}else{
	$html .= '			<span> '.$value['commisson_payment_status'].'</span>';
					}
	$html .= '									
					</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;">'; 
					
					if($value['commisson_payment_status'] == "Paid"){
	$html .= '			<span > ฿ '.number_format($value['pay_for_sales']  , 2).' '.$value['currency'].'</span><br>';
						
						
						if($value['date_for_sales'] != "0000-00-00" ){ 	
							$_month_name_comm = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
								"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
								"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
								"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
												 
							$commissiondate = $value['date_for_sales'];
												 
							list($year_comm,$momth_comm,$day_comm) = explode("-",$commissiondate);
												  
							$yy_comm = $year_comm;
							$mm_comm = $momth_comm;
							$dd_comm = $day_comm; 
												
							if ($dd_comm < 10){
								$dd_comm = substr($dd_comm,1,2);
							}
							$date_comm = $_month_name_comm[$mm_comm]." ".$dd_comm.",  ".$yy_comm;
												  
		$html .= '			<span style="font-size:11px">(Date : '.$date_comm.')</span><br>';
						}
					}
	$html .= '									
					</td>
					
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;">'; 
					if($value['update_date'] != "0000-00-00" ){ 
						$_month_name = array("01"=>"Jan.", "02"=>"Feb.", "03"=>"Mar.","04"=>"Apr.", "05"=>"May.", "06"=>"Jun.", "07"=>"Jul.", "08"=>"Aug.", "09"=>"Sep.", "10"=>"Oct.", "11"=>"Nov.", "12"=>"Dec."); 
																								 
						list($year,$momth,$day) = explode("-",$value['update_date']);
																					
						if ($day < 10){
							$day = substr($day,1,2);
						}
															
						$date = $_month_name[$momth]." ".$day.",  ".$year;
												
	$html .= '			<span style="font-size:12px;">'.$date.'</span>';
											
					}else{
						$date = " ";
												
	$html .= '			<span style="font-size:12px;">'.$date.'</span>';
					}	
	$html .= '
					</td>
									
				</tr>
				<tr style="background-color: #f9e1bc;">
					<td>Comments : </td>
					<td colspan="13" style="vertical-align: middle;text-align: left;border: 1px solid #ddd;white-space: pre;word-wrap:break-word;padding:8px;">
						<span>';  
										
						$comments = Yii::app()->db->createCommand()
							->select('*')
							->from('comments com')
							->where('com.invoice = "'.$value['id'].'"')
							->order('com.date_comments DESC')
							->limit('1')
							->queryAll();
												
							foreach ($comments as $key_co => $value_co) {
								if($value_co['user_group']== "1"){
	$html .= '						JOG : ';
								}elseif($value_co['user_group']== "2"){
	$html .= '						Sale : ';
								}		
	$html .= '						'.nl2br($value_co['comments']);
							}	
	$html .= '									 
					</span></td>
				</tr>';
			} }	
			if($sumtotalTHB != 0 ){
	$html .= '
				<tr style="background-color: #c1ffe6;">
					<td colspan="5"></td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">
						<span style="font-weight: bold;">฿ '.number_format($sumAmountReceivedTHB , 2).' THB  </span>
					</td>
					<td colspan=""></td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">
						<span style="font-weight: bold;">฿ '.number_format($sumtotalTHB , 2).' THB  </span>
					</td>
					<td></td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">
						<span style="font-weight: bold;">฿ '.number_format($totalcommissionTHB , 2).' THB</span>									  
					</td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">';
						if($commissionPaymentTHB == 0){	
	$html .= '				<span style="font-weight: bold;">฿ '.number_format($commissionPaymentTHB , 2).' THB</span>';
						}else{ 
	$html .= '				<span style="color:red;padding:5px 10px;font-weight: bold;">฿ '.number_format($commissionPaymentTHB , 2).' THB</span>';
						} 
	$html .= '		</td>
					<td></td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">';
						if(!empty($sumCommissionPaymaentTHB)){	
	$html .= '				<span style="font-weight: bold;">฿ '.number_format($sumCommissionPaymaentTHB , 2).' THB</span>';
						} 
	$html .= '		</td>
							
					<td></td>			
				</tr>';
			} 			
	$html .= '						
			</tbody>
		</table>
	</div>	
	<br>';
		}
		
	}
	$html .= '		
		
	<br>	
	
		<table style="border: 1px solid #ddd;width: 100%;max-width: 100%;margin-bottom: 20px;background-color: transparent;border-spacing: 0;border-collapse: collapse;">
			<thead style="display: table-header-group;vertical-align: middle;border-color: inherit;">
				<tr style="display: table-row;vertical-align: inherit;border-color: inherit;">
					<th style="border-top: 0;vertical-align: middle;padding: 8px;line-height: 1.42857143;background-color: #5c656d !important;border: 1px solid #848d94 ;color: #fff;text-align: left;" >Notes</th>
					<th style="border-top: 0;vertical-align: middle;padding: 8px;line-height: 1.42857143;background-color: #5c656d !important;border: 1px solid #848d94 ;color: #fff;text-align: left;" >Bank Account Details:</th>
				</tr>
			</thead>
			<tbody>';
			$notes= Yii::app()->db->createCommand('select *  from notes where type = "Calculator"')->queryAll();
			$bank= Yii::app()->db->createCommand('select *  from user where fullname = "'.$sale.'"')->queryAll();
				
	$html .=	'<tr>';
				foreach ($notes as $key => $value) {
	$html .='		<td style="font-size:13px;color: #73879C;padding: 5px 5px;">'. nl2br($value['notes']).'</td>';
				}	
				foreach ($bank as $key_bank => $value_bank) {
	$html .='		<td style="font-size:13px;color: #73879C;padding: 5px 5px;">
						<div><span style="font-weight: bold;" >Bank Name : </span>'.$value_bank['bank_name'].'</div>
						<div><span style="font-weight: bold;" >Account Name : </span>'.$value_bank['bank_account_name'].'</div>
						<div><span style="font-weight: bold;" >Account Number : </span>'.$value_bank['bank_number'].'</div>
						<div><span style="font-weight: bold;" >Swift Code : </span>'.$value_bank['bank_swift_code'].'</div>
						<div><span style="font-weight: bold;" >Make check payable to : </span>'. $value_bank['bank_name_check'].'</div>
						<div><span style="font-weight: bold;" >Mailing Address : </span>'.$value_bank['bank_mailing_address'].'</div>
						<div><span style="font-weight: bold;" >Other : </span>'.$value_bank['bank_other'].'</div>
					</td>';
				}	
	$html .='	</tr>';
				
	$html .=	'</tbody>
		</table>
	</div>

';


//==============================================================
//==============================================================
//==============================================================

include_once(Yii::app()->getBasePath()."/vendors/mpdf/mpdf.php");
$mpdf=new mPDF('th','c'); 
$mpdf->AddPage('L');
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

//==============================================================
//==============================================================
//==============================================================


?>