
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Currency extends CI_Controller {
    
    public function exchange($amount, $from, $to, $rate){

        $convertedAmount = $amount * $rate;

        // Define o símbolo  
        $symbol = '';
        switch ($to) {
            case 'USD':
                $symbol = '$';
                break;
            case 'EUR':
                $symbol = '€';
                break;
            case 'BRL':
                $symbol = 'R$';
                break;
            default:
                $symbol = '';
                break;
        }

        $responsePayload = [
            'valorConvertido' => $convertedAmount,
            'simboloMoeda' => $symbol
        ];

        return response()->json($responsePayload);
    }
}
