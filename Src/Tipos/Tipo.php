<?php

namespace Src\Tipos;

abstract class Tipo {
    public $valor;
    public $campo;

    /**
     * @return void
     * @throws TipoException
     */
    abstract public function validar(); 

    public function __construct($valor, $campo = '') {
        $this->valor = $valor;
        $this->campo = $campo;
        $this->validar();
    }

    public function getValor() {
        return $this->valor;
    }
}