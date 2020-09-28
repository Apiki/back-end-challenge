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
 * @author   Paulo Correia <correia.tec@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';


use Apiki\Http;

$http = new Http;
$url = $http->Url();

use Apiki\Check_Url;

$check = new Check_Url;
$path = $check->Path($url);
$valued = $check->_valued;
$amount = $check->_amount;
$rate = $check->_rate;
$symbol = $check->_symbol;

use Apiki\Exchange;

$exchange = new Exchange;
$value = $exchange->Convert($valued,$amount,$rate);
$return = [ 'valorConvertido' => $value, 'simboloMoeda' => $symbol];
header('Content-Type: application/json');

use Apiki\Json;

$json = new Json('ENC', $return, 1, 1);
echo $json->decode_encode();
