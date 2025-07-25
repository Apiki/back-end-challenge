<?php
/**
 * Exchange Controller.
 *
 * PHP version 8.3
 *
 * @category Challenge
 * @package  Back-end
 * @author   Lucas Sens <lucassousase@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App;

/**
 * Currency exchange controller.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Lucas Sens <lucassousase@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class ExchangeController
{
    private ExchangeService $_exchangeService;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->_exchangeService = new ExchangeService();
    }

    /**
     * Process currency exchange request.
     *
     * @return void
     */
    public function handleRequest(): void
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '';
        $path = parse_url($uri, PHP_URL_PATH);
        
        if (!$path) {
            $this->_sendErrorResponse('Invalid URL', 400);
            return;
        }

        $segments = explode('/', trim($path, '/'));
        
        if (count($segments) !== 5 || $segments[0] !== 'exchange') {
            $this->_sendErrorResponse('Invalid URL format', 400);
            return;
        }

        $amount = $segments[1];
        $from = $segments[2];
        $to = $segments[3];
        $rate = $segments[4];

        try {
            $result = $this->_exchangeService->convert($amount, $from, $to, $rate);
            $this->_sendSuccessResponse($result);
        } catch (\InvalidArgumentException $e) {
            $this->_sendErrorResponse($e->getMessage(), 400);
        } catch (\Exception $e) {
            $this->_sendErrorResponse('Internal server error', 500);
        }
    }

    /**
     * Send success response.
     *
     * @param array $data Response data
     *
     * @return void
     */
    private function _sendSuccessResponse(array $data): void
    {
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Send error response.
     *
     * @param string $message    Error message
     * @param int    $statusCode HTTP status code
     *
     * @return void
     */
    private function _sendErrorResponse(string $message, int $statusCode): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode(['error' => $message], JSON_UNESCAPED_UNICODE);
    }
} 
