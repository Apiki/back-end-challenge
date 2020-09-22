<?php

namespace App\Apiki\conversodemoedas\Dominio\Moeda;

class ValidarMoeda
{
    public static function moedaENula(string $moedaentrada,  string $moedasaida): bool
    {
        if (empty($moedaentrada) && empty($moedasaida)) {
            return false;
        } else {
            return true;
        }
    }
    public static function simboloENulo(string $simboloentrada, string $simbolosaida): bool
    {
        if (empty($simboloentrada) && empty($simbolosaida)) {
            return false;
        } else {
            return true;
        }
    }

    public static function validaTodosParametros(array $dados): bool
    {
        if (sizeof($dados) == 6) {
            return true;
        } else {
            return false;
        }
    }
}
