<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Create group');
?>

<section class="block-dash">
    <h1><?= Yii::t('app', 'Create new group') ?></h1>
    <div class="form-dash">
        <?php $form = ActiveForm::begin([
            'id' => 'createGroup-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'labelOptions' => ['class' => 'control-label'],
            ],
        ]); ?>

        <?= $form->field($model, 'identifier')->textInput(['placeholder' => Yii::t('app', 'This will be used for your group subdomain')]) ?>
        <?= $form->field($model, 'name')->textInput(['placeholder' => Yii::t('app', 'This everyone will see as your group name')]) ?>
        <?= $form->field($model, 'description')->textInput(['placeholder' => Yii::t('app', 'Make a short description of your group (not required)')]) ?>

        <div class="form-dash-button">
            <?= Html::submitButton(Yii::t('app', 'Create group'), ['class' => 'btn btn-primary login-button', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</section>
