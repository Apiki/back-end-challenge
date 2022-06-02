<?php
/**
 * API Para conversão de moedas
 * php version 7.4.3
 *
 * @category Conversão
 * @package  App\controllers
 * @author   Gustavo Breternitz <breternitzgustavo@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU/CPLv3
 * @link     https://www.linkedin.com/in/gustavo-breternitz-9b83901ba/
 */

namespace App\utils;

/**
 * Arquivo de Conversão de Siglas para Simbolos
 * php version 7.4.3
 *
 * @category Conversão
 * @package  App\controllers
 * @author   Gustavo Breternitz <breternitzgustavo@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU/CPLv3
 * @link     https://www.linkedin.com/in/gustavo-breternitz-9b83901ba/
 */
class Arrays
{
    /**
     * Função responsável por alterar a sigla para um simbolo
     *
     * @param string $key Key
     *
     * @return string
     */
    public  static  function siglasMoedas($key)
    {
        $array = [
            'BRL' => 'R$',
            'USD' => '$',
            'EUR' => '€'
        ];

        return array_key_exists($key, $array) ? $array[$key] : $array;
    }
}