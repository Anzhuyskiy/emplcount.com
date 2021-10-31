<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property int $dep_id
 * @property int|null $emp_id
 * @property string|null $dep_name
 *
 * @property Emplyees[] $emplyees
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'departments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['dep_name', 'required'],
            [['dep_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dep_id' => 'Dep ID',
            'dep_name' => 'Dep Name',
        ];
    }
    public function getEmps(){
        return $this->hasMany(Employees::class,['emp_id'=>'emp_id'])->viaTable('relations',['dep_id'=>'dep_id']);
    }

}
