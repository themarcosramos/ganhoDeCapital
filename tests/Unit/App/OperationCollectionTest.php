<?php

declare(strict_types=1);

namespace Tests\Unit\App;

use Source\App\OperationCollection;
use Source\Models\Operation;
use PHPUnit\Framework\TestCase;

class OperationCollectionTest extends TestCase
{
    public function testCollection(): void
    {
        $collectionExpected = [
            new Operation('buy', 10.00, 10_000),
            new Operation('buy', 11.00, 11_000),
            new Operation('buy', 12.00, 12_000),
        ];

        $operationCollection = new OperationCollection();
        $operationCollection->addOperation(new Operation('buy', 10.00, 10_000));
        $operationCollection->addOperation(new Operation('buy', 11.00, 11_000));
        $operationCollection->addOperation(new Operation('buy', 12.00, 12_000));

        $collectionGot = $operationCollection->getCollection();
        self::assertEquals($collectionExpected, $collectionGot);
    }
}
