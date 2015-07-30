<?php
/**
 * Created by PhpStorm.
 * User: Dmitry
 * Date: 29.07.2015
 * Time: 16:03
 */

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * RegisterForm is the model behind the register form.
 */
class RegisterForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $repeat_password;
    public $first_name;
    public $last_name;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'password', 'first_name', 'last_name', 'email', 'repeat_password'], 'required'],
            ['email', 'email'],
            [['username', 'password', 'first_name', 'last_name', 'email'], 'string', 'max' => 64],
            ['repeat_password', 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('app', 'Passwords don\'t match')]
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function register()
    {
        if($this->validate()) {
            $this->_user = new Users();
            $this->_user->load(['Users' => $this->attributes]);
            $this->_user->setPassword();
            $this->_user->setToken("{$this->_user->getId()}{$this->_user->username}token");
            $this->_user->setAuthKey("{$this->_user->getId()}{$this->_user->username}authkey");

            if(!$this->_user->save()) {
                $this->addErrors($this->_user->errors);
            }
        }

        return false;

    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'email' => Yii::t('app', 'Email'),
            'repeat_password' => Yii::t('app', 'Repeat Password'),
            'first_name' => Yii::t('app', 'Firstname'),
            'last_name' => Yii::t('app', 'Lastname'),
        ];
    }
}
