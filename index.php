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

header('Content-Type: application/json');

require __DIR__ . '/vendor/autoload.php';
 

$url = explode('/', $_SERVER['REQUEST_URI']);

if($url[1] != "exchange"){
    array_shift($url);
}

if ($url[1] === "exchange") {

    ucfirst($url[1]);
    
    $service = 'App\Services\\'.ucfirst($url[1]).'Service';
    array_shift($url);
    if(is_numeric ($url[1])){
        array_shift($url);
        if(sizeof($url) != 4){
            http_response_code(400);
            echo json_encode(array('status' => 'error 5'));  
            exit;
        }
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        try {
            $response = call_user_func(array(new $service, $method), $url);
            http_response_code(200);
            echo json_encode(array('valorConvertido' => $response->getValor(), 'simboloMoeda' => $response->getSimbolo()));
            exit;
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(array('status' => 'error 3', 'data' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
            exit;
        }
    }else{ 
        http_response_code(400);
        echo json_encode(array('status' => 'error 2'));  
        exit;
    }
}else{
    http_response_code(400);
    echo json_encode(array('status' => 'error 1'));  
    exit;
}
