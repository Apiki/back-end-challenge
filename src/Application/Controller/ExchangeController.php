<?php

/**
 * ExchangeController for REST API.
 *
 * PHP version 7.4+
 *
 * Handles currency exchange requests.
 *
 * @category Challenge
 * @package  App\Application\Controller
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App\Application\Controller;

use App\Application\DTO\Factory\ExchangeRequestFactory;
use App\Application\UseCase\ConvertCurrencyUseCase;
use App\Domain\Model\Exchange\Exception\InvalidAmountException;
use App\Domain\Model\Exchange\Exception\InvalidCurrencyException;
use App\Domain\Model\Exchange\Exception\InvalidRateException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * ExchangeController class.
 *
 * Handles REST API requests for currency exchange.
 *
 * @category Challenge
 * @package  App\Application\Controller
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class ExchangeController
{
    /**
     * Constructor.
     *
     * @param ConvertCurrencyUseCase $convertCurrencyUseCase The use case.
     */
    public function __construct(
        private ConvertCurrencyUseCase $convertCurrencyUseCase
    ) {
    }

    /**
     * Handle currency exchange requests.
     *
     * @param Request $request The HTTP request.
     *
     * @return JsonResponse The JSON response.
     */
    public function exchange(Request $request): JsonResponse
    {
        try {
            // Create DTO from request using factory
            $exchangeRequest = ExchangeRequestFactory::fromRequest($request);

            // Execute use case
            $result = $this->convertCurrencyUseCase->execute($exchangeRequest);

            // Handle Result pattern
            if ($result->isSuccess()) {
                $response = $result->getData();
                return new JsonResponse($response->toArray());
            }

            return new JsonResponse([], Response::HTTP_BAD_REQUEST);
        } catch (InvalidAmountException | InvalidCurrencyException |
            InvalidRateException $e) {
            return new JsonResponse([], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            return new JsonResponse([], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Handle invalid exchange requests.
     *
     * @param Request $request The HTTP request.
     *
     * @return JsonResponse The JSON response.
     */
    public function invalid(Request $request): JsonResponse
    {
        return new JsonResponse([], Response::HTTP_BAD_REQUEST);
    }
}
