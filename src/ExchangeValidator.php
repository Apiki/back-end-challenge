<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Willian <willian@apiki.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

namespace App;

/**
 * Validator class for exchange API input validation.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Willian <willian@apiki.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class ExchangeValidator
{
    /**
     * Validate amount parameter.
     *
     * @param string|null $amount Amount to validate
     *
     * @return array Validation result
     */
    public function validateAmount(?string $amount): array
    {
        if (!$amount) {
            return ['valid' => false, 'error' => 'Amount is required'];
        }

        if (!is_numeric($amount)) {
            return ['valid' => false, 'error' => 'Amount must be a number'];
        }

        $value = (float)$amount;

        if ($value < 0) {
            return ['valid' => false, 'error' => 'Amount must be positive'];
        }

        return ['valid' => true, 'value' => $value];
    }

    /**
     * Validate currency parameter.
     *
     * @param string|null $currency Currency to validate
     * @param string      $field    Field name for error messages
     *
     * @return array Validation result
     */
    public function validateCurrency(?string $currency, string $field): array
    {
        if (!$currency) {
            $msg = ucfirst($field) . ' currency is required';

            return ['valid' => false, 'error' => $msg];
        }

        if ($currency !== strtoupper($currency)) {
            $msg = ucfirst($field) . ' currency must be uppercase';

            return ['valid' => false, 'error' => $msg];
        }

        $validCurrencies = ['BRL', 'USD', 'EUR'];

        if (!in_array($currency, $validCurrencies, true)) {
            return ['valid' => false, 'error' => 'Invalid ' . $field . ' currency'];
        }

        return ['valid' => true, 'value' => $currency];
    }

    /**
     * Validate rate parameter.
     *
     * @param string|null $rate Rate to validate
     *
     * @return array Validation result
     */
    public function validateRate(?string $rate): array
    {
        if (!$rate) {
            return ['valid' => false, 'error' => 'Rate is required'];
        }

        if (!is_numeric($rate)) {
            return ['valid' => false, 'error' => 'Rate must be a number'];
        }

        $value = (float)$rate;

        if ($value < 0) {
            return ['valid' => false, 'error' => 'Rate must be positive'];
        }

        return ['valid' => true, 'value' => $value];
    }
}
