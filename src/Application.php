<?php

namespace App;

use App\Http\Kernel\Router\Router;
use App\Http\Kernel\Request;
use App\Http\Kernel\Response;

class Application
{
    private $router;
    private $request;
    private $response;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request);
    }

    /**
     * @return Router
     */
    public function getRouter(): Router
    {
        return $this->router;
    }

    /**
     * @return void
     */
    public function run()
    {
        try {
            $result = $this->router->dispatch();
            $this->response->json($result);
        } catch (\Exception $e) {
            $this->response->error();
        }
    }
}
