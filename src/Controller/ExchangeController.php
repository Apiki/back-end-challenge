<?php
declare(strict_types=1);

namespace App\Controller;

use App\Validation\ExchangeRequestValidator;
use App\Service\ExchangeService;
use App\Http\JsonResponse;
use App\Utils\Url;

class ExchangeController
{
    private ExchangeService $exchangeService;
    private ExchangeRequestValidator $validator;
    private Url $common;

    public function __construct(
        ExchangeService          $exchangeService,
        ExchangeRequestValidator $validator,
        Url                      $common
    )
    {
        $this->exchangeService = $exchangeService;
        $this->validator = $validator;
        $this->common = $common;
    }

    public function handle(string $requestUri): void
    {
        $segments = $this->common->getExtractSegments($requestUri);

        $validation = $this->validator->validate($segments);

        if ($validation['valid'] !== true) {
            JsonResponse::send(['error' => $validation['message']], 400);
            return;
        }

        [$amount, $from, $to, $rate] = $validation['segments'];

        $result = $this->exchangeService->convert(
            (float)$amount,
            $from,
            $to,
            (float)$rate
        );

        if ($result === null) {
            JsonResponse::send(['error' => 'Unsupported currency conversion.'], 400);
            return;
        }

        JsonResponse::send($result, 200);
    }


}
