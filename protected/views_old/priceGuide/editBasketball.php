<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'edit-basketball-form',
		'htmlOptions' => array(
			'class'  => 'form-horizontal form-label-left',
			),
		)); 

	$model = new Basketball;

	echo $this->renderPartial('_Basketball', array('form'=>$form, 'model'=>$model));

	$this->endWidget();

?>
