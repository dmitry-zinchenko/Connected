<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h1>Group Settings</h1>

<div class="site-login">
    <div class="login-form-back">
        <h1><?= Yii::t('app', 'Create Group') ?></h1>
        <?php $form1 = ActiveForm::begin([
            'id' => 'changeGroup-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'labelOptions' => ['class' => 'control-label'],
            ],
        ]); ?>

        <?= $form1->field($model, 'name') ?>
        <?= $form1->field($model, 'description') ?>
        <?= $form1->field($model, 'disabled')->checkbox() ?>
        <div class="form-group sign-block">
            <?= Html::submitButton(Yii::t('app', 'Apply'), ['class' => 'btn btn-primary login-button', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>