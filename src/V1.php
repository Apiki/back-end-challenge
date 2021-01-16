<?php

include_once __DIR__.'/../../back-end-challenge/index.php';



class V1
{
    public static function exchange(string $v1, string $v2, string $v3, string $v4)
    {
        if (!empty($v1)){

            $amount = $v1;
            $from = mb_strtoupper($v2);
            $to = mb_strtoupper($v3);
            $rate = $v4;

            if ($from == 'BRL' && $to == 'USD'){
                $result = doubleval($amount) * doubleval($rate);
                $simbol = '$';
                $return = [
                    "ValorConvertido" => $result,
                    "simboloMoeda" => $simbol
                ];
                return $return;
            }else if ($from == 'USD' && $to == 'BRL'){
                $result = $amount * $rate;
                $simbol = 'R$';
                $return = [
                    "ValorConvertido" => $result,
                    "simboloMoeda" => $simbol
                ];
                return $return;
            }else if($from == 'BRL' && $to == 'EUR'){
                $result = $amount * $rate;
                $simbol = '€';
                $return = [
                    "ValorConvertido" => $result,
                    "simboloMoeda" => $simbol
                ];
                return $return;
            }else{
                $result = $amount * $rate;
                $simbol = 'R$';
                $return = [
                    "ValorConvertido" => $result,
                    "simboloMoeda" => $simbol
                ];
                return $return;
            }
        }else{
            throw new Exception("EndPoint não encontrado");
        }
    }
}