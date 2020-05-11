<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use App\Helpers\CurrencyConverter;

class ExchangeController
{
    public function exchange(Request $request, Response $response)
    {
        $conversao = CurrencyConverter::transformValue($request, $response);
        if ($conversao) {
            $response->getBody()->write($conversao);
            $response = $response->withHeader('Content-Type', 'application/json;charset=utf-8');
            return $response;
        }

        return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
    }
}
