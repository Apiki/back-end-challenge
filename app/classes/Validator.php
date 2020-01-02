<?php
/**
 * Created by Carlos Adriano Sousa
 * User: Carlos
 */

class Validator
{

    /**
     * Método que valida um texto/string
     * @param $field
     * @param $str
     * @param null $min_size
     * @param null $max_size
     * @param null $acceptable_values
     * @param bool $blank_or_null
     * @param bool $error_msg
     * @return boolean
     */
    public function validaString($field, $str, $min_size = null, $max_size = null, $acceptable_values = null, $blank_or_null = false): bool {
        $str_size = strlen($str);

        if ($blank_or_null && $str_size == 0){
            return 1;
        }
        if (!$blank_or_null && $str_size == 0){
            //Erro!
            return 0;

        }
        //Valida tamanho mínimo
        if ($min_size != null){

            if ($str_size < $min_size){
                return 0;
            }
        }

        //Valida tamanho máximo
        if ($max_size != null){
            if ($str_size > $max_size){
                return 0;
            }
        }

        //Valida os valores aceitáveis
        if ($acceptable_values != null){

            $success = false;
            $acceptable_values = explode(',',$acceptable_values);


            for ($i = 0 ; $i < sizeof($acceptable_values); $i++){

                if ($str == $acceptable_values[$i]){

                    $success = true;

                }
            }


            if (!$success){
                return 0;
            }
        }
        return 1;
    }


    /**
     * Método que valida o float
     * @param type $field
     * @param type $n
     * @param type $min_value
     * @param type $max_value
     * @return boolean
     */
    public function validaFloat($field, $n, $min_value = null, $max_value = null, $blank_or_null = false) {

        //Valida Blank or Null
        if ($blank_or_null && ($n === null || $n === "")){
            return 1;
        }

        if (!$blank_or_null && ($n === null || $n === "")){
            //Erro!
            return 0;

        }


        $filter_result = filter_var($n, FILTER_VALIDATE_FLOAT);

        //Verifica se é fracionário
        if ($filter_result == true || $n == '0'){
            //Verifica valor mínimo
            if ($min_value != null) {
                if ($n < $min_value){ //Se for menor que o valor mínimo ERRO de validação
                    return 0;
                }

            }

            //Verifica valor máximo
            if ($max_value != null){
                if ($n > $max_value){//Se for maior que o valor máximo, ERRO de validação
                    return 0;
                }
            }


        }elseif (!$filter_result)
            return 0;


       return 1;

    }

}