<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este arquivo contém a classe ControllerException, utilizada para sinalizar erros
 * nos controllers
 *
 * @category Controller
 * @package  Utils
 * @author   Raphael Ceccato Pauli <raphaelcpauli@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/raphaelceccato/back-end-challenge
 */


namespace App\Utils;

use Exception;


/**
 * Classe ControllerException
 * 
 * Exception utilizada para sinalizar erros nos controllers
 * 
 * @category Controller
 * @package  Utils
 * @author   Raphael Ceccato Pauli <raphaelcpauli@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/raphaelceccato/back-end-challenge
 */
class ControllerException extends Exception
{
    /**
     * Construtor da classe ControllerException.
     *
     * @param int    $code    Código do erro
     * @param string $message Mensagem de erro
     */
    public function __construct(int $code, string $message)
    {
        parent::__construct($message, $code);
    }
}
