
<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'edit-calculator-form',
		'action' => Yii::app()->request->baseUrl . '/calculator/editCalculatorSubmit',
		'htmlOptions' => array(
			'enctype' => 'multipart/form-data',
			'class'  => 'form-horizontal form-label-left',
			),
		)); 

	$model = new Calculator;
	
	$user = User::model()->findAll("user_group_id = 2");
	//echo $model->getAttributeLabel('status_commission'); 
	//echo $form->textField($model, 'status_commission'); 

	echo '<input type="hidden" name="year" value="'.$year.'">';
	echo '<input type="hidden" name="month" value="'.$month.'">';
	echo '<input type="hidden" name="sales" value="'.$sales.'">';

	echo $this->renderPartial('_Calculator', array('form'=>$form, 'model'=>$model, 'user'=>$user));

	$this->endWidget();

?>
