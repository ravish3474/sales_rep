<?php

class Privacy_policyController extends Controller
{
    public $layout = '//layouts/loginMain';
    public function actionIndex()
    {
        $this->render('index'); 
    }
}