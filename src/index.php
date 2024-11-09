<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este será o arquivo chamado na execução dos testes automatizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Raphael Ceccato Pauli <raphaelcpauli@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/raphaelceccato/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';


use App\Controllers\ExchangeController;
use App\Utils\ControllerException;
use App\Utils\Router;
use App\Utils\RouteResponse;


$controller = new ExchangeController();


$router = new Router();


$router->get(
    "/^\/exchange\/(?P<value>.*)\/(?P<from>.*)\/(?P<to>.*)\/(?P<rate>.*)$/i",
    function (array $params) use ($controller) {
        $res = new RouteResponse();
        $res->content_type = "application/json";

        try {
            $result = $controller->exchange(
                $params["value"], $params["from"], $params["to"], $params["rate"]
            );
            $res->content = json_encode($result);
        }
        catch (ControllerException $ex) {
            $res->code = $ex->getCode();
            $res->content = json_encode([ "error" => $ex->getMessage() ]);
        }
        catch (Exception $ex) {
            $res->code = 500;
            $res->content = json_encode([ "error" => "Erro interno do servidor" ]);
            throw $ex;
        }

        $res->build();
    }
);



$router->get(
    "/.*/", function (array $params) {
        $res = new RouteResponse();
        $res->code = 400;
        $res->content_type = "application/json";
        $res->content = json_encode([ "error" => "Requisição inválida" ]);
        $res->build();
    }
);



$router->processRequest();
