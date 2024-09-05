<?php
/** 
 * Declarar a tipagem como válida
 * 
 * PHP version 8.3.7
 * 
 * @category Challenge
 * @package  Back-end
 * @author   Mateus Ávila Isidoro <mateus@mateusavila.com.br>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);
require __DIR__ . '/../vendor/autoload.php';

/**
 * Back-end Challenge.
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Mateus Ávila Isidoro <mateus@mateusavila.com.br>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class MoneyConvert
{
    private string $_url;
    private float $_amount;
    private float $_rate;
    private string $_from;
    private string $_to;
    private array $_urlSlices;
    private string $_result;
    private float $_total;
    private string $_error;
    private array $_moneyStrings = ['USD' => '$', 'EUR' => '€', 'BRL' => 'R$'];
    private $_rg = '#^/exchange/(\d+(\.\d+)?)/([A-Z]{3})/([A-Z]{3})/(\d+(\.\d+)?)$#';

    /**
     * Construtor da classe.
     *
     * @param string $url A URL da qual extrair as informações para conversão.
     */
    public function __construct(string $url)
    {
        $this->_url = $url;
        if (!$this->validateURL()) {
            $this->_error = json_encode(["message" => "URL inválida"]);
            return $this->returnError();
        }
        $explodeURL = explode('/', $url); 
        $this->_urlSlices = $explodeURL;
        
        if (!$this->validateMoneyStrings(3)) {
            $message = "Moeda selecionada não é válida";
            $this->_error = json_encode(["message" => $message]);
            return $this->returnError();
        }
          
        if (!$this->validateMoneyStrings(4)) {
            $message = "Moeda a ser convertida não é válida";
            $this->_error = json_encode(["message" => $message]);
            return $this->returnError();
        }

        return $this->calculateResult();
    }

    /**
     * Valida a URL fornecida.
     *
     * @return void Retorna um erro
     */
    public function returnError()
    {
        echo $this->_error;
        http_response_code(400);
    }

    /**
     * Valida a URL fornecida.
     *
     * @return bool True se a URL for válida, False caso contrário.
     */
    public function validateURL()
    {
        return preg_match($this->_rg, $this->_url);
    }

    /**
     * Valida se a moeda buscada existe no array
     *
     * @param int $position marca a posição do array
     *
     * @return bool Retorna se existe ou não no array 
     */
    public function validateMoneyStrings(int $position)
    {
        return array_key_exists($this->_urlSlices[$position], $this->_moneyStrings);
    }

    /**
     * Calcula o resultado da conversão de moeda.
     * 
     * @return void apenas executa a função.
     */
    public function calculateResult()
    {
        $this->_amount = (float) $this->_urlSlices[2];
        $this->_rate = (float) $this->_urlSlices[5];
        $this->_from = $this->_urlSlices[3];
        $this->_to = $this->_urlSlices[4];
        $this->_total = $this->_amount * $this->_rate;

        $TT = $this->_total;
        $SY = $this->_moneyStrings[$this->_to];
        $this->_result = json_encode([ "valorConvertido"=>$TT, "simboloMoeda"=>$SY]);
        http_response_code(200);
        $this->process();
    }

    /**
     * Processa e exibe o resultado.
     * 
     * @return string com os valores declarados na função.
     */
    public function process()
    {
        print_r($this->_result);
    }
}

$money = new MoneyConvert($_SERVER['REQUEST_URI']);
