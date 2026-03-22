<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * @category Challenge
 * @package  Back-end
 * @author   João Paulin <ppaulin23@hotmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/joaopaulin/back-end-challenge
 */
declare(strict_types=1);

namespace App\Routers;

use App\Classes\CurrencyConverter;

/**
 * Classe Router.
 *
 * PHP version 7.4
 *
 * Responsável por gerenciar as rotas e despachar para o conversor de moedas.
 *
 * @category Challenge
 * @package  Back-end
 * @author   João Paulin <ppaulin23@hotmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/joaopaulin/back-end-challenge
 */
class Router
{
    /**
     * Lida com a requisição atual.
     * 
     * @return void
     */
    public function handleRequest(): void
    {
        // Define o cabeçalho JSON
        header('Content-Type: application/json');

        // Obtém a URI da requisição
        $request_uri = $_SERVER['REQUEST_URI'];
        $path = parse_url($request_uri, PHP_URL_PATH);
        $pathParts = explode('/', trim($path, '/'));

        if (count($pathParts) < 4) {
            $this->_sendErrorResponse();
        }

        // Se a primeira parte for 'exchange', remove-a
        if ($pathParts[0] === 'exchange') {
            array_shift($pathParts);
        }

        // Verifica se temos partes suficientes (amount, from, to, rate)
        if (count($pathParts) !== 4) {
            $this->_sendErrorResponse();
        }

        [$amountRaw, $from, $to, $rateRaw] = $pathParts;

        // Validação básica
        if (!is_numeric($amountRaw) || !is_numeric($rateRaw)) {
            $this->_sendErrorResponse();
        }

        $amount = (float) $amountRaw;
        $rate = (float) $rateRaw;

        if ($amount < 0 || $rate < 0) {
            $this->_sendErrorResponse();
        }

        $converter = new CurrencyConverter();

        if (!$converter->isValidCurrency($from) 
            || !$converter->isValidCurrency($to)
        ) {
            $this->_sendErrorResponse();
        }

        // Executa a conversão e mapeia símbolo
        $convertedValue = $converter->convert($amount, $rate);
        $symbol = $converter->getSymbol($to);

        // Resposta de Sucesso
        echo json_encode(
            [
                'valorConvertido' => $convertedValue,
                'simboloMoeda' => $symbol
            ]
        );
    }

    /**
     * Envia uma resposta de erro 400.
     * 
     * @return void
     */
    private function _sendErrorResponse(): void
    {
        http_response_code(400);
        echo json_encode(['error' => 'Requisicao Invalida']);
        exit;
    }
}
