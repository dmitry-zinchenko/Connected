<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $index = $auth->createPermission('index');
        $index->description = 'Access to index';
        $auth->add($index);

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

        // add the rule
        $rule = new \app\rbac\OwnerRule;
        $auth->add($rule);

        $changeGroup=$auth->createPermission('changeGroup');
        $changeGroup->description='Change Group';
        $changeGroup->ruleName = $rule->name;
        $auth->add($changeGroup);

        $grantAuthor=$auth->createPermission('granAuthor');
        $grantAuthor->description='Grant user rights of author';
        $auth->add($grantAuthor);

        $cancelAuthor=$auth->createPermission('cancelAuthor');
        $cancelAuthor->description='Cancel user rights of author';
        $auth->add($cancelAuthor);

        $inviteUser = $auth->createPermission('inviteUser');
        $inviteUser->description='Invite user in this group';
        $auth->add($inviteUser);


        // add the rule
        $rule = new \app\rbac\MemberRule;
        $auth->add($rule);

        // add the "updateOwnPost" permission and associate the rule with it.
        $member = $auth->createPermission('AccessGroup');
        $member->description = 'Access to group';
        $member->ruleName = $rule->name;
        $auth->add($member);


        $rule = new \app\rbac\UserGroupRule;
        $auth->add($rule);



        // add "author" role and give this role the "createPost" permission
        $user = $auth->createRole('user');
        $user->ruleName = $rule->name;
        $auth->add($user);
        $auth->addChild($user, $createGroup);
        $auth->addChild($user, $chat);
        $auth->addChild($user, $index);
        $auth->addChild($user, $leaveComment);
        $auth->addChild($user, $member);


        // add "author" role and give this role the "createPost" permission
        $author = $auth->createRole('author');
        $author->ruleName = $rule->name;
        $auth->add($author);
        
        $auth->addChild($author, $createPost);
        //$auth->addChild($author, $updatePost);
        $auth->addChild($author, $user);

        // add the rule
        $rule = new \app\rbac\AuthorRule;
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
        $rule = new \app\rbac\UserGroupRule;
        $owner->ruleName = $rule->name;
        $auth->add($owner);
        $auth->addChild($owner, $deletePost);
        $auth->addChild($owner, $author);
        $auth->addChild($owner, $dropUser);
        $auth->addChild($owner, $updatePost);
        $auth->addChild($owner, $changeGroup);
        $auth->addChild($owner, $grantAuthor);
        $auth->addChild($owner, $cancelAuthor);
        $auth->addChild($owner, $inviteUser);
        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($user, 3);
        $auth->assign($author, 2);
        $auth->assign($owner, 1);
    }
}