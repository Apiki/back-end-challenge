<?php

namespace App\Helpers;

use Symfony\Component\Intl\Currencies;

class ExchangeValidator
{
    public static function validate($amount, $from, $to, $rate)
    {
        $errorMsg = [];

        $isValidAmount = self::validateValue($amount);
        if ($isValidAmount !== true) {
            $errorMsg['amount'] = $isValidAmount['msg'];
        }

        $isValidFrom = self::validateCurrency($from);
        if ($isValidFrom !== true) {
            $errorMsg['from'] = $isValidFrom['msg'];
        }

        $isValidTo = self::validateCurrency($to);
        if ($isValidTo !== true) {
            $errorMsg['to'] = $isValidTo['msg'];
        }

        $isValidRate = self::validateValue($rate);
        if ($isValidRate !== true) {
            $errorMsg['rate'] = $isValidRate['msg'];
        }

        if (sizeof($errorMsg) > 0) {
            foreach ($errorMsg as $key => $value) {
                $msg[$key] = $value;
            }
            return json_encode($msg);
        }

        return true;
    }

    private static function validateValue($value)
    {
        if (strpos($value, ',')) {
            $value = str_replace('.', '', $value);
            $value = str_replace(',', '.', $value);
        }
        if (empty($value) || null === $value || !is_numeric($value)) {
            return array('msg' => 'Formato inválido de valor.');
        }
        return true;
    }

    private static function validateCurrency($type)
    {
        if (!Currencies::exists($type)) {
            return array('msg' => 'Formato inválido de moeda.');
        }
        return true;
    }
}
