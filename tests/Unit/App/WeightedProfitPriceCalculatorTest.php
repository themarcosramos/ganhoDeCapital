<?php

declare(strict_types=1);

namespace Tests\Unit\App;

use Source\App\WeightedProfitPriceCalculator;
use Source\Models\Operation;
use PHPUnit\Framework\TestCase;

class WeightedProfitPriceCalculatorTest extends TestCase
{
    public function testGetPrice(): void
    {
        $priceExpected = 12.2;

        $weightedProfitPriceCalculator = new WeightedProfitPriceCalculator();
        $weightedProfitPriceCalculator->addBuyOperation(
            new Operation('buy', 12.00, 1_000)
        );
        $weightedProfitPriceCalculator->addBuyOperation(
            new Operation('buy', 13.00, 250)
        );
        $weightedProfitPriceCalculator->addBuyOperation(
            new Operation('sell', 30.00, 500)
        );
        $priceGot = $weightedProfitPriceCalculator->getPrice();

        self::assertEquals($priceExpected, $priceGot);
    }
}
