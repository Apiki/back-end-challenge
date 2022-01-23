<?php

namespace App\Models;

use App\Classes\RealCoin;
use App\Classes\DolarCoin;
use App\Classes\EuroCoin;
use App\Classes\Response;

class Api
{
    /**
     * Método principal para converter os valores da API
     * @param $params
     * @return mixed|string
     */
    public static function convert($params)
    {
        $from   = strtoupper($params['from']);
        $amount = $params['amount'];
        $range  = $params['range'];

        $convert_value = (float)$amount * (float)$range;

        switch ($from):
            case 'BRL':
                $symbol = RealCoin::getCoinSymbol();
                break;
            case 'USD':
                $symbol = DolarCoin::getCoinSymbol();
                break;
            case 'EUR':
                $symbol = EuroCoin::getCoinSymbol();
                break;
            default:
                $symbol = null;
        endswitch;

        return Response::catch([
            'valorConvertido' => $convert_value,
            'simboloMoeda' => $symbol
        ], 200);
    }

}