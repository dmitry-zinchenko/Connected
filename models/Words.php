<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "words".
 *
 * @property integer $id
 * @property string $name
 */
class Words extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'words';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @inheritdoc
     * @return WordsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WordsQuery(get_called_class());
    }
}
