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
    <div class="lang-changer">
        <?= Yii::t('app', 'Change language:') ?>
        <?php foreach($languages as $locale => $params): ?>
            <span><a class="lang <?= Html::encode($params['class']) ?>" href="<?= $queryParams ?><?= Html::encode('language=' . $locale) ?>"><?= Html::encode($params['name']) ?></a></span>
        <?php endforeach; ?>
    </div>
</div>