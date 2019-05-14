<?php

namespace Src\Cotacao\BancoCentral;

use Src\Cotacao\ICotacao;
use Src\Cotacao\Moeda;
use Src\Tipos\TipoFloat;
use GuzzleHttp\Client;
use Src\Cotacao\CotacaoResposta;


class Cotacao implements ICotacao {
    /**
     * @param Moeda $de
     * @param Moeda $para
     * @param TipoFloat $valor
     * @return ICotacaoResposta
     * @throws InvalidArgumentException
     */
    public function cotar(Moeda $de, Moeda $para, TipoFloat $valor)  {

        if($de->getMoeda() == $para->getMoeda()) {
            throw new \InvalidArgumentException('As moeda devem ser diferentes!');
        }

        if($de->getMoeda() != 'BRL' && $para->getMoeda() != 'BRL') {
            throw new \InvalidArgumentException('Umas das moeda deve ser BRL!');
        }

        $moeda = $de->getMoeda() != 'BRL' ? $de : $para;

        $data = new \DateTime();
        $url = sprintf('https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoMoedaDia(moeda=' .
        '@moeda,dataCotacao=@dataCotacao)?@moeda=\'%s\'&@dataCotacao=\'%s\'&$top=1&$format=json&$select=cotacaoCompra',
        $moeda->getMoeda(), $data->format('m-d-Y'));

        $clienteHttp = new Client; 
        $cotacao = $clienteHttp->request('GET', $url);
        $retorno = json_decode($cotacao->getBody()->getContents());

        if ( $retorno->value[0]->cotacaoCompra < 1 || $de->getMoeda() == 'BRL' ) {
            return new CotacaoResposta(new TipoFloat($valor->getValor() / $retorno->value[0]->cotacaoCompra), $para);
        }

        return new CotacaoResposta(new TipoFloat($valor->getValor() * $retorno->value[0]->cotacaoCompra), $para);
    }
}