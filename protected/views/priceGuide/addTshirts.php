<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'add-tshirts-form',
		'htmlOptions' => array(
			'class'  => 'form-horizontal form-label-left',
			),
		)); 
	
	$tshirts = Yii::app()->db->createCommand()
			    ->select('Max(sort_data) As maxsort')
			    ->from('tshirts pl')
			    ->queryAll();
			
			foreach ($tshirts as $key => $value) {	
				$sort_data = $value['maxsort']+1;
				
				echo CHtml::hiddenField('Tshirts[sort_data]', $sort_data);
			}
			
	$model = new Tshirts;

	echo $this->renderPartial('_Tshirts', array('form'=>$form, 'model'=>$model));

	$this->endWidget();
?>
