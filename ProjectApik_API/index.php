<?php
//definição de classe 
class Parametrização
{
    //derclaração de variaveis da classe
    private $url;
    private $url2;
    private $cod;
    private $valor1;
    private $moeda1;
    private $moeda2;
    private $valor2;

    //construtor para receber os dados 
    public function __construct($url, $url2, $cod, $valor1, $moeda1, $moeda2, $valor2)
    {

        $this->url = $url;
        $this->url2 = $url2;
        $this->cod = $cod;
        $this->valor1 = $valor1;
        $this->moeda1 = $moeda1;
        $this->moeda2 = $moeda2;
        $this->valor2 = $valor2;
    }
    //metodo responsavel por realizar a soma das moedas
    public function somaMoedas()
    {
        $valorFinal = ($this->valor1 * $this->valor2);   //realiza a soma dos valores das moedas passadas pela url
        $simboloMoeda = '';
        
        //estruturas de decisão para verificar se o usuario está solicitando uma conversão valida
        if ($this->moeda2 == 'USD' && $this->moeda1 == 'BRL') {         
            $simboloMoeda = '$';
        } else if ($this->moeda2 == 'EUR' && $this->moeda1 == 'BRL') {
            $simboloMoeda = '€';
        } else if ($this->moeda1 == 'USD' && $this->moeda2 == 'BRL' || $this->moeda1 == 'EUR' && $this->moeda2 == 'BRL') {
            $simboloMoeda = 'R$';
        } else {
            echo ("Verifique a sigla da moeda informada");
            return;
        }
        // array que captura os dados resultantes 
        $dados = array(
            'valorConvertido' => $valorFinal,
            'simboloMoeda' =>  $simboloMoeda
        );
        //chamada de metodo para impressão 
        $this->getResultado($dados);
    }
    //metodo responsavel por imprimir os dados na tela do navegador
    public function getResultado($dados)
    {
        echo "<pre>" . json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), "</pre>";
    }
}

//funções php e regex utilizados para capturar as informações da URL
$url = $_SERVER['SCRIPT_NAME'];
$url2 = preg_replace('([a-z])', "", $url);
$cod = explode("/", $url2);
$count = count($cod);

//estrutura para verificar se os dados foram informados e recebidos corretamentes 
if ($count > 4) {
    $valor1 = $cod[2];
    $moeda1 = $cod[3];
    $moeda2 = $cod[4];
    $valor2 = $cod[5];
    //instancia e inicializa objeto da classe criada
    $obj = new Parametrização($url, $url2, $cod, $valor1, $moeda1, $moeda2, $valor2);
    //chamada do metodo somaMoedas()
    echo $obj->somaMoedas();
}else{
    //Caso o usuario informe valores incorretos na URL 
    echo "Erro, Informe os valores em ponto flutuante";
}

?>