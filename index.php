<?php

session_start();

require_once("vendor/autoload.php");

// require_once("src/php-functions/functions.php");
// require_once("config/config.php");

$config = [
    'settings' => [
        'displayErrorDetails' => true
    ]
];

use \Slim\Slim;

$app = new \Slim\App($config);

/* ROTAS */
require_once("routes/routes.php");
/* FIM - ROTAS */

$app->run();

?>