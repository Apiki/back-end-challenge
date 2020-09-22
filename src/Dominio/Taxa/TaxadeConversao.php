<?php

namespace App\Apiki\conversodemoedas\Dominio\Taxa;

use App\Apiki\conversodemoedas\Moeda\simboloMoeda;

class TaxadeConversao
{


    public function __construct(float $moedaentrada, float $moedasaida)
    {
        $this->moedaentrada = $moedaentrada;
        $this->moedasaida = $moedasaida;
    }

    public  static function calculaConversao(float $moedaentrada, float $moedasaida): float
    {
        return $moedaentrada * $moedasaida;
    }
}
