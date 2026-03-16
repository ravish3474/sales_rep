<?php

class Support_urlController extends Controller
{
    public $layout = '//layouts/loginMain';
    public function actionIndex()
    {
        $this->render('index'); 
    }
}