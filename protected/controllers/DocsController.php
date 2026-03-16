<?php

class DocsController extends AuthController
{
	public function actionIndex()
	{
		$result['model'] = new Upload;
		$result['files'] = Upload::model()->findAll();
		$this->render('index', $result);
	}

	public function actionUpload()
	{
		$result['model'] = new Upload;
		$result['files'] = Upload::model()->findAll();
		$this->render('upload', $result);
	}

	public function actionUploadSubmit()
	{

		foreach ($_FILES['Upload']['name']['file_path'] as $key => $value) {
			$model = new Upload;
			$model->attributes = $_POST['Upload'];

	        $uploadedFile = CUploadedFile::getInstance($model,"file_path[$key]");
	        $filePath = date('Ymd-His') . '-' . $key . '.' . $uploadedFile->extensionName;

			$model->file_path = $filePath;
			$model->file_type = $uploadedFile->extensionName;
			$model->file_datetime = date('Y-m-d H:i:s');

	        if ($model->save()) {
				$uploadedFile->saveAs(Yii::getPathOfAlias('webroot') . '/upload/docs/' . $filePath);
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
			$result['model'] = Upload::model()->findByPk($id);
			$result['model']->delete();

			if (file_exists(Yii::getPathOfAlias('webroot') . '/upload/docs/' . $result['model']->file_path)) {
				unlink(Yii::getPathOfAlias('webroot') . '/upload/docs/' . $result['model']->file_path);
			}
		}

		$this->redirect(array('upload'));
	}

	public function actionDownloadFile($id = null) {
		if (!is_null($id)) {
		    $model = Upload::model()->findByPk($id);
		    $filename = $model->file_name . '.' . $model->file_type;
		    $path = Yii::getPathOfAlias('webroot') . '/upload/docs/' . $model->file_path;

		    if(file_exists($path)) {
		    	return Yii::app()->getRequest()->sendFile($filename, @file_get_contents($path));
		    }
		}
	}

}

