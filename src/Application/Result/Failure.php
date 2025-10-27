<?php

/**
 * Failure result for use case responses.
 *
 * PHP version 7.4+
 *
 * Represents a failed operation result.
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
 * Failure class.
 *
 * Represents a failed operation result.
 *
 * @category Challenge
 * @package  App\Application\Result
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class Failure extends Result
{
    /**
     * Constructor.
     *
     * @param string $error The error message.
     */
    public function __construct(string $error)
    {
        parent::__construct(null, $error);
    }

    /**
     * Check if result is successful.
     *
     * @return bool Always false for Failure.
     */
    public function isSuccess(): bool
    {
        return false;
    }

    /**
     * Check if result is a failure.
     *
     * @return bool Always true for Failure.
     */
    public function isFailure(): bool
    {
        return true;
    }
}
