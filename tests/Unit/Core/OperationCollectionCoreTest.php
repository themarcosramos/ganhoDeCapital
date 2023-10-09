<?php

declare(strict_types=1);

namespace Tests\Unit\Core;

use Source\App\OperationCollection;
use Source\Models\Operation;
use Source\Core\OperationCollectionCore;
use PHPUnit\Framework\TestCase;

class OperationCollectionCoreTest extends TestCase
{
    public function testCreateFromArray(): void
    {
        $operationCollectionExpected = new OperationCollection();
        $operationCollectionExpected->addOperation(new Operation("buy", 10.00, 17_000));
        $operationCollectionExpected->addOperation(new Operation("buy", 16.00, 21_000));
        $operationCollectionExpected->addOperation(new Operation("sell", 45.00, 6_000));

        $data = [
            ['operation' => 'buy', 'unit-cost' => 10.00, 'quantity' => 17_000],
            ['operation' => 'buy', 'unit-cost' => 16.00, 'quantity' => 21_000],
            ['operation' => 'sell', 'unit-cost' => 45.00, 'quantity' => 6_000],
        ];

        $operationCollectionGot = OperationCollectionCore::createFromArray($data);
        self::assertEquals($operationCollectionExpected, $operationCollectionGot);
    }
}
