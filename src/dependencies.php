<?php
// DIC configuration

$container = $app->getContainer();

$container['client'] = function ($c) {
    $settings = $c->get('settings')['client'];
    return new \GuzzleHttp\Client($settings);
};

// view renderer
//$container['renderer'] = function ($c) {
//    $settings = $c->get('settings')['renderer'];
//    return new Slim\Views\PhpRenderer($settings['template_path']);
//};

// rubellum/slim-blade-view
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new \Slim\Views\Blade(
        $settings['blade_template_path'],
        $settings['blade_cache_path']
    );
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};
