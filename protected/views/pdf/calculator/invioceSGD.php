<?php


$html = '
<img src="images/jog-logo3.png" class="img-responsive" style="width:30px;margin-bottom:20px;" alt="1">&nbsp; &nbsp;
<img src="images/jog_athl.png" class="img-responsive" style="width:100px;" alt="1">

						
<h2>Invoice - '.$year.' year </h2>					
	<div >';
		$getDate = Yii::app()->db->createCommand('select MAX(update_date) AS datedata  from calculator where date_quarter LIKE "'.$year.'%" AND currency = "SGD" ORDER BY `date_quarter` ASC, `invoice` ASC limit 1')->queryAll();
						
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
		
		$sumtotalSGD = 0;
		$totalcommissionSGD = 0;
		$payoutSGD = 0;
		$balanceSGD = 0;
		$commissionPaymentSGD = 0;
		$sumCommissionPaymaentSGD = 0;
		$sumAmountReceivedSGD = 0;
		
		$currency = Array();
		
				
				
				$getreprot2 = Yii::app()->db->createCommand('select * from calculator where date_quarter LIKE "'.$year.'%" AND currency = "SGD" group by invoice ORDER BY `date_quarter` ASC, `invoice` ASC ')->queryAll();
				
				foreach ($getreprot2 as $key_report2 => $value_date_report2) {
					
					$getreprot = Yii::app()->db->createCommand('select * from calculator where invoice = "'.$value_date_report2['invoice'].'"  AND currency = "SGD" limit 1 ')->queryAll();
					
					foreach ($getreprot as $key_report => $value_report) {
						if($value_date_report2['invoice_status'] == "Paid"){	
							$sumAmountReceivedSGD += $value_report['invoice_amount_received'];
						}
						$sumtotalSGD +=  (($value_report['total_sales']-$value_report['shipping_cost'])-$value_report['creditcard_feecost']);
										
					}	
				
				//$html .= $sumtotalUSD."<br>";
				
				//foreach ($getreprot as $key_report => $value_date_report) {
					

				$getSale = Yii::app()->db->createCommand('select * from calculator where invoice = "'.$value_date_report2['invoice'].'" AND currency = "SGD" ORDER BY `date_quarter` ASC, `invoice` ASC')->queryAll();
						
					foreach ($getSale as $key_data => $value_data) {
						$curr = $value_data['currency'];

								//$sumtotalSGD +=  (($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost']);
								
								$sumCommissionPaymaentSGD += $value_data['pay_for_sales'];
								
								$totalcommissionSGD +=  $value_data['commission'];
								$payoutSGD +=  $value_data['pay_for_sales'];
							if($value_date_report2['invoice_status'] == "Paid"){	
								if($value_data['commisson_payment_status'] == "Paid"){
									$commissionPaymentSGD +=  $value_data['commission'] - $value_data['pay_for_sales'];
								}else{
									$commissionPaymentSGD += $value_data['commission'];
								}
						
						
							}
					}
					$currency[] = $value_date_report2['currency'];
					
				//}
				}
					
					$balanceSGD = number_format($totalcommissionSGD - $payoutSGD , 2);
					
					
					
					$number_sumtotalSGD = number_format($sumtotalSGD , 2);
					
					
					
					$number_totalcommissionSGD = number_format($totalcommissionSGD , 2);
					
					
					
					if($sumtotalSGD != 0){ 
					
$html .= '			
	<div >
		<table style="width: 100%;max-width: 100%;margin-bottom: 20px;border-spacing: 0;border-collapse: collapse;border: 1px solid #ddd;border-collapse: initial;">
			<thead style="display: table-header-group;vertical-align: middle;border-color: inherit;">
				<tr>								
					<th colspan="3" style="background-color:rgb(0, 65, 121);color:#fff;text-align: center;border: 1px solid #ddd;padding:8px;">
						<span>	SGD </span>
					</th>
				</tr>
				<tr>							
					<th style="background-color: #012f5d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Total Sales </th>
					<th style="background-color: #012f5d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Total commissions Earned </th>
					<th style="background-color: #012f5d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Balance  </th>	</tr>
			</thead>
			<tbody>
				<tr>									
					<td style="background-color: #87c1fb !important;border: 1px solid #848d94 !important;color: #001a33;text-align: center;border: 1px solid #ddd;padding:8px;white-space: nowrap;font-weight: bold;"><span>$ '.$number_sumtotalSGD.' </span>
					</td>
					<td style="background-color: #87c1fb !important;border: 1px solid #848d94 !important;color: #001a33;text-align: center;border: 1px solid #ddd;padding:8px;white-space: nowrap;font-weight: bold;"><span>$ '.$number_totalcommissionSGD.'</span>
					</td>
					
					<td style="background-color: #87c1fb !important;border: 1px solid #848d94 !important;color: #001a33;text-align: center;border: 1px solid #ddd;padding:8px;white-space: nowrap;font-weight: bold;">';
					if($commissionPaymentSGD == 0){
	$html .= '			<span>$ '.number_format($commissionPaymentSGD , 2).'</span>';
					}else{ 
	$html .= '			<span style="color:red;padding:5px 10px;">$ '.number_format($commissionPaymentSGD , 2).'</span>';
					 } 
	$html .= '		</td>		
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
			<img src="images/red.png" class="img-responsive" style="width:8px;" alt="1"> Outstanding &nbsp; &nbsp; 
	</div>
	<div >
		<span>Invoice Mailing Status : </span>
			<img src="images/mail-s.png" class="img-responsive" style="width:10px;" alt="1"> Sent &nbsp; &nbsp; 
			<img src="images/mail-ns.png" class="img-responsive" style="width:10px;" alt="1"> Not Send  &nbsp; &nbsp; 
		
	</div>
	<div >
		<span>Sales Responsible : </span>
			<img src="images/user.png" class="img-responsive" style="width:10px;" alt="1"> Sales Manager (M) &nbsp; &nbsp; 
			<img src="images/user.png" class="img-responsive" style="width:10px;" alt="1"> Sales Rep (R)  &nbsp; &nbsp; 
			<img src="images/user.png" class="img-responsive" style="width:10px;" alt="1"> Processor (P)  &nbsp; &nbsp; 
	</div>
	<br>';
	
	$currency_curr = array_unique ($currency);
		
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
					
					<th colspan = "" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Sales Responsible </th>
					
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
					
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;"> Sales Responsible </th>
					
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
			
			$getData = Yii::app()->db->createCommand('select * from calculator where date_quarter LIKE "'.$year.'%"  AND currency = "SGD" group by invoice ORDER BY `date_quarter` ASC, `invoice` ASC')->queryAll();
					
			foreach ($getData as $key => $value) {
				if($value['currency'] ==  $curr ){
	$html .= '							
				<tr>
					<td style="vertical-align: middle;border: 1px solid #ddd;white-space: nowrap;">&nbsp;'.$value['invoice'];
										
					if($value['invoice_mail_status'] == "Send"){
	$html .= '			&nbsp; <img src="images/mail-s.png" class="img-responsive" style="width:10px;" alt="1">';
					}else{
	$html .= '			
						&nbsp; <img src="images/mail-ns.png" class="img-responsive" style="width:10px;" alt="1"></i>';
					}	
	$html .= '						
					</td>
					<td style="vertical-align: middle;border: 1px solid #ddd;">&nbsp;'.$value['order_no'].'
							
					</td>
					<td style="vertical-align: middle;text-align: left;border: 1px solid #ddd;padding:5px 5px;">';
					if($value['invoice_status'] == "Paid"){ 
	$html .= '										
						<img src="images/green.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
						
					}elseif($value['invoice_status'] == "Outstanding"){ 
	$html .= '									
						<img src="images/red.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
					}	
	$html .= '					
					'.$value['order_name'].'
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
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:5px 5px;">'.$date.'/ <br>'.$quarter.' 
					</td>

					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:5px 5px;">'; 
						
					if($value['invoice_status'] == "Outstanding"){
	$html .= '			<span style="color:red">'.$value['invoice_status'].'</span>';
					}else{
	$html .= '			<span> '.$value['invoice_status'].'</span>';
					}
	$html .= '									
					</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:5px 5px;">'; 
						
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
					<td style="vertical-align: top;text-align: left;border: 1px solid #ddd;white-space: nowrap;padding:5px 5px;">';
						$getResponsible = Yii::app()->db->createCommand('select * from calculator where invoice = "'.$value['invoice'].'" order by sales_status ASC')->queryAll();
							foreach ($getResponsible as $key_res => $value_res ) {
								if($value_res['sales_status'] == "1"){	
	$html .= '			
									<span style="font-weight: bold;">M : </span>'.$value_res['sales_manager'].'<br>';
					
								}elseif($value_res['sales_status'] == "2"){
	$html .= '						<span style="font-weight: bold;">R : </span>'.$value_res['sales_manager'].'<br>';
								}elseif($value_res['sales_status'] == "3"){
	$html .= '						<span style="font-weight: bold;">P : </span>'.$value_res['sales_manager'].'<br>'; 
								}
							}
	$html .= '		</td>
					<td style="vertical-align: top;text-align: left;border: 1px solid #ddd;white-space: nowrap;padding:5px 5px;">';
						foreach ($getResponsible as $key_res => $value_res ) {
							if($value_res['sales_status'] == "1"){	
								$totalsale_man = (($value_res['total_sales'] - $value_res['shipping_cost']) - $value_res['creditcard_feecost']);
									if($value_res['total_sales'] != 0){
										if($value_res['status_commission'] == "Approved"){ 
	$html .= '										
											<img src="images/green.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
						
										}elseif($value_res['status_commission'] == "Not Approved"){ 
	$html .= '									
											<img src="images/red.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
										}else{ 
	$html .= '			
											<img src="images/oragn.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
										}
	$html .= '
										<span style="font-weight: bold;">M : </span>$ '.number_format($totalsale_man , 2).' '.$value_res['currency'].'<br>';
									}else{
	$html .= '
										<span style="font-weight: bold;"> </span><br>';									
									}
							}elseif($value_res['sales_status'] == "2"){
								$totalsale_rep = (($value_res['total_sales'] - $value_res['shipping_cost']) - $value_res['creditcard_feecost']);
									if($value_res['total_sales'] != 0){
										if($value_res['status_commission'] == "Approved"){ 
	$html .= '										
											<img src="images/green.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
						
										}elseif($value_res['status_commission'] == "Not Approved"){ 
	$html .= '									
											<img src="images/red.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
										}else{ 
	$html .= '			
											<img src="images/oragn.png" class="img-responsive" style="width:8px;" alt="1"> &nbsp;';
										}
	$html .= '								
										<span style="font-weight: bold;">R : </span>$ '.number_format($totalsale_rep , 2).' '.$value_res['currency'].'<br>';
									}else{
	$html .= '
										<span style="font-weight: bold;"> </span><br>';									
									}	
							}
						}				
						
	$html .= '		</td>
					<td style="vertical-align: top;text-align: left;border: 1px solid #ddd;white-space: nowrap;padding:5px 5px;" >';
						foreach ($getResponsible as $key_res => $value_res ) {
							if($value_res['sales_status'] == "1"){	
								if($value_res['total_sales'] != 0){
					
	$html .= '						<span style="font-weight: bold;">M : </span>'.$value_res['commission_percent'].'%<br>';
								}else{
	$html .= '
									<span style="font-weight: bold;"> </span><br>';									
								}
							}elseif($value_res['sales_status'] == "2"){
								if($value_res['total_sales'] != 0){
					
	$html .= '						<span style="font-weight: bold;">R : </span>'.$value_res['commission_percent'].'%<br>';
								}else{
	$html .= '
									<span style="font-weight: bold;"> </span><br>';									
								}
								
							}
						}	
	$html .= '		</td>
					<td style="vertical-align: top;text-align: left;border: 1px solid #ddd;white-space: nowrap;padding:5px 5px;">';
						foreach ($getResponsible as $key_res => $value_res ) {
							if($value_res['sales_status'] == "1"){	
								if($value_res['total_sales'] != 0){
	$html .= '						
									<span style="font-weight: bold;">M : </span>$ '.number_format($value_res['commission'] , 2).' '.$value_res['currency'].'<br>';
								}else{
	$html .= '
									<span style="font-weight: bold;"> </span><br>';									
								}
							}elseif($value_res['sales_status'] == "2"){
								if($value_res['total_sales'] != 0){
	$html .= '						
									<span style="font-weight: bold;">R : </span>$ '.number_format($value_res['commission'] , 2).' '.$value_res['currency'].'<br>';
								}else{
	$html .= '
									<span style="font-weight: bold;"> </span><br>';									
								}
							}		
						}		
	$html .= '		</td>
					<td style="vertical-align: top;text-align: left;border: 1px solid #ddd;white-space: nowrap;padding:5px 5px;">';
						foreach ($getResponsible as $key_res => $value_res ) {
							if($value_res['sales_status'] == "1"){	
								if($value_res['invoice_status'] == "Paid"){
									if($value_res['commisson_payment_status'] == "Paid"){
														
										$balance_invoice = $value_res['commission'] - $value_res['pay_for_sales'];
										
										if($balance_invoice != 0 ){
	$html .= '								
											<span style="font-weight: bold;">M : </span><span style="color:red"> $ '.number_format($balance_invoice  , 2).' '.$value_res['currency'].'</span><br>';
										}else{
	$html .= '					
											<span style="font-weight: bold;">M : </span><span> $ '.number_format($balance_invoice  , 2).' '.$value_res['currency'].'</span><br>';
										}
														
									}else{
										if($value_res['total_sales']  != 0){
	$html .= '								
											<span style="font-weight: bold;">M : </span><span style="color:red"> $ '.number_format($value_res['commission'] , 2).' '.$value_res['currency'].'</span><br>';
										}
									}
								}
							}elseif($value_res['sales_status'] == "2"){
								if($value_res['invoice_status'] == "Paid"){
									if($value_res['commisson_payment_status'] == "Paid"){
														
										$balance_invoice = $value_res['commission'] - $value_res['pay_for_sales'];
										
										if($balance_invoice != 0 ){
	$html .= '								
											<span style="font-weight: bold;">R : </span><span style="color:red"> $ '.number_format($balance_invoice  , 2).' '.$value_res['currency'].'</span><br>';
										}else{
	$html .= '					
											<span style="font-weight: bold;">R : </span><span> $ '.number_format($balance_invoice  , 2).' '.$value_res['currency'].'</span><br>';
										}
														
									}else{
										if($value_res['total_sales']  != 0){
	$html .= '								
											<span style="font-weight: bold;">R : </span><span style="color:red"> $ '.number_format($value_res['commission'] , 2).' '.$value_res['currency'].'</span><br>';
										}
									}
								}
							}elseif($value_res['sales_status'] == "3"){
								if($value_res['invoice_status'] == "Paid"){
									if($value_res['commisson_payment_status'] == "Paid"){
														
										$balance_invoice = $value_res['commission'] - $value_res['pay_for_sales'];
										
										if($balance_invoice != 0 ){
	$html .= '								
											<span style="font-weight: bold;">P : </span><span style="color:red"> $ '.number_format($balance_invoice  , 2).' '.$value_res['currency'].'</span><br>';
										}else{
	$html .= '					
											<span style="font-weight: bold;">P : </span><span> $ '.number_format($balance_invoice  , 2).' '.$value_res['currency'].'</span><br>';
										}
														
									}else{
										if($value_res['total_sales']  != 0){
	$html .= '								
											<span style="font-weight: bold;">P : </span><span style="color:red"> $ '.number_format($value_res['commission'] , 2).' '.$value_res['currency'].'</span><br>';
										}
									}
								}
							}
						}		
	$html .= '	
					</td>
					
					<td style="vertical-align: top;text-align: left;border: 1px solid #ddd;white-space: nowrap;padding:5px 5px;">'; 
					foreach ($getResponsible as $key_res => $value_res ) {
						if($value_res['sales_status'] == "1"){		
							if($value_res['commisson_payment_status'] == "Outstanding"){
	$html .= '					
								<span style="font-weight: bold;">M : </span><span style="color:red">'.$value_res['commisson_payment_status'].'</span><br>';
							}else{
	$html .= '					<span style="font-weight: bold;">M : </span><span> '.$value_res['commisson_payment_status'].'</span><br>';
							}
						}elseif($value_res['sales_status'] == "2"){	
							if($value_res['commisson_payment_status'] == "Outstanding"){
	$html .= '					
								<span style="font-weight: bold;">R : </span><span style="color:red">'.$value_res['commisson_payment_status'].'</span><br>';
							}else{
	$html .= '					<span style="font-weight: bold;">R : </span><span> '.$value_res['commisson_payment_status'].'</span><br>';
							}
						}
					}		
	$html .= '									
					</td>
					<td style="vertical-align: top;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:5px 5px;">'; 
					foreach ($getResponsible as $key_res => $value_res ) {
						if($value_res['sales_status'] == "1"){
							if($value_res['commisson_payment_status'] == "Paid"){
	$html .= '					
								<span style="font-weight: bold;">M : </span><span > $ '.number_format($value_res['pay_for_sales']  , 2).' '.$value_res['currency'].'</span><br>';
								
								if($value_res['date_for_sales'] != "0000-00-00" ){ 	
									$_month_name_comm = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
										"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
										"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
										"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
												 
									$commissiondate = $value_res['date_for_sales'];
												 
									list($year_comm,$momth_comm,$day_comm) = explode("-",$commissiondate);
												  
									$yy_comm = $year_comm;
									$mm_comm = $momth_comm;
									$dd_comm = $day_comm; 
												
									if ($dd_comm < 10){
										$dd_comm = substr($dd_comm,1,2);
									}
									$date_comm = $_month_name_comm[$mm_comm]." ".$dd_comm.",  ".$yy_comm;
												  
		$html .= '					<span style="font-size:11px">(Date : '.$date_comm.')</span><br>';
								}
							}
						}elseif($value_res['sales_status'] == "2"){
							if($value_res['commisson_payment_status'] == "Paid"){
	$html .= '					
								<span style="font-weight: bold;">R : </span><span > $ '.number_format($value_res['pay_for_sales']  , 2).' '.$value_res['currency'].'</span><br>';
								
								if($value_res['date_for_sales'] != "0000-00-00" ){ 			
									$_month_name_comm = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
										"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
										"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
										"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
												 
									$commissiondate = $value_res['date_for_sales'];
												 
									list($year_comm,$momth_comm,$day_comm) = explode("-",$commissiondate);
												  
									$yy_comm = $year_comm;
									$mm_comm = $momth_comm;
									$dd_comm = $day_comm; 
												
									if ($dd_comm < 10){
										$dd_comm = substr($dd_comm,1,2);
									}
									$date_comm = $_month_name_comm[$mm_comm]." ".$dd_comm.",  ".$yy_comm;
												  
		$html .= '					<span style="font-size:11px">(Date : '.$date_comm.')</span><br>';
								}
							}
							
						}
					}
	$html .= '									
					</td>
					
					<td style="vertical-align: top;text-align: left;border: 1px solid #ddd;white-space: nowrap;padding:5px 5px;">'; 
					foreach ($getResponsible as $key_res => $value_res ) {
						if($value_res['sales_status'] == "1"){	
							if($value_res['update_date'] != "0000-00-00" ){ 
								$_month_name = array("01"=>"Jan.", "02"=>"Feb.", "03"=>"Mar.","04"=>"Apr.", "05"=>"May.", "06"=>"Jun.", "07"=>"Jul.", "08"=>"Aug.", "09"=>"Sep.", "10"=>"Oct.", "11"=>"Nov.", "12"=>"Dec."); 
																										 
								list($year,$momth,$day) = explode("-",$value_res['update_date']);
																							
								if ($day < 10){
									$day = substr($day,1,2);
								}
																	
								$date = $_month_name[$momth]." ".$day.",  ".$year;
												
	$html .= '						<span style="font-weight: bold;">M : </span><span style="font-size:12px;">'.$date.'</span><br>';
											
							}else{
								$date = " ";
												
	$html .= '					<span style="font-size:12px;">'.$date.'</span><br>';
							}
						}elseif($value_res['sales_status'] == "2"){
							if($value_res['update_date'] != "0000-00-00" ){ 
								$_month_name = array("01"=>"Jan.", "02"=>"Feb.", "03"=>"Mar.","04"=>"Apr.", "05"=>"May.", "06"=>"Jun.", "07"=>"Jul.", "08"=>"Aug.t", "09"=>"Sep.", "10"=>"Oct.", "11"=>"Nov.", "12"=>"Dec."); 
																										 
								list($year,$momth,$day) = explode("-",$value_res['update_date']);
																							
								if ($day < 10){
									$day = substr($day,1,2);
								}
																	
								$date = $_month_name[$momth]." ".$day.",  ".$year;
												
	$html .= '						<span style="font-weight: bold;">R : </span><span style="font-size:12px;">'.$date.'</span><br>';
											
							}else{
								$date = " ";
												
	$html .= '					<span style="font-size:12px;">'.$date.'</span><br>';
							}
						}elseif($value_res['sales_status'] == "3"){
							if($value_res['update_date'] != "0000-00-00" ){ 
								$_month_name = array("01"=>"Jan.", "02"=>"Feb.", "03"=>"Mar.","04"=>"Apr.", "05"=>"May.", "06"=>"Jun.", "07"=>"Jul.", "08"=>"Aug.", "09"=>"Sep.", "10"=>"Oct.", "11"=>"Nov.", "12"=>"Dec."); 
																										 
								list($year,$momth,$day) = explode("-",$value_res['update_date']);
																							
								if ($day < 10){
									$day = substr($day,1,2);
								}
																	
								$date = $_month_name[$momth]." ".$day.",  ".$year;
												
	$html .= '						<span style="font-weight: bold;">P : </span><span style="font-size:12px;">'.$date.'</span><br>';
											
							}else{
								$date = " ";
												
	$html .= '					<span style="font-size:12px;">'.$date.'</span><br>';
							}
						}
					}
	$html .= '
					</td>
									
				</tr>
				<tr style="background-color: #f9e1bc;">
					<td>Comments : </td>
					<td colspan="13" style="vertical-align: middle;text-align: left;border: 1px solid #ddd;white-space: pre;word-wrap:break-word;padding:8px;">
						<span>';  
										
						foreach ($getResponsible as $key_res => $value_res ) {
						if($value_res['sales_status'] == "1"){					
							$comments = Yii::app()->db->createCommand()
								->select('*')
								->from('comments com')
								->where('com.invoice = "'.$value_res['id'].'"')
								->order('com.date_comments DESC')
								->limit('1')
								->queryAll();
													
								foreach ($comments as $key_co => $value_co) {
									if($value_co['user_group']== "1"){
	$html .= '							<span style="font-weight: bold;">M : </span> JOG : ';
									}elseif($value_co['user_group']== "2"){
	$html .= '							<span style="font-weight: bold;">M : </span> Sale : ';
									}		
	$html .= '							'.nl2br($value_co['comments']).'<br>';
								}
						}elseif($value_res['sales_status'] == "2"){
							$comments = Yii::app()->db->createCommand()
								->select('*')
								->from('comments com')
								->where('com.invoice = "'.$value_res['id'].'"')
								->order('com.date_comments DESC')
								->limit('1')
								->queryAll();
													
								foreach ($comments as $key_co => $value_co) {
									if($value_co['user_group']== "1"){
	$html .= '							<span style="font-weight: bold;">R : </span> JOG : ';
									}elseif($value_co['user_group']== "2"){
	$html .= '							<span style="font-weight: bold;">R : </span> Sale : ';
									}		
	$html .= '							'.nl2br($value_co['comments']).'<br>';
								}
						}elseif($value_res['sales_status'] == "3"){
							$comments = Yii::app()->db->createCommand()
								->select('*')
								->from('comments com')
								->where('com.invoice = "'.$value_res['id'].'"')
								->order('com.date_comments DESC')
								->limit('1')
								->queryAll();
													
								foreach ($comments as $key_co => $value_co) {
									if($value_co['user_group']== "1"){
	$html .= '							<span style="font-weight: bold;">P : </span> JOG : ';
									}elseif($value_co['user_group']== "2"){
	$html .= '							<span style="font-weight: bold;">P : </span> Sale : ';
									}		
	$html .= '							'.nl2br($value_co['comments']).'<br>';
								}
						}
					}	
	$html .= '									 
					</span></td>
				</tr>
				';
			} }	
			if($sumtotalSGD!= 0 ){ 
							
	$html .= '				<tr style="background-color: #c1ffe6;">
								<td colspan="5"></td>
								
								<td  style="text-align: right;color: #006400;vertical-align: middle;font-weight:bold;vertical-align: middle;border: 1px solid #ddd;white-space: nowrap;padding:5px 5px;">
										<span>$ '.number_format($sumAmountReceivedSGD , 2).' SGD  </span>
								</td>
								<td></td>
								<td  style="text-align: right;color: #006400;vertical-align: middle;font-weight:bold;vertical-align: middle;border: 1px solid #ddd;white-space: nowrap;padding:5px 5px;">
										<span>$ '.number_format($sumtotalSGD , 2).' SGD  </span>
								</td>
								<td></td>
								<td class="text-right nowrap" style="text-align: right;color: #006400;vertical-align: middle;font-weight:bold;vertical-align: middle;border: 1px solid #ddd;white-space: nowrap;padding:5px 5px;">
										<span>$ '.number_format($totalcommissionSGD , 2).' SGD  </span>									  
								</td>
								<td class="text-right nowrap" style="text-align: right;color: #006400;vertical-align: middle;font-weight:bold;vertical-align: middle;border: 1px solid #ddd;white-space: nowrap;padding:5px 5px;">';
									if($commissionPaymentSGD == 0){	
	$html .= '							<span>$ '.number_format($commissionPaymentSGD , 2).' SGD </span>';
									}else{
	$html .= '							<span style="color:red;padding:5px 10px;">$ '.number_format($commissionPaymentSGD , 2). ' SGD </span>';
									}
	$html .= '					</td>
								<td></td>
								<td class="text-right nowrap" style="text-align: right;color: #006400;vertical-align: middle;font-weight:bold;vertical-align: middle;border: 1px solid #ddd;white-space: nowrap;padding:5px 5px;">';
									if(!empty($sumCommissionPaymaentSGD)){	
	$html .= '							<span>$ '.number_format($sumCommissionPaymaentSGD , 2).' SGD </span>';
									}
	$html .= '					</td>
								
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
					
				</tr>
			</thead>
			<tbody>';
			$notes= Yii::app()->db->createCommand('select *  from notes where type = "Calculator"')->queryAll();
				
	$html .=	'<tr>';
				foreach ($notes as $key => $value) {
	$html .='		<td style="font-size:13px;color: #73879C;padding: 5px 5px;">'. nl2br($value['notes']).'</td>';
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