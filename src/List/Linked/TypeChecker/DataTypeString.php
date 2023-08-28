<?php

namespace List\Linked\TypeChecker;

use UnexpectedValueException;

class DataTypeString implements DataTypeCheckerInterface
{
    public function checkDataTape(mixed $value): void
    {
        if (!is_string($value)) {
            throw new UnexpectedValueException('Value isn\'t type of string.');
        }
    }
}
