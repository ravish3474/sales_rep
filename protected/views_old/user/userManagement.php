<div class="row" id="user">

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>User Management</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="btn-add">
					<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#addData"><i class="fa fa-plus"></i> Add</a>
				</div>
				<?php
					foreach (User::model()->getUserGroup() as $groupId => $group) {
						if (isset($user[$groupId])) {
				?>
				<h2><?php echo $group; ?></h2>
				<table id="userTable" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="bg-blue-light"></th>
							<th class="bg-blue-light">Username</th>
							<th class="bg-blue-light">Name</th>
							<th class="bg-blue-light">Phone</th>
							<th class="bg-blue-light">Email</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach ($user[$groupId] as $key => $value) {
						?>
						<tr>
							<td class="tbl-btn-box">
								<button class="btn btn-success" data-toggle="modal" data-target="#editData" data-id="<?php echo $value['id'];?>">
									<i class="fa fa-pencil"></i>
								</button>
								<button class="btn btn-danger confirm" del-id="<?php echo $value['id'];?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/user/deleteUser">
									<i class="fa fa-close"></i>
								</button>
							</td>
							<td><?php echo $value['username']; ?></td>
							<td><?php echo $value['fullname']; ?></td>
							<td><?php echo $value['phone']; ?></td>
							<td><?php echo $value['email']; ?></td>
						</tr>
						<?php
							}
						?>
					</tbody>
				</table>
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
			<div class="modal-header">
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
			<div class="modal-header">
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
