<?php
/**
 * Back-end Challenge.
 *
 * PHP version 8.1
 *
 * @category Challenge
 * @package  Back-end
 * @author   Hahuma <firminopetterson@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

namespace App;

/**
 * Request router.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Hahuma <firminopetterson@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
final class Router
{
    /**
     * Handle the incoming request.
     *
     * @return void
     */
    public static function handle(): void
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '';

        if (!is_string($uri)) {
            Response::error('Invalid request.');
        }

        $path = parse_url($uri, PHP_URL_PATH);

        if (!is_string($path)) {
            Response::error('Invalid request.');
        }

        $replaced = preg_replace('#^/exchange/?#', '', $path);
        $path = is_string($replaced) ? $replaced : '';
        $parts = explode('/', $path);
        $filter = static fn (string $s): bool => $s !== '';
        $segments = array_values(array_filter($parts, $filter));

        try {
            $params = Validator::validate($segments);
        } catch (ValidationException $e) {
            Response::error($e->getMessage());
        }

        $result = Converter::convert(
            $params['amount'],
            $params['to'],
            $params['rate']
        );

        Response::json($result);
    }
}
