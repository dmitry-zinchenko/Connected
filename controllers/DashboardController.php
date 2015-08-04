<?php

namespace app\controllers;
use app\models\AccountSettingsForm;
use app\models\ChangeGroupForm;
use app\models\ChangePasswordForm;
use app\models\CreateGroupForm;
use app\models\Groups;
use Yii;
use yii\filters\AccessControl;
use yii\web;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use app\models\Users;
use app\models\Notices;
use app\models\Messages;
use app\models\Comments;
use app\models\UserGroups;

class DashboardController extends \yii\web\Controller
{
    public $layout = 'dashboard';

    public function beforeAction($action)
    {
        if(\Yii::$app->user->isGuest) {
            $this->redirect('/');
        }

        return parent::beforeAction($action) ? true : false;
    }

    public function actionAccountSettings()
    {
        $modelAccount = new AccountSettingsForm();
        $modelAccount->setUser(\Yii::$app->user->getId());
        if($modelAccount->load(\Yii::$app->request->post()) && $modelAccount->updateProfile())
        {
            return $this->redirect(['dashboard/']);
        }

        $modelPassword = new changePasswordForm();
        $modelPassword->setUser(\Yii::$app->user->getId());
        if($modelPassword->load(\Yii::$app->request->post()) && $modelPassword->updateProfile())
        {
            return $this->redirect(['dashboard/']);
        }

        return $this->render('account-settings', [
            'modelAccount' => $modelAccount,
            'modelPassword' => $modelPassword
        ]);
    }

    public function actionCreateGroup()
    {
        $model = new CreateGroupForm();
        if($model->load(\Yii::$app->request->post()) && $model->createGroup())
        {
            return $this->redirect(['dashboard/index']);
        }
        return $this->render('create-group',['model' => $model]);
    }

    public function actionGroupSettings($identifier)
    {
        $model = new ChangeGroupForm();
        $model->setParams($identifier);
        if($model->load(\Yii::$app->request->post()) && $model->changeGroup())
        {
            return $this->redirect(['dashboard/index']);
        }
        $group = Groups::find()->where(['identifier' => $identifier] )->one();
        $disabled = $group['disabled'] ? true : false;


        return $this->render('group-settings',[
            'model' => $model,
            'disabled' => $disabled,
            'identifier' => $identifier
        ]);
    }

    public function actionIndex()
    {
        $user = \Yii::$app->user->identity;
        $myGroups = $user->getOwnGroups();
        $participating = $user->getParticipatingGroups();
        $disabledGroups = $user->getDisabledGroups();
        return $this->render('index', [
            'myGroups' => $myGroups,
            'participating' => $participating,
            'disabledGroups' => $disabledGroups,
        ]);
    }

    public function actionDisable($identifier)
    {
        if($group = Groups::find()->where(['identifier' => $identifier])->one()) {
            if ($group['disabled']) {
                $group->setAttribute('disabled', 0);
            } else {
                $group->setAttribute('disabled', 1);

            }
            $group->save();
        }
        return $this->redirect(['dashboard/group-settings?identifier=' . $identifier]);

    }

    public function actionDelete($identifier)
    {
        if($group=Groups::find()->where(['identifier' => $identifier])->one()) {

            $notices = Notices::find()->where(['group_id' => $group->id])->all();
            foreach ($notices as $notice) {
                Comments::deleteAll('notice_id = :id', [':id' => $notice->id]);
                $notice->delete();
            }

            Messages::deleteAll('group_id = :id', [':id' => $group->id]);
            UserGroups::deleteAll('group_id = :id', [':id' => $group->id]);
            $group->delete();

            return $this->redirect(['dashboard/index']);
        }

        return $this->redirect(['dashboard/group-settings?identifier=' . $identifier]);

    }

}
