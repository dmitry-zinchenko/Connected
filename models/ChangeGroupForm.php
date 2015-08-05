<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 7/31/15
 * Time: 1:02 PM
 */
namespace app\models;

use Yii;
use yii\base\Model;
class ChangeGroupForm extends Model
{
    public $name;
    public $description;
    public $identifier;
    private $_group;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return
            [
                [['name'], 'string', 'max' => 64],
                [['description'], 'string', 'max' => 255],
            ];
    }

    public function setParams($identifier)
    {
        $this->identifier = $identifier;
        $this->_group = Groups::find()->where(['identifier' => $this->identifier])->one();
        $this->name = $this->_group->name;
        $this->description = $this->_group->description;
    }
    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function changeGroup()
    {
        if($this->validate() && $this->_group = Groups::find()->where(['identifier' => $this->identifier])->one())
        {
            $this->_group->setAttribute('name',$this->name);
            $this->_group->setAttribute('description',$this->description);
            if(!$this->_group->save())
            {
                $this->addErrors($this->_group->errors);
            }
            else
            {
                return true;
            }
        }

        return false;

    }

    public function attributeLabels()
    {
        return [
            'identifier' => Yii::t('app', 'Identifier'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    public function getGroup() {
        return $this->_group;
    }

}
