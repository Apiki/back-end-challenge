<?php
namespace App\Kernel;

use App\Kernel\Http\AbstractResponse;
use App\Kernel\Http\RequestInterface;

class Route
{
    public function __construct(string $path, array $callback, RequestInterface $request)
    {
        $this->path = $path;
        $this->callback = $callback;
        $this->request = $request;
    }

    public function execute(): ?AbstractResponse
    {
        $method = new \ReflectionMethod($this->callback[0], $this->callback[1]);
        $request = $this->request;
        $num = $method->getNumberOfParameters();
        $data = $request->getUrlData();

        if($num == count($data['parameters'])) {
            $response = call_user_func_array($this->callback, $data['parameters']);
            return $response;
        }

        return null;
    }

    public function getResponse(): ?AbstractResponse
    {
        return $this->response;
    }
}
