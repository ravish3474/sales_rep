<?php

class LoginController extends Controller
{
	public $layout = '//layouts/loginMain';

	public function actionIndex()
	{
		$result['model'] = new User; 
		$this->render('index', $result);
	}

	public function actionUserLogin()
	{
		$model=new LoginForm;

		if(isset($_POST['User'])) {

			$model->attributes=$_POST['User'];

			if ($model->validate() && $model->login()) {
				$this->redirect(Yii::app()->user->returnUrl);
			} else {
				$msgError = array();
				foreach ($model->getErrors() as $key => $error) {
					foreach ($error as $key => $message) {
						 array_push($msgError, $message);
					}
				}

				Yii::app()->user->setFlash('error', implode('<br />', $msgError));

				$this->redirect('index');
			}


		}

		
		

		
		
	}



}

