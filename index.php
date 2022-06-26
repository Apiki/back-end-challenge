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

use App\Router;
use App\ConvertValues;
header('Content-Type: application/json');
$router = new Router;
$url = $router->getExchangeEndpoint();

if($url && sizeof($url) === 5){
    try{

        $convertValue = new ConvertValues((float)$url[1], $url[2], $url[3], (float)$url[4]);

        if ($convertValue->currencyValidation() !== "Parâmetro válido")
            throw new Exception($convertValue->currencyValidation());

        $convertedValue = $convertValue->getConvertedValue();
        $convertedValueIcon = $convertValue->getCurrencyIcon();

        $response = array("valorConvertido" => $convertedValue, "simboloMoeda" => $convertedValueIcon);
        http_response_code(200);
        echo  json_encode($response);

    }catch (Exception $exception) {
        http_response_code(400);
        echo json_encode('');
    }
}else{
    http_response_code(400);
    echo json_encode('');
}

