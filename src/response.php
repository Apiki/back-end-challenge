<?php     
     
    function response($status,$status_message,$data){
        header("HTTP/1.1 ".$status);
        
     
        $response=$data;
        
        $json_response = json_encode($response);
        echo $json_response;
    }    

?>