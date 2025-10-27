<?php

/**
 * InvalidRateException.
 *
 * PHP version 7.4+
 *
 * Exception thrown when exchange rate is invalid.
 *
 * @category Challenge
 * @package  App\Domain\Model\Exchange\Exception
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App\Domain\Model\Exchange\Exception;

/**
 * InvalidRateException class.
 *
 * @category Challenge
 * @package  App\Domain\Model\Exchange\Exception
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class InvalidRateException extends \InvalidArgumentException
{
}
