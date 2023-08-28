<?php

namespace List\Linked\TypeChecker;

use UnexpectedValueException;

class DataTypeInteger implements DataTypeCheckerInterface
{
    public function checkDataTape(mixed $value): void
    {
        if (!is_integer($value)) {
            throw new UnexpectedValueException('Value isn\'t type of integer');
        }
    }
}
