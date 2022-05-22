<?php

namespace App\Common\Http;

class Request extends HttpMessage
{
    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getUri()
    {
        if ($_SERVER["HTTP_HOST"] === "localhost") {
            return substr($_SERVER["REQUEST_URI"], strlen("/back-end-challenge"));
        }
        return $_SERVER['REQUEST_URI'];
    }

    public function getServerParams()
    {
        return $_POST;
    }

    public function getQueryParams()
    {
        return $_GET;
    }

    public function getParsedBody()
    {
        return file_get_contents("php://input");
    }
}
