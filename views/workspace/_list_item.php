<?php
use app\models\Comments;
use yii\helpers\Url;
use yii\helpers\Html;
?>

<div class="notice">
    <div class = 'notice-title'>
        <?= Html::a(Html::tag('h3', $model->title),Url::to(['view','identifier'=>\Yii::$app->request->get('identifier')])); ?>
    </div>
    <div class="notice-text">
        <?= $model->text; ?>
    </div>
    <?= Comments::find()->where(['notice_id'=>$model->id])->count() . ' comments'; ?>
    <div class="author-date">
        <?= $model->author->first_name . ' ' . $model->author->last_name. ' '. $model->create_at;  ?>
    </div>
</div>
