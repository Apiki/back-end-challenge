<?php
declare(strict_types=1);
// header("Content-type: text/html; charset=utf-8");
header('Content-Type: application/json');
/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Jhone Bering <jhonebering@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

require "./src/Models/Exchange.php";
require "./src/Models/Currency.php";

require __DIR__ . '/vendor/autoload.php';



function response($code, $status, $response) {

    http_response_code($code);
    echo json_encode(array('status' => $status, 'response' => $response));
    exit;
}

function verifyParams($params) {

    if(!$params[1] || !$params[2] || !$params[3] || !$params[4])
        response(400, 'Bad Request', 'Some parameter is missing.');

    if(!is_numeric($params[1]) || !is_string($params[2]) || !is_string($params[3]) || !is_numeric($params[4]))
        response(400, 'Bad Request', 'Some wrong format parameter.');

    if($params[1] <= 0 || $params[4] <= 0)
        response(400, 'Bad Request', 'Invalid parameter value.');
}

if(is_null($_GET['url']))
    response(400, 'Bad Request', 'Params not found.');

$params = explode('/', $_GET['url']);

if (!isset($params[0]) || $params[0] != 'exchange') {
    response(400, 'Bad Request', 'Service not found.');
    exit;
}

verifyParams($params);

$currencyFrom = new Currency($params[2]);
$currencyFrom->setCurrency($params[1]);

$currencyTo = new Currency($params[3]);
$currencyTo->setCurrency($params[4]);

$_exchange = new Exchange();

$response = $_exchange->exchangeValue($currencyFrom->getCurrency(), $currencyTo->getCurrency());

http_response_code(200);
echo json_encode($response);
exit;
