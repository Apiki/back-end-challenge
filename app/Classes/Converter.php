<?php

namespace app\Classes;

use App\Classes\Error;

class Converter
{

    private $validCoins = ['BRL', 'USD', 'EUR'];
    private $symbolCoin = ['BRL' => 'R$', 'USD' => '$', 'EUR' => '€'];

    //Validando URL
    public function validateRequest($url)
    {

        if (
            (isset($url[0]) && $url[0] != "" && $url[0] != NULL) &&
            (isset($url[1]) && $url[1] != "" && $url[1] != NULL) &&
            (isset($url[2]) && $url[2] != "" && $url[2] != NULL) &&
            (isset($url[3]) && $url[3] != "" && $url[3] != NULL)
        ) {

            $url[3] = str_replace(",", ".", $url[3]);


            //Não é possível a conversão para meoedas iguais
            if (strtoupper($url[1]) === strtoupper($url[2])) {

                Error::getError('0002');
                exit;
            }

            //verifica se ou amount e o rate são númericos pra poder fazer o cálculo
            if (!is_numeric($url[0]) || !is_numeric($url[3])) {

                Error::getError('0001');
                exit;
            }

            return true;
        }

        return false;
    }


    //Metódo para verificar se as moedas enviadas na requisição são válidas
    public function verifyValidCoins($to, $from)
    {

        if (!in_array($to, $this->validCoins) || !in_array($from, $this->validCoins)) {

            return false;
        }
        return true;
    }

    //Metódo que fará o cálculo da conversão
    public function calcConverter($amount, $to, $rate)
    {

        if ($to === 'BRL') {

            return $amount * $rate;
        } else {

            return $amount / $rate;
        }
    }

    //Metódo criado para retornar a resposta
    public function getResponse($convertedValue, $symbolCoin)
    {
        $response = ['valorConvertido' => number_format($convertedValue, 2), 'simboloMoeda' => $symbolCoin];
        return json_encode($response);
    }


    // Getters e Setters

    public function getSymbolCoin($to)
    {
        return $this->symbolCoin[$to];
    }

    public function getValidCoins()
    {
        return $this->validCoins;
    }
}
