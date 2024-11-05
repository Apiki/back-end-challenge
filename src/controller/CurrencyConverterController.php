<?php

namespace TestApi\controller;
use TestApi\dto\CurrencyDTO;
use TestApi\service\CurrencyService;

class CurrencyConverterController{

    public static function converter(CurrencyDTO $data){
        $currencyService = new CurrencyService();

        try{
            $result = $currencyService->currency($data);

            http_response_code(200);
            echo $result;

        } catch(\Exception $e){
            http_response_code(400);
            echo json_encode(['error' => 'Impossible to converter ' . $data->from . ' to ' . $data->to]);
            return;
        }
    }
}

