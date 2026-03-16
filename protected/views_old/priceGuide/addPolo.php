<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'add-polo-form',
		'htmlOptions' => array(
			'class'  => 'form-horizontal form-label-left',
			),
		)); 
		
		$polo = Yii::app()->db->createCommand()
			    ->select('Max(sort_data) As maxsort')
			    ->from('polo pl')
			    ->queryAll();
			
			foreach ($polo as $key => $value) {	
				$sort_data = $value['maxsort']+1;
				
				echo CHtml::hiddenField('Polo[sort_data]', $sort_data);
			}
			
	$model = new Polo;

	echo $this->renderPartial('_Polo', array('form'=>$form, 'model'=>$model));

	$this->endWidget();
?>
