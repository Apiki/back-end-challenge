<?php
/**
 * API Para conversão de moedas
 * php version 7.4.3
 *
 * @category Conversão
 * @package  App\controllers
 * @author   Gustavo Breternitz <breternitzgustavo@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU/CPLv3
 * @link     https://www.linkedin.com/in/gustavo-breternitz-9b83901ba/
 */
namespace App\controllers;

use App\utils\Arrays;
use Exception;

/**
 * Exchange Controller
 *
 * @category Conversão
 * @package  App\controllers
 * @author   Gustavo Breternitz <breternitzgustavo@gmail.com>
 * @license  None https://www.linkedin.com/in/gustavo-breternitz-9b83901ba/
 * @link     https://www.linkedin.com/in/gustavo-breternitz-9b83901ba/
 */
class ExchangeController
{
    private $_erros;

    /**
     *  Método construtor da controller Exchange
     */
    public function __construct()
    {
        $this->_erros = null;
    }

    /**
     * Action responsável Processar os dados da conversão
     *
     * @param array $request Dados
     *
     * @return void
     */
    public function converter($request)
    {
        try {
            if (count($request) != 5) {
                http_response_code(400);
                echo json_encode(
                    [
                        'erro' => 'A requisição deve seguir o seguinte formato: http://localhost:8000/exchange/{amount}/{from}/{to}/{rate}.'
                    ]
                );
                return;
            }

            $arr_request = [
                'amount' => $request[1],
                'from' => strtoupper($request[2]),
                'to' => strtoupper($request[3]),
                'rate' => $request[4]
            ];

            if (!$this->_validate($arr_request)) {
                http_response_code(400);
                echo json_encode(['erro' => $this->_erros]);
                return;
            }

            $valor = $this->_getValorConvertido($arr_request);
            if (!is_bool($valor)) {
                echo json_encode(['valorConvertido' => $valor, 'simboloMoeda' => Arrays::siglasMoedas($arr_request['to'])]);
            } else {
                http_response_code(400);
                echo json_encode(['erro' => $this->_erros]);
            }
            return;
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(['erro' => 'Ocorreu um erro, tente novamente, caso o mesmo persista entre em contato com o administrador [01].']);
            return;
        }
    }

    /**
     * Função responsável por validar os dados da request
     *
     * @param array $dados Dados
     *
     * @return boolean
     */
    private function _validate($dados)
    {
        try {
            if (preg_match('/^[0-9]+(?:\.[0-9]{0,2})?$/', $dados['amount']) != 1) {
                $this->_erros = 'O segundo parâmetro (amount) deve conter o seguinte formato: 99.99, tente novamente.';
                return false;
            }

            if (preg_match('/^[0-9]+(?:\.[0-9]{0,2})?$/', $dados['amount']) != 1) {
                $this->_erros = 'O quarto parâmetro (rate) deve conter o seguinte formato: 99.99, tente novamente.';
                return false;
            }

            if (is_array(Arrays::siglasMoedas($dados['from'])) || is_array(Arrays::siglasMoedas($dados['to']))) {
                $this->_erros = 'As moedas suportadas para a conversão são: BRL (Real Brasileiro), USD (Dólar Americano) e EUR (Euro).';
                return false;
            }

            if ($dados['from'] == $dados['to']) {
                $this->_erros = 'Para realizar a conversão é necessário alterar dois tipos de moedas diferentes.';
                return false;
            }

            return true;
        } catch (Exception $e) {
            $this->_erros = 'Ocorreu um erro, tente novamente, caso o mesmo persista entre em contato com o administrador [02].';
            return false;
        }
    }

    /**
     * Função responsável por calcular a conversão
     *
     * @param array $dados Dados
     *
     * @return float
     */
    private function _getValorConvertido($dados)
    {
        try {
            switch ([$dados['from'], $dados['to']]) {
            case ['BRL', 'USD']:
            case ['BRL', 'EUR']:
            case ['USD', 'BRL']:
            case ['EUR', 'BRL']:
                return round($dados['amount'] * $dados['rate'], 2);
            default:
                $this->_erros = 'Ocorreu um erro, tente novamente, caso o mesmo persista entre em contato com o administrador [02].';
                return false;
            }
        } catch (Exception $e) {
            $this->_erros = 'Ocorreu um erro, tente novamente, caso o mesmo persista entre em contato com o administrador [03].';
            return false;
        }
    }
}