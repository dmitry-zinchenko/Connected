<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use app\models\Groups;
use yii\helpers\Url;
Yii::$app->view->params['group'] = $group;
Yii::$app->view->params['members'] = $group->getMembersWithOwner();

$this->title = Html::encode($group->name . ' - ') . Yii::t('app', 'Workspace');
?>
<h1>workspace/index</h1>

<p>
    <?= Html::a(Yii::t('app', 'Create Notice'), Url::to(['create','group_identifier'=>$group->identifier]), ['class' => 'btn btn-success']) ?>
</p>

<div class="notice-list">

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemOptions' => ['class' => 'item'],
    'itemView' => '_list_item',

    'pager' => ['class' => kop\y2sp\ScrollPager::className(),'negativeMargin' => 500]
]); ?>

</div>