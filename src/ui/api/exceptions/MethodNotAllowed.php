<?php

namespace App\ui\api\exceptions;

final class MethodNotAllowed extends \Exception
{
    public function __construct($message = 'Method Not Allowed', $code = 405)
    {
        parent::__construct($message, $code);
    }
}
