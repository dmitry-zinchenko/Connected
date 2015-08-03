<?php

namespace app\controllers;
use app\models\AccountSettingsForm;
use app\models\ChangeGroupForm;
use app\models\ChangePasswordForm;
use app\models\CreateGroupForm;
use app\models\Groups;
use app\models\SetDisabledGroupForm;
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
        $model->setParams();
        if($model->load(\Yii::$app->request->post()) && $model->changeGroup())
        {
            return $this->redirect(['dashboard/index']);
        }
        $name = \Yii::$app->request->get('name');
        $group = Groups::find()->where(['name' =>$name] )->one();
        $disable = (!$group['disabled']) ? 'Disable' : 'Enable';


        return $this->render('group-settings',[
            'model' => $model,
            'disable' => $disable,
            'name' => $name
        ]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSignOut()
    {
        if(!\Yii::$app->user->logout()) {
            return $this->render('sign-out');
        }
        return $this->redirect(['site/index']);
    }

    public function actionDisable()
    {

        $name = \Yii::$app->request->get('name');
        if($group=Groups::find()->where(['name' => $name])->one()) {

            if ($group['disabled']) {

                $group->setAttribute('disabled', false);
            } else {
                $group->setAttribute('disabled', true);

            }
            if ($group->save()) {
                return $this->redirect(['dashboard/index']);

            }
        }
        return $this->redirect(['dashboard/group-settings?name='.$name]);

    }

    public function actionDelete()
    {

        $name = \Yii::$app->request->get('name');
        if($group=Groups::find()->where(['name' => $name])->one()) {

            if ($group->delete()) {
                return $this->redirect(['dashboard/index']);

            }
        }
        return $this->redirect(['dashboard/group-settings?name='.$name]);

    }

}
