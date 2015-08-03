<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Notices */
/* @var $model_comments app\models\Comments */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Notices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= Html::a(Yii::t('app', 'Notices'), ['index']); ?>

<div class="notices-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'text:ntext',
            'author.first_name',
            'created_at',
            ['class' => 'yii\grid\ActionColumn',
                'buttons'=>[

                    'delete' => function ($url, $model, $key) {
                        return Html::a(Yii::t('app', 'Delete'), ['deletecomment', 'id_comment' => $key], [
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this comment?'),
                                'method' => 'post',
                            ]
                        ]);
                    }

                ],
            ],
        ],
    ]);

    ?>

    <?=
    $this->render('_comments', [
        'model_comments' => $model_comments,
    ]) ?>

</div>