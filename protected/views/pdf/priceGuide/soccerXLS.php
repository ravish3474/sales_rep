<?php
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=PG_Sales_Direct_Soccer_".date("Ymd").".xls");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);

$html = '';

if(isset($_GET['curr'])){$curr=$_GET['curr'];}else{$curr=0;}

switch ($curr) {
	case 0:
		$curr_name='USD North America';
		break;
	case 1:
		$curr_name='CAD North America';
		break;
	case 2:
		$curr_name='USD Europe and South America';
		break;
	case 3:
		$curr_name='USD ASIA and Australia';
		break;
	case 4:
		$curr_name='THB Thai Baht';
		break;
	case 5:
		$curr_name='SGD Singapore';
		break;
	}


$toppic = Yii::app()->db->createCommand('select *  from category where type = "Soccer" ')->queryAll();
	foreach ($toppic as $key_topic => $value_topic) {
						
$html .= '<h2>'.$value_topic['details'].'</h2>';						
	}

$html .= '
<h3>Sales Direct Pricing</h3>
	<div>
		<table style="border: 1px solid #ddd;width: 100%;max-width: 100%;margin-bottom: 20px;background-color: transparent;border-spacing: 0;border-collapse: collapse;">
			<thead style="display: table-header-group;vertical-align: middle;border-color: inherit;">';
			
				$header = Yii::app()->db->createCommand('select * from header where type = "Soccer" ')->queryAll();
					foreach ($header as $key_header => $value_header) {
				
				$html .= '	
				<tr>
					<th rowspan = "2" style="background-color: #5c656d ;border: 1px solid #848d94 ;color: #fff;border-top: 0;vertical-align: middle;padding: 8px;line-height: 1.42857143;text-align: center;font-weight: bold;">'.$value_header['r1c1'].'</th>
					<th rowspan = "2" style="background-color: #5c656d ;border: 1px solid #848d94 ;color: #fff;border-top: 0;vertical-align: middle;padding: 8px;line-height: 1.42857143;text-align: left;font-weight: bold;width:200px;"> '.$value_header['r1c2'].'</th>
					
					<th style="background-color: #d2dae0;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c6'].'</th>
					<th style="background-color: #b7bdc1;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c7'].'</th>
					<th style="background-color: #d2dae0;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c8'].'</th>
					<th style="background-color: #b7bdc1;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c9'].'</th>
					
					<th style="background-color: #d2dae0;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c11'].'</th>
					<th style="background-color: #b7bdc1;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c12'].'</th>
					<th style="background-color: #d2dae0;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c13'].'</th>
					<th style="background-color: #b7bdc1;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c14'].'</th>
					
					<th style="background-color: #d2dae0;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c16'].'</th>
					<th style="background-color: #b7bdc1;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c17'].'</th>
					<th style="background-color: #d2dae0;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c18'].'</th>
					<th style="background-color: #b7bdc1;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c19'].'</th>
					<th style="background-color: #d0d0d0;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;" >'.$value_header['r1c20'].'</th>
				</tr>
				<tr>
					<th style="background-color: #d2dae0 ;border: 1px solid #fff ;color: #404040;text-align: center;" colspan="13">'.$curr_name.'</th>
				</tr>
				<tr>
					<th style="background-color: #252c2f !important;border: 1px solid #848d94 !important;color: #fff;" colspan="2">'.$value_header['r3c1_2'].'</th>
					
					<th style="background-color: #d2dae0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;" >'.$value_header['r3c6'].'</th>
					<th style="background-color: #b7bdc1;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;" >'.$value_header['r3c7'].'</th>
					<th style="background-color: #d2dae0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;" >'.$value_header['r3c8'].'</th>
					<th style="background-color: #b7bdc1;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;" >'.$value_header['r3c9'].'</th>
					
					<th style="background-color: #b7bdc1;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;" >'.$value_header['r3c11'].'</th>
					<th style="background-color: #d2dae0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;" >'.$value_header['r3c12'].'</th>
					<th style="background-color: #b7bdc1;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;" >'.$value_header['r3c13'].'</th>
					<th style="background-color: #d2dae0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;" >'.$value_header['r3c14'].'</th>
					
					<th style="background-color: #d2dae0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;" >'.$value_header['r3c16'].'</th>
					<th style="background-color: #b7bdc1;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;" >'.$value_header['r3c17'].'</th>
					<th style="background-color: #d2dae0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;" >'.$value_header['r3c18'].'</th>
					<th style="background-color: #b7bdc1;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;" >'.$value_header['r3c19'].'</th>
					<th style="background-color: #d0d0d0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;" >'.$value_header['r3c20'].'</th>
				</tr>';
				}
	$html .= 	'
			</thead>
			<tbody>';
				$soccer = Yii::app()->db->createCommand('select *  from soccer where 1 order by sort_data ASC')->queryAll();
					foreach ($soccer as $key => $value) {
						switch ($curr) {
									case 0:
										$qty2= $value['qty2'];
										$qty3= $value['qty3'];
										$qty4= $value['qty4'];
										$qty5= $value['qty5'];
										$qty7= $value['qty7'];
										$qty8= $value['qty8'];
										$qty9= $value['qty9'];
										$qty10= $value['qty10'];
										$qty12= $value['qty12'];
										$qty13= $value['qty13'];
										$qty14= $value['qty14'];
										$qty15= $value['qty15'];
										$msrp= $value['msrp'];
										break;
									case 1:
										$qty2= $value['qty2_1'];
										$qty3= $value['qty3_1'];
										$qty4= $value['qty4_1'];
										$qty5= $value['qty5_1'];
										$qty7= $value['qty7_1'];
										$qty8= $value['qty8_1'];
										$qty9= $value['qty9_1'];
										$qty10= $value['qty10_1'];
										$qty12= $value['qty12_1'];
										$qty13= $value['qty13_1'];
										$qty14= $value['qty14_1'];
										$qty15= $value['qty15_1'];
										$msrp= $value['msrp_1'];
										break;
									case 2:
										$qty2= $value['qty2_2'];
										$qty3= $value['qty3_2'];
										$qty4= $value['qty4_2'];
										$qty5= $value['qty5_2'];
										$qty7= $value['qty7_2'];
										$qty8= $value['qty8_2'];
										$qty9= $value['qty9_2'];
										$qty10= $value['qty10_2'];
										$qty12= $value['qty12_2'];
										$qty13= $value['qty13_2'];
										$qty14= $value['qty14_2'];
										$qty15= $value['qty15_2'];
										$msrp= $value['msrp_2'];
										break;
									case 3:
										$qty2= $value['qty2_3'];
										$qty3= $value['qty3_3'];
										$qty4= $value['qty4_3'];
										$qty5= $value['qty5_3'];
										$qty7= $value['qty7_3'];
										$qty8= $value['qty8_3'];
										$qty9= $value['qty9_3'];
										$qty10= $value['qty10_3'];
										$qty12= $value['qty12_3'];
										$qty13= $value['qty13_3'];
										$qty14= $value['qty14_3'];
										$qty15= $value['qty15_3'];
										$msrp= $value['msrp_3'];
										break;
									case 4:
										$qty2= $value['qty2_4'];
										$qty3= $value['qty3_4'];
										$qty4= $value['qty4_4'];
										$qty5= $value['qty5_4'];
										$qty7= $value['qty7_4'];
										$qty8= $value['qty8_4'];
										$qty9= $value['qty9_4'];
										$qty10= $value['qty10_4'];
										$qty12= $value['qty12_4'];
										$qty13= $value['qty13_4'];
										$qty14= $value['qty14_4'];
										$qty15= $value['qty15_4'];
										$msrp= $value['msrp_4'];
										break;
									case 5:
										$qty2= $value['qty2_5'];
										$qty3= $value['qty3_5'];
										$qty4= $value['qty4_5'];
										$qty5= $value['qty5_5'];
										$qty7= $value['qty7_5'];
										$qty8= $value['qty8_5'];
										$qty9= $value['qty9_5'];
										$qty10= $value['qty10_5'];
										$qty12= $value['qty12_5'];
										$qty13= $value['qty13_5'];
										$qty14= $value['qty14_5'];
										$qty15= $value['qty15_5'];
										$msrp= $value['msrp_5'];
										break;
									}
								if($qty2!=0){$p2=$qty2.' +';}else{$p2='';}
								if($qty3!=0){$p3=$qty3.' +';}else{$p3='';}
								if($qty4!=0){$p4=$qty4.' +';}else{$p4='';}
								if($qty5!=0){$p5=$qty5.' +';}else{$p5='';}
								if($qty7!=0){$p7=$qty7.' +';}else{$p7='';}
								if($qty8!=0){$p8=$qty8.' +';}else{$p8='';}
								if($qty9!=0){$p9=$qty9.' +';}else{$p9='';}
								if($qty10!=0){$p10=$qty10.' +';}else{$p10='';}
								if($qty12!=0){$p12=$qty12.' +';}else{$p12='';}
								if($qty13!=0){$p13=$qty13.' +';}else{$p13='';}
								if($qty14!=0){$p14=$qty14.' +';}else{$p14='';}
								if($qty15!=0){$p15=$qty15.' +';}else{$p15='';}
								if($msrp!=0){$pmsrp=$msrp.' +';}else{$pmsrp='';}
	$html .= 	'<tr>
					<td style="border: 1px solid #ddd;color: #000;padding: 0 5px;">'. $value['category'].'</td>
					<td style="border: 1px solid #ddd;color: #000;padding: 0 5px;">'. $value['notes'].'</td>
					
					<td style="background-color: #d2dae0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;font-weight: bold;">'.$p2.'</td>
					<td style="background-color: #b7bdc1;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;font-weight: bold;">'.$p3.'</td>
					<td style="background-color: #d2dae0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;font-weight: bold;">'.$p4.'</td>
					<td style="background-color: #b7bdc1;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;font-weight: bold;">'.$p5.'</td>
					
					<td style="background-color: #d2dae0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;font-weight: bold;">'.$p7.'</td>
					<td style="background-color: #b7bdc1;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;font-weight: bold;">'.$p8.'</td>
					<td style="background-color: #d2dae0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;font-weight: bold;">'.$p9.'</td>
					<td style="background-color: #b7bdc1;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;font-weight: bold;">'.$p10.'</td>
					
					<td style="background-color: #d2dae0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;font-weight: bold;">'.$p12.'</td>
					<td style="background-color: #b7bdc1;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;font-weight: bold;">'.$p13.'</td>
					<td style="background-color: #d2dae0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;font-weight: bold;">'.$p14.'</td>
					<td style="background-color: #b7bdc1;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;font-weight: bold;">'.$p15.'</td>
					<td style="background-color: #d0d0d0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;font-weight: bold;">'.$pmsrp.'</td>
					
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
					<th style="border-top: 0;vertical-align: middle;padding: 8px;line-height: 1.42857143;background-color: #5c656d !important;border: 1px solid #848d94 !important;color: #fff;text-align: left;" colspan="2">Notes</th>
				</tr>
			</thead>
			<tbody>';
			$notes= Yii::app()->db->createCommand('select *  from notes where type = "Soccer"')->queryAll();
				foreach ($notes as $key => $value) {
	$html .=	'<tr>
					<td style="font-size:13px;color: #000;padding: 0 5px;">'. nl2br($value['notes']).'</td>
				</tr>';
				}
	$html .=	'</tbody>
		</table>
	</div>

';


//==============================================================
//==============================================================
//==============================================================

echo $html;

//==============================================================
//==============================================================
//==============================================================


?>