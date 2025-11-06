<?php
/**
 * Router class.
 *
 * PHP version 7.4
 *
 * @category Challenge
 * @package  Back-end
 * @author   Claude AI <claude@anthropic.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

namespace App;

/**
 * Router class to handle HTTP requests.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Claude AI <claude@anthropic.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class Router
{
    /**
     * Parse the request URI and extract parameters.
     *
     * @return array Array with parsed parameters or error
     */
    public function parseRequest(): array
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $path = parse_url($uri, PHP_URL_PATH);

        // Remove leading slash and split by /
        $parts = array_filter(explode('/', trim($path, '/')));

        // Remove 'exchange' from the path if present
        if (count($parts) > 0 && $parts[array_key_first($parts)] === 'exchange') {
            array_shift($parts);
            $parts = array_values($parts); // Re-index array
        }

        // We expect exactly 4 parameters
        if (count($parts) !== 4) {
            return ['error' => 'Missing parameters'];
        }

        [$amount, $from, $to, $rate] = $parts;

        return [
            'amount' => $amount,
            'from' => $from,
            'to' => $to,
            'rate' => $rate,
        ];
    }
}
