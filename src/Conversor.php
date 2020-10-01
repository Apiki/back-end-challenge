<?php
    class Conversor
    {
        protected $acceptedCurrency = ['BRL' => 'R$', 'USD' => '$', 'EUR' => '€'];
        public $valorConvertido;
        public $simboloMoeda;

        public function convert($valueFrom, $currencyFrom, $currencyTo, $valueTo)
        {
            try {
                $this->checkParamsValidity($valueFrom, $currencyFrom, $currencyTo, $valueTo);

                $this->simboloMoeda = $this->acceptedCurrency[$currencyTo];
                $this->valorConvertido = $this->calculateConversion($valueFrom,$valueTo);
                return true;
            }catch(Exception $e) {
                throw new Exception($e->getMessage());
            }
        }

        public function checkParamsValidity($valueFrom, $currencyFrom, $currencyTo, $valueTo)
        {
            if(!$this->checkCurrency($currencyFrom, $currencyTo)){
                throw new Exception("Currency Not Accepted!");
            }

            if(!$this->checkValues($valueFrom, $valueTo)){
                throw new Exception("Negative Number!");
            }
            
            if($currencyFrom == $currencyTo){
                throw new Exception("Invalid Conversion!");
            }

            if(!$this->checkIsNumeric($valueFrom, $valueTo)){
                throw new Exception("Non numeric values!");
            }
        }

        public function calculateConversion($valueFrom, $valueTo)
        {
            return $valueFrom * $valueTo;
        }

        public function checkIsNumeric($valueFrom, $valueTo)
        {
            if (is_numeric($valueFrom) && is_numeric($valueTo)) {
                return true;
            }else{
                return false;
            }
        }

        public function checkCurrency($currencyFrom, $currencyTo)
        {
            if (array_key_exists($currencyFrom, $this->acceptedCurrency) && array_key_exists($currencyTo,$this->acceptedCurrency)) {
                return true;
            }else{
                return false;
            }
        }

        public function checkValues($valueFrom, $valueTo)
        {
            if ($valueFrom < 0 || $valueTo < 0) {
                return false;
            }else{
                return true;
            }
        }
    }