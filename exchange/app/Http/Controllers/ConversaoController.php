<?php

namespace App\Http\Controllers;

use Hamcrest\Type\IsInteger;
use Illuminate\Http\Request;

class ConversaoController extends Controller
{
    public function index($amount,$from,$to,$rate){
        if((isset($amount) && isset($from) && isset($to) && isset($rate)) && ((intval($amount) > 0) && is_string($from) && is_string($to) && (floatval($rate) > 0)) && ($amount > 0 && $rate > 0) && $from != $to){
            if(strtoupper($to) == "BRL"){
                $valorConvertido = $amount * $rate;
            }
            else{
                $valorConvertido = $amount / $rate;
                $valorConvertido = number_format($valorConvertido,2,',','.');
            }
            switch (strtoupper($to)) {
                case "BRL":
                    $simboloMoeda = "R$";
                    break;
                case "EUR":
                    $simboloMoeda = "€";
                    break;
                case "USD":
                    $simboloMoeda = "$";
                    break;
            }
            $data = [
                'valorConvertido' => $valorConvertido,
                'simboloMoeda' => $simboloMoeda,
            ];

            $json_data = json_encode($data);
            dd($json_data);
        }
        else{
            print("ERRO 400: Não foi possível processar a sua requisição.");
        }
    }
}
