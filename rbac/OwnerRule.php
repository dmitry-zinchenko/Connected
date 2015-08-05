<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 7/29/15
 * Time: 1:21 PM
 */
namespace app\rbac;

use yii\rbac\Rule;
use app\models\Users;
/**
 * Checks if authorID matches user passed via params
 */
class OwnerRule extends Rule
{
    public $name = 'isOwner';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        //var_dump($params); die();
        return isset($params['changeGroup']) ? $params['changeGroup']->attributes['owner_id'] == $user : false;
    }
}