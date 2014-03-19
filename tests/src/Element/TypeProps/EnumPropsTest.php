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
    public function testConstruct()
    {
        $emptyCharset = new Charset();

        $props = new EnumProps([], $emptyCharset);

        $this->assertSame([], $props->getEnumValues());
        $this->assertSame($emptyCharset, $props->getCharset());
    }

    /**
     * @return array
     */
    public function providerElements()
    {
        return [
            [
                new EnumProps([], new Charset()),
                ['values' => [], 'charset' => '', 'collate' => ''],
            ],
            [
                new EnumProps(['val1', 'val2'], new Charset('cs', 'cl')),
                ['values' => ['val1', 'val2'], 'charset' => 'cs', 'collate' => 'cl'],
            ],
        ];
    }
}
