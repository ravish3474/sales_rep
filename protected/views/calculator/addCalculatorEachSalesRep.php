
<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'add-calculator-form',
		'action' => Yii::app()->request->baseUrl . '/calculator/addCalculatorEachSalesRepSubmit',
		'htmlOptions' => array(
			'enctype' => 'multipart/form-data',
			'class'  => 'form-horizontal form-label-left',
			),
		)); 
		
	$model = new Calculator;
	$user = User::model()->findAll("user_group_id = 2 OR id = 65 order by fullname ASC");
	
	echo $this->renderPartial('_CalculatorUploadEachSalesRep', array('form'=>$form, 'model'=>$model, 'user'=>$user));

	$this->endWidget();
?>
