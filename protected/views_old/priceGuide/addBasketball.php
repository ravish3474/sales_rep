<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'add-basketball-form',
		'htmlOptions' => array(
			'class'  => 'form-horizontal form-label-left',
			),
		)); 
		
			$basketball = Yii::app()->db->createCommand()
			    ->select('Max(sort_data) As maxsort')
			    ->from('baseball bb')
			    ->queryAll();
			
			foreach ($basketball as $key => $value) {	
				$sort_data = $value['maxsort']+1;
				
				echo CHtml::hiddenField('Basketball[sort_data]', $sort_data);
			}
			
	$model = new Basketball;

	echo $this->renderPartial('_Basketball', array('form'=>$form, 'model'=>$model));

	$this->endWidget();
?>
