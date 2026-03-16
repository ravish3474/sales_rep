<?php


$html = '
<img src="images/jog-logo3.png" class="img-responsive" style="width:30px;margin-bottom:20px;" alt="1">&nbsp; &nbsp;
<img src="images/jog_athl.png" class="img-responsive" style="width:100px;" alt="1">

						
<h2>Sales Rep Commission All '.$year.'</h2>					


	<div>
		<table style="width: 100%;max-width: 100%;margin-bottom: 20px;border-spacing: 0;border-collapse: collapse;border: 1px solid #ddd;border-collapse: initial;">
			<thead style="display: table-header-group;vertical-align: middle;border-color: inherit;">';

				$html .= '	
				<tr>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" >Sales rep </th>
					<th colspan="5" style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" > USD</th>
					<th colspan="5" style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" > CAD</th>
					<th colspan="5" style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" > SGD</th>
					<th colspan="5" style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" > THB</th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" > Update</th>
								
				</tr>
				<tr>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" > Name </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" > Total Sales </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" > Total commissions Earned</th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" > Balance </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" >Payment received<br>from customer</th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" >Remaining Credit<br>owe to JOG</th>
									
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" > Total Sales </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" > Total commissions Earned </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" > Balance </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" >Payment received<br>from customer</th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" >Remaining Credit<br>owe to JOG</th>
									
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" > Total Sales </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" > Total commissions Earned </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" > Balance  </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" >Payment received<br>from customer</th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" >Remaining Credit<br>owe to JOG</th>
									
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" > Total Sales </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" > Total commissions Earned </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" > Balance  </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" > Last Update </th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" >Payment received<br>from customer</th>
					<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:8px;" >Remaining Credit<br>owe to JOG</th>
				</tr>';
				
	$html .= 	'
			</thead>
			<tbody>';
				
				$year_commission = $year;	
				/*$sumtotalUSD = 0;
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
			*/
				$getData = Yii::app()->db->createCommand('select * from calculator where date_quarter LIKE "'.$year.'%" AND  sales_status != "3" group by sales_manager order by sales_manager ASC')->queryAll();
					foreach ($getData as $key => $value) {
						
						$getDate = Yii::app()->db->createCommand('select MAX(update_date) AS datedata  from calculator where sales_manager = "'.$value['sales_manager'].'" ORDER BY `date_quarter` ASC, `invoice` ASC limit 1')->queryAll();
						
						foreach ($getDate as $key_date => $value_date) {
							$datedata = $value_date['datedata'];
						}
						
						$sql_tmp = 'select *  from calculator where date_quarter LIKE "'.$year.'%" AND sales_manager = "'.$value['sales_manager'].'" ORDER BY `id` ASC';
						$getSale = Yii::app()->db->createCommand($sql_tmp)->queryAll();
						
								
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

								$sumfcusUSD[$key] = 0;
								$sumfcusCAD[$key] = 0;
								$sumfcusSGD[$key] = 0;
								$sumfcusTHB[$key] = 0;

								$sumPayCreditUSD[$key] = 0;
								$sumPayCreditCAD[$key] = 0;
								$sumPayCreditSGD[$key] = 0;
								$sumPayCreditTHB[$key] = 0;
							
							//$test_num = 0;

							foreach ($getSale as $key_data => $value_data) {
								
								//$test_num++;
								//if($value['sales_manager'] == $value_data['sales_manager']){
											if($value_data['currency'] == "USD"){
												

													$sumtotalUSD[$key] +=  (($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost']);
													
													$totalcommissionUSD[$key]  +=  $value_data['commission'];
													$payoutUSD[$key]  +=  $value_data['pay_for_sales'];
													
													$sumfcusUSD[$key] += $value_data['pay_by_customer'];

												if($value_data['invoice_status'] == "Paid"){	
													if($value_data['invoice_status'] == "Paid"){
														$balanceUSD[$key]  += ($value_data['commission']  - $value_data['pay_for_sales'] );

														$sumPayCreditUSD[$key] += $value_data['pay_by_credit'];
													}else{
														$balanceUSD[$key]  += $value_data['commission'];
													}
												}
											}
											if($value_data['currency'] == "CAD"){
												

													$sumtotalCAD[$key]  +=  (($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost']);
													
													$totalcommissionCAD[$key]  +=  $value_data['commission'];
													$payoutCAD[$key]  +=  $value_data['pay_for_sales'];

													$sumfcusCAD[$key] += $value_data['pay_by_customer'];

												if($value_data['invoice_status'] == "Paid"){	
													if($value_data['invoice_status'] == "Paid"){
														$balanceCAD[$key]  += ($value_data['commission']  - $value_data['pay_for_sales'] );

														$sumPayCreditCAD[$key] += $value_data['pay_by_credit'];
													}else{
														$balanceCAD[$key]  += $value_data['commission'];
													}
												}	
											}
											if($value_data['currency'] == "SGD"){
												

													$sumtotalSGD[$key]  +=  (($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost']);
													
													$totalcommissionSGD[$key]  +=  $value_data['commission'];
													$payoutSGD[$key]  +=  $value_data['pay_for_sales'];

													$sumfcusSGD[$key] += $value_data['pay_by_customer'];

												if($value_data['invoice_status'] == "Paid"){	
													if($value_data['invoice_status'] == "Paid"){
														$balanceSGD[$key]  += ($value_data['commission']  - $value_data['pay_for_sales'] );

														$sumPayCreditSGD[$key] += $value_data['pay_by_credit'];
													}else{
														$balanceSGD[$key]  += $value_data['commission'];
													}
												}
											}
											if($value_data['currency'] == "THB"){
												

													$sumtotalTHB[$key]  +=  (($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost']);
													
													$totalcommissionTHB[$key]  +=  $value_data['commission'];
													$payoutTHB[$key]  +=  $value_data['pay_for_sales'];

													$sumfcusTHB[$key] += $value_data['pay_by_customer'];

												if($value_data['invoice_status'] == "Paid"){	
													if($value_data['invoice_status'] == "Paid"){
														$balanceTHB[$key]  += ($value_data['commission']  - $value_data['pay_for_sales'] );

														$sumPayCreditTHB[$key] += $value_data['pay_by_credit'];
													}else{
														$balanceTHB[$key]  += $value_data['commission'];
													}
												}	
											}
										//}
							}
						
	$html .=' 	<tr>
					<td style="text-align: left;white-space: nowrap;border: 1px solid #ddd; padding: 8px;" > 
						<span>'.$value['sales_manager'].'</span>	
					</td>
					<td style="text-align: right;white-space: nowrap;background-color: #b7bdc1 !important;border: 1px solid #fff !important;color: #404040;border: 1px solid #ddd; padding: 8px;" >
						<span> $ '.number_format($sumtotalUSD[$key] , 2).'</span> 
					</td>
					<td style="text-align: right;white-space: nowrap;background-color: #b7bdc1 !important;border: 1px solid #fff !important;color: #404040;border: 1px solid #ddd; padding: 8px;" >
						<span>$ '.number_format($totalcommissionUSD[$key] , 2).'</span>
					</td>
					<td style="text-align: right;white-space: nowrap;background-color: #b7bdc1 !important;border: 1px solid #fff !important;color: #404040;border: 1px solid #ddd; padding: 8px;" >';
					
						$totalUSD=$balanceUSD[$key]-$sumPayCreditUSD[$key];
						if($totalUSD < 0){
						
	$html .='				<span style="color:red;">$ '.number_format($totalUSD , 2).'</span>';
						
						}else{
							
	$html .='				<span>$ '.number_format($totalUSD , 2).'</span>';
							
						}	
					
	$html .='		</td>
					<td style="text-align: right;white-space: nowrap;background-color: #b7bdc1 !important;border: 1px solid #fff !important;color: #404040;border: 1px solid #ddd; padding: 8px;" >';
					
					if($sumfcusUSD[$key] != 0){
						$p_fUSD="<span style=\"color:red;\">$ ".number_format($sumfcusUSD[$key] , 2)."</span>";
					}else{
						$p_fUSD="<span>$ ".number_format($sumfcusUSD[$key] , 2)."</span>";
					}
	$html .=$p_fUSD.'
					</td>
					<td style="text-align: right;white-space: nowrap;background-color: #b7bdc1 !important;border: 1px solid #fff !important;color: #404040;border: 1px solid #ddd; padding: 8px;" >';

					$sumcreditUSD=$sumfcusUSD[$key]-$sumPayCreditUSD[$key];
					if($sumcreditUSD > 0){
						$p_sUSD="<span style=\"color:red;\">$ ".number_format($sumcreditUSD , 2)."</span>";
					}else{
						$p_sUSD="<span>$ ".number_format($sumcreditUSD , 2)."</span>";
					}
	$html .=$p_sUSD.'
					</td>
					<td style="text-align: right;white-space: nowrap;background-color: #d2dae0 !important;border: 1px solid #fff !important;color: #404040;border: 1px solid #ddd; padding: 8px;" >  
						<span>$ '.number_format($sumtotalCAD[$key] , 2).'</span>
					</td>
					<td style="text-align: right;white-space: nowrap;background-color: #d2dae0 !important;border: 1px solid #fff !important;color: #404040;border: 1px solid #ddd; padding: 8px;" >  
						<span>$ '.number_format($totalcommissionCAD[$key] , 2).'</span>
					</td>
					<td style="text-align: right;white-space: nowrap;background-color: #d2dae0 !important;border: 1px solid #fff !important;color: #404040;border: 1px solid #ddd; padding: 8px;" >'; 
					
					$totalCAD=$balanceCAD[$key]-$sumPayCreditCAD[$key];
					if($totalCAD < 0){
	$html .='			<span style="color:red;">$ '.number_format($totalCAD , 2).'</span>';
					}else{
	$html .='			<span>$ '.number_format($totalCAD , 2).'</span>';
					}		
										
					
	$html .='		</td>
					<td style="text-align: right;white-space: nowrap;background-color: #b7bdc1 !important;border: 1px solid #fff !important;color: #404040;border: 1px solid #ddd; padding: 8px;" >';
					
					if($sumfcusCAD[$key] != 0){
						$p_fCAD="<span style=\"color:red;\">$ ".number_format($sumfcusCAD[$key] , 2)."</span>";
					}else{
						$p_fCAD="<span>$ ".number_format($sumfcusCAD[$key] , 2)."</span>";
					}
	$html .=$p_fCAD.'
					</td>
					<td style="text-align: right;white-space: nowrap;background-color: #b7bdc1 !important;border: 1px solid #fff !important;color: #404040;border: 1px solid #ddd; padding: 8px;" >';

					$sumcreditCAD=$sumfcusCAD[$key]-$sumPayCreditCAD[$key];
					if($sumcreditCAD > 0){
						$p_sCAD="<span style=\"color:red;\">$ ".number_format($sumcreditCAD , 2)."</span>";
					}else{
						$p_sCAD="<span>$ ".number_format($sumcreditCAD , 2)."</span>";
					}
	$html .=$p_sCAD.'
					</td>

					<td style="text-align: right;white-space: nowrap;background-color: #b7bdc1 !important;border: 1px solid #fff !important;color: #404040;border: 1px solid #ddd; padding: 8px;" >  
						<span>$ '.number_format($sumtotalSGD[$key] , 2).'</span>
					</td>
					<td style="text-align: right;white-space: nowrap;background-color: #b7bdc1 !important;border: 1px solid #fff !important;color: #404040;border: 1px solid #ddd; padding: 8px;" >  
						<span>$ '.number_format($totalcommissionSGD[$key] , 2).'</span>
					</td>
					<td style="text-align: right;white-space: nowrap;background-color: #b7bdc1 !important;border: 1px solid #fff !important;color: #404040;border: 1px solid #ddd; padding: 8px;" >'; 
					
					$totalSGD=$balanceSGD[$key]-$sumPayCreditSGD[$key];
					if($totalSGD < 0){
	$html .='			<span style="color:red;">$ '.number_format($totalSGD , 2).'</span>';
					}else{
	$html .='			<span>$ '.number_format($totalSGD , 2).'<span>';
					}
	$html .='		</td>
					<td style="text-align: right;white-space: nowrap;background-color: #b7bdc1 !important;border: 1px solid #fff !important;color: #404040;border: 1px solid #ddd; padding: 8px;" >';
					
					if($sumfcusSGD[$key] != 0){
						$p_fSGD="<span style=\"color:red;\">$ ".number_format($sumfcusSGD[$key] , 2)."</span>";
					}else{
						$p_fSGD="<span>$ ".number_format($sumfcusSGD[$key] , 2)."</span>";
					}
	$html .=$p_fSGD.'
					</td>
					<td style="text-align: right;white-space: nowrap;background-color: #b7bdc1 !important;border: 1px solid #fff !important;color: #404040;border: 1px solid #ddd; padding: 8px;" >';

					$sumcreditSGD=$sumfcusSGD[$key]-$sumPayCreditSGD[$key];
					if($sumcreditSGD > 0){
						$p_sSGD="<span style=\"color:red;\">$ ".number_format($sumcreditSGD , 2)."</span>";
					}else{
						$p_sSGD="<span>$ ".number_format($sumcreditSGD , 2)."</span>";
					}
	$html .=$p_sSGD.'
					</td>

					<td style="text-align: right;white-space: nowrap;background-color: #d2dae0 !important;border: 1px solid #fff !important;color: #404040;border: 1px solid #ddd; padding: 8px;" >  
						<span> ฿ '.number_format($sumtotalTHB[$key] , 2).'</span>
					</td>
					<td style="text-align: right;white-space: nowrap;background-color: #d2dae0 !important;border: 1px solid #fff !important;color: #404040;border: 1px solid #ddd; padding: 8px;" >  
						<span> ฿ '.number_format($totalcommissionTHB[$key] , 2).'</span>
					</td>
					<td style="text-align: right;white-space: nowrap;background-color: #d2dae0 !important;border: 1px solid #fff !important;color: #404040;border: 1px solid #ddd; padding: 8px;" >'; 
					
					$totalTHB=$balanceTHB[$key]-$sumPayCreditTHB[$key];
					if($totalTHB < 0){
	$html .='			<span style="color:red;"> ฿ '.number_format($totalTHB, 2).'</span>';
					}else{
	$html .='			<span> ฿ '.number_format($totalTHB, 2).'</span>';
					}		
	$html .='		</td>
					<td style="text-align: right;white-space: nowrap;background-color: #b7bdc1 !important;border: 1px solid #fff !important;color: #404040;border: 1px solid #ddd; padding: 8px;" >';
					
					if($sumfcusTHB[$key] != 0){
						$p_fTHB="<span style=\"color:red;\">$ ".number_format($sumfcusTHB[$key] , 2)."</span>";
					}else{
						$p_fTHB="<span>$ ".number_format($sumfcusTHB[$key] , 2)."</span>";
					}
	$html .=$p_fTHB.'
					</td>
					<td style="text-align: right;white-space: nowrap;background-color: #b7bdc1 !important;border: 1px solid #fff !important;color: #404040;border: 1px solid #ddd; padding: 8px;" >';

					$sumcreditTHB=$sumfcusTHB[$key]-$sumPayCreditTHB[$key];
					if($sumcreditTHB > 0){
						$p_sTHB="<span style=\"color:red;\">$ ".number_format($sumcreditTHB , 2)."</span>";
					}else{
						$p_sTHB="<span>$ ".number_format($sumcreditTHB , 2)."</span>";
					}
	$html .=$p_sTHB.'
					</td>

					<td style="text-align: left;white-space: nowrap;border: 1px solid #ddd; padding: 8px;" >'; 
					
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
							
	$html .='		<span>'.$date.'<span></td>
				</tr>';
					} 
	$html .=
			'</tbody>
		</table>
		<br>
		<br>
		<table style="border: 1px solid #ddd;width: 100%;max-width: 100%;margin-bottom: 20px;background-color: transparent;border-spacing: 0;border-collapse: collapse;">
			<thead style="display: table-header-group;vertical-align: middle;border-color: inherit;">
				<tr style="display: table-row;vertical-align: inherit;border-color: inherit;">
					<th style="border-top: 0;vertical-align: middle;padding: 8px;line-height: 1.42857143;background-color: #5c656d !important;border: 1px solid #848d94 ;color: #fff;text-align: left;" colspan="2">Notes</th>
				</tr>
			</thead>
			<tbody>';
			$notes= Yii::app()->db->createCommand('select *  from notes where type = "Calculator"')->queryAll();
				foreach ($notes as $key => $value) {
	$html .=	'<tr >
					<td style="font-size:13px;color: #73879C;padding: 10px 5px;">'. nl2br($value['notes']).'</td>
				</tr>';
				}
	$html .=	'</tbody>
		</table>
	</div>

';


//==============================================================
//==============================================================
//==============================================================

include_once(Yii::app()->getBasePath()."/vendors/mpdf/mpdf.php");
$mpdf = new mPDF('th','c'); 

$mpdf->AddPage('L');
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

//==============================================================
//==============================================================
//==============================================================


?>