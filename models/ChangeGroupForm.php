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

    public function setParams()
    {
        $this->name = \Yii::$app->request->get('name');
        $this->_group=Groups::find()->where(['name' => $this->name])->one();
        $this->description=$this->_group['description'];
    }
    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function changeGroup()
    {
        if($this->validate() && $this->_group=Groups::find()->where(['name' => $this->name])->one())
        {
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
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
        ];
    }
}
