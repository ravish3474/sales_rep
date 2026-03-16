<div class="row" id="baseball">
	<div class="row mt-20">
		<div class="col-md-12">
			<a href="<?php echo Yii::app()->request->baseUrl; ?>/documents/upload" class="link"  >
				<i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Go Back
			</a>
		</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2><?php echo $sales; ?> - Documents</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<ul class="no-list">
				<?php
					foreach ($files as $key => $value) {
				?>
					<li>
						<button class="btn btn-danger confirm" del-id="<?php echo $value['id'];?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/documents/deleteFile">
							<i class="fa fa-close"></i>
						</button>
						<a href="<?php echo Yii::app()->request->baseUrl; ?>/docs/downloadFile/id/<?php echo $value['id']; ?>">
							<?php echo Helper::getIconFile($value['file_type']) . $value['file_name']; ?>
						</a>
					</li>
				<?php
					}
				?>
				</ul>
			</div>
		</div>

	</div>	
</div>	
