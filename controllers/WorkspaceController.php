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
    public $layout = 'workspace';

    private $group;
    public function beforeAction($action)
    {
        if (parent::beforeAction($action) && !empty(\Yii::$app->request->get('identifier'))){
            $this->group = Groups::find()->where(['identifier' => \Yii::$app->request->get('identifier')])->one();
            return true;
        }
        return false;
    }


    public function actionIndex($identifier)
    {
        if(!\Yii::$app->user->isGuest) {
            if($this->group) {
                $query = Notices::find()->where(['group_id' => $this->group->id])->all();
                $dataProvider = new ArrayDataProvider([
                    'allModels' => $query,
                    'key' => 'id',

                ]);

                return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'group' => $this->group,
                ]);

            } else {
                throw new NotFoundHttpException(Yii::t('app', 'There is no group with identifier {id}', [
                    'id' => $identifier,
                ]));
            }
        }
        else
        {
            throw new ForbiddenHttpException('Access denied');
        }

    }

}
