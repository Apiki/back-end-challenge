<?php

namespace TestApi\service;

use TestApi\dto\CurrencyDTO;
use TestApi\dto\CurrencyResponseDTO;

class CurrencyService{

    public function __construct(
    ) {}
 
    public function currency(CurrencyDTO $data){
        $result = $this->currencyConverter($data);

        return $result;
    }

    private function calculate($amount, $rate):float{
        return $amount * $rate;
    }

    private function currencyConverter(CurrencyDTO $data){
        $list = [
            'BRL' => ['USD', 'EUR'],
            'USD' => ['BRL'],
            'EUR' => ['BRL']
        ];

        if(!isset($list[$data->from]) || !in_array($data->to, $list[$data->from])) {
            throw new \Exception("Impossible to converter");

            /*
            http_response_code(400);
            echo json_encode(['error' => 'Impossible to converter ' . $data->from . ' to ' . $data->to]);
            return;*/
        }

        $calc = $this->calculate($data->amount, $data->rate);

        $symbol = '';
        if ($data->to === 'BRL') {
            $symbol = 'R$';
        } elseif ($data->to === 'USD') {
            $symbol = '$';
        } elseif ($data->to === 'EUR') {
            $symbol = '€';
        }

        error_log($calc);

        $finalResult = CurrencyResponseDTO::create($calc, $symbol);

        return json_encode($finalResult);
    }
}