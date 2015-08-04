<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Users;

$this->title = Yii::t('app', 'Account settings');
?>

<section class="block-dash">
    <h1><?= Yii::t('app', 'Account settings') ?></h1>
    <div class="form-dash">
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

        <div class="form-dash-button">
            <?= Html::submitButton(Yii::t('app', 'Save profile'), ['class' => 'btn btn-primary login-button', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</section>

<section class="block-dash">
    <h1><?= Yii::t('app', 'Change password') ?></h1>
    <div class="form-dash">
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

        <div class="form-dash-button">
            <?= Html::submitButton(Yii::t('app', 'Save password'), ['class' => 'btn btn-primary login-button', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</section>
