<?php

/**
 * ConvertCurrencyUseCase.
 *
 * PHP version 7.4+
 *
 * Application service for currency conversion use case.
 *
 * @category Challenge
 * @package  App\Application\UseCase
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\DTO\ExchangeConversionRequest;
use App\Application\DTO\ExchangeConversionResponse;
use App\Application\Result\Result;
use App\Application\Result\Success;
use App\Application\Result\Failure;
use App\Domain\Model\Exchange\ValueObject\Amount;
use App\Domain\Model\Exchange\ValueObject\Currency;
use App\Domain\Model\Exchange\Exception\InvalidAmountException;
use App\Domain\Model\Exchange\Exception\InvalidCurrencyException;
use App\Domain\Model\Exchange\Exception\InvalidRateException;
use App\Domain\Model\Exchange\Repository\ICurrencyRepository;
use App\Domain\Model\Exchange\ValueObject\ExchangeRate;
use App\Domain\Model\Exchange\Service\CurrencyExchangeService;

/**
 * ConvertCurrencyUseCase class.
 *
 * Handles the currency conversion use case orchestration.
 *
 * @category Challenge
 * @package  App\Application\UseCase
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class ConvertCurrencyUseCase
{
    /**
     * Constructor.
     *
     * @param CurrencyExchangeService $exchangeService    The exchange service.
     * @param ICurrencyRepository     $currencyRepository The currency repository.
     */
    public function __construct(
        private CurrencyExchangeService $exchangeService,
        private ICurrencyRepository $currencyRepository
    ) {
    }

    /**
     * Execute the currency conversion use case.
     *
     * @param ExchangeConversionRequest $request The exchange conversion request DTO.
     *
     * @return Result The conversion result wrapped in Result pattern.
     *
     * @throws InvalidCurrencyException When currency is invalid.
     * @throws InvalidAmountException   When amount is invalid.
     * @throws InvalidRateException     When rate is invalid.
     */
    public function execute(ExchangeConversionRequest $request): Result
    {
        try {
            // Validate currencies
            if (!$this->currencyRepository->isValid($request->from)) {
                throw new InvalidCurrencyException(
                    "Unsupported currency: {$request->from}"
                );
            }

            if (!$this->currencyRepository->isValid($request->to)) {
                throw new InvalidCurrencyException(
                    "Unsupported currency: {$request->to}"
                );
            }

            // Create value objects with validation
            $amount = new Amount($request->amount);
            $fromCurrency = new Currency($request->from);
            $toCurrency = new Currency($request->to);
            $exchangeRate = new ExchangeRate($request->rate);

            // Execute the service
            $response = $this->exchangeService->convert(
                $amount,
                $fromCurrency,
                $toCurrency,
                $exchangeRate
            );

            return new Success($response);
        } catch (
            InvalidCurrencyException |
            InvalidAmountException |
            InvalidRateException $e
        ) {
            return new Failure($e->getMessage());
        }
    }
}
