<?php

declare(strict_types=1);

namespace List\Linked\Node\Factory;

use List\Linked\Node\LinkedListNodeInterface;
use List\Linked\Node\LinkedListStringNode;

class LinkedListStringNodeFactory implements LinkedListNodeFactoryInterface
{
    public function create(mixed $value): LinkedListNodeInterface
    {
        return new LinkedListStringNode($value);
    }
}
