
<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'add-calculator-form',
		'action' => Yii::app()->request->baseUrl . '/calculator/addSalesOrdersSubmit',
		'htmlOptions' => array(
			'enctype' => 'multipart/form-data',
			'class'  => 'form-horizontal form-label-left',
			),
		)); 
		
	$model = new SalesOrders;
	$user = User::model()->findAll("user_group_id = 2");
	
	echo $this->renderPartial('_SalesOrders', array('form'=>$form, 'model'=>$model, 'user'=>$user));

	$this->endWidget();
?>
