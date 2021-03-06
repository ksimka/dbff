<?php

namespace Dbff\Element;

use Dbff\Element\TypeProps\EmptyProps;

/**
 * EmptyProps element test
 *
 * @package Dbff\Element
 */
class EmptyPropsTest extends AbstractElementTest
{
    public function testConstruct()
    {
        $props = new EmptyProps();

        $this->assertSame([], $props->getDefinition());
    }

    /**
     * @return array
     */
    public function providerElements()
    {
        return [
            [
                new EmptyProps(),
                [],
            ],
        ];
    }
}
