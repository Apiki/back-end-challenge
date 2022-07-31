<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este será o arquivo que retornara o status e o json como resposta.
 *
 * @category Response
 * @package  Back-end
 * @author   Nick Granados <internickbr@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/internick2017/back-end-challenge
 */

namespace App;

/**
 * Classe Response
 *
 * @category Response
 * @package  Back-end
 * @author   Nick Granados <internickbr@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/internick2017/back-end-challenge
 */
class Response
{

    /**
     * Estabelecer o código de resposta do header
     *
     * @param int $code Código
     *
     * @return void
     */
    public function setStatusCode(int $code): void
    {
        http_response_code($code);
    }

    /**
     * Estabelecer a resposta em formato JSON
     *
     * @param mixed $body Conteudo da resposta
     *
     * @return false|string
     */
    public function json($body)
    {
        header('Content-Type: application/json; charset=utf-8');
        return json_encode($body);
    }

}