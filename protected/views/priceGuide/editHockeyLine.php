<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'edit-hockeyLine-form',
		'htmlOptions' => array(
			'class'  => 'form-horizontal form-label-left',
			),
		)); 

	$model = new HockeyLine;


	echo $this->renderPartial('_HockeyLine', array('form'=>$form, 'model'=>$model));


	$this->endWidget(); 
?>
