<?php

/**
 * Back-end Challenge.
 *
 * PHP version 7.4+
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Application;
use App\Application\Controller\ExchangeController;
use App\Application\UseCase\ConvertCurrencyUseCase;
use App\Container;
use App\Infrastructure\Persistence\InMemoryCurrencyRepository;
use App\Domain\Model\Exchange\Service\CurrencyExchangeService;
use Symfony\Component\HttpFoundation\Request;

// Create container
$container = new Container();

// Register repositories
$container->register(
    'CurrencyRepository',
    static function () {
        return new InMemoryCurrencyRepository();
    }
);

// Register services
$container->register(
    'CurrencyExchangeService',
    static function ($c) {
        return new CurrencyExchangeService($c->get('CurrencyRepository'));
    }
);

$container->register(
    'ConvertCurrencyUseCase',
    static function ($c) {
        return new ConvertCurrencyUseCase(
            $c->get('CurrencyExchangeService'),
            $c->get('CurrencyRepository')
        );
    }
);

$container->register(
    ExchangeController::class,
    static function ($c) {
        return new ExchangeController($c->get('ConvertCurrencyUseCase'));
    }
);

// Load routes from config file
$routeLoader = include __DIR__ . '/../config/routes.php';
$routes = $routeLoader();

// Create request and run application
$request = Request::createFromGlobals();
$app = new Application($routes, $request, $container);
$app->run();
