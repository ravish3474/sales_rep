<style> 
table, tr, td {
	border:1px solid #00182f
}
td{
	padding:8px;
}
</style> 

<table style="width:500px;">
	<thead>
		<tr style="background-color: #004080;">
			<td colspan="2" style="margin: auto">
				<h2 style="text-align:center;vertical-align: middle;color:#fff;"><img src="https://jogsports.com/salesrep/images/jog-logo.png">&nbsp; INVOICE </h2>
			</td>
		</tr>
	<thead>
	<tbody>
	<?php 
		$data_invoice = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator cal')
				->where('cal.id = "'.$id.'"')
			    ->queryAll();
			
			foreach ($data_invoice as $key_invoice => $value_invoice) {
	?>
	<tr >
		<td style="width:20%">
			Invoice : 
		</td>
		<td style="width:80%">
			<?php echo $value_invoice['invoice']; ?>
		</td>
	</tr>
	<tr >
		<td>
			Order Name : 
		</td>
		<td>
			<?php echo $order_name; ?>
		</td>
	</tr>
	<tr >
		<td>
			Date : 
		</td>
		<td>
			<?php 
			
				if($value_invoice['date_quarter'] != "0000-00-00"){
					$_month_name_s = array("01"=>"January", "02"=>"February", "03"=>"March","04"=>"April", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December"); 
														 
					$date_quarter = $value_invoice['date_quarter'];
					list($year_s,$momth_s,$day_s) = explode("-",$date_quarter);
											
					if ($day_s < 10){
						$day_s = substr($day_s,1,2);
					}
					$date_s = $_month_name_s[$momth_s]." ".$day_s.",  ".$year_s;
				}		
				
				echo $date_s; 
			?>
		</td>
	</tr>
	<tr >
		<td>
			Invoice File : 
		</td>
		<td>
			<?php if($value_invoice['file_path'] != "Array" && $value_invoice['file_path'] != ""){ ?>
			<a href="https://jogsports.com/salesrep/invoice/docs/<?php echo $value_invoice['file_path'];?>" target="_blank"><i class="fa fa-file-text-o" aria-hidden="true"></i> >>> Click Here <<< </a>
			<?php } ?>
		</td>
	</tr>
			
	<tr >
		<td>
			Messages : 
		</td>
		<td>
			<?php 
			
			function autolink($messages)
				{

				//สร้างลิงค์อีเมล์
				$messages = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\"><font color=#FF6600>\\2@\\3</font></a>", $messages);

				// สร้างลิ้งค์ http://
				$messages = preg_replace("#(^|[\n ])([\w]+?://[^ \"\n\r\t<]*)#is", "\\1<a href=\"\\2\" target=\"_blank\"><font color=#FF6600>\\2</font></a>", $messages);

				//สร้างลิ้ล์ www.
				$messages = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r<]*)#is", "\\1<a href=\"http://\\2\" target=\"_blank\"><font color=#FF6600>\\2</font></a>", $messages);

				return ( $messages ) ;

				}
			
			
			
			
			echo autolink($messages); ?>
		</td>
	</tr>
	<tr >
		<td>
			Invoice Payment Status :
		</td>
		<td>
			<?php 
			
			if($value_invoice['invoice_status'] == "Paid"){
				echo $value_invoice['invoice_status'];
			}else{
				echo "<span style=\"color:red\">".$value_invoice['invoice_status']."<span>";
			}
			 ?>
		</td>
	</tr>	
	
	
	<?php } ?>
	<tbody>
</table>