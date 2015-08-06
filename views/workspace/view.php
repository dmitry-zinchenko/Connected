<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\helpers\Url;
use app\models\Groups;
use app\models\Notices;

/* @var $this yii\web\View */
/* @var $model app\models\Notices */
/* @var $model_comments app\models\Comments */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Notices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

Yii::$app->view->params['group'] = $group;
Yii::$app->view->params['members'] = $group->getMembersWithOwner();

?>

<?= Html::a(Yii::t('app', 'Notices'), Url::to(['index', 'identifier'=>$group->identifier])); ?>

<div class="notices-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id, 'identifier' => $group->identifier], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id, 'identifier' => $group->identifier], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'text:ntext',
            'create_at',
            'author.first_name',
        ],
    ]) ?>

</div>

<div class="comments">

    <h4><?= Html::encode('Comments') ?></h4>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_comment_item',
        'pager' => ['class' => kop\y2sp\ScrollPager::className(),'negativeMargin' => 500]
    ]);

    ?>

    <?=
    $this->render('_comments', [
        'model_comments' => $model_comments,
    ]) ?>

</div>