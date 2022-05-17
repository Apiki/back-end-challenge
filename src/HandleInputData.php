<?php

class HandleInputData
{
    public $inputDataFromUrl;

    function __construct()
    {
        $this->inputDataFromUrl = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    public function getUrlData()
    {
        $urlAttributes = $this->getUrlAttributes();
        $dataForAnalysis = [];

        if($urlAttributes){
            
            $dataForAnalysis = [
                'amount' => str_replace(",", ".", $urlAttributes[2]),
                'rate' => str_replace(",", ".", $urlAttributes[5]),
                'coinFrom' => $urlAttributes[3],
                'coinTo' => $urlAttributes[4],
            ];
        }
        return $dataForAnalysis;
    }

    public function getCoinSymbol($country)
    {        
        $symbolFrom = array(
            'BRL' => 'R$',
            'USD' => '$',
            'EUR' => '&#8364',
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

    public function getUrlAttributes()
    {
        return preg_split("/\//", $this->inputDataFromUrl);
    } 


}