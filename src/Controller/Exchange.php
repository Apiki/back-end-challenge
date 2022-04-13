<?php
namespace App\Controller;

/**
 * Classe responsável pela conversão dos valores
 * e pelo controle de validade dos parâmetros.
 */
class Exchange {

    private $exchange;
    private $amount;
    private $from;
    private $to;
    private $rate;
    
    /**
     * @param array $uri Vetor com as partes da URL requisitada
     */
    public function __construct( $uri )
    {
        // Anula uma variável se detectada sua ausência
        $this->exchange = isset( $uri[1] ) && !empty( $uri[1] ) ? $uri[1] : null;
        $this->amount   = isset( $uri[2] ) && !empty( $uri[2] ) ? $uri[2] : null;
        $this->from     = isset( $uri[3] ) && !empty( $uri[3] ) ? $uri[3] : null;
        $this->to       = isset( $uri[4] ) && !empty( $uri[4] ) ? $uri[4] : null;
        $this->rate     = isset( $uri[5] ) && !empty( $uri[5] ) ? $uri[5] : null;

        // Verificação de presença dos parâmetros
        if ( !$this->hasNull() && $this->isExchange() ) {

            // Verificação de validade dos parâmetros
            if ( $this->isValid() ) {

                $this->calc();
                exit();
            }
        }

        // Erro 400
        $this->error();
    }

    public function hasNull()
    {
        // Verifica se alguma variável está nula
        return 
        is_null( $this->exchange ) || 
        is_null( $this->amount ) || 
        is_null( $this->from ) || 
        is_null( $this->to ) || 
        is_null( $this->rate );
    }

    public function isExchange()
    {
        // Verifica se o primeiro parâmetro da URL é 'exchange'
        return 'exchange' === $this->exchange;
    }

    /**
     * Verificação de validade, dentro
     * das regras estabelecidas
     */
    public function isValid()
    {
        return 
        // Verifica se 'amount' é numérico e maior que zero
        ( is_numeric( $this->amount ) && 0 < $this->amount ) && 
        // Verifica se 'from' é alfabético e maiúsculo
        ( ctype_alpha( $this->from ) && ctype_upper( $this->from ) ) && 
        // Verifica se 'to' é alfabético e maiúsculo
        ( ctype_alpha( $this->to ) && ctype_upper( $this->to ) ) && 
        // Verifica se 'rate' é numérico e maior que zero
        ( is_numeric( $this->rate ) && 0 < $this->rate );
    }

    /**
     * Cálculo da conversão e 
     * impressão da resposta
     */
    public function calc()
    {
        // Conversão
        $valor_convertido = $this->amount * $this->rate;

        // Relação dos parâmetros com os símbolos monetários
        $simbolo_moeda = [
            'USD'   => '$',
            'BRL'   => 'R$',
            'EUR'   => '€'
        ];
        
        // Monta o vetor resposta
        $result = [
            'valorConvertido' => $valor_convertido, 
            'simboloMoeda'    => $simbolo_moeda[$this->to]
        ];
        
        // Imprime no formato JSON
        echo json_encode( $result );
    }

    /**
     * Retorna uma página de erro
     * 
     * @param int $cod Código do erro
     */
    public function error( $cod = 400 )
    {
        $error = [
            400 => [
                'header'    => 'HTTP/1.1 400 Bad Request',
                'body'      => 'Erro na requisição'
            ]
        ];
        
        header( $error[$cod]['header'] );
        echo json_encode( $error[$cod]['body'] );
        exit();
    }

}
