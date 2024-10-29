<?php

/**
 * File: ExchangeView.php
 *
 * PHP version 7.4
 * 
 * This file contains the ExchangeView class, which handles JSON response formatting
 * for exchange operations within the application.
 *
 * @category View
 * @package  App\Views
 * @author   André Nascimento <andreadn0312@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/andrenascimento0312/andre-dedeus
 */

namespace App\Views;

/**
 * Class ExchangeView
 *
 * Handles JSON response formatting for exchange operations.
 *
 * @category View
 * @package  App\Views
 * @author   André Nascimento <andreadn0312@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/andrenascimento0312/andre-dedeus
 */
class ExchangeView
{
    /**
     * Sends a JSON response with the specified data and HTTP status code.
     *
     * @param array $data       The data to be encoded as JSON.
     * @param int   $statusCode The HTTP status code to set for the response.
     *
     * @return void
     */
    public static function returnJson(array $data, int $statusCode = 200): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
