<?php
    declare (strict_types=1);

    namespace Source;

    class Exchange {

        public $simbolos = ["BRL" => "R$", "USD" => "$", "EUR" => "€"];


        /*
         *  valida regra
         */

        public function validaMoeda($from, $to) {
            /*
             * Combinações possíveis
            */
            $combine = [
                "BRL" => ["USD", "EUR"],
                "USD" => ["BRL"],
                "EUR" => ["BRL"],
            ];

            if(empty($from) && empty($to)) {
                $result = false;
            } else {
                $result = !empty($combine[$from]) ? in_array($to, $combine[$from]) ? true : false : false;

            }
            return $result;
        }

        /*
         *  Valida se é número
         */

        public function ValidaValor($valor) {

            $check = false;

            if(preg_match('/^(\d+(\.\d+)?)$/', $valor) > 0 && $valor > 0) {
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