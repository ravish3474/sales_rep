<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'edit-tracksuits-form',
		'htmlOptions' => array(
			'class'  => 'form-horizontal form-label-left',
			),
		)); 

	$model = new Tracksuits;
	
	echo $this->renderPartial('_Tracksuits', array('form'=>$form, 'model'=>$model));
	
	$this->endWidget();
?>