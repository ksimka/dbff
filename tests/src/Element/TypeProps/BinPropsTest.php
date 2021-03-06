<?php

namespace Dbff\Element;

use Dbff\Element\TypeProps\BinProps;

/**
 * BinProps element test
 *
 * @package Dbff\Element
 */
class BinPropsTest extends AbstractElementTest
{
    public function testConstruct()
    {
        $props = new BinProps('');

        $this->assertSame(0, $props->getLength());
    }

    /**
     * @return array
     */
    public function providerElements()
    {
        return [
            [
                new BinProps(''),
                ['length' => 0],
            ],
            [
                new BinProps('100'),
                ['length' => 100],
            ],
        ];
    }
}
