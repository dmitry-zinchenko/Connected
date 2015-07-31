<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 7/30/15
 * Time: 1:36 PM
 */
namespace app\models;
use Yii;
use yii\base\Model;

class AccountSettingsForm extends Model
{
    public $username;
    public $email;
    public $first_name;
    public $last_name;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name',], 'required'],
            [['username', 'first_name', 'last_name', 'email'], 'string', 'max' => 64]
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */

    public function updateProfile()
    {
        if($this->validate())
        {
            $this->_user->setFirstname($this['first_name']);
            $this->_user->setLastname($this['last_name']);

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
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'first_name' => Yii::t('app', 'Firstname'),
            'last_name' => Yii::t('app', 'Lastname'),
        ];
    }
}
