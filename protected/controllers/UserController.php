<?php
class UserController extends AuthController
{
	public function actionUserManagement()
	{
		$result['model'] = new User;
		$user = User::model()->findAll();
		foreach ($user as $key => $value) {
			$result['user'][$value['user_group_id']] = User::model()->findAllByAttributes(array('user_group_id'=>$value['user_group_id'],'enable'=>1));
		}
		$this->render('userManagement', $result);
	}

	public function actionAddUser()
	{
		if (Yii::app()->request->isAjaxRequest) {
			$result = User::add($_POST['User']);
        }

		header('Content-type: application/json');
        echo json_encode($result);
	}

	public function actionEditUser()
	{
		if (Yii::app()->request->isAjaxRequest) {
			$model = User::model()->findByPk($_POST['id']);
			$result = $model->attributes;
			$result['password'] = '******';
        }

		header('Content-type: application/json');
        echo json_encode($result);
	}

	public function actionEditSubmitUser()
	{
		if (Yii::app()->request->isAjaxRequest) {
			$result = User::edit($_POST['User']);
        }

		header('Content-type: application/json');
        echo json_encode($result);
	}

	public function actionDeleteUser($id)
	{
		$result = array();
		//User::model()->deleteByPk($id);
		$sql_update = "UPDATE user SET enable=0,password='[Disabled user]' WHERE id='".$id."'; ";
		
		Yii::app()->db->createCommand($sql_update)->execute();
		$this->redirect(array('userManagement'));

	}

	public function actionProfile()
	{
		if (Yii::app()->request->isAjaxRequest) {
			$model = User::model()->findByPk($_POST['id']);
			$result = $model->attributes;
			$result['password'] = '******';
        }

		header('Content-type: application/json');
        echo json_encode($result);
	}

}