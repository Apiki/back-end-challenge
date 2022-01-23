<?php

namespace App\Classes;

class Response
{

    /**
     * Retorna um JSON com a mensagem e código do status.
     * @param $message
     * @param $status
     * @return void
     */
    public static function catch($response, $status)
    {
        header("Content-type: application/json; charset=utf-8", 1, $status);
        echo json_encode($response);
        exit();
    }

}
