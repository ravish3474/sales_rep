<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'add-hockeyLine-form',
		'action' 		=> Yii::app()->request->baseUrl . '/priceGuide/addHockeyLine',
		'htmlOptions' => array(
			'class'  => 'form-horizontal form-label-left',
			),
		)); 

	$model = new HockeyLine;
	
	echo $this->renderPartial('_HockeyLine', array('form'=>$form, 'model'=>$model));

	$this->endWidget();
?>
