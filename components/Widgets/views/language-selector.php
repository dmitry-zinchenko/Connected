<?php
/**
 * Created by PhpStorm.
 * User: Dmitry
 * Date: 30.07.2015
 * Time: 15:34
 */
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="language-selector">

    <?= $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'attribute')
        ->dropDownList(
            $items,           // Flat array ('id'=>'label')
            ['prompt'=>'']    // options
            ); ?>

    <?= ActiveForm::end(); ?>

</div>