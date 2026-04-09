<?php

class PageController extends Controller
{
    public $layout = '//layouts/loginMain';

    public function actionEula()
    {
        $this->pageTitle = Yii::app()->name . ' - End-User License Agreement';
        $this->render('eula');
    }

    public function actionPrivacy()
    {
        $this->pageTitle = Yii::app()->name . ' - Privacy Policy';
        $this->render('privacy');
    }
}
