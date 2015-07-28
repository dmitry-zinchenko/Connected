<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Users;
?>
<h1>Register</h1>

<p>
<?php

$form = ActiveForm::begin() ?>
    <?= $form->field($user, 'username') ?>
    <?= $form->field($user, 'email') ?>
    <?= $form->field($user, 'password')->passwordInput() ?>
    <?= $form->field($user, 'repeat_password')->passwordInput() ?>
    <?= $form->field($user, 'first_name') ?>
    <?= $form->field($user, 'last_name') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Register',['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
</p>
