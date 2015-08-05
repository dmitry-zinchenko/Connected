<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property integer $id
 * @property integer $author_id
 * @property string $text
 * @property integer $notice_id
 * @property string $created_at
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id', 'text', 'notice_id', 'created_at'], 'required'],
            [['author_id', 'notice_id'], 'integer'],
            [['text'], 'string'],
            [['created_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'author_id' => Yii::t('app', 'Author ID'),
            'text' => Yii::t('app', 'Text'),
            'notice_id' => Yii::t('app', 'Notice ID'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @inheritdoc
     * @return CommentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommentsQuery(get_called_class());
    }
}
