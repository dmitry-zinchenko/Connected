<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Users]].
 *
 * @see Users
 */
class UsersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Users[]|array
     */
     public function byPk($itemId)
    {
        $this->andWhere('id=:itemId')
            ->addParams([':itemId' => $itemId]);
        return $this;
    }
     
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Users|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}