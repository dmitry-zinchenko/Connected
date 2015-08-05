<?php

namespace app\controllers;

use Yii;
use app\models\Messages;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use app\models\Groups;
use yii\filters\VerbFilter;

/**
 * MessageController implements the CRUD actions for Messages model.
 */
class MessageController extends Controller
{

    private $group;
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            $this->group = Groups::find()->where(['identifier' => \Yii::$app->request->get('group_identifier')])->one();
            return true;
        }
        return false;
    }

    public function actionIndex()
    {
        if(\Yii::$app->user->can('AccessGroup',['group'=>$this->group])) {
            $model = new Messages();
            if ($model->load(Yii::$app->request->post()) && $model->save()) $this->redirect(Url::toRoute(['message/index', 'group_identifier' => $this->group->identifier]));

            $dataProvider = new ActiveDataProvider([
                'query' => Messages::find()->where(['group_id' => $this->group->id]),
            ]);

            $model->group_id = $this->group->id;
            return $this->render('index', [
                'dataProvider' => $dataProvider,
                'model' => $model,
            ]);
        }
        else
        {
            throw new ForbiddenHttpException('Access denied');
        }
    }

    protected function findModel($id)
    {
        if (($model = Messages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}