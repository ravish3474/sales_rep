<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'add-hoodies-form',
		'htmlOptions' => array(
			'class'  => 'form-horizontal form-label-left',
			),
		)); 
		
	$hoodies = Yii::app()->db->createCommand()
			    ->select('Max(sort_data) As maxsort')
			    ->from('hoodies h')
			    ->queryAll();
			
			foreach ($hoodies as $key => $value) {	
				$sort_data = $value['maxsort']+1;
				
				echo CHtml::hiddenField('Hoodies[sort_data]', $sort_data);
			}
			
	$model = new Hoodies;

	echo $this->renderPartial('_Hoodies', array('form'=>$form, 'model'=>$model));

	$this->endWidget();

?>
