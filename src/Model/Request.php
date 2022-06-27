<?php

namespace Challenge\Source\Model;

require_once __DIR__ . '/BrlCurrency.php';
require_once __DIR__ . '/UsdCurrency.php';
require_once __DIR__ . '/EurCurrency.php';
use Challenge\Source\Model\BrlCurrency;
use Challenge\Source\Model\UsdCurrency;
use Challenge\Source\Model\EurCurrency;

class Request
{
    public function handleRequest() 
    {
        $this->request = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));

        if (count($this->request) == 5) { 
            
            foreach ($this->request as $key => $argument) {
                switch ($key) {
                case 0:
                    if ($argument !== 'exchange') {
                        return false;
                    }
                    break;
                case 1:
                    if (is_numeric($argument) && $argument > 0) {
                        $amount = $argument;
                    } else {
                        return false;
                    }
                    break;
                case 2:
                    $fromCurrency = $this->verifyCurrency($argument);

                    if (!$fromCurrency) {
                        return false;
                    }
                    break;
                case 3:
                    $toCurrency = $this->verifyCurrency($argument);

                    if (!$toCurrency) {
                        return false;
                    }
                    break;
                case 4:
                    if (is_numeric($argument) && $argument > 0) {
                        $rate = $argument;
                    } else {
                        return false;
                    }
                    break;
                }

            }
            return $fromCurrency->convert($toCurrency, $rate, $amount);
        }
        return false;
    }

    private function verifyCurrency($currency)
    {
        switch($currency) {
        case 'BRL':
            return new BrlCurrency();
        case 'USD':
            return new UsdCurrency();
        case 'EUR':
            return new EurCurrency();
            return false;    
        }
    }
}
