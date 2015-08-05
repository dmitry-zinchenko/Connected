<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 8/5/15
 * Time: 5:11 PM
 */
namespace app\rbac;

use yii\rbac\Rule;
use app\models\Users;
use app\models\Groups;
use app\models\UserGroups;
/**
 * Checks if authorID matches user passed via params
 */
class MemberRule extends Rule
{
    public $name = 'isMember';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        return isset($params['group']) ? UserGroups::find()->where(['group_id' => $params['group']->attributes['id'],'user_id' => $user])->one() : false;
    }
}