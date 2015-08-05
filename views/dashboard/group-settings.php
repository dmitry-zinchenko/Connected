<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\Helpers\Url;

$this->title = Yii::t('app', 'Group settings') . Html::encode(' - ' . $model->getGroup()->name);
?>

<section class="block-dash">
    <h1><?= Yii::t('app', 'Group settings') ?></h1>
    <div class="form-dash">
    <?php $form = ActiveForm::begin([
        'id' => 'changeGroup-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'labelOptions' => ['class' => 'control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'identifier')->textInput(['value' => $model->getGroup()->identifier, 'disabled' => 'disabled']) ?>
    <?= $form->field($model, 'name')->textInput(['value' => $model->getGroup()->name]) ?>
    <?= $form->field($model, 'description')->textInput(['value' => $model->getGroup()->description]) ?>
        <div class="form-dash-button">
        <?= Html::submitButton(Yii::t('app', 'Save changes'), ['class' => 'btn btn-primary login-button', 'name' => 'login-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
</section>

<section class="group-manage group-disable">
    <?php if(!$disabled) : ?>
        <h3><?= Yii::t('app', 'Disable group') ?></h3>
        <p><?= Yii::t('app', 'This group will become inactive. Nobody will have access until you activate the group.') ?></p>
        <p class="text-center confirmation"><?= Html::a(Yii::t('app', 'Disable'), Url::toRoute( ['dashboard/disable','identifier' => $identifier]),['class' => 'btn btn-warning']) ?></p>
    <?php else : ?>
        <h3><?= Yii::t('app', 'Enable group') ?></h3>
        <p><?= Yii::t('app', 'Enable access to the group.') ?></p>
        <p class="text-center confirmation"><?= Html::a(Yii::t('app', 'Enable'), Url::toRoute( ['dashboard/disable','identifier' => $identifier]),['class' => 'btn btn-warning']) ?></p>
    <?php endif; ?>
</section>

<section class="group-manage group-delete">
    <h3><?= Yii::t('app', 'Delete group') ?></h3>
    <p><?= Yii::t('app', 'Delete everything related to this group. This operation can not be undone!') ?></p>
    <p class="text-center confirmation"><?= Yii::t('app', 'Will be available soon') ?></p>
</section>