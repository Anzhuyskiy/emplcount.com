<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "relations".
 *
 * @property int $dep_id
 * @property int $emp_id
 *
 * @property Department $dep
 * @property Employees $emp
 */
class Relations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'relations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dep_id', 'emp_id'], 'required'],
            [['dep_id', 'emp_id'], 'integer'],
            [['dep_id', 'emp_id'], 'unique', 'targetAttribute' => ['dep_id', 'emp_id']],
            [['dep_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::class, 'targetAttribute' => ['dep_id' => 'dep_id']],
            [['emp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::class, 'targetAttribute' => ['emp_id' => 'emp_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dep_id' => 'Dep ID',
            'emp_id' => 'Emp ID',
        ];
    }

    /**
     * Gets query for [[Dep]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDep()
    {
        return $this->hasOne(Department::class, ['dep_id' => 'dep_id']);
    }

    /**
     * Gets query for [[Emp]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmp()
    {
        return $this->hasOne(Employees::class, ['emp_id' => 'emp_id']);
    }
}
