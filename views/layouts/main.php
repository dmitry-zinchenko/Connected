<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use app\components\Widgets\LanguageSelectorWidget;
/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

$this->registerJsFile(Yii::$app->request->baseUrl . '/js/main.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

    <?php $this->beginBody() ?>

    <?php
    NavBar::begin([
        'brandLabel' => '',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-fixed-top navbar-main',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => Yii::t('app', 'Learn more'), 'url' => ['#learnmore'], 'linkOptions' => ['id' => 'learn-more']],
            Yii::$app->user->isGuest ?
                ['label' => Yii::t('app', 'Sign in'), 'url' => ['signin'], 'linkOptions' => ['class' => 'sign-in']] :
                ['label' => 'Dashboard', 'url' => ['dashboard/index']],
        ]
    ]);
    NavBar::end();
    ?>

    <div class="wrap">
        <?= $content ?>
    </div>

        <footer class="footer">
            <div class="container">
                <div class="pull-left">
                    <a class="logo-footer" href="<?= Yii::$app->request->baseUrl ?>"></a>
                    <?= LanguageSelectorWidget::widget([
                        'supportedLanguages' => [
                            'en-US' => [
                                'name' => 'English',
                                'class' => 'lang-en',
                            ],
                            'ru-RU' => [
                                'name' => 'Русский',
                                'class' => 'lang-ru',
                            ],
                        ]
                    ]); ?>
                </div>
                <div class="pull-right">
                    <span class="copyright">&copy; <?= date('Y') ?> <?= Html::encode('Connected Team') ?></span>
                </div>
            </div>
        </footer>

    <?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
