<?php

class Exchange {

    var $amount;
    var $from;
    var $to;
    var $rate;
    var $json;
    var $message;
    var $statusCode;

    const messages = [
        0 => 'O número de parámetros deve ser 4',
        1 => 'Parámetro {amount} inválido. Forneça um valor numérico >= 0',
        2 => 'Parámetro {from} inválido. Moeda não achada',
        3 => 'Parámetro {to} inválido. Moeda não achada',
        4 => 'Parámetro {rate} inválido. Forneça um valor numérico > 0',
    ];

    const currencies = [
        'BRL' => 'R$',
        'USD' => '$',
        'EUR' => '€',
    ];

    public function checkParams() {
        // extraindo parámetros
        $params = array_filter(explode('/', $_SERVER['REQUEST_URI']));
        // conferindo número de parámetros
        if (count($params) != 5) {
            $this->message = self::messages[0];
            return false;
        }
        // conferindo amount
        $amount = $params[2];
        if (is_numeric($amount) && $amount >= 0) {
            $this->amount = $amount;
        } else {
            $this->message = self::messages[1];
            return false;
        }
        // conferindo from
        $from = $params[3];
        if (array_key_exists($from, self::currencies)) {
            $this->from = $from;
        } else {
            $this->message = self::messages[2];
            return false;
        }
        // conferindo to
        $to = $params[4];
        if (array_key_exists($to, self::currencies)) {
            $this->to = $to;
        } else {
            $this->message = self::messages[3];
            return false;
        }
        // conferindo rate
        $rate = $params[5];
        if (is_numeric($rate) && $rate > 0) {
            $this->rate = $rate;
        } else {
            $this->message = self::messages[4];
            return false;
        }
        // se os parámetros enviados são vãlidos, devolver true
        return true;
    }

    public function processRequest() {
        if ($this->checkParams()) {
            $this->statusCode = 200;
            $result = $this->amount * $this->rate;
            $this->json = [
                'valorConvertido' => $result,
                'simboloMoeda' => self::currencies[$this->to],
            ];
        } else {
            $this->statusCode = 400;
            $this->json = [
                'error' => $this->message,
            ];
        }
        // cabeçalhos e resposta
        header('Content-Type: application/json; charset=utf-8', true, $this->statusCode);
        echo json_encode($this->json, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
    }

}