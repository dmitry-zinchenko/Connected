<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

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
    public function __construct($text = null, $groupId = null)
    {
        parent::__construct();
        $this->text = $text;
        $this->group_id = $groupId;
    }

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
            [['text'], 'required'],
            [['author_id', 'group_id'], 'integer'],
            [['text'], 'string'],
            [['created_at'], 'safe']
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'author_id',
                'updatedByAttribute' => false,
            ]
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

    public function getAuthor()
    {
        return $this->hasOne(Users::className(), ['id' => 'author_id']);
    }

    public function create() {
        if($this->validate() && $this->save()) {
            return true;
        }

        return false;
    }

    public static function find()
    {
        return new MessagesQuery(get_called_class());
    }
}