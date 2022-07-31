<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este será o arquivo que processara a requisição.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Seu Nome <internickbr@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/internick2017/back-end-challenge
 */

namespace App;

/**
 * Classe Request
 *
 * @category Challenge
 * @package  Back-end
 * @author   Seu Nome <internickbr@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/internick2017/back-end-challenge
 */
class Request
{
    /**
     * Função para obter o caminho da url da requisição
     *
     * @return mixed|string
     */
    public function getPath()
    {
        return $_SERVER['REQUEST_URI'] ?? '/';
    }

    /**
     * Função para obter o método da url da requisição
     *
     * @return string
     */
    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

}