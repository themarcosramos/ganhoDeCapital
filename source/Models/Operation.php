<?php

declare(strict_types=1);

namespace Source\Models;

use Source\Exception\InvalidTypeException;

use function in_array;

class Operation
{
    private const TYPE_BUY = "buy";
    private const TYPE_SELL = "sell";
    private const SELL_TAX_EXEMPTION_MINIMUM = 20000;
    private string $type;
    private float $unitCost;
    private float $quantity;

    public function __construct(string $type, float $unitCost, float $quantity)
    {
        if (!self::isValidType($type)) {
            throw InvalidTypeException::throwNew($type, self::getTypesAvailable());
        }
        $this->type = $type;
        $this->unitCost = $unitCost;
        $this->quantity = $quantity;
    }

    public function isTypeBuy(): bool
    {
        return $this->type === self::TYPE_BUY;
    }

    public function isTypeSell(): bool
    {
        return $this->type === self::TYPE_SELL;
    }

    public function getUnitCost(): float
    {
        return $this->unitCost;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

    public function getTotal(): float
    {
        return $this->unitCost * $this->quantity;
    }

    public function isTaxExemption(): bool
    {
        return $this->isTypeSell() && $this->getTotal() <= self::SELL_TAX_EXEMPTION_MINIMUM;
    }

    private static function isValidType(string $type): bool
    {
        return in_array($type, self::getTypesAvailable());
    }

    private static function getTypesAvailable(): array
    {
        return [self::TYPE_BUY, self::TYPE_SELL];
    }
}
