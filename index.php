<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.2
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

require __DIR__ . '/vendor/autoload.php';

    use Source\Exchange;

    $url = explode('/', $_SERVER['REQUEST_URI']);
    array_shift($url);
    $response = [];

    if($url[0] === 'exchange') {

        $exchange = new Exchange;

        if(!$exchange->validaMoeda($url[2], $url[3])) {
            header("HTTP/1.1 400 Bad Request");
            $response = ['status' => "error", "message" => "Por favor, informe uma moeda válida"];
        } elseif($exchange->ValidaValor($url[1]) == false or $exchange->ValidaValor($url[4]) == false) {
            header("HTTP/1.1 400 Bad Request");
            $response = ['status' => "error", "message" => "Valor inválido, tente novamente"];
        } else {
            $moeda = $exchange->simboloMoeda($url[3]);
            $value = $exchange->valorConvertido($url[1], $url[4]);
            header('HTTP/1.1 200 OK');
            $response = ['valorConvertido' => $value, 'simboloMoeda' => $moeda];
        }
    } else {
        header("HTTP/1.1 400 Bad Request");
        $response = ['status' => "error", "message" => "URL inválida"];
    }

    return print_r(json_encode($response, JSON_UNESCAPED_UNICODE));
