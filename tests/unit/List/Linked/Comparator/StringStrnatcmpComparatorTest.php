<?php

namespace unit\List\Linked\Comparator;

use List\Linked\Comparator\ComparatorInterface;
use List\Linked\Comparator\StringStrnatcmpComparator;
use List\Linked\Node\LinkedListIntegerNode;
use List\Linked\Node\LinkedListStringNode;
use PHPUnit\Framework\TestCase;

class StringStrnatcmpComparatorTest extends TestCase
{
    public function testLowerStringValue(): void
    {
        $stringNode = new LinkedListStringNode('Gandalf5');
        $greaterValueNode = new LinkedListStringNode('Gandalf125');
        $comparator = new StringStrnatcmpComparator();
        $this->assertSame(ComparatorInterface::LOWER, $comparator->compare($stringNode, $greaterValueNode));
    }

    public function testGreaterStringValue(): void
    {
        $stringNode = new LinkedListStringNode('Gandalf123');
        $lowerValueNode =  new LinkedListStringNode('Gandalf1');
        $comparator = new StringStrnatcmpComparator();
        $this->assertSame(ComparatorInterface::GREATER, $comparator->compare($stringNode, $lowerValueNode));
    }

    public function testEqualStringValue(): void
    {
        $stringNode = new LinkedListStringNode('Gandalf123');
        $equalValueNode = new LinkedListStringNode('Gandalf123');
        $comparator = new StringStrnatcmpComparator();
        $this->assertSame(ComparatorInterface::EQUAL, $comparator->compare($stringNode, $equalValueNode));
    }

    public function testCompareInvalidParamTypeString(): void
    {
        $integerNode = new LinkedListStringNode(10);
        $sortedLinkedList = new StringStrnatcmpComparator();
        $this->expectException(\TypeError::class);
        $sortedLinkedList->compare([], $integerNode);
    }

    public function testCompareInvalidParamTypeStringNode(): void
    {
        $stringNode = new LinkedListStringNode('as');
        $integerNode = new LinkedListIntegerNode(10);
        $sortedLinkedList = new StringStrnatcmpComparator();
        $this->expectException(\UnexpectedValueException::class);
        $sortedLinkedList->compare($stringNode, $integerNode);
    }
}
