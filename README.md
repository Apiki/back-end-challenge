 <?php  


  /*
  Desenvolva uma REST API que faça conversão de moedas.

  Conversões:
    De Real para Dólar 
    De Dólar para Real
    De Real para Euro;
    De Euro para Real;



  Como fazer cálculo de conversão de moeda?
      Por exemplo: vamos considerar a cotação do Euro no dia 16 de junho: R$ 3,67. Para saber, em reais, o preço de um produto que custa 10 Euros,
      basta multiplicar: R$ 3,67 x 10. Portanto, um produto que custa 10 euros, no Brasil custa R$ 36,70.

     http://localhost:8000/exchange/{amount}/{from}/{to}/{rate} rate taxa
     http://localhost:8000/exchange/10/BRL/USD/4.50   ($10,00 -> 45,00 R$)

                                                         {
                                                           "valorConvertido": 45,
                                                             "simboloMoeda": "$"
                                                         }

  */ 
    class API {

  

     public static function  Post(){
        
     $url =  $_SERVER['REQUEST_URI'];  
      

      
      $str = (explode("/",$url));

      $size_arr = count($str);
     //  echo ("tamanho".$size_arr);
       
      if( ($size_arr <= 5 ) || ($size_arr >= 7) ) {
         $_erro = "URL inválida";
        
         $value = array( "erro"=>$_erro); 
         return json_encode($value);
         
          return false;
      }

     
      $valor1  = $str[2];
      $moeda1 = $str[3];
       
      $moeda2 = $str[4];
      $rate   = $str[5];

    
     $valor =  str_replace(',', '.', $valor1 );
     $Taxa_conversao  = str_replace(',', '.', $rate );
     

       if(  ($moeda1 == "BRL") && ($moeda2 == "USD")  )  {
       
            $simboloMoeda = "$";      
             $temp = API::BRL_USD($valor,$Taxa_conversao,$simboloMoeda);
        
       }

        if(  ($moeda1 == "BRL") && ($moeda2 == "EUR")   )  {

             $simboloMoeda = "R$";
             $temp = API::BRL_EUR($valor,$Taxa_conversao,$simboloMoeda);
          
       }

        if(  ($moeda1 == "USD") && ($moeda2 == "BRL")   )  {

             $simboloMoeda = "R$";
             $temp = API::USD_BRL($valor,$Taxa_conversao,$simboloMoeda);
       

       }

         if(  ($moeda1 == "EUR") && ($moeda2 == "BRL")  )  {

              $simboloMoeda = htmlentities(" €");
              $temp = API::EUR_BRL($valor,$Taxa_conversao,$simboloMoeda);

       }
   

    }

 

     public static function BRL_USD($valor,$Taxa_conversao,$simboloMoeda){
     
          $calculo = $valor * $Taxa_conversao;
       
             $value = array(  "valorConvertido"=>$calculo, "simboloMoeda"=>$simboloMoeda ); 
             $return_js =  json_encode($value);
             return $return_js;
             echo $teste;
     
    }

     public static function USD_BRL($valor,$Taxa_conversao,$simboloMoeda){
      
           $calculo = $valor * $Taxa_conversao;
          

             $value = array(  "valorConvertido"=>$calculo, "simboloMoeda"=>$simboloMoeda ); 
             $return_js =  json_encode($value);
             return $return_js;
             echo $teste;
     
    }

    public static function BRL_EUR($valor,$Taxa_conversao,$simboloMoeda){
      
             $calculo = $valor * $Taxa_conversao;
          

              $value = array(  "valorConvertido"=>$calculo, "simboloMoeda"=>$simboloMoeda ); 
              $return_js =  json_encode($value);
              return $return_js;
              echo $teste;
     
    }
     public static function EUR_BRL($valor,$Taxa_conversao,$simboloMoeda){
      
               $calculo = $valor * $Taxa_conversao;
           
          
                $value = array(  "valorConvertido"=>$calculo, "simboloMoeda"=>$simboloMoeda ); 
                $return_js =  json_encode($value);
                return $return_js;
                echo $teste;
     
    }


   }

  
     

   API::Post();
   

 ?>

 
