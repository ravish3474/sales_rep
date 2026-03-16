
<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'send-mail-form',
		//'action' => Yii::app()->request->baseUrl . '/calculator/editPaymentSubmit',
		'htmlOptions' => array(
			'enctype' => 'multipart/form-data',
			'class'  => 'form-horizontal form-label-left',
			),
		)); 
	
	$model = new Calculator;
	
	//echo $_POST['id'];
	echo $this->renderPartial('_SendEmailCustomer', array('form'=>$form, 'model'=>$model));
	
	$this->endWidget();

?>
