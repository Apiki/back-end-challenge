<?php

namespace App\Common\Http;

class Response extends HttpMessage
{
    public function getStatusCode()
    {
        return http_response_code();
    }

    public function withStatus(int $code)
    {
        return http_response_code($code);
    }

    public function send()
    {
        foreach ($this->headers as $key => $value) {
            header("{$key}: {$value}");
        }
    }
}
