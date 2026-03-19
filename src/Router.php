<?php
/**
 * Router.
 *
 * PHP version 7.4
 *
 * @category Challenge
 * @package  Back-end
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App;

/**
 * Class Router
 *
 * @category Challenge
 * @package  Back-end
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class Router
{
    /**
     * Handle the incoming request.
     *
     * @return void
     */
    public function handleRequest(): void
    {
        header('Content-Type: application/json');

        $uri = $_SERVER['REQUEST_URI'] ?? '';
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = preg_replace('#^/exchange#', '', $uri);

        $parts = explode('/', trim($uri, '/'));

        if (count($parts) < 4 || empty($parts[0])) {
            $this->_sendError('Missing required parameters.', 400);
            return;
        }

        list($amount, $from, $to, $rate) = $parts;

        if (!is_numeric($amount) || !is_numeric($rate)) {
            $this->_sendError('Invalid numeric value.', 400);
            return;
        }

        if ($from !== strtoupper($from) || $to !== strtoupper($to)) {
            $this->_sendError('Currency must be uppercase.', 400);
            return;
        }

        try {
            $converter = new CurrencyConverter();
            $result    = $converter->convert(
                (float) $amount,
                $from,
                $to,
                (float) $rate
            );

            http_response_code(200);
            echo json_encode($result);
        } catch (\InvalidArgumentException $e) {
            $this->_sendError($e->getMessage(), 400);
        }
    }

    /**
     * Send an error response.
     *
     * @param string $message The error message.
     * @param int    $code    The HTTP status code.
     *
     * @return void
     */
    private function _sendError(string $message, int $code): void
    {
        http_response_code($code);
        echo json_encode(['error' => $message]);
    }
}
