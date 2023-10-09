<?php

declare(strict_types=1);

namespace Tests\Unit\Exception;

use Source\Exception\InvalidTypeException;
use PHPUnit\Framework\TestCase;

class InvalidTypeExceptionTest extends TestCase
{
    public function testThrowNew(): void
    {
        self::expectException(InvalidTypeException::class);
        self::expectExceptionMessage('Invalid type got [ refund ], types available, [ buy, sell ]');

        throw InvalidTypeException::throwNew('refund', ['buy', 'sell']);
    }
}
