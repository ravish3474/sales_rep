<table class="cls_tbl_sale_type">
	<tr>
		<th >
			Sales Type
			<i style="font-size: 20px; color: #5D3; cursor: pointer;" class="fa fa-plus" data-toggle="modal" data-target="#adminAddSaleTypeModal" ></i>
		</th>
		<th style="text-align: center;">Sorting</th>
		<th style="width: 55px; text-align: center;">Edit</th>
	</tr>
	<?php
	$id_sat_first = $a_sat[0]["sat_id"];
	$id_sat_last = $a_sat[(sizeof($a_sat)-1)]["sat_id"];

	$sat_previous_id = 0;
	$sat_next_id = 0;

	for($i=0;$i<sizeof($a_sat);$i++){
		$row_sat = $a_sat[$i];
	?>
		<tr id="sat_row<?php echo $row_sat["sat_id"]; ?>" <?php if($row_sat["enable"]=="0"){ echo ' class="disable_row" '; } ?>>
			<td id="sat_name_select<?php echo $row_sat["sat_id"]; ?>" class="select_sale_type sat_mark" onclick="return adminSelectSaleType(<?php echo $row_sat["sat_id"]; ?>);"><?php echo $row_sat["sat_name"]; ?></td>
			<td style="padding: 2px; text-align: center;">
				<div id="sat_sorting<?php echo $row_sat["sat_id"]; ?>" class="sorting_zone">
				<?php 
				if($row_sat["sat_id"]!=$id_sat_last){ 
					$sat_next_id = $a_sat[($i+1)]["sat_id"];
				?>
				<i class="fa fa-arrow-circle-down" onclick="return adminSwapSaleType(<?php echo $row_sat["sat_id"]; ?>,<?php echo $sat_next_id; ?>);"></i>
				<?php 
				}

				if($row_sat["sat_id"]!=$id_sat_first){ 
					$sat_previous_id = $a_sat[($i-1)]["sat_id"];
				?>
				<i class="fa fa-arrow-circle-up" onclick="return adminSwapSaleType(<?php echo $row_sat["sat_id"]; ?>,<?php echo $sat_previous_id; ?>);"></i>
				<?php 
				}
				?>
				</div>
			</td>
			<td style="text-align: center;">
				<i style="font-size: 20px; color: #D53; cursor: pointer;" class="fa fa-pencil" data-toggle="modal" data-target="#adminEditSaleTypeModal" onclick="return adminEditSaleType(<?php echo $row_sat["sat_id"]; ?>);"></i>
			</td>
		</tr>
	<?php
	}
	?>
</table>