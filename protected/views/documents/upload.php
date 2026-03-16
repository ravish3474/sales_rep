<style>
	.form-control {
		font-size: 13px;
		height: 45px;
		padding: 10px;
		border-radius: 3px;
	}

	.form-horizontal .control-label {
		margin: 12px 0;
		font-size: 15px;
		text-transform: uppercase;
		font-weight: 500;
	}

	.x_content {
		margin-top: 0;
	}

	.input-group-btn:last-child>.btn,
	.input-group-btn:last-child>.btn-group {
		z-index: 2;
		margin-left: -1px;
		height: 45px;
		padding: 12px 20px;
		margin: 0;
		border: none;
	}

	.btn-primary {
		margin: 20px 0;
		height: 40px;
		width: 130px;
	}

	.btn.uploadGreenBtn {
		background: #5CB85C !important;
		color: #FFF;
		margin-top: 20px;
		float: right;
		width: 100%;
		padding: 8px;
	}

	form#add-documents-form {
		box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;
		padding: 20px;
		margin: 20px 0;
	}

	.form-control {
		background: #FFF;
	}

	.documentList li {
		text-decoration: none;
		border: 1px solid #e0e2e5;
		padding: 3px 10px;
		border-radius: 4px;
	}

	.documentList {
		display: flex;
		gap: 5px;
		margin: 10px 0;
	}

	@media screen and (max-width:520px) {

		.input-group-btn:last-child>.btn,
		.input-group-btn:last-child>.btn-group {
			height: 40px;
		}

		.form-control {
			height: 40px;
		}

		.btn-primary {

			height: 40px;

		}

		form#add-documents-form {
			padding: 0 20px;
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
				<div class="col-md-5">
					<?php
					$form = $this->beginWidget('CActiveForm', array(
						'id'     => 'add-documents-form',
						'action' => Yii::app()->request->baseUrl . '/documents/uploadSubmit',
						'htmlOptions' => array(
							'enctype' => 'multipart/form-data',
							'class'   => 'form-horizontal form-label-left',
						),
					));
					if (Yii::app()->user->getState('userGroup') == 99 || Yii::app()->user->getState('userGroup') == 1) {
						echo $form->labelEx($model, 'sales_rep', array('class' => 'control-label'));
					?>
						<select class="form-control" name="Documents[sales_rep]" id="Documents_sales_rep" required>
							<option value="" hidden>Please Select Sales</option>
							<?php
							foreach ($user as $key_sale => $value_sale) {
							?>
								<option value="<?php echo $value_sale['fullname']; ?>">- <?php echo $value_sale['fullname']; ?></option>
							<?php } ?>
						</select>

					<?php
					}
					echo $form->labelEx($model, 'file_name', array('class' => 'control-label'));
					echo $form->textField($model, 'file_name', array('class' => 'form-control', 'required' => true));

					echo $form->labelEx($model, 'file_path', array('class' => 'control-label'));
					echo $form->fileField($model, 'file_path[]', array('class' => 'file', 'data-show-upload' => 'false',  'data-min-file-count' => '1'));

					echo CHtml::submitButton('Upload', array('class' => 'btn uploadGreenBtn'));
					$this->endWidget();
					?>
				</div>
			</div>
		</div>
		<?php
		foreach ($files as $key => $value) {
			if (Yii::app()->user->getState('userGroup') == 99 || Yii::app()->user->getState('userGroup') == 1) {
		?>
				<div class="x_panel">
					<div class="x_title">
						<h2>Sales Rep Documents </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<ul class="no-list documentList">
							<li>
								<a href="<?php echo Yii::app()->request->baseUrl; ?>/documents/index/sales/<?php echo $value['sales_rep']; ?>">
									<i class="fa fa-file-text-o" aria-hidden="true"></i><?php echo $value['sales_rep']; ?>
								</a>
							</li>
						</ul>
					</div>
				</div>
			<?php
			} else {
			?>
				<div class="x_panel">
					<div class="x_title">
						<h2>Documents</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<ul class="no-list documentList">
							<li>
								<button class="btn btn-danger confirm" del-id="<?php echo $value['id']; ?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/documents/deleteFile">
									<i class="fa fa-close"></i>
								</button>
								<a href="<?php echo Yii::app()->request->baseUrl; ?>/documents/downloadFile/id/<?php echo $value['id']; ?>">
									<?php echo Helper::getIconFile($value['file_type']) . $value['file_name']; ?>
								</a>
							</li>
						</ul>
					</div>
				</div>
		<?php
			}
		}
		?>
	</div>
</div>