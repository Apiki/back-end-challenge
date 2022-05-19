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
 * @author   Adriano Reis <adrianoreis@outlook.com.br>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/adriano-reis/back-end-challenge
 */
declare(strict_types=1);


require_once "vendor/autoload.php";
header('Content-Type: application/json; charset=utf-8');

use App\Classes\Converter;
use App\Classes\Error;

//Validando URL
if (isset($_GET['url'])) {

    $url = explode("/", $_GET['url']);

    $converter = new Converter;

    if ($converter->validateRequest($url)) {

        $amount = $url[0];
        $from = strtoupper($url[1]);
        $to = strtoupper($url[2]);
        $rate = $url[3];

        //Verificando se as moedas são válidas
        if ($converter->verifyValidCoins($to, $from)) {

            //Realizando o cálculo da conversão
            $convertedValue = $converter->calcConverter($amount, $to, $rate);

            //Exibindo resposta
            echo $converter->getResponse($convertedValue, $converter->getSymbolCoin($to));

            exit;
        }

        Error::getError('0003');
    } else {

        Error::getError('0001');
    }
} else {

    Error::getError('0001');
}
