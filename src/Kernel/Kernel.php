<?php

namespace App\Kernel;

use App\Kernel\Http\AbstractResponse;
use App\Kernel\Http\JsonResponse;
use App\Kernel\Http\RequestInterface;

class Kernel
{
    private $controllers;

    public function __construct(array $controllers, RequestInterface $request)
    {
        $this->controllers = $controllers;
        $this->request = $request;
    }

    public function execute()
    {
        $response = $this->forward();
        return $response;
    }

    private function forward(): ?AbstractResponse
    {
        $urlData = $this->request->getUrlData();
        foreach($this->controllers as $controller) {
            if($urlData['prefix'] == $controller::getPrefix()) {
                $controllerForwarded = new $controller;
                $response = $controllerForwarded->run($this->request);
                if(! is_null($response)) {
                    return $response;
                }
            }
        }
        
        $response = new JsonResponse($this->request);
        $response->setBody('');
        $response->setStatus(400);
        return $response;
    }

}
