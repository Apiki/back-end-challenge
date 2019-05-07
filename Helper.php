<?php

class Helper{

    /**
     * Retorna um array com os valores de conversão de uma moeda para outra considerando 1 unidade de moeda
     * @return array
     */
    public function currencyMap(){
        return [
            'brl' => [
                'usd' => 0.25,
                'eur' => 0.22
            ],
            'eur' => [
                'brl' => 4.45,
            ],
            'usd' => [
                'brl' => 3.97,
            ]
        ];
    }

    /**
     * Retorna o simbolo da moeda com base na sigla da mesma
     * @param string $currency
     * @return string
     */
    static function getCurrencySimbol($currency){
        switch($currency){
            case 'brl': return 'R$';
            case 'usd': return '$';
            case 'eur': return '€';
            default:    return '';
        }
    }

    /**
     * Realiza o calculo da moeda atual para outra moeda com base na cotação
     * @param string $from
     * @param string $to
     * @param numeric $quote
     * @return numeric
     */
    static function getCurrencyValue($from, $to, $quote){
        $values = self::currencyMap();
        return $values[$from][$to] * $quote;
    }

    /**
     * Monta o retrono da API
     * @param string $message
     * @return string
     */
    public function response($data, $code = 200){
        header('Content-Type: application/json; charset=utf-8;');
        http_response_code($code);

        if(!empty($data))
            echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

        exit;
    }

    /**
     * Retorno da API incluido uma mensagem e com status 406 - Method Not Allowed
     * @param string $message
     * @return string
     */
    static function responseMethodNotAllowed($message){
        $data['message'] = $message;
        return self::response($data, 406);
    }

    /**
     * Retorno da API incluido uma mensagem e com status 405 - Not Accetable
     * @param string $message
     * @return string
     */
    static function responseNotAcceptable($message){
        $data['message'] = $message;
        return self::response($data, 405);
    }

    /**
     * Retorno da API incluido um objecto e com status 200 - Success
     * @param mix $object
     * @return string
     */
    static function responseSuccess($object){
        $data['data'] = $object;
        return self::response($data, 405);
    }
}