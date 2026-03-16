<?php

class DocumentsController extends AuthController
{
	public function actionIndex($sales)
	{
		$result['sales'] = $sales;
		$result['model'] = new Documents;
		$result['files'] = Documents::model()->findAllByAttributes(array('sales_rep' => $sales));
		$this->render('index', $result);
	}

	public function actionUpload()
	{
		if(Yii::app()->user->getState('userGroup') == 99 || Yii::app()->user->getState('userGroup') == 1){ 
			$result['model'] = new Documents;
			$result['user'] = User::model()->findAllByAttributes(array('user_group_id' => '2'));
			$result['files'] = Documents::model()->findAll(array('group' => 'sales_rep'));
		}else{
			$result['model'] = new Documents;
			$result['files'] = Documents::model()->findAllByAttributes(array('sales_rep'=>Yii::app()->user->getState('fullName')));				
		}	

		$this->render('upload', $result);
	}

	public function actionUploadSubmit()
	{

		foreach ($_FILES['Documents']['name']['file_path'] as $key => $value) {
			
			
			$model = new Documents;
			$model->attributes = $_POST['Documents'];

	        $uploadedFile = CUploadedFile::getInstance($model,"file_path[$key]");
	        $filePath = date('Ymd-His') . '-' . $key . '.' . $uploadedFile->extensionName;
			
			$model->file_path = $filePath;
			$model->file_type = $uploadedFile->extensionName;
			$model->file_datetime = date('Y-m-d H:i:s');
			
			if(Yii::app()->user->getState('userGroup') == 99 || Yii::app()->user->getState('userGroup') == 1){ 
				$model->sales_rep = $_POST['Documents']['sales_rep'];
			}else{
				$model->sales_rep = Yii::app()->user->getState('fullName');
			}
			
	        if ($model->save()) {
				
				$uploadedFile->saveAs(Yii::getPathOfAlias('webroot') . '/upload/documents/' . $filePath);
				Yii::app()->user->setFlash('success', 'Upload Success');
				$this->redirect(array('upload'));
			} else {
				Yii::app()->user->setFlash('error', 'Upload Error');
				$this->redirect(array('upload'));
			}
		}

	}

	public function actionDeleteFile($id = null)
	{
		if (!is_null($id)) {
			$result['model'] = Documents::model()->findByPk($id);
			$result['model']->delete();

			if (file_exists(Yii::getPathOfAlias('webroot') . '/upload/documents/' . $result['model']->file_path)) {
				unlink(Yii::getPathOfAlias('webroot') . '/upload/documents/' . $result['model']->file_path);
			}
		}

		$this->redirect(array('upload'));
	}

	public function actionDownloadFile($id = null) {
		if (!is_null($id)) {
		    $model = Upload::model()->findByPk($id);
		    $filename = $model->file_name . '.' . $model->file_type;
		    $path = Yii::getPathOfAlias('webroot') . '/upload/documents/' . $model->file_path;

		    if(file_exists($path)) {
		    	return Yii::app()->getRequest()->sendFile($filename, @file_get_contents($path));
		    }
		}
	}

}

