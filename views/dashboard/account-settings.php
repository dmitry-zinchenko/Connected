<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Users;
?>

<div class="site-login">
    <div class="login-form-back">
        <h1><?= Yii::t('app', 'Account settings') ?></h1>
        <?php $form1 = ActiveForm::begin([
            'id' => 'accountSettings-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'labelOptions' => ['class' => 'control-label'],
            ],
        ]); ?>

        <?= $form1->field($modelAccount, 'username')->textInput(['value' => $modelAccount->getUser()['username'], 'disabled' => 'disabled']) ?>

        <?= $form1->field($modelAccount, 'email')->textInput(['value' => $modelAccount->getUser()['email'], 'disabled' => 'disabled']) ?>

        <?= $form1->field($modelAccount, 'first_name')->textInput(['value' => $modelAccount->getUser()['first_name']]) ?>

        <?= $form1->field($modelAccount, 'last_name')->textInput(['value' => $modelAccount->getUser()['last_name']]) ?>

        <div class="form-group sign-block">
            <?= Html::submitButton(Yii::t('app', 'Apply'), ['class' => 'btn btn-primary login-button', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <br><h1><?= Yii::t('app', 'Change password') ?></h1>
        <?php $form2 = ActiveForm::begin([
            'id' => 'changePassword-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'labelOptions' => ['class' => 'control-label'],
            ],
        ]); ?>

        <?= $form2->field($modelPassword, 'old_password')->passwordInput() ?>

        <?= $form2->field($modelPassword, 'new_password')->passwordInput() ?>

        <?= $form2->field($modelPassword, 'repeat_password')->passwordInput() ?>

        <div class="form-group sign-block">
            <?= Html::submitButton(Yii::t('app', 'Apply'), ['class' => 'btn btn-primary login-button', 'name' => 'login-button']) ?>
        </div><br>

        <?php ActiveForm::end(); ?>
    </div>
</div>
