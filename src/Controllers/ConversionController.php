<?php

namespace App\Controllers;

class ConversionController
{

     protected $container;

     /**
      * This attribute knows the respective 'icon' of the coin 
      * and all project coins
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
          if (!self::isValidated($args)) {
               $response->getBody()->write(json_encode(new \stdClass));
               return $response
               ->withHeader('Content-Type', 'application/json')
               ->withStatus(400);
          }

          $value = self::calculateValue($args['amount'], $args['rate']);
          $data = self::getData($value, $args['to']);

          $payload = json_encode($data);
          $response->getBody()->write($payload);
          return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(200);
     }

     /**
      * Calculate the value to response
      * @param  amount The amount from
      * @param  rate The rate of the conversion
      * @return float 
      */
     protected static function calculateValue(float $amount, float $rate): float {
          return round($amount*$rate, 2);
     }

     /**
      * Create the response in array type
      * @param  value The converted value
      * @param  to The place `to`
      * @return array
      */
      protected static function getData(float $value, string $to): array {
          return [
               "valorConvertido" => $value,
               "simboloMoeda" => self::$coins[$to]
          ];
      }

     /**
      * Validate the args
      * 
      * @param  args arguments of the request
      * @return bool
      */
     protected static function isValidated($args) {
          // Check if from and to is string
          if(!is_string($args['from']) || !is_string($args['to'])) {
               return false;
          }
          // Check if amount and rate is numeric
          if(!is_numeric($args['amount']) || !is_numeric($args['rate'])) {
               return false;
          }
          // Check if amount and rate is > 0
          if($args['amount'] < 0 || $args['rate'] < 0) {
               return false;
          }
          // Check if type exists
          if(!isset(self::$coins[$args['to']]) || !isset(self::$coins[$args['from']])) {
               return false;
          }
          return self::isConvertionEnabled($args['from'], $args['to']);
      }

     /**
      * Check if is possible to convert those values
      *
      * @param  from Actual coin
      * @param  to coin wished 
      * @return bool 
      */
     protected static function isConvertionEnabled($from, $to): bool {
          return in_array($to, self::$conversionsTypes[$from]);
     }

}