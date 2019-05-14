<?php

namespace Src\Cotacao;

class Moeda {
    private $moeda;

    private $moedasValidas = [
        'EUR' => '€',
        'USD' => '$',
        'BRL' => 'R$'
    ];

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

    public function getMoeda() {
        return $this->moeda;
    }

    public function getSimbolo() {
        return $this->moedasValidas[$this->moeda];
    }
}