<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'edit-volleyball-form',
		'htmlOptions' => array(
			'class'  => 'form-horizontal form-label-left',
			),
		)); 

	$model = new Volleyball;

	echo $this->renderPartial('_Volleyball', array('form'=>$form, 'model'=>$model));

	$this->endWidget();
?>
