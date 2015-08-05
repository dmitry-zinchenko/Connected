<?php
/* @var $this yii\web\View */

Yii::$app->view->params['group'] = $group;
Yii::$app->view->params['members'] = $group->getMembersWithOwner();
?>
<h1>workspace/index</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>
