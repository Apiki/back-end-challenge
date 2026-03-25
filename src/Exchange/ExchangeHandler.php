<?php
namespace App\Exchange;

class ExchangeHandler
{
    private const PARAM_AMOUNT = 1;
    private const PARAM_FROM   = 2;
    private const PARAM_TO     = 3;
    private const PARAM_RATE   = 4;

    public function handle(string $requestUri): void
    {
        $parts = $this->parsePath($requestUri);

        if (count($parts) !== 5) :
            $this->respondError(400, ExchangeConfig::ERROR_MESSAGES['INVALID_ROUTE']);
        endif;

        if ($parts[0] !== ExchangeConfig::ROUTE) :
            $this->respondError(404, ExchangeConfig::ERROR_MESSAGES['INVALID_ROUTE']);
        endif;

        if (
            !is_numeric($parts[self::PARAM_AMOUNT])
            || (float) $parts[self::PARAM_AMOUNT] <= 0
        ) :
            $this->respondError(400, ExchangeConfig::ERROR_MESSAGES['INVALID_AMOUNT']);
        endif;

        if (
            !is_numeric($parts[self::PARAM_RATE])
            || (float) $parts[self::PARAM_RATE] <= 0
        ) :
            $this->respondError(400, ExchangeConfig::ERROR_MESSAGES['INVALID_RATE']);
        endif;

        $from = trim($parts[self::PARAM_FROM]);
        $to   = trim($parts[self::PARAM_TO]);

        if (
            !in_array($from, ExchangeConfig::PERMITTED_CURRENCIES, true)
            || !in_array($to, ExchangeConfig::PERMITTED_CURRENCIES, true)
        ) :
            $this->respondError(400, ExchangeConfig::ERROR_MESSAGES['INVALID_CURRENCY']);
        endif;

        $amount = (float) trim($parts[self::PARAM_AMOUNT]);
        $rate   = (float) trim($parts[self::PARAM_RATE]);
        $result = $amount * $rate;

        $this->respondSuccess([
            'valorConvertido' => round($result, 2),
            'simboloMoeda' => ExchangeConfig::SIGN_SYMBOL[$to],
        ]);
    }

    private function parsePath(string $requestUri): array
    {
        $path = parse_url($requestUri, PHP_URL_PATH);

        if (!is_string($path)) :
            return [];
        endif;

        return explode('/', trim($path, '/'));
    }

    private function respondError(int $statusCode, string $message): void
    {
        http_response_code($statusCode);
        echo json_encode(['erro' => $message]);
        exit;
    }

    private function respondSuccess(array $payload): void
    {
        echo json_encode($payload);
    }
}
