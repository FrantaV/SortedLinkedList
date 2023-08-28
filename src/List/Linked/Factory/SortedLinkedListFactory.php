<?php

declare(strict_types=1);

namespace List\Linked\Factory;

use List\Linked\Comparator\IntegerComparator;
use List\Linked\Comparator\StringStrnatcmpComparator;
use List\Linked\Node\Factory\LinkedListIntegerNodeFactory;
use List\Linked\Node\Factory\LinkedListStringNodeFactory;
use List\Linked\SortedLinkedList;
use List\Linked\TypeChecker\DataTypeInteger;
use List\Linked\TypeChecker\DataTypeString;

class SortedLinkedListFactory
{
    public function createSortedLinkedListIntegerType(): SortedLinkedList
    {
        return new SortedLinkedList(
            new IntegerComparator(),
            new LinkedListIntegerNodeFactory(),
            new DataTypeInteger()
        );
    }

    public function createSortedLinkedListStringType(): SortedLinkedList
    {
        return new SortedLinkedList(
            new StringStrnatcmpComparator(),
            new LinkedListStringNodeFactory(),
            new DataTypeString()
        );
    }
}
