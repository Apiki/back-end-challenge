<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\ConversionController;
use Illuminate\Http\Response;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});




$router->get('exchange/{amount}/{from}/{to}/{rate}', function ($amount, $from, $to, $rate) {
    $currency_symbols = [
        'USD' => '$',
        'BRL' => 'R$',
        'EUR' => '€'
    ];

    if (!isset($currency_symbols[$to]) || !isset($currency_symbols[$from])) {
        return response()->json(["error" => "Invalid currency"], 400);
    }

    if (!is_numeric($amount) || !is_numeric($rate) || $rate < 0 || $amount < 0) {
        return response()->json(["error" => "Invalid numeric value"], 400);
    }

    $currency_symbol = $currency_symbols[$to];

    try {
        $converted_amount = $amount * $rate;
    } catch (\Throwable $th) {
        return response()->json(["error" => "Invalid operation"], 400);
    }

    return [
        "valorConvertido" => $converted_amount,
        "simboloMoeda" => $currency_symbol
    ];
});

$router->get('exchange/{path:.*}', function () {
    return response()->json(["error" => "Invalid parameters"], 400);
});

$router->get('exchange', function () {
    return response()->json(["error" => "Invalid parameters"], 400);
});