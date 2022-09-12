<?php

/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Pedro Henrique da Silva <pedrohenriquedasilva100@yahoo.com.br>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\Controller\Api;
use App\Controller\HttpStatus;

$status = new HttpStatus();
$status->statusVerification();

$objFeedController = new Api();

$amount = (float) @$status->getUri()[2];
$from = @$status->getUri()[3];
$to = @$status->getUri()[4];
$rate = (float) @$status->getUri()[5];
echo $objFeedController->conversion($amount, $from, $to, $rate);
