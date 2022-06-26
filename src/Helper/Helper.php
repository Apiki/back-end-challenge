<?php

namespace App\Helper;

class Helper
{
    protected string|array|false $headers;
    private array $response;

    public function __construct()
    {
        header('Content-Type: application/json; charset=UTF-8');
        $this->headers = getallheaders();
    }

    /**
     * @param int $code
     * @param string|null $type
     * @param string|null $message
     * @return $this
     */
    protected function calling(int $code, string $type = null, string $message = null): self
    {
        http_response_code($code);

        if (! empty($type)) {
            $this->response = [
                'errors' => [
                    "type" => $type,
                    "message" => $message
                ]
            ];
        }
        return $this;
    }

    /**
     * @param array|null $response
     * @return $this
     */
    protected function returnBack(array $response = null): self
    {
        if (!empty($response)) {
            $this->response = (!empty($this->response) ? array_merge($this->response, $response) : $response);
        }

        echo json_encode($this->response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return $this;
    }
}