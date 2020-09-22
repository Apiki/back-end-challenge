<?php

namespace App\Apiki\conversodemoedas\Dominio\Taxa;

class  simboloMoeda
{


    public  function __construct(string $simboloentrada, string $simbolosaida)
    {
        $this->simboloentrada = $simboloentrada;
        $this->simbolosaida = $simbolosaida;
    }

    public  static function retornasimboloentrada(string $simboloentrada): bool
    {
        if (ctype_upper($simboloentrada) == false) {
            return false;
        }
        switch ($simboloentrada) {
            case 'BRL':
                return true;
                break;
            case 'USD':
                return true;
                break;
            case 'EUR':
                return true;
                break;
            default:
                return false;
        }
    }

    public static function retornasimbolosaida(string $simbolosaida): bool
    {
        if (ctype_upper($simbolosaida) == false) {
            return false;
        }
        switch ($simbolosaida) {
            case 'BRL':
                return true;
                break;
            case 'USD':
                return true;
                break;
            case 'EUR':
                return true;
                break;
            default:
                return false;
        }
    }

    public  static function getvalormoedasaida($valor): bool
    {
        if ($valor > 0) {
            return true;
        } else {
            return false;
        }
    }

    public  static function getvalormoedaentrada($valorentrada): bool
    {
        if ($valorentrada > 0) {
            return true;
        } else {
            return false;
        }
    }
}

//  $moedasApi = ['BRL', 'USD', 'EUR'];
//  throw new \InvalidArgumentException('Formado de Moeda Invalido');