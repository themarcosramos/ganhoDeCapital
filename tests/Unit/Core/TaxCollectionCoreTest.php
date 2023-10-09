<?php

declare(strict_types=1);

namespace Tests\Unit\Core;

use Source\App\TaxCollection;
use Source\Models\Tax;
use Source\Core\TaxCollectionCore;
use PHPUnit\Framework\TestCase;

class TaxCollectionCoreTest extends TestCase
{
    public function testGetResponse(): void
    {
        $responseExpected = '[{"tax":10},{"tax":11},{"tax":12}]';

        $taxCollection = new TaxCollection();
        $taxCollection->addTax(new Tax(10.00));
        $taxCollection->addTax(new Tax(11.00));
        $taxCollection->addTax(new Tax(12.00));

        $taxCollectionCore = new TaxCollectionCore($taxCollection);
        $responseGot = $taxCollectionCore->getResponse();

        self::assertEquals($responseExpected, $responseGot);
    }
}
