<?php

namespace app\controllers;

use app\models\Department;
use app\models\Employees;
use app\models\Relations;
use phpDocumentor\Reflection\Utils;
use PHPUnit\Framework\Error\Error;
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
        $dep = new department();
        $connection = \Yii::$app->getDb();
        $deps = $connection->createCommand("SELECT departments.dep_name, relations.dep_id,count(*) as employee_count
                                                FROM departments  JOIN relations ON departments.dep_id=relations.dep_id
                                                group by dep_id")->queryAll();
        $deps_zero = $connection->createCommand("SELECT dep_name,dep_id FROM departments WHERE dep_name NOT IN
                                                    (SELECT departments.dep_name
                                                    FROM departments  JOIN relations ON departments.dep_id=relations.dep_id
                                                    group by dep_name);")->queryAll();
        return $this->render('admin-dep',['dep'=>$dep,'deps'=>$deps,'deps_zero'=>$deps_zero]);
    }

    public function actionAddNew(){
        if( \Yii::$app->request->isPost){
            $dep_new = new Department();
            $dep_new->load(\Yii::$app->request->post());
            try{
                $dep_new->save();
            }catch (\ErrorException $e){
                \Yii::warning('problem with saving to DB');
            }
            return $this->redirect('/admin-dep');
        }
    }

    public function actionEdit(){

        if( \Yii::$app->request->isPost){
            $dep_edit = department::find()->where(['dep_id'=>\Yii::$app->request->post('id')])->one();

            if(strlen(\Yii::$app->request->post('dep_name')) > 0){
                $dep_edit->dep_name = \Yii::$app->request->post('dep_name');
            }else{
                return $this->redirect('/admin-dep');
            }
            try{
                $dep_edit->save();
            }catch (\ErrorException $e){
                \Yii::warning('problem with saving to DB');
            }
            return $this->redirect('/admin-dep');
        }
    }

    public function actionDelete(){
        if(!empty(\Yii::$app->request->get())){
            if(!empty($dep = Department::findOne(['dep_id'=>\Yii::$app->request->get('id')]))){
                $empls = $dep->emps;
                for($i=0;$i< count($empls);$i++){
                    $emp  = Employees::findOne(['emp_id'=>$empls[$i]->emp_id]);
                    $deps = $emp->deps;
                    if(count($deps)===1) {
                        return 'You can\'t remove this department, because the employee ' . $empls[$i]->emp_name .
                            ' is a member of this department only';
                    }
                }
                if(!$dep->delete()){
                    return 'some server problem appear during deleting';
                }else{
                    return  $dep->dep_name .' successfully deleted';
                }
            }
            }else{
            return 'Department with that id not found';
        }

    }

}