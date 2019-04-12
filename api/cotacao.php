<?php 
namespace api;

class Cotacao {
    private $url;
    private $valorDolar;
    private $valorEuro;
    /**
     * Para obter a chave, faça o cadastro no site: https://hgbrasil.com/status/finance/
     * Documentação da api: https://hgbrasil.com/status/finance/#chaves-de-api
     * 
     * @var string
     */
    const KEY = 'INSIRA A CHAVE GERADA PELO SITE';

    public function __construct() {
        $this->url = 'https://api.hgbrasil.com/finance/quotations?format=json&key=' . self::KEY .'';
        $this->getCotacoes();
    }
    
    /**
     *  Essa função consome a API do HG Brasil (https://hgbrasil.com/status/finance/)
     *  Busca os valores da cotação e salva os valores de compra do DOLAR e do EURO em duas variáveis.
     */
    public function getCotacoes () {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_URL,$this->url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13");
        $json = curl_exec($ch);
        curl_close($ch);
        
        //return $json;
        
        if (empty($json)) {
            echo json_encode([
                "Error" => "Verifique a KEY da API"
            ]);
            exit;
        } else {
            $array_cota = json_decode($json, true);
            $this->valorDolar = $array_cota['results']['currencies']['USD']['buy'];
            $this->valorEuro  = $array_cota['results']['currencies']['EUR']['buy'];
        }
    }
    
    /**
     * @return mixed
     */
    public function getValorDolar()
    {
        return $this->valorDolar;
    }
    
    /**
     * @return mixed
     */
    public function getValorEuro()
    {
        return $this->valorEuro;
    }
    
    /**
     * @param mixed $valorDolar
     */
    public function setValorDolar($valorDolar)
    {
        $this->valorDolar = $valorDolar;
    }
    
    /**
     * @param mixed $valorEuro
     */
    public function setValorEuro($valorEuro)
    {
        $this->valorEuro = $valorEuro;
    }
}