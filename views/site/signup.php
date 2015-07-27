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
    <?= $form->field($user, 'password') ?>
    <?= $form->field($user, 'first_name') ?>
    <?= $form->field($user, 'last_name') ?>
    <?= $form->field($user, 'email') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Register',['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
</p>
