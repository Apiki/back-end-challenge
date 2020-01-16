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

require __DIR__ . '\vendor\autoload.php';
require_once __DIR__ . '\src\converter.php';

$request_uri = $_SERVER["REQUEST_URI"];
$parameters = explode('/',$request_uri);
$request_method = $_SERVER["REQUEST_METHOD"];

switch($request_method) {
        case 'GET':
            switch($parameters[1]) {
                case 'exchange':
                    $converter = new Converter();
                    if(!$converter->dataValidation($parameters[2], $parameters[3], $parameters[4], $parameters[5])){
                        http_response_code(400);
                    }else{
                        $result = array('valorConvertido' => $converter->getConvert($parameters[2], $parameters[5]), 
                                    'simboloMoeda' => $converter->getSymbolCurrency($parameters[4]));
                        header("Content-Type: application/json");
                        echo json_encode($result);
                    }
                default:
                    // Invalid Request Method
                    http_response_code(400);
                    break;
			}
            break;     
		default:
			// Invalid Request Method
			http_response_code(400);
			break;
}