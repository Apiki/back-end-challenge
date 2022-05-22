<?php

namespace App\Kernel\Http;

abstract class AbstractResponse
{
    protected $code = 200;
    abstract public function setBody($body): AbstractResponse;
    abstract public function send();

    public function __construct(RequestInterface $request = null)
    {
        $this->request = $request;
    }

    public function getRequest(): ?RequestInterface
    {
        return $this->request;
    }

    public function setStatus(int $code)
    {
        $this->code = $code;
        return $this;
    }

    public function getStatus(): int
    {
        return $this->code;
    }
}
