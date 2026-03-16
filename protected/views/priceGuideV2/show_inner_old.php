<?php
$table_width = 180 + 280 + (sizeof($a_comm) * 60);

//echo $admin_edit;
/*echo "<pre>";
print_r($a_item);
echo "</pre>";*/

?>
<style type="text/css">
	.fix_head1 {
		position: sticky;
		top: 0px;
		border: 1px solid #848d94 !important;
	}

	.fix_head2 {
		position: sticky;
		top: 50px;
		border: 1px solid #848d94 !important;

	}

	table {
		border-collapse: unset !important;
	}
	
</style>

<div id="lower_table" style="max-height:700px; max-width:1260px; overflow: scroll;">
	<table class="tbl_show_pguide" style="width:100%;">

		<tr class="tr_head">
			<th class="fix_head1" style="width: 180px;" rowspan="1">
				Product
				<?php
				if (isset($admin_edit) && $admin_edit == "yes") {
					$have_group = 0;
					if (sizeof($a_item_group) > 0) {
						$have_group = 1;
					}
				}
				?>
			</th>
			<th class="fix_head1">Description</th>
			<th class="fix_head1">Drive</th>
			<th class="fix_head1">Color</th>
			<?php
			$msrp_check = Yii::app()->user->getState('userMSRP');
			$user_sess_price = Yii::app()->user->getState('userPricing');
			if ($user_sess_price != 0 && $sat_id == 3) {
				$a_use_bg = array();
				for ($i = 0; $i < sizeof($a_comm_low); $i++) {

					switch ($a_comm_low[$i]["qty_name"]) {
						case 'QTY 15-99':
							$a_use_bg[$i] = "col_backg1";
							break;
						case 'QTY 100-299':
							$a_use_bg[$i] = "col_backg2";
							break;
						case 'QTY 300+':
							$a_use_bg[$i] = "col_backg1";
							break;
						case 'MSRP':
							$a_use_bg[$i] = "col_backg3";
							break;
						default:
							$a_use_bg[$i] = "col_backg1";
							break;
					}
			?>
					<td style="width:60px;" class="fix_head1 <?php echo $a_use_bg[$i]; ?>"><b id="col_title<?php echo $a_comm_low[$i]["comm_per_id"]; ?>"><?php echo str_replace(" ", "<br>", $a_comm_low[$i]["qty_name"]); ?></b></td>
				<?php
				}
			} else {
				for ($i = 0; $i < sizeof($a_comm); $i++) {

					switch ($a_comm[$i]["qty_name"]) {
						case 'QTY 15-99':
							$a_use_bg[$i] = "col_backg1";
							break;
						case 'QTY 100-299':
							$a_use_bg[$i] = "col_backg2";
							break;
						case 'QTY 300+':
							$a_use_bg[$i] = "col_backg1";
							break;
						case 'MSRP':
							$a_use_bg[$i] = "col_backg3";
							break;
						default:
							$a_use_bg[$i] = "col_backg1";
							break;
					}
				?>
					<td style="width:60px;" class="fix_head1 <?php echo $a_use_bg[$i]; ?>"><b id="col_title<?php echo $a_comm[$i]["comm_per_id"]; ?>"><?php echo str_replace(" ", "<br>", $a_comm[$i]["qty_name"]); ?></b></td>
			<?php
				}
			}
			?>
		</tr>
		<tr class="tr_head">
			<th class="fix_head2" style="text-align: center;width:20%">
				<div class="form-group">
					<label for="sel1">Product Category</label>
					<select class="form-control" id="sel1">
						<option value="" selected disabled>--Select Product Category--</option>
						<?php
						$group_name = "";
						for ($i = 0; $i < sizeof($a_item); $i++) {
							if ($group_name != $a_item[$i]["group_name"]) {
								$group_name = $a_item[$i]["group_name"];
								echo '<option value="group_' . $i . '">' . $group_name . '</option>';
							}
						}
						?>
					</select>
				</div>
			</th>
			<th class="fix_head2" style="text-align: center;width:30%">
				<?php
				if ($sat_id != 3 && $sat_id != 6) {
				?>Sales Commission
			<?php
				}
			?>
			</th>
			<th class="fix_head2" style="text-align: center;width:10%"></th>
			<th class="fix_head2" style="text-align: center;width:10%"></th>
			<?php
			$comm_loop = sizeof($a_comm);
			$n_col_span = 4 + $comm_loop;
			$user_group = Yii::app()->user->getState('userGroup');
			$comm_type = Yii::app()->user->getState('commissionType');
			$numer = 0;
			if ($user_sess_price != 0 && $sat_id == 3) {
				$numer = 8;
			}
			for ($i = 0; $i < ($comm_loop - $numer); $i++) {
			?>
				<td class="fix_head2 <?php echo $a_use_bg[$i]; ?>"><b id="col_comm_percent<?php echo $a_comm[$i]["comm_per_id"]; ?>"><?php
																																		if ($sat_id == 2 && $comm_type == 7) {
																																			//echo "0%";
																																		} else {
																																			if ($a_comm[$i]["comm_value"] != 0) {
																																				if ($user_sess_price == 0 || $user_group != 4) {
																																					echo $a_comm[$i]["comm_value"] . "%";
																																				}
																																			}
																																		}
																																		?></b></td>
			<?php
			}
			?>
		</tr>

		<?php
		$group_name = "";
		for ($i = 0; $i < sizeof($a_item); $i++) {
			if ($group_name != $a_item[$i]["group_name"]) {
				$group_name = $a_item[$i]["group_name"];
				echo '<tr id="group_' . $i . '"><td colspan="' . $n_col_span . '" style="text-align:left; background-color:#848484; color:#FFF;" class="row_group_name">' . $group_name . '</td></tr>';
			}

			$item_id = $a_item[$i]["item_id"];
		?>
			<tr>
				<td style="width: 180px; text-align: left;" id="row_item_name<?php echo $item_id; ?>">
					<?php
					echo '<span id="sp_item_name' . $item_id . '">' . $a_item[$i]["item_name"] . '</span>';

					$user_group = Yii::app()->user->getState('userGroup');
					if ((!isset($admin_edit) || $admin_edit == "no") && $user_group != "4") {
					?>
						<div style="text-align: center;"><button class="btn btn-primary" style="padding:2px 6px; border-radius: 15px;" data-toggle="modal" data-target="#manageAdditionalModal" onclick="return manageAddiV2(<?php echo $item_id; ?>);"><i class="fa fa-plus-square"></i></button></div>
					<?php
					}
					?>
				</td>
				<td style="text-align: left; white-space: pre-line;" id="td_item_desc<?php echo $item_id; ?>"><?php echo $a_item[$i]["item_style"] . " " . $a_item[$i]["item_detail"] . " " . $a_item[$i]["item_fabric_opt"]; ?>
					<?php
					if (isset($admin_edit) && $admin_edit == "yes") {
					?>
						<br><button class="btn btn-primary add_cost add_cost_<?= $item_id ?>" item_name="<?= base64_encode($a_item[$i]["item_name"]) ?>" item_id="<?= $item_id ?>">Add/Edit Cost</button>
						<?php
						$newsql1 = "SELECT * FROM tbl_cost_calc WHERE item_id='" . $item_id . "'";
						$fetch1 = Yii::app()->db->createCommand($newsql1)->queryAll();
						if (count($fetch1) > 0) {
							foreach ($fetch1 as $calcc) {
						?>
								<button class="btn btn-success open_calc open_calc_<?= $calcc['calc_id'] ?>" item_id="<?= $item_id ?>" item_name="<?= base64_encode($a_item[$i]["item_name"]) ?>" calc_id="<?= $calcc['calc_id'] ?>"><?= $calcc['draft_name'] ?></button>
						<?php
							}
						}
						?>
						<button class="btn btn-warning clone_cost" item_name="<?= base64_encode($a_item[$i]["item_name"]) ?>" item_id="<?= $item_id ?>">Clone Cost</button>
					<?php
					}
					?>
					<?php
					if (isset($admin_edit) && $admin_edit == "yes") {
					?>
						<button class="btn btn-default clone_item" item_name="<?= base64_encode($a_item[$i]["item_name"]) ?>" item_id="<?= $item_id ?>">Clone Item</button>
					<?php
					}
					?>
				</td>
				<td class="text-center">
					<?php
					if (isset($admin_edit) && $admin_edit == "yes") {
						if ($a_item[$i]["gdrive_link"] == "0") {
					?>
							<div class="add_link" onclick="return adminEditUpdateLink(<?= $item_id ?>)" data-toggle="modal" data-target="#adminEditUpdateLink">
								<i class="fa fa-plus-circle"></i>
							</div>
						<?php
						} else {
						?>
							<div class="btn btn-dark btn-block" onclick="return adminEditUpdateLinkNew(<?= $item_id ?>)" data-toggle="modal" data-target="#adminEditUpdateLinkNew">
								<i class="fa fa-google"></i> Drive
							</div>
						<?php
						}
					} else {
						if ($a_item[$i]["gdrive_link"] != 0) {
						?>
							<button item_id="<?= $item_id ?>" class="btn btn-dark btn-block openGdrive"><i class="fa fa-google"></i> Drive</button>
					<?php
						} else {
							echo "-";
						}
					}
					?>
				</td>
				<td style="width:60px;" class="col_backg1">
					<?php
					if (isset($admin_edit) && $admin_edit == "yes") {
					?>
						<div class="add_price" id="color_<?php echo $item_id; ?>" onclick="return adminEditUpdateColour(<?= $item_id ?>,'<?= base64_encode($a_item[$i]["item_name"]) ?>');" data-toggle="modal" data-target="#adminEditUpdateColour">
							<i class="fa fa-plus-circle"></i>
						</div>
						<?php
					} else {
						if ($a_item[$i]['color_available'] == 0) {
						?>
							-
						<?php
						} else {
						?>
							<button class="btn btn-primary" onclick="return viewColour(<?= $item_id ?>,'<?= base64_encode($a_item[$i]["item_name"]) ?>');" data-toggle="modal" data-target="#viewColor">View Colors</button>
					<?php
						}
					}
					?>
				</td>

				<?php
				if ($user_sess_price != 0 && $sat_id == 3) {
					if ($user_sess_price == 1) {
						$iteration_prices = []; // Initialize an array to store prices for each iteration

						for ($j = 0; $j < $comm_loop; $j++) {
							$comm_per_id = $a_comm[$j]["comm_per_id"];
							$price = isset($a_pguide[$item_id][$comm_per_id]["price"]) ? $a_pguide[$item_id][$comm_per_id]["price"] : "-";

							// Store the price in the current iteration's array
							$iteration = floor($j / 3);
							$iteration_prices[$iteration][] = $price;

							if ($j % 3 == 2 || $j == $comm_loop - 1) {
								// Calculate the lowest price for the current iteration
								$lowest_price = "-";

								foreach ($iteration_prices[$iteration] as $iter_price) {
									if ($iter_price !== "-" && ($lowest_price === "-" || $iter_price < $lowest_price)) {
										$lowest_price = $iter_price;
									}
								}

				?>

								<td style="width:60px;" class="<?php echo $a_use_bg[$j]; ?>">
									<?php
									if (isset($admin_edit) && $admin_edit == "yes") {
										$prg_id = $a_pguide[$item_id][$comm_per_id]["prg_id"];
									?>
										<div id="prg_price<?php echo $prg_id; ?>" class="add-to-cart" onclick="return adminEditPrice(<?php echo $prg_id . "," . $item_id . "," . $curr_id . "," . $sat_id . "," . $comm_per_id; ?>);" data-toggle="modal" data-target="#adminEditPriceModal"><?php echo ($lowest_price === "-" ? "-" : number_format($lowest_price, 2)); ?></div>
									<?php
									} else {
									?>
										<div <?php if (Yii::app()->user->getState('quotePermission') == 1) { ?> class="add-to-cart" onclick="return addToCartV2(<?php echo $a_pguide[$item_id][$comm_per_id]["prg_id"]; ?>);" <?php } ?>>
											<?php echo ($lowest_price === "-" ? "-" : number_format($lowest_price, 2)); ?>
										</div>
									<?php
									}
									?>
								</td>
							<?php
							}
						}
					} elseif ($user_sess_price == 2) {
						$iteration_prices = []; // Initialize an array to store prices for each iteration

						for ($j = 0; $j < $comm_loop; $j++) {
							$comm_per_id = $a_comm[$j]["comm_per_id"];
							$price = isset($a_pguide[$item_id][$comm_per_id]["price"]) ? $a_pguide[$item_id][$comm_per_id]["price"] : "-";

							// Store the price in the current iteration's array
							$iteration = floor($j / 3);
							$iteration_prices[$iteration][] = $price;

							if ($j % 3 == 2 || $j == $comm_loop - 1) {
								// Calculate the highest price for the current iteration
								$highest_price = "-";

								foreach ($iteration_prices[$iteration] as $iter_price) {
									if ($iter_price !== "-" && ($highest_price === "-" || $iter_price > $highest_price)) {
										$highest_price = $iter_price;
									}
								}

							?>

								<td style="width:60px;" class="<?php echo $a_use_bg[$j]; ?>">
									<?php
									if (isset($admin_edit) && $admin_edit == "yes") {
										$prg_id = $a_pguide[$item_id][$comm_per_id]["prg_id"];
									?>
										<div id="prg_price<?php echo $prg_id; ?>" class="add-to-cart" onclick="return adminEditPrice(<?php echo $prg_id . "," . $item_id . "," . $curr_id . "," . $sat_id . "," . $comm_per_id; ?>);" data-toggle="modal" data-target="#adminEditPriceModal"><?php echo ($highest_price === "-" ? "-" : number_format($highest_price, 2)); ?></div>
									<?php
									} else {
									?>
										<div <?php if (Yii::app()->user->getState('quotePermission') == 1) { ?> class="add-to-cart" onclick="return addToCartV2(<?php echo $a_pguide[$item_id][$comm_per_id]["prg_id"]; ?>);" <?php } ?>>
											<?php echo ($highest_price === "-" ? "-" : number_format($highest_price, 2)); ?>
										</div>
									<?php
									}
									?>
								</td>
						<?php
							}
						}
					}
				} else {
					for ($j = 0; $j < $comm_loop; $j++) {

						$comm_per_id = $a_comm[$j]["comm_per_id"];

						?>
						<td style="width:60px;" class="<?php echo $a_use_bg[$j]; ?>">

							<?php
							if (isset($admin_edit) && $admin_edit == "yes") {



								if (isset($a_pguide[$item_id][$comm_per_id]["price"])) {

									$prg_id = $a_pguide[$item_id][$comm_per_id]["prg_id"];
									$price = $a_pguide[$item_id][$comm_per_id]["price"];

									/*$curr_id = $a_pguide[$item_id][$comm_per_id]["curr_id"];
					$sat_id = $a_pguide[$item_id][$comm_per_id]["sat_id"];*/
							?>
									<div id="prg_price<?php echo $prg_id; ?>" class="add-to-cart" onclick="return adminEditPrice(<?php echo $prg_id . "," . $item_id . "," . $curr_id . "," . $sat_id . "," . $comm_per_id; ?>);" data-toggle="modal" data-target="#adminEditPriceModal"><?php echo $price; ?></div>
								<?php
								} else {
									$cell_id = $item_id . "00" . $comm_per_id;
								?>
									<div id="prg_price<?php echo $cell_id; ?>" class="add_price" onclick="return adminAddPrice(<?php echo $cell_id . "," . $item_id . "," . $curr_id . "," . $sat_id . "," . $comm_per_id; ?>);" data-toggle="modal" data-target="#adminEditPriceModal">
										<i class="fa fa-plus-circle"></i>
									</div>
								<?php
								}
							} else {
								if (isset($a_pguide[$item_id][$comm_per_id]["price"])) {
								?>
									<div <?php
											if (Yii::app()->user->getState('quotePermission') == 1) { ?> class="add-to-cart" onclick="return addToCartV2(<?php echo $a_pguide[$item_id][$comm_per_id]["prg_id"]; ?>);" <?php } ?>>
										<?php echo $a_pguide[$item_id][$comm_per_id]["price"]; ?>
									</div>
							<?php
								} else {
									echo "-";
								}
							}
							?>
						</td>
				<?php
					}
				}
				?>

			</tr>
		<?php
		}
		?>
	</table>
</div>
<script type="text/javascript">
	$(document).ready(function() {

		var card_width = $('#price_guide_content').width();
		$('#lower_table').css("max-width", card_width + "px");

	});
	<?php
	if ($msrp_check == 0) {
	?>
		$(document).ready(function() {
			$(".tbl_show_pguide tr").each(function() {
				// Find the last td element in the current tr and remove it
				$(this).find("td:last").remove();
			});
		});
	<?php
	}
	?>
</script>