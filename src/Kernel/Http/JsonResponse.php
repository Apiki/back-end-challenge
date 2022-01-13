<?php

namespace App\Kernel\Http;

class JsonResponse extends AbstractResponse
{
    private $body;

    public function setBody($body): AbstractResponse
    {
        $this->body = $body;

        return $this;
    }

    public function send()
    {
        http_response_code($this->getStatus());
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($this->body);
        die();
    }
}
