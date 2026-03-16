<style>
	.custom-flex {
		display: flex;
		align-items: center;
		margin: 0;
		justify-content: space-between;
		border-right: 1px solid #FFF;
	}
</style>
<table class="cls_tbl_product">
	<tr>
		<th class="custom-flex">
			Product
			<i style="font-size: 20px; color: #57744f; cursor: pointer;padding-top:5px;" class="fa fa-plus" data-toggle="modal" data-target="#adminAddProductModal"></i>
		</th>
		<th style="width: 150px;">Detail</th>
		<th>Note</th>
		<th style="width: 77px;">Sales Type</th>
		<th style="width: 90px; text-align: center;">Sorting</th>
		<th style="width: 55px; text-align: center;">Edit</th>
	</tr>
	<?php
	$id_product_first = $a_product[0]["prod_id"];
	$id_product_last = $a_product[(sizeof($a_product) - 1)]["prod_id"];

	$prod_previous_id = 0;
	$prod_next_id = 0;

	for ($i = 0; $i < sizeof($a_product); $i++) {
		$row_product = $a_product[$i];
	?>
		<tr id="prod_row<?php echo $row_product["prod_id"]; ?>" <?php if ($row_product["enable"] == "0") {
																	echo ' class="disable_row" ';
																} ?>>
			<td><?php echo $row_product["prod_name"]; ?></td>
			<td><?php echo $row_product["prod_detail"]; ?></td>
			<td><?php echo $row_product["prod_note"]; ?></td>
			<td style="text-align: center;">
				<?php
				if ($row_product["sat_id_list"] != "") {
					$tmp_sat_id = explode(",", $row_product["sat_id_list"]);
					echo sizeof($tmp_sat_id);
				} else {
					echo "0";
				}
				?>
			</td>
			<td style="padding: 2px; text-align: center;">
				<div id="prod_sorting<?php echo $row_product["prod_id"]; ?>" class="sorting_zone">
					<?php
					if ($row_product["prod_id"] != $id_product_last) {
						$prod_next_id = $a_product[($i + 1)]["prod_id"];
					?>
						<i class="fa fa-arrow-circle-down" onclick="return adminSwapProduct(<?php echo $row_product["prod_id"]; ?>,<?php echo $prod_next_id; ?>);"></i>
					<?php
					}

					if ($row_product["prod_id"] != $id_product_first) {
						$prod_previous_id = $a_product[($i - 1)]["prod_id"];
					?>
						<i class="fa fa-arrow-circle-up" onclick="return adminSwapProduct(<?php echo $row_product["prod_id"]; ?>,<?php echo $prod_previous_id; ?>);"></i>
					<?php
					}
					?>
				</div>
			</td>
			<td style="text-align: center;">
				<i style="font-size: 20px; color: #D53; cursor: pointer;" class="fa fa-pencil" data-toggle="modal" data-target="#adminEditProductModal" onclick="return adminEditProduct(<?php echo $row_product["prod_id"]; ?>);"></i>
			</td>
		</tr>
	<?php
	}
	?>
</table>