<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_groups".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $group_id
 * @property integer $role_id
 */
class UserGroups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'group_id', 'role_id'], 'required'],
            [['user_id', 'group_id', 'role_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'group_id' => Yii::t('app', 'Group ID'),
            'role_id' => Yii::t('app', 'Role ID'),
        ];
    }

    /**
     * @inheritdoc
     * @return UserGroupsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserGroupsQuery(get_called_class());
    }

    public function getRoleInfo()
    {
        return $this->hasOne(AuthAssignment::className(), ['user_id' => 'role_id'])->one();
    }

    public static function findByUserAndGroup($userId, $groupId) {
        return UserGroups::find()->where(['user_id' => $userId, 'group_id' => $groupId])->one();
    }

    public function dropUser() {
        return $this->delete();
    }

    public function changeRole($roleId) {
        if($this->role_id != 1) {
            $this->role_id = $roleId;
            if($this->validate() && $this->save()) {
                return true;
            }
        }
        return false;
    }
}
