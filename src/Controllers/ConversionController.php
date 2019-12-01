<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface;

class ConversionController
{
     protected $container;

     /**
     * This attribute knows the respective 'icon' of the coin 
     *
     * @var array
     */
     private static $coins = [
          'BRL' => 'R$', 
          'USD' => '$', 
          'EUR' => '€',
     ];

    /**
     * This attribute knows the enabled conversions 
     *
     * @var array
     */
     private static $conversionsTypes = [
          "BRL" => ['USD', 'EUR'],
          'USD' => ['BRL'],
          'EUR' => ['BRL'],
     ];

     public function convert($request, $response, $args) {
          if (!$this->isConvertionEnabled($args['from'], $args['to'])) {
               $payload = json_encode([
                    'Erro' => "Valor não disponível para conversão."
               ]);
               $response->getBody()->write($payload);
               return $response
               ->withHeader('Content-Type', 'application/json')
               ->withStatus(400);
          }

          $value = $this->calculateValue($args['amount'], $args['rate']);
          $data = $this->getData($value, $args['to']);

          $payload = json_encode($data);
          $response->getBody()->write($payload);
          return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(200);
     }

     /**
      * Check if is possible to convert those values
      *
      * @param  from Actual coin
      * @param  to coin wished 
      * @return bool 
      */
     protected function isConvertionEnabled($from, $to): bool {
          return in_array($to, self::$conversionsTypes[$from]);
     }

     /**
      * Calculate the value to response
      * @param  amount The amount from
      * @param  rate The rate of the conversion
      * @return float 
      */
      protected function calculateValue(float $amount, float $rate): float {
          return round($amount*$rate, 2);
      }


      /**
       * Create the response in array type
       * @param  value The converted value
       * @param  to The place `to`
       * @return array
       */
      protected function getData(float $value, string $to): array {
          return [
               "valorConvertido" => $value,
               "simboloMoeda" => self::$coins[$to]
          ];
      }

}