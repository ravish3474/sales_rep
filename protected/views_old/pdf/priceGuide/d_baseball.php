<?php


/*$html = '
<img src="images/jog-logo3.png" class="img-responsive" style="width:30px;margin-bottom:20px;" alt="1">&nbsp; &nbsp;
<img src="images/jog_athl.png" class="img-responsive" style="width:100px;" alt="1">';*/
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

$toppic = Yii::app()->db->createCommand('select *  from category where type = "Baseball" ')->queryAll();
	foreach ($toppic as $key_topic => $value_topic) {
						
$html .= '<h2>'.$value_topic['details'].'</h2>';						
	}

$html .= '
<h3>Sales Dealers Pricing</h3>
	<div>
		<table style="border: 1px solid #ddd;width: 100%;max-width: 100%;margin-bottom: 20px;background-color: transparent;border-spacing: 0;border-collapse: collapse;">
			<thead style="display: table-header-group;vertical-align: middle;border-color: inherit;">';
				$header = Yii::app()->db->createCommand('select * from dheader where type = "Baseball" ')->queryAll();
					foreach ($header as $key_header => $value_header) {
				
				$html .= '	
				<tr>
					<th rowspan = "2" style="background-color: #5c656d ;border: 1px solid #848d94 ;color: #fff;border-top: 0;vertical-align: middle;padding: 8px;line-height: 1.42857143;text-align: center;font-weight: bold;">'.$value_header['r1c1'].'</th>
					<th rowspan = "2" style="background-color: #5c656d ;border: 1px solid #848d94 ;color: #fff;border-top: 0;vertical-align: middle;padding: 8px;line-height: 1.42857143;text-align: left;font-weight: bold;width:200px;"> '.$value_header['r1c2'].'</th>
					<th style="background-color: #b7bdc1;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c5'].'</th>
					<th style="background-color: #d2dae0;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c6'].'</th>
					<th style="background-color: #b7bdc1;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c7'].'</th>
					<th style="background-color: #d2dae0;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c8'].'</th>
					<th style="background-color: #b7bdc1;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c9'].'</th>
					<th style="background-color: #d2dae0;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c10'].'</th>
					<th style="background-color: #b7bdc1;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c11'].'</th>
					<th style="background-color: #d2dae0;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c12'].'</th>
					<th style="background-color: #b7bdc1;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c13'].'</th>
					<th style="background-color: #d0d0d0;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c14'].'</th>
					
				</tr>
				<tr>
					<th style="background-color: #d2dae0 ;border: 1px solid #fff ;color: #404040;text-align: center;" colspan="10">'.$curr_name.'</th>
				</tr>
				<tr>
					<th style="background-color: #252c2f !important;border: 1px solid #848d94 !important;color: #fff;" colspan="2">'.$value_header['r3c1_2'].'</th>
					<th style="background-color: #b7bdc1;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;" >'.$value_header['r3c5'].'</th>
					<th style="background-color: #d2dae0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;" >'.$value_header['r3c6'].'</th>
					<th style="background-color: #b7bdc1;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;" >'.$value_header['r3c7'].'</th>
					<th style="background-color: #d2dae0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;" >'.$value_header['r3c8'].'</th>
					<th style="background-color: #b7bdc1;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;" >'.$value_header['r3c9'].'</th>
					<th style="background-color: #d2dae0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;" >'.$value_header['r3c10'].'</th>
					<th style="background-color: #b7bdc1;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;" >'.$value_header['r3c11'].'</th>
					<th style="background-color: #d2dae0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;" >'.$value_header['r3c12'].'</th>
					<th style="background-color: #b7bdc1;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;" >'.$value_header['r3c13'].'</th>
					<th style="background-color: #d0d0d0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;" >'.$value_header['r3c14'].'</th>
					
				</tr>';
				}
	$html .= 	'
			</thead>
			<tbody>';
				$baseball = Yii::app()->db->createCommand('select *  from baseball where 1 order by sort_data ASC')->queryAll();
					foreach ($baseball as $key => $value) {
						switch ($curr) {
									case 0:
										$d_qty1= $value['d_qty1'];
										$d_qty2= $value['d_qty2'];
										$d_qty3= $value['d_qty3'];
										$d_qty4= $value['d_qty4'];
										$d_qty5= $value['d_qty5'];
										$d_qty6= $value['d_qty6'];
										$d_qty7= $value['d_qty7'];
										$d_qty8= $value['d_qty8'];
										$d_qty9= $value['d_qty9'];
										$d_msrp= $value['d_msrp'];
										break;
									case 1:
										$d_qty1= $value['d_qty1_1'];
										$d_qty2= $value['d_qty2_1'];
										$d_qty3= $value['d_qty3_1'];
										$d_qty4= $value['d_qty4_1'];
										$d_qty5= $value['d_qty5_1'];
										$d_qty6= $value['d_qty6_1'];
										$d_qty7= $value['d_qty7_1'];
										$d_qty8= $value['d_qty8_1'];
										$d_qty9= $value['d_qty9_1'];
										$d_msrp= $value['d_msrp_1'];
										break;
									case 2:
										$d_qty1= $value['d_qty1_2'];
										$d_qty2= $value['d_qty2_2'];
										$d_qty3= $value['d_qty3_2'];
										$d_qty4= $value['d_qty4_2'];
										$d_qty5= $value['d_qty5_2'];
										$d_qty6= $value['d_qty6_2'];
										$d_qty7= $value['d_qty7_2'];
										$d_qty8= $value['d_qty8_2'];
										$d_qty9= $value['d_qty9_2'];
										$d_msrp= $value['d_msrp_2'];
										break;
									case 3:
										$d_qty1= $value['d_qty1_3'];
										$d_qty2= $value['d_qty2_3'];
										$d_qty3= $value['d_qty3_3'];
										$d_qty4= $value['d_qty4_3'];
										$d_qty5= $value['d_qty5_3'];
										$d_qty6= $value['d_qty6_3'];
										$d_qty7= $value['d_qty7_3'];
										$d_qty8= $value['d_qty8_3'];
										$d_qty9= $value['d_qty9_3'];
										$d_msrp= $value['d_msrp_3'];
										break;
									case 4:
										$d_qty1= $value['d_qty1_4'];
										$d_qty2= $value['d_qty2_4'];
										$d_qty3= $value['d_qty3_4'];
										$d_qty4= $value['d_qty4_4'];
										$d_qty5= $value['d_qty5_4'];
										$d_qty6= $value['d_qty6_4'];
										$d_qty7= $value['d_qty7_4'];
										$d_qty8= $value['d_qty8_4'];
										$d_qty9= $value['d_qty9_4'];
										$d_msrp= $value['d_msrp_4'];
										break;
									case 5:
										$d_qty1= $value['d_qty1_5'];
										$d_qty2= $value['d_qty2_5'];
										$d_qty3= $value['d_qty3_5'];
										$d_qty4= $value['d_qty4_5'];
										$d_qty5= $value['d_qty5_5'];
										$d_qty6= $value['d_qty6_5'];
										$d_qty7= $value['d_qty7_5'];
										$d_qty8= $value['d_qty8_5'];
										$d_qty9= $value['d_qty9_5'];
										$d_msrp= $value['d_msrp_5'];
										break;
									}
								if($d_qty1!=0){$p1=$d_qty1.' +';}else{$p1='';}
								if($d_qty2!=0){$p2=$d_qty2.' +';}else{$p2='';}
								if($d_qty3!=0){$p3=$d_qty3.' +';}else{$p3='';}
								if($d_qty4!=0){$p4=$d_qty4.' +';}else{$p4='';}
								if($d_qty5!=0){$p5=$d_qty5.' +';}else{$p5='';}
								if($d_qty6!=0){$p6=$d_qty6.' +';}else{$p6='';}
								if($d_qty7!=0){$p7=$d_qty7.' +';}else{$p7='';}
								if($d_qty8!=0){$p8=$d_qty8.' +';}else{$p8='';}
								if($d_qty9!=0){$p9=$d_qty9.' +';}else{$p9='';}
								if($d_msrp!=0){$p10=$d_msrp.' +';}else{$p10='';}
	$html .= 	'<tr>
					<td style="border: 1px solid #ddd;color: #000;padding: 5px 5px;">'. $value['category'].'</td>
					<td style="border: 1px solid #ddd;color: #000;padding: 5px 5px;">'. $value['notes'].'</td>
					<td style="background-color: #b7bdc1;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;font-weight: bold;">'.$p1.'</td>
					<td style="background-color: #d2dae0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;font-weight: bold;">'.$p2.'</td>
					<td style="background-color: #b7bdc1;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;font-weight: bold;">'.$p3.'</td>
					<td style="background-color: #d2dae0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;font-weight: bold;">'.$p4.'</td>
					<td style="background-color: #b7bdc1;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;font-weight: bold;">'.$p5.'</td>
					<td style="background-color: #d2dae0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;font-weight: bold;">'.$p6.'</td>
					<td style="background-color: #b7bdc1;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;font-weight: bold;">'.$p7.'</td>
					<td style="background-color: #d2dae0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;font-weight: bold;">'.$p8.'</td>
					<td style="background-color: #b7bdc1;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;font-weight: bold;">'.$p9.'</td>
					<td style="background-color: #d0d0d0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;font-weight: bold;">'.$p10.'</td>
					
				</tr>';
					} 
	$html .=
			'</tbody>
		</table><br><br>

		<table style="border: 1px solid #ddd;width: 100%;max-width: 100%;margin-bottom: 20px;background-color: transparent;border-spacing: 0;border-collapse: collapse;">
			<thead style="display: table-header-group;vertical-align: middle;border-color: inherit;">
				<tr style="display: table-row;vertical-align: inherit;border-color: inherit;">
					<th style="border-top: 0;vertical-align: middle;padding: 8px;line-height: 1.42857143;background-color: #5c656d !important;border: 1px solid #848d94 ;color: #fff;text-align: left;" colspan="2">Notes</th>
				</tr>
			</thead>
			<tbody>';
			$notes= Yii::app()->db->createCommand('select *  from notes where type = "Baseball"')->queryAll();
				foreach ($notes as $key => $value) {
	$html .=	'<tr>
					<td style="font-size:13px;color: #000;padding: 5px 5px;">'. nl2br($value['notes']).'</td>
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
$mpdf=new mPDF('c'); 

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

//==============================================================
//==============================================================
//==============================================================


?>