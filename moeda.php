<?php
class moeda
{
   private $simbolo;

   public function setSimbolo($moeda)
   {
      $this->simbolo = $moeda;
   }

   public function getSimbolo()
   {
      return $this->simbolo;
   }

   public function converterMoeda($cotacao, $valor)
   {
      return  $this->getSimbolo() . ': ' . number_format($cotacao * $valor, 2);
   }
}
