<?php

declare(strict_types=1);

namespace Tests\Unit\App;

use Source\App\TaxCollection;
use Source\Models\Tax;
use PHPUnit\Framework\TestCase;

class TaxCollectionTest extends TestCase
{
    public function testCollection(): void
    {
        $collectionExpected = [
            new Tax(10),
            new Tax(11),
            new Tax(12),
        ];

        $taxCollection = new TaxCollection();
        $taxCollection->addTax(new Tax(10));
        $taxCollection->addTax(new Tax(11));
        $taxCollection->addTax(new Tax(12));

        $collectionGot = $taxCollection->getCollection();
        self::assertEquals($collectionExpected, $collectionGot);
    }
}
