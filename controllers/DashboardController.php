<?php

namespace app\controllers;
use app\models\AccountSettingsForm;
use app\models\changePasswordForm;
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
        return $this->render('create-group');
    }

    public function actionGroupSettings()
    {
        return $this->render('group-settings');
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
