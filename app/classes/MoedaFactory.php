<?php
/**
 * Created by Carlos Adriano Sousa
 * User: Carlos
 */

require 'app/classes/Real.php';
require 'app/classes/Dolar.php';
require 'app/classes/Euro.php';


/**
 * Class Currency
 * Esta classe é responsável pela Factory que retorna um objeto de acordo com a moeda desejada.
 */
abstract class MoedaFactory
{


    /**
     * Método Factory Simples
     * @param $moeda_name
     * @return Dolar|Euro|null|Real
     */
    public static function getMoeda($moeda_name){

        $moeda_name = mb_strtoupper($moeda_name);

        switch ($moeda_name){
            case 'BRL':{
                return new Real();
                break;
            }
            case 'EUR':{
                return new Euro();
                break;
            }
            case 'USD':{
                return new Dolar();
                break;
            }

            default:{
                return null;
            }
        }

    }

}