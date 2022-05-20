<?php

return [
    'tinify' => [
        'token' => env('TINIFY_CLIENT_TOKEN', null),
        'resize-x' => 70,
        'resize-y' => 70,
        'resize-method' => 'fit',
        'extension' => '.jgp',
        'folder' => 'cropped-images'
    ],
    'image' => [
        'min_width' => 75,
        'min_height' => 75
    ]
];
