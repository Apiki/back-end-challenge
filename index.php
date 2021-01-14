<?php

require 'vendor/autoload.php';

use Buki\Router\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$router = new Router;



// For basic GET URI
$router->get('/:all', function() {

    
$originalURI = trim($_SERVER['REQUEST_URI'], '/exchange');

    $converion = explode('/', $originalURI);

    if(count($converion) != 4) {

        echo "Faltam parâmetros!";

    } else {

        $value = $converion[0];
        if($value <= 0) {
            $arr = array("valorAconverter" => "Menor ou igual a 0");
            return json_encode($arr);
            // return http_response_code(400);
        }
        $from = strtoupper($converion[1]);
        $to = strtoupper($converion[2]);
        $rate = $converion[3];

        $resultValue = $value * $rate;

        switch($to) {
            case "BRL":
                $resultSymbol = "R$";
                break;
            case "USD":
                $resultSymbol = "$";
                break;
            case "EUR":
                $resultSymbol = "€";
                break;
        }
        

        $array = array('valorConvertido' => round($resultValue, 2), 'simboloMoeda' => $resultSymbol);
        
        return json_encode($array);
    }

});



$router->run();




