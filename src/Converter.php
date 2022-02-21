<?php

namespace App;

class Converter {
    public $coins = [ 'BRL' => 'R$', 'USD' => '$', 'EUR' => '€' ];
    public $value;
    public $pieces;
    public $origin;
    public $destiny;
    public $tax;
    public $code;
    public $message;

    function __construct( $request ) {        
        $request = rtrim( $request, "/" );
        $this->parts = explode( "/", $request );
        if( isset( $this->pieces[2] )) $this->value = $this->pieces[2];
        if( isset( $this->pieces[3] )) $this->origin = $this->pieces[3];
        if( isset( $this->pieces[4] )) $this->destiny = $this->pieces[4];
        if( isset( $this->pieces[5] )) $this->tax = $this->pieces[5];
        $this->check();                       
    }

    public function check() {
        if( !isset( $this->value ) || !isset( $this->origin ) || !isset( $this->destiny ) || !isset( $this->tax )) {
            $this->code = 400;
            $this->message = "Error, check data inserted and try again.";
            return;            
        }
        $this->check2();
    }


    public function check2() {
        if( $this->value < 0 || !is_numeric( $this->value ) || $this->tax < 0 || !is_numeric( $this->tax )) {
            $this->code = 400;
            $this->message = "Error. Invlid data inserted, check and try again.";
            return;           
        } 
        else if( !ctype_upper( $this->origin ) || !ctype_upper( $this->destiny ) ) {
            $this->code = 400;
            $this->message = "Error check data {de} and {from} must be UPPERCASE.";
            return;  
        }
        $this->convert();
    }


    public function convert() {
        $this->code = 200;
        $this->answer = $this->value * $this->tax;
        $this->message = [ 'Answer:' => $this->answer, 'Coin Symbol' => $this->coins[ $this->destiny ]];
        return;
    }


    public function responseCode() {
        http_response_code( $this->code );
    }


    public function responseContent() {        
        header( 'Content-Type: application/json; charset=utf-8' );        
        echo json_encode( $this->message, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE );        
    }

    

}