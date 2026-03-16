<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'edit-polo-form',
		'htmlOptions' => array(
			'class'  => 'form-horizontal form-label-left',
			),
		)); 

	$model = new Polo;

	echo $this->renderPartial('_Polo', array('form'=>$form, 'model'=>$model));

	$this->endWidget();
?>
