<?php

class Request {

    protected $curl = null;
    public function __construct($base_url){
      $this->base_url = $base_url;
      $this->curl = curl_init();

    }

    public  function make($endpoint){
      // curl_setopt($this->curl, CURLOPT_URL, $this->base_url.$endpoint); 
      // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
      // if(!$response = curl_exec($this->curl)){
      //   return ['error'];
      // };
      // curl_close($this->curl);
      // return 0;
        curl_setopt_array($this->curl, array(
        CURLOPT_URL => $this->base_url.$endpoint,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true
        ));
        
        $response = json_decode(curl_exec($this->curl),true);
        return $response;
        
    }

}