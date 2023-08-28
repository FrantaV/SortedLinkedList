<?php

namespace List\Linked;

interface SortedLinkedListInterface
{
    public function add(mixed $value): void;

    public function remove(mixed $value): void;

    public function clear(): void;

    public function isEmpty(): bool;

    public function exists(mixed $value): bool;

    public function removeDuplicates(): void;

    public function indexOf(mixed $value): int;
}
