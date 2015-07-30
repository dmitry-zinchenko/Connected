<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Notices');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notices-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Notice'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'text',

            /* [
             'class' => 'yii\grid\DataColumn',
             'attribute' => 'author',
             'value' => function() {
                 //$model = $dataProvider->id;
                 return $model->author->first_name;
             }],*/
            'author.first_name',

            'author.id',

            'create_at',
            //'to',
            //'author_id',

            ['class' => 'yii\grid\ActionColumn',
                //'template' => '{view} {update} {delete}',

                'buttons'=>[
                    'view' => function ($url, $model) {
                        return Html::a(Yii::t('app', 'View'), ['view', 'id' => $model->id]);

                        },

                    'update' => function ($url, $model) {
                        return Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id]);

                    },

                    'delete' => function ($url, $model) {
                        return Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                            //'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ]
                        ]);
                    }
                ],
            ],
        ],
    ]); ?>

</div>