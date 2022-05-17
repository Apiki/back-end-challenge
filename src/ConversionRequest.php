<?php
require_once "src/ValidateInputData.php";
require_once "src/HandleInputData.php";

class ConversionRequest{
    public $handleInputData;

    function __construct(){
        $this->handleInputData = new HandleInputData();
    }

    public function request()
    {
        $validateInputData = new ValidateInputData();
        
        if($validateInputData->validateUrl()){
            $data = $this->convertCoin();
            $this->response($data);
        }else{
            header(http_response_code(400));
        }

    }
    public function convertCoin()
    {
        $data = $this->handleInputData->getUrlData();
        $result = array(
            'convertedValue' => (floatval($data['amount']) * floatval($data['rate'])),
            'coinSymbol' => $data['coinTo'],
        );
        
        return $result;
    }

    public function response($data){
        header(["Content-Type:application/json"]);
        echo $this->handleInputData->formattedConversionData($data['convertedValue'], $data['coinSymbol']);
    }

}