<?php

namespace app\controllers;

class WorkspaceController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
