<?php
/**
 * Created by PhpStorm.
 * User: Dmitry
 * Date: 28.07.2015
 * Time: 14:53
 */

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>

<header class="register-header"><a class="logo" href="<?= Url::to(['index']) ?>"></a></header>

<div class="wrap">
    <?= $content ?>
</div>

<footer class="register-footer">
        &copy; <?= date('Y') ?> Connected Team
</footer>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
