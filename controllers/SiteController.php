<?php

namespace app\controllers;

use app\models\RegisterForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Users;
class SiteController extends Controller
{
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            // change layout for error action
            if ($action->id=='error')
                $this->layout ='register';
            return true;
        } else {
            return false;
        }
    }
    
    public function behaviors()
    {
        return [
            // 'access' => [
            //     'class' => AccessControl::className(),
            //     'only' => ['logout'],
            //     'rules' => [
            //         [
            //             'actions' => ['logout'],
            //             'allow' => true,
            //             'roles' => ['@'],
            //         ],
            //     ],
            // ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        if(!Yii::$app->user->isGuest) {
            $this->redirect(['dashboard/']);
        }
        return $this->render('index');
    }

    public function actionSignin()
    {
        if(!Yii::$app->user->isGuest) {
            $this->redirect(['dashboard/']);
        }

        $this->layout = 'register';

        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        } else {
            $pass = $model->password;
            return $this->render('signin', [
                'model' => $model,
                'pass' => $pass
            ]);
        }
    }

    public function actionSignout()
    {
        if(!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }

        return $this->goHome();
    }

    public function actionSignup()
    {
        if(!Yii::$app->user->isGuest) {
            $this->redirect(['dashboard/']);
        }

        $this->layout = 'register';
       
        $model = new RegisterForm();
        if ($model->load(\Yii::$app->request->post()) && $model->register())
        {
            $user = Users::findByUsername($model->username);
            Yii::$app->user->login($user);

            return $this->goHome();
        }
        
        return $this->render('signup', [
            'model' => $model
        ]);
    }
}
