<?php

namespace app\controllers;
use app\models\Users;
use yii\web\Controller;
use yii\web\User;

class AuthController extends Controller
{
    public function actionIndex()
    {
        $users = new Users();
        var_dump(\Yii::$app->user->isGuest);
        return $this->render('index',['users'=>$users]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $login_form = new Users;
        if(!empty(\Yii::$app->request->post())){
            $login_form->load(\Yii::$app->request->post());
            if($login_form->validate()){
                \Yii::$app->user->login($login_form->getUser());
                return $this->goHome();
            }
            return $this->render('/auth/index',['users'=>$login_form]);
        }else{
            return $this->redirect('/auth/index');
        }
    }

    public function actionLogout()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->redirect('/auth/index');
        }else{
            \Yii::$app->user->logout();
            return $this->goHome();
        }

    }
}