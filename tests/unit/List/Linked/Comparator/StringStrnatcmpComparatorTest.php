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
        $greaterNode = new LinkedListStringNode('Gandalf125');
        $comparator = new StringStrnatcmpComparator();
        $this->assertSame(ComparatorInterface::GREATER, $comparator->compare($stringNode, $greaterNode));
        $this->assertTrue($comparator->isSecondValueGreater($stringNode, $greaterNode));
    }

    public function testGreaterStringValue(): void
    {
        $stringNode = new LinkedListStringNode('Gandalf123');
        $lowerNode =  new LinkedListStringNode('Gandalf1');
        $comparator = new StringStrnatcmpComparator();
        $this->assertSame(ComparatorInterface::LOWER, $comparator->compare($stringNode, $lowerNode));
        $this->assertTrue($comparator->isSecondValueLower($stringNode, $lowerNode));
    }

    public function testEqualStringValue(): void
    {
        $stringNode = new LinkedListStringNode('Gandalf123');
        $equalNode = new LinkedListStringNode('Gandalf123');
        $comparator = new StringStrnatcmpComparator();
        $this->assertSame(ComparatorInterface::EQUAL, $comparator->compare($stringNode, $equalNode));
        $this->assertTrue($comparator->areValuesEqual($stringNode, $equalNode));
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
