<?php
namespace App;

class Conversao {

    private $exchange;
    private $amont;
    private $from;
    private $to;
    private $rate;
    private $simboloMoeda;

    public function __construct($uri)
    {
        $this->exchange = $uri[1];
        $this->amont = (float) str_replace(",",".", $uri[2]);
        $this->from = $uri[3];
        $this->to = $uri[4];
        $this->rate = (float) str_replace(",",".", $uri[5]);
    }

    public function verificarRequest()
    {
        if ($this->exchange !== 'exchange' || $this->amont == "" 
        || $this->from == ""  || $this->to == ""  || $this->rate == "" ) {
            $erro = array(
                    "Status"=>"Erro", 
                    "Mensagem"=>'Informe corretamente todos os parametros. http://localhost:8000/exchange/{amount}/{from}/{to}/{rate}'
                    );
            http_response_code(400);
            echo \json_encode($erro,JSON_UNESCAPED_SLASHES);
            exit();
        } else {
            return true;
        }
    }

    private function verificaMoeda($moeda)
    {
        switch ($moeda) {
            case "BRL":
                $this->simboloMoeda = "R$";
                return true;
            case "USD":
                $this->simboloMoeda = "$";
                return true;
            case "EUR":
                $this->simboloMoeda = "€";
                return true;
            default:
            $erro = array(
                "Status"=>"Erro", 
                "Mensagem"=>'Informe uma moeda aceita. BRL, USD, EUR'
                );
        http_response_code(400);
        echo \json_encode($erro);
        exit();
        }

    }

    public function verificaMoedas()
    {
        if ($this->from == $this->to) {
            $erro = array(
                "Status"=>"Erro", 
                "Mensagem"=>'Informe moedas diferentes. São aceitas BRL, USD, EUR'
                );
        http_response_code(400);
        echo \json_encode($erro,JSON_UNESCAPED_UNICODE);
        exit();
        }
        if ($this->verificaMoeda($this->from) && $this->verificaMoeda($this->to)){
            return true;
        }
    }

    public function converter()
    {
        if ($this->amont < 0 || $this->rate < 0) {
            $erro = array(
                "Status"=>"Erro", 
                "Mensagem"=>'Informe valores maiores que 0'
                );
        http_response_code(400);
        echo \json_encode($erro);
        exit();
        }
        $total = $this->amont * $this->rate;
        $retorno = array(
            "valorConvertido" => $total,
            "simboloMoeda" => $this->simboloMoeda
        );
        echo \json_encode($retorno,JSON_UNESCAPED_UNICODE);
        exit();

    }
}