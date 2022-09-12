<?php
/**
 * PHP version 8.1.6
 * 
 * Class que faz a conversão
 * 
 * @file Exchange.php Esta é a classe que faz a conversao pelo metodo converter
 * Esta é a classe que faz a consistencia e aconversao pelo metodo converter
 *
 * @category Class
 * @package  Back_End_Challenge
 * @author   Werner Max <werner.max.bohling@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.apiki.com/
 */

/**
 * PHP version 8.1.6
 * 
 * Class que faz a conversão
 * 
 * @file Exchange.php Esta é a classe que faz a conversao pelo metodo converter
 * Esta é a classe que faz a consistencia e aconversao pelo metodo converter
 *
 * @category Class
 * @package  Back_End_Challenge
 * @author   Werner Max <werner.max.bohling@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.apiki.com/
 */

class Exchange
{
    private static $_instance;
    private static $_api;
    private static $_amount;
    private static $_from;
    private static $_to;
    private static $_rate;

    /**
     * Função construtora que inicializa as variáveis
     */
    public function __construct()
    {
        self::$_api = '';
        self::$_amount = '';
        self::$_from = '';
        self::$_to = '';
        self::$_rate = '';
    }


    /**
     * If an instance exists, this returns it.  If not, it creates one and
     * retuns it.
     *
     * @return self
     */
    public static function getInstance()
    {
        if (!self::$_instance ) {
                self::$_instance = new self;
        }
        return self::$_instance;
    }


     /**
      * Pega os parametros do request e faz a consistência
      * 
      * @return Exception Se ocorrer um erro de consitencia
      **/
    public static function getParametersAndConsist() 
    {
        $metodo = $_SERVER['REQUEST_METHOD'];
        $url = explode('/', $_SERVER['REQUEST_URI']);

        foreach ($url as $parameter) {
            if (isset($parameter) && $parameter <> '') {
                if (!isset(self::$_api) || self::$_api == '') {
                    self::$_api = $parameter;           
                } else if (!isset(self::$_amount) || self::$_amount == '') {
                    self::$_amount = $parameter;           
                } else if (!isset(self::$_from) || self::$_from == '') {
                    self::$_from = $parameter;           
                } else if (!isset(self::$_to) || self::$_to == '') {
                    self::$_to = $parameter;           
                } else if (!isset(self::$_rate) || self::$_rate == '') {
                    self::$_rate = $parameter;           
                }
            }
        }
        
        // consistencia dos parametros
        if (!isset(self::$_api) || self::$_api == '' 
            || strtolower(self::$_api) <> 'exchange'
        ) {
            throw new Exception("Erro na API");
        } else if (!isset(self::$_amount) || self::$_amount == '' 
            || !is_numeric(self::$_amount) || number_format(self::$_amount, 1) <= 0
        ) {
            throw new Exception("Erro no AMOUNT");
        } else if (!isset(self::$_from) || self::$_from == '' 
            || (self::$_from != "BRL" && self::$_from != 'USD' 
            && self::$_from != 'EUR')
        ) {
            throw new Exception("Erro no _FROM");
        } else if (!isset(self::$_to) || self::$_to == '' 
            || (self::$_to != 'BRL' && self::$_to != 'USD'  && self::$_to != 'EUR')
        ) {
            throw new Exception("Erro no TO");
        } else if (!isset(self::$_rate) || self::$_rate == '' 
            || !is_numeric(self::$_rate) || self::$_rate < 0 
            || number_format(self::$_rate, 1) <= 0
        ) {
            throw new Exception("Erro no RATE");
        } else {
            return;
        }
    }

    /**
     * Realiza a conversão entre moedas  
     *
     * @return object json
     **/
    public static function converter() 
    {
        $simbolo = '';
        switch (self::$_to) {

        case 'USD':
            $simbolo = "$";
            break;

        case 'EUR':
            $simbolo = '€';
            break;

        default:
            $simbolo = "R$";
            break;
        }       
        $valor = number_format(self::$_amount, 1) * number_format(self::$_rate, 1);
        return (object)array('valorConvertido'=>$valor, 'simboloMoeda'=>$simbolo);
    }
}
?>
