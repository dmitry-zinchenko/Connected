<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host='.getenv('IP').';dbname=connected',
    'username' => getenv('C9_USER'),
    'password' => '',
    'charset' => 'utf8',
];
