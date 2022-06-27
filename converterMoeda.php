<?php

class converterMoeda{

    private $simbolo_real   = 'BRL';
    private $simbolo_dolar  = 'USD';
    private $simbolo_euro   = 'EUR';   

    // pegando a url
    private function url(){
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $setUrl = (empty($uri) ? '' : $uri);
        $url = explode('/', $setUrl);
    
        return $url;

    }

    // real para dolar
    private function real_dolar()
    {     

        $valor1 = $this->url()[2];
        $valor2   = $this->url()[5];

        $valores = array(
            'valorConvertido'  => (float)$valor1 * (float)$valor2,
            'simboloMoeda'     => '$'
        );

        return $valores;
    }

    // dolar para real
    private function dolar_real(){

        $valor1 = $this->url()[2];
        $valor2   = $this->url()[5];

        $valores = array(
            'valorConvertido'  => (float)$valor1 * (float)$valor2,
            'simboloMoeda'     => 'R$'
        );

        return $valores;
    }

    // real para euro
    private function real_euro(){

        $valor1 = $this->url()[2];
        $valor2   = $this->url()[5];

        $valores = array(
            'valorConvertido'  => (float)$valor1 * (float)$valor2,
            'simboloMoeda'     => '€'
        );

        return $valores;

    }

    // euro para real
    private function euro_real(){

        $valor1 = $this->url()[2];
        $valor2   = $this->url()[5];

        $valores = array(
            'valorConvertido'  => (float)$valor1 * (float)$valor2,
            'simboloMoeda'     => 'R$'
        );

        return $valores;       
 
    }

    // exibir valores
    function exibir(){

        $slug[3] = (empty($this->url()[3]) ? false : $this->url()[3]);
        $slug[4] = (empty($this->url()[4]) ? false : $this->url()[4]);

        if($slug[3] == $this->simbolo_real and $slug[4] == $this->simbolo_dolar) :
            $retorno = $this->real_dolar();
        
        elseif($slug[3] == $this->simbolo_dolar and $slug[4] == $this->simbolo_real) :
            $retorno = $this->dolar_real();

        elseif($slug[3] == $this->simbolo_real and $slug[4] == $this->simbolo_euro) :
            $retorno = $this->real_euro();
            
        elseif($slug[3] == $this->simbolo_euro and $slug[4] == $this->simbolo_real) :
            $retorno = $this->euro_real();
         
        else :
            $retorno = false;
        endif;

        $this->retorno($retorno);
    }

    // retorno em json
    private function retorno($retorno)
    {
        if ($retorno == false){
            $this->saida = array(
                'valid' => false,
                'code' => 400,
                'message');

            header('Content-Type: application/json; charset=utf-8', true, 400);
            
        } else {

            $this->saida = array(
                'valid' => true,
                'code' => 200,
                'message');

            $this->saida = array_merge($this->saida, $retorno);
            header('Content-Type: application/json; charset=utf-8', true, 200);   
         
        }

        echo json_encode($this->saida, JSON_NUMERIC_CHECK);

    } 
}