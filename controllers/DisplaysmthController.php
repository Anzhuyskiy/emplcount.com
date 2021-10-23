<?php

namespace app\controllers;

use yii\web\Controller;

class DisplaysmthController extends Controller
{
    public $layout = 'emptylayout.php';
    public function actionIndex(){
        return $this->render('index');
    }
}