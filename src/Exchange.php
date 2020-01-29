<?php

    class Exchange {

        public function getUrl() {
            if(isset($_GET["url"])) {
                $url = rtrim($_GET['url'], "/");
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = array_filter(explode("/", $url));                

                return $url;
            }
        }

        public function selectCurrency($url) {

            /*
                Real -> Dolar
                Dolar -> Real
                Real -> Euro
                Euro -> Real
            */ 

            $amount = intval($url[0]);
            $from = $url[1];
            $to = $url[2];
            $rate = floatval($url[3]);

            $convertedCurrency = $this->convert($amount, $rate);

            if(gettype($convertedCurrency) == "Array" || isset($convertedCurrency["Error"])) {
                return $convertedCurrency;
            }

            switch($from) {
                case "BRL":
                    if($to == "USD") {
                        $response = array(
                            "valorConvertido" => $convertedCurrency,
                            "simboloMoeda" => "$"
                        );

                        return $response;
                    } 
                    if ($to == "EUR") {
                        $response = array(
                            "valorConvertido" => $convertedCurrency,
                            "simboloMoeda" => "€"
                        );

                        return $response;
                    } 

                    return $this->getException("Por favor, escolha uma das moedas (USD, EUR)");                    
                case "USD":
                    if($to == "BRL") {
                        $response = array(
                            "valorConvertido" => $convertedCurrency,
                            "simboloMoeda" => "R$"
                        );

                        return $response;
                    } 

                    return $this->getException("Por favor, escolha uma das moedas (BRL)");                  
                case "EUR":
                    if($to == "BRL") {
                        $response = array(
                            "valorConvertido" => $convertedCurrency,
                            "simboloMoeda" => "R$"
                        );

                        return $response;
                    } 
                    
                    return $this->getException("Por favor, escolha uma das moedas (BRL)");
                default:
                    return $this->getException("Por favor, escolha uma das moedas (BRL, USD, EUR)"); 
            }
        }

        public function convert(float $amount, float $rate) {
            if($amount <= 0 || $rate <= 0) {
                return $this->getException("Quantia e/ou taxa de câmbio inválida.");
            } else {
                return $amount * $rate;
            }            
        }

        public function getException(string $message):array {
            $exc = array(
                "Error" => $message
            );

            return $exc;
        }
    }