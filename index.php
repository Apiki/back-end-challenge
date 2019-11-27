<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.2
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Iago S. <146050u54@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$router = new League\Route\Router;

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

class Convertion {
    private $amount;
    private $rate;
    private $currency_from;
    private $currency_to;

    private static $casting = ['BRL' => 'R$', 'USD' => '$', 'EUR' => '€'];

    public function __construct(float $amount, float $rate, string $currency_from, string $currency_to) {
        if (!is_numeric($amount) || !is_numeric($rate) || !is_string($currency_to) || $amount < 0 || $rate < 0 ||
            !self::is_convertion_supported(strtoupper($currency_from), strtoupper($currency_to))
        ) {
            throw new Exception();
        }

        $this->amount = $amount;
        $this->rate = $rate;
        $this->currency_from = $currency_from;
        $this->currency_to = $currency_to;
    }

    private static function is_convertion_supported($from, $to) : bool {
        $possible_currencies = array_keys(self::$casting);
        $combination = $from[0] . $to[0];
        if (
            !in_array($from, $possible_currencies) ||
            !in_array($to, $possible_currencies) ||
            !in_array($combination, ['BU', 'BE', 'UB', 'EB'])
        ) {
            return false;
        }

        return true;
    }

    protected function get_currency() : string {
        if (isset(self::$casting[$this->currency_from])) {
            return self::$casting[$this->currency_to];
        }

        throw new Exception();
    }

    protected function get_value() : float {
        return $this->amount * $this->rate;
    }

    public function __get($attribute) {
        if ($attribute === 'currency') {
            return $this->get_currency();
        }

        if ($attribute === 'value') {
            return $this->get_value();
        }

        if (property_exists(self::class, $attribute)) {
            return $this->$attribute;
        }

        throw new Exception('');
    }
}


$router->map('GET', '/exchange/{amount}/{from}/{to}/{rate}', function (ServerRequestInterface $request, array $args) : ResponseInterface {
    $amount = $args['amount'];
    $currency_from = $args['from'];
    $currency_to = $args['to'];
    $rate = $args['rate'];

    $converter = new Convertion((float) $amount, (float) $rate, $currency_from, $currency_to);

    return new Zend\Diactoros\Response\JsonResponse([
        'valorConvertido' => $converter->value,
        'simboloMoeda' => $converter->currency
    ]);
});

try {
    $response = $router->dispatch($request);
} catch (Exception $exception) {
    $response = new Zend\Diactoros\Response\JsonResponse(['error' => 'we can\'t perform this action'], 400);
} finally {
    (new Zend\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
}