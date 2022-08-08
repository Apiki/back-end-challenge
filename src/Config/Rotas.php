<?php
require_once(__DIR__.'/../../vendor/autoload.php');

use App\Controller\ConverteMoeda;
use App\Controller\ConversorMoeda;

// Array de Rotas e Controladores
$rotas = [
    "/exchange" => ConversorMoeda::class,
    "/exchange/convert" => ConverteMoeda::class
];

return $rotas;