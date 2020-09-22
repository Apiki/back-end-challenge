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

use App\Apiki\conversodemoedas\Dominio\Taxa\TaxadeConversao;
use App\Apiki\conversodemoedas\Infra\API\ApiMoeda;
use App\Apiki\conversodemoedas\Dominio\Taxa\simboloMoeda;
use App\Apiki\conversodemoedas\Infra\ConvertJson\json;
use App\Apiki\conversodemoedas\Dominio\Moeda\ValidarMoeda;

require __DIR__ . '/vendor/autoload.php';

$url = $_SERVER['REQUEST_URI'];
$dados = explode("/", $url);


/*
$inputMoedaentrada = $dados[2];
$inputSimboloEntrada = $dados[3];
$inputMoedasaida = $dados[5];
$inputSimbolosaida = $dados[4];
*/

if (ValidarMoeda::validaTodosParametros($dados) == false) {
    //echo  'Formado de Moeda ou simboloInvalido';
    header("HTTP/1.1 " . 400);
    $json_response = json_encode("Formado de Moeda ou simboloInvalido", JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo $json_response;
    return $json_response;
}

if (simboloMoeda::retornasimboloentrada($dados[3]) == false) {
    header("HTTP/1.1 " . 400);
    $json_response = json_encode("Formado de Moeda Invalido", JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo $json_response;
    return $json_response;
}
if (SimboloMoeda::retornasimbolosaida($dados[4]) == false) {
    header("HTTP/1.1 " . 400);
    $json_response = json_encode("Formado de Moeda Invalido", JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo $json_response;
    return $json_response;
}

if (simboloMoeda::getvalormoedasaida($dados[5]) == false) {

    header("HTTP/1.1 " . 400);
    $json_response = json_encode("Formado de Moeda saida  Invalido", JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo $json_response;
    return $json_response;
}

if (!simboloMoeda::getvalormoedaentrada($dados[2])) {

    header("HTTP/1.1 " . 400);
    $json_response = json_encode("Formado de Moeda saida  Invalido", JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo $json_response;
    return $json_response;
}




$api = new ApiMoeda((float)$dados[2], $dados[3], (float)$dados[5], $dados[4]);
$moedaentrada = $api->retonaMoedaEntrada();
$simboloentrada = $api->retornaSimboloEntrada();
$moedasaida = $api->retonaMoedaSaida();
$simbolosaida = $api->retornaSimboSaida();;



$moedacalculada = TaxadeConversao::calculaConversao($moedaentrada, $moedasaida);



header("HTTP/1.1 " . 200);


$json_response = json::retornarjson($moedacalculada, $simbolosaida);
echo $json_response;

return  $json_response;
