<?php

namespace Dbff\Element;

use Dbff\Element\TypeProps\EmptyProps;

/**
 * Type element test
 *
 * @package Dbff\Element
 */
class TypeTest extends AbstractElementTest
{
    public function testConstruct()
    {
        $emptyProps = new EmptyProps();

        $type = new Type('', $emptyProps);

        $this->assertSame('', $type->getType());
        $this->assertSame($emptyProps, $type->getProps());
    }

    /**
     * @return array
     */
    public function providerElements()
    {
        $emptyProps = new EmptyProps();

        return [
            [
                new Type('', $emptyProps),
                ['name' => '', 'props' => $emptyProps]
            ],
            [
                new Type('int', $emptyProps),
                ['name' => 'int', 'props' => $emptyProps]
            ],
        ];
    }
}
