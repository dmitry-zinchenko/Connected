<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "groups".
 *
 * @property integer $id
 * @property integer $owner_id
 * @property string $name
 * @property string $description
 * @property integer $disabled
 * @property string $identifier
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['owner_id', 'disabled'], 'integer'],
            [['name', 'identifier'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 64],
            [['identifier'], 'string', 'max' => 50],
            [['identifier'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'owner_id' => Yii::t('app', 'Owner ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'disabled' => Yii::t('app', 'Disabled'),
            'identifier' => Yii::t('app', 'Identifier'),
        ];
    }

    /**
     * @inheritdoc
     * @return GroupsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GroupsQuery(get_called_class());
    }

    public function getMembers() {
        return $this->hasMany(Users::className(), ['id' => 'user_id'])
            ->viaTable('user_groups', ['group_id' => 'id'], function ($query) {
                $query->andWhere('role_id <> 1');
            })->orderBy('username');
    }
}
