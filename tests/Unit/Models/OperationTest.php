<?php

declare(strict_types=1);

namespace Tests\Unit\Moldes;

use Source\Exception\InvalidTypeException;
use Source\Models\Operation;
use PHPUnit\Framework\TestCase;

class OperationTest extends TestCase
{
    public function testConstruct(): void
    {
        $operation = new Operation('buy', 12.00, 1_000);

        self::assertEquals(12.00, $operation->getUnitCost());
        self::assertEquals(1_000, $operation->getQuantity());
        self::assertEquals(12_000, $operation->getTotal());
        self::assertTrue($operation->isTypeBuy());
        self::assertFalse($operation->isTypeSell());
        self::assertFalse($operation->isTaxExemption());
    }

    public function testConstructWithInvalidType(): void
    {
        self::expectException(InvalidTypeException::class);

        new Operation('refund', 12.00, 1_000);
    }
}
