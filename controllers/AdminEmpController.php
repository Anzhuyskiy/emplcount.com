<?php

namespace app\controllers;

use app\models\Department;
use app\models\EmployeeEditForm;
use app\models\Employees;
use app\models\Relations;
use app\models\Users_table;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\base\ErrorException;
use yii\web\ForbiddenHttpException;

class AdminEmpController extends Controller
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
        $new_empl = new Employees();
        $all_deps = Department::find()->all();
        $connection = \Yii::$app->getDb();
        $empl_list =$connection->createCommand("SELECT  emp_id,count(*),emp_name,count(*), group_concat(dep_name) dep_names FROM(SELECT employees.emp_name, employees.emp_id, relations.dep_id, departments.dep_name
                                                    FROM employees 
                                                    JOIN relations ON employees.emp_id = relations.emp_id
                                                    JOIN departments ON relations.dep_id = departments.dep_id) AS res_table
                                                    group by emp_name,emp_id
                                                ")->queryAll();
        return $this->render('admin-emp',['empl_list'=>$empl_list,'$new_empl'=>$new_empl,'all_deps'=>$all_deps]);
    }

    public function actionDelete(){
        if(!empty(\Yii::$app->request->get('id'))){
            if(preg_match("/[0-9]+/",\Yii::$app->request->get('id'))){
                $empl = Employees::findOne(['emp_id'=>\Yii::$app->request->get('id')]);
                $empl->delete();
                return $this->redirect('/admin-emp');
            }else{
                throw new ForbiddenHttpException('id value is wrong');
            }
        }else{
            throw new ForbiddenHttpException('get parameter in your request is missing');
        }
    }


    public function actionEdit(){
        $newdep = new Department();
        $edit_form = new EmployeeEditForm();
        if(\Yii::$app->request->isPost){
            $employee = Employees::findOne(['emp_id'=>\Yii::$app->request->post('EmployeeEditForm')['emp_id']]);
            $deps = $employee->deps;
            $recived_deps = (explode('|',\Yii::$app->request->post('EmployeeEditForm')['dep_name']));
            array_pop($recived_deps);
            for($i = 0; $i < count($deps);$i++){
                    if(in_array($deps[$i]->dep_id,$recived_deps)){
                       $current_dep[]= $deps[$i]->dep_id;
                    }else{
                        $del_rel = Relations::find()->where(['emp_id'=>\Yii::$app->request->post('EmployeeEditForm')['emp_id'],'dep_id'=>$deps[$i]->dep_id])->one();
                        $del_rel->delete();
                    }
            }
            foreach ($recived_deps as $each_recive_dep){
                $add_rel = new Relations();
                $add_rel->dep_id = $each_recive_dep;
                $add_rel->emp_id = \Yii::$app->request->post('EmployeeEditForm')['emp_id'];
                $add_rel->save();
            }
            return $this->goBack('/admin-emp');

        }
        if(!empty(\Yii::$app->request->get('id'))) {
            if(preg_match("/[0-9]+/",\Yii::$app->request->get('id'))){
                $empl = Employees::findOne(['emp_id'=>\Yii::$app->request->get('id')]);
                $deps = $empl->deps;
                return $this->render('emp-edit',['empl'=>$empl,'deps'=>$deps,'newdep'=>$newdep,'edit_form'=>$edit_form]);
            }
        }
    }

    public function actionAddEmployee(){
        $edit_form = new EmployeeEditForm();
        if(\Yii::$app->request->isPost){
            $recived_deps = (explode('|',\Yii::$app->request->post('EmployeeEditForm')['dep_name']));
            array_pop($recived_deps);
            $new_empl = new Employees();
            $new_user = new Users_table();
            $new_user->email = \Yii::$app->request->post('EmployeeEditForm')['dep_name'] . '@mail.ru';
            $new_user->password = sha1('111');
            if($new_user->save()){
                $new_empl->user_id = $new_user->user_id;
                $new_empl->emp_name = \Yii::$app->request->post('EmployeeEditForm')['emp_name'];
                $new_empl->save();
            }
            foreach ($recived_deps as $each_recived_dep){
                $new_rel = new Relations();
                $new_rel->dep_id = $each_recived_dep;
                $new_rel->emp_id = $new_empl->emp_id;
                $new_rel->save();
            }
            return  $this->redirect('/admin-emp');
        }
       return $this->render('add-employee',['edit_form'=>$edit_form]);
    }
    public function actionGetDeps(){
        if(\Yii::$app->request->isAjax){
            $arr = ArrayHelper::map(Department::find()->all(),'dep_id','dep_name');
            return  json_encode($arr);
        }
    }

}