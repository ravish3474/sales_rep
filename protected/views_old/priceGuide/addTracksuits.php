<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'          => 'add-tracksuits-form',
		'htmlOptions' => array(
			'class'  => 'form-horizontal form-label-left',
			),
		)); 
		
		$tracksuits = Yii::app()->db->createCommand()
			    ->select('Max(sort_data) As maxsort')
			    ->from('tracksuits pl')
			    ->queryAll();
			
			foreach ($tracksuits as $key => $value) {	
				$sort_data = $value['maxsort']+1;
				
				echo CHtml::hiddenField('Tracksuits[sort_data]', $sort_data);
			}
			
	$model = new Tracksuits;

	echo $this->renderPartial('_Tracksuits', array('form'=>$form, 'model'=>$model));

	$this->endWidget();

?>
