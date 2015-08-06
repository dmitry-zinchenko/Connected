<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Notices */

$this->title = Yii::t('app', 'Update Notice: ', [
        'modelClass' => 'Notices',
    ]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Notices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

Yii::$app->view->params['group'] = $group;
Yii::$app->view->params['members'] = $group->getMembersWithOwner();
?>
<div class="notices-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>