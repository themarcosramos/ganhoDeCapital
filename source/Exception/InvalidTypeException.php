<?php

declare(strict_types=1);

namespace Source\Exception;

use function implode;
use function sprintf;

class InvalidTypeException extends \InvalidArgumentException
{
    public static function throwNew(string $typeGot, array $typesAvailable): self
    {
        return new self(
            sprintf(
                'Invalid type got [ %s ], types available, [ %s ]',
                $typeGot,
                implode(", ", $typesAvailable),
            )
        );
    }
}
