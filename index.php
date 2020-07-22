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
 * @author   Raphael Willisk <rwillisk@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

    use Source\Exchange;

    $url = explode('/', $_SERVER['REQUEST_URI']);
    array_shift($url);
    $response = [];

    if($url[0] === 'exchange' and count($url) === 5) {

        $exchange = new Exchange;

        if($exchange->validaMoeda($url[2], $url[3]) === false) {
            http_response_code(400);
            $response = '';
        } elseif($exchange->ValidaValor($url[1]) === false or $exchange->ValidaValor($url[4]) === false) {
            http_response_code(400);
            $response = '';
        } else {
            $moeda = $exchange->simboloMoeda($url[3]);
            $value = $exchange->valorConvertido($url[1], $url[4]);
            header('HTTP/1.1 200 OK');
            $response = ['valorConvertido' => $value, 'simboloMoeda' => $moeda];
        }
    } else {
        header("HTTP/1.1 400 Bad Request");
        $response = '';
    }

    echo json_encode($response);
