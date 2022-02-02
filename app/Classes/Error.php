<?php

namespace app\Classes;

class Error
{

    public $errorCode;


    public function __construct($errorCode)
    {
        $this->errorCode = $errorCode;
        $this->getError($this->errorCode);
    }


    //Metódo criado para tratamento de erros
    public static function getError($errorCode)
    {

        http_response_code(400);

        switch ($errorCode) {
            case '0001':
                echo json_encode(['statusCode' => http_response_code(), 'errorCode' => $errorCode, 'msgError' => 'A Requisição deve ser feita no seguinte formato: http://localhost:3000/exchange/10/BRL/USD/5.70 (Convertendo R$10 para Dólar, considerando o valor do Dólar em $5.70)']);
                break;
            case '0002':
                echo json_encode(['statusCode' => http_response_code(), 'errorCode' => $errorCode, 'msgError' => 'Não é possível converter moedas iguais']);
                break;
            case '0003':
                echo json_encode(['statusCode' => http_response_code(), 'errorCode' => $errorCode, 'msgError' => 'Moeda Inválida']);
                break;
            default:
                http_response_code(404);
                echo json_encode(['statusCode' => http_response_code(), 'errorCode' => "0000", 'msgError' => 'Página não encontrada']);
                break;
        }
    }
}
