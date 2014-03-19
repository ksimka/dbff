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
    public function testConstruct()
    {
        $props = new IntProps('', '', '');

        $this->assertSame(0, $props->getLength());
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
