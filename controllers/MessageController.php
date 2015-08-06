<?php

namespace app\controllers;

use Yii;
use app\models\Messages;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
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
//    public function beforeAction($action)
//    {
//        if (parent::beforeAction($action)) {
//            $this->group = Groups::find()->where(['identifier' => \Yii::$app->request->get('group')])->one();
//            return true;
//        }
//        return false;
//    }

    public function actionIndex($group)
    {
        $this->group = Groups::find()->where(['identifier' => $group])->one();

        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/json; charset=utf-8');

        if(\Yii::$app->user->can('AccessGroup',['group'=>$this->group])) {
            $messages = Messages::find()->where(['group_id' => $this->group->id])->orderBy('id')->all();

            return $this->renderPartial('index', [
                'messages' => $messages,
            ]);
        }
        else
        {
            throw new ForbiddenHttpException('Access denied');
        }
    }

    public function actionSend()
    {
        $this->group = Groups::find()->where(['identifier' => \Yii::$app->request->post('group')])->one();

        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/json; charset=utf-8');

        if(\Yii::$app->user->can('AccessGroup',[ 'group' => $this->group ])) {
            $model = new Messages(
                \Yii::$app->request->post('text'),
                $this->group->id
            );
            $result = $model->create();

            return $this->renderPartial('send', [
                'result' => $result,
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