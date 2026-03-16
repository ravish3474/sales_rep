<table class="cls_tbl_sale_type table">
	<tr>
		<th >
			#
		</th>
		<th style="text-align: center;">Product</th>
		<th style="text-align: center;">Currency</th>
		<th style="text-align: center;">Update Date</th>
	</tr>
	<?php
	for($i=0;$i<sizeof($a_sat);$i++){
		$row_sat = $a_sat[$i];
	?>
		<tr>
			<td style="text-align: center;"><?php echo $i+1;?></td>
			<td style="text-align: center;"><?php echo $row_sat["prod_name"]; ?></td>
			<td style="text-align: center;"><?php echo $row_sat["curr_name"]; ?> (<?php echo $row_sat["curr_desc"]; ?>)</td>
			<td style="text-align: center;"><?=$row_sat["create_timestamp"]?></td>
		</tr>
	<?php
	}
	?>
</table>