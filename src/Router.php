<?php

namespace App;

/**
 * Class Router
 *
 * Classe responsável por realizar o roteamento da URL da requisição.
 *
 * @package App
 */
class Router
{
    /**
     * Realiza o roteamento da URL da requisição.
     *
     * @param string $url URL da requisição.
     *
     * @return array Dados da requisição roteada (amount, fromCurrency, toCurrency, rate).
     * @throws \InvalidArgumentException Caso a ação seja inválida, o número de parâmetros seja inválido,
     *                                    ou o valor ou taxa sejam inválidos.
     */
    public function route(string $url): array
    {
        $urlParts = explode('/', trim($url, '/'));
        $action = array_shift($urlParts);

        if ($action !== 'exchange') {
            throw new \InvalidArgumentException("Invalid action.");
        }

        if (count($urlParts) !== 4) {
            throw new \InvalidArgumentException("Invalid number of parameters.");
        }

        list($amount, $fromCurrency, $toCurrency, $rate) = $urlParts;

        if (!is_numeric($amount) || !is_numeric($rate)) {
            throw new \InvalidArgumentException("Invalid amount or rate.");
        }

        // Optionally validate currencies here if needed
        // Example: if (!in_array($fromCurrency, ['BRL', 'USD', 'EUR']) || !in_array($toCurrency, ['BRL', 'USD', 'EUR'])) {
        //     throw new \InvalidArgumentException("Invalid currency.");
        // }

        return [
            'amount' => (float) $amount,
            'fromCurrency' => strtoupper($fromCurrency),
            'toCurrency' => strtoupper($toCurrency),
            'rate' => (float) $rate,
        ];
    }
}
