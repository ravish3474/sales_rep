<style>
	.form-horizontal .control-label {
		margin: 10px 0;
		font-size: 14px;
		font-weight: 500;
	}

	.form-horizontal .form-control {
		height: 37px;
	}

	.no-list a {
		font-size: 15px;
		font-weight: 500;
		font-style: italic;
		display: flex;
		align-items: baseline;
		line-height: 20px;
	}


	.input-group-btn:last-child>.btn,
	.input-group-btn:last-child>.btn-group {
		margin: 0 0 0 5px;
		height: 37px;
	}

	.x_content .upload-btn {
		width: 20%;
		background: #5CB85C !important;
		margin: 20px 0;
	}

	ul.no-list {
		list-style-type: none;
		padding-left: 10px;
		font-size: 15px;
		line-height: 1.7;
		display: grid;
		grid-template-columns: 1fr 1fr;
		gap: 10px;
	}

	.noListItems {
		border: 1px solid #e0e2e5;
		padding: 5px 10px;
		display: flex;
		align-items: center;
		justify-content: space-between;
		gap: 15px;
		border-radius: 4px;
	}

	.x_content form {
		width: 90%;
		box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;
		padding: 20px;
	}

	@media screen and (max-width: 520px) {
		.x_title {
			padding: 0 !important;
		}

		.x_panel {
			padding: 20px 10px;
		}

		.x_content .upload-btn {
			width: 50%;
			margin: 6px 0;
		}

		.form-horizontal .control-label {
			margin: 5px 0;
			font-size: 13px;
		}

		ul.no-list {
			padding-left: 10px;
			font-size: 10px;
			line-height: 35px;
			align-items: self-start;
			flex-direction: column;
		}
	}
</style>
<div class="row" id="baseball">

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Upload</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="col-md-6">

					<?php
					$form = $this->beginWidget('CActiveForm', array(
						'id'     => 'add-baseball-form',
						'action' => Yii::app()->request->baseUrl . '/docs/uploadSubmit',
						'htmlOptions' => array(
							'enctype' => 'multipart/form-data',
							'class'   => 'form-horizontal form-label-left',
						),
					));

					echo $form->labelEx($model, 'file_name', array('class' => 'control-label'));
					echo $form->textField($model, 'file_name', array('class' => 'form-control', 'required' => true));

					echo $form->labelEx($model, 'file_path', array('class' => 'control-label'));
					echo $form->fileField($model, 'file_path[]', array('class' => 'file', 'data-show-upload' => 'false',  'data-min-file-count' => '1'));

					echo CHtml::submitButton('Upload', array('class' => 'btn btn-primary upload-btn'));
					$this->endWidget();
					?>
				</div>
				<div class="col-md-6">
					<div class="x_title">
						<h2>Documents</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<ul class="no-list">
							<?php
							foreach ($files as $key => $value) {
							?>
								<li class="noListItems">
									<a href="<?php echo Yii::app()->request->baseUrl; ?>/docs/downloadFile/id/<?php echo $value['id']; ?>">
										<?php echo Helper::getIconFile($value['file_type']) . $value['file_name']; ?>
									</a>
									<button class="btn btn-danger confirm m-0 my-auto" del-id="<?php echo $value['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/docs/deleteFile">
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

		<!-- <div class="x_panel">
			<div class="x_title">
				<h2>Documents</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<ul class="no-list">
					<?php
					foreach ($files as $key => $value) {
					?>
						<li class="noListItems">
							<a href="<?php echo Yii::app()->request->baseUrl; ?>/docs/downloadFile/id/<?php echo $value['id']; ?>">
								<?php echo Helper::getIconFile($value['file_type']) . $value['file_name']; ?>
							</a>
							<button class="btn btn-danger confirm m-auto" del-id="<?php echo $value['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/docs/deleteFile">
								<i class="fa fa-close"></i>
							</button>

						</li>
					<?php
					}
					?>
				</ul>
			</div>
		</div> -->

	</div>
</div>