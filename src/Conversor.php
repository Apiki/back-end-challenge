<?php
    class Conversor
    {
        protected $acceptedCurrency = ['BRL' => 'R$', 'USD' => '$', 'EUR' => '€'];
        protected $valorConvertido;
        protected $simboloMoeda;

        public function __construct()
        {

        }

        public function convert($valueFrom, $currencyFrom, $currencyTo, $valueTo)
        {
            $currencyFrom = strtoupper($currencyFrom);
            $currencyTo = strtoupper($currencyTo);

            if(!$this->checkCurrency($currencyFrom, $currencyTo)){
                http_response_code(400);
                return json_encode(["message" => "Currency Not Accepted!"]);
            }
            
            if($currencyFrom == $currencyTo){
                http_response_code(400);
                
                return json_encode(["message" => "Invalid Conversion!"]);
            }

            $this->simboloMoeda = $this->acceptedCurrency[$currencyTo];
            $this->valorConvertido = $this->calculateConversion($valueFrom,$valueTo);

            http_response_code(200);
            return json_encode(["valorConvertido" => $this->valorConvertido, "simboloMoeda" => $this->simboloMoeda]);
        }

        public function calculateConversion($valueFrom, $valueTo)
        {
            return $valueFrom * $valueTo;
        }

        public function checkCurrency($currencyFrom, $currencyTo)
        {
            if (array_key_exists($currencyFrom, $this->acceptedCurrency) && array_key_exists($currencyTo,$this->acceptedCurrency)) {
                return true;
            }else{
                return false;
            }
        }
    }