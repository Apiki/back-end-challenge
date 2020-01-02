<?php
/**
 * Created by Carlos Adriano Sousa
 * User: Carlos
 */


require 'app/classes/Real.php';
require 'app/classes/Dolar.php';
require 'app/classes/Euro.php';


class Currency
{


    public static function factory($moeda_name){

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