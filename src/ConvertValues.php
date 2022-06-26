<?php

namespace App;

class ConvertValues
{

    private float $_amount;
    private string $_from;
    private  string $_to;
    private float $_rate;

    public function __construct(float  $amount,
        string  $from, string  $to,  float  $rate
    ) {
        $this->_from = $from;
        $this->_to = $to;
        $this->_amount = $amount;
        $this->_rate = $rate;
    }

    /**
     * Return currency multiplication value
     *
     * @return float
     */
    public function getRate(): float
    {
        return $this->_rate;
    }

    /**
     * Return if the params are valid
     *
     * @return string
     */
    public  function currencyValidation(): string
    {
        if(!($this->_from === "BRL" || $this->_from === "USD"
            || $this->_from === "EUR")
        ) {
            return "Parâmetro 'from' inválido";
        };
        if(!($this->_to === "BRL" || $this->_to === "USD"
            || $this->_to === "EUR")
        ) {
            return "Parâmetro 'to' inválido";
        };
        if(! ($this->_amount > 0) ) {
            return "Parâmetro 'amount'  inválido";
        };
        if(! ($this->_rate > 0)) {
            return "Parâmetro 'rate' inválido";
        };
        return "Parâmetro válido";
    }

    /**
     * Return the converted value
     *
     * @return float|int
     */
    public function getConvertedValue()
    {
        return $this->_amount *  $this->_rate;
    }


    /**
     * Return 'from' param currency symbol
     *
     * @return string
     */
    public function getCurrencyIcon(): string
    {
        $symbols = array(
            "BRL" => "R$",
            "USD" => "$",
            "EUR" => "€"
        );
        return $symbols[$this->_to];
    }

}
