<?php
class Request 
{
    private $_method;
    private $_base_uri;
    private $_uri_request;
    public function __construct(string $method, string $base_uri, string $uri_request) {
        $this->_method = $method;
        $this->_uri_request = $uri_request;
        $this->_base_uri = $base_uri;
    }
    public function convertCurrency(float $amount, string $current, string $expected, float $rate) {
        $result['valorConvertido'] = $amount * $rate;
        switch($expected) {
            case 'BRL':
                $result['simboloMoeda'] = 'R$';
            break;
            case 'USD':
                $result['simboloMoeda'] = '$';
            break;
            case 'EUR':
                $result['simboloMoeda'] = '€';
            break;
        }
        $json_result = json_encode($result);
        return $json_result;
    }
    public function getData() {
        if($this->_method !== 'GET') {
            http_response_code(403);
            $result['erro'] = 'Método HTTP não suportado';
            $json_result = json_encode($result);
            return $json_result;
        } else {
            if(strpos($this->_uri_request, $this->_base_uri) !== false) {
                $uri = preg_replace('#'.$this->_base_uri.'/#', '', $this->_uri_request);
                $arr = preg_split('#/#', $uri);
                if(sizeof($arr) !== 4) {
                    http_response_code(400);
                    $result['erro'] = 'Faltam argumentos na requisição!';
                    $json_result = json_encode($result);
                    return $json_result;
                } elseif(!preg_match('#^[0-9]\d*(\.\d+)?$#',$arr[0]) | !preg_match('#^[0-9]\d*(\.\d+)?$#',$arr[3])) {
                    http_response_code(400);
                    $result['erro'] = 'Argumento vazio ou inválido';
                    $json_result = json_encode($result);
                    return $json_result;
                } elseif(!preg_match('#BRL|USD|EUR#',$arr[1]) | !preg_match('#BRL|USD|EUR#',$arr[2])) {
                    http_response_code(400);
                    $result['erro'] = 'Formato de moeda inválido. (BRL, USD, EUR)';
                    $json_result = json_encode($result);
                    return $json_result;
                }
                else {
                    return $this->convertCurrency(floatval($arr[0]), $arr[1], $arr[2], floatval($arr[3]));
                }
            } else {
                http_response_code(404);
                $result['erro'] = 'Recurso não encontrado!';
                $json_result = json_encode($result);
                return $json_result;
            }
        }
    }
}
?>