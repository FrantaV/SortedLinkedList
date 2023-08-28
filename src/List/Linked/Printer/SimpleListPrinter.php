<?php

namespace List\Linked\Printer;

use Iterator;

class SimpleListPrinter
{
    public function print(Iterator $sortedLinkedList): void
    {
        $firstValue = true;
        foreach ($sortedLinkedList as $key => $value) {
            if ($firstValue) {
                $firstValue = false;
            } else {
                echo ' -> ';
            }
            echo "[$key] $value";
        }

        echo "\n";
    }
}
