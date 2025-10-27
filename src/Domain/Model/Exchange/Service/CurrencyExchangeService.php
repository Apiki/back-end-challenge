<?php

/**
 * Currency exchange service.
 *
 * PHP version 7.4+
 *
 * Handles currency conversion operations.
 *
 * @category Challenge
 * @package  App\Domain\Model\Exchange\Service
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App\Domain\Model\Exchange\Service;

use App\Application\DTO\ExchangeConversionResponse;
use App\Domain\Model\Exchange\Repository\ICurrencyRepository;
use App\Domain\Model\Exchange\ValueObject\Amount;
use App\Domain\Model\Exchange\ValueObject\Currency;
use App\Domain\Model\Exchange\ValueObject\ExchangeRate;

/**
 * CurrencyExchangeService class.
 *
 * Handles currency conversion operations.
 *
 * @category Challenge
 * @package  App\Domain\Model\Exchange\Service
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class CurrencyExchangeService
{
    /**
     * Constructor.
     *
     * @param ICurrencyRepository $currencyRepository The currency repository.
     */
    public function __construct(
        private ICurrencyRepository $currencyRepository
    ) {
    }

    /**
     * Convert currency amount.
     *
     * @param Amount       $amount The amount to convert.
     * @param Currency     $from   The source currency.
     * @param Currency     $to     The target currency.
     * @param ExchangeRate $rate   The exchange rate.
     *
     * @return ExchangeConversionResponse The conversion result.
     */
    public function convert(
        Amount $amount,
        Currency $from,
        Currency $to,
        ExchangeRate $rate
    ): ExchangeConversionResponse {
        $converted = $amount->multiply($rate->getValue());
        $symbol = $this->currencyRepository->getSymbol($to->getCode());

        return new ExchangeConversionResponse($converted, $symbol);
    }
}
