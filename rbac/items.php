<?php
return [
    'createGroup' => [
        'type' => 2,
        'description' => 'Create a group',
    ],
    'chat' => [
        'type' => 2,
        'description' => 'Leave a message in chat',
    ],
    'leaveComment' => [
        'type' => 2,
        'description' => 'Leave a comment',
    ],
    'createPost' => [
        'type' => 2,
        'description' => 'Create a post',
    ],
    'updatePost' => [
        'type' => 2,
        'description' => 'Update a post',
    ],
    'deletePost' => [
        'type' => 2,
        'description' => 'Drop User',
    ],
    'dropUser' => [
        'type' => 2,
    ],
    'user' => [
        'type' => 1,
        'children' => [
            'createGroup',
            'chat',
            'leaveComment',
        ],
    ],
    'author' => [
        'type' => 1,
        'children' => [
            'createPost',
            'updatePost',
            'user',
        ],
    ],
    'owner' => [
        'type' => 1,
        'children' => [
            'deletePost',
            'author',
            'dropUser',
        ],
    ],
];
