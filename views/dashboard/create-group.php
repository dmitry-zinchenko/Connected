<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h1>Create Group</h1>

<div class="site-login">
    <div class="login-form-back">
        <h1><?= Yii::t('app', 'Create Group') ?></h1>
        <?php $form = ActiveForm::begin([
            'id' => 'createGroup-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'labelOptions' => ['class' => 'control-label'],
            ],
        ]); ?>

        <?= $form->field($model, 'identifier') ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'description') ?>
        <div class="form-group sign-block">
            <?= Html::submitButton(Yii::t('app', 'Apply'), ['class' => 'btn btn-primary login-button', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>