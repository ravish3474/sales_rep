
<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'add-calculatorsales-form',
		'action' => Yii::app()->request->baseUrl . '/calculator/addCalculatorSalesSubmit',
		'htmlOptions' => array(
			'enctype' => 'multipart/form-data',
			'class'  => 'form-horizontal form-label-left',
			),
		)); 
		
	$model = new Calculator;
	$user = User::model()->findAll("user_group_id = 2 order by fullname ASC");
	
	echo $this->renderPartial('_CalculatorAddSales', array('form'=>$form, 'model'=>$model, 'user'=>$user));

	$this->endWidget();
?>
