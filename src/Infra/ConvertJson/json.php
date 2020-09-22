<?php

namespace App\Apiki\conversodemoedas\Infra\ConvertJson;

use App\Apiki\conversodemoedas\Dominio\Taxa\simboloMoeda;

class json
{
    public static function  retornarjson($moedaConvertida, $simbolosaida)
    {



        switch ($simbolosaida) {
            case 'BRL':
                $simbolosaida = 'R$';
                $array['valorConvertido'] = $moedaConvertida;
                $array['simboloMoeda'] = $simbolosaida;
                return json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

                break;
            case 'USD':
                $simbolosaida = '$';
                $array['valorConvertido'] = $moedaConvertida;
                $array['simboloMoeda'] = $simbolosaida;
                return json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

                break;
            case 'EUR':
                $simbolosaida = '€';
                $array['valorConvertido'] = $moedaConvertida;
                $array['simboloMoeda'] = $simbolosaida;
                return json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

                break;
            default:
                return false;
        }
    }
}
