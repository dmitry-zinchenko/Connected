<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notices".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $create_at
 * @property integer $group_id
 * @property integer $author_id
 */
class Notices extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['text'], 'string'],
            [['group_id', 'author_id'], 'integer'],
            [['title'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'text' => 'Text',
            'create_at' => 'Create At',
            'group_id' => 'Group ID',
            'author_id' => 'Author ID',
        ];
    }

    public function getAuthor()
    {
        return $this->hasOne(Users::className(), ['id' => 'author_id']);
    }


}