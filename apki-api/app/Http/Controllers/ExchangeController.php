<?php
namespace App\Http\Controllers;

class ExchangeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function exchange($amount, $from, $to, $rate)
    {
        $moedas = ['BRL' => 'R$', 'USD' => '$', 'EUR' => '€'];
        $result = $amount * $rate;
        $json = ['valorConvertido' => $result, 'simboloMoeda' => $moedas[strtoupper($to)]];
        $data = json_encode($json, JSON_UNESCAPED_UNICODE);
        return $data;
    }
}
