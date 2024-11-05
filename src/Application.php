<?php

namespace TestApi;

use TestApi\controller\CurrencyConverterController;
use TestApi\dto\CurrencyDTO;
use TestApi\router\Router;


class Application{

    public static function start(){
        $router = new Router();

        $router->create('GET', '/exchange/{amount}/{from}/{to}/{rate}', function($amount, $from, $to, $rate) {
            try{
                $dto = CurrencyDTO::create($amount, $from, $to, $rate);

                CurrencyConverterController::converter($dto);
            }catch(\TypeError $ex){
                http_response_code(400);
                echo json_encode([]);
            }
        });
        

        $router->init();
    }
}