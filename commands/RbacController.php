<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // add "createGroup" permission
        $createGroup = $auth->createPermission('createGroup');
        $createGroup->description = 'Create a group';
        $auth->add($createGroup);

        // add "chat" permission
        $chat = $auth->createPermission('chat');
        $chat->description = 'Leave a message in chat';
        $auth->add($chat);
        
        // add "leaveComment" permission
        $leaveComment = $auth->createPermission('leaveComment');
        $leaveComment->description = 'Leave a comment';
        $auth->add($leaveComment);
        
         // add "createPost" permission
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);
        
         // add "leaveComment" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update a post';
        $auth->add($updatePost);
        
         // add "leaveComment" permission
        $deletePost = $auth->createPermission('deletePost');
        $deletePost->description = 'Delete a Post';
        $auth->add($deletePost);
        
         // add "dropUser" permission
        $dropUser = $auth->createPermission('dropUser');
        $deletePost->description = 'Drop User';
        $auth->add($dropUser);
        
         // add "author" role and give this role the "createPost" permission
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $createGroup);
        $auth->addChild($user, $chat);
        $auth->addChild($user, $leaveComment);


        // add "author" role and give this role the "createPost" permission
        $author = $auth->createRole('author');
        $auth->add($author);
        
        $auth->addChild($author, $createPost);
        //$auth->addChild($author, $updatePost);
        $auth->addChild($author, $user);

        // add the rule
        $rule = new \app\rbac\authorRule;
        $auth->add($rule);

        // add the "updateOwnPost" permission and associate the rule with it.
        $updateOwnPost = $auth->createPermission('updateOwnPost');
        $updateOwnPost->description = 'Update own post';
        $updateOwnPost->ruleName = $rule->name;
        $auth->add($updateOwnPost);

        // "updateOwnPost" will be used from "updatePost"
        $auth->addChild($updateOwnPost, $updatePost);

        // allow "author" to update their own posts
        $auth->addChild($author, $updateOwnPost);
        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $owner = $auth->createRole('owner');
        $auth->add($owner);
        $auth->addChild($owner, $deletePost);
        $auth->addChild($owner, $author);
        $auth->addChild($owner, $dropUser);
        $auth->addChild($owner, $updatePost);
        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($user, 3);
        $auth->assign($author, 2);
        $auth->assign($owner, 1);
    }
}