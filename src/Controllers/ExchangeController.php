<?php

namespace App\Controllers;

class ExchangeController
{
    public function converter(array $data)
    {
        $coins = new \App\Model\Coins;
        $symbol = $coins::getSymbol($data['to']);
        $amount = 0;
        if($symbol == 'R$'){
            $amount = (float) $data['amount'] * (float) $data['rate'];
        }else{
            $amount = (float) $data['amount'] / (float) $data['rate'];
        }
        return ["valorConvertido"=>$amount, "simboloMoeda"=>$symbol];
    }
}