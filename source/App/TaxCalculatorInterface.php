<?php

declare(strict_types=1);

namespace Source\App;

use Source\Models\Operation;
use Source\Models\Tax;

interface TaxCalculatorInterface
{
    public function getTax(Operation $operation): Tax;
}
