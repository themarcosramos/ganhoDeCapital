<?php

declare(strict_types=1);

namespace Source\App;

use Source\Models\Operation;

interface ProfitPriceCalculatorInterface
{
    public function addBuyOperation(Operation $operation): void;

    public function getPrice(): float;
}
