<?php

/**
 * Result abstraction for use case responses.
 *
 * PHP version 7.4+
 *
 * Base class for Result pattern implementation.
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
 * Result class.
 *
 * Abstract base class for Result pattern implementation.
 *
 * @category Challenge
 * @package  App\Application\Result
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
abstract class Result
{
    /**
     * The result data.
     *
     * @var mixed
     */
    private $_data;

    /**
     * The error message if any.
     *
     * @var string|null
     */
    private $_error;

    /**
     * Constructor.
     *
     * @param mixed       $data  The result data.
     * @param string|null $error The error message.
     */
    public function __construct($data = null, ?string $error = null)
    {
        $this->_data = $data;
        $this->_error = $error;
    }

    /**
     * Get the result data.
     *
     * @return mixed The data.
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * Get the error message.
     *
     * @return string|null The error message.
     */
    public function getError(): ?string
    {
        return $this->_error;
    }

    /**
     * Check if result is successful.
     *
     * @return bool True if successful.
     */
    abstract public function isSuccess(): bool;

    /**
     * Check if result is a failure.
     *
     * @return bool True if failure.
     */
    abstract public function isFailure(): bool;
}
