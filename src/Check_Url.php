<?php

namespace Apiki;

class Check_Url
{
  public $_valued = "";
  public $_symbol = "";
  public $_amount = "";
  public $_rate = "";

  public function Path($url)
  {
    $url_path = explode('/', filter_var(rtrim( $url, '/' ), FILTER_SANITIZE_URL));

    /*
    * Check if first path is exchange
    */
    if ($url_path[3]!='exchange')
    {
      header('Content-Type: application/json');
      $json = new Json('ENC', 'Invalid Path, correct is \'exchange\'');
      echo $json->decode_encode();
      exit;
    }

    /*
    * Check if is an float and positive value
    */
    if (floatval($url_path[4])<1)
    {
      http_response_code(400);
      header('Content-Type: application/json');
      $json = new Json('ENC', 'Invalid Amont Value, correct is an float positive value');
      echo $json->decode_encode();
      exit;
    }

    /*
    * First Type - From
    */
    switch ($url_path[5])
    {
      case 'BRL':
        $this->_valued = 0;
        break;

      case 'USD':
        $this->_valued = 1;
        break;

      case 'EUR':
        $this->_valued = 1;
        break;

      default:
        http_response_code(400);
        header('Content-Type: application/json');
        $json = new Json('ENC', 'Invalid Type, the types are \'BRL\', \'USD\' and \'EUR\'');
        echo $json->decode_encode();
        exit;
        break;
    }

    /*
    * Second Type - To
    */
    switch ($url_path[6])
    {
      case 'BRL':
        if ($url_path[5]=='BRL')
        {
          http_response_code(400);
          header('Content-Type: application/json');
          $json = new Json('ENC', 'Same Type exchange conversion');
          echo $json->decode_encode();
          exit;
        }
        $this->_symbol = "R$";
        break;

      case 'USD':
        if ($url_path[5]=='USD')
        {
          http_response_code(400);
          header('Content-Type: application/json');
          $json = new Json('ENC', 'Same Type exchange conversion');
          echo $json->decode_encode();
          exit;
        }
        if ($url_path[5]=='EUR')
        {
          http_response_code(400);
          header('Content-Type: application/json');
          $json = new Json('ENC', 'Not Permited Type exchange conversion');
          echo $json->decode_encode();
          exit;
        }
        $this->_symbol = "$";
        break;

      case 'EUR':
        if ($url_path[5]=='EUR')
        {
          http_response_code(400);
          header('Content-Type: application/json');
          $json = new Json('ENC', 'Same Type exchange conversion');
          echo $json->decode_encode();
          exit;
        }
        if ($url_path[5]=='USD')
        {
          http_response_code(400);
          header('Content-Type: application/json');
          $json = new Json('ENC', 'Not Permited Type exchange conversion');
          echo $json->decode_encode();
          exit;
        }
        $this->_symbol = "€";
        break;

      default:
        http_response_code(400);
        header('Content-Type: application/json');
        $json = new Json('ENC', 'Invalid Type, the types are \'BRL\', \'USD\' and \'EUR\'');
        echo $json->decode_encode();
        exit;
        break;
    }

    /*
    * Check second value is positive and grant by zero
    */
    if (floatval($url_path[7])<=0)
    {
      http_response_code(400);
      header('Content-Type: application/json');
      $json = new Json('ENC', 'Invalid Rate Value, correct is an float positive value grant by zero');
      echo $json->decode_encode();
      exit;
    }

    $this->_amount = $url_path[4];
    $this->_rate = $url_path[7];

  }

}
