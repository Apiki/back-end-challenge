<?php
/**
 * Created by Carlos Adriano Sousa.
 * User: Carlos
 */

    abstract class Moeda
    {

        protected $nome_moeda = '';
        protected $simbolo_moeda = '';

        public function getSimbolo(){
            return $this->simbolo_moeda;
        }

    }