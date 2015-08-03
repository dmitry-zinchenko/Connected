<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Connected - a platform to collaborate with team');
?>

<div class="site-index">

    <section class="jumbotron">
        <h1><?= Html::encode('Единое пространство для всей команды') ?></h1>

        <p class="lead"><?= Html::encode('Делитесь важной информацией и идеями, а затем обсуждайте их со своими коллегами') ?></p>
        <p><a class="btn btn-lg btn-danger" href="<?= Url::to(['signup']) ?>"><?= Yii::t('app', 'Sign up') ?></a></p>
        <div class="head-image">
            <img class="screenshot" src="<?= Yii::$app->request->baseUrl ?>/images/screenshot_interface.png" >
        </div>
    </section>

    <div class="body-content body-landing">

        <section class="row indigo" id="description">
            <div class="row-content">
                <h2 class="row-header"><?= Html::encode('Создавайте объявления') ?></h2>
                <p><?= Html::encode('У вас всегда есть то, что нужно донести до всей команды. Объедините людей в группу и отравляйте важную информацию всем сразу.') ?></p>
                <img class="row-image" src="<?= Yii::$app->request->baseUrl ?>/images/screenshot_notices.jpg">
            </div>
        </section>

        <section class="row">
            <div class="row-content">
                <h2 class="row-header"><?= Html::encode('Взаимодействуйте') ?></h2>
                <div class="clearfix cols">
                    <div class="col-sm-6">
                        <p><?= Html::encode('Объявления &mdash; это не просто объявления! Это целая платформа для обсуждения и принятия решений') ?></p>
                        <img class="row-image" src="<?= Yii::$app->request->baseUrl ?>/images/screenshot_notices.jpg">
                    </div>
                    <div class="col-sm-6">
                        <p><?= Html::encode('Если вам нужно быстро сообщить всем что-то, вы всегда можете воспользоваться групповым чатом.') ?></p>
                        <img class="row-image" src="<?= Yii::$app->request->baseUrl ?>/images/screenshot_notices.jpg">
                    </div>
                </div>
            </div>
        </section>

        <section class="row indigo">
            <div class="row-content">
                <h2 class="row-header"><?= Html::encode('Используйте теги') ?></h2>
                <p><?= Html::encode('Распределяйте объявления с помощью тегов. Добавляйте ключевые слова и используйте их для поиска по категориям.') ?></p>
                <img class="row-image" src="<?= Yii::$app->request->baseUrl ?>/images/screenshot_notices.jpg">
            </div>
        </section>

        <section class="row">
            <div class="row-content">
                <h2 class="row-header"><?= Html::encode('Другие возможности') ?></h2>
                <div class="clearfix cols">
                    <div class="col-sm-4">
                        <section class="feature">
                            <div class="feature-description">
                                <h3><?= Html::encode('Неограниченность групп') ?></h3>
                                <p><?= Html::encode('Вы можете создавать неограниченное количество групп и состоять в других без ограничений.') ?></p>
                            </div>
                            <div class="feature-image">
                                <img src="<?= Yii::$app->request->baseUrl ?>/images/screenshot_notices.jpg">
                            </div>
                        </section>
                    </div>
                    <div class="col-sm-4">
                        <section class="feature">
                            <div class="feature-description">
                                <h3><?= Html::encode('Управляйте привилегиями') ?></h3>
                                <p><?= Html::encode('Вы решаете, кто может смотреть, создавать и редактировать контент в вашей группе.') ?></p>
                            </div>
                            <div class="feature-image">
                                <img src="<?= Yii::$app->request->baseUrl ?>/images/screenshot_notices.jpg">
                            </div>
                        </section>
                    </div>
                    <div class="col-sm-4">
                        <section class="feature coming-soon">
                            <div class="feature-description">
                                <h3><?= Html::encode('Подключите облачное хранилище') ?></h3>
                                <p><?= Html::encode('Подключите аккаунт Dropbox к группе, чтобы каждый имел доступ к файлам.') ?></p>
                            </div>
                            <div class="feature-image">
                                <span class="coming-soon-text"><?= Html::encode('Будет доступно скоро') ?></span>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>