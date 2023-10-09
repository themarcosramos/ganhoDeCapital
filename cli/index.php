<?php

use Source\App\Taxes;
use Source\App\TaxCalculator;
use Source\App\WeightedProfitPriceCalculator;
use Source\Core\OperationCollectionCore;
use Source\Core\TaxCollectionCore;

require dirname(__DIR__) . '/vendor/autoload.php';

while ($line = \fgets(STDIN)) {
    $line = \strtolower(trim($line));
    $data = \json_decode(\strtolower(trim($line)), true);

    $operationCollection = OperationCollectionCore::createFromArray($data);

    $Taxes = new Taxes(
        new TaxCalculator(
            new WeightedProfitPriceCalculator()
        )
    );

    $taxCollection = $Taxes->execute($operationCollection);
    $response = new TaxCollectionCore($taxCollection);
    \fwrite(STDOUT, $response->getResponse());
}
