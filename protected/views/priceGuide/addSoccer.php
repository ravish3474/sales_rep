<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'add-soccer-form',
		'htmlOptions' => array(
			'class'  => 'form-horizontal form-label-left',
			),
		)); 
		
		$soccer = Yii::app()->db->createCommand()
			    ->select('Max(sort_data) As maxsort')
			    ->from('soccer pl')
			    ->queryAll();
			
			foreach ($soccer as $key => $value) {	
				$sort_data = $value['maxsort']+1;
				
				echo CHtml::hiddenField('Soccer[sort_data]', $sort_data);
			}
			
	$model = new Soccer;

	echo $this->renderPartial('_Soccer', array('form'=>$form, 'model'=>$model));

	$this->endWidget();
?>
