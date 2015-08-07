<?php
/**
 * Created by PhpStorm.
 * User: Dmitry
 * Date: 31.07.2015
 * Time: 15:49
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use app\components\Widgets\LanguageSelectorWidget;
/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

$this->registerJsFile(Yii::$app->request->baseUrl . '/js/dashboard.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

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

<div class="wrap-dash">

    <?php
    $items = [
        [
            'label' => Html::encode(\Yii::$app->user->identity->first_name . ' ' . \Yii::$app->user->identity->last_name),
            'url' => ['dashboard/'],
            'linkOptions' => ['class' => 'dash-link link-profile']
        ],
        ['label' => Yii::t('app', 'Settings'), 'url' => ['account-settings'], 'linkOptions' => ['class' => 'dash-link link-settings']],
        ['label' => Yii::t('app', 'Sign out'), 'url' => ['site/signout'], 'linkOptions' => ['class' => 'dash-link link-signout']],
    ];
    NavBar::begin([
        'brandLabel' => '',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-dashboard navbar-dashboard-abs',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => !\Yii::$app->user->isGuest ? $items : [],
    ]);
    NavBar::end();
    ?>

    <section class="content-dash">
        <?= $content ?>
    </section>

    <footer class="footer-dash">
        <div class="container">
            <div class="pull-left">
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

</div>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>