 <?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'          => 'edit-profile',
        'htmlOptions' => array(
            'class'  => 'form-horizontal form-label-left',
            ),
        ));
    
    $model = new User;
?>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('username'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->hiddenField($model, 'id'); ?>
		<?php echo $form->textField($model, 'username', array('class' => 'form-control', 'required' => true, 'readonly' => true)); ?>
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
		<?php echo $form->textField($model, 'phone', array('class' => 'form-control', 'required' => true)); ?>
	</div>
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('email'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->emailField($model, 'email', array('class' => 'form-control', 'required' => true)); ?>
	</div>
</div>

<?php 
    $this->endWidget();
?>