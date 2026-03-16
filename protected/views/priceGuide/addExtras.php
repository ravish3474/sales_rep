<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'add-extras-form',
		'htmlOptions' => array(
			'class'  => 'form-horizontal form-label-left',
			),
		)); 

	$model = new Extras;

	echo $this->renderPartial('_Extras', array('form'=>$form, 'model'=>$model));

	$this->endWidget();
?>
