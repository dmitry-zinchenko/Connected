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
    public $description;
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
            [['description'], 'string', 'max' => 255]
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
            $this->_group->setAttribute('name',$this->name);
            $this->_group->setAttribute('description',$this->description);
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
            'name' => Yii::t('app', 'Name'),
            'owner_id' => Yii::t('app', 'Owner_id'),
            'description' => Yii::t('app', 'Description'),
        ];
    }
}
