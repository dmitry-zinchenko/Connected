<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\Helpers\Url;
?>
<h1>Group Settings</h1>

<div class="site-login">
    <div class="login-form-back">
        <h1><?= Yii::t('app', 'Group Settings') ?></h1>
        <?php $form1 = ActiveForm::begin([
            'id' => 'changeGroup-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'labelOptions' => ['class' => 'control-label'],
            ],
        ]); ?>

        <?= $form1->field($model, 'identifier')->textInput(['value' => $model->getGroup()->identifier, 'disabled' => 'disabled']) ?>
        <?= $form1->field($model, 'name')->textInput(['value' => $model->getGroup()->name]) ?>
        <?= $form1->field($model, 'description')->textInput(['value' => $model->getGroup()->description]) ?>
        <div class="form-group sign-block">
            <?= Html::submitButton(Yii::t('app', 'Apply'), ['class' => 'btn btn-primary login-button', 'name' => 'login-button']) ?>
        </div>

        <?= Html::a($disable, Url::toRoute( ['dashboard/disable','identifier'=>$identifier]),['class' => 'btn btn-primary login-button', 'name' => 'login-button']) ?>
        <?= Html::a("Delete", Url::toRoute( ['dashboard/delete','identifier'=>$identifier]),['class' => 'btn btn-primary login-button', 'name' => 'login-button']) ?>

        </div>

    </div>
</div>