<?php
$pdf_title = "";
if($search_date_start!="" && $search_date_end!=""){

	$html = '<h2>'.$sale.' <font style="font-size:15px;">('.date("M. d, Y",strtotime($search_date_start)).' - '.date("M. d, Y",strtotime($search_date_end)).')</font></h2>';
	$pdf_title = $sale.' ('.date("M. d, Y",strtotime($search_date_start)).' - '.date("M. d, Y",strtotime($search_date_end)).')';

}else{

	$html = '<h2>'.$sale.' - '.$year.' '.((isset($month) && $month!="")?date("F",strtotime("2020-".$month."-01")):"").'</h2>';
	$pdf_title = $sale.' - '.$year.' '.((isset($month) && $month!="")?date("F",strtotime("2020-".$month."-01")):"");

}

$html .= '<div >';

		$getDate = Yii::app()->db->createCommand('select MAX(update_date) AS datedata  from calculator where sales_manager = "'.$sale.'" AND currency = "USD" ORDER BY `date_quarter` ASC, `invoice` ASC limit 1')->queryAll();
						
			foreach ($getDate as $key_date => $value_date) {
				$datedata = $value_date['datedata'];
			}
	
			if($datedata != "0000-00-00" ){ 
								
				$_month_name = array("01"=>"January", "02"=>"February", "03"=>"March","04"=>"April", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December"); 
																			 
				list($year2,$momth,$day) = explode("-",$datedata);
																
				if ($day < 10){
					$day = substr($day,1,2);
				}
										
				$date = $_month_name[$momth]." ".$day.",  ".$year2;
				
			}else{
				$date = " - ";
			}	
$html .= '	<span style="color:red;font-size:12px;">Last Update! : '.$date.'<span>
	</div>';
	
		$year_commission = $_GET['year'];	
		$sumtotalUSD = 0;
		$totalcommissionUSD = 0;
		$payoutUSD = 0;
		$balanceUSD = 0;
		$commissionPaymentUSD = 0;	
		$sumCommissionPaymaentUSD = 0;	
		$sumAmountReceivedUSD = 0;	
		$totalPayByCredit = 0;
		$totalPayByCustomer = 0;
		$currency = Array();

		if($search_date_start!="" && $search_date_end!=""){
			$condi_date = ' (date_quarter BETWEEN "'.$search_date_start.'" AND "'.$search_date_end.'") ';
		}else{
			$condi_date = ' date_quarter LIKE "'.$year.'-'.(($month!='')?($month.'-'):'').'%" ';
		}
		
		if($search_invoice!=""){
			$condi_date .= ' AND invoice LIKE "%'.$search_invoice.'%" ';
		}

		if($search_orderno!=""){
			$condi_date .= ' AND order_no LIKE "%'.$search_orderno.'%" ';
		}

		if($search_ordername!=""){
			$condi_date .= ' AND order_name LIKE "%'.$search_ordername.'%" ';
		}

		if($invoice_status!=""){
			$condi_date .= ' AND invoice_status="'.$invoice_status.'" ';
		}
		if($aproved_status!=""){
			$condi_date .= ' AND status_commission="'.$aproved_status.'" ';
		}
		if($commission_status!=""){
			$condi_date .= ' AND commisson_payment_status="'.$commission_status.'" ';
		}

		
				$getreprot = Yii::app()->db->createCommand('select * from calculator where '.$condi_date.' AND sales_manager = "'.$sale.'" AND currency = "USD" ORDER BY `date_quarter` ASC, `invoice` ASC ')->queryAll();
				//$html .= '<div>select * from calculator where '.$condi_date.' AND sales_manager = "'.$sale.'" AND currency = "USD" ORDER BY `date_quarter` ASC, `invoice` ASC </div>';
				
				foreach ($getreprot as $key_report => $value_date_report) {
							
							if($value_date_report['invoice_status'] == "Paid"){		
								
								$sumAmountReceivedUSD += $value_date_report['invoice_amount_received'];	
									
								if($value_date_report['commisson_payment_status'] == "Paid"){
									$commissionPaymentUSD += ($value_date_report['commission'] - $value_date_report['pay_for_sales'])-$value_date_report['pay_by_credit'];
									$totalPayByCredit += $value_date_report['pay_by_credit'];
									$sumCommissionPaymaentUSD += $value_date_report['pay_for_sales']+$value_date_report['pay_by_credit'];
									$payoutUSD += $value_date_report['pay_for_sales'];
								}else{
									$commissionPaymentUSD += $value_date_report['commission'];
								}
							}	
									
							$sumtotalUSD +=  (($value_date_report['total_sales']-$value_date_report['shipping_cost'])-$value_date_report['creditcard_feecost']);
							
							$totalcommissionUSD += $value_date_report['commission'];
							
							$totalPayByCustomer += $value_date_report['pay_by_customer'];
							
					$currency[] = $value_date_report['currency'];
					
				}
					
					$balanceUSD = number_format($totalcommissionUSD - $payoutUSD , 2);
					$number_sumtotalUSD = number_format($sumtotalUSD , 2);
					$number_totalcommissionUSD = number_format($totalcommissionUSD , 2);
					$pay_by_customer=number_format($totalPayByCustomer , 2);
					$total_credit = $totalPayByCustomer-$totalPayByCredit;
					if($sumtotalUSD != 0 ){ 
					
$html .= '			
	<div >
		<table style="width: 100%;max-width: 100%;margin-bottom: 20px;border-spacing: 0;border-collapse: collapse;border: 1px solid #ddd;border-collapse: initial;">
			<thead style="display: table-header-group;vertical-align: middle;border-color: inherit;">
				<tr>
					<th colspan="5" style="background-color: rgb(0, 65, 121) !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;">
							<span> USD </span>
					</th>
				</tr>
				<tr>
					<th style="background-color: #012f5d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Total Sales </th>
					<th style="background-color: #012f5d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Total commissions Earned </th>
					<th style="background-color: #012f5d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Balance </th>
					<th style="background-color: #012f5d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Payment received<br>from customer </th>
					<th style="background-color: #012f5d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;"> Remaining Credit<br>owe to JOG </th>
				</tr>
			</thead>
			<tbody>
				<tr>
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
	$html .= '		</td>
					<td style="background-color: #87c1fb !important;border: 1px solid #848d94 !important;color: #001a33;text-align: center;border: 1px solid #ddd;padding:8px;white-space: nowrap;font-weight: bold;"><span>$ '.$pay_by_customer.'</span>
					</td>
					<td style="background-color: #87c1fb !important;border: 1px solid #848d94 !important;color: #001a33;text-align: center;border: 1px solid #ddd;padding:8px;white-space: nowrap;font-weight: bold;">';
					if($total_credit<0){
	$html .= '
						<span>$ '.number_format($total_credit , 2).'</span>';
					}else{
	$html .= '		
						<span style="color:red;padding:5px 10px;">$ '.number_format($total_credit , 2).'</span>';
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
			
			<font style="color:#5A5;">A</font> = Approved &nbsp;&nbsp; 
			<font style="color:#5A5;">N</font> = Not Approved &nbsp;&nbsp; 
			<font style="color:#5A5;">P</font> =  Pending 
	</div>
	<div >
		<span>Invoice Status : </span>
			<font style="color:#A55;">PD</font> = Paid &nbsp;&nbsp; 
			<font style="color:#A55;">OS</font> = Outstanding 
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
			
			$getData = Yii::app()->db->createCommand('select *  from calculator where '.$condi_date.' AND sales_manager = "'.$sale.'" AND currency = "USD" ORDER BY `date_quarter` ASC, `invoice` ASC')->queryAll();
					
			foreach ($getData as $key => $value) {
				if($value['currency'] ==  $curr ){
	$html .= '							
				<tr>
					<td style="vertical-align: middle;border: 1px solid #ddd;white-space: nowrap;padding:8px;">&nbsp;<span>'.$value['invoice'].'</span>';
										
					/*if($value['invoice_mail_status'] == "Send"){
	$html .= '			&nbsp; <font style="color:#55A;">ST</font>';
					}else{
	$html .= '			
						&nbsp; <font style="color:#55A;">NS</font>';
					}*/	
	$html .= '						
					</td>
					<td style="vertical-align: middle;border: 1px solid #ddd;padding:8px;">&nbsp;
						<span>'.$value['order_no'].'</span>
					</td>
					<td style="vertical-align: middle;text-align: left;border: 1px solid #ddd;padding:8px;">';
					if($value['invoice_status'] == "Paid"){ 
	$html .= '										
						<font style="color:#A55;">PD</font> &nbsp;';
						
					}elseif($value['invoice_status'] == "Outstanding"){ 
	$html .= '									
						<font style="color:#A55;">OS</font> &nbsp;';
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
								<font style="color:#5A5;">A</font> &nbsp;';
							}elseif($value['status_commission'] == "Not Approved"){
	$html .= '					<font style="color:#5A5;">N</font> &nbsp;';
							}else{
	$html .= '					<font style="color:#5A5;">P</font> &nbsp;';
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
												
								$balance_invoice = ($value['commission'] - $value['pay_for_sales'])-$value['pay_by_credit'];
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
						$pay_for_sales=$value['pay_for_sales']+$value['pay_by_credit'];
						if($value['pay_by_credit']!=0){$style='style="color:red"';}else{$style='';}
	$html .= '			<span '.$style.'> $ '.number_format($pay_for_sales , 2).' '.$value['currency'].'</span><br>';
						
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
			if($sumtotalUSD != 0 ){
	$html .= '
				<tr style="background-color: #c1ffe6;">
					<td colspan="5"></td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">
						<span>$ '.number_format($sumAmountReceivedUSD , 2).' USD  </span>
					</td>
					<td colspan=""></td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">
						<span>$ '.number_format($sumtotalUSD , 2).' USD  </span>
					</td>
					<td></td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">
						<span>$ '.number_format($totalcommissionUSD , 2).' USD</span>									  
					</td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">';
						if($commissionPaymentUSD == 0){	
	$html .= '				<span>$ '.number_format($commissionPaymentUSD , 2).' USD</span>';
						}else{ 
	$html .= '				<span style="color:red;padding:5px 10px;">$ '.number_format($commissionPaymentUSD , 2).' USD</span>';
						} 
	$html .= '		</td>
					<td></td>
					<td  style="color: #006400;vertical-align: middle;font-weight:bold;text-align: right;border: 1px solid #ddd;white-space: nowrap;padding:8px;">';
						if(!empty($sumCommissionPaymaentUSD)){	
	$html .= '				<span>$ '.number_format($sumCommissionPaymaentUSD , 2).' USD</span>';
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
	
	$getTLoan = Yii::app()->db->createCommand('select * from calculator where '.$condi_date.' AND sales_manager = "'.$sale.'" AND pay_by_customer!="0" AND currency = "USD" order by id DESC limit 1')->queryAll();
	foreach ($getTLoan as $keyTloan => $value_Tloan) {
	$html .= '		
	
	<div>
		<table style="width: 100%;max-width: 100%;margin-bottom: 20px;border-spacing: 0;border-collapse: collapse;border: 1px solid #ddd;border-collapse: initial;">
			<thead style="display: table-header-group;vertical-align: middle;border-color: inherit;">
				<tr>
					<th colspan = "10" style="background-color:rgb(169, 185, 199);color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Payment Received to Rep  </th>
				</tr>
				<tr>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;">Invoice </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;">Order No.</th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;">Order Name</th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;">Date/Quarter</th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;">Invoice Status</th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;">Amount Received</th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;">Comm PO by JOG</th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;">Payment received<br>from customer</th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;">Comm PO by Credit</th>
				</tr>
			</thead>
			<tbody>';
			
	$getLoan = Yii::app()->db->createCommand('select * from calculator where '.$condi_date.' AND sales_manager = "'.$sale.'" AND pay_by_customer!="0" AND currency = "USD" order by id DESC')->queryAll();
	foreach ($getLoan as $key_loan => $value_loan) {
		
	$html .= '
				<tr>
					<td style="vertical-align: middle;border: 1px solid #ddd;white-space: nowrap;padding:8px;">&nbsp;<span>'.$value_loan['invoice'].'</span>';
										
					/*if($value_loan['invoice_mail_status'] == "Send"){
	$html .= '			&nbsp; <font style="color:#55A;">ST</font>';
					}else{
	$html .= '			
						&nbsp; <font style="color:#55A;">NS</font>';
					}*/	
	$html .= '						
					</td>
					<td style="vertical-align: middle;border: 1px solid #ddd;padding:8px;">&nbsp;
						<span>'.$value_loan['order_no'].'</span>
					</td>
					<td style="vertical-align: middle;text-align: left;border: 1px solid #ddd;padding:8px;">';
					if($value_loan['invoice_status'] == "Paid"){ 
	$html .= '										
						<font style="color:#A55;">PD</font> &nbsp;';
						
					}elseif($value_loan['invoice_status'] == "Outstanding"){ 
	$html .= '									
						<font style="color:#A55;">OS</font> &nbsp;';
					}	
	$html .= '					
					<span>'.$value_loan['order_name'].'</span>
					</td>';
					
					$_month_name = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
										 "04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
										 "07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
										 "10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
										 
					$vardate= $value_loan['date_quarter'];
					
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
						
					if($value_loan['invoice_status'] == "Outstanding"){
	$html .= '			<span style="color:red">'.$value_loan['invoice_status'].'</span>';
					}else{
	$html .= '			<span> '.$value_loan['invoice_status'].'</span>';
					}
	$html .= '									
					</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px;">'; 
						
					if($value_loan['invoice_status'] == "Paid"){
						if(!empty($value_loan['invoice_amount_received'])){
	$html .= '			<span > $ '.number_format($value_loan['invoice_amount_received']  , 2).' '.$value_loan['currency'].'</span><br>';
						}
						if($value_loan['invoice_date'] != "0000-00-00"){		
							$_month_name_int = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
								"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
								"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
								"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
												 
							$invoicedate = $value_loan['invoice_date'];
												 
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
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px;">'; 
					
					if($value_loan['commisson_payment_status'] == "Paid"){
	$html .= '			<span > $ '.number_format($value_loan['pay_for_sales']  , 2).' '.$value_loan['currency'].'</span><br>';
						
						if($value_loan['date_for_sales'] != "0000-00-00" ){ 	
							$_month_name_comm = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
								"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
								"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
								"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
												 
							$commissiondate = $value_loan['date_for_sales'];
												 
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
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px;">
						<span > $ '.number_format($value_loan['pay_by_customer']  , 2).' '.$value_loan['currency'].'</span>
					</td>
					<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px;"> ';
						$pay_by_credit=$value_loan['pay_by_credit'];
						if($pay_by_credit<0){
							$pPay_to_rep='<span style="color:#c50202;padding:5px 10px;font-weight: 700;">$ '.number_format($pay_by_credit , 2).' '.$value_loan['currency'].'</span>';
						}else{
							$pPay_to_rep='<span>$ '.number_format($pay_by_credit , 2).' '.$value_loan['currency'].'</span>';
						}					
	
	$html .= $pPay_to_rep.'</td>
				</tr>';
	}
	$html .= '
			</tbody>
			</table>';
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
$mpdf->SetTitle($pdf_title);

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

//==============================================================
//==============================================================
//==============================================================


?>