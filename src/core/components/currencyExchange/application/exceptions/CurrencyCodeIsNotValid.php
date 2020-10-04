<?php

namespace App\core\components\currencyExchange\application\exceptions;

final class CurrencyCodeIsNotValid extends \Exception
{
    public function __construct($message = 'The currency is not valid', $code = 400)
    {
        parent::__construct($message, $code);
    }
}
