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
 * @author   Lucas Dzin Pedroso <lucasdzin@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/converter.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$request_uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$parameters = explode('/',$request_uri);
$request_method = $_SERVER["REQUEST_METHOD"];

if ($request_method != 'GET' || $parameters[1] !== 'exchange' || sizeof($parameters) != 6) {
    header("HTTP/1.1 400 Bad request");
    echo json_encode('');
    exit();
}else{           
    $converter = new Converter();
    if($converter->dataValidation($parameters[2], $parameters[3], $parameters[4], $parameters[5])){
        $response = $converter->getResult($parameters[2], $parameters[5], $parameters[4]);
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }else{
        header("HTTP/1.1 400 Bad request");
        echo json_encode('');
        exit();
    }
}