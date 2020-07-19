<?php

namespace App\Config;

class Route
{

  private $_method;				// HTTP Method - POST | PUT | GET | DELETE
  private $_pattern;				// Pattern to match (ie. '/user/profile/[id]')
  private $_optionalFunctions; 	// Optional functions to execute
  private $_function; 			// Function to call
  private $_param; 				// Parameter for the function

  // args = method, pettern, optional functions, function
  function __construct($args)
  {
    $this->_method = array_shift($args);
    $this->_pattern = array_shift($args);
    $this->_function = array_pop($args);
    $this->_optionalFunctions = $args;
    $this->_param = array();
  }

  public function methodMatches($method) {
    if ( $this->_method == $method )
      return true;
    else
      return false;
  }

  public function patternMatches($URI) {
    //Extract URL params
    preg_match_all('@:([\w]+)@', $this->_pattern, $paramNames, PREG_PATTERN_ORDER);
    $paramNames = $paramNames[0];

    //Convert URL params into regex patterns, construct a regex for this route
    $patternAsRegex = preg_replace_callback('@:[\w]+@', array($this, '_convertPatternToRegex'), $this->_pattern);
    if ( substr($this->_pattern, -1) === '/' ) {
      $patternAsRegex = $patternAsRegex . '?';
    }
    $patternAsRegex = '@^' . $patternAsRegex . '$@';

    //Cache URL params' names and values if this route matches the current HTTP request
    if ( preg_match($patternAsRegex, $URI, $paramValues) ) {
      array_shift($paramValues);
      foreach ( $paramNames as $index => $value ) {
        $val = substr($value, 1);
        if ( isset($paramValues[$val]) ) {
          $this->_param[$val] = urldecode($paramValues[$val]);
        }
      }
      return true;
    }
    return false;
  }

  private function _convertPatternToRegex( $matches ) {
    $key = str_replace(':', '', $matches[0]);
    return '(?P<' . $key . '>[a-zA-Z0-9_\-\.\!\~\*\\\'\(\)\:\@\&\=\$\+,%]+)';
  }

  public function run() {

    //Run the optional functions
    foreach ($this->_optionalFunctions as $function) {
      if (is_callable($function))
        call_user_func($function);
    }

    //Run the main function
    if (is_callable($this->_function)) {
      call_user_func_array($this->_function, array_values($this->_param));
      return true;
    }
    return false;
  }

}