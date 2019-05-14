<?php

namespace Src\Cotacao;

use Src\Tipos\TipoFloat;

interface ICotacaoResposta {
    public function __construct(TipoFloat $valor, Moeda $moeda);
    public function getValor();
    public function getMoeda();
}