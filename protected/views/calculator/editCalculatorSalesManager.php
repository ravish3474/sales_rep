
<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'edit-calculatorManager-form',
		'action' => Yii::app()->request->baseUrl . '/calculator/editCalculatorManagerSubmit',
		'htmlOptions' => array(
			'enctype' => 'multipart/form-data',
			'class'  => 'form-horizontal form-label-left',
			),
		)); 

	$model = new Calculator;
	
	$user = User::model()->findAll("user_group_id = 2");
	//echo $model->getAttributeLabel('status_commission'); 
	//echo $form->textField($model, 'status_commission'); 
	echo $this->renderPartial('_CalculatorSales', array('form'=>$form, 'model'=>$model, 'user'=>$user));

	$this->endWidget();

?>
