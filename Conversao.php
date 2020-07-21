<?php
namespace Src\Conversao;

class Conversao {

    public function verificarRequest($uri)
    {
        if ($uri[1] !== 'exchange' || $uri[2] == "" || $uri[2] == ""  || $uri[2] == ""  || $uri[2] == "" ) {
            echo "Informe corretamente os parâmetros:\n
            http://localhost:8000/exchange/{amount}/{from}/{to}/{rate}";
            exit();
        }
    }
}
