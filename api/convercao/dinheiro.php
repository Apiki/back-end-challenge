<?php

class Dinheiro
{

    private static $convert;

    private function sync()
    {
        $var = json_decode(file_get_contents('https://api.hgbrasil.com/finance'));

        self::$convert->euro = $var->results->currencies->EUR->buy;
        self::$convert->dolar = $var->results->currencies->USD->buy;
    }

    public function converter($parametros)
    {
        $this->sync();

        $resposta;
        switch ($parametros->destino) {
            case 'euro':
                $resposta->cifra = '€';
                if (isset($parametros->dolar)) {
                    $real = $parametros->dolar * self::$convert->dolar;
                    $resposta->valor = $real / self::$convert->euro;
                } else if (isset($parametros->real)) {
                    $resposta->valor = $parametros->real / self::$convert->euro;
                }
                break;

            case 'dolar':
                $resposta->cifra = '$';
                if (isset($parametros->euro)) {
                    $real = $parametros->euro * self::$convert->euro;
                    $resposta->valor = $real / self::$convert->dolar;
                } else if (isset($parametros->real)) {
                    $resposta->valor = $parametros->real / self::$convert->dolar;
                }
                break;
            case 'real':
                $resposta->cifra = 'R$';
                if (isset($parametros->dolar)) {
                    $resposta->valor = $parametros->dolar * self::$convert->dolar;
                } else if (isset($parametros->euro)) {
                    $resposta->valor = $parametros->euro * self::$convert->euro;
                }
                break;
        }
        return $resposta;
    }
}

?>