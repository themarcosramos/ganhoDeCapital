<?php

declare(strict_types=1);

namespace Tests\Unit\App;

use Source\App\Taxes;
use Source\App\TaxCalculator;
use Source\App\OperationCollection;
use Source\App\TaxCollection;
use Source\App\WeightedProfitPriceCalculator;
use Source\Models\Operation;
use Source\Models\Tax;
use PHPUnit\Framework\TestCase;

class TaxesTest extends TestCase
{
    public function testCase(): void
    {
        $returnExpected = new TaxCollection();
        $returnExpected->addTax(new Tax(0));
        $returnExpected->addTax(new Tax(0));
        $returnExpected->addTax(new Tax(0));

        $collection = new OperationCollection();
        $collection->addOperation(
            new Operation("buy", 10.00, 100)
        );
        $collection->addOperation(
            new Operation("sell", 15.00, 50)
        );
        $collection->addOperation(
            new Operation("sell", 15.00, 50)
        );

        $Taxes = new Taxes(
            new TaxCalculator(
                new WeightedProfitPriceCalculator()
            )
        );
        $returnGot = $Taxes->execute($collection);

        self::assertEquals($returnExpected, $returnGot);
    }

    public function testCase1(): void
    {
        $returnExpected = new TaxCollection();
        $returnExpected->addTax(new Tax(0));
        $returnExpected->addTax(new Tax(10_000));
        $returnExpected->addTax(new Tax(0));

        $collection = new OperationCollection();
        $collection->addOperation(
            new Operation("buy", 10.00, 10_000)
        );
        $collection->addOperation(
            new Operation("sell", 20.00, 5_000)
        );
        $collection->addOperation(
            new Operation("sell", 5.00, 5_000)
        );

        $Taxes = new Taxes(
            new TaxCalculator(
                new WeightedProfitPriceCalculator()
            )
        );
        $returnGot = $Taxes->execute($collection);

        self::assertEquals($returnExpected, $returnGot);
    }

    public function testCase2(): void
    {
        $returnExpected = new TaxCollection();
        $returnExpected->addTax(new Tax(0));
        $returnExpected->addTax(new Tax(0));
        $returnExpected->addTax(new Tax(5_000));

        $collection = new OperationCollection();
        $collection->addOperation(
            new Operation("buy", 10.00, 10_000)
        );
        $collection->addOperation(
            new Operation("sell", 5.00, 5_000)
        );
        $collection->addOperation(
            new Operation("sell", 20.00, 5_000)
        );

        $Taxes = new Taxes(
            new TaxCalculator(
                new WeightedProfitPriceCalculator()
            )
        );
        $returnGot = $Taxes->execute($collection);

        self::assertEquals($returnExpected, $returnGot);
    }

    public function testCase3(): void
    {
        $returnExpected = new TaxCollection();
        $returnExpected->addTax(new Tax(0));
        $returnExpected->addTax(new Tax(0));
        $returnExpected->addTax(new Tax(0));

        $collection = new OperationCollection();
        $collection->addOperation(
            new Operation("buy", 10.00, 10_000)
        );
        $collection->addOperation(
            new Operation("buy", 25.00, 5_000)
        );
        $collection->addOperation(
            new Operation("sell", 15.00, 10_000)
        );

        $Taxes = new Taxes(
            new TaxCalculator(
                new WeightedProfitPriceCalculator()
            )
        );
        $returnGot = $Taxes->execute($collection);

        self::assertEquals($returnExpected, $returnGot);
    }

    public function testCase4(): void
    {
        $returnExpected = new TaxCollection();
        $returnExpected->addTax(new Tax(0));
        $returnExpected->addTax(new Tax(0));
        $returnExpected->addTax(new Tax(0));
        $returnExpected->addTax(new Tax(10_000));

        $collection = new OperationCollection();
        $collection->addOperation(
            new Operation("buy", 10.00, 10_000)
        );
        $collection->addOperation(
            new Operation("buy", 25.00, 5_000)
        );
        $collection->addOperation(
            new Operation("sell", 15.00, 10_000)
        );
        $collection->addOperation(
            new Operation("sell", 25.00, 5_000)
        );

        $Taxes = new Taxes(
            new TaxCalculator(
                new WeightedProfitPriceCalculator()
            )
        );
        $returnGot = $Taxes->execute($collection);

        self::assertEquals($returnExpected, $returnGot);
    }

    public function testCase5(): void
    {
        $returnExpected = new TaxCollection();
        $returnExpected->addTax(new Tax(0));
        $returnExpected->addTax(new Tax(0));
        $returnExpected->addTax(new Tax(0));
        $returnExpected->addTax(new Tax(0));
        $returnExpected->addTax(new Tax(3_000));

        $collection = new OperationCollection();
        $collection->addOperation(
            new Operation("buy", 10.00, 10_000)
        );
        $collection->addOperation(
            new Operation("sell", 2.00, 5_000)
        );
        $collection->addOperation(
            new Operation("sell", 20.00, 2_000)
        );
        $collection->addOperation(
            new Operation("sell", 20.00, 2_000)
        );
        $collection->addOperation(
            new Operation("sell", 25.00, 1_000)
        );

        $Taxes = new Taxes(
            new TaxCalculator(
                new WeightedProfitPriceCalculator()
            )
        );
        $returnGot = $Taxes->execute($collection);

        self::assertEquals($returnExpected, $returnGot);
    }
}
