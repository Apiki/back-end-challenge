<?php

/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Arquivo de verificação da url
 *
 * @category Challenge
 * @package  Back-end
 * @author   Pedro Henrique da Silva <pedrohenriquedasilva100@yahoo.com.br>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

namespace App\Controller;

/**
 * Essa classe verifica se os parâmetros da url possui erros
 * 
 * @category Challenge
 * @package  Http
 * @author   Pedro Henrique da Silva <pedrohenriquedasilva100@yahoo.com.br>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class HttpStatus
{
    private $_uri;

    /**
     * Método construtor, passa o valor url para a propriedade _uri
     */
    public function __construct()
    {
        $this->_uri = $this->getUri();
    }

    /**
     * Pega a url do navegador
     * 
     * @return array
     */
    public function getUri()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode('/', $uri);

        return $uri;
    }

    /**
     * Verifica se a url está nos padrões definidos
     * 
     * @return null
     */
    public function statusVerification()
    {
        if ((isset($this->_uri[1]) && $this->_uri[1] != 'exchange')
            || !isset($this->_uri[2])
            || !isset($this->_uri[3])
            || !isset($this->_uri[4])
            || !isset($this->_uri[5])
        ) {
            $callback["message"] = 'HTTP/1.1 400 Bad Request';
            echo json_encode($callback);
            header("HTTP/1.1 400 Bad Request");
            exit();
        }

        if ((is_numeric($this->_uri[2]) == false || $this->_uri[2] < 0)
            || (is_numeric($this->_uri[5]) == false || $this->_uri[5] < 0)
        ) {
            $callback["message"] = 'HTTP/1.1 400 Bad Request';
            echo json_encode($callback);
            header("HTTP/1.1 400 Bad Request");
            exit();
        }

        if (ctype_upper($this->_uri[3]) == false
            || ctype_upper($this->_uri[4]) == false
        ) {
            $callback["message"] = 'HTTP/1.1 400 Bad Request';
            echo json_encode($callback);
            header("HTTP/1.1 400 Bad Request");
            exit();
        }
    }
}
