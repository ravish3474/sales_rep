<div class="row" id="baseball">

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Documents</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<ul class="no-list">
				<?php
					foreach ($files as $key => $value) {
				?>
					<li>
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
