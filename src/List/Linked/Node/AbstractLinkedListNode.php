<?php

declare(strict_types=1);

namespace List\Linked\Node;

abstract class AbstractLinkedListNode implements LinkedListNodeInterface
{
    private ?LinkedListNodeInterface $previousNode = null;
    private ?LinkedListNodeInterface $nextNode = null;

    public function getPreviousNode(): ?LinkedListNodeInterface
    {
        return $this->previousNode;
    }

    public function setPreviousNode(?LinkedListNodeInterface $previousNode): void
    {
        $this->previousNode = $previousNode;
    }

    public function getNextNode(): ?LinkedListNodeInterface
    {
        return $this->nextNode;
    }

    public function setNextNode(?LinkedListNodeInterface $nextNode): void
    {
        $this->nextNode = $nextNode;
    }

    public function mutuallyInterlinkWithNextNode(?LinkedListNodeInterface $nextNode): void
    {
        $this->setNextNode($nextNode);
        if ($nextNode !== null) {
            $nextNode->setPreviousNode($this);
        }
    }

    abstract public function getValue(): int|string;
}
