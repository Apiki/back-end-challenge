<?php
/**
 * API routes.
 *
 * PHP version 7.4
 *
 * @category Challenge
 * @package  Back-end
 * @author   Leonardo Silva <leonardosilvadelima534@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
use App\Controllers\ExchangeController;
use App\Router;

return function (Router $router) {
    $router->get(
        '/exchange/{amount}/{from}/{to}/{rate}',
        [ExchangeController::class, 'handle']
    );
};
