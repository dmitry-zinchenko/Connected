<?php

use yii\helpers\HtmlPurifier;

echo HTMLPurifier::process(json_encode($result));