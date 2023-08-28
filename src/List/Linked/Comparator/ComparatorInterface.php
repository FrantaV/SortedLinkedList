<?php

declare(strict_types=1);

namespace List\Linked\Comparator;

use List\Linked\Node\LinkedListNodeInterface;

interface ComparatorInterface
{
    public const GREATER = 1;
    public const EQUAL = 0;
    public const LOWER = -1;

    public function compare(LinkedListNodeInterface $firstNode, LinkedListNodeInterface $secondNode): int;
}
