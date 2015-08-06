<?php

use yii\helpers\HtmlPurifier;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$data = [ 'messages' => [] ];

foreach ($messages as $message) {
    $data['messages'][] = [
        'author' =>
            $message->getAuthor()->one()->first_name . ' ' . $message->getAuthor()->one()->last_name,
        'author_username' => $message->getAuthor()->one()->username,
        'text' => $message->text,
        'created_at' => $message->created_at,
    ];
}

echo HTMLPurifier::process(json_encode($data));