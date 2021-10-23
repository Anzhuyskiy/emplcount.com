<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $user_id
 * @property string $email
 * @property string $password
 * @property string|null $date_added
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $user = false;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            [['date_added'], 'safe'],
            [['email', 'password'], 'string', 'max' => 255],
            ['password', 'validatePassword'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'email' => 'Email',
            'password' => 'Password',
            'date_added' => 'Date Added',
        ];
    }
    public function validatePassword($attribute,$params)
    {
        if(!$this->hasErrors())
        {
            $user = $this->getUser();

            if(!$user || ($user->password != sha1($this->password)))
            {
                $this->addError($attribute,'Password or email are wrong');
            }
        }
    }

    public function getUser()
    {
        return Users::findOne(['email'=>$this->email]);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function getId()
    {
        return $this->user_id;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }
    /**
     * {@inheritdoc}
     */

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
}
