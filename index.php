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
 * @author   Pedro Paulo Mauro e Silva <p.paulo0512@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/src/Api.php';

if(isset($_SERVER['REQUEST_URI'])){
    print_r(Api::checkUrl($_SERVER['REQUEST_URI']));
}
