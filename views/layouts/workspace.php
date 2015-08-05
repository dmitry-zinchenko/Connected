<?php
/**
 * Created by PhpStorm.
 * User: Dmitry
 * Date: 05.08.2015
 * Time: 13:03
 */

use yii\bootstrap\ButtonDropdown;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use app\components\Widgets\LanguageSelectorWidget;
/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

$group = $this->params['group'];
$members = $this->params['members'];

$dataProvider = new ActiveDataProvider([
    'query' => $members,
    'pagination' => [
        'pageSize' => false,
    ],
]);

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

    <div class="wrap-work">

        <?php
        NavBar::begin([
            'brandLabel' => '',
            'brandUrl' => Yii::$app->homeUrl,
            'brandOptions' => [
                'title' => 'Back to dashboard',
            ],
            'options' => [
                'class' => 'navbar-default navbar-dashboard',

            ],
        ]);
        echo Html::tag('span', $group->name, [ 'class' => 'group-name']);
        echo Html::tag('button', '', [ 'class' => 'button-sidebar-open', 'title' => Yii::t('app', 'Open sidebar') ]);
        echo ButtonDropdown::widget([
            'label' => 'Add storage',
            'dropdown' => [
                'items' => [
                    [
                        'label' => 'Coming soon',
                        'url' => '#'
                    ],
                ],
                'options' => [
                    'class' => 'dropdown-menu-storage',
                ],
            ],
            'options' => [
                'class' => 'dropdown-storage-btn',
            ],
            'containerOptions' => [
                'class' => 'container-storage',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right nav-work'],
            'items' => [
                [
                    'label' => 'Add storage (coming soon)',
                    'url' => '#',
                ],
            ],
        ]);
        NavBar::end();
        ?>



        <div class="content-wrap">

            <aside id="group-members" class="sidebar">
                <div class="sidebar-wrap">
                    <div class="sidebar-content">
                        <h3>Members</h3>
                        <div class="members-list">
                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'tableOptions' => ['class' => 'table table-members'],
                                'columns' => [
                                    [
                                        'format' => 'text',
                                        'header' => Yii::t('app', 'Member'),
                                        'value' => function ($user) { return "$user->first_name $user->last_name"; },
                                    ],
                                    [
                                        'value' => function ($user, $key, $index, $column) use ($group) {
                                            return $user->getRole($group->id)->item_name;
                                        },
                                        'format' =>'raw',
                                        'header' => Yii::t('app', 'Role'),
                                    ],
                                ],
                            ]) ?>
                        </div>
                        <h3>Group chat</h3>
                        <div class="group-chat">

                        </div>
                    </div>
                </div>
            </aside>
            <section class="content-work">
                <?= $content ?>
            </section>

        </div>

    </div>

    <?php $this->endBody() ?>

    </body>
    </html>
<?php $this->endPage() ?>