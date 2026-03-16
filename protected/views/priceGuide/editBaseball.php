<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'edit-baseball-form',
		'htmlOptions' => array(
			'class'  => 'form-horizontal form-label-left',
			),
		)); 

	$model = new Baseball;

	echo $this->renderPartial('_Baseball', array('form'=>$form, 'model'=>$model));

	$this->endWidget();

?>
