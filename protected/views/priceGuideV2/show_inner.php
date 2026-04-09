<?php
$table_width = 180 + 280 + (sizeof($a_comm) * 60);

//echo $admin_edit;
/*echo "<pre>";
print_r($a_item);
echo "</pre>";*/

?>
<style type="text/css">
	@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

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

	.ColorPalletBox {
		padding: 0 !important;
		border: none !important;
		width: 35px !important;
		height: 35px !important;
		cursor: pointer;
		position: relative;
	}

	#spanresetButton {
		background: #F2F5FF;
		border: none;
		color: #337AB7;
		padding: 5px 16px;
		font-size: 12px;
		font-weight: 600;
		border-radius: 4px;
		border: 1px solid #337AB7;

	}

	.SwithToDefaultBtn:active {
		transform: translateY(10px);
	}

	.SwithToDefaultBtn {
		font-family: sans-serif;
		background: #f2f5ff;
		border: none;
		color: #337ab7;
		padding: 5px 16px;
		font-size: 12px;
		font-weight: 600;
		border-radius: 4px;
		border: 1px solid #337ab7;
	}


	.ShowBadgeOnHover:hover .insideBadgesType {
		display: block;
		transform: translateX(90px);
		transition: 1s ease;
		opacity: 2;
	}

	#BadgesModaledit .edititembadegs .modal-footer #deleitem {
		float: left;
		margin-left: 12px;
	}

	#lower_table {
		scrollbar-width: unset;
	}

	.customFilter .nav-item {
		padding: 5px 10px;
		font-family: 13px;
		font-weight: 400;
		font-size: 12px;
	}

	.customFilter {

		font-family: "Poppins", serif;
	}

	.customFilter .nav-pills {
		border-bottom: 1px solid #DDDDDD;
		border-top: 1px solid #DDDDDD;
		background: none;
		display: flex;
		flex-direction: row;
		position: sticky;
		top: 0;
		z-index: 1;
		background: #FFF;
		text-align: center;
	}

	.customFilter .nav-pills .nav-link {
		color: #444444 !important;
		background: none !important;
		padding: 2px 0 7px 0;
		border-radius: 0;
	}




	.customFilter .options ul {
		padding-left: 0
	}

	.customFilter .btn {
		background: none;
		width: 100%;
		text-align: left;
		color: #444444;
		margin: 0;
		border-radius: 0 !important;
		font-size: 12px;
		font-weight: 500;
		padding: 10px 2.5vw 10px 10px;
	}

	#categoryList li.selected {
		background: #1967D2;
		color: #FFF;
		font-weight: 400;
	}

	.customFilter .options li {
		color: #111;
		font-size: 14px;
		cursor: pointer;
		font-family: "Poppins", serif;
		list-style: none;
		font-weight: 400;
		font-size: 14px;
		transition: .3s ease;
		padding: 5px 12px;
	}

	.customFilter .options li.active {
		background: #1967D2;
		color: #FFF;
	}

	.customFilter .options li:hover {
		background: #1967D233;
		color: #1967D2;
		font-weight: 500;
	}

	.customFilter .fade {
		opacity: 1;
	}

	#dropdownMenu {
		min-height: 40vh;
		scrollbar-width: none;
		overflow: scroll;
		border: 1px solid #CCD0D7;
		box-shadow: 0px 4px 6px 0px #00000026;
		position: absolute;
		width: 350px;
		border-radius: 0 8px 8px 8px;
	}

	.customFilter {
		background: #FFFFFF;
		border-radius: 2px;
		position: relative;
		margin-top: 5px;
		text-align: left;


	}

	.customFilter .options {
		padding: 10px 0;
		max-height: 360px;
		overflow-y: auto;
		scrollbar-width: thin;
	}

	.fix_head1 {
		position: relative;
	}

	td.row_group_name {
		top: 82px;
		z-index: 2;
	}

	.customFilter .btn i {
		position: absolute;
		right: 10px;
		top: 10px;
		font-weight: 500;
		font-size: 20px;
	}

	.nav-link.active {
		border-bottom: 2px solid #333333;
		font-weight: 500;
	}

	.activeProductCat {
		text-align: center;
		background-color: #848484 !important;
		color: #FFF !important;
	}
</style>

