<?php
namespace App\Controller;

use App\Validate;
use App\ProcessaRequisicao;

class ConverteMoeda implements ProcessaRequisicao 
{
    public function Processa() {
        
        // Recebe parâmetros do formulário
        $from = Validate::ValidateString(isset($_POST['from']) ? ($_POST['from']) : false);
        $to = Validate::ValidateString(isset($_POST['to']) ? ($_POST['to']) : false); 
        $amount = intval(Validate::ValidateString(isset($_POST['amount']) ? ($_POST['amount']) : false));
        
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, 'https://api.apilayer.com/currency_data/convert?to='.$to.'&from='.$from.'&amount='.$amount);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'apikey: O2hqTqblC4yRkxJbG04V0ioIsiwHECNG',
        ]);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 0);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        return $response;
    }
}