
<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('invoice'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		
		<?php echo $form->hiddenField($model, 'id'); ?>
		<?php echo $form->hiddenField($model, 'sales_manager'); ?>
		<?php echo $form->hiddenField($model, 'order_name'); ?>
		<?php echo $form->hiddenField($model, 'currency'); ?>
		<?php echo $form->hiddenField($model, 'invoice_mail_status'); ?>
		
		<?php echo $form->textField($model, 'invoice', array('class' => 'form-control', 'required' => true, 'disabled' => true)); ?>
	</div>
</div>
<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('invoice_mail_name'); ?></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<?php echo $form->emailField($model, 'invoice_mail_name', array('class'=>'form-control')); ?>
		</div>
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('invoice_mail_customer'); ?></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<?php echo $form->emailField($model, 'invoice_mail_customer', array('class'=>'form-control')); ?>
		</div>
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('invoice_mail_subject'); ?></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
						
		<?php echo $form->textField($model, 'invoice_mail_subject', array('class'=>'form-control')); ?>
						
		</div>
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('invoice_mail_detail'); ?></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<?php echo $form->textArea($model, 'invoice_mail_detail', array('class'=>'form-control')); ?>
		</div>
</div>