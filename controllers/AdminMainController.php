<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class AdminMainController extends Controller
{
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::class,
                'rules'=>[
                    [
                        'allow'=>true,
                        'roles'=>['admin']
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(){
        return $this->render('admin-main-page');
    }

}