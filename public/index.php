<?php

require __DIR__ . '/../getmoney/vendor/autoload.php';
session_start();

// Instantiate the app
$settings = require __DIR__ . '/../getmoney/src/settings.php';
$app = new Slim\App($settings);


// set up Controller
require __DIR__ . '/../getmoney/controller/CoincheckController.php';

// Register routes
require __DIR__ . '/../getmoney/src/routes.php';

// Set up dependencies
require __DIR__ . '/../getmoney/src/dependencies.php';

$app->run();
