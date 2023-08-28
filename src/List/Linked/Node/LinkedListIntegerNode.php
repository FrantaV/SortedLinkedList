<?php

declare(strict_types=1);

namespace List\Linked\Node;

class LinkedListIntegerNode extends AbstractLinkedListNode
{
    private readonly int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
