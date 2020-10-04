<?php

namespace App\core\components\currencyExchange\application\exceptions;

final class MoneyAmountIsNotValid extends \Exception
{
    public function __construct($message = 'THe amount is not valid', $code = 400)
    {
        parent::__construct($message, $code);
    }
}
