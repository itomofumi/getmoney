<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
require_once __DIR__ . '/../lib/csvload/csvloadper30.php';

$app->any('/cc/index/{name}' , CoincheckController::class . ':index');
$app->any('/cc/phpinfo' , CoincheckController::class . ':phpinfo');
$app->any('/cc/getprice' , CoincheckController::class . ':getPrice');

$app->get('/cc/open', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    $args = ['name' => 'hoge'];
    // Render index view
    return $this->renderer->render($response, 'sample', $args);
});

$app->get('/cc/close' , CoincheckController::class . ':close');
