<?php

/**
 * Success result for use case responses.
 *
 * PHP version 7.4+
 *
 * Represents a successful operation result.
 *
 * @category Challenge
 * @package  App\Application\Result
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App\Application\Result;

/**
 * Success class.
 *
 * Represents a successful operation result.
 *
 * @category Challenge
 * @package  App\Application\Result
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class Success extends Result
{
    /**
     * Constructor.
     *
     * @param mixed $data The success data.
     */
    public function __construct($data)
    {
        parent::__construct($data, null);
    }

    /**
     * Check if result is successful.
     *
     * @return bool Always true for Success.
     */
    public function isSuccess(): bool
    {
        return true;
    }

    /**
     * Check if result is a failure.
     *
     * @return bool Always false for Success.
     */
    public function isFailure(): bool
    {
        return false;
    }
}
