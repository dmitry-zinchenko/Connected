<?php

namespace app\controllers;
use Yii;
use app\models\Notices;
use app\models\Comments;
use yii\data\ArrayDataProvider;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\models\Groups;
use yii\helpers\Url;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class WorkspaceController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $notice_index = Url::to(['notice/index','identifier'=>\Yii::$app->request->get('identifier')]);
        return $this->render('index',[
            'notice_index' => $notice_index
        ]);
    }

}
