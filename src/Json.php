<?php

namespace Apiki;

class Json
{

  private $_type = "";
  private $_data = "";
  private $_assoc = "";
  private $_unescaped = "";

  public function __construct($type, $data, $assoc = "", $unescaped = "")
  {
    $this->_type = $type;
    $this->_data = $data;

    if ( (strlen($assoc)<1) && (!$assoc) )
    {
        $this->_assoc = true;
      } else {
        $this->_assoc = false;
    }

    if ( (strlen($unescaped)<1) && (!$unescaped) )
    {
          $this->_unescaped = true;
        } else {
          $this->_unescaped = false;
    }

  }

  /*
  * Decode or Encode
  * return @array, @object or @string
  */
  public function decode_encode()
  {

    if ( ($this->_type!= "DEC") && ($this->_type != "ENC") )
    {
      return "Error_-_Invalid_Json_Type";
    }

    if ($this->_unescaped)
    {

      if ($this->_type== "ENC")
      {
          $ret = json_encode($this->_data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK );
          return $ret;
      }

    }

    if ($this->_type == "DEC")
    {
        $ret = json_decode($this->_data, $this->_assoc);
    }

    if ($this->_type== "ENC")
    {
        $ret = json_encode($this->_data, JSON_UNESCAPED_UNICODE);
    }

    return $ret;
  }

}
