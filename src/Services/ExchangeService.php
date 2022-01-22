<?php

namespace App\Services;

use App\Models\Currency;
use Exception;

class ExchangeService
{
    /**
     * @throws Exception
     */
    public function convert(Currency $from, Currency $to, $amount, $rate)
    {
        if (!is_numeric($amount) or $amount < 0)
            throw new Exception("Amount is not valid");

        if (!is_numeric($rate) or $rate < 0)
            throw new Exception("Rate is not valid");

        return $amount * $rate;
    }
}
