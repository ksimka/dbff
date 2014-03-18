<?php

namespace Dbff\Element;

use Dbff\Element\TypeProps\FloatProps;

/**
 * FloatProps element test
 * 
 * @package Dbff\Element
 */
class FloatPropsTest extends AbstractElementTest
{
    /**
     * @return array
     */
    public function providerElements()
    {
        return [
            [
                new FloatProps('', '', '', ''),
                ['length' => 0, 'decimal' => 0, 'unsigned' => false, 'zerofill' => false],
            ],
            [
                new FloatProps('10', '5', 'unsigned', 'zerofill'),
                ['length' => 10, 'decimal' => 5, 'unsigned' => true, 'zerofill' => true],
            ],
        ];
    }
}
