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
    public $identifier;
    private $_group;
    private $_user_group;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'identifier'], 'required'],
            [['name'], 'string', 'max' => 64],
            [['identifier'], 'string', 'min' => 3, 'max' => 50],
            [['description'], 'string', 'max' => 255],
            ['identifier', 'match', 'pattern' => "/^[a-z0-9-]+$/", "message" => Yii::t('app', 'Only \'a-z\', \'0-9\' and \'-\' are allowed.')],
            ['identifier', 'match', 'pattern' => "/^[^-]/", "message" => Yii::t('app', 'Invalid symbol in the beginning.')],
            ['identifier', 'match', 'pattern' => "/[^-]$/", "message" => Yii::t('app', 'Invalid symbol in the end.')],
//            ['identifier', 'match', 'pattern' => "/^[a-z0-9]+[a-z0-9-]*[a-z0-9]+$/", "message" => "Only 'a-z' and '-' are allowed"],

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
            $this->_group->setAttribute('owner_id', $this->owner_id);
            $this->_group->setAttribute('name', $this->name);
            $this->_group->setAttribute('description', $this->description);
            $this->_group->setAttribute('identifier', $this->identifier);
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
            'name' => Yii::t('app', 'Group name'),
            'owner_id' => Yii::t('app', 'Owner_id'),
            'description' => Yii::t('app', 'Description'),
            'identifier' => Yii::t('app', 'Identifier')
        ];
    }
}
