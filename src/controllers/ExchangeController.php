<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use App\Helpers\ExchangeValidator;
use App\Helpers\CurrencyConverter;

class ExchangeController
{
    public function exchange(Request $request, Response $response)
    {
        $amount = $request->getAttribute('amount');
        $from   = $request->getAttribute('from');
        $to     = $request->getAttribute('to');
        $rate   = $request->getAttribute('rate');

        $validate = ExchangeValidator::validate($amount, $from, $to, $rate);
        if ($validate) {
            $conversao = CurrencyConverter::transformValue($amount, $from, $to, $rate); 
        }

        return $response->withJson($conversao, 200)
            ->withHeader('Content-type', 'application/json');
    }
}
