<?php

namespace Apiki;

class Http
{

  /*
  * Get Url
  * return @string
  */
  public function Url()
  {
    $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    return $link;
  }

}
