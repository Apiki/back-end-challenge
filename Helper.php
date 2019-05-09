<?php

class Helper{

    static $CURRENCY = [
        'brl',
        'eur',
        'usd'
    ];

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
     * Retorna true se a conversão for inválida, false se ela for valida
     * @param string $from
     * @param string $to
     * @return boolean
     */
    public function invalidExchange($from, $to){
        switch($from){
            case $to:
                return true;
            case 'eur':
                return 'usd' == $to;
            case 'usd':
                return 'eur' == $to;
        }
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
     * Retorno da API incluido uma mensagem e com status 405 - Not Acceptable
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