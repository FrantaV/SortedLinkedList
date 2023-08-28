<?php

declare(strict_types=1);

namespace List\Linked\Node\Factory;

use List\Linked\Node\LinkedListIntegerNode;
use List\Linked\Node\LinkedListNodeInterface;

class LinkedListIntegerNodeFactory implements LinkedListNodeFactoryInterface
{
    public function create(mixed $value): LinkedListNodeInterface
    {
        return new LinkedListIntegerNode($value);
    }
}
