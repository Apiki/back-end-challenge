<?php
namespace App\Classes;

class Conversao{

    public function realToDolar($real, $dolar)
    {
        $retorno = [];
        $num_format=(1 / floatval($dolar)) * floatval($real);
        $conversao = number_format($num_format, 2, ',', '.');
        $retorno["valorCovertido"] = $conversao;
        $retorno["simboloMoeda"] = "US$";
    
        return json_encode($retorno);
    }

    public function dolarToReal($dolar, $real)
    {
        $retorno = [];
        $num_format=(floatval($dolar) * floatval($real));
        $conversao = number_format($num_format, 2, ',', '.');
        $retorno["valorCovertido"] = $conversao;
        $retorno["simboloMoeda"] = "$";
    
        return json_encode($retorno);
    }

    public function realToEuro($real, $dolar)
    {
        $retorno = [];
        $num_format=($real*$dolar);
        $conversao = number_format($num_format, 2, ',', '.');
        $retorno["valorCovertido"] = $conversao;
        $retorno["simboloMoeda"] = "&euro;";
    
        return json_encode($retorno);
    }

    public function euroToReal($real, $dolar)
    {
        $retorno = [];
        $num_format=($real*$dolar);
        $conversao = number_format($num_format, 2, ',', '.');
        $retorno["valorCovertido"] = $conversao;
        $retorno["simboloMoeda"] = "$";
    
        return json_encode($retorno);
    }

    public function tipo($from, $to)
    {
        
        
        if($from == "BRL" && $to == "USD"){
            $retorno = 1;
        }elseif($from == "USD" && $to == "BRL"){
            $retorno = 2;
        }elseif($from == "BRL" && $to == "EURO"){
            $retorno = 3;
        }elseif($from == "EURO" && $to == "BRL"){
            $retorno = 4;
        }else {
            $retorno = 0;
        }
        
        return $retorno;
    }


}
