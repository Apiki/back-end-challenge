<?php

/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

/** 
 * Classe CurrencyConverter
 */

class CurrencyConverter
{
    private $amount;
    private $from;
    private $to;
    private $rate;

    public function __construct($amount, $from, $to, $rate)
    {
        $this->amount = $amount;
        $this->from = $from;
        $this->to = $to;
        $this->rate = $rate;
    }

    public function convert()
    {
        $conversion = $this->amount * $this->rate;
        $symbol = '';

        switch ($this->from . '-' . $this->to) {
        case 'BRL-USD':
            $symbol = '$';
            break;
        case 'USD-BRL':
            $symbol = 'R$';
            break;
        case 'BRL-EUR':
            $symbol = '€';
            break;
        case 'EUR-BRL':
            $symbol = 'R$';
            break;
        default:
            $symbol = '';
            break;
        }


        $response = [
            'valorConvertido' => $conversion,
            'simboloMoeda' => $symbol
        ];

        return $response;
    }
}

$requestUri = $_SERVER['REQUEST_URI'];
$endpoint = '/exchange/';

// Verifica se a requisição está no endpoint /exchange/
if (strpos($requestUri, $endpoint) === 0) {
    $requestUri = substr($requestUri, strlen($endpoint));
    $requestParts = explode('/', $requestUri);

    // Verifica se há as informações necessárias na URL
    if (count($requestParts) === 4) {
        $amount = $requestParts[0];
        $from = $requestParts[1];
        $to = $requestParts[2];
        $rate = $requestParts[3];


        // Verifica se o valor é numérico
        if (!is_numeric($amount) || !is_numeric($rate)) {
            // Retorna um erro 400 - Bad Request caso os valores não sejam numéricos
            http_response_code(400);
            echo json_encode(['error' => 'Invalid amount or rate']);
            exit;
        }

        // Verifica se o valor é positivo
        if ($amount <= 0 || $rate <= 0) {
            http_response_code(400);
            echo json_encode(['error' => 'Amount and rate must be positive']);
            exit;
        }

        // Verifica se as moedas são strings
        $validCurrencies = ["USD", "EUR", "BRL"];
        if (!is_string($from) || !is_string($to) 
            || empty($from) || empty($to) 
            || !in_array($from, $validCurrencies) || !in_array($to, $validCurrencies)
        ) {
            // Retorna um erro 400 - Bad Request caso as moedas sejam inválidas
            http_response_code(400);
            echo json_encode(['error' => 'Invalid from or to currency']);
            exit;
        }





        // Cria uma instância do conversor de moedas
        $converter = new CurrencyConverter($amount, $from, $to, $rate);

        // Realiza a conversão de moedas
        $result = $converter->convert();

        // Define o cabeçalho da resposta como JSON
        header('Content-Type: application/json');

        // Retorna a resposta em JSON
        echo json_encode($result);
    } else {
        // Retorna um erro 400 - Bad Request caso as informações sejam inválidas
        http_response_code(400);
        echo json_encode(['error' => 'Invalid request']);
    }
} else {
    // Retorna um erro 404 - Not Found caso a URL não seja válida
    http_response_code(404);
    echo json_encode(['error' => 'Not found']);
}
