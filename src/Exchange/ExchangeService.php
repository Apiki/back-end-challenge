<?php
/**
 * Exchange service.
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

namespace App\Exchange;

use App\Http\BadRequestException;

/**
 * Convert exchange requests.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Eduardo Lopes <eduardo.frlopes@hotmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class ExchangeService
{
    /**
     * Supported exchange pairs.
     *
     * @var array<string, string>
     */
    private array $_supportedPairs = [
        'BRL:USD' => '$',
        'USD:BRL' => 'R$',
        'BRL:EUR' => '€',
        'EUR:BRL' => 'R$',
    ];

    /**
     * Convert an exchange request.
     *
     * @param ExchangeRequest $request Exchange request.
     *
     * @return array<string, float|string>
     * @throws BadRequestException
     */
    public function convert(ExchangeRequest $request): array
    {
        $pair = $request->getFrom() . ':' . $request->getTo();

        if (!array_key_exists($pair, $this->_supportedPairs)) {
            throw new BadRequestException();
        }

        return [
            'valorConvertido' => $request->getAmount() * $request->getRate(),
            'simboloMoeda' => $this->_supportedPairs[$pair],
        ];
    }
}
