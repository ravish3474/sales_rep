<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('username'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->hiddenField($model, 'id'); ?>
		<?php echo $form->textField($model, 'username', array('class' => 'form-control', 'required' => true)); ?>
	</div>
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('password'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'required' => true)); ?>
	</div>
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('fullname'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->textField($model, 'fullname', array('class' => 'form-control', 'required' => true)); ?>
	</div>
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('phone'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->textField($model, 'phone', array('class' => 'form-control phoneNumber', 'required' => true)); ?>
	</div>
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('email'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->emailField($model, 'email', array('class' => 'form-control', 'required' => true)); ?>
	</div>
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('user_group_id'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->dropDownList($model, 'user_group_id', array('2' => 'Sales Direct','3' => 'Sales Dealers','4' => 'Dealers','1' => 'Admin','5'=>'Factory Direct','7'=>'Designer')); ?>
		<?php //echo $form->dropDownList($model, 'user_group_id', array('class' => 'form-control', 'required' => true)); ?>
	</div>
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('commission_type'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->dropDownList($model, 'commission_type', array('10'=>'10', '7'=>'7')); ?>
	</div>
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('quote_permission'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->dropDownList($model, 'quote_permission', array('1'=>'Yes', '0'=>'No')); ?>
	</div>
</div>
EPS
JOGDistributors
Exclusive Pro






