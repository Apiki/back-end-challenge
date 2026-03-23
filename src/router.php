<?php
/**
 * Back-end Challenge Router.
 *
 * PHP version 7.4
 *
 * Router para o servidor embutido do PHP.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Jamerson Wesley <jamersonwesleyoliveira@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

if (php_sapi_name() === 'cli-server') {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $file = __DIR__ . $path;

    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/index.php';