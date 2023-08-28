<?php

namespace List\Linked\TypeChecker;

interface DataTypeCheckerInterface
{
    public function checkDataTape(mixed $value): void;
}
