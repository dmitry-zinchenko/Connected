<?php

use yii\helpers\HtmlPurifier;

$data = [ 'result' => $result ];

echo HTMLPurifier::process(json_encode($data));