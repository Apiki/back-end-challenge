<?php

class API  { 
        
        private $conv;

        function dados () {
            $var = json_decode(file_get_contents('https://api.hgbrasil.com/finance')); //dados atuais para converter as moedas
            self:: $conv->euro = $var->results->currencies->EUR->buy;
            self:: $conv->dollar = $var->results->currencies->USD->buy;
        }

        function conversor ($p) {
            $this -> dados();
            $convertido;

            switch ($p) {

                case 'real': 
                    if (isset($p->dollar)) {
                        $convertido = $p->real * self:: $conv->dollar;
                    } elseif (isset($p->euro)) {
                        $convertido = ("R$ ". $p->real * self:: $conv->euro);
                    } break;

                case 'dollar':
               
                    if (isset($p->real)) {
                        $convertido = ("$". $p->dollar * self:: $conv->real);
                    } break;

                case 'euro':
                    if (isset($p->real)) {
                        $convertido = ("€ ". $p->euro * self:: $conv->real);
                    } break;
                
                default:
                    echo "Conversão não requerida pelo teste. ";
            }
            return $convertido;
        }
}
