<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once 'src/helpers/currency_converter.php';
require_once 'src/helpers/currency_symbols.php';

use Currency\Converter;
use CurrencySymbols;

$app = AppFactory::create();

$converter = new Converter();

$app->get(
    '/exchange[/{amount}[/{from}[/{to}[/{rate}]]]]', 
    function (Request $request, Response $response, array $args) use ($converter) {
        $amount = $args['amount'];
        $from = $args['from'];
        $to = $args['to'];
        $rate = $args['rate'];

        if (empty($amount) || empty($from) || empty($to) || empty($rate)) {
            $data = [
                'error' => 'Bad Request',
                'message' => 'All parameters must be provided',
            ];
            $response->getBody()->write(json_encode($data));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        if ($from !== strtoupper($from) || $to !== strtoupper($to)) {
            $errorData = [
                'error' => 'Bad Request',
                'message' => 'Currencies should be uppercase',
            ];
            $response->getBody()->write(json_encode($errorData));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        if (empty($from) || empty($to)) {
            $errorData = [
                'error' => 'Bad Request',
                'message' => 'Missing required parameters'
            ];
    
            $response->getBody()->write(json_encode($errorData));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }
    
        if (!is_numeric($amount) || $amount <= 0) {
            $errorData = [
                'error' => 'Bad Request',
                'message' => 'Invalid amount value'
            ];
    
            $response->getBody()->write(json_encode($errorData));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }
    
        if (!is_numeric($rate) || $rate <= 0) {
            $errorData = [
                'error' => 'Bad Request',
                'message' => 'Invalid rate value'
            ];
    
            $response->getBody()->write(json_encode($errorData));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $convertedAmount = 0;
        $symbol = CurrencySymbols\getCurrencySymbol($to);

        if ($from === 'BRL' && $to === 'USD') {
            $convertedAmount = $converter->fromRealToDollar($amount, $rate);
        } 
    
        if ($from === 'USD' && $to === 'BRL') {
            $convertedAmount = $converter->fromDollarToReal($amount, $rate);
        } 
    
        if ($from === 'BRL' && $to === 'EUR') {
            $convertedAmount = $converter->fromRealToEuro($amount, $rate);
        } 
    
        if ($from === 'EUR' && $to === 'BRL') {
            $convertedAmount = $converter->fromEuroToReal($amount, $rate);
        }

        $data = [
        'valorConvertido' => $convertedAmount,
        'simboloMoeda' => $symbol,
        ];

        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }
);

$app->run();
