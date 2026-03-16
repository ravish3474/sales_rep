<style>
	.tbl-btn-box i.fa.fa-pencil {
		background: none;
		font-size: 14px;
		color: #fff !important;
	}

	tr:hover i.fa.fa-pencil {
		background: none;
	}

	.table>thead>tr>th {
		padding: 14px;
	}

	.btn-add .btn {
		padding: 6px 20px;
	}

	.form-control {
		font-size: 12px;
		padding: 10px;
	}

	.form-horizontal .form-group {
		display: flex;
		align-items: center;
	}

	.form-horizontal select {
		width: 100%;
		background: #e6eff6;
		padding: 8px;
		border: 1px solid #0000002e;
	}

	.form-control[disabled],
	.form-control[readonly],
	fieldset[disabled] .form-control {
		background-color: #337ab759;
		color: #000000d6;
		font-weight: 500;
		text-transform: capitalize;
	}

	.form-horizontal label {
		text-transform: capitalize;
		font-size: 15px;
		font-weight: 500;
	}

	.x_content h2 {
		margin: 0;
		padding: 8px 18px;
		color: #2A3F54;
		border: 1px solid #E3EBF2;
		font-size: 15px;
		font-weight: 600;
		text-align: center;
		border-radius: 4px 4px 0 0;
		text-transform: uppercase;
	}



	#editData .modal-dialog {
		width: 50% !important;
	}

	#addData .modal-dialog {
		width: 50% !important;
	}

	.table>tbody>tr>td.tbl-btn-box {
		width: 80px;
	}

	.table>tbody>tr>td.tbl-btn-box button {
		width: 27px;
		margin: 1px;
		height: 27px;
	}


	.flex-header .modal-title {
		font-size: 17px;
	}

	.flex-header {
		display: flex;
	}

	.flex-header .close {
		color: #337ab7;
		position: absolute;
		right: 20px;
		top: 12px;
		padding: 7px 10px;
		background: #ced5db;
	}

	.managementItems {
		padding: 10px;
		border: 1px solid #ededed;
		margin-bottom: 20px;
		border-radius: 4px;
	}

	label.checkbox-inline {
		border: 1px solid #E3EBF2;
		padding: 2px 10px;
		border-radius: 4px;
		white-space: nowrap;
	}

	@media screen and (max-width: 520px) {
		.x_content {
			overflow-x: scroll;
		}

		.flex-header .modal-title {
			font-size: 16px;
			width: 80%;
		}

		.x_content {
			padding: 0 5px 6px;
			position: relative;
			width: 100%;
			float: left;
			clear: both;
			margin-top: 0;
		}

		.x_title {
			padding: 20px 10px 10px 10px !important;
		}

		.x_content h2 {
			font-size: 13px;
			margin: 0 0 12px 0;
		}

		.modal.in form {
			width: 100%;
			overflow-x: hidden;
			display: flex;
			align-items: unset;
			flex-direction: column;
		}

		.table>tbody>tr>td.tbl-btn-box {
			display: flex;
			align-items: center;
			justify-content: center;
		}

		#editData .modal-dialog {
			width: 100% !important;
		}

		#addData .modal-dialog {
			width: 100% !important;
		}

		#editData form {
			overflow: hidden !important;
			width: 100% !important;
		}

		.form-horizontal label {
			font-size: 13px;
		}

		.form-control {
			height: 30px;
		}
	}
