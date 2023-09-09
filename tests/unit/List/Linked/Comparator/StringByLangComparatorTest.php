<?php

namespace unit\List\Linked\Comparator;

use List\Linked\Comparator\ComparatorInterface;
use List\Linked\Comparator\StringByLangComparator;
use List\Linked\Node\LinkedListIntegerNode;
use List\Linked\Node\LinkedListStringNode;
use PHPUnit\Framework\TestCase;

class StringByLangComparatorTest extends TestCase
{
    public function testLowerNumber(): void
    {
        $stringNode = new LinkedListStringNode('Řeřicha');
        $greaterNode = new LinkedListStringNode('Zámek');
        $comparator = new StringByLangComparator('cs_CZ');
        $this->assertSame(ComparatorInterface::GREATER, $comparator->compare($stringNode, $greaterNode));
        $this->assertTrue($comparator->isSecondValueGreater($stringNode, $greaterNode));
    }

    public function testGreaterNumber(): void
    {
        $stringNode = new LinkedListStringNode('Vopice');
        $lowerNode = new LinkedListStringNode('Vokno');
        $comparator = new StringByLangComparator('cs_CZ');
        $this->assertSame(ComparatorInterface::LOWER, $comparator->compare($stringNode, $lowerNode));
        $this->assertTrue($comparator->isSecondValueLower($stringNode, $lowerNode));
    }

    public function testEqualNumber(): void
    {
        $stringNode = new LinkedListStringNode('Žemlovka');
        $equalNode = new LinkedListStringNode('Žemlovka');
        $comparator = new StringByLangComparator('cs_CZ');
        $this->assertSame(ComparatorInterface::EQUAL, $comparator->compare($stringNode, $equalNode));
        $this->assertTrue($comparator->areValuesEqual($stringNode, $equalNode));
    }

    public function testCompareInvalidParamTypeString(): void
    {
        $integerNode = new LinkedListStringNode(10);
        $comparator = new StringByLangComparator();
        $this->expectException(\TypeError::class);
        $comparator->compare([], $integerNode);
    }

    public function testCompareInvalidParamTypeStringNode(): void
    {
        $stringNode = new LinkedListStringNode('as');
        $integerNode = new LinkedListIntegerNode(10);
        $comparator = new StringByLangComparator();
        $this->expectException(\UnexpectedValueException::class);
        $comparator->compare($stringNode, $integerNode);
    }
}
