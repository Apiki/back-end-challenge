<?php

    namespace Source;

    class Exchange {

        public $simbolos = array("BRL" => "R$", "USD" => "$", "EUR" => "€");

        /*
         *  valida regra
         */

        public function validaMoeda($from, $to) {
            /*
             * possiveis combinações
            */
            $combine = [
                "BRL" => array("USD", "EUR"),
                "USD" => array("BRL"),
                "EUR" => array("BRL")
            ];

            return isset($from) && in_array($to, $combine[$from]);
        }

        /*
         *  Valida se é número
         */

        public function ValidaValor($valor) {

            $check = false;

            if(!is_numeric($valor)){
                $check = true;
            }

            if($valor > 0){
                $check = true;
            }

            return $check;
        }

        /*
         *  Retorna o simbolo
         */
        public function simboloMoeda($c) {
            return $this->simbolos[$c];
        }

        /*
         *  Retorna conversão
         */
        public function valorConvertido($amount, $cambio) {
            return $amount * $cambio;
        }
    }