<?php
namespace api;

require_once "cotacao.php";

class Converte {
    private $valor;
    private $moedaOrigem;
    private $moedaDestino;
    private $simbolo = ['R$', 'U$', 'E$'];
    const MOEDAS = ['brl', 'usd', 'eur'];
    
    public function __construct() {
        //header('Content-type: application/json');
    }
    
    /*
     * Essa função converte os valores de acordo com as entradas de moedaOrigem e moedaDestino
     * @return json
     * 
     */
    public function converteValor($valor, $moedaOrigrem, $moedaDestino) {
        if (in_array($moedaDestino,self::MOEDAS) && in_array($moedaOrigrem,self::MOEDAS)) {
            $cotacao = new Cotacao();
            
            if ($moedaOrigrem == 'brl') {
                if ($moedaDestino == 'usd') {
                    $this->simbolo = $this->simbolo[1];
                    $resultado = round($valor / $cotacao->getValorDolar(),2);
                } else {
                    $this->simbolo = $this->simbolo[2];
                    $resultado = round($valor / $cotacao->getValorEuro(),2);
                }
            } else if ($moedaOrigrem == 'usd') {
                $this->simbolo = $this->simbolo[0];
                $resultado = round($cotacao->getValorDolar() * $valor,2);
            } else {
                $this->simbolo = $this->simbolo[0];
                $resultado = round($cotacao->getValorEuro() * $valor,2);
            }
            
            
            echo json_encode([
                "ValorEntrada" => $valor, 
                "MoedaOrigem" => $moedaOrigrem, 
                "MoedaDestino" => $moedaDestino, 
                $this->simbolo => $resultado
            ]);
            
            //echo json_encode(self::MOEDAS);
        } else {
            echo json_encode([
                "Error" 		=> "Uma das variaveis esta com valor incorreto.",
                "valor" 		=> "float",
                "moedaorigem" 	=> ['brl', 'usd', 'eur'],
                "moedadestino" 	=> ['brl', 'usd', 'eur']
            ]);
        }
    }    
    
    /**
     * @return mixed
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @return mixed
     */
    public function getMoedaOrigem()
    {
        return $this->moedaOrigem;
    }

    /**
     * @return mixed
     */
    public function getMoedaDestino()
    {
        return $this->moedaDestino;
    }

    /**
     * @param mixed $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    /**
     * @param mixed $moedaOrigem
     */
    public function setMoedaOrigem($moedaOrigem)
    {
        $this->moedaOrigem = $moedaOrigem;
    }

    /**
     * @param mixed $moedaDestino
     */
    public function setMoedaDestino($moedaDestino)
    {
        $this->moedaDestino = $moedaDestino;
    }

}