<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'add-volleyball-form',
		'htmlOptions' => array(
			'class'  => 'form-horizontal form-label-left',
			),
		)); 
		
	$volleyball = Yii::app()->db->createCommand()
			    ->select('Max(sort_data) As maxsort')
			    ->from('volleyball pl')
			    ->queryAll();
			
			foreach ($volleyball as $key => $value) {	
				$sort_data = $value['maxsort']+1;
				
				echo CHtml::hiddenField('Volleyball[sort_data]', $sort_data);
			}
			
	$model = new Volleyball;

	echo $this->renderPartial('_Volleyball', array('form'=>$form, 'model'=>$model));

	$this->endWidget();
?>
