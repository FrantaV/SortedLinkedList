<?php

declare(strict_types=1);

namespace List\Linked;

use List\Linked\Comparator\ComparatorInterface;
use List\Linked\Node\Factory\LinkedListNodeFactoryInterface;
use List\Linked\Node\LinkedListNodeInterface;
use List\Linked\TypeChecker\DataTypeCheckerInterface;
use Countable;
use Iterator;

/**
 * @implements Iterator<mixed, mixed>
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class SortedLinkedList implements SortedLinkedListInterface, Countable, Iterator
{
    public const INDEX_NOT_FOUND = -1;

    private ?LinkedListNodeInterface $head = null;
    private ?LinkedListNodeInterface $tail = null;
    private int $count = 0;
    private ComparatorInterface $comparator;
    private LinkedListNodeFactoryInterface $nodeFactory;
    private DataTypeCheckerInterface $nodeValueTypeChecker;
    private int $iteratorPosition = 0;
    private ?LinkedListNodeInterface $iteratorCurrentNode = null;

    public function __construct(
        ComparatorInterface $comparator,
        LinkedListNodeFactoryInterface $nodeFactory,
        DataTypeCheckerInterface $nodeValueTypeChecker
    ) {
        $this->comparator = $comparator;
        $this->nodeFactory = $nodeFactory;
        $this->nodeValueTypeChecker = $nodeValueTypeChecker;
    }

    public function add(mixed $value): void
    {
        $this->checkNodeValueDataType($value);
        $newNode = $this->nodeFactory->create($value);
        $this->count++;

        if ($this->isEmpty()) {
            $this->initializeNewListUsingNode($newNode);
            return;
        }

        if ($this->isLowerThanHeadNode($newNode)) {
            $this->makeNodeNewHeadNode($newNode);
            return;
        }

        if ($this->isGreaterThanTailNode($newNode)) {
            $this->makeNodeNewTailNode($newNode);
            return;
        }

        $this->addNodeToSortedList($newNode);
    }

    private function initializeNewListUsingNode(LinkedListNodeInterface $newNode): void
    {
        $this->head = $newNode;
        $this->tail = $newNode;
        $this->rewind();
    }

    private function isLowerThanHeadNode(LinkedListNodeInterface $newNode): bool
    {
        if ($this->head === null) {
            throw new \RuntimeException("Can't compare nodes. Head node isn't set.");
        }

        return $this->comparator->isSecondValueLower($this->head, $newNode);
    }

    private function makeNodeNewHeadNode(LinkedListNodeInterface $newNode): void
    {
        $newNode->mutuallyInterlinkWithNextNode($this->head);
        $this->head = $newNode;
        $this->rewind();
    }

    private function isGreaterThanTailNode(LinkedListNodeInterface $newNode): bool
    {
        if ($this->tail === null) {
            throw new \RuntimeException("Can't compare nodes. Tail node isn't set.");
        }
        return $this->comparator->isSecondValueGreater($this->tail, $newNode);
    }

    private function makeNodeNewTailNode(LinkedListNodeInterface $newNode): void
    {
        if ($this->tail === null) {
            throw new \RuntimeException("Can't compare nodes. Tail node isn't set.");
        }

        $this->tail->mutuallyInterlinkWithNextNode($newNode);
        $this->tail = $newNode;
        $this->rewind();
    }

    private function addNodeToSortedList(LinkedListNodeInterface $newNode): void
    {
        if ($this->head === null) {
            throw new \RuntimeException("Can't compare nodes. Head node isn't set.");
        }

        $currentNode = $this->head;
        do {
            $nextNode = $currentNode->getNextNode();
            if ($nextNode === null) {
                $currentNode->mutuallyInterlinkWithNextNode($newNode);
                $this->tail = $newNode;
                break;
            }

            if ($this->comparator->isSecondValueLower($nextNode, $newNode)) {
                $newNode->mutuallyInterlinkWithNextNode($nextNode);
                $currentNode->mutuallyInterlinkWithNextNode($newNode);
                break;
            }

            $currentNode = $nextNode;
        } while (1);
        $this->rewind();
    }

    public function remove(mixed $value): void
    {
        $this->checkNodeValueDataType($value);
        $currentNode = $this->head;
        while ($currentNode !== null) {
            if ($currentNode->getValue() !== $value) {
                $currentNode = $currentNode->getNextNode();
                continue;
            }

            $previousNode = $currentNode->getPreviousNode();
            $isNodeHeadNode = $previousNode === null;
            if ($isNodeHeadNode) {
                $this->head = $this->head?->getNextNode();
                $this->count--;
                if ($this->isEmpty()) {
                    $this->clear();
                }
                break;
            }

            $nextNode = $currentNode->getNextNode();
            $previousNode->mutuallyInterlinkWithNextNode($nextNode);
            $isNodeTailNode = $nextNode === null;
            if ($isNodeTailNode) {
                $this->tail = $previousNode;
            }

            $this->count--;
            break;
        }
        $this->rewind();
    }

    public function clear(): void
    {
        $this->head = null;
        $this->tail = null;
        $this->count = 0;
        $this->rewind();
    }

    public function count(): int
    {
        return $this->count;
    }

    public function isEmpty(): bool
    {
        return $this->head === null;
    }

    public function exists(mixed $value): bool
    {
        $this->checkNodeValueDataType($value);
        return $this->indexOf($value) >= 0;
    }

    public function indexOf(mixed $value): int
    {
        $this->checkNodeValueDataType($value);
        $currentNode = $this->head;
        $index = 0;
        while ($currentNode !== null) {
            if ($currentNode->getValue() === $value) {
                return $index;
            }
            $index++;
            $currentNode = $currentNode->getNextNode();
        }
        return self::INDEX_NOT_FOUND;
    }

    public function removeDuplicates(): void
    {
        $currentNode = $this->head;
        while ($currentNode !== null) {
            $this->linkNodeWithClosestNextNodeWithDifferentValue($currentNode);
            $currentNode = $currentNode->getNextNode();
        }
        $this->rewind();
    }

    private function linkNodeWithClosestNextNodeWithDifferentValue(LinkedListNodeInterface $node): void
    {
        $nextNode = $node->getNextNode();
        $searchingValue = $node->getValue();

        if ($nextNode === null || $searchingValue !== $nextNode->getValue()) {
            return;
        }

        $currentNode = $nextNode;
        do {
            $currentNode = $currentNode?->getNextNode();
            $currentNodeValue = $currentNode?->getValue();
            $this->count--;
        } while ($searchingValue === $currentNodeValue);
        $node->mutuallyInterlinkWithNextNode($currentNode);
    }

    public function checkNodeValueDataType(mixed $value): void
    {
        $this->nodeValueTypeChecker->checkDataTape($value);
    }

    public function current(): mixed
    {
        return $this->iteratorCurrentNode?->getValue();
    }

    public function next(): void
    {
        $this->iteratorPosition++;
        $this->iteratorCurrentNode = $this->iteratorCurrentNode?->getNextNode();
    }

    public function key(): mixed
    {
        return $this->iteratorPosition;
    }

    public function valid(): bool
    {
        return $this->iteratorCurrentNode !== null;
    }

    public function rewind(): void
    {
        $this->iteratorPosition = 0;
        $this->iteratorCurrentNode = $this->head;
    }
}
