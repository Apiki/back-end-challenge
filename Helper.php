<?php

class Helper {
    /* Função para selecionar símbolo */
    public function getCurrencySymbol($currency) {
        switch(strtoupper($currency)) {
            case 'BRL':
                return $symbol = 'R$';
            case 'EUR':
                return $symbol = '€';
            case 'USD':
                return $symbol = '$';
        }
    }

    /* Função para calculo do valor convertido */
    public function getNewAmount($amount, $rate) {
        $newAmount = ($amount/$rate);
        return $newAmount;
    }

    /* Função para tratamento de algumas regras */
    public function getRules($amount, $from, $to, $rate) {
        $currencies = array("BRL", "EUR", "USD");

        /* Verifica se moeda de entrada está entre as moedas selecionadas */
        if (!in_array($from, $currencies)) {
            $mensagem = "Moeda de entrada inserida não suportada! (Use: BRL, USD, EUR)";
        }
        /* Verifica se moeda para conversão está entre as moedas selecionadas */
        if (!in_array($to, $currencies)) {
            $mensagem = "Moeda de conversão inserida não suportada! (Use: BRL, USD, EUR)";
        }
        /* Caso selecione a mesma moeda com a cotação diferente de 1 */
        if (($rate != 1) && ($from == $to)) {
            $mensagem = "Moedas não podem ser iguais com cotação diferente!";
        }
        
        if (isset($mensagem)){
            return $mensagem;
        }
    }

}

?>