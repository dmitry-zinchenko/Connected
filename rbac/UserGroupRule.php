<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 8/7/15
 * Time: 2:21 PM
 */namespace app\rbac;

use Yii;
use yii\rbac\Rule;

/**
 * Checks if user group matches
 */
class UserGroupRule extends Rule
{
    public $name = 'userGroup';

    public function execute($user, $item, $params)
    {
        if (!Yii::$app->user->isGuest) {
            $role = array_keys(\Yii::$app->authManager->getRolesByUser($user))[0];


            //var_dump($role, $item->name); die();
            if ($item->name === 'user') {
                return $role === 'user' ||  $role === 'author' ||  $role === 'owner';
            } elseif ($item->name === 'author') {
                return $role === 'owner' ||  $role === 'author';
            } elseif ($item->name === 'owner') {
                return $role === 'owner';
            }
        }
        return false;
    }
}