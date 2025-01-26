<?php

namespace App\DTO;

/**
 * Class ApiErrorDTO
 *
 * Represents an API error with a code, message, and optional data.
 */
class ApiErrorDTO
{
    /**
     * @var string The error code.
     */
    public string $error_code;

    /**
     * @var string The error message.
     */
    public string $error_message;

    /**
     * @var mixed Additional error data.
     */
    public $error_data;

    /**
     * ApiErrorDTO constructor.
     *
     * @param string $error_code The error code.
     * @param string $error_message The error message (optional).
     * @param mixed $error_data Additional error data (optional).
     */
    public function __construct(string $error_code, string $error_message = "", $error_data = null)
    {
        $this->error_code = $error_code;
        $this->error_message = $error_message;
        $this->error_data = $error_data;
    }

    /**
     * Returns the error details as an array.
     *
     * @return array The error details.
     */
    public function value(): array
    {
        return [
            "error_code" => $this->error_code,
            "error_message" => $this->error_message,
            "error_data" => $this->error_data,
        ];
    }
}