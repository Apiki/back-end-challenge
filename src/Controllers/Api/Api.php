<?php


namespace App\Controllers\Api;


use App\Core\Controller;

class Api extends Controller
{
    /** @var array|false */
    protected $headers;

    /** @var array|null */
    protected $response;

    public function __construct()
    {
        parent::__construct("/");

        header('Content-Type: application/json; charset=UTF-8');
        $this->headers = getallheaders();
    }

    protected function call(int $code, string $type = null, string $message = null, string $rule = "errors"): Api
    {
        http_response_code($code);

        if (!empty($type)) {
            $this->response = [
                $rule => [
                    "type" => $type,
                    "message" => (!empty($message) ? $message : null)
                ]
            ];
        }
        return $this;
    }

    protected function back(array $response = null): Api
    {
        if (!empty($response)) {
            $this->response = (!empty($this->response) ? array_merge($this->response, $response) : $response);
        }

        echo json_encode($this->response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return $this;
    }
}