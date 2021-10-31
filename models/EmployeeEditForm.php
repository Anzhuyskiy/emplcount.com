<?php

namespace app\models;
use yii\db\ActiveRecord;
class EmployeeEditForm extends ActiveRecord
{
    public $emp_name;
    public $dep_name;
    public $dep_id;
    public $fake;

    public function rules(){
        return [
            ['emp_name','required'],
            [['emp_name'], 'string', 'max' => 100],
            [['emp_id'],'integer']
            //нужно дописать еще валидаторы для проверок и т.д
        ];
    }

}