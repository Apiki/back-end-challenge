<?php
    header('Content-Type: application/json');

    require_once '../vendor/autoload.php';
    
    if (isset($_GET['url'])) {
        $url = explode('/', $_GET['url']);

        if (is_numeric ($url[0])) {
            $service = 'App\Services\\ExchangeService';
        
            $method = strtolower($_SERVER['REQUEST_METHOD']);
            try {
                $response = call_user_func(array(new $service, $method), $url);

                http_response_code(200);
                if($response == "error"){
                    http_response_code(404);
                    echo json_encode(array('status' => 'error'));  
                }else{
                    echo json_encode(array('valorConvertido' => number_format($response->getValor() , 2 ,",","."), 'simboloMoeda' => $response->getSimbolo()));
                }
                exit;
            } catch (\Exception $e) {
                http_response_code(404);
                echo json_encode(array('status' => 'error', 'data' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
                exit;
            }
        }else{
            http_response_code(404);
            echo json_encode(array('status' => 'error'));  
        }
    }else{
        http_response_code(404);
        echo json_encode(array('status' => 'error'));  
    }
