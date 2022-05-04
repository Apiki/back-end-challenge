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
 * @author   Rafael dos Santos Pedro <rafael@codash.com.br>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/rafael-business/apiki-back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

// Importação da classe Exchange
use App\Controller\Exchange;

// Cabeçalhos essenciais da API
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

// Salvando a URL num vetor
$uri = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
$uri = explode( '/', $uri );

// Chamada da classe Exchange
new Exchange( $uri );
