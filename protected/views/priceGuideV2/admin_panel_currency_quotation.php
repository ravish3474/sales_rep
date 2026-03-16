<table class="cls_tbl_sale_type table">
	<tr>
		<th >
			#
		</th>
		<th style="text-align: center;">Base Currency</th>
		<th style="text-align: center;">Currency</th>
		<th style="text-align: center;">Ex.rate</th>
		<th style="text-align: center;">Action</th>
	</tr>
	<?php
	for($i=0;$i<sizeof($a_product);$i++){
		$row_sat = $a_product[$i];
	?>
		<tr>
			<td style="text-align: center;"><?php echo $i+1;?></td>
			<td style="text-align: center;">USD (NORTH AMERICA)</td>
			<td style="text-align: center;"><?php echo $row_sat["curr_name"]; ?> (<?php echo $row_sat["curr_desc"]; ?>)</td>
			<td style="text-align: center;"><input type="number" id="val_<?=$row_sat['curr_id']?>" step=".01" value="<?=$row_sat["quote_currency"]?>"></td>
			<td style="text-align: center;"><button class="btn btn-primary update_val" val_attr="<?=$row_sat['curr_id']?>">Update</button></td>
		</tr>
	<?php
	}
	?>
</table>