<?php 

namespace App\Controller;

use App\Http\Response;

class IndexController
{
    public function notFound()
    { 
        $response = new Response  ;
        $response->status(400)->toJSON(['error' => "Error"]);
    }
}