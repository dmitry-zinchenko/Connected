<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 7/29/15
 * Time: 1:21 PM
 */
namespace app\rbac;

use yii\rbac\Rule;
use app\models\Notices;
/**
 * Checks if authorID matches user passed via params
 */
class AuthorRule extends Rule
{
    public $name = 'isAuthor';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        return isset($params['updatePost']) ? $params['updatePost']->attributes['author_id'] == $user : false;
    }
}