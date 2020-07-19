<?php

namespace App\Objects;

class Currency {

  public $code;
  public $sign;
  public $value;

  function __construct($code, $value) {
    $this->code = $code;
    $this->sign = $this->getSignByCode($code);
    $this->value = $value;
  }

  function set_code($code) {
    $this->code = $code;
  }
  function get_code() {
    return $this->code;
  }

  function set_sign($sign) {
    $this->sign = $sign;
  }
  function get_sign() {
    return $this->sign;
  }

  function set_value($value) {
    $this->value = $value;
  }
  function get_value() {
    return $this->value;
  }

  private static function getSignByCode($code){
    switch ($code){
      case 'BRL':
        return 'R$';
      case 'USD':
        return '$';
      case 'EUR':
        return '€';
      default:
        return '';
    }
  }
}