<?php

declare(strict_types=1);

namespace Source\App;

use Source\Models\Tax;

class TaxCollection
{
    private array $collection;

    public function __construct()
    {
        $this->collection = [];
    }

    public function addTax(Tax $tax): void
    {
        $this->collection[] = $tax;
    }

    public function getCollection(): array
    {
        return $this->collection;
    }
}
