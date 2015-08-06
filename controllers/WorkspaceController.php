<?php

namespace app\controllers;

use app\models\Groups;
use Yii;
use yii\web\NotFoundHttpException;

class WorkspaceController extends \yii\web\Controller
{
    public $layout = 'workspace';

    public function actionIndex($identifier)
    {
        if($group = Groups::findGroupByIdentifier($identifier)) {

            return $this->render('index', [
                'group' => $group,
            ]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'There is no group with identifier {id}', [
                'id' => $identifier,
            ]));
        }

    }

}
