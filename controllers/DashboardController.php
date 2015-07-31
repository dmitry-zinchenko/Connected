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
use yii\filters\VerbFilter;
use app\models\Users;
class DashboardController extends \yii\web\Controller
{
    public function actionAccountSettings()
    {
        $modelAccount = new AccountSettingsForm();
        $modelAccount->setUser(\Yii::$app->user->getId());
        if($modelAccount->load(\Yii::$app->request->post()) && $modelAccount->updateProfile())
        {
            return $this->redirect(['dashboard/index']);
        }

        $modelPassword = new changePasswordForm();
        $modelPassword->setUser(\Yii::$app->user->getId());
        if($modelPassword->load(\Yii::$app->request->post()) && $modelPassword->updateProfile())
        {
            return $this->redirect(['dashboard/index']);
        }

        return $this->render('account-settings',[
        'modelAccount' => $modelAccount,
        'modelPassword' => $modelPassword]);
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

    public function actionGroupSettings()
    {
        $model = new ChangeGroupForm();
        if($model->load(\Yii::$app->request->post()) && $model->changeGroup())
        {
            return $this->redirect(['dashboard/index']);
        }

        return $this->render('group-settings',['model' => $model]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSignOut()
    {
        return $this->render('sign-out');
    }

}
