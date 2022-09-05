<?php
/**
 * Esta classe faz a conversão do arquivo
 *
 * @author Felipe Peixoto <peixoto152@gmail.com>
 */
class Exchange
{
    private $_amount    = null;
    private $_from    = null;
    private $_to        = null;
    private $_rate    = null;
    private $_valor    = 0;
    private $_simb    = null;


    /**
     * Coleta as propriedades
     *
     * @param  number $amount montante
     * @param  string $from   moeda atual
     * @param  string $to     moeda destino
     * @param  number $rate   valor 
     * @return void
     */
    public function __construct($amount,$from,$to,$rate)
    {
        $this->_amount    = $amount;
        $this->_from        = $from;
        $this->_to         = $to;
        $this->_rate        = $rate;

    }

    /**
     * Faz a conversao
     * 
     * @return void
     */
    public function doExchange()
    {
        $this->_valor =  $this->_amount * $this->_rate;
        switch ($this->_to) {
        case 'USD':
            $this->_simb = '$';
            break;
        case 'BRL':
            $this->_simb = 'R$';
            break;
        case 'EUR':
            $this->_simb = '€';
            break;
        default:
            $this->_simb = '';
            break;
        }
        return;
    }

    /**
     * Retorna em formato json
     * 
     * @return string
     */    
    public function outputJson()
    {
        $json = array(
        'valorConvertido'    =>    $this->_valor,
        'simboloMoeda'        =>    $this->_simb,
        );
        return json_encode($json);
    }
}
