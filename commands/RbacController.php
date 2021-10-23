<?php

namespace app\commands;

use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit(){
        $auth = \Yii::$app->authManager;
        $auth->removeAll();
        $admin = $auth->createRole('admin');
        $employee = $auth->createRole('employee');
        $auth->add($admin);
        $auth->add($employee);
        $auth->assign($admin, 1);
    }
}