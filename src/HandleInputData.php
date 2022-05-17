<?php

class HandleInputData
{
    public $inputDataFromUrl;

    function __construct()
    {
        $this->inputDataFromUrl = $_SERVER[REQUEST_URI];
    }

    public function getUrlData()
    {
        $urlAttributes = preg_split("/\//", $this->inputDataFromUrl);
        
        $dataForAnalysis = array(
            'amount' => str_replace(",", ".", $urlAttributes[2]),
            'rate' => str_replace(",", ".", $urlAttributes[5]),
            'coinFrom' => $urlAttributes[3],
            'coinTo' => $urlAttributes[4],
        );

        return $dataForAnalysis;
    }

    public function getCoinSymbol($country)
    {        
        $symbolFrom = array(
            'BRL' => 'R$',
            'USD' => '$',
            'EUR' => '€',
        );

        return $symbolFrom[$country];
    }

    public function formattedConversionData($convertedValue, $country)
    {
        $conversionResult = array(
            'valorConvertido' => $convertedValue,
            'simboloMoeda' => $this->getCoinSymbol($country),
        );

        return json_encode($conversionResult);
    }

}