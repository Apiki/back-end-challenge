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
 * @author   João Marcos Neves da Silva
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

use App\Model\Coin;

require __DIR__ . '/vendor/autoload.php';

$uri = preg_replace('/^[A-Za-z0-9-]+$/u', '', $_SERVER['REQUEST_URI']);
if (!$uri) {
    http_response_code(400);
    echo json_encode(array("message" => "Invalid URI.\n"));
    ;
}
$uriExplode = explode('/', $uri);
$coinConvert = ['BRL', 'USD', 'EUR'];
if (count($uriExplode) < 6) {
    http_response_code(400);
    echo json_encode(array("message" => "Invalid URI.\n"));
} else {
    if ($uriExplode[1] === 'exchange') {
        array_unshift($uriExplode);
        $amount =  $uriExplode[2];
        $from = $uriExplode[3];
        $to = $uriExplode[4];
        $rate = $uriExplode[5];
        if (!is_numeric($amount)) {
            http_response_code(400);
            echo json_encode(array("message" => "Invalid URI. Amount not a number.\n"));
        }
        $amount =  doubleval($amount);
        if ($amount < 0) {
            http_response_code(400);
            echo json_encode(array("message" => "Invalid URI. Amount < 0.\n"));
        }
        if (!in_array($from, $coinConvert)) {
            http_response_code(400);
            echo json_encode(array("message" => "Invalid URI. From no defined.\n"));
        }
        if (!in_array($to, $coinConvert)) {
            http_response_code(400);
            echo json_encode(array("message" => "Invalid URI. To no defined.\n"));
        }
        if (!is_numeric($rate)) {
            http_response_code(400);
            echo json_encode(array("message" => "Invalid URI. Rate not a number.\n"));
        }
        $rate =  doubleval($rate);
        if ($rate < 0) {
            http_response_code(400);
            echo json_encode(array("message" => "Invalid URI. Rate < 0.\n"));
        }
        try {
            $response = new Coin($amount, $from, $to, $rate);
            echo $response->conversion();
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(array("message" => $e->getMessage() . '.\n'));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Invalid URI.\n"));
    }
}
