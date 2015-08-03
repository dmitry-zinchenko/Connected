<?php

namespace app\controllers;

use Yii;
use app\models\Messages;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use yii\filters\VerbFilter;

/**
 * MessageController implements the CRUD actions for Messages model.
 */
class MessageController extends Controller
{
    public function actionIndex()
    {
        $model = new Messages();
        if($model->load(Yii::$app->request->post()) && $model->save()) $this->redirect(Url::toRoute('message/index'));

        $dataProvider = new ActiveDataProvider([
            'query' => Messages::find(),
        ]);


        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
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