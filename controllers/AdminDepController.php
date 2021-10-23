<?php

namespace app\controllers;

use app\models\Department;
use app\models\Employees;
use yii\debug\models\search\Db;
use yii\filters\AccessControl;
use yii\web\Controller;

class AdminDepController extends Controller
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

        $connection = \Yii::$app->getDb();
//        $empl_count = $connection->createCommand("SELECT ")
        $deps = $connection->createCommand("SELECT department.dep_name, relation.dep_id,count(*) as employee_count
                                                FROM department  JOIN relation ON department.dep_id=relation.dep_id
                                                group by dep_id")->queryAll();
        $deps_zero = $connection->createCommand("SELECT dep_name FROM department WHERE dep_name NOT IN
                                                    (SELECT department.dep_name
                                                    FROM department  JOIN relation ON department.dep_id=relation.dep_id
                                                    group by dep_name);")->queryAll();
        return $this->render('admin-dep',['deps'=>$deps,'deps_zero'=>$deps_zero]);
    }

}