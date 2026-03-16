<table class="cls_tbl_sale_type">
	<tr>
		<th >
			#
		</th>
		<th style="text-align: center;">Percentage</th>
		<th style="text-align: center;">Increase / Decrease</th>
		<th style="text-align: center;">Update Date</th>
		<th style="text-align: center;">Undo</th>
	</tr>
	<?php
	for($i=0;$i<sizeof($a_sat);$i++){
		$row_sat = $a_sat[$i];
	?>
		<tr>
			<td style="text-align: center;"><?php echo $i+1;?></td>
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
				<button class="btn btn-primary" onclick="undo_change(<?=$row_sat["percent_value"]?>,<?=$row_sat["increase_decrease"]?>,<?=$row_sat["change_id"]?>)">UNDO</button>
			<?php }elseif($i==0 && $row_sat["undo_status"]==1){?>
				<button class="btn btn-danger">UNDO DONE</button>
			<?php }?>
			</td>
		</tr>
	<?php
	}
	?>
</table>