<?php

namespace List\Linked\Node;

interface LinkedListNodeInterface
{
    /**
     * @return LinkedListNodeInterface|null
     */
    public function getPreviousNode(): ?LinkedListNodeInterface;

    /**
     * @param AbstractLinkedListNode $prevNode
     */
    public function setPreviousNode(?LinkedListNodeInterface $prevNode): void;

    /**
     * @return LinkedListNodeInterface|null
     */
    public function getNextNode(): ?LinkedListNodeInterface;

    /**
     * @param LinkedListNodeInterface $nextNode
     */
    public function setNextNode(?LinkedListNodeInterface $nextNode): void;

    public function getValue(): mixed;

    public function mutuallyInterlinkWithNextNode(?LinkedListNodeInterface $nextNode): void;
}
