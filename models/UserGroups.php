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
            'id' => 'ID',
            'user_id' => 'User ID',
            'group_id' => 'Group ID',
            'role_id' => 'Role ID',
        ];
    }
}