<?php

namespace App\Model;

class Coin
{
    protected $to;
    protected $from;
    protected $amount;
    protected $rate;

    /**
     * The function __construct() is a constructor function that takes in four parameters:
     * @param Double $amount The amount of money to convert
     * @param String $from $from The currency you want to convert from
     * @param String $to The currency you want to convert to
     * @param Double $rate $rate The exchange rate from the currency you're converting from to the currency you're
     */
    function __construct($amount, $from, $to, $rate)
    {
        $this->to = $to;
        $this->from = $from;
        $this->amount = $amount;
        $this->rate = $rate;
    }
    /**
     * If the currency to be converted is USD and the currency to be converted to is BRL, then convert
     * the amount to BRL using the rate.
     * 
     * @return The result of the conversion.
     */
    public function conversion()
    {
        if ($this->to === "BRL" && $this->from === "USD") {
            return $this->BRLToUSD($this->amount, $this->rate);
        } elseif ($this->to === "USD" && $this->from === "BRL") {
            return $this->USDToBRL($this->amount, $this->rate);
        } elseif ($this->to === "BRL" && $this->from === "EUR") {
            return $this->BRLToEUR($this->amount, $this->rate);
        } elseif ($this->to === "EUR" && $this->from === "BRL") {
            return $this->EURToBRL($this->amount, $this->rate);
        }
    }

    /**
     * It takes a value in BRL and converts it to USD using the exchange rate
     * 
     * @param Float $amount The amount to be converted.
     * @param Float $rate The exchange rate between the two currencies.
     * 
     * @return A JSON object with the converted value and the currency symbol.
     */
    protected function BRLToUSD($amount, $rate)
    {
        $result = $amount * $rate;
        return json_encode(array('valorConvertido' => number_format($result, 1), 'simboloMoeda' => 'R$'));
    }

    /**
     * It takes an amount and a rate, multiplies them, and returns the result as a JSON object
     * 
     * @param Float $amount The amount to be converted.
     * @param Float $rate The exchange rate between the two currencies.
     * 
     * @return A JSON object with the converted value and the currency symbol.
     */
    protected function USDToBRL($amount, $rate)
    {
        $result = $amount * $rate;
        return json_encode(array('valorConvertido' => number_format($result, 1), 'simboloMoeda' => '$'));
    }

    /**
     * It receives a value in BRL and a rate, then it multiplies the value by the rate and returns the
     * result in EUR
     * 
     * @param Float $amount The amount to be converted.
     * @param Float $rate The exchange rate between the two currencies.
     * 
     * @return a JSON object with two properties: valorConvertido and simboloMoeda.
     */
    protected function BRLToEUR($amount, $rate)
    {
        $result = $amount * $rate;
        return json_encode(array('valorConvertido' => number_format($result, 0), 'simboloMoeda' => 'R$'));
    }

    /**
     * It receives an amount and a rate, multiplies them and returns the result in JSON format
     * 
     * @param Float $amount The amount to be converted.
     * @param Float $rate The exchange rate between the two currencies.
     * convert to.
     * 
     * @return a JSON object with the converted value and the currency symbol.
     */
    protected function EURToBRL($amount, $rate)
    {
        $result = $amount * $rate;
        return json_encode(array('valorConvertido' => number_format($result, 0), 'simboloMoeda' => '€'));
    }
}
