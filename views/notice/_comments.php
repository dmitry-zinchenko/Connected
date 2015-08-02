<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="notices-comments">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model_comments, 'text')->textarea(['rows' => 6, 'placeholder' => 'Enter your comment here'])?>

    <?= $form->field($model_comments, 'notice_id')->hiddenInput()->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Send comment'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
