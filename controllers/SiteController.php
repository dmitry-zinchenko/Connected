<?php

namespace app\controllers;

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
        return $this->render('index');
    }

    public function actionLogin()
    {
         $pass = "";
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->render('index');
        } else {
            $pass = $model->password;
            return $this->render('login', [
                'model' => $model,
                'pass' => $pass
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

   public function actionSignup()
    {
       
        $user = new Users(['scenario' => 'signup']);
        //$user->scenario = 'signup';
        if ($user->load(\Yii::$app->request->post()) && $user->validate())
        {
            $user->setPassword();
            $user->setToken($user->getId()."token");
            $user->setAuthKey("auth".$user->getId()."key");
            $user->save(false);
        return $this->redirect(['site/index']);
        }
        
        return $this->render('signup', [
            'user' => $user
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
