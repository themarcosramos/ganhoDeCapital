<?php

declare(strict_types=1);

namespace Source\App;

use Source\Models\Operation;
use Source\Models\Tax;

class TaxCalculator implements TaxCalculatorInterface
{
    private const TAX_PERCENT_DECIMAL = 0.2;
    private ProfitPriceCalculatorInterface $profitPriceCalculator;
    private float $lossAmount;

    public function __construct(ProfitPriceCalculatorInterface $profitPriceCalculator)
    {
        $this->profitPriceCalculator = $profitPriceCalculator;
        $this->lossAmount = 0;
    }

    public function getTax(Operation $operation): Tax
    {
        if ($operation->isTypeBuy()) {
            $this
                ->profitPriceCalculator
                ->addBuyOperation($operation)
            ;
            return new Tax(0);
        }

        if ($operation->isTaxExemption()) {
            return $this->getTaxExemptionCalculated($operation);
        }

        return $this->getTaxCalculated($operation);
    }

    private function getTaxExemptionCalculated(Operation $operation): Tax
    {
        $profitPrice = $this
            ->profitPriceCalculator
            ->getPrice()
        ;

        if ($profitPrice > $operation->getUnitCost()) {
            $this->increaseLossAmountOperation($operation);
        }

        return new Tax(0);
    }

    private function getTaxCalculated(Operation $operation): Tax
    {
        $profitPrice = $this
            ->profitPriceCalculator
            ->getPrice()
        ;

        if ($profitPrice > $operation->getUnitCost()) {
            $this->increaseLossAmountOperation($operation);
            return new Tax(0);
        }

        $operationProfitCalculated = new Operation("sell", $profitPrice, $operation->getQuantity());

        if ($this->lossAmount > $operationProfitCalculated->getTotal()) {
            $this->lossAmount -= $operationProfitCalculated->getTotal();
            return new Tax(0);
        }

        $totalProfitPrice = $operation->getTotal() - $operationProfitCalculated->getTotal();

        if ($this->lossAmount > 0) {
            $totalProfitPrice -= $this->lossAmount;
            $this->lossAmount = 0;
        }

        return new Tax($totalProfitPrice * self::TAX_PERCENT_DECIMAL);
    }

    private function increaseLossAmountOperation(Operation $operation): void
    {
        $profitPrice = $this
            ->profitPriceCalculator
            ->getPrice()
        ;

        $operationProfitCalculated = new Operation("sell", $profitPrice, $operation->getQuantity());
        $this->lossAmount += ($operationProfitCalculated->getTotal() - $operation->getTotal());
    }
}
