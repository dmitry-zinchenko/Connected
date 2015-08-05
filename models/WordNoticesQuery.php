<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[WordNotices]].
 *
 * @see WordNotices
 */
class WordNoticesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return WordNotices[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return WordNotices|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}