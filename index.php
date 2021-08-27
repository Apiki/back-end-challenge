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
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);


$router->group("exchange");
$router->get("/{amount}/{from}/{to}/{rate}", function ($data) {
    $to = $data['to'];
    $amount = floatval($data['amount']);
    $rate = floatval($data['rate']);
    
    $finalResult = (object) [
        'valorConvertido' => $amount * $rate,
      ];

      if ($to === 'BRL') {
          $finalResult -> simboloMoeda = 'R$';
      }
      if ($to === 'USD') {
        $finalResult -> simboloMoeda = '$';
    }
    if ($to === 'EUR') {
        $finalResult -> simboloMoeda = '₤';
    }

    echo json_encode($finalResult);
});

$router->dispatch();