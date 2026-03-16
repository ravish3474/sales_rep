<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'edit-user-form',
		'htmlOptions' => array(
			'class'  => 'form-horizontal form-label-left',
			),
		)); 

	$model = new User;

	echo $this->renderPartial('_User', array('form'=>$form, 'model'=>$model));

	$this->endWidget();
?>
