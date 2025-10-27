<?php

/**
 * ExchangeConversionResponse data transfer object.
 *
 * PHP version 7.4+
 *
 * Represents an exchange conversion response.
 *
 * @category Challenge
 * @package  App\Application\DTO
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App\Application\DTO;

/**
 * ExchangeConversionResponse class.
 *
 * Data transfer object for exchange conversion responses.
 *
 * @category Challenge
 * @package  App\Application\DTO
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class ExchangeConversionResponse
{
    /**
     * Constructor.
     *
     * @param float  $valorConvertido The converted amount value.
     * @param string $simboloMoeda    The target currency symbol.
     */
    public function __construct(
        private float $valorConvertido,
        private string $simboloMoeda,
    ) {
    }

    /**
     * Get the converted amount.
     *
     * @return float The converted amount value.
     */
    public function getValorConvertido(): float
    {
        return $this->valorConvertido;
    }

    /**
     * Get the currency symbol.
     *
     * @return string The target currency symbol.
     */
    public function getSimboloMoeda(): string
    {
        return $this->simboloMoeda;
    }

    /**
     * Convert the response to an array.
     *
     * @return array The response as an array.
     */
    public function toArray(): array
    {
        return [
            'valorConvertido' => $this->valorConvertido,
            'simboloMoeda' => $this->simboloMoeda,
        ];
    }
}
