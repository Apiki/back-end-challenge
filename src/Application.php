<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este será o arquivo chamado na pelo index para executar a classe application.
 *
 * @category Application
 * @package  Back-end
 * @author   Nick Granados <internickbr@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/internick2017/back-end-challenge
 */
namespace App;

/**
 * Application Class
 *
 * @category Application
 * @package  Back-end
 * @author   Nick Granados <internickbr@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/internick2017/back-end-challenge
 */
class Application
{

    /**
     *  Caminho para o diretório principal
     *
     * @var string
     */
    public static string $ROOT_DIR;
    /**
     *  Classe Router
     *
     * @var Router
     */
    public Router $router;
    /**
     * Classe Request
     *
     * @var Request
     */
    public Request $request;
    /**
     * Classe Response
     *
     * @var Response
     */
    public Response $response;
    /**
     * Classe Application
     *
     * @var Application
     */
    public  static Application $app;

    /**
     * Construtor da classe Application
     *
     * @param $rootPath // Caminho para o diretório principal
     */
    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    /**
     * Função que corre a aplicação
     *
     * @param mixed $callback Função callback
     *
     * @return void
     */
    public function run($callback): void
    {
        $this->router->resolve();
        echo $callback($this->request, $this->response, $this->router);
    }
}