</style>
<div class="row" id="user">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title d-flex" style="    justify-content: space-between;">
				<h2>User Management</h2>
				<div class="clearfix"></div>
				<div class="btn-add">
					<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#addData"><i class="fa fa-plus"></i> Add</a>
				</div>
			</div>
			<div class="x_content">

				<?php
				foreach (User::model()->getUserGroup() as $groupId => $group) {
					if (isset($user[$groupId])) {
				?>
						<div class="managementItems">
							<h2><?php echo $group; ?></h2>
							<table id="userTable" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th class="bg-blue-light"></th>
										<th class="bg-blue-light">Username</th>
										<?php
										if ($group == "Dealers") {
											echo '<th class="bg-blue-light">Pricing</th>';
										}
										?>
										<th class="bg-blue-light">Name</th>
										<th class="bg-blue-light">Phone</th>
										<th class="bg-blue-light">Email</th>
										<th class="bg-blue-light">MSRP</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($user[$groupId] as $key => $value) {
										if ($value['id'] != "65") {
									?>
											<tr>
												<td class="tbl-btn-box">
													<button class="btn btn-success" data-toggle="modal" data-target="#editData" data-id="<?php echo $value['id']; ?>">
														<i class="fa fa-pencil"></i>
													</button>
													<button class="btn btn-danger confirm" del-id="<?php echo $value['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/user/deleteUser">
														<i class="fa fa-close"></i>
													</button>
												</td>
												<td><?php echo $value['username']; ?></td>
												<?php
												if ($group == "Dealers") {
												?>
													<td>
														<div class="d-flex" style="justify-content: space-between;">
															<label class="checkbox-inline">
																<input type="radio" <?php
																					if ($value['pricing_module'] == 0) {
																						echo "checked";
																					}
																					?> name="option_<?= $value['id'] ?>" user_id="<?= $value['id'] ?>" value="0"> Default
															</label>
															<label class="checkbox-inline">
																<input type="radio" <?php
																					if ($value['pricing_module'] == 1) {
																						echo "checked";
																					}
																					?> name="option_<?= $value['id'] ?>" user_id="<?= $value['id'] ?>" value="1"> Lowest
															</label>
															<label class="checkbox-inline">
																<input type="radio" <?php
																					if ($value['pricing_module'] == 2) {
																						echo "checked";
																					}
																					?> name="option_<?= $value['id'] ?>" user_id="<?= $value['id'] ?>" value="2"> Highest
															</label>
														</div>
													</td>
												<?php
												}
												?>
												<td><?php echo $value['fullname']; ?></td>
												<td><?php echo $value['phone']; ?></td>
												<td><?php echo $value['email']; ?></td>
												<td>
													<div class="toggle-switch">
														<input type="checkbox" <?php
																				if ($value['msrp_active'] == 1) {
																					echo "checked";
																				}
																				?> user_id="<?= $value['id'] ?>" class="toggle_switch-main" value="1">
													</div>
												</td>
											</tr>
									<?php
										}
									}
									?>
								</tbody>
							</table>
						</div>
				<?php
					}
				}
				?>
			</div>
		</div>
	</div>
</div>

<!-- Add PriceGuide -->
<div class="modal fade" id="addData" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="flex-header modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">User Management - Add</h4>
			</div>
			<div class="modal-body">
				<?php echo $this->renderPartial('/user/addUser');  ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="submit-user">Save</button>
			</div>
		</div>
	</div>
</div>


<!-- Edit PriceGuide -->
<div class="modal fade" id="editData" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="flex-header modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">User Management - Edit</h4>
			</div>
			<div class="modal-body">
				<?php echo $this->renderPartial('/user/editUser');  ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="edit-submit-user">Save</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$(".toggle_switch-main").change(function() {
			var user_id = $(this).attr('user_id');
			var value = 1;
			if ($(this).prop("checked")) {
				value = 1;
			} else {
				value = 0;
			}
			$.ajax({
				type: 'POST',
				data: {
					user_id: user_id,
					value: value
				},
				url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/UpdateUserMSRP',
				success: function(response) {
					console.log(response);
				}
			})
		});
	});

	$(document).ready(function() {
		// Attach a change event handler to elements with class "radio-option"
		$('.checkbox-inline input[type="radio"]').change(function() {
			// Get the value of the selected option
			var pricing = $(this).val();
			var user_id = $(this).attr('user_id');
			$.ajax({
				type: 'POST',
				data: {
					pricing: pricing,
					user_id: user_id
				},
				url: '<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/UpdateUserPricing',
				success: function(response) {
					console.log(response);
				}
			})
		});
	});
</script>