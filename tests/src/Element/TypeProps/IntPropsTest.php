<?php

namespace Dbff\Element;

use Dbff\Element\TypeProps\IntProps;

/**
 * IntProps element test
 *
 * @package Dbff\Element
 */
class IntPropsTest extends AbstractElementTest
{
    /**
     * @return array
     */
    public function providerElements()
    {
        return [
            [
                new IntProps('', '', ''),
                ['length' => 0, 'unsigned' => false, 'zerofill' => false],
            ],
            [
                new IntProps('11', 'unsigned', 'zerofill'),
                ['length' => 11, 'unsigned' => true, 'zerofill' => true],
            ],
        ];
    }
}
