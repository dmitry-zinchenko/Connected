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
    <form id="lang-form" method="post" action="/">
        <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
        <select id="lang-select" name="language">
            <?php foreach($languages as $locale => $params): ?>
                <option value="<?= Html::encode($locale) ?>"></option>
            <?php endforeach; ?>
        </select>
    </form>
    <div class="lang-changer">
        <?= Yii::t('app', 'Change language:') ?>
        <?php foreach($languages as $locale => $params): ?>
            <span><a class="lang <?= Html::encode($params['class']) ?>" href="#<?= Html::encode($locale) ?>"><?= Html::encode($params['name']) ?></a></span>
        <?php endforeach; ?>
    </div>
</div>