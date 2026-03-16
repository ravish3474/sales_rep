<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'edit-tshirts-form',
		'htmlOptions' => array(
			'class'  => 'form-horizontal form-label-left',
			),
		)); 

	$model = new Tshirts;

	echo $this->renderPartial('_Tshirts', array('form'=>$form, 'model'=>$model));

	$this->endWidget();
?>
