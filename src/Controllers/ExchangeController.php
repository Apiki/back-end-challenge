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
            //var_dump((float) str_replace(',', '.',$data['rate']));exit;
            $amount = (float) str_replace(',', '.',$data['amount']) * (float) str_replace(',', '.', $data['rate']);
        }else{
            $amount = (float) str_replace(',', '.', $data['amount']) / (float) str_replace(',', '.', $data['rate']);
        }
        return ["valorConvertido"=>$amount, "simboloMoeda"=>$symbol];
    }
}