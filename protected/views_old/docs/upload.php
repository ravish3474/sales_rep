<div class="row" id="baseball">

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Upload</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<?php 
					$form=$this->beginWidget('CActiveForm', array(
						'id'     => 'add-baseball-form',
						'action' => Yii::app()->request->baseUrl . '/docs/uploadSubmit',
						'htmlOptions' => array(
							'enctype' => 'multipart/form-data',
							'class'   => 'form-horizontal form-label-left',
							),
						)); 

					echo $form->labelEx($model, 'file_name', array('class'=>'control-label'));
					echo $form->textField($model, 'file_name', array('class' => 'form-control', 'required' => true));

					echo $form->labelEx($model, 'file_path', array('class'=>'control-label'));
					echo $form->fileField($model, 'file_path[]', array('class'=>'file', 'data-show-upload'=>'false',  'data-min-file-count'=>'1'));

					echo CHtml::submitButton('Upload', array('class'=>'btn btn-primary'));
					$this->endWidget();
				?>
			</div>
		</div>

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
						<button class="btn btn-danger confirm" del-id="<?php echo $value['id'];?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/docs/deleteFile">
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
