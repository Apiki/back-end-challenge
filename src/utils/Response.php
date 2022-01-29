<?php

namespace App\utils;

use App\models\CoinModel;

class Response
{
    /**
     * Renderiza informações de uma moeda
     * @param CoinModel $coin
     * @return void
     */
    public static function render(CoinModel $coin): void
    {
        echo (new \PlugHttp\Response())
            ->response()
            ->json([
                'valorConvertido' => $coin->getAmount(),
                'simboloMoeda' => $coin->getSymbol(),
            ]);
    }

    /**
     * Renderiza uma mensagem de erro padrão
     * @return void
     */
    public static function renderClientError(): void
    {
        echo (new \PlugHttp\Response())
            ->setStatusCode(400)
            ->response()
            ->json([
                'error' => 'URL inválida'
            ]);
    }
}