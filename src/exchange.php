<?php

class Exchange {

    const acceptedCurrencies = ['BRL' => 'R$', 'EUR' => '€', 'USD'=> '$'];
    const acceptedRoutes = ['exchange'];

    var $errors = array();
    var $convertedValue;
    var $currencySymbol; 
    var $responseCode; 
    var $returnMessage;

    public function getParams() {

        $params = explode("/", $_SERVER['REQUEST_URI']);

        //Check if requested route matches our avaliable ones
        $route = $params[1];
        if (!in_array($route, self::acceptedRoutes)) {
            array_push($this->errors, 'Invalid route');
            return false;
        }

        //Sanitize $params 
        array_shift($params); //Removes server URI prefix
        array_shift($params); //Removes route name

        //Check number of parameters
        if(sizeof($params)<4) { 
            array_push($this->errors, 'Invalid number of parameters');
        } else { 
            //Populate params on $this
            $this->amount = $params[0];
            $this->from = strtoupper($params[1]);
            $this->to = strtoupper($params[2]);
            $this->rate = $params[3];

            //Check 'amount' param, shoud be a positive number
            if (!is_numeric($this->amount) || ($this->amount < 0)) {
                array_push($this->errors, 
                    "Amount '" . $this->amount . "' should be a positive number"
                );
            }

            //Check 'from' param, should be an accepted currency
            if (!array_key_exists($this->from, self::acceptedCurrencies)) {
                array_push($this->errors, "Currency '"  . $this->from . "' is not accepted");
            }

            //Check 'to' param, should be an accepted currency
            if (!array_key_exists($this->to, self::acceptedCurrencies)) {
                array_push($this->errors, "Currency '"  . $this->to . "' is not accepted");
            }

            //Check 'rate' param, should be a positive number
            if (!is_numeric($this->rate) || ($this->rate < 0) || $this->rate == "") {
                array_push($this->errors, "Rate '" . $this->rate . "' should be a positive number");
            }
        }
        //Return false if there's errors reported, or true if everything is ok
        return ($this->errors) ? false : true;
    }

    public function Run() {

        if ($this->getParams()) { //If it's all good with params, proceeds
            $this->convertedValue = $this->amount * $this->rate;
            $this->currencySymbol = $this::acceptedCurrencies[$this->to];
            $this->responseCode = 200;
            $this->returnMessage = array(
                'valorConvertido' => $this->convertedValue,
                'simboloMoeda' => $this->currencySymbol
            );
        } else {
            $this->responseCode = 400;
            $this->returnMessage = array(
                'error' => implode("; ",$this->errors)."."
            );
        }

        //Provides output
        header('Content-Type: application/json; charset=utf-8', true, $this->responseCode);
        print(json_encode($this->returnMessage, JSON_UNESCAPED_UNICODE, JSON_NUMERIC_CHECK));
    }
}