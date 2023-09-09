<?php

declare(strict_types=1);

namespace List\Linked\Comparator;

use List\Linked\Node\LinkedListNodeInterface;
use List\Linked\Node\LinkedListStringNode;

class StringStrnatcmpComparator extends AbstractTypeComparator
{
    public function compare(LinkedListNodeInterface $firstNode, LinkedListNodeInterface $secondNode): int
    {
        $this->checkNodeValidation($firstNode, $secondNode);
        return strnatcmp($firstNode->getValue(), $secondNode->getValue());
    }

    protected function nameOfExpectedClass(): string
    {
        return LinkedListStringNode::class;
    }
}
