<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Currency;
use App\ValidationException;
use App\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class ValidatorTest extends TestCase
{
    public function testValidBrlToUsd(): void
    {
        $result = Validator::validate(['10', 'BRL', 'USD', '4.50']);

        $this->assertSame(10.0, $result['amount']);
        $this->assertSame(Currency::BRL, $result['from']);
        $this->assertSame(Currency::USD, $result['to']);
        $this->assertSame(4.5, $result['rate']);
    }

    public function testValidEurToBrl(): void
    {
        $result = Validator::validate(['7', 'EUR', 'BRL', '5']);

        $this->assertSame(7.0, $result['amount']);
        $this->assertSame(Currency::EUR, $result['from']);
        $this->assertSame(Currency::BRL, $result['to']);
        $this->assertSame(5.0, $result['rate']);
    }

    /**
     * @param array<int, string> $segments Invalid segments.
     */
    #[DataProvider('invalidInputProvider')]
    public function testInvalidInputThrowsException(
        array $segments
    ): void {
        $this->expectException(ValidationException::class);

        Validator::validate($segments);
    }

    /**
     * @return array<string, array{array<int, string>}>
     */
    public static function invalidInputProvider(): array
    {
        return [
            'empty segments'     => [[]],
            'missing params'     => [['10', 'BRL']],
            'non-numeric amount' => [['abc', 'BRL', 'USD', '1']],
            'negative amount'    => [['-5', 'BRL', 'USD', '1']],
            'lowercase from'     => [['10', 'brl', 'USD', '1']],
            'lowercase to'       => [['10', 'BRL', 'usd', '1']],
            'non-numeric rate'   => [['10', 'BRL', 'USD', 'abc']],
            'negative rate'      => [['10', 'BRL', 'USD', '-1']],
        ];
    }
}
