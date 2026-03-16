<style>
	ul.noListItems {
		list-style-type: none;
		padding-left: 10px;
		font-size: 15px;
		line-height: 1.7;
		display: grid;
		grid-template-columns: repeat(4, 1fr);
		gap: 10px;
	}
</style>
<div class="row" id="baseball">

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

			<div class="x_title d-flex justify-content-between ">
				<h2><?php echo $sales; ?> - Documents</h2>
				<a href="<?php echo Yii::app()->request->baseUrl; ?>/documents/upload" class="link goBackBtn">
					<i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Go Back
				</a>

			</div>

			<div class="x_content">
				<ul class="no-list noListItems">
					<?php
					foreach ($files as $key => $value) {
					?>
						<li>
							<a href="<?php echo Yii::app()->request->baseUrl; ?>/docs/downloadFile/id/<?php echo $value['id']; ?>">
								<?php echo Helper::getIconFile($value['file_type']) . $value['file_name']; ?>
							</a>
							<button class="btn btn-danger confirm" del-id="<?php echo $value['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/documents/deleteFile">
								<i class="fa fa-close"></i>
							</button>

						</li>
					<?php
					}
					?>
				</ul>
			</div>
		</div>

	</div>
</div>