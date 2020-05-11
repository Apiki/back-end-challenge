<?php

namespace App\Helpers;

use Symfony\Component\Intl\Currencies;

class ExchangeValidator
{
    public static function validate($request, $response)
    {
        $error = 0;

        $isValidAmount = self::validateValue($request->getAttribute('amount'));
        if ($isValidAmount !== true) {
            $error++;
            $response->getBody()->write(json_encode(['error'=> 'Bad Request']));
            return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(400);
        }

        $isValidFrom = self::validateCurrency($request->getAttribute('from'));
        if ($isValidFrom !== true) {
            $error++;
            $response->getBody()->write(json_encode(['error'=> 'Bad Request']));
            return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(400);
        }

        $isValidTo = self::validateCurrency($request->getAttribute('to'));
        if ($isValidTo !== true) {
            $error++;
            $response->getBody()->write(json_encode(['error'=> 'Bad Request']));
            return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(400);
        }

        $isValidRate = self::validateValue($request->getAttribute('rate'));
        if ($isValidRate !== true) {
            $error++;
            $response->getBody()->write(json_encode(['error'=> 'Bad Request']));
            return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(400);
        }

        if ($error > 0) {
            $response->getBody()->write(json_encode(['error'=> 'Bad Request']));
            return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(400);
        }

        return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
    }

    private static function validateValue($value)
    {
        if (strpos($value, ',')) {
            $value = str_replace('.', '', $value);
            $value = str_replace(',', '.', $value);
        }
        if (empty($value) || null === $value || !is_numeric($value) || ($value < 0)) {
            return false;
        }
        return true;
    }

    private static function validateCurrency($type)
    {
        if (!Currencies::exists($type)) {
            return false;
        }
        return true;
    }
}
