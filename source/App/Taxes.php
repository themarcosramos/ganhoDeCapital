<?php

declare(strict_types=1);

namespace Source\App;

use Source\Models\Operation;

class Taxes
{
    private TaxCalculatorInterface $taxCalculator;

    public function __construct(TaxCalculatorInterface $taxCalculator)
    {
        $this->taxCalculator = $taxCalculator;
    }

    public function execute(OperationCollection $operationCollection): TaxCollection
    {
        $taxCollection = new TaxCollection();

        /** @var Operation $operation */
        foreach ($operationCollection->getCollection() as $operation) {
            $tax = $this
                ->taxCalculator
                ->getTax($operation)
            ;

            $taxCollection->addTax($tax);
        }

        return $taxCollection;
    }
}
