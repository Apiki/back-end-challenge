<?php
/**
 * Bad request exception.
 *
 * PHP version 7.4
 *
 * @category Challenge
 * @package  Back-end
 * @author   Eduardo Lopes <eduardo.frlopes@hotmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App\Http;

use RuntimeException;

/**
 * Signal invalid input data.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Eduardo Lopes <eduardo.frlopes@hotmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class BadRequestException extends RuntimeException
{
}
