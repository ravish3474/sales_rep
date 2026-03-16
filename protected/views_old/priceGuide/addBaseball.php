<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'add-baseball-form',
		'htmlOptions' => array(
			'class'  => 'form-horizontal form-label-left',
			),
		)); 
	
	$baseball = Yii::app()->db->createCommand()
				
			    ->select('Max(sort_data) As maxsort')
			    ->from('baseball bb')
			    ->queryAll();
			//$result['sort_data'] = $result['model']->maxsort;
			foreach ($baseball as $key => $value) {	
				$sort_data = $value['maxsort']+1;
				
				echo CHtml::hiddenField('Baseball[sort_data]', $sort_data);
			}
	$model = new Baseball;
	
	echo $this->renderPartial('_Baseball', array('form'=>$form, 'model'=>$model));

	$this->endWidget();
?>
