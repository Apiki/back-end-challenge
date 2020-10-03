<?php

namespace App\Controllers;

class ExchangeController
{
    private $requestMethod;
    private $amount;
    private $from;
    private $to;
    private $rate;

    public function __construct($requestMethod, $amount, $from, $to, $rate)
    {
        $this->requestMethod = $requestMethod;
        $this->amount = $amount;
        $this->from = $from;
        $this->to = $to;
        $this->rate = $rate;
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->currencyConvert();
                break;
            case 'PUT':
            case 'DELETE':
            case 'POST':
                http_response_code(405);
                $response = 'Method not allowed';
                break;
            default:
                http_response_code(405);
                $response = $this->notFoundResponse();
                break;
        }
        return json_encode($response);
    }

    public function currencyConvert()
    {
        http_response_code(400);
        if (!$this->amount || !$this->from || !$this->to || !$this->rate) {
            return "Looks like you forgot one of the params. You need to pass 4 params (amount, from, to and rate)";
        }

        // conversion
        // check is numeric
        if (!is_numeric($this->amount) || !is_numeric($this->rate)) {
            return "Amount and rate need to be numerics";
        }

        // check greather than zero
        if ($this->amount <= 0 || $this->rate <= 0) {
            return "Amount and rate need to be greater than zero";
        }

        // check currency abbreviation
        if (!in_array($this->from, array('BRL', 'USD', 'EUR'))) {
            return 'Currency not found';
        }

        $conversionValue = round($this->amount * $this->rate, 2);
        switch ($this->to) {
            case 'BRL':
                $currencySymbol = 'R$';
                break;

            case 'USD':
                $currencySymbol = '$';
                break;

            case 'EUR':
                $currencySymbol = '€';
                break;

            default:
                return 'Currency not found';
        }

        http_response_code(200);
        return array(
            'valorConvertido' => $conversionValue,
            'simboloMoeda' => $currencySymbol
        );
    }
}