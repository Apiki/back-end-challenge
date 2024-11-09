<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este arquivo contém a classe RouteResponse, que pode ser utilizada
 * para construir as respostas das requisições
 *
 * @category Router
 * @package  Utils
 * @author   Raphael Ceccato Pauli <raphaelcpauli@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/raphaelceccato/back-end-challenge
 */


namespace App\Utils;




/**
 * Classe RouteResponse
 * 
 * Este arquivo contém a classe RouteResponse, que pode ser utilizada
 * para construir as respostas das requisições
 * 
 * @category Router
 * @package  Utils
 * @author   Raphael Ceccato Pauli <raphaelcpauli@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/raphaelceccato/back-end-challenge
 */
class RouteResponse
{
    public int $code = 200;
    public string $content_type = "text/html";
    public string $charset = "utf-8";
    public string $content = "";


    /**
     * Constrói a resposta e a envia automaticamente
     * 
     * @return void
     */
    public function build()
    {
        http_response_code($this->code);
        header("Content-Type: {$this->content_type}; charset={$this->charset}");
        echo $this->content;
    }
}
