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
    public function testConstruct()
    {
        $emptyCharset = new Charset();

        $props = new CharProps('', $emptyCharset);

        $this->assertSame(0, $props->getLength());
        $this->assertSame($emptyCharset, $props->getCharset());
    }

    /**
     * @return array
     */
    public function providerElements()
    {
        return [
            [
                new CharProps('', new Charset()),
                ['length' => 0, 'charset' => '', 'collate' => ''],
            ],
            [
                new CharProps('15', new Charset('utf8', 'coll')),
                ['length' => 15, 'charset' => 'utf8', 'collate' => 'coll'],
            ],
        ];
    }
}
