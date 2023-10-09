<?php

declare(strict_types=1);

namespace Tests\Unit\App;

use Source\App\TaxCalculator;
use Source\App\WeightedProfitPriceCalculator;
use Source\Models\Operation;
use Source\Models\Tax;
use PHPUnit\Framework\TestCase;

class TaxCalculatorTest extends TestCase
{
    public function testGetTaxFromBuyOperation(): void
    {
        $taxExpected = new Tax(0);

        $TaxCalculator = new TaxCalculator(
            new WeightedProfitPriceCalculator()
        );
        $taxGot = $TaxCalculator->getTax(
            new Operation('buy', 10.00, 10_000)
        );

        self::assertEquals($taxExpected, $taxGot);
    }

    public function testGetTaxFromSellOperationWithTaxExemption(): void
    {
        $taxExpected = new Tax(0);

        $TaxCalculator = new TaxCalculator(
            new WeightedProfitPriceCalculator()
        );
        $TaxCalculator->getTax(
            new Operation('buy', 10.00, 10_000)
        );
        $taxGot = $TaxCalculator->getTax(
            new Operation('sell', 15.00, 1_000)
        );

        self::assertEquals($taxExpected, $taxGot);
    }

    public function testGetTaxFromSellOperationWithTaxExemptionAndLossAmount(): void
    {
        $taxExpected = new Tax(0);

        $TaxCalculator = new TaxCalculator(
            new WeightedProfitPriceCalculator()
        );
        $TaxCalculator->getTax(
            new Operation('buy', 10.00, 10_000)
        );
        $taxGot = $TaxCalculator->getTax(
            new Operation('sell', 5.00, 1_000)
        );

        self::assertEquals($taxExpected, $taxGot);
    }

    public function testGetTaxCalculatedFromSellOperation(): void
    {
        $taxExpected = new Tax(35_000);

        $TaxCalculator = new TaxCalculator(
            new WeightedProfitPriceCalculator()
        );
        $TaxCalculator->getTax(
            new Operation('buy', 10.00, 10_000)
        );
        $taxGot = $TaxCalculator->getTax(
            new Operation('sell', 45.00, 5_000)
        );

        self::assertEquals($taxExpected, $taxGot);
    }

    public function testGetTaxCalculatedFromSellOperationWithLossAmount(): void
    {
        $taxExpected = new Tax(0);

        $TaxCalculator = new TaxCalculator(
            new WeightedProfitPriceCalculator()
        );
        $TaxCalculator->getTax(
            new Operation('buy', 40.00, 10_000)
        );
        $taxGot = $TaxCalculator->getTax(
            new Operation('sell', 30.00, 5_000)
        );

        self::assertEquals($taxExpected, $taxGot);
    }

    public function testGetTaxCalculatedFromSellOperationWithPreviousAndDeductionOfLossAmount(): void
    {
        $taxExpected = new Tax(0);

        $TaxCalculator = new TaxCalculator(
            new WeightedProfitPriceCalculator()
        );
        $TaxCalculator->getTax(
            new Operation('buy', 40.00, 10_000)
        );
        $TaxCalculator->getTax(
            new Operation('sell', 30.00, 5_000)
        );
        $taxGot = $TaxCalculator->getTax(
            new Operation('sell', 45.00, 1_000)
        );

        self::assertEquals($taxExpected, $taxGot);
    }

    public function testGetTaxCalculatedFromSellOperationWithPreviousLossAmount(): void
    {
        $taxExpected = new Tax(20_000);

        $TaxCalculator = new TaxCalculator(
            new WeightedProfitPriceCalculator()
        );
        $TaxCalculator->getTax(
            new Operation('buy', 40.00, 10_000)
        );
        $TaxCalculator->getTax(
            new Operation('sell', 30.00, 5_000)
        );//50 prejuizo
        $taxGot = $TaxCalculator->getTax(
            new Operation('sell', 70.00, 5_000)
        );

        self::assertEquals($taxExpected, $taxGot);
    }
}
