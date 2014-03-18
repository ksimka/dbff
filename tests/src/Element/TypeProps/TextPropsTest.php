<?php

namespace Dbff\Element;

use Dbff\Element\TypeProps\TextProps;

/**
 * TextProps element test
 * 
 * @package Dbff\Element
 */
class TextPropsTest extends AbstractElementTest
{
    /**
     * @return array
     */
    public function providerElements()
    {
        return [
            [
                new TextProps('', '', ''),
                ['binary' => false, 'charset' => '', 'collate' => ''],
            ],
            [
                new TextProps('binary', 'cs20', 'col11'),
                ['binary' => true, 'charset' => 'cs20', 'collate' => 'col11'],
            ],
        ];
    }
}
