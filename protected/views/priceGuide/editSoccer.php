<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'edit-soccer-form',
		'htmlOptions' => array(
			'class'  => 'form-horizontal form-label-left',
			),
		)); 

	$model = new Soccer;

	echo $this->renderPartial('_Soccer', array('form'=>$form, 'model'=>$model));

	$this->endWidget();
?>
