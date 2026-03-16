<table class="cls_tbl_sale_type table">
	<tr>
		<th >
			#
		</th>
		<th style="text-align: center;">Product</th>
		<th style="text-align: center;">Currency</th>
		<th style="text-align: center;">Type</th>
		<th style="text-align: center;">Value</th>
		<th style="text-align: center;">Increase / Decrease</th>
		<th style="text-align: center;">Update Date</th>
		<th style="text-align: center;">Undo</th>
	</tr>
	<?php
	for($i=0;$i<sizeof($a_sat);$i++){
		$row_sat = $a_sat[$i];

		switch ($row_sat["sat_id"]) {
			case '0':
				$sat_name = 'ALL';
				break;
			case '1':
				$sat_name = 'Sales Direct';
				break;
			case '2':
				$sat_name = 'Sales Dealers ';
				break;
			case '6':
				$sat_name = 'Factory Direct ';
				break;
			
			default:
				$sat_name = "";
				break;
		}
	?>
		<tr>
			<td style="text-align: center;"><?php echo $i+1;?></td>
			<td style="text-align: center;"><?php echo $row_sat["prod_name"]; ?></td>
			<td style="text-align: center;"><?php echo $row_sat["curr_name"]; ?> (<?php echo $row_sat["curr_desc"]; ?>)</td>
			<td style="text-align: center;"><?php echo $sat_name; ?></td>
			<td style="text-align: center;"><?php echo $row_sat["percent_value"]; ?></td>
			<td style="text-align: center;"><?php
			if ($row_sat["increase_decrease"]==1) {
				echo "Increased";
			}
			else{
				echo "Decreased";
			}
			?></td>
			<td style="text-align: center;"><?=$row_sat["change_timestamp"]?></td>
			<td style="text-align:center">
				<?php if($i==0 && $row_sat["undo_status"]==0){?>
				<button class="btn btn-primary" onclick="undo_change_product(<?=$row_sat["percent_value"]?>,<?=$row_sat["increase_decrease"]?>,<?=$row_sat["change_id"]?>,<?=$row_sat["prod_id"]?>,<?=$row_sat["curr_id"]?>,<?=$row_sat["sat_id"]?>)">UNDO</button>
			<?php }elseif($i==0 && $row_sat["undo_status"]==1){?>
				<button class="btn btn-danger">UNDO DONE</button>
			<?php }?>
			</td>
		</tr>
	<?php
	}
	?>
</table>