<?php
use app\models\Comments;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$comments = Comments::find()->where(['notice_id'=>$model->id])->count();

$createdAt = DateTime::createFromFormat('Y-m-d H:i:s', $model->create_at);
$stringCreated = $createdAt->format('F j, Y, G:i')

?>

<div class="notice-thumb">
    <div class="notice-header clearfix">
        <div class="actions pull-right">
            <?= Html::a(Yii::t('app', 'Edit'), Url::to(['update','identifier' => \Yii::$app->request->get('identifier'), 'id' => $model->id])); ?>
            <?= Html::a(Yii::t('app', 'Delete'), Url::to(['delete','identifier' => \Yii::$app->request->get('identifier'), 'id' => $model->id])); ?>
        </div>
        <div class="notice-title">
            <?= Html::a(Html::tag('h3', $model->title),Url::to(['view','identifier' => \Yii::$app->request->get('identifier'), 'id' => $model->id])); ?>
        </div>
    </div>
    <div class="notice-body">
        <div class="notice-text"><?= HtmlPurifier::process($model->text) ?></div>
    </div>
    <div class="notice-footer clearfix">
        <div class="pull-left">
            <? if($comments != 1) : ?>
                <span class="notice-comments"><?= Html::encode($comments . ' ') . Yii::t('app', 'comments') ?></span>
            <? else : ?>
                <span class="notice-comments"><?= Html::encode($comments . ' ') . Yii::t('app', 'comment') ?></span>
            <? endif; ?>
        </div>
        <div class="pull-right">
            <span class="author-date"><?= Html::encode($model->author->first_name . ' ' . $model->author->last_name. ' ('. $stringCreated . ')' )  ?></span>
        </div>
    </div>

</div>
