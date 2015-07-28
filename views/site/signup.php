<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Users;

$this->title = 'Sign up';
?>

<div class="site-login">
    <div class="login-form-back">
        <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'labelOptions' => ['class' => 'control-label'],
            ],
        ]) ?>

            <?= $form->field($user, 'username') ?>
            <?= $form->field($user, 'email') ?>
            <?= $form->field($user, 'password')->passwordInput() ?>
            <?= $form->field($user, 'repeat_password')->passwordInput() ?>
            <?= $form->field($user, 'first_name') ?>
            <?= $form->field($user, 'last_name') ?>

            <div class="form-group sign-block">
                    <?= Html::submitButton('Create account',['class' => 'btn btn-primary login-button']) ?>
            </div>

        <?php ActiveForm::end() ?>
    </div>
</div>


<!--<div class="site-login">-->
<!--    <div class="login-form-back">-->
<!--        <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
<!---->
<!--        --><?php //$form = ActiveForm::begin([
//            'id' => 'login-form',
//            'options' => ['class' => 'form-horizontal'],
//            'fieldConfig' => [
//                'template' => "{label}\n<div class=\"\">{input}</div>\n<div class=\"\">{error}</div>",
//                'labelOptions' => ['class' => 'control-label'],
//            ],
//        ]); ?>
<!---->
<!--        --><?//= $form->field($model, 'username') ?>
<!---->
<!--        --><?//= $form->field($model, 'password')->passwordInput() ?>
<!---->
<!--        --><?//= $form->field($model, 'rememberMe', [
//            'template' => "<div class=\"\">{input}</div>\n<div class=\"\">{error}</div>",
//        ])->checkbox() ?>
<!---->
<!--        <div class="form-group">-->
<!--            <div class="">-->
<!--                --><?//= Html::submitButton('Sign in', ['class' => 'btn btn-primary login-button', 'name' => 'login-button']) ?>
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        --><?php //ActiveForm::end(); ?>
<!--    </div>-->
<!--</div>-->
