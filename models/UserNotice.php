<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_notice".
 *
 * @property integer $id
 * @property integer $notice_id
 * @property integer $user_at
 */
class UserNotice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_notice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notice_id', 'user_at'], 'required'],
            [['notice_id', 'user_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'notice_id' => Yii::t('app', 'Notice ID'),
            'user_at' => Yii::t('app', 'User At'),
        ];
    }

    /**
     * @inheritdoc
     * @return UserNoticeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserNoticeQuery(get_called_class());
    }
}
