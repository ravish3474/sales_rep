<?php


$html = '
<img src="images/jog-logo3.png" class="img-responsive" style="width:30px;margin-bottom:20px;" alt="1">&nbsp; &nbsp;
<img src="images/jog_athl.png" class="img-responsive" style="width:100px;" alt="1">

						
<h2>'.$sale.' - Sales Commission Calculator</h2>';	
				
	$getDetail = Yii::app()->db->createCommand('select * from calculator left join user ON calculator.sales_manager = user.fullname where calculator.id = "'.$id.'" order by calculator.id DESC ')->queryAll();
				
				foreach ($getDetail as $key => $value) {
	
		  
			 $_month_name = array("01"=>"January", "02"=>"February", "03"=>"March","04"=>"April", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December"); 
											 
			$vardate = $value['date_quarter'];
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
			
			<table id="calculatorSendTable">
				<tr>
					<td>Invoice :</td>
					<td>
						'. $value['invoice'].' 
					</td>
				</tr>
				<tr>
					<td>Order No. :</td>
					<td>
						&nbsp;'.$value['order_no'].'
					</td>
				</tr>
				<tr>
					<td>Order Name :</td>
					<td>
						&nbsp;'.$value['order_name'].'
					</td>
				</tr>
				<tr>
					<td>Date/Quarter :</td>
					<td>
						&nbsp;'.$date.'/ '.$quarter.'  
					</td>
				</tr>
				<tr>
					<td>Commission Status :</td>
					<td>';
						
						if($value['status_commission'] == "Not Approved"){ 
		$html .= '			&nbsp; <span style="color:red">'.$value['status_commission'].'</span>';
						}elseif($value['status_commission'] == "Approved"){ 
		$html .= '			&nbsp; <span style="color:green">'.$value['status_commission'].'</span>'; 
						}else{ 
		$html .= '			&nbsp; <span style="color:#e68c00">Pending</span>'; 
						}
		$html .= '									
					</td>
				</tr>
								
				<tr>
					<td>Invoice Mailing Status : </td>
					<td>';
						if($value['invoice_mail_status'] == "Send"){ 
					$html .= '		<img src="images/mail-s.png" class="img-responsive" style="width:10px;" alt="1"> &nbsp; Sent &nbsp; &nbsp; ';
		
						}else{ 
					$html .= '		&nbsp; <img src="images/mail-ns.png" class="img-responsive" style="width:10px;" alt="1">&nbsp; Not Send &nbsp; &nbsp;';
						}	
		$html .= '	</td>
				</tr>
				<tr>
					<td>Last Update! :</td>
					<td>';
						if($value['update_date'] != "0000-00-00" ){ 
																		
							$_month_name = array("01"=>"January", "02"=>"February", "03"=>"March","04"=>"April", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December"); 
																													 
							list($year,$momth,$day) = explode("-",$value['update_date'] );
																										
							if ($day < 10){
								$day = substr($day,1,2);
							}
																				
							$date = $_month_name[$momth]." ".$day.",  ".$year;
														
						}else{
							$date = " - ";
						}
										
			$html .= '		<span style="color:red;font-size:12px;"> '.$date .'<span>
									
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Sales : </td>
					<td>'. $value['fullname'].'</td>
				</tr>
				<tr>
					<td>Phone : </td>
					<td> '. $value['phone'].'</td>
				</tr>
				<tr>
					<td>Email : </td>
					<td>'. $value['email'].'</td>
				</tr>
				<tr>
					<td>Prosition : </td>
						<td style="padding:0 5px;">';
							if($value['sales_status'] == 1){
		$html .= '				Manager';
							}elseif($value['sales_status'] == 2){
		$html .= '				Sales Rep';
							}elseif($value['sales_status'] == 3){
		$html .= '				Processor';
							}
		$html .= '
									</td>
								</tr>
			</table>
			<br>				
		<div >	
			<table style="width: 100%;max-width: 100%;margin-bottom: 20px;border-spacing: 0;border-collapse: collapse;border: 1px solid #ddd;border-collapse: initial;">
				<thead style="display: table-header-group;vertical-align: middle;border-color: inherit;">
					<tr>
						<th colspan="4" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Invoice </th>
						<th colspan="4" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Commission Calculator </th>
						<th colspan="4" style="background-color:#89939c;color:rgb(51, 67, 80);text-align: center;border: 1px solid #ddd;padding:8px;"> Commission </th>
					</tr>
					<tr>
						<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:5px 10px;" > Payment Status </th>
						<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:5px 10px;" > Date </th>
						<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:5px 10px;" > Amount Received </th>
						<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:5px 10px;" > Payment Method </th>
						
						<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:5px 10px;" > Total Sales </th>
						<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:5px 10px;" > Commission% </th>
						<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:5px 10px;" > Commission </th>
						<th  style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:5px 10px;"> Balance </th>
						
						<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:5px 10px;" > Payment Status </th>
						<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:5px 10px;" > Date </th>
						<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:5px 10px;" > Payment </th>
						<th style="background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: center;border: 1px solid #ddd;padding:5px 10px;" > Payment Method</th>
	
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px;">';
						
							if($value['invoice_status'] == "Outstanding"){
		$html .= '				<span style="color:red">'.$value['invoice_status'].'</span>';
							}else{
		$html .= '				<span>'.$value['invoice_status'].'</span>';
							}
							
		$html .= '		</td>
						<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px;">
							<span>';
								if($value['invoice_status'] == "Paid"){		
									if($value['invoice_date'] != "0000-00-00"){
										$_month_invoice = array("01"=>"Jan.", "02"=>"Feb.", "03"=>"Mar.","04"=>"Apr.", "05"=>"May.", "06"=>"Jun.", "07"=>"Jul.", "08"=>"Aug.", "09"=>"Sep.", "10"=>"Oct.", "11"=>"Nov.", "12"=>"Dec."); 
														
										$invdate = $value['invoice_date'];
										list($year_v,$momth_v,$day_v) = explode("-",$invdate);
										$yy_v = $year_v;
										$mm_v = $momth_v;
										$dd_v = $day_v; 
										if ($dd_v < 10){
											$dd_v = substr($dd_v,1,2);
										}
										$date_v = $_month_invoice[$mm_v]." ".$dd_v.",  ".$yy_v;
															
			$html .= '					'.$date_v;
									}
								}
		$html .= '			</span>
						</td>
						<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px;">';
						if($value['invoice_status'] == "Paid"){		
							if(!empty($value['invoice_amount_received'])){
								if($value['currency'] == "THB"){	
		$html .= '					<span> ฿ '.number_format($value['invoice_amount_received'] , 2).' '.$value['currency'].'</span>';
								}else{
		$html .= '					<span> $ '.number_format($value['invoice_amount_received'] , 2).' '.$value['currency'].'</span>';
								}
							}
						}	
							
		$html .= '		</td>
						<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px;">';
						if($value['invoice_status'] == "Paid"){	
						
		$html .= '			<span>'.$value['invoice_payment_method'].'</span>';
						}
						
		$html .= '		</td>
						<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;"padding:8px;>
							<span>';
								$Commissionable = ($value['total_sales'] - $value['shipping_cost']) - $value['creditcard_feecost']; 
								if($Commissionable != 0 ){
									if($value['currency'] == "THB"){
		$html .= '						฿ '.number_format($Commissionable , 2).' '.$value['currency'];
									}else{
		$html .= '						$ '.number_format($Commissionable , 2).' '.$value['currency'];								
									}
								}	
		$html .= '			</span>	
						</td>
						<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px;">';
							if($value['total_sales'] != 0 ){
		$html .= '				<span>'. $value['commission_percent'].'% </span>';
							}
		$html .= '		</td>
						<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px;">
							<span>';
								$commission = $value['commission'];
								if($value['total_sales'] != 0 ){
									if($value['currency'] == "THB"){
									
		$html .= '						฿ '.number_format($commission , 2).' '.$value['currency'];
		
									}else{
		$html .= '						$ '.number_format($commission , 2).' '.$value['currency'];								
									}
								}			
													
		$html .= '			</span>	
						</td>
											
						<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px;">';
							
							if($value['invoice_status'] == "Paid"){		
								if($value['commisson_payment_status'] == "Paid"){
															
									$balance_invoice = $value['commission'] - $value['pay_for_sales'];
									if($balance_invoice != 0 ){
										if($value['currency'] == "THB"){
			$html .= '						<span style="color:red"> ฿ '.number_format($balance_invoice  , 2).' '.$value['currency'].'</span>';
										}else{
			$html .= '						<span style="color:red"> $ '.number_format($balance_invoice  , 2).' '.$value['currency'].'</span>';
										}
									}else{
										if($value['currency'] == "THB"){
			$html .= '					<span> ฿ '.number_format($balance_invoice  , 2).' '.$value['currency'].'</span>';
										}else{
			$html .= '					<span> $ '.number_format($balance_invoice  , 2).' '.$value['currency'].'</span>';								
										}
									}
															
								}else{
									if($Commissionable != 0 ){
										if($value['currency'] == "THB"){
			$html .= '						<span style="color:red"> ฿ '.number_format($value['commission'] , 2).' '.$value['currency'].'</span>';
										}else{
			$html .= '						<span style="color:red"> $ '.number_format($value['commission'] , 2).' '.$value['currency'].'</span>';
										}
									}
								}
							}	
		$html .= '										
						</td>
						
						<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px;">';
							if($value['commisson_payment_status'] == "Outstanding"){
								$html .= '<span style="color:red">'.$value['commisson_payment_status'].'</span>';
							}else{
								$html .= '<span>'.$value['commisson_payment_status'].'</span>';
							}
		$html .= '		</td>
											
						<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px;">
							<span>';
							if($value['invoice_status'] == "Paid" && $value['commisson_payment_status'] == "Paid"){		
								if($value['date_for_sales'] != "0000-00-00"){
									$_month_name_s = array("01"=>"Jan.", "02"=>"Feb.", "03"=>"Mar.","04"=>"Apr.", "05"=>"May.", "06"=>"Jun.", "07"=>"Jul.", "08"=>"Aug.", "09"=>"Sep.", "10"=>"Oct.", "11"=>"Nov.", "12"=>"Dec.");
																 
									$date_for_sales = $value['date_for_sales'];
									list($year_s,$momth_s,$day_s) = explode("-",$date_for_sales);
													
									if ($day_s < 10){
										$day_s = substr($day_s,1,2);
									}
									$date_s = $_month_name_s[$momth_s]." ".$day_s.",  ".$year_s;
													
		$html .= '					'.$date_s;
								}			
							}					
		$html .= '			</span>
						</td>
						<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px;"> 
							<span>';
							if($value['invoice_status'] == "Paid" && $value['commisson_payment_status'] == "Paid"){	 
								if($value['pay_for_sales'] != 0){
									if($value['currency'] == "THB"){	
		$html .= '						฿ '.number_format($value['pay_for_sales'] , 2).' '.$value['currency'];
									}else{
		$html .= '						$ '.number_format($value['pay_for_sales'] , 2).' '.$value['currency'];								
									}
								}
							}					
		$html .= '			</span>												
						</td>
						<td style="vertical-align: middle;text-align: center;border: 1px solid #ddd;white-space: nowrap;padding:8px;">';
						
							if($value['invoice_status'] == "Paid" && $value['commisson_payment_status'] == "Paid"){
						
		$html .= '				<span> '.$value['payment_method'].'</span>';
							}
		$html .= '		</td>
											
					</tr>	
				</tbody>
			</table>
		</div>
		
	';
	
	
				}
$html .='
	<br>
	<br>';
	
	$comments = Yii::app()->db->createCommand('select * from comments where invoice = "'.$id.'" order by date_comments DESC ')->queryAll();
		if(!empty($comments)){
				
$html .='	<div class="form-group">
									
				<h2>Comments</h2>';			
			 
				foreach ($comments as $cmm => $comment){
	
$html .='			<div>
						<label>'.$comment['salerep'].' : </label>
							<span>'.$comment['comments'].'</span> 
							<br />
							<sup>'.$comment['date_comments'].'</sup>
					</div>		
					<hr>';
				} 
			
$html .='	<br>
			
			</div>
	<br>
	<br>';
	
		}
	
$html .='<table style="border: 1px solid #ddd;width: 100%;max-width: 100%;margin-bottom: 20px;background-color: transparent;border-spacing: 0;border-collapse: collapse;">
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
	$html .='		<td style="font-size:13px;color: #73879C;padding: 10px 5px;">'. nl2br($value['notes']).'</td>';
				}	
				foreach ($bank as $key_bank => $value_bank) {
	$html .='		<td style="font-size:13px;color: #73879C;padding: 5px 5px;">
						<div><span style="font-weight: 700;" >Bank Name : </span>'.$value_bank['bank_name'].'</div>
						<div><span style="font-weight: 700;" >Account Name : </span>'.$value_bank['bank_account_name'].'</div>
						<div><span style="font-weight: 700;" >Account Number : </span>'.$value_bank['bank_number'].'</div>
						<div><span style="font-weight: 700;" >Swift Code : </span>'.$value_bank['bank_swift_code'].'</div>
						<div><span style="font-weight: 700;" >Make check payable to : </span>'. $value_bank['bank_name_check'].'</div>
						<div><span style="font-weight: 700;" >Mailing Address : </span>'.$value_bank['bank_mailing_address'].'</div>
						<div><span style="font-weight: 700;" >Other : </span>'.$value_bank['bank_other'].'</div>
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