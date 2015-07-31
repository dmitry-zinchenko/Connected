<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 7/30/15
 * Time: 4:57 PM
 */
namespace app\models;
use Yii;
use yii\base\Model;

class changePasswordForm extends Model
{
    public $old_password;
    public $new_password;
    public $repeat_password;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['old_password', 'new_password','repeat_password'], 'required'],
            [['old_password', 'password', 'repeat_password'], 'string', 'max' => 64],
            ['repeat_password', 'compare', 'compareAttribute' => 'new_password', 'message' => Yii::t('app', 'Passwords don\'t match')]
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */

    public function updateProfile()
    {
        if ($this->_user && $this->user->validatePassword($this->old_password))
        {
            $this->_user->setPassword($this['new_password']);
            if(!$this->_user->save()) {
                $this->addErrors($this->_user->errors);
            }
            else
            {
                return true;
            }
        }
        return false;

    }

    public function setUser($id)
    {
        $this->_user=Users::findOne($id);
    }

    public function getUser()
    {
        return $this->_user;
    }


    public function attributeLabels()
    {
        return [
            'old_password' => Yii::t('app', 'Old Password'),
            'repeat_password' => Yii::t('app', 'Repeat Password'),
            'new_password' => Yii::t('app', 'New Password')
        ];
    }
}
