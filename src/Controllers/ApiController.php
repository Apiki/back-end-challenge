<?php

namespace App\Controllers;

use App\Model\Exchange;

class ApiController
{

    public function processEndpoint( array $params = [] )
    {
        if ($params[1] === 'exchange'){
            $this->exchangeEndpoint($params);
        }
    }

    private function exchangeEndpoint( array $params = [] )
    {
        $exchange = new Exchange($params[2], $params[3], $params[4], $params[5]);

        $response = $exchange->makeConversion();

        echo \GuzzleHttp\json_encode($response);
    }


}