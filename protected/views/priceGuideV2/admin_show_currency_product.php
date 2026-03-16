<table class="cls_tbl_currency">
	<tr>
		<th style="text-align: center; line-height: 1.5;vertical-align: top;">
			Currency<br>
		</th>
		<th style="line-height: 1.5; vertical-align: top;">Description</th>
		<th style="line-height: 1.5; vertical-align: top; text-align: center;">Symbol</th>
		<th style="line-height: 1.5; vertical-align: top; text-align: center;width: 100px;">Ex.rate from USD</th>
		<th style="line-height: 1.5; vertical-align: top; text-align: center;">Prices in use</th>
		<th style="line-height: 1.5; vertical-align: top; text-align: center;">Choose <br> Product</th>
		<th style="line-height: 1.5; vertical-align: top; text-align: center;">Create Prices from USD</th>
	</tr>
	<?php
	$id_curr_first = $a_curr[0]["curr_id"];
	$id_curr_last = $a_curr[(sizeof($a_curr) - 1)]["curr_id"];

	$curr_previous_id = 0;
	$curr_next_id = 0;

	for ($i = 0; $i < sizeof($a_curr); $i++) {
		$row_curr = $a_curr[$i];
	?>
		<tr id="curr_row<?php echo $row_curr["curr_id"]; ?>" <?php if ($row_curr["enable"] == "0") {
																	echo ' class="disable_row" ';
																} ?>>
			<td style="text-align: center;"><?php echo $row_curr["curr_name"]; ?></td>
			<td><?php echo $row_curr["curr_desc"]; ?></td>
			<td style="text-align: center;"><?php echo $row_curr["curr_symbol"]; ?></td>
			<td style="text-align: center;"><?php echo $row_curr["exchange_from_usd"]; ?></td>
			<td style="text-align: right;"><?php echo (isset($a_curr_prices[($row_curr["curr_id"])])) ? number_format($a_curr_prices[($row_curr["curr_id"])]) : '0'; ?></td>
			<td>
				<?php
				if ($row_curr["curr_id"] != "1") {
				?>
					<select id="prd_curr_id_<?php echo $row_curr["curr_id"]; ?>" style="width:100%;height: 100%;background: #337ab72b;padding: 2px;border: 1px solid #337ab733;">
						<?php
						foreach ($a_product as $prod) {
						?>
							<option value="<?= $prod['prod_id'] ?>" product="<?= $prod['prod_name'] ?>"><?= $prod['prod_name'] ?></option>
						<?php
						}
						?>
					</select>
				<?php
				}
				?>
			</td>
			<td style="text-align: center;">
				<?php
				if ($row_curr["curr_id"] != "1") {
				?>
					<button id="btn_bpfusd_prd<?php echo $row_curr["curr_id"]; ?>" type="button" curr_id="<?= $row_curr['curr_id'] ?>" class="btn btn-info prd_curr" style="padding: 2px 10px;width: 100%;"><i class="fa fa-arrow-circle-o-right"></i> <i class="fa fa-database"></i></button>
				<?php
				}
				?>
			</td>
		</tr>
	<?php
	}
	?>
</table>