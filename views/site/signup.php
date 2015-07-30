<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Users;

$this->title = Html::encode('Connected - ') . Yii::t('app', 'Sign up');
?>

<div class="site-login">
    <div class="login-form-back">
        <h1><?= Yii::t('app', 'Sign up') ?></h1>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'labelOptions' => ['class' => 'control-label'],
            ],
        ]) ?>

            <?= $form->field($model, Yii::t('app', 'username')) ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'repeat_password')->passwordInput() ?>
            <?= $form->field($model, 'first_name') ?>
            <?= $form->field($model, 'last_name') ?>

            <div class="form-group sign-block">
                    <?= Html::submitButton(Yii::t('app', 'Create account'), ['class' => 'btn btn-primary login-button']) ?>
            </div>

        <?php ActiveForm::end() ?>
    </div>
</div>
