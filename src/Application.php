<?php

/**
 * Application class for back-end challenge.
 *
 * PHP version 7.4+
 *
 * Handles request routing and dispatching.
 *
 * @category Challenge
 * @package  App
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RouteCollection;

/**
 * Application class.
 *
 * Handles request routing and controller dispatching.
 *
 * @category Challenge
 * @package  App
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class Application
{
    private RouteCollection $_routes;
    private Request $_request;
    private Container $_container;

    /**
     * Constructor.
     *
     * @param RouteCollection $routes    The application routes.
     * @param Request         $request   The HTTP request.
     * @param Container       $container The service container.
     */
    public function __construct(
        RouteCollection $routes,
        Request $request,
        Container $container
    ) {
        $this->_routes = $routes;
        $this->_request = $request;
        $this->_container = $container;
    }

    /**
     * Run the application.
     *
     * @return void
     */
    public function run(): void
    {
        $context = new RequestContext();
        $context->fromRequest($this->_request);

        $matcher = new UrlMatcher($this->_routes, $context);

        try {
            $parameters = $matcher->match($this->_request->getPathInfo());
            $this->_request->attributes->add($parameters);

            $response = $this->_dispatch($parameters);
            $response->send();
        } catch (ResourceNotFoundException $e) {
            $response = new JsonResponse([], Response::HTTP_NOT_FOUND);
            $response->send();
        } catch (\Exception $e) {
            error_log(
                'Error: ' . $e->getMessage() . ' - ' .
                $e->getFile() . ':' . $e->getLine()
            );
            $response = new JsonResponse(
                ['error' => $e->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
            $response->send();
        }
    }

    /**
     * Dispatch the request to the appropriate controller.
     *
     * @param array $parameters The route parameters.
     *
     * @return Response The response object.
     *
     * @throws Exception When controller instantiation fails.
     */
    private function _dispatch(array $parameters): Response
    {
        $controllerString = $parameters['_controller'];
        list($controllerClass, $methodName) = explode('::', $controllerString);

        try {
            // Get controller from container or instantiate
            if ($this->_container->has($controllerClass)) {
                $controller = $this->_container->get($controllerClass);
            } else {
                $controller = new $controllerClass(
                    $this->_container->get('CurrencyExchangeService')
                );
            }

            return $controller->$methodName($this->_request);
        } catch (\Exception $e) {
            error_log(
                'Dispatch error: ' . $e->getMessage() . ' - ' .
                $e->getFile() . ':' . $e->getLine()
            );
            throw $e;
        }
    }
}
