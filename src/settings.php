<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        'telegram' => [
            'name' => 'bnbot',
            'hook_route' => 'https://rocky-bastion-1679.herokuapp.com/webhook.php',
            'api_token' => '244605275:AAG_nevQUgen0EiE2KQhiBfRBIxLGVPSebE',
            'use_hooks' => true
        ]
    ],
];
