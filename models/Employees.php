<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property int $emp_id
 * @property int $user_id
 * @property string|null $emp_name
 * @property int|null $salary
 *
 * @property Relation[] $relations
 * @property Users $user
 */
class Employees extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['emp_name'], 'string', 'max' => 100],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'emp_id' => 'Employee ID',
            'user_id' => 'User ID',
            'emp_name' => 'Emp Name',
        ];
    }

    /**
     * Gets query for [[Relations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRelations()
    {
        return $this->hasMany(Relation::className(), ['emp_id' => 'empl_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'user_id']);
    }

    public function getDeps(){
        return $this->hasMany(Department::class,['dep_id'=>'dep_id'])->viaTable('relations',['emp_id'=>'emp_id']);
    }
}
