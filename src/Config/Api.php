<?php

namespace App\Config;

use App\Controllers\CurrencyController;

class Api
{

  private $_URI;          //URI - /password/cat/id
  private $_method;       //GET - POST - PUT - DELETE
  private $_rawInput;     //Raw input


  function __construct($inputs)
  {
    //HTTP inputs
    $this->_URI =       $this->_checkKey('URI', $inputs);
    $this->_rawInput =  $this->_checkKey('raw_input', $inputs);
    $this->_method =    $this->_checkKey('method', $inputs);
  }

  //Return NULL if the key does not exist
  private function _checkKey($key, $array){
    return array_key_exists($key, $array) ? $array[$key] : NULL;
  }

  public function run() {

    //Create the router
    $router = new Router();

    //Add Route to /exchange/{amount}/{from}/{to}/{rate}
    $router->addRoute('GET', '/exchange/:amount/:from/:to/:rate',
      function($amount,$from,$to,$rate){
        //Call the exchangeCurrency method in controller
        CurrencyController::currencyExchange($amount,$from,$to,$rate);
      }
    );

    //Run the router
    $router->run($this->_method, $this->_URI);
  }
}