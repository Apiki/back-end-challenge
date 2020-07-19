<?php

namespace App\Objects;

class Currency
{

    public $code;
    public $sign;
    public $value;

    function __construct($code, $value)
    {
        $this->code = $code;
        $this->sign = $this->getSignByCode($code);
        $this->value = $value;
    }

    function setCode($code)
    {
        $this->code = $code;
    }
    function getCode()
    {
        return $this->code;
    }

    function setSign($sign)
    {
        $this->sign = $sign;
    }
    function getSign()
    {
        return $this->sign;
    }

    function setValue($value)
    {
        $this->value = $value;
    }
    function getValue()
    {
        return $this->value;
    }

    private static function getSignByCode($code)
    {
        switch ($code){
        case 'BRL':
            return 'R$';
        case 'USD':
            return '$';
        case 'EUR':
            return '€';
        default:
            return '';
        }
    }
}
