<?php

namespace App\Service;

class ExchangeRateService
{
    public function getRate(string $from, string $to): float
    {
        $url = "https://api.exchangerate.host/convert?from={$from}&to={$to}";

        $response = file_get_contents($url);

        if ($response === false) {
            throw new \Exception('Erro ao consultar API externa');
        }

        $data = json_decode($response, true);

        if (!isset($data['info']['rate'])) {
            throw new \Exception('Resposta inválida da API');
        }

        return (float) $data['info']['rate'];
    }
}