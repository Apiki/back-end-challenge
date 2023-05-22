<?php
/**
 * Classe ExchangeService
 * É responsável por obter os dados de câmbio das moedas e por fim fazer a conversão
 *
 * @category Services
 * @package  ExchangeService
 * @license  MIT License
 * @link     https://example.com
 */
class ExchangeService
{
    /**
     * Símbolos de cada moeda
     *
     * @var array
     */
    private $_currencySymbols = [
        'AUD' => '$',
        'BGN' => 'лв',
        'BRL' => 'R$',
        'CAD' => '$',
        'CHF' => 'Fr',
        'CNY' => '¥',
        'CZK' => 'Kč',
        'DKK' => 'kr',
        'GBP' => '£',
        'HKD' => 'HK$',
        'HUF' => 'Ft',
        'IDR' => 'Rp',
        'ILS' => '₪',
        'INR' => '₹',
        'ISK' => 'kr',
        'JPY' => '¥',
        'KRW' => '₩',
        'MXN' => '$',
        'MYR' => 'RM',
        'NOK' => 'kr',
        'NZD' => '$',
        'PHP' => '₱',
        'PLN' => 'zł',
        'RON' => 'lei',
        'SEK' => 'kr',
        'SGD' => '$',
        'THB' => '฿',
        'TRY' => '₺',
        'USD' => '$',
        'ZAR' => 'R',
        'EUR' => '€',
    ];
    
    /**
     * Converte as moedas
     *
     * @param string $fromCurrency Moeda de origem
     * @param string $toCurrency   Moeda de destino
     * @param float  $amount       Valor a ser convertido
     * @param float  $rate         Taxa de conversão
     *
     * @return float|null
     *
     * @throws Exception Se ocorrer um erro ao realizar a conversão
     */
    public function convertCurrency(string $fromCurrency, string $toCurrency, float $amount, float $rate): ?float
    {
        if ($rate > 0) {
            $convertedAmount = ($amount * $rate);
    
            return $convertedAmount;
        }
        
        throw new Exception('Erro ao realizar a conversão. Verifique os dados e tente novamente');
    }

    /**
     * Obtém o símbolo da moeda
     *
     * @param string $currency Código da moeda
     *
     * @return string
     */
    public function getCurrencySymbol(string $currency): string
    {
        if (isset($this->_currencySymbols[$currency])) {
            return $this->_currencySymbols[$currency];
        }
        
        return '';
    }
}