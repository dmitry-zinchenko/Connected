<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UserGroups]].
 *
 * @see UserGroups
 */
class UserGroupsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return UserGroups[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserGroups|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}