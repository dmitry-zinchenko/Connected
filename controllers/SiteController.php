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
//        $pref = ['ru-RU', 'en-US'];
//        \Yii::$app->language = \Yii::$app->request->getPreferredLanguage($pref);


        if(!Yii::$app->user->isGuest) {

        } else {

        }
        return $this->render('index');
    }

    public function actionSignin()
    {
        $this->layout = 'register';

        $pass = "";
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('index');
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
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $this->layout = 'register';

        if(!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
       
        $model = new RegisterForm();
        if ($model->load(\Yii::$app->request->post()) && $model->register())
        {
            $user = Users::findByUsername($model->username);
            Yii::$app->user->login($user);

            return $this->redirect(['site/index']);
        }
        
        return $this->render('signup', [
            'model' => $model
        ]);
    }

    public function actionLanguage() {

    }
}
