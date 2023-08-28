<?php

declare(strict_types=1);


namespace unit\List\Linked;

use List\Linked\Factory\SortedLinkedListFactory;
use PHPUnit\Framework\TestCase;

final class SortedLinkedListTest extends TestCase
{
    public function testEmptyList(): void
    {
        $sortedLinkedListIntegerType = (new SortedLinkedListFactory())->createSortedLinkedListIntegerType();
        $this->assertSame(0, $sortedLinkedListIntegerType->count());
        $sortedLinkedListIntegerType->remove(10);
        $this->assertSame(0, $sortedLinkedListIntegerType->count());
    }

    public function testAddValue(): void
    {
        $sortedLinkedListIntegerType = (new SortedLinkedListFactory())->createSortedLinkedListIntegerType();
        $sortedLinkedListIntegerType->add(10);
        $this->assertSame(1, $sortedLinkedListIntegerType->count());
    }

    public function testAddAndRemoveOneValue(): void
    {
        $sortedLinkedListIntegerType = (new SortedLinkedListFactory())->createSortedLinkedListIntegerType();
        $sortedLinkedListIntegerType->add(10);
        $this->assertSame(1, $sortedLinkedListIntegerType->count());
        $sortedLinkedListIntegerType->remove(10);
        $this->assertSame(0, $sortedLinkedListIntegerType->count());
    }

    public function testAddInvalidValueTypeString(): void
    {
        $sortedLinkedListIntegerType = (new SortedLinkedListFactory())->createSortedLinkedListIntegerType();
        $this->expectException(\UnexpectedValueException::class);
        $sortedLinkedListIntegerType->add('10');
    }

    public function testAddInvalidValueTypeArray(): void
    {
        $sortedLinkedListIntegerType = (new SortedLinkedListFactory())->createSortedLinkedListIntegerType();
        $this->expectException(\UnexpectedValueException::class);
        $sortedLinkedListIntegerType->add([]);
    }

    public function testAddThreeValuesAndClearListAfterThat(): void
    {
        $sortedLinkedListIntegerType = (new SortedLinkedListFactory())->createSortedLinkedListIntegerType();
        $sortedLinkedListIntegerType->add(10);
        $sortedLinkedListIntegerType->add(20);
        $sortedLinkedListIntegerType->add(30);
        $this->assertSame(3, $sortedLinkedListIntegerType->count());
        $sortedLinkedListIntegerType->clear();
        $this->assertSame(0, $sortedLinkedListIntegerType->count());
    }

    public function testSortingOfIntegersValues(): void
    {
        $sortedLinkedListIntegerType = (new SortedLinkedListFactory())->createSortedLinkedListIntegerType();
        $testValues = [
            123,
            12,
            54,
            2,
            7,
            789,
            29,
            98,
            3,
        ];

        foreach ($testValues as $testValue) {
            $sortedLinkedListIntegerType->add($testValue);
        }

        $this->assertSame(9, $sortedLinkedListIntegerType->count());
        $this->assertSame(2, $sortedLinkedListIntegerType->indexOf(7));
        $this->assertSame(8, $sortedLinkedListIntegerType->indexOf(789));
    }

    public function testSortingOfStringValues(): void
    {
        $sortedLinkedListStringType = (new SortedLinkedListFactory())->createSortedLinkedListStringType();
        $testValues = [
            'Gandalf123',
            'Gandalf12',
            'Heracles',
            'Achlys',
            'Owen Zastava Pitt',
            'Zeus',
            'E.T.',
            'Xena',
            'Brumla',
        ];

        foreach ($testValues as $testValue) {
            $sortedLinkedListStringType->add($testValue);
        }
        $this->assertSame(9, $sortedLinkedListStringType->count());
        $this->assertSame(2, $sortedLinkedListStringType->indexOf('E.T.'));
        $this->assertSame(7, $sortedLinkedListStringType->indexOf('Xena'));
    }

    public function testRemovingIntegerValues(): void
    {
        $sortedLinkedListIntegerType = (new SortedLinkedListFactory())->createSortedLinkedListIntegerType();

        $testValues = [
            123,
            12,
            54,
            7,
            789,
            29,
            98,
            3,
        ];

        foreach ($testValues as $testValue) {
            $sortedLinkedListIntegerType->add($testValue);
        }

        $removeValues = [
            54,
            156489498461651651,
            3,
            789,
        ];

        foreach ($removeValues as $removeValue) {
            $sortedLinkedListIntegerType->remove($removeValue);
        }

        $this->assertSame(5, $sortedLinkedListIntegerType->count());
    }

    public function testRemovingStringValues(): void
    {
        $sortedLinkedListStringType = (new SortedLinkedListFactory())->createSortedLinkedListStringType();
        $testValues = [
            'Gandalf123',
            'Gandalf12',
            'Heracles',
            'Achilles',
            'Zeus',
            'E.T.',
            'Xena',
            'Brumla',
        ];

        foreach ($testValues as $testValue) {
            $sortedLinkedListStringType->add($testValue);
        }

        $removeValues = [
            'Gandalf123',
            'Frodo',
            'Achilles',
            'Zeus',
        ];

        foreach ($removeValues as $removeValue) {
            $sortedLinkedListStringType->remove($removeValue);
        }

        $this->assertSame(5, $sortedLinkedListStringType->count());
    }

    public function testFindValuesWithDuplicity(): void
    {
        $sortedLinkedListIntegerType = (new SortedLinkedListFactory())->createSortedLinkedListIntegerType();
        $testValues = [
            12,
            12,
            12,
            15,
            42,
            42,
            42,
        ];
        foreach ($testValues as $testValue) {
            $sortedLinkedListIntegerType->add($testValue);
        }
        $this->assertSame(7, $sortedLinkedListIntegerType->count());
        $this->assertSame(4, $sortedLinkedListIntegerType->indexOf(42));
    }

    public function testRemoveDuplicates(): void
    {
        $sortedLinkedListIntegerType = (new SortedLinkedListFactory())->createSortedLinkedListIntegerType();
        $testValues = [
            12,
            12,
            12,
            15,
            42,
            42,
            42,
        ];
        foreach ($testValues as $testValue) {
            $sortedLinkedListIntegerType->add($testValue);
        }

        $this->assertSame(7, $sortedLinkedListIntegerType->count());
        $this->assertSame(4, $sortedLinkedListIntegerType->indexOf(42));
        $sortedLinkedListIntegerType->removeDuplicates();
        $this->assertSame(3, $sortedLinkedListIntegerType->count());
        $this->assertSame(2, $sortedLinkedListIntegerType->indexOf(42));
    }
}
