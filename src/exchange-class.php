<?php
/**
 * Class to solve o back end challenge
 */
class ExchangeClass{

    protected $amout;
    protected $from;
    protected $to;
    protected $rate;
    protected $request;
    protected $conv_value;
    protected $symbol;
    protected $response;

    /**
     * @param string server request
     */
    function __construct( $data ) {
        $this->do_explode( $data );
    }

    /**
     * Procedure prepare request and send data 
     * @param string server request
     */
    function do_explode( $data ){

        $this->request = explode( '/', $data );

        if ( sizeof( $this->request ) < 6 )
            $this->set_response( "erro", "Parameter should be 4" );

        $this->verify_request();

        $this->set_data();
    }

    /**
     * Procedure verify if request is correct, if not set response error
     */
    function verify_request() {

        $verify_request = $this->treat_request();

        if ( $verify_request != false  )
            $this->set_response( "erro", $verify_request );
        
        if( ! $this->select_simbol( $this->request[3] ) )
            $this->set_response( "erro", "No found correct simbol" );

        if( ! $this->select_simbol( $this->request[4] ) )
            $this->set_response( "erro", "No found correct simbol" ); 
    }

    /**
     * Set data and calculate request, verify if below zero response error
     */
    function set_data(){

        $this->amout = $this->request[2];
        $this->from = $this->request[3];
        $this->to = $this->request[4];
        $this->rate = $this->request[5];
        $this->conv_value = $this->amout * $this->rate;
        $this->symbol = $this->select_simbol( $this->to );

        //verify conv value below zero
        if ( $this->conv_value < 0 )
            $this->set_response( "erro", "Below zero" );

        $this->set_response( $this->conv_value, $this->symbol );
    }

    /**
     * Function to verify match with simbols
     * @param string symbol of request
     * @return string symbol of coin when find equals
     * @return false if don't found
     */
    function select_simbol( $symbol ){

        switch( $symbol ) :
            case 'BRL' :
                return "R$";
                break;
            case 'USD' :
                return "$";
                break;
            case 'EUR' :
                return "€";
                break;                                    
            default :
                return false;
                break;
        endswitch;

    }

    /**
     * Function to verify errors from request
     * @return string with errors of treat request
     * @return false when no found errors
     */
    function treat_request() {

        $erro = false;

        if ( ! is_numeric( $this->request[2] ) )
            $erro = "1 Request must be number";

        if ( ! is_string( $this->request[3] ) AND strlen( $this->request[3] ) <> 3 )
            $erro = $erro . "- 2 Request must be type of coin";

        if ( ! is_string( $this->request[4] ) AND strlen( $this->request[4] ) <> 3 )
            $erro = $erro . "- 3 Request must be type of coin";

        if ( ! is_numeric( $this->request[5] ) )
            $erro = $erro . "- 4 Request must be number";

        return $erro;       
    }

    /**
     * Procedure to prepare header and send response
     * @param string param1
     * @param string param2
     */
    function set_response( $param1, $param2 ){

        $this->response = array( 
            'valorConvertido' => $param1, 
            'simboloMoeda' => $param2 
        );

        if ( $param1 == "erro" ) :
            header('HTTP/1.1 400 error', true, 400);
            $this->do_response();
        endif;

        header('HTTP/1.1 200 Unauthorized', true, 200);
        $this->do_response();
    }

    /**
     * Prcedure to send response json
     */
    function do_response(){
        echo json_encode( $this->response );
        exit;
    }

}