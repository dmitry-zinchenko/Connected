<?php
/**
 * Created by PhpStorm.
 * User: Dmitry
 * Date: 04.08.2015
 * Time: 22:59
 */
namespace app\models;

use Yii;
use yii\base\Model;
class AddMemberForm extends Model
{
    public $username;

    protected $_user;
    protected $_groupId;
    protected $_roleId;

    public function __construct($groupId, $roleId) {
        parent::__construct();
        $this->_groupId = $groupId;
        $this->_roleId = $roleId;
    }

    public function rules()
    {
        return [
            ['username', 'required'],
            ['username', 'checkUsername'],
            ['username', 'uniqueRecord'],
        ];
    }

    public function checkUsername($attribute, $params) {
        if(($user = Users::findByUsername($this->username)) == null) {
            $this->addError($attribute, Yii::t('app', 'User does not exists.'));
        } else {
            $this->_user = $user;
        }
    }

    public function uniqueRecord($attribute, $params) {
        if($userGroup = UserGroups::findByUserAndGroup($this->_user->id, $this->_groupId)) {
            $this->addError($attribute, Yii::t('app', 'This user has already been added.'));
        }
    }

    public function addMember()
    {
        if($this->validate()) {
            $userGroup = new UserGroups();
            $userGroup->setAttribute('user_id', $this->_user->id);
            $userGroup->setAttribute('group_id', $this->_groupId);
            $userGroup->setAttribute('role_id', $this->_roleId);
            if (!$userGroup->save()) {
                $this->addErrors($userGroup->errors);
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
            'username' => Yii::t('app', 'Username'),
        ];
    }
}
