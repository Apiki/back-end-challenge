<?php

namespace Controller;

use Model\Moeda;

class MoedaController
{
    public function converteMoeda($valorOrigem, $moedaOrigem, $moedaDestino, $indiceConversao)
    {
        $moeda = new Moeda();

        $simboloMoedaDestino = $moeda->getMoeda($moedaDestino);
        $valorConvertido = floatval($valorOrigem) * floatval($indiceConversao);

        return ["valorConvertido" => $valorConvertido, "simboloMoeda" => $simboloMoedaDestino];

    }
}