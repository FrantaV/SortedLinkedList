<?php

namespace unit\List\Linked\Comparator;

use List\Linked\Comparator\ComparatorInterface;
use List\Linked\Comparator\IntegerComparator;
use List\Linked\Node\LinkedListIntegerNode;
use List\Linked\Node\LinkedListStringNode;
use PHPUnit\Framework\TestCase;

final class IntegerComparatorTest extends TestCase
{
    public function testLowerNumber(): void
    {
        $integerNode = new LinkedListIntegerNode(10);
        $greaterNode = new LinkedListIntegerNode(30);
        $comparator = new IntegerComparator();
        $this->assertSame(ComparatorInterface::LOWER, $comparator->compare($integerNode, $greaterNode));
    }

    public function testGreaterNumber(): void
    {
        $integerNode = new LinkedListIntegerNode(10);
        $lowerNode = new LinkedListIntegerNode(5);
        $comparator = new IntegerComparator();
        $this->assertSame(ComparatorInterface::GREATER, $comparator->compare($integerNode, $lowerNode));
    }

    public function testEqualNumber(): void
    {
        $integerNode = new LinkedListIntegerNode(10);
        $equalNode = new LinkedListIntegerNode(10);
        $comparator = new IntegerComparator();
        $this->assertSame(ComparatorInterface::EQUAL, $comparator->compare($integerNode, $equalNode));
    }

    public function testCompareInvalidParamTypeString(): void
    {
        $integerNode = new LinkedListIntegerNode(10);
        $comparator = new IntegerComparator();
        $this->expectException(\TypeError::class);
        $comparator->compare('as', $integerNode);
    }

    public function testCompareInvalidParamTypeStringNode(): void
    {
        $stringNode = new LinkedListStringNode('as');
        $integerNode = new LinkedListIntegerNode(10);
        $comparator = new IntegerComparator();
        $this->expectException(\UnexpectedValueException::class);
        $comparator->compare($stringNode, $integerNode);
    }
}
