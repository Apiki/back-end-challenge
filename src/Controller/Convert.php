<?php

namespace App\Controller;

use App\Service\ConvertService;

class Convert
{
    protected string|array|false $headers;
    protected ConvertService $service;

    public function __construct()
    {
        $this->service = new ConvertService();
    }

    public function conversion($amount, $from, $to, $rate): void
    {
        $data = [
          'amount' => $amount,
          'from' => $from,
          'to' => $to,
          'rate' => $rate
        ];

        $this->service->convertService($data);
    }
}
