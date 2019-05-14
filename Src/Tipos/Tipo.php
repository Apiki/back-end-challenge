<?php

namespace Src\Tipos;

abstract class Tipo {

    /**
     * @var string
     */
    public $valor;

    /**
     * @var string
     */
    public $campo;

    /**
     * @return void
     * @throws TipoException
     */
    abstract public function validar(); 

    /**
     * @param string $valor
     * @param string $campo
     */
    public function __construct($valor, $campo = '') {
        $this->valor = $valor;
        $this->campo = $campo;
        $this->validar();
    }

    /**
     * @return string
     */
    public function getValor() {
        return $this->valor;
    }
}