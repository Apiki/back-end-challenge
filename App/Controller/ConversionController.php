<?php 

namespace App\Controller;

use App\Lib\Response;

class ConversionController
{
    public function notFound()
    { 
        $res = new Response  ;
        $res->status(400)->toJSON(['error' => "Not Found"]);
    }
}