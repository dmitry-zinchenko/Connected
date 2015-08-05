<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "word_notices".
 *
 * @property integer $id
 * @property integer $word_id
 * @property integer $notice_id
 */
class WordNotices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'word_notices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['word_id', 'notice_id'], 'required'],
            [['word_id', 'notice_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'word_id' => Yii::t('app', 'Word ID'),
            'notice_id' => Yii::t('app', 'Notice ID'),
        ];
    }

    /**
     * @inheritdoc
     * @return WordNoticesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WordNoticesQuery(get_called_class());
    }
}
