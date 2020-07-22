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

        public function ValidaValor($v) {
            return !preg_match('/[^0-9.]+/', $v);
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