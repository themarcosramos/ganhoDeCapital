<?php

declare(strict_types=1);

namespace Source\Core;

use Source\App\TaxCollection;
use Source\Models\Tax;

use function json_encode;

class TaxCollectionCore
{
    private TaxCollection $taxCollection;

    public function __construct(TaxCollection $taxCollection)
    {
        $this->taxCollection = $taxCollection;
    }

    public function getResponse(): string
    {
        $response = [];

        /** @var Tax $tax */
        foreach ($this->taxCollection->getCollection() as $tax) {
            $response[] = ['tax' => $tax->getAmount()];
        }

        return json_encode($response);
    }
}
