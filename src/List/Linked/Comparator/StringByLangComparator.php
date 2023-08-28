<?php

declare(strict_types=1);

namespace List\Linked\Comparator;

use List\Linked\Node\LinkedListNodeInterface;
use List\Linked\Node\LinkedListStringNode;
use Exception;
use Collator;

class StringByLangComparator extends AbstractTypeComparator implements ComparatorInterface
{
    private Collator $collator;

    public function __construct(string $lang = 'en_US')
    {
        $this->collator = new Collator($lang);
    }

    public function compare(LinkedListNodeInterface $firstNode, LinkedListNodeInterface $secondNode): int
    {
        $this->checkNodeValidation($firstNode, $secondNode);
        $result = $this->collator->compare($firstNode->getValue(), $secondNode->getValue());

        if ($result === false) {
            throw new Exception(
                'Error while comparing values: ' . $firstNode->getValue() . ' and ' . $secondNode->getValue()
            );
        }
        return $result;
    }

    protected function nameOfExpectedClass(): string
    {
        return LinkedListStringNode::class;
    }
}
