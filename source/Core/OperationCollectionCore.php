<?php

declare(strict_types=1);

namespace Source\Core;

use Source\App\OperationCollection;
use Source\Models\Operation;

class OperationCollectionCore
{
    public static function createFromArray(array $data): OperationCollection
    {
        $operationCollection = new OperationCollection();

        foreach ($data as $line) {
            $operationCollection->addOperation(
                new Operation($line['operation'], $line['unit-cost'], $line['quantity'])
            );
        }

        return $operationCollection;
    }
}
