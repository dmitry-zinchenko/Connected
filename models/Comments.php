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
            'id' => 'ID',
            'author_id' => 'Author ID',
            'text' => 'Text',
            'notice_id' => 'Notice ID',
            'created_at' => 'Created At',
        ];
    }
}