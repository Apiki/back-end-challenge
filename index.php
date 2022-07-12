<?php

/**
 * Back-end Challenge APIKI.
 * Arquivo de respostas - Cassio Sironi 
 */


require __DIR__ . '/vendor/autoload.php';


use App\Http\App;
use App\Http\Request;
use App\Http\Response;

use App\Routes\Router;

use App\Controller\IndexController;

use App\Model\Conversion;

Conversion::load();
Router::get('/exchange/([0-9\.]*)/([A-Z]*)/([A-Z]*)/([0-9\.]*)', function (Request $request, Response $response) {
    $quant = ($request->params[0]);
    $var = ($request->params[3]);
    $origin = Conversion::findById($request->params[1]);
    $dest = Conversion::findById($request->params[2]);
    $value = ($var * $quant);
    $response->status(200)->toJSON([
        'valorConvertido' => $value,
        'simboloMoeda' => $dest->simboloMoeda,
    ]);
});
App::run();
