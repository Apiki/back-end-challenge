<?php
/**
 * Response class.
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
 * Response class to handle HTTP responses.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Claude AI <claude@anthropic.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class Response
{
    /**
     * Send a JSON response with status code.
     *
     * @param array $data       Data to send
     * @param int   $statusCode HTTP status code
     *
     * @return void
     */
    public function json(array $data, int $statusCode = 200): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    /**
     * Send an error response.
     *
     * @param string $message    Error message
     * @param int    $statusCode HTTP status code
     *
     * @return void
     */
    public function error(string $message, int $statusCode = 400): void
    {
        $this->json(['error' => $message], $statusCode);
    }
}
