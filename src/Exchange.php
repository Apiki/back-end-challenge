<?php
namespace App;

class Exchange {

    public function checkName($name)
    {
        $names = array("BRL", "USD", "EUR");

        if (!in_array($name, $names)) {
            return false;
        }

        return true;
    }

    public function checkVal($value)
    {
        if (!is_numeric($value)) {
            return false;
        }

        if ($value < 0) {
            return false;
        }

        return true;
    }

    public function getSymbol($index)
    {
        $symbol = array('BRL' => 'R$', 'USD' => '$', 'EUR' => '€');

        return $symbol[$index];
    }

    public function getExchange($firstVal, $secondVal)
    {
        return $firstVal * $secondVal;
    }
}