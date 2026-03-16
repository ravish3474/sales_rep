<table class="cls_tbl_currency">
	<tr>
		<th style="text-align: center; line-height: 1.5;width: 80px;">
			Currency
			<i style="font-size: 20px; color: #5D3; cursor: pointer;" class="fa fa-plus" data-toggle="modal" data-target="#adminAddCurrencyModal"></i>
		</th>
		<th style="line-height: 1.5; vertical-align: top;">Description</th>
		<th style="line-height: 1.5; vertical-align: top; text-align: center;">Symbol</th>
		<th style="line-height: 1.5; vertical-align: top; text-align: center;">Ex.rate from USD</th>
		<th style="line-height: 1.5; vertical-align: top; text-align: center;">Prices in use</th>
		<th style="line-height: 1.5; vertical-align: top; text-align: center;">Sorting</th>
		<th style="line-height: 1.5; vertical-align: top; width: 55px; text-align: center;">Edit</th>
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
			<td style="padding: 2px; text-align: center;">
				<div id="curr_sorting<?php echo $row_curr["curr_id"]; ?>" class="sorting_zone">
					<?php
					if ($row_curr["curr_id"] != $id_curr_last) {
						$curr_next_id = $a_curr[($i + 1)]["curr_id"];
					?>
						<i class="fa fa-arrow-circle-down" onclick="return adminSwapCurrency(<?php echo $row_curr["curr_id"]; ?>,<?php echo $curr_next_id; ?>);"></i>
					<?php
					}

					if ($row_curr["curr_id"] != $id_curr_first) {
						$curr_previous_id = $a_curr[($i - 1)]["curr_id"];
					?>
						<i class="fa fa-arrow-circle-up" onclick="return adminSwapCurrency(<?php echo $row_curr["curr_id"]; ?>,<?php echo $curr_previous_id; ?>);"></i>
					<?php
					}
					?>
				</div>
			</td>
			<td style="text-align: center;">
				<i style="font-size: 20px; color: #D53; cursor: pointer;" class="fa fa-pencil" data-toggle="modal" data-target="#adminEditCurrencyModal" onclick="return adminEditCurrency(<?php echo $row_curr["curr_id"]; ?>);"></i>
			</td>
			<td style="text-align: center;">
				<?php
				if ($row_curr["curr_id"] != "1") {
				?>
					<button id="btn_bpfusd<?php echo $row_curr["curr_id"]; ?>" type="button" onclick="return buildPricesFromUSD(<?php echo $row_curr["curr_id"]; ?>);" class="btn btn-info" style="padding: 2px 10px;width: 100%;"><i class="fa fa-arrow-circle-o-right"></i> <i class="fa fa-database"></i></button>
				<?php
				}
				?>
			</td>
		</tr>
	<?php
	}
	?>
</table>