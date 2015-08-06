<?php

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Dashboard');
?>

<h1><?= Yii::t('app', 'My groups') ?></h1>
<div class="groups-list">
    <?php foreach($myGroups as $group) : ?>
        <?php if($group->disabled == 0) : ?>
            <div class="group-block">
                <a class="group-settings" href="<?= Url::to([ 'group-settings', 'identifier' => $group->identifier ]) ?>"></a>
                <h3><?= Html::encode($group->name) ?></h3>
                <p class="group-description"><?= Html::encode($group->description) ?></p>
                <a href="<?= Url::to(["workspace/", "identifier" => $group->identifier]) ?>" class="group-open btn btn-success"><?= Yii::t('app', 'Open') ?></a>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <a class="group-block group-add" href="<?= Url::to(['create-group']) ?>"></a>
</div>

<h1><?= Yii::t('app', 'Participating') ?></h1>
<div class="groups-list">
    <?php if(empty($participating)) : ?>
        <p><?= Yii::t('app', 'You are not a member of any group.') ?></p>
    <?php endif; ?>
    <?php foreach($participating as $group) : ?>
        <div class="group-block">
            <h3><?= Html::encode($group->name) ?></h3>
            <p class="group-description"><?= Html::encode($group->description) ?></p>
            <a href="<?= Url::to(["workspace/", "identifier" => $group->identifier]) ?>" class="group-open btn btn-success"><?= Yii::t('app', 'Open') ?></a>
        </div>
    <?php endforeach; ?>
</div>

<h1><?= Yii::t('app', 'Disabled') ?></h1>
<div class="groups-list">
    <?php if(empty($disabledGroups)) : ?>
        <p><?= Yii::t('app', 'Nothing to show.') ?></p>
    <?php endif; ?>
    <?php foreach($disabledGroups as $group) : ?>
        <div class="group-block">
            <a class="group-settings" href="<?= Url::to([ 'group-settings', 'identifier' => $group->identifier ]) ?>"></a>
            <h3><?= Html::encode($group->name) ?></h3>
            <p class="group-description"><?= Html::encode($group->description) ?></p>
        </div>
    <?php endforeach; ?>

</div>