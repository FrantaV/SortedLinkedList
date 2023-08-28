<?php

declare(strict_types=1);

namespace List\Linked\Node;

class LinkedListStringNode extends AbstractLinkedListNode
{
    private readonly string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
