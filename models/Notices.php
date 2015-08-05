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
            [['create_at'], 'safe'],
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
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'text' => Yii::t('app', 'Text'),
            'create_at' => Yii::t('app', 'Create At'),
            'group_id' => Yii::t('app', 'Group ID'),
            'author_id' => Yii::t('app', 'Author ID'),
        ];
    }

    /**
     * @inheritdoc
     * @return NoticesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NoticesQuery(get_called_class());
    }
}
