<?php

final class Validacoes
{
    const ROTA = 'exchange';
    const QTD_PARAMETROS = 4;
    const currencyes = array('BRL', 'EUR', 'USD');

    var $amount;
    var $from;
    var $to;
    var $rate;

    var $messages = array();

    private function getURI()
    {
        $rota = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        return $rota;
    }

    private function validarRota()
    {
        if ($this->getURI()[1] == self::ROTA) {
            return TRUE;
        } else {
            array_push($this->messages, 'Rota invalida');
            return FALSE;
        }
    }

    private function validarQtdParametros()
    {
        if ($this->validarRota()) {
            //Somo com 2 porque o primeiro parâmetro é vazio e o segundo é a rota
            if (count($this->getURI()) == 2 + self::QTD_PARAMETROS) {
                return TRUE;
            } else {
                array_push($this->messages, 'Quantidade de parametros incorreta');
                return FALSE;
            }
        }
        return FALSE;
    }

    private function validarTipoParametros()
    {
        if ($this->validarQtdParametros()) {
            $parametros = $this->getURI();
            $this->amount = $parametros[2];
            $this->from = $parametros[3];
            $this->to = $parametros[4];
            $this->rate = $parametros[5];


            //Valida se o AMOUNT é um número
            if (!is_numeric($this->amount)) {
                array_push($this->messages, 'Valor de AMOUNT nao e numerico');
                return FALSE;
            }

            //Valida se o AMOUNT é positivo
            if (floatval($this->amount) * 1 < 0) {
                array_push($this->messages, 'Valor de AMOUNT nao e positivo');
                return FALSE;
            }

            //Valida se o FROM está dentro das moedas definidas
            if (!in_array($this->from, self::currencyes, TRUE)) {
                array_push($this->messages, 'Valor de FROM nao esta entre as moedas aceitas');
                return FALSE;
            }

            //Valida se o TO está dentro das moedas definidas
            if (!in_array($this->to, self::currencyes, TRUE)) {
                array_push($this->messages, 'Valor de TO nao esta entre as moedas aceitas');
                return FALSE;
            }

            //Valida se o RATE é um número
            if (!is_numeric($this->rate)) {
                array_push($this->messages, 'Valor de RATE nao e numerico');
                return FALSE;
            }

            //Valida se o RATE é positivo
            if (floatval($this->rate) * 1 < 0) {
                array_push($this->messages, 'Valor de RATE nao e positivo');
                return FALSE;
            }

            return TRUE;
        }
        return FALSE;
    }

    public function validar()
    {
        return $this->validarTipoParametros();
    }
}

class App
{
    var $saida = array(
        'valid' => true,
        'code' => 200,
        'message' => 'Success'
    );
    var $validacoes;

    public function run()
    {
        $this->validacoes = new Validacoes();
        $retorno = FALSE;

        if ($this->validacoes->validar()) {
            $resultado = $this->calcular($this->validacoes->amount, $this->validacoes->rate);
            $moeda = '';
            switch ($this->validacoes->to) {
                case 'USD':
                    $moeda = '$';
                    break;
                case 'EUR':
                    $moeda = '€';
                    break;
                case 'BRL':
                    $moeda = 'R$';
                    break;
            }

            $retorno = array(
                'valorConvertido' => $resultado,
                'simboloMoeda' => $moeda
            );
        }

        $this->retornar($retorno);
    }

    private function calcular($a, $b)
    {
        return $a * $b;
    }

    private function retornar($r)
    {
        if (!$r){
            $this->saida = array(
                'valid' => false,
                'code' => 400,
                'message' => array_pop($this->validacoes->messages)
            );
            header('Content-Type: application/json; charset=utf-8', true, 400);
        } else {
            $this->saida = array_merge($this->saida, $r);
            header('Content-Type: application/json; charset=utf-8', true, 200);            
        }
        echo json_encode($this->saida, JSON_NUMERIC_CHECK);
    }

}
