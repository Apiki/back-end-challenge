<?php

namespace App\Kernel\Http;

class Request implements RequestInterface
{
    public function __construct(string $path)
    {
        $this->path = $path; 
    }

    public function getUrlData(): array
    {
        $path = parse_url($this->path, PHP_URL_PATH);
        $urlParts = $this->splitPath($path);
        $urlData = [
            'path' => $path,
            'prefix' => '',
            'parameters' => $this->setParameters()
        ];

        foreach ($urlParts as $key => $part) {
            if ($key == 0) {
                $urlData['prefix'] = sprintf('/%s', $part);
            }
        }

        return $urlData;
    }

    private function splitPath()
    {
        $path = parse_url($this->path, PHP_URL_PATH);
        $sanitizeParts = [];
        $parts = explode('/', $path);
        foreach ($parts as $part) {
            if ($part === '') {
                continue;
            }

            $sanitizeParts[] = $part;
        }

        return $sanitizeParts;
    }

    private function setParameters()
    {
        $parts = $this->splitPath();
        array_shift($parts);
        return $parts;
    }
}
