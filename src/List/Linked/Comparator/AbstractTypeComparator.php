<?php

declare(strict_types=1);

namespace List\Linked\Comparator;

use List\Linked\Node\LinkedListNodeInterface;
use UnexpectedValueException;

abstract class AbstractTypeComparator implements ComparatorInterface
{
    protected function checkNodeValidation(
        LinkedListNodeInterface $firstNode,
        LinkedListNodeInterface $secondNode
    ): void {
        if (!$this->nodesAreValid($firstNode, $secondNode)) {
            throw new UnexpectedValueException(
                'Comparator expected ' . $this->nameOfExpectedClass() . '. ' . get_class($firstNode)
                . ' and ' . get_class($secondNode) . ' given.'
            );
        }
    }

    private function nodesAreValid(LinkedListNodeInterface $firstNode, LinkedListNodeInterface $secondNode): bool
    {
        return $this->isNodeValid($firstNode) && $this->isNodeValid($secondNode);
    }

    private function isNodeValid(LinkedListNodeInterface $node): bool
    {
        $expectedTypeOfClass = $this->nameOfExpectedClass();
        return $node instanceof $expectedTypeOfClass;
    }

    abstract protected function nameOfExpectedClass(): string;
}
