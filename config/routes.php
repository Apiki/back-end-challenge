<?php

/**
 * Application Routes Configuration.
 *
 * PHP version 7.4+
 *
 * Define all application routes using Symfony Routing components.
 *
 * @category Challenge
 * @package  Config
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * Create and return the application route collection.
 *
 * @return RouteCollection The configured route collection.
 */
return function (): RouteCollection {
    $routes = new RouteCollection();

    $routes->add(
        'exchange',
        new Route(
            '/exchange/{amount}/{from}/{to}/{rate}',
            [
                '_controller' => 'App\Application\Controller\ExchangeController::exchange',
            ],
            [
                'amount' => '[^/]+',
                'from' => '[^/]+',
                'to' => '[^/]+',
                'rate' => '[^/]+',
            ],
            [],
            '',
            [],
            ['GET']
        )
    );

    $routes->add(
        'exchange_root',
        new Route(
            '/exchange/',
            [
                '_controller' => 'App\Application\Controller\ExchangeController::invalid',
            ],
            [],
            [],
            '',
            [],
            ['GET']
        )
    );

    $routes->add(
        'exchange_invalid',
        new Route(
            '/exchange/{path}',
            [
                '_controller' => 'App\Application\Controller\ExchangeController::invalid',
            ],
            ['path' => '.+'],
            [],
            '',
            [],
            ['GET']
        )
    );

    return $routes;
};
