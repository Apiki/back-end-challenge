<?php

namespace App\Controller;

class CoinController{
    
    public function convertCoin($request, $response, $args){
        $simbolos = [
            'BRL' => "R$",
            'USD' => "$",
            'EUR' => "€"
        ];
        
        if($this->validateParam($args)){
            $value = $this->getValueConverted($args['amount'], $args['rate']);
            $json = []; 
            $json['valorConvertido'] = floatval($value);
            $json['simboloMoeda'] = $simbolos[$args['to']];
            $payload = json_encode($json);
            $response->getbody()->write($payload);
            return $response
                        ->withHeader('Content-type', 'application/json');
        }else{
            $response->getBody()->write(json_encode(['error'=> 'Deu error' ]));
            return $response
                    ->withHeader('Content-type', 'application/json')
                    ->withStatus(400);
        }
    }

    /**
     * Method of checking parameters passed in the api
     * param: array of arguments passed in the api
     * return: true if it passed verification and false if it did not  
     */
    public function validateParam($params){
        $pattern = '/[a-zA-Z+]/';
        $coins = ["BRL", 'USD', "EUR"];
        foreach($params as $param => $value){
            if(is_null($value)) return false;
            
            switch($param){
                case 'amount':
                    if(preg_match($pattern, $value) == 1 || $value < 0){
                        return false;
                    }
                break;
                case 'from':
                    if(preg_match($pattern, $value) == 0 || !in_array($value, $coins)){
                        return false;
                    }
                break;
                case 'to':
                    if(preg_match($pattern, $value) == 0 || !in_array($value, $coins)){
                        return false;
                    }
                break;
                case 'rate':
                    if(preg_match($pattern, $value) == 1 || $value < 0){
                        return false;
                    }
                break;
                default: return false;
            }
        }

        $dict_conversion = [
            'BRL' => ['EUR', 'USD'],
            'USD' => ['BRL'],
            'EUR' => ['BRL']
        ];

        return in_array($params['to'], $dict_conversion[$params['from']]);
    }


    /**
     * Method to calculate conversion
     * param: amount,
     * param: rate
     * return: conversion value 
     */
    public function getValueConverted(float $amount, float $rate) : float{
        return $amount * $rate;
    }
} 