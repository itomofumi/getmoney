<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        'debug' => true,

        // Renderer settings
        'renderer' => [
            //'template_path' => __DIR__ . '/../templates/',
            'blade_template_path' => __DIR__ . '/../templates',
            'blade_cache_path'    => __DIR__ . '/../cache',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        'client' => [
            'base_uri' => 'https://coincheck.com',
        ],
    ],
];
