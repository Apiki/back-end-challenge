<?php

namespace App\Common\Http;

abstract class HttpMessage
{
    protected $headers;

    public function getHeaders(): array
    {
        return getallheaders();
    }

    public function hasHeader(string $name): bool
    {
        return (isset($this->getHeaders()[$name]) ? true : false);
    }

    public function getHeader(string $name)
    {
        if ($this->hasHeader($name)) {
            return [$name => $this->getHeaders()[$name]];
        }

        return [];
    }

    public function getHeaderLine(string $name)
    {
        if ($this->hasHeader($name)) {
            return $this->getHeaders()[$name];
        }

        return "";
    }

    public function withHeader(string $name, $value)
    {
        $this->headers[$name] = $value;
        return $this;
    }
}
