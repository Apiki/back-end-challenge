<?php

namespace App\Controllers;

use App\Models\Api;

class ApiController
{
    /**
     * Exige que seja passado os parâmetros dos Endpoints
     * @param $amount
     * @param $from
     * @param $to
     * @param $range
     */
    public static function get($amount, $from, $to, $range)
    {
        $params = [
            'amount' => $amount,
            'from'   => $from,
            'to'     => $to,
            'range'  => $range
        ];

        echo Api::convert($params);
    }

}