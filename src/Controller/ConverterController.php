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
 * @author   Lucas Felype Fonseca Santos <lucasfelypeqw@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

namespace App\Controller;


use App\Service\ConverterService;
use App\Helpers\Validation;

/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Lucas Felype Fonseca Santos <lucasfelypeqw@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class ConverterController
{
    /**
     * Handle conversion request.
     *
     * @param array $data Request data.
     *
     * @return array
     */
    public function handle(array $data): array
    {
        Validation::validate($data);
        $service = new ConverterService();

        return $service->convert(
            $data['amount'],
            $data['to'],
            $data['rate']
        );
    }
}
