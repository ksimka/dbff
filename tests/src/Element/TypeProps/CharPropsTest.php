<?php

namespace Dbff\Element;

use Dbff\Element\TypeProps\CharProps;

/**
 * CharProps element test
 *
 * @package Dbff\Element
 */
class CharPropsTest extends AbstractElementTest
{
    /**
     * @return array
     */
    public function providerElements()
    {
        return [
            [
                new CharProps('', '', ''),
                ['length' => 0, 'charset' => '', 'collate' => ''],
            ],
            [
                new CharProps('15', 'utf8', 'coll'),
                ['length' => 15, 'charset' => 'utf8', 'collate' => 'coll'],
            ],
        ];
    }
}