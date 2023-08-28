<?php

namespace List\Linked\Node\Factory;

use List\Linked\Node\LinkedListNodeInterface;

interface LinkedListNodeFactoryInterface
{
    public function create(mixed $value): LinkedListNodeInterface;
}
