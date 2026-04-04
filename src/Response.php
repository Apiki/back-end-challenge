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
 * JSON response helper.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Hahuma <firminopetterson@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
final class Response
{
    /**
     * Send a JSON response and terminate.
     *
     * @param array<string, mixed> $data       Response data.
     * @param int                  $statusCode HTTP status code.
     *
     * @return never
     */
    public static function json(array $data, int $statusCode = 200): never
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_THROW_ON_ERROR);
        exit;
    }

    /**
     * Send a JSON error response and terminate.
     *
     * @param string $message    Error message.
     * @param int    $statusCode HTTP status code.
     *
     * @return never
     */
    public static function error(string $message, int $statusCode = 400): never
    {
        self::json(['error' => $message], $statusCode);
    }
}
