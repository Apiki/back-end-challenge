<?php

namespace Src\Cotacao;

class Moeda {
    
    /**
     * @var string
     */
    private $moeda;

    /**
     * @var array
     */
    private $moedasValidas = [
        'EUR' => '€',
        'USD' => '$',
        'BRL' => 'R$'
    ];

    /**
     * @param string $moeda
     */
    public function __construct($moeda) {
        $this->moeda = strtoupper($moeda);

        if(!isset($this->moedasValidas[$this->moeda])) {
            throw new \InvalidArgumentException(
                sprintf('A moeda %s não é aceita. Moedas aceitas: %s', $this->moeda, 
                    implode(', ', array_flip($this->moedasValidas))
                )
            );
        }
    }

    /**
     * @param string $moeda
     */
    public function getMoeda() {
        return $this->moeda;
    }

    /**
     * @param string $moeda
     */
    public function getSimbolo() {
        return $this->moedasValidas[$this->moeda];
    }
}