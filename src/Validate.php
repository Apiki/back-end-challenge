<?php
namespace App;

use DomainException;

// Classe com métodos onde Validam e Sanitizam valores recebidos do formulário
class Validate 
{
    public static function ValidateString($string) {
        $string = filter_var($string, FILTER_SANITIZE_STRING);

        if ($string === false) throw new DomainException('Este dado está incorreto');

        return $string;
    }

    public static function ValidateInt($int) {
        $int = filter_var($int, FILTER_VALIDATE_INT);

        if ($int === false) throw new DomainException('Este valor não é válido');

        return $int;
    }

    public static function ValidateFloat($float) {
        $float = filter_var($float, FILTER_VALIDATE_FLOAT);

        if ($float === false) throw new DomainException('Este valor não é válido');

        return $float;
    }
}