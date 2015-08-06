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

<div class="new-notice-buton">
    <?= Html::a('', Url::to(['create','identifier'=>$group->identifier]), ['class' => 'new-notice-link']) ?>
</div>

<div class="notice-list">

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemOptions' => ['class' => 'item'],
    'itemView' => '_list_item',
    'pager' => ['class' => kop\y2sp\ScrollPager::className(),'negativeMargin' => 500]
    ]);
?>

</div>