<?php

declare(strict_types=1);

namespace List\Linked\Comparator;

use List\Linked\Node\LinkedListIntegerNode;
use List\Linked\Node\LinkedListNodeInterface;

class IntegerComparator extends AbstractTypeComparator
{
    public function compare(LinkedListNodeInterface $firstNode, LinkedListNodeInterface $secondNode): int
    {
        $this->checkNodeValidation($firstNode, $secondNode);
        return $firstNode->getValue() <=> $secondNode->getValue();
    }

    protected function nameOfExpectedClass(): string
    {
        return LinkedListIntegerNode::class;
    }
}
