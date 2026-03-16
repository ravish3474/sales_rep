<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('extras'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->hiddenField($model, 'id'); ?>
		<?php echo $form->textField($model, 'extras', array('class' => 'form-control', 'required' => true)); ?>
	</div>
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('discription'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->textArea($model, 'discription', array('class' => 'form-control', 'required' => true)); ?>
	</div>
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('msrp'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->textField($model, 'msrp', array('class' => 'form-control numeric', 'required' => true)); ?>
	</div>
</div>