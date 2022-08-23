<?php
/**
 * Controller da API
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
 * Classe Controller com os métodos implementados pela API
 * 
 * @category Challenge
 * @package  Back-end
 * @author   Bernardo Gomes <bernardomgo@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class Controller
{
    /**
     * Recebe o pedido da API e retorna o resultado do método caso ele exista
     * 
     * @param STRING $method método chamado pela requisição 
     * @param ARRAY  $data   array com os argumentos do método
     * 
     * @return array Array com o resultado do método ou com o erro
     */
    public function procRequest($method, $data)
    {
        if (method_exists($this, $method)) {
            return call_user_func(array($this, $method), $data);
        } else {
            return ['ERRO' => 'MÉTODO NÃO ENCONTRADO'];
        }
    }
    /**
     * Implementa o método de conversão de moedas
     *
     * @param ARRAY $data array com os argumentos $amount, $from, $to e $rate
     * 
     * @return ARRAY Array com o resultado da conversão 
     * e símbolo da moeda ou com o erro
     */
    private function _exchange($data)
    {
        [$amount, $from, $to, $rate] = $data;
        if (!max($amount, 0) || !$from || !$to || !max($rate, 0)) {
            return ['ERRO' => 'ERRO DE REQUISIÇÃO'];
        }
        if ($from == 'BRL' xor $to == 'BRL') {
            $valorConvertido = $amount * $rate;
            $simboloMoeda = '';
            switch ($to) {
            case 'BRL':
                $simboloMoeda = 'R$';
                break;
            case 'EUR':
                $simboloMoeda = '€';
                break;
            case 'USD':
                $simboloMoeda = '$';
                break;
            default:
                return ['ERRO' => 'MOEDA NÃO PERMITIDA'];
            }

            return [
                'valorConvertido' => $valorConvertido,
                'simboloMoeda' => $simboloMoeda
            ];
        } else {
            return ['ERRO' => 'CONVERSÃO NÃO PERMITIDA'];
        }
    }
}
