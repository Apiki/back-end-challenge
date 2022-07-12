<?php 

namespace App\Http;

class Request
{
    public $Params;
    public $Method;
    public $Type;   

    public function getFull()
    {
        $full = [];
        foreach ($_POST as $ID => $value) {
            $full[$ID] = filter_input(INPUT_POST, $ID, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        return $full;
    }

    public function getJSON()
    {     
        $full_inner = trim(file_get_contents("php://input"));
        $full_cod = json_decode($full_inner);
        return $full_cod;
    }

    public function __construct($Params = [])
    {
        $this->params = $Params;
        $this->Method = trim($_SERVER['REQUEST_METHOD']);
        $this->Type = !empty($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    }
}