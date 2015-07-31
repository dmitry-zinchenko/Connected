<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property integer $id
 * @property integer $author_id
 * @property string $text
 * @property string $created_at
 * @property integer $group_id
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id', 'text', 'created_at', 'group_id'], 'required'],
            [['author_id', 'group_id'], 'integer'],
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
            'created_at' => 'Created At',
            'group_id' => 'Group ID',
        ];
    }
}