<?php

namespace Apiki;

class Exchange
{

  /*
  * Convert a value by Rate
  * Retun @integer or @float
  */
  public function Convert($valued, $from_value, $rate)
  {

    if ($rate == 0) {
      header('Content-Type: application/json');
      $json = new Json('ENC', 'Invalid Rate Value, correct is an float positive value grant by zero');
      echo $json->decode_encode();
      exit;
    }

    if ($rate < 1)
    {
      $valued = 1;
    }

    if ($valued == 0)
    {
        $value = $from_value/$rate;
      } else {
        $value = $from_value * $rate;
    }

    return $value;
  }

}
