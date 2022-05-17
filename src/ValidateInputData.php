<?php

require "src/HandleInputData.php";

class ValidateInputData{

    public function validateUrl()
    {
        $handleInputData = new HandleInputData();
        $data = $handleInputData->getUrlData();
        $validateUrlAttributes = $this->validateFieldsAmountAndRate($data['amount'], $data['rate']) && $this->validateFieldsFromAndTo($data['coinFrom'], $data['coinTo']) && $this->validateUrlWithoutValues($handleInputData->getUrlAttributes());
        return $validateUrlAttributes;
    }

    public function validateUrlWithoutValues($urlAttributes)
    {
        $isUrlValid = $urlAttributes[1] == "exchange" && sizeof($urlAttributes) == 6;
        return $isUrlValid;
    }

    public function validateFieldsAmountAndRate($amount, $rate)
    {
        $areNumericFields = $this->validateTypeNumericValue($amount) && $this->validateTypeNumericValue($rate);
        $arePositiveValues = $this->validateValueNonNegative(intval($amount)) && $this->validateValueNonNegative(intval($rate));
        $areCorrectFields = $areNumericFields && $arePositiveValues;
        
        return $areCorrectFields; 
    }

    public function validateTypeNumericValue($value)
    {
        $noDotsAndCommas = implode(preg_split("/[-+.,]/", $value));
        $lettersAndNumbers = '/\D+(\d+)|(\d+)\D+|\D+/';
        preg_match($lettersAndNumbers, $noDotsAndCommas, $matchResult);
        $isNumericValue = sizeof($matchResult) == 0;
        
        return $isNumericValue;
    }

    public function validateValueNonNegative($value)
    {
        $isValueNegative = $value >= 0;
        return $isValueNegative;
    }

    public function validateFieldsFromAndTo($coinFrom, $coinTo)
    {
        $areUppercaseFields = $this->validateUppercaseText($coinFrom) && $this->validateUppercaseText($coinTo);
        return $areUppercaseFields;        
    }

    public function validateUppercaseText($targetText)
    {    
        $pattern = '/[A-Z]{3}/';
        preg_match($pattern, $targetText, $matchTargetText);
        $matchUppercaseInTarget = sizeof($matchTargetText) > 0;

        return $matchUppercaseInTarget;
    }
}