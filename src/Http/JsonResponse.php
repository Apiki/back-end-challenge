<?php
/**
 * JSON response.
 *
 * PHP version 7.4
 *
 * @category Challenge
 * @package  Back-end
 * @author   Eduardo Lopes <eduardo.frlopes@hotmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App\Http;

/**
 * Send JSON responses.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Eduardo Lopes <eduardo.frlopes@hotmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class JsonResponse
{
    /**
     * Response payload.
     *
     * @var array<string, mixed>
     */
    private array $_data;

    /**
     * Response status code.
     *
     * @var int
     */
    private int $_statusCode;

    /**
     * Create a JSON response.
     *
     * @param array<string, mixed> $data       Response payload.
     * @param int                  $statusCode HTTP status code.
     */
    public function __construct(array $data, int $statusCode = 200)
    {
        $this->_data = $data;
        $this->_statusCode = $statusCode;
    }

    /**
     * Send the response.
     *
     * @return void
     */
    public function send(): void
    {
        http_response_code($this->_statusCode);
        header('Content-Type: application/json');

        echo json_encode($this->_data);
    }
}
