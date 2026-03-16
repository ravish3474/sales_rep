
<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'edit-payment-form',
		'action' => Yii::app()->request->baseUrl . '/calculator/editPaymentSubmit',
		'htmlOptions' => array(
			'enctype' => 'multipart/form-data',
			'class'  => 'form-horizontal form-label-left',
			),
		)); 
	
	$model = new Calculator;
	//echo $status;
	echo $this->renderPartial('_PaymentCalculator', array('form'=>$form, 'model'=>$model, 'status'=>$status));
	
	$this->endWidget();

?>
