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

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/bootstrap.php';


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace('apiki/', '', $uri); //remover
$uri = explode( '/', $uri );
$moedas = array('BRL','USD','EUR');
if (!isset($uri[2]) or empty($uri[2]) or 
 !isset($uri[3]) or empty($uri[3]) or 
 !isset($uri[4]) or empty($uri[4]) or 
 !isset($uri[5]) or empty($uri[5]) or 
 !is_numeric($uri[2]) or $uri[2]<0 or 
 !in_array($uri[3], $moedas) or !in_array($uri[4], $moedas) or 
 !is_numeric($uri[5]) or $uri[5]<0
) {
    header("HTTP/1.1 400 Bad Request");
    exit( json_encode(array()) );
}

$exchange = new Exchange($uri[2],$uri[3],$uri[4],$uri[5]);
$exchange->doExchange();
exit( $exchange->outputJson() );
