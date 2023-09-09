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
        if (!$this->areNodesValid($firstNode, $secondNode)) {
            throw new UnexpectedValueException(
                'Comparator expected ' . $this->nameOfExpectedClass() . '. ' . get_class($firstNode)
                . ' and ' . get_class($secondNode) . ' given.'
            );
        }
    }

    private function areNodesValid(LinkedListNodeInterface $firstNode, LinkedListNodeInterface $secondNode): bool
    {
        return $this->isNodeValid($firstNode) && $this->isNodeValid($secondNode);
    }

    private function isNodeValid(LinkedListNodeInterface $node): bool
    {
        $expectedTypeOfClass = $this->nameOfExpectedClass();
        return $node instanceof $expectedTypeOfClass;
    }

    public function isSecondValueGreater(
        LinkedListNodeInterface $firstValue,
        LinkedListNodeInterface $secondValue
    ): bool {
        return $this->compare($firstValue, $secondValue) === ComparatorInterface::GREATER;
    }

    public function isSecondValueLower(LinkedListNodeInterface $firstValue, LinkedListNodeInterface $secondValue): bool
    {
        return $this->compare($firstValue, $secondValue) === ComparatorInterface::LOWER;
    }

    public function areValuesEqual(LinkedListNodeInterface $firstValue, LinkedListNodeInterface $secondValue): bool
    {
        return $this->compare($firstValue, $secondValue) === ComparatorInterface::EQUAL;
    }

    abstract protected function nameOfExpectedClass(): string;
}
