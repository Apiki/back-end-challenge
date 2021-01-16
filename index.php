<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.2
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Anderson da Mata Pereira <anderson.daamata@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
require __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/src/V1.php';

class Rest
{
    public static function open($requisicao)
    {
        $url = explode('/', $requisicao['url']);

        $classe = ucfirst($url[0]);
        array_shift($url);

        $metodo = $url[0];
        array_shift($url);

        $parametros = array();
        $parametros = $url;

        try {
            if (class_exists($classe)) {
                if (method_exists($classe, $metodo)) {
                    $retorno = call_user_func_array(array( $classe, $metodo), $parametros);

                    return json_encode(array('status' => 'sucesso', 'dados' => $retorno));
                } else {
                    return json_encode(array('status' => 'erro', 'dados' => 'Método inexistente!'));
                }
            } else {
                return json_encode(array('status' => 'erro', 'dados' => 'Classe inexistente!'));
            }
        } catch (Exception $e) {
            return json_encode(array('status' => 'erro', 'dados' => $e->getMessage()));
        }

    }
}

if (isset($_REQUEST)) {
    echo Rest::open($_REQUEST);
}



