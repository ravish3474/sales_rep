<?php
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=PG_Dealers_Tracksuits_".date("Ymd").".xls");
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

$toppic = Yii::app()->db->createCommand('select *  from category where type = "Tracksuits" ')->queryAll();
	foreach ($toppic as $key_topic => $value_topic) {
						
$html .= '<h2>'.$value_topic['details'].'</h2>';						
	}

$html .= '
<h3> Dealers Pricing</h3>
	<div>
		<table style="border: 1px solid #ddd;width: 100%;max-width: 100%;margin-bottom: 20px;background-color: transparent;border-spacing: 0;border-collapse: collapse;">
			<thead style="display: table-header-group;vertical-align: middle;border-color: inherit;">';
				$header = Yii::app()->db->createCommand('select * from dealer_header where type = "Tracksuits" ')->queryAll();
					foreach ($header as $key_header => $value_header) {
				
				$html .= '	
				<tr >
					<th rowspan = "2" style="background-color: #5c656d ;border: 1px solid #848d94 ;color: #fff;border-top: 0;vertical-align: middle;padding: 8px;line-height: 1.42857143;text-align: center;font-weight: bold;">'.$value_header['r1c1'].'</th>
					<th rowspan = "2" style="background-color: #5c656d ;border: 1px solid #848d94 ;color: #fff;border-top: 0;vertical-align: middle;padding: 8px;line-height: 1.42857143;text-align: center;font-weight: bold;"> '.$value_header['r1c2'].'</th>
					<th rowspan = "2" style="background-color: #5c656d ;border: 1px solid #848d94 ;color: #fff;border-top: 0;vertical-align: middle;padding: 8px;line-height: 1.42857143;text-align: center;font-weight: bold;"> '.$value_header['r1c3'].'</th>
					<th rowspan = "2" style="background-color: #5c656d ;border: 1px solid #848d94 ;color: #fff;border-top: 0;vertical-align: middle;padding: 8px;line-height: 1.42857143;text-align: center;font-weight: bold;"> '.$value_header['r1c4'].'</th>
					<th style="background-color: #b7bdc1;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c5'].'</th>
					<th style="background-color: #d2dae0;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c6'].'</th>
					<th style="background-color: #b7bdc1;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c7'].'</th>
					<th style="background-color: #d0d0d0;color: #404040;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;"> '.$value_header['r1c8'].'</th>
					
				</tr>
				<tr >
					<th style="background-color: #d2dae0 ;border: 1px solid #fff ;color: #404040;text-align: center;" colspan="4">'.$curr_name.'</th>
				</tr>';
				
					}
					
	$html .= '	
			</thead>
			<tbody>';
				$tracksuits= Yii::app()->db->createCommand('select *  from tracksuits where 1 order by sort_data ASC')->queryAll();
					foreach ($tracksuits as $key => $value) {
						switch ($curr) {
									case 0:
										$dealers_qty1= $value['dealers_qty1'];
										$dealers_qty2= $value['dealers_qty2'];
										$dealers_qty3= $value['dealers_qty3'];
										$dealers_msrp= $value['dealers_msrp'];
										break;
									case 1:
										$dealers_qty1= $value['dealers_qty1_1'];
										$dealers_qty2= $value['dealers_qty2_1'];
										$dealers_qty3= $value['dealers_qty3_1'];
										$dealers_msrp= $value['dealers_msrp_1'];
										break;
									case 2:
										$dealers_qty1= $value['dealers_qty1_2'];
										$dealers_qty2= $value['dealers_qty2_2'];
										$dealers_qty3= $value['dealers_qty3_2'];
										$dealers_msrp= $value['dealers_msrp_2'];
										break;
									case 3:
										$dealers_qty1= $value['dealers_qty1_3'];
										$dealers_qty2= $value['dealers_qty2_3'];
										$dealers_qty3= $value['dealers_qty3_3'];
										$dealers_msrp= $value['dealers_msrp_3'];
										break;
									case 4:
										$dealers_qty1= $value['dealers_qty1_4'];
										$dealers_qty2= $value['dealers_qty2_4'];
										$dealers_qty3= $value['dealers_qty3_4'];
										$dealers_msrp= $value['dealers_msrp_4'];
										break;
									case 5:
										$dealers_qty1= $value['dealers_qty1_5'];
										$dealers_qty2= $value['dealers_qty2_5'];
										$dealers_qty3= $value['dealers_qty3_5'];
										$dealers_msrp= $value['dealers_msrp_5'];
										break;
									}
								if($dealers_qty1!=0){$p1=$dealers_qty1.' +';}else{$p1='';}
								if($dealers_qty2!=0){$p2=$dealers_qty2.' +';}else{$p2='';}
								if($dealers_qty3!=0){$p3=$dealers_qty3.' +';}else{$p3='';}
								if($dealers_msrp!=0){$p4=$dealers_msrp.' +';}else{$p4='';}
	$html .= 	'<tr>
					<td style="border: 1px solid #ddd;color: #000;padding: 0 5px;">'. $value['category'].'</td>
					<td style="border: 1px solid #ddd;color: #000;padding: 0 5px;">'. nl2br($value['discription']).'</td>
					<td style="border: 1px solid #ddd;color: #000;padding: 0 5px;">'. $value['style'].'</td>
					<td style="border: 1px solid #ddd;color: #000;padding: 0 5px;">'. $value['notes'].'</td>
					<td style="background-color: #b7bdc1;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;font-weight: bold;">'.$p1.'</td>
					<td style="background-color: #d2dae0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;font-weight: bold;">'.$p2.'</td>
					<td style="background-color: #b7bdc1;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;font-weight: bold;">'.$p3.'</td>
					<td style="background-color: #d0d0d0;color: #404040;white-space: nowrap;text-align: center;border: 1px solid #fff;padding-left:5px;padding-right:5px;font-weight: bold;">'.$p4.'</td>
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
			$notes= Yii::app()->db->createCommand('select *  from notes where type = "Tracksuits"')->queryAll();
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

echo $html;

//==============================================================
//==============================================================
//==============================================================


?>