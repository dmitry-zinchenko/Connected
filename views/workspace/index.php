<?php
/* @var $this yii\web\View */

?>
<h1>workspace/index</h1>

<p>
    <?php
//    $this->registerJsFile();
    $this->registerJs("$.ajax({url:'$notice_index'}).success(function(data) {
        $( \"#noticelist\" ).html( data );
    })")?>
    <div id="noticelist">

    </div>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>
