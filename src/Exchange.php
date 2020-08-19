<?php

namespace App;

class Exchange extends Base
{
    private $coins = ["BRL", "USD", "EUR"];

    public function __construct()
    {
        parent::__construct();
    }

    public function convert($amount, $from, $to, $rate): void
    {
        if(in_array($from, $this->coins) && in_array($to, $this->coins) && $this->checkValue($amount) && $this->checkValue($rate)){
            $response = [
                'valorConvertido' => $this->calculateExchange($amount, $rate), 'simboloMoeda' => $this->backSymbol($to)
            ];
            $this->back($response);
        }else{
            $this->call(
                400,
                "not_found",
                "Valor incorreto"
            )->back();
            return;
        }
    }

    public function backSymbol($to)
    {
        switch ($to){
            case "BRL":
                return "R$";
            case "USD":
                return "$";
            case "EUR":
                return "€";
        }
    }

    public function checkValue($value)
    {
        if(preg_match('/^(\d+(\.\d+)?)$/', $value) > 0 && $value > 0) {
            return true;
        }
        return false;
    }

    public function calculateExchange($amount, $rate)
    {
        return ($amount * $rate);
    }

}