<div id="lower_table" style="max-height:700px; max-width:100%; overflow: scroll;">
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
			<th class="fix_head1">Product<br>Image</th>
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

		<tr class="tr_head" style="position:relative !important; z-index: 10; top: auto;">
			<th class="fix_head2" style="text-align: center;width:20%">
				<div class="form-group">
					<label for="sel1">Product Category</label>
					<div class="customFilter">
						<button class="btn" type="button" id="dropdownButton">
							Select Product Category <i class="fa fa-angle-down"></i>
						</button>
						<div class="dropdown-menu" id="dropdownMenu">
							<div class="container mt-3">
								<!-- Pills Navigation -->
								<ul class="nav nav-pills" id="pills-tab" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" id="pills-home-tab" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Category</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="pills-profile-tab" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Extra Items</a>
									</li>
								</ul>

								<!-- Tab Content -->
								<div class="tab-content" id="pills-tabContent">
									<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
										<div class="options">
											<ul>
												<?php
												$group_name = "";
												for ($i = 0; $i < sizeof($a_item); $i++) {
													if ($group_name != $a_item[$i]["group_name"]) {
														$group_name = $a_item[$i]["group_name"];
														echo '<li class="category-item" data-group="group_' . $i . '">' . $group_name . '</li>';
													}
												}
												?>
											</ul>
										</div>

									</div>
									<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
										<div class="options">
											<ul id="categoryList">
												<?php
												$count = 0;
												$current_group = null;
												foreach ($a_extra as $tmp_key => $row_extra) {
													$group_name = $row_extra["group_name"];
													if ($group_name !== $current_group) {
												?>
														<li value="extra_grouping_<?= $count ?>"><?= $group_name ?></li>
												<?php
														$current_group = $group_name;
														$count++;
													}
												}
												?>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</th>
			<th class="fix_head2" style="text-align: center;width:30% ;z-index: -1;">
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
				$numer = 4;
			}

			for ($i = 0; $i < ($comm_loop - $numer); $i++) {
			?>
				<td class="fix_head2 <?php echo $a_use_bg[$i]; ?>"><b id="col_comm_percent<?php echo $a_comm[$i]["comm_per_id"]; ?>">
						<?php
						if (($sat_id == 2 && $comm_type == 7) || $sat_id == 3) {
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
				echo '<tr id="group_' . $i . '"><td colspan="' . $n_col_span . '"  class="row_group_name activeProductCat">' . $group_name . '</td></tr>';
			}

			$item_id = $a_item[$i]["item_id"];
		?>
			<tr>
				<td class="badges-column" style="width: 180px; text-align: left;" id="row_item_name<?php echo $item_id; ?>">
					<?php
					//if (isset($admin_edit) && $admin_edit == "yes") {
					?>
					<?php
					$itembadges = "SELECT * FROM `tbl_item_badges` WHERE `item_id` = " . $item_id . " ORDER BY `id` DESC LIMIT 1";
					$result = Yii::app()->db->createCommand($itembadges)->queryAll();

					if (count($result) > 0) {
					?>
						<?php
						if (isset($result[0]['status']) && $result[0]['status'] == 1) { ?>
							<?php foreach ($result as $bad) { ?>
								<div class="ShowBadgeOnHover itemaddbadge<?php echo $item_id; ?>  itembagbyid<?php echo $bad['id']; ?>">
									<div class="badgesType HotBadgesBg">
										<p class="items-title defaultItems defaultBG customByPallet " style="background-color: <?php echo $bad['badge_color'] ?>;"><?php echo $bad['title'];  ?>
											<span class="before customByPallet " style="background-color: <?php echo $bad['badge_color'] ?>;"></span>
											<span class="after customByPallet" style="background-color: <?php echo $bad['badge_color'] ?>;"></span>
										</p>
									</div>
									<div class="insideBadgesType">
										<div class="defaultBG upperHeading customByPallet" style="background-color: <?php echo $bad['badge_color'] ?>;">
											<?php
											$itemname = $a_item[$i]['item_name'];
											$itemname = str_replace(['"', "'"], '', $itemname);
											?>
											<textarea name="desname" id='<?php echo 'desname' . $bad['id'] ?>' style="display:none;"><?php echo $bad['description'] ?></textarea>
											<?php if (isset($admin_edit) && $admin_edit == "yes") { ?>
												<a href="#" data-toggle="modal" data-target="#BadgesModaledit" onclick="badgepopupedit('<?php echo $bad['id']; ?>','<?php echo htmlspecialchars($bad['title'], ENT_QUOTES); ?>','<?php echo $bad['badge_color'] ?>','<?php echo htmlspecialchars($bad['highlight_title'], ENT_QUOTES); ?>','<?php echo htmlspecialchars($bad['badge_title'], ENT_QUOTES); ?>','<?php echo $item_id; ?>','<?php echo $itemname; ?>')" data-whatever="@mdo"><i class="fa fa-pencil-square-o editBadgeIcon" aria-hidden="true"></i> </a>
											<?php } ?>
											<!-- <a href="#"  data-toggle="modal" data-target="#BadgesModaledit" onclick="badgepopupedit('<?php echo $bad['id']; ?>','<?php echo $item_id; ?>','<?php echo $bad['title'] ?>','<?php echo $bad['badge_color'] ?>','<?php echo $bad['highlight_title'] ?>')" data-whatever="@mdo"> <i class="fa fa-pencil-square-o editBadgeIcon" aria-hidden="true"></i> </a>								 -->
											<!-- <a href="#" data-toggle="modal" data-target="#BadgesModal" data-whatever="@mdo"><i class="fa fa-pencil-square-o editBadgeIcon" aria-hidden="true"></i></a> -->
											<p class="innerType"><?php echo $bad['highlight_title'];  ?></p>
											<p class="text-center"><?php echo $bad['badge_title'];  ?></p>
										</div>
										<div class="innerContext">
											<?php
											$string = $bad['description'];
											$lines = explode("\n", $string);
											$lines = array_filter($lines, 'strlen');
											?>
											<ul>
												<?php foreach ($lines as $key => $line) { ?>
													<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo $line; ?> </li>
												<?php } ?>
											</ul>
										</div>
									</div>
								</div>
							<?php } ?>
						<?php } else { ?>
							<?php if (isset($admin_edit) && $admin_edit == "yes") {
								$itemname = $a_item[$i]['item_name'];
								$itemname = str_replace(['"', "'"], '', $itemname);
							?>

								<div class="itemaddbadge<?php echo $item_id; ?>">
									<a href="#" class="BadgeButton" data-toggle="modal" data-target="#BadgesModalpro" onclick="badgepopup('<?php echo $item_id; ?>', '<?php echo $itemname; ?>')" data-whatever="@mdo"> Add <img src="/images/badgeIcon.png" alt=""> </a>
								</div>
							<?php } ?>
						<?php }  ?>
					<?php
					} elseif (!empty($badged)) { ?>
						<?php foreach ($badged as $bad) { ?>
							<div class="ShowBadgeOnHover itemaddbadge<?php echo $item_id; ?> catbagbyid<?php echo $item_id; ?>">
								<div class="badgesType HotBadgesBg">
									<p class="items-title defaultItems defaultBG customByPallet " style="background-color: <?php echo $bad['badge_color'] ?>;"><?php echo $bad['title'];  ?>
										<span class="before customByPallet " style="background-color: <?php echo $bad['badge_color'] ?>;"></span>
										<span class="after customByPallet" style="background-color: <?php echo $bad['badge_color'] ?>;"></span>
									</p>
								</div>
								<div class="insideBadgesType">
									<div class="defaultBG upperHeading customByPallet" style="background-color: <?php echo $bad['badge_color'] ?>;">
										<?php
										$itemname = $a_item[$i]['item_name'];
										$itemname = str_replace(['"', "'"], '', $itemname);
										?>
										<textarea name="desname" id='<?php echo 'desname' . $bad['id'] ?>' style="display:none;"><?php echo $bad['description'] ?></textarea>
										<?php if (isset($admin_edit) && $admin_edit == "yes") { ?>
											<a href="#" data-toggle="modal" data-target="#BadgesModaledit" onclick="badgepopupaddcat('<?php echo $bad['id']; ?>','<?php echo $bad['title'] ?>','<?php echo $bad['badge_color'] ?>','<?php echo $bad['highlight_title'] ?>','<?php echo $bad['badge_title'] ?>','<?php echo $item_id; ?>', '<?php echo $itemname; ?>')" data-whatever="@mdo"><i class="fa fa-pencil-square-o editBadgeIcon" aria-hidden="true"></i> </a>
										<?php } ?>
										<!-- <a href="#" data-toggle="modal" data-target="#BadgesModal" data-whatever="@mdo"><i class="fa fa-pencil-square-o editBadgeIcon" aria-hidden="true"></i></a> -->
										<p class="innerType"><?php echo $bad['highlight_title'];  ?></p>
										<p class="text-center"><?php echo $bad['badge_title'];  ?></p>
									</div>
									<div class="innerContext">
										<?php
										$string = $bad['description'];
										$lines = explode("\n", $string);
										$lines = array_filter($lines, 'strlen');
										?>
										<ul>
											<?php foreach ($lines as $key => $line) { ?>
												<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo $line; ?> </li>
											<?php } ?>
										</ul>
									</div>
								</div>
							</div>
						<?php } ?>
					<?php } else { ?>
						<?php if (isset($admin_edit) && $admin_edit == "yes") { ?>
							<div class="itemaddbadge<?php echo $item_id; ?>">
								<a href="#" class="BadgeButton" data-toggle="modal" data-target="#BadgesModalpro" onclick="badgepopup('<?php echo $item_id; ?>', '<?php echo $itemname; ?>')" data-whatever="@mdo"> Add <img src="/images/badgeIcon.png" alt=""> </a>
							</div>
						<?php } ?>
					<?php } ?>
					<?php //} 
					?>
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
								 View
							</div>
						<?php
						}
					} else {
						if ($a_item[$i]["gdrive_link"] != 0) {
						?>
							<button item_id="<?= $item_id ?>" class="btn btn-dark btn-block openGdrive">View</button>
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
                        for ($j = 0; $j < $comm_loop; $j++) {
                    
                            $comm_per_id = $a_comm[$j]["comm_per_id"];
                            $price = isset($a_pguide[$item_id][$comm_per_id]["price"])
                                ? $a_pguide[$item_id][$comm_per_id]["price"]
                                : "-";
                    
                            // ✅ Skip if price is "-"
                            if ($price === "-" || $price === "" || $price === null) {
                                continue;
                            }
                    ?>
                            <td style="width:60px;" class="<?php echo $a_use_bg[$j]; ?>">
                                <div>
                                    <?php echo number_format($price, 2); ?>
                                </div>
                            </td>
                    <?php
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
<div id="invpopm"></div>
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

<!-- FOCUSING PRODUCTS AND EXTRA ITEMS  -->
 <!-- <script> 
	const lowerTable = document.getElementById("lower_table");
	const focusSection = document.querySelector(".focusingOnSection");

	const btnProducts = document.querySelector(".productItemsMainTop");
	const btnExtra = document.querySelector(".productExtraItemsMainBottom");

	// Toggle buttons when clicked
	document.querySelectorAll('.focusingOnSection a').forEach(btn => { 
   	 btn.addEventListener("click", function () { 
        // If Extra Items button was clicked
        if (this.classList.contains("productExtraItemsMainBottom")) { 
            btnExtra.classList.add("d-none");      // hide extra
            btnProducts.classList.remove("d-none"); // show products
        } 
        // If Our Products button was clicked
        else if (this.classList.contains("productItemsMainTop")) { 
            btnProducts.classList.add("d-none");    // hide products
            btnExtra.classList.remove("d-none");    // show extra
        } 
    	}); 
	}); 
	let lastVisible = false; 
	if (lowerTable) { 
		lowerTable.addEventListener("scroll", function () {

			const scrollTop = lowerTable.scrollTop;
			const shouldShow = scrollTop > 50;

			// When panel becomes visible FIRST TIME
			if (shouldShow && !lastVisible) {

				focusSection.classList.add("show");

				// ⭐ RESET DEFAULT STATE
				btnProducts.classList.add("d-none");      // hide "Our Products"
				btnExtra.classList.remove("d-none");      // show "Extra Items"
			}

			// When user goes back to top
			if (!shouldShow && lastVisible) {
				focusSection.classList.remove("show");
			}

			lastVisible = shouldShow;
		});
	} 
</script> -->

<script>
	const lowerTable = document.getElementById("lower_table");
const focusSection = document.querySelector(".focusingOnSection");

const btnProducts = document.querySelector(".productItemsMainTop");
const btnExtra = document.querySelector(".productExtraItemsMainBottom");

// Toggle buttons when clicked
document.querySelectorAll(".focusingOnSection a").forEach((btn) => {
  btn.addEventListener("click", function () {
    if (this.classList.contains("productExtraItemsMainBottom")) {
      btnExtra.classList.add("d-none");
      btnProducts.classList.remove("d-none");
    } else if (this.classList.contains("productItemsMainTop")) {
      btnProducts.classList.add("d-none");
      btnExtra.classList.remove("d-none");
    }
  });
});

let lastVisible = false;
let modalOpen = false;

// ⭐ Scroll logic function
function handleScroll(scrollTop) {
  if (modalOpen) return;
  const shouldShow = scrollTop > 50;

  if (shouldShow && !lastVisible) {
    focusSection.classList.add("show");

    btnProducts.classList.add("d-none");
    btnExtra.classList.remove("d-none");
  }

  if (!shouldShow && lastVisible) {
    focusSection.classList.remove("show");
  }

  lastVisible = shouldShow;
}

// Scroll inside table
if (lowerTable) {
  lowerTable.addEventListener("scroll", function () {
    handleScroll(lowerTable.scrollTop);
  });
}

// Scroll from main page scrollbar
window.addEventListener("scroll", function () {
  handleScroll(window.scrollY);
});

// Hide nav when any modal opens, restore when modal closes
$(document).on("show.bs.modal", function () {
  modalOpen = true;
  focusSection.classList.remove("show");
});
$(document).on("hidden.bs.modal", function () {
  // Another modal may have opened before this one finished closing
  if ($('.modal.in').length > 0 || $('.modal.show').length > 0) return;
  modalOpen = false;
  if (lastVisible) {
    focusSection.classList.add("show");
  }
});
</script>

<script>
	function badgepopup(itemid, itemname) {
		var modalHtml = '';
		var modalHtml = `
		<div class="modal fade" id="BadgesModalpro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<form action="managebadges/Additembadge" method="post" class="additembadegs">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add Badge For Item </h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body myDivClass"id="myDiv"  >
						<div class="ProductName">
						
						</div>
						<div class="col-lg-6 col-md-6 previewDisplay left-side">
						<div class="card defaultBadges">
							<div class="badgesType">
								<p class="defaultItems defaultBG${itemid} customByPallet" id="defaultBadge${itemid}" style="background-color:#00aeef">New Item
									<span class="before customByPallet" style="background-color:#00aeef"></span>
									<span class="after customByPallet" style="background-color:#00aeef"></span>
								</p>
							</div>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 previewDisplay badges-column right-side" id="myDiv" class="myDivClass">
						<div class="card" >
							<div class="insideBadgesType">
								<div class="defaultBG${itemid} upperHeading customByPallet" id="badgeContainer" style="background-color:#00aeef">
									<p class="innerType" id="demo${itemid}">NEW</p>
									<p class="text-center" id="badgeDescription${itemid}">Close out Special</p>
								</div>
								<div class="innerContext">
									<ul id="descriptionList${itemid}">
									</ul>
								</div>
							</div>
						</div>
						</div>
						<div class="col-md-12 ResetBAdgesBtn">
						<span  id="resetButton${itemid} " class="SwithToDefaultBtn">Switch to Default <i class="fa fa-refresh" aria-hidden="true"></i></span>
						</div>
						
						<div class="col-md-12">
						<div class="card">
								<div class="form-group Add-Badge" style="display: none;">
									<label for="Add-Badge" class="col-form-label">Add Badge</label>
									<input type="text" class="Add-Badge" name="Add_Badge" id="badgeInput" placeholder="Enter Your Badge Name..">
									<input type="hidden" name="itemid" value="${itemid}">
								</div>
								<div class="form-group BadgesStatus">
									<label for="BadgesStatus" class="col-form-label">Choose a Badge</label>
									<input type="text" id="BadgesStatus${itemid}" name="BadgesStatus" class="form-control" value="" placeholder="Enter Your Badge Name."> 
								</div>
								<div class="form-group">
									<label for="BadgesStatus" class="col-form-label">Choose Badges Color</label>
									<input type="color" class="ColorPalletBox" id="favcolor closeColorPaletteButton${itemid}" name="badge_color" value="#00aeef">
								</div>
								<div class="form-group">
									<label for="BadgesHighlights" class="col-form-label">Badges Highlights</label>
									<input type="text" class="BadgesHighlights${itemid}" name="BadgesHighlights" value="" Placeholder="Enter your Badges Highlights.">
								</div>
								<div class="form-group">
									<label for="BadgesStatus" class="col-form-label">Badges Title</label>
									<input type="text" id="BadgesTitle${itemid}" name="BadgesTitle" value="" Placeholder="Enter your Badges Title.">
								</div>
								<div class="form-group ForDescription">
									<p class="DesNote"> you can only write 4 Description for this Badges & Press Enter to go no next Line</p>
									<label for="description">Description:</label><br>
									<div id="descriptionContainer">
									<div class="position-relative">
										<textarea id="description${itemid}" class="UpdateBadgesForm" name="description" rows="1">Type your description </textarea>
									</div>
									</div>
								</div>
							
						</div>
						</div>
					</div>
						<div class="modal-footer" style="position: static;">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save Badges</button>
						</div>
				</div>
				</form>
			</div>
		</div>
        `;

		// Append the modal HTML to the body
		$('#invpopm').html(modalHtml);

		// Show the modal using jQuery
		//$('#BadgesModal').modal('show');

		$('.additembadegs').submit(function(event) {
			// Prevent default form submission
			event.preventDefault();
			// Serialize form data
			var formData = $(this).serialize();
			var badgeColor = $(this).find('input[name="badge_color"]').val();
			var BadgesStatus = $(this).find('input[name="BadgesStatus"]').val();
			var BadgesHighlights = $(this).find('input[name="BadgesHighlights"]').val();
			var BadgesTitle = $(this).find('input[name="BadgesTitle"]').val();
			//var description =  $(this).find('input[name="description"]').val();
			var description = $('#description' + itemid).val();

			var descriptionLines = description.split('\n');
			var descriptionHTML = '';

			// Generate HTML list items for each line of the description
			for (var i = 0; i < descriptionLines.length; i++) {
				descriptionHTML += '<li><i class="fa fa-check" aria-hidden="true"></i> ' + descriptionLines[i] + '</li>';
			}

			// Send AJAX request
			$.ajax({
				type: 'POST',
				url: '<?php echo Yii::app()->request->baseUrl; ?>/managebadges/Additembadge',
				data: formData,
				success: function(response) {
					//console.log(response);
					$('#BadgesModalpro').modal('hide');
					$('.itemaddbadge' + itemid).html('<div class="ShowBadgeOnHover itembagbyid' + itemid + '"> <div class="badgesType HotBadgesBg"> <p class="items-title defaultItems defaultBG customByPallet" style="background-color: ' + badgeColor + ';">' + BadgesStatus + ' <span class="before customByPallet" style="background-color: ' + badgeColor + ';"></span> <span class="after customByPallet" style="background-color: ' + badgeColor + ';"></span> </p> </div> <div class="insideBadgesType"> <div class="defaultBG upperHeading customByPallet" style="background-color: ' + badgeColor + ';"> <textarea name="desname" id="desname' + response + '" style="display:none;"> ' + description + ' </textarea> <a href="#" data-toggle="modal" data-target="#BadgesModaledit" onclick="badgepopupedit(\'' + response + '\',\'' + BadgesStatus + '\',\'' + badgeColor + '\',\'' + BadgesHighlights + '\',\'' + BadgesTitle + '\',\'' + itemid + '\',\' ' + itemname + '\')" data-whatever="@mdo"><i class="fa fa-pencil-square-o editBadgeIcon" aria-hidden="true"></i> </a> <p class="innerType">' + BadgesHighlights + '</p> <p class="text-center">' + BadgesTitle + '</p> </div> <div class="innerContext"> <ul>' + descriptionHTML + '</ul> </div> </div> </div>');



					//location.reload(true);

				},
				error: function(xhr, status, error) {
					// Handle errors if any
					console.error(xhr.responseText);
					// Optionally, display an error message or perform other actions
				}
			});
		});

		$(document).ready(function() {
			$('#BadgesTitle' + itemid + '').on('input', function() {
				var inputText = $(this).val();
				$('#badgeDescription' + itemid + '').text(inputText);
			});
		});

		$(document).ready(function() {

			$('.BadgesHighlights' + itemid + '').on('input', function() {

				var inputText = $(this).val();
				$('#demo' + itemid + '').text(inputText);
			});
		});
		$(document).ready(function() {

			$('#BadgesStatus' + itemid + '').on('input', function() {

				var inputText = $(this).val();


				var pTag = $('.badgesType #defaultBadge' + itemid + '');
				var existingBeforeSpan = pTag.find('.before').prop('outerHTML');
				var existingAfterSpan = pTag.find('.after').prop('outerHTML');
				pTag.html(inputText + existingBeforeSpan + existingAfterSpan);
			});
		});

		$(document).ready(function() {
			var maxLength = 25; // Maximum character limit
			var maxLines = 4; // Maximum number of lines
			var descriptionTextarea = $("#description" + itemid + "");
			var descriptionList = $("#descriptionList" + itemid + "");

			// Check if textarea is empty when the page loads
			if (descriptionTextarea.val().trim() === "") {
				descriptionTextarea.val("Save Upto $28"); // Add default line
			}

			descriptionTextarea.on("input", function() {
				var lines = $(this).val().split("\n").filter(line => line.trim() !== ""); // Filter empty lines

				// Check if number of lines exceeds the limit
				if (lines.length > maxLines) {
					// Display popup or error message here
					alert("You can only write up to " + maxLines + " lines.");

					// Trim lines to maximum allowed
					lines = lines.slice(0, maxLines);

					// Update textarea value with trimmed lines
					$(this).val(lines.join("\n"));
				}

				// Format the list for display
				var formattedList = lines.map(line => {
					if (line.length > maxLength) {
						line = line.slice(0, maxLength);
					}
					return "<li><i class='fa fa-check' aria-hidden='true'></i> " + line.trim() + "</li>";
				}).join("");

				// Update the description list
				descriptionList.html(formattedList);
			});
		});
		$(document).ready(function() {
			// When the color input changes
			$('input[type="color"]').change(function() {
				// Get the new color value
				var newColor = $(this).val();

				// Update the background color of the elements
				$('.defaultBG' + itemid + ' ').css('background-color', newColor);
				$('.defaultBG' + itemid + ' .before').css('background-color', newColor);
				$('.defaultBG' + itemid + ' .after').css('background-color', newColor);
			});
		});

		$(document).ready(function() {
			const colors = ['#FFBABA', '#94FF94', '#C7C7FF', '#FFFF8F', '#FFA6FF', '#00FFFF', '#D10100', '#BFBFBF', '#FFFFFF', '#7959D4', '#7ED552', '#75BAF5', '#F9C390', '#FCD75F', '#ABA5A5', '#FF9F9E', '#FF840D', '#AD90FF', '#50A7F2', '#FF7675'];

			const targetDiv = $('.defaultBG' + itemid + '');
			const resetButton = $('#resetButton' + itemid + '');
			const resetBadgesBtn = $('.ResetBAdgesBtn');
			let defaultColor = '#00AEEF'; // Set default color
			colors.forEach(color => {
				const colorBox = $('<div>').addClass('colorBox').css('background-color', color);
				colorBox.click(function() {
					targetDiv.css('background-color', color);
					targetDiv.find('span').css('background-color', color); // change span color

					// Change background color of .defaultBG class
					$('.defaultBG').css('background-color', color);
				});

			});

			function resetForm() {
				targetDiv.css('background-color', defaultColor);
				targetDiv.find('span').css('background-color', defaultColor); // reset span color

				// Reset input values
				$('#BadgesStatus' + itemid + '').val(''); // Clear input value
				$('.BadgesHighlights' + itemid + '').val(''); // Clear input value
				$('#BadgesTitle' + itemid + '').val(''); // Clear input value
				$('#description' + itemid + '').val('Save Upto $28'); // Reset textarea value
				$('.ColorPalletBox').val('#00AEEF'); // Reset textarea value

				// Reset content of div elements
				$('.defaultBadges .defaultBG' + itemid + '').css('background-color', defaultColor);
				$('.defaultBadges .defaultBG' + itemid + '').html('New Item<span class="before customByPallet"></span><span class="after customByPallet"></span>');
				$('.insideBadgesType #demo' + itemid + '').text('NEW');
				$('.insideBadgesType #badgeDescription' + itemid + '').text('Close out Special');
				$('.insideBadgesType #descriptionList' + itemid + '').html('<li><i class="fa fa-check" aria-hidden="true"></i> Save Upto $28</li>');
			}

			resetButton.click(resetForm);
			resetBadgesBtn.click(resetForm);


		});
	}


	function badgepopupedit(id, title, badge_color, highlight_title, badge_title, itemid, prod_name) {
		var description = document.getElementById("desname" + id + "").value;
		var lines = description.split("\n").filter(line => line.trim() !== "");
		var formattedDescription = lines.map(line => {
			return "<li><i class='fa fa-check' aria-hidden='true'></i> " + line.trim() + "</li>";
		}).join("");
		var modalHtml = '';
		var modalHtml = `
		<div class="modal fade" id="BadgesModaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<form action="managebadges/Additembadge" method="post" class="edititembadegs">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Edit Modal </h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body myDivClass"id="myDiv"  >
						<div class="ProductName">
						<h5 class="ProductTitle">${prod_name}</h5>
						</div>
						<div class="col-lg-6 col-md-6 previewDisplay left-side">
						<div class="card defaultBadges">
							<div class="badgesType">
								<p class="defaultItems defaultBG${id} customByPallet" id="defaultBadge${id}" style="background-color:${badge_color}">${title}
									<span class="before customByPallet" style="background-color:${badge_color}"></span>
									<span class="after customByPallet" style="background-color:${badge_color}"></span>
								</p>
							</div>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 previewDisplay badges-column right-side" id="myDiv" class="myDivClass">
						<div class="card" >
							<div class="insideBadgesType">
								<div class="defaultBG${id} upperHeading customByPallet" id="badgeContainer" style="background-color:${badge_color}">
									<p class="innerType" id="demo${id}">${highlight_title}</p>
									<p class="text-center" id="badgeDescription${id}">${badge_title}</p>
								</div>
								<div class="innerContext">
									<ul id="descriptionList${id}">
										${formattedDescription}
									</ul>
								</div>
							</div>
						</div>
						</div>
						<div class="col-md-12 ResetBAdgesBtn">
						<span  id="resetButton${id} " class="SwithToDefaultBtn">Switch to Default <i class="fa fa-refresh" aria-hidden="true"></i></span>
						</div>
						
						<div class="col-md-12">
						<div class="card">
								<div class="form-group Add-Badge" style="display: none;">
									<label for="Add-Badge" class="col-form-label">Add Badge</label>
									<input type="text" class="Add-Badge" name="Add_Badge" id="badgeInput" placeholder="Enter Your Badge Name.." value="${title}">									
									<input type="hidden" name="id" value="${id}">
									<input type="hidden" name="itemid" value="${itemid}">
								</div>
								<div class="form-group BadgesStatus">
									<label for="BadgesStatus" class="col-form-label">Choose a Badge</label>
									<input type="text" id="BadgesStatus${id}" name="BadgesStatus" class="form-control" value="${title}" placeholder="New Items"> 
								</div>
								<div class="form-group">
									<label for="BadgesStatus" class="col-form-label">Choose Badges Color</label>
									<input type="color"  class="ColorPalletBox" id="favcolor closeColorPaletteButton${id}" name="badge_color" value="${badge_color}">									
								</div>
								<div class="form-group">
									<label for="BadgesHighlights" class="col-form-label">Badges Highlights</label>
									<input type="text" class="BadgesHighlights${id}" name="BadgesHighlights" value="${highlight_title}" Placeholder=" New..">
								</div>
								<div class="form-group">
									<label for="BadgesStatus" class="col-form-label">Badges Title</label>
									<input type="text" id="BadgesTitle${id}" name="BadgesTitle" value="${badge_title}" Placeholder="Close out Special..">
								</div>
								<div class="form-group ForDescription">
									<p class="DesNote"> you can only write 4 Description for this Badges</p>
									<label for="description">Description:</label><br>
									<div id="descriptionContainer">
									<div class="position-relative">
										<textarea id="description${id}" class="UpdateBadgesForm" name="description" value="" rows="1">${description}</textarea>
									</div>
									</div>
								</div>
							
						</div>
						</div>
					</div>
						<div class="modal-footer" style="position: static;">
							<button type="button" class="btn btn-danger" id="deleitem"  onclick="deleteitme(${id}, ${itemid})"> Delete </button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save Badges</button>
						</div>
				</div>
				</form>
			</div>
		</div>
        `;

		// Append the modal HTML to the body
		$('#invpopm').html(modalHtml);

		// Show the modal using jQuery
		//$('#BadgesModaledit').modal('show');

		$('.edititembadegs').submit(function(event) {
			// Prevent default form submission
			event.preventDefault();
			// Serialize form data
			var formData = $(this).serialize();
			var dis = document.getElementById("desname" + id + "").value;
			formData += "&dis=" + encodeURIComponent(dis);

			var badgeColor = $(this).find('input[name="badge_color"]').val();
			var BadgesStatus = $(this).find('input[name="BadgesStatus"]').val();
			var BadgesHighlights = $(this).find('input[name="BadgesHighlights"]').val();
			var BadgesTitle = $(this).find('input[name="BadgesTitle"]').val();
			//var description =  $(this).find('input[name="description"]').val();
			var description = $('#description' + id).val();

			var descriptionLines = description.split('\n');
			var descriptionHTML = '';

			// Generate HTML list items for each line of the description
			for (var i = 0; i < descriptionLines.length; i++) {
				descriptionHTML += '<li><i class="fa fa-check" aria-hidden="true"></i> ' + descriptionLines[i] + '</li>';
			}


			// Send AJAX request
			$.ajax({
				type: 'POST',
				url: '<?php echo Yii::app()->request->baseUrl; ?>/managebadges/Edititembadge',
				data: formData,
				success: function(response) {
					console.log(response);
					$('#BadgesModaledit').modal('hide');
					//location.reload(true);
					$('.itemaddbadge' + itemid).html('<div class="ShowBadgeOnHover itembagbyid' + itemid + '"> <div class="badgesType HotBadgesBg"> <p class="items-title defaultItems defaultBG customByPallet" style="background-color: ' + badgeColor + ';">' + BadgesStatus + ' <span class="before customByPallet" style="background-color: ' + badgeColor + ';"></span> <span class="after customByPallet" style="background-color: ' + badgeColor + ';"></span> </p> </div> <div class="insideBadgesType"> <div class="defaultBG upperHeading customByPallet" style="background-color: ' + badgeColor + ';"> <textarea name="desname" id="desname' + response + '" style="display:none;"> ' + description + ' </textarea> <a href="#" data-toggle="modal" data-target="#BadgesModaledit" onclick="badgepopupedit(\'' + response + '\',\'' + BadgesStatus + '\',\'' + badgeColor + '\',\'' + BadgesHighlights + '\',\'' + BadgesTitle + '\',\'' + itemid + '\',\' ' + prod_name + '\')" data-whatever="@mdo"><i class="fa fa-pencil-square-o editBadgeIcon" aria-hidden="true"></i> </a> <p class="innerType">' + BadgesHighlights + '</p> <p class="text-center">' + BadgesTitle + '</p> </div> <div class="innerContext"> <ul>' + descriptionHTML + '</ul> </div> </div> </div>');

				},
				error: function(xhr, status, error) {
					// Handle errors if any
					console.error(xhr.responseText);
					// Optionally, display an error message or perform other actions
				}
			});
		});

		$(document).ready(function() {
			$('#BadgesTitle' + id + '').on('input', function() {
				var inputText = $(this).val();
				$('#badgeDescription' + id + '').text(inputText);
			});
		});

		$(document).ready(function() {

			$('.BadgesHighlights' + id + '').on('input', function() {

				var inputText = $(this).val();
				$('#demo' + id + '').text(inputText);
			});
		});
		$(document).ready(function() {

			$('#BadgesStatus' + id + '').on('input', function() {

				var inputText = $(this).val();


				var pTag = $('.badgesType #defaultBadge' + id + '');
				var existingBeforeSpan = pTag.find('.before').prop('outerHTML');
				var existingAfterSpan = pTag.find('.after').prop('outerHTML');
				pTag.html(inputText + existingBeforeSpan + existingAfterSpan);
			});
		});

		$(document).ready(function() {
			var maxLength = 25; // Maximum character limit
			var maxLines = 4; // Maximum number of lines
			var descriptionTextarea = $("#description" + id + "");
			var descriptionList = $("#descriptionList" + id + "");

			// Check if textarea is empty when the page loads
			if (descriptionTextarea.val().trim() === "") {
				descriptionTextarea.val("Save Upto $28"); // Add default line
			}

			descriptionTextarea.on("input", function() {
				var lines = $(this).val().split("\n").filter(line => line.trim() !== ""); // Filter empty lines

				// Check if number of lines exceeds the limit
				if (lines.length > maxLines) {
					// Display popup or error message here
					alert("You can only write up to " + maxLines + " lines.");

					// Trim lines to maximum allowed
					lines = lines.slice(0, maxLines);

					// Update textarea value with trimmed lines
					$(this).val(lines.join("\n"));
				}

				// Format the list for display
				var formattedList = lines.map(line => {
					if (line.length > maxLength) {
						line = line.slice(0, maxLength);
					}
					return "<li><i class='fa fa-check' aria-hidden='true'></i> " + line.trim() + "</li>";
				}).join("");

				// Update the description list
				descriptionList.html(formattedList);
			});
		});
		$(document).ready(function() {
			// When the color input changes
			$('input[type="color"]').change(function() {
				// Get the new color value
				var newColor = $(this).val();

				// Update the background color of the elements
				$('.defaultBG' + id + ' ').css('background-color', newColor);
				$('.defaultBG' + id + ' .before').css('background-color', newColor);
				$('.defaultBG' + id + ' .after').css('background-color', newColor);
			});
		});

		$(document).ready(function() {

			const colors = ['#FFBABA', '#94FF94', '#C7C7FF', '#FFFF8F', '#FFA6FF', '#00FFFF', '#D10100', '#BFBFBF', '#FFFFFF', '#7959D4', '#7ED552', '#75BAF5', '#F9C390', '#FCD75F', '#ABA5A5', '#FF9F9E', '#FF840D', '#AD90FF', '#50A7F2', '#FF7675'];

			const targetDiv = $('.defaultBG' + id + '');
			const resetButton = $('#resetButton' + id + '');
			const resetBadgesBtn = $('.ResetBAdgesBtn');
			let defaultColor = '#00AEEF'; // Set default color
			colors.forEach(color => {
				const colorBox = $('<div>').addClass('colorBox').css('background-color', color);
				colorBox.click(function() {
					targetDiv.css('background-color', color);
					targetDiv.find('span').css('background-color', color); // change span color

					// Change background color of .defaultBG class
					$('.defaultBG').css('background-color', color);
				});

			});

			function resetForm() {
				targetDiv.css('background-color', defaultColor);
				targetDiv.find('span').css('background-color', defaultColor); // reset span color

				// Reset input values
				$('#BadgesStatus' + id + '').val(''); // Clear input value
				$('.BadgesHighlights' + id + '').val(''); // Clear input value
				$('#BadgesTitle' + id + '').val(''); // Clear input value
				$('#description' + id + '').val('Save Upto $28'); // Reset textarea value
				$('.ColorPalletBox').val('#00AEEF'); // Reset textarea value

				// Reset content of div elements
				$('.defaultBadges .defaultBG' + id + '').css('background-color', defaultColor);
				$('.defaultBadges .defaultBG' + id + '').html('New Item<span class="before customByPallet"></span><span class="after customByPallet"></span>');
				$('.insideBadgesType #demo' + id + '').text('NEW');
				$('.insideBadgesType #badgeDescription' + id + '').text('Close out Special');
				$('.insideBadgesType #descriptionList' + id + '').html('<li><i class="fa fa-check" aria-hidden="true"></i> Save Upto $28</li>');
			}

			resetButton.click(resetForm);
			resetBadgesBtn.click(resetForm);
		});
	}

	function badgepopupaddcat(id, title, badge_color, highlight_title, badge_title, itemid, prod_name) {
		var description = document.getElementById("desname" + id + "").value;
		var lines = description.split("\n").filter(line => line.trim() !== "");
		var formattedDescription = lines.map(line => {
			return "<li><i class='fa fa-check' aria-hidden='true'></i> " + line.trim() + "</li>";
		}).join("");

		var modalHtml = '';
		var modalHtml = `
		<div class="modal fade" id="BadgesModaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<form action="managebadges/Additembadge" method="post" class="edititembadegs">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Edit Modal</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body myDivClass"id="myDiv"  >
						<div class="ProductName">
						<h5 class="ProductTitle">${prod_name}</h5>
						</div>
						<div class="col-lg-6 col-md-6 previewDisplay left-side">
						<div class="card defaultBadges">
							<div class="badgesType">
								<p class="defaultItems defaultBG${id} customByPallet" id="defaultBadge${id}" style="background-color:${badge_color}">${title}
									<span class="before customByPallet" style="background-color:${badge_color}"></span>
									<span class="after customByPallet" style="background-color:${badge_color}"></span>
								</p>
							</div>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 previewDisplay badges-column right-side" id="myDiv" class="myDivClass">
						<div class="card" >
							<div class="insideBadgesType">
								<div class="defaultBG${id} upperHeading customByPallet" id="badgeContainer" style="background-color:${badge_color}">
									<p class="innerType" id="demo${id}">${highlight_title}</p>
									<p class="text-center" id="badgeDescription${id}">${badge_title}</p>
								</div>
								<div class="innerContext">
									<ul id="descriptionList${id}">
										${formattedDescription}
									</ul>
								</div>
							</div>
						</div>
						</div>
						<div class="col-md-12 ResetBAdgesBtn">
						<span  id="resetButton${id}" class="SwithToDefaultBtn">Switch to Default <i class="fa fa-refresh" aria-hidden="true"></i></span>
						</div>
						
						<div class="col-md-12">
						<div class="card">
								<div class="form-group Add-Badge" style="display: none;">
									<label for="Add-Badge" class="col-form-label">Add Badge</label>
									<input type="text" class="Add-Badge" name="Add_Badge" id="badgeInput" placeholder="Enter Your Badge Name.." value="${title}">									
									<input type="hidden" name="id" value="${id}">
									<input type="hidden" name="itemid" value="${itemid}">
								</div>
								<div class="form-group BadgesStatus">
									<label for="BadgesStatus" class="col-form-label">Choose a Badge</label>
									<input type="text" id="BadgesStatus${id}" name="BadgesStatus" class="form-control" value="${title}" placeholder="New Items"> 
								</div>
								<div class="form-group">
									<label for="BadgesStatus" class="col-form-label">Choose Badges Color</label>
									<input type="color" class="ColorPalletBox BadgesModaledit" id="favcolor closeColorPaletteButton${id}" name="badge_color" value="${badge_color}">									
								</div>
								<div class="form-group">
									<label for="BadgesHighlights" class="col-form-label">Badges Highlights</label>
									<input type="text" class="BadgesHighlights${id}" name="BadgesHighlights" value="${highlight_title}" Placeholder=" New..">
								</div>
								<div class="form-group">
									<label for="BadgesStatus" class="col-form-label">Badges Title</label>
									<input type="text" id="BadgesTitle${id}" name="BadgesTitle" value="${badge_title}" Placeholder="Close out Special..">
								</div>
								<div class="form-group ForDescription">
									<p class="DesNote"> you can only write 4 Description for this Badges</p>
									<label for="description">Description:</label><br>
									<div id="descriptionContainer">
									<div class="position-relative">
										<textarea id="description${id}" class="UpdateBadgesForm" name="description" value="" rows="1">${description}</textarea>
									</div>
									</div>
								</div>
							
						</div>
						</div>
					</div>
						<div class="modal-footer" style="position: static;">
						<button type="button" class="btn btn-danger" id="deleitem"  onclick="deletecat(${itemid})"> Delete </button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save Badges</button>
						</div>
				</div>
				</form>
			</div>
		</div>
        `;

		// Append the modal HTML to the body
		$('#invpopm').html(modalHtml);

		// Show the modal using jQuery
		//$('#BadgesModaledit').modal('show');

		$('.edititembadegs').submit(function(event) {
			// Prevent default form submission
			event.preventDefault();
			// Serialize form data
			var formData = $(this).serialize();
			var dis = document.getElementById("desname" + id + "").value;
			formData += "&dis=" + encodeURIComponent(dis);

			// Send AJAX request
			$.ajax({
				type: 'POST',
				url: '<?php echo Yii::app()->request->baseUrl; ?>/managebadges/Addcarttoitembadge',
				data: formData,
				success: function(response) {
					console.log(response);
					$('#BadgesModaledit').modal('hide');
					location.reload(true);

				},
				error: function(xhr, status, error) {
					// Handle errors if any
					console.error(xhr.responseText);
					// Optionally, display an error message or perform other actions
				}
			});
		});

		$(document).ready(function() {
			$('#BadgesTitle' + id + '').on('input', function() {
				var inputText = $(this).val();
				$('#badgeDescription' + id + '').text(inputText);
			});
		});

		$(document).ready(function() {

			$('.BadgesHighlights' + id + '').on('input', function() {

				var inputText = $(this).val();
				$('#demo' + id + '').text(inputText);
			});
		});
		$(document).ready(function() {

			$('#BadgesStatus' + id + '').on('input', function() {

				var inputText = $(this).val();


				var pTag = $('.badgesType #defaultBadge' + id + '');
				var existingBeforeSpan = pTag.find('.before').prop('outerHTML');
				var existingAfterSpan = pTag.find('.after').prop('outerHTML');
				pTag.html(inputText + existingBeforeSpan + existingAfterSpan);
			});
		});

		$(document).ready(function() {
			var maxLength = 25; // Maximum character limit
			var maxLines = 4; // Maximum number of lines
			var descriptionTextarea = $("#description" + id + "");
			var descriptionList = $("#descriptionList" + id + "");

			// Check if textarea is empty when the page loads
			if (descriptionTextarea.val().trim() === "") {
				descriptionTextarea.val("Save Upto $28"); // Add default line
			}

			descriptionTextarea.on("input", function() {
				var lines = $(this).val().split("\n").filter(line => line.trim() !== ""); // Filter empty lines

				// Check if number of lines exceeds the limit
				if (lines.length > maxLines) {
					// Display popup or error message here
					alert("You can only write up to " + maxLines + " lines.");

					// Trim lines to maximum allowed
					lines = lines.slice(0, maxLines);

					// Update textarea value with trimmed lines
					$(this).val(lines.join("\n"));
				}

				// Format the list for display
				var formattedList = lines.map(line => {
					if (line.length > maxLength) {
						line = line.slice(0, maxLength);
					}
					return "<li><i class='fa fa-check' aria-hidden='true'></i> " + line.trim() + "</li>";
				}).join("");

				// Update the description list
				descriptionList.html(formattedList);
			});
		});
		$(document).ready(function() {
			// When the color input changes
			$('input[type="color"]').change(function() {
				// Get the new color value
				var newColor = $(this).val();

				// Update the background color of the elements
				$('.defaultBG' + id + ' ').css('background-color', newColor);
				$('.defaultBG' + id + ' .before').css('background-color', newColor);
				$('.defaultBG' + id + ' .after').css('background-color', newColor);
			});
		});

		$(document).ready(function() {
			const colors = ['#FFBABA', '#94FF94', '#C7C7FF', '#FFFF8F', '#FFA6FF', '#00FFFF', '#D10100', '#BFBFBF', '#FFFFFF', '#7959D4', '#7ED552', '#75BAF5', '#F9C390', '#FCD75F', '#ABA5A5', '#FF9F9E', '#FF840D', '#AD90FF', '#50A7F2', '#FF7675'];

			const targetDiv = $('.defaultBG' + id + '');
			const resetButton = $('#resetButton' + id + '');
			const resetBadgesBtn = $('.ResetBAdgesBtn');
			let defaultColor = '#00AEEF'; // Set default color
			colors.forEach(color => {
				const colorBox = $('<div>').addClass('colorBox').css('background-color', color);
				colorBox.click(function() {
					targetDiv.css('background-color', color);
					targetDiv.find('span').css('background-color', color); // change span color

					// Change background color of .defaultBG class
					$('.defaultBG').css('background-color', color);
				});

			});

			function resetForm() {
				targetDiv.css('background-color', defaultColor);
				targetDiv.find('span').css('background-color', defaultColor); // reset span color

				// Reset input values
				$('#BadgesStatus' + id + '').val(''); // Clear input value
				$('.BadgesHighlights' + id + '').val(''); // Clear input value
				$('#BadgesTitle' + id + '').val(''); // Clear input value
				$('#description' + id + '').val('Save Upto $28'); // Reset textarea value
				$('.ColorPalletBox').val('#00AEEF'); // Reset textarea value

				// Reset content of div elements
				$('.defaultBadges .defaultBG' + id + '').css('background-color', defaultColor);
				$('.defaultBadges .defaultBG' + id + '').html('New Item<span class="before customByPallet"></span><span class="after customByPallet"></span>');
				$('.insideBadgesType #demo' + id + '').text('NEW');
				$('.insideBadgesType #badgeDescription' + id + '').text('Close out Special');
				$('.insideBadgesType #descriptionList' + id + '').html('<li><i class="fa fa-check" aria-hidden="true"></i> Save Upto $28</li>');
			}

			resetButton.click(resetForm);
			resetBadgesBtn.click(resetForm);


		});
	}
</script>

<script>
	function deleteitme(id, itemid) {
		if (confirm("Deleting confirm?")) {
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->request->baseUrl; ?>/managebadges/Deleteitembages",
				data: {
					"itembageid": id
				},
				success: function(response) {
					console.log(response);
					$('#BadgesModaledit').modal('hide');
					$('.itembagbyid' + id + '').html('<a href="#" class="BadgeButton" data-toggle="modal" data-target="#BadgesModalpro" onclick="badgepopup(' + itemid + ')" data-whatever="@mdo"> Add <img src="/images/badgeIcon.png" alt=""> </a>');
					//location.reload(true);					
				}
			});
		}

	}

	function deletecat(id) {
		if (confirm("Deleting confirm?")) {
			$.ajax({
				type: "POST",
				dataType: "json",
				url: "<?php echo Yii::app()->request->baseUrl; ?>/managebadges/Deletecatbages",
				data: {
					"itembageid": id
				},
				success: function(resp) {
					$('#BadgesModaledit').modal('hide');
					$('.catbagbyid' + id + '').html('<a href="#" class="BadgeButton" data-toggle="modal" data-target="#BadgesModalpro" onclick="badgepopup(' + id + ')" data-whatever="@mdo"> Add <img src="/images/badgeIcon.png" alt=""> </a>');
				}
			});
		}

	}
</script>
<!-- Dropdown Toggle -->
<script>
	$(document).ready(function() {
		$('#dropdownButton').click(function() {
			$('#dropdownMenu').toggle();
		});
	});
	$(document).ready(function() {
		$(document).click(function(event) {
			if (!$(event.target).closest('#dropdownButton, #dropdownMenu').length) {
				$('#dropdownMenu').hide();
			}
		});
	});
	// Tab  
	$(document).ready(function() {
		$('#pills-tab a').click(function(e) {
			e.preventDefault();
			$('#pills-tab .nav-link').removeClass('active');
			$('.tab-pane').removeClass('show active');
			$(this).addClass('active');
			var targetTab = $(this).attr('href');
			$(targetTab).addClass('show active');
		});
	});
</script>



<!-- Category Item Click Event (Closing Dropdown and Scrolling) -->
<script>
	$(document).ready(function() {
		$(document).on('click', '.category-item', function() {
			var value = $(this).data('group');
			var x = document.getElementById(value);
			x.scrollIntoView({
				behavior: 'smooth',
				block: 'center'
			});
			$('.category-item').removeClass('active');
			$(this).addClass('active');
			$('#dropdownMenu').hide();
			var selectedCategory = $(this).text();
			$('#dropdownButton').html(selectedCategory + ' <i class="fa fa-angle-down"></i>');
		});

		$(document).on('click', '#categoryList li', function() {
			$('#dropdownMenu').hide();
			var selectedExtraItem = $(this).text();
			$('#dropdownButton').html(selectedExtraItem + ' <i class="fa fa-angle-down"></i>');
		});
	});
</script>