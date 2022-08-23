<?php
/**
 * Requisições da API
 * 
 * PHP version 7.4
 * 
 * @category Challenge
 * @package  Back-end
 * @author   Bernardo Gomes <bernardomgo@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/bernardomaia/back-end-challenge
 */


/**
 * Classe Request processa as requisições
 * e respostas da API
 * 
 * @category Challenge
 * @package  Back-end
 * @author   Bernardo Gomes <bernardomgo@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/bernardomaia/back-end-challenge
 */
class Request
{
    /**
     * Busca a requisição e a separa nos parâmetros método e data
     * 
     * @return array Array com o método e os argumentos de entrada 
     */
    public function getRequest()
    {
        $request = array_filter(explode('/', $_SERVER['REQUEST_URI']));
        $method = array_shift($request);
        return [$method, $request];
    }

    /**
     * Envia a resposta da requisição, adicionando o código
     * de erro se necessário 
     * 
     * @param ARRAY $response com a resposta da requisição 
     * 
     * @return VOID 
     */
    public function sendResponse($response)
    {
        header("Content-Type:application/json");
        if (!$response) { 
            $response['ERRO'] = 'OPERAÇÃO NÃO RECONHECIDA';
        }
        if (isset($response['ERRO'])) {
            http_response_code(400);
        }
        echo json_encode($response);
    }
}