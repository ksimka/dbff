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
    public function testConstruct()
    {
        $emptyCharset = new Charset();

        $props = new TextProps('', $emptyCharset);

        $this->assertSame(false, $props->isBinary());
        $this->assertSame($emptyCharset, $props->getCharset());
    }

    /**
     * @return array
     */
    public function providerElements()
    {
        return [
            [
                new TextProps('', new Charset()),
                ['binary' => false, 'charset' => '', 'collate' => ''],
            ],
            [
                new TextProps('binary', new Charset('cs20', 'col11')),
                ['binary' => true, 'charset' => 'cs20', 'collate' => 'col11'],
            ],
        ];
    }
}
