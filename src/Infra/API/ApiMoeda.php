<?php

namespace App\Apiki\conversodemoedas\Infra\API;

class ApiMoeda
{

    public function __construct(float $moedaentrada, string $simboloentrada, float $moedasaida, string $simbolosaida)
    {
        $this->moedaentrada = $moedaentrada;
        $this->simboloentrada = $simboloentrada;
        $this->moedasaida = $moedasaida;
        $this->simbolosaida = $simbolosaida;
    }

    public function moedaentradamaiorquezero(): bool
    {
        if ($this->moedaentrada > 0) {
            return true;
        } else {
            echo 'valor tem que ser maior que zero';
        }
    }

    public function retonaMoedaEntrada(): float
    {
        return $this->moedaentrada;
    }

    public function retonaMoedaSaida(): float
    {
        return $this->moedasaida;
    }

    public function retornaSimboloEntrada(): string
    {
        return $this->simboloentrada;
    }

    public function retornaSimboSaida(): string
    {
        return $this->simbolosaida;
    }
}
