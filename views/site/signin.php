<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = Html::encode('Connected - ') . Yii::t('app', 'Sign in');
?>
<div class="site-login">
    <div class="login-form-back">
        <h1><?= Yii::t('app', 'Sign in') ?></h1>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'labelOptions' => ['class' => 'control-label'],
            ],
        ]); ?>

        <?= $form->field($model, 'username') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe', [
            'template' => "<div class=\"\">{input}</div>\n<div class=\"\">{error}</div>",
        ])->checkbox() ?>

        <div class="form-group sign-block">
            <?= Html::submitButton(Yii::t('app', 'Sign in'), ['class' => 'btn btn-primary login-button', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
