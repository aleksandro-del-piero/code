<?php

return [
    'tinify' => [
        'token' => env('TINIFY_CLIENT_TOKEN', null),
        'resize-x' => 70,
        'resize-y' => 70,
        'resize-method' => 'fit',
        'extension' => '.jgp',
        'folder' => 'cropped-images'
    ]
];
