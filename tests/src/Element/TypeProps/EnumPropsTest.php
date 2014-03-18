<?php

namespace Dbff\Element;

use Dbff\Element\TypeProps\EnumProps;

/**
 * EnumProps element test
 * 
 * @package Dbff\Element
 */
class EnumPropsTest extends AbstractElementTest
{
    /**
     * @return array
     */
    public function providerElements()
    {
        return [
            [
                new EnumProps([], '', ''),
                ['values' => [], 'charset' => '', 'collate' => ''],
            ],
            [
                new EnumProps(['val1', 'val2'], 'cs', 'cl'),
                ['values' => ['val1', 'val2'], 'charset' => 'cs', 'collate' => 'cl'],
            ],
        ];
    }
}
