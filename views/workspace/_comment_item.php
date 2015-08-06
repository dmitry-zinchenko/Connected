<?php
use app\models\Comments;
use yii\helpers\Url;
use yii\helpers\Html;
?>

<div class="comment">
    <div class="UD">
        <?= Html::a('Delete', Url::to(['deletecomment','identifier' => \Yii::$app->request->get('identifier'), 'id_comment' => $model->id])); ?>
    </div>
    <div class="notice-text">
        <?= $model->text; ?>
    </div>
    <div class="author-comment">
        <?= $model->author->first_name . ' ' . $model->author->last_name. ' '. $model->created_at;  ?>
    </div>
    <div class="clear"></div>
</div>
