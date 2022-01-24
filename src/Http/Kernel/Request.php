<?php

namespace App\Http\Kernel;

class Request
{
    public function getPath()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}
