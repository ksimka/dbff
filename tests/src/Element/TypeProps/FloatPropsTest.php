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
    public function testConstruct()
    {
        $props = new FloatProps('', '', '', '');

        $this->assertSame(0, $props->getLength());
        $this->assertSame(0, $props->getDecimal());
        $this->assertSame(false, $props->isUnsigned());
        $this->assertSame(false, $props->isZerofill());
    }

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
