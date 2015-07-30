<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Connected - a platform to collaborate with team');
?>

<div class="site-index">

    <section class="jumbotron">
        <h1><?= Html::encode('One place for the whole team') ?></h1>

        <p class="lead"><?= Html::encode('You can easily share important information, idea and discuss it with your colleagues') ?></p>
        <p><a class="btn btn-lg btn-danger" href="<?= Url::to(['signup']) ?>"><?= Yii::t('app', 'Sign up') ?></a></p>
        <div class="head-image">
            <img class="screenshot" src="/images/screenshot_interface.png" >
        </div>
    </section>

    <div class="body-content body-landing">

        <section class="row indigo" id="description">
            <div class="row-content">
                <h2 class="row-header"><?= Html::encode('Create notices') ?></h2>
                <p><?= Html::encode('You always have a lot to share. Just band your team together and send important information to all at once') ?></p>
                <img class="row-image" src="/images/screenshot_notices.jpg">
            </div>
        </section>

        <section class="row">
            <div class="row-content">
                <h2 class="row-header"><?= Html::encode('Collaborate') ?></h2>
                <div class="clearfix cols">
                    <div class="col-sm-6">
                        <p><?= Html::encode('Notices are not just notices! It\'s a platform for discussions and making decisions') ?></p>
                        <img class="row-image" src="/images/screenshot_notices.jpg">
                    </div>
                    <div class="col-sm-6">
                        <p><?= Html::encode('If it\'s a quick question or you need to send a link to all your colleagues you can use group chat.') ?></p>
                        <img class="row-image" src="/images/screenshot_notices.jpg">
                    </div>
                </div>
            </div>
        </section>

        <section class="row indigo">
            <div class="row-content">
                <h2 class="row-header"><?= Html::encode('Use tags') ?></h2>
                <p><?= Html::encode('Categorize notices with tags. Just add keywords to your notice and use them for searching.') ?></p>
                <img class="row-image" src="/images/screenshot_notices.jpg">
            </div>
        </section>

        <section class="row">
            <div class="row-content">
                <h2 class="row-header"><?= Html::encode('Cool features') ?></h2>
                <div class="clearfix cols">
                    <div class="col-sm-4">
                        <section class="feature">
                            <div class="feature-description">
                                <h3><?= Html::encode('Unlimited groups') ?></h3>
                                <p><?= Html::encode('You can create and participate unlimited amount of groups.') ?></p>
                            </div>
                            <div class="feature-image">
                                <img src="">
                            </div>
                        </section>
                    </div>
                    <div class="col-sm-4">
                        <section class="feature">
                            <div class="feature-description">
                                <h3><?= Html::encode('Control privileges') ?></h3>
                                <p><?= Html::encode('You decide, who can view, create and manage content in your group.') ?></p>
                            </div>
                            <div class="feature-image">
                                <img src="">
                            </div>
                        </section>
                    </div>
                    <div class="col-sm-4">
                        <section class="feature coming-soon">
                            <div class="feature-description">
                                <h3><?= Html::encode('Connect to storage') ?></h3>
                                <p><?= Html::encode('Connect Dropbox account to your group, so everyone have access to files.') ?></p>
                            </div>
                            <div class="feature-image">
                                <span class="coming-soon-text"><?= Html::encode('Coming soon') ?></span>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>