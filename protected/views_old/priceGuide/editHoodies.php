<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'edit-hoodies-form',
		'htmlOptions' => array(
			'class'  => 'form-horizontal form-label-left',
			),
		)); 

	$model = new Hoodies;

	echo $this->renderPartial('_Hoodies', array('form'=>$form, 'model'=>$model));

	$this->endWidget();

?>
