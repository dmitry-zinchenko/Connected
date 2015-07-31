<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 7/31/15
 * Time: 12:01 PM
 */
namespace app\models;

use Yii;
use yii\base\Model;
class CreateGroupForm extends Model
{
    public $owner_id;
    public $name;
    private $_group;
    private $_user_group;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return
            [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 64],
            ];
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function createGroup()
    {
        if($this->validate()) {
            $this->owner_id=\Yii::$app->user->getId();
            $this->_group=new Groups();
            $this->_group->setAttribute('owner_id',$this->owner_id);
            $this->_group->setAttribute('owner_id',$this->owner_id);
            $this->_group->setAttribute('name',$this->name);
            if($this->_group->save())
            {
                $this->_user_group = new UserGroups();
                $this->_user_group->setAttribute('user_id', $this->owner_id);
                $this->_user_group->setAttribute('group_id',$this->_group->getAttribute('id'));
                $this->_user_group->setAttribute('role_id', 1);
                if (!$this->_user_group->save()) {
                    $this->addErrors($this->_user_group->errors);
                }
                else
                {
                    return true;
                }
            }
            else
            {
                $this->addErrors($this->_group->errors);
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
