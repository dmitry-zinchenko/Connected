<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="messages-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'text:ntext',
            'author.first_name',
            'created_at',
        ],
    ]);
    ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>