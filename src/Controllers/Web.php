<?php

namespace Srp\Controllers;


class Web {
    
    public function convert($date){

        $amount = floatval($date['amount']);
        $from = $date['from'];
        $to = $date['to'];
        $rate = floatval($date['rate']);

        if($from == 'BRL' && $to == 'USD'){
            
            $result = $amount / $rate;
            
            $returnJson['valorConvertido'] = number_format($result, 2, '.', '');
            $returnJson['simboloMoeda'] = '$';
            echo json_encode($returnJson);
        }

        if($from == 'USD' && $to == 'BRL'){
            $result = $amount * $rate;
            
            $returnJson['valorConvertido'] = number_format($result, 2, '.', '');
            $returnJson['simboloMoeda'] = 'R$';
            echo json_encode($returnJson);
        }

        if($from == 'BRL' && $to == 'EURO'){
            $result = $amount / $rate;
            
            $returnJson['valorConvertido'] = number_format($result, 2, '.', '');
            $returnJson['simboloMoeda'] = '€';
            echo json_encode($returnJson);
        }

        if($from == 'EURO' && $to == 'BRL'){
            $result = $amount * $rate;
            
            $returnJson['valorConvertido'] = number_format($result, 2, '.', '');
            $returnJson['simboloMoeda'] = 'R$';
            echo json_encode($returnJson);
        }
        

    }


    public function error($data){
        echo "<h1>Erro {$data["errcode"]}</h1>";

        var_dump($data);
    }
}