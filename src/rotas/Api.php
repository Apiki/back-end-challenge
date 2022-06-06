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
namespace App\rotas;
use Exception;

/**
 * Arquivo de Rotas para o Challenge
 * php version 7.4.3
 *
 * @category Conversão
 * @package  App\controllers
 * @author   Gustavo Breternitz <breternitzgustavo@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU/CPLv3
 * @link     https://www.linkedin.com/in/gustavo-breternitz-9b83901ba/
 */
class Api
{

    private $_rotas;

    /**
     * Função construtora por iniciar os atributos da classe
     *
     * @return void
     */
    public function __construct()
    {
        $this->getRotas();
        $this->run();
    }

    /**
     * Função responsável por montar as rotas
     *
     * @return void
     */
    public function getRotas()
    {
        $this->_rotas['exchange'] = [
            'controller' => 'ExchangeController',
            'action' => 'converter'
        ];
    }

    /**
     * Função responsável por disparar as rotas
     *
     * @return void
     */
    public function run()
    {
        $request = explode('/', substr($_SERVER['REQUEST_URI'], '1'));
        $nome_controller = reset($request);
        try {
            if (!empty($request) && isset($this->_rotas[$nome_controller])) {
                $namespace = "App\\controllers\\";
                $namespace .= $this->_rotas[$nome_controller]['controller'];
                $controller = new $namespace;
                $action = $this->_rotas[$nome_controller]['action'];
                $controller->$action($request);
            } else {
                http_response_code(400);
            }
        } catch (Exception $e) {
            http_response_code(400);
        }

    }
}