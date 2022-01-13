<?php

namespace App\Kernel\Http;

interface RequestInterface
{
    public function getUrlData(): array;
}
