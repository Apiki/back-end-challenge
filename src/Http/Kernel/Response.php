<?php

namespace App\Http\Kernel;

class Response
{
    public function json($data)
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }

    public function error()
    {
        http_response_code(400);
        $this->json(['success' => false]);
    }
}
