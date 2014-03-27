<?php

namespace Dbff\Element;

use Dbff\Element\TypeProps\CharProps;
use Dbff\Element\TypeProps\EmptyProps;
use Dbff\Element\TypeProps\FloatProps;
use Dbff\Element\TypeProps\IntProps;

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

    public function providerConvertDefault()
    {
        return [
            [
                new Type('int', new IntProps(10, true, false)),
                '100',
                100,
            ],
            [
                new Type('int', new IntProps(10, true, false)),
                '',
                0,
            ],
            [
                new Type('int', new IntProps(10, true, false)),
                null,
                null,
            ],
            [
                new Type('float', new FloatProps(10, 5, true, false)),
                '100',
                100.0,
            ],
            [
                new Type('float', new FloatProps(10, 5, true, false)),
                null,
                null,
            ],
            [
                new Type('float', new FloatProps(10, 5, true, false)),
                '',
                0.0,
            ],
            [
                new Type('char', new CharProps(10, new Charset())),
                1000,
                '1000',
            ],
            [
                new Type('char', new CharProps(10, new Charset())),
                '',
                '',
            ],
        ];
    }

    /**
     * @dataProvider providerConvertDefault
     *
     * @param Type $type
     * @param $value
     * @param $expected
     */
    public function testConvertDefault(Type $type, $value, $expected)
    {
        $this->assertSame($expected, $type->convertDefault($value));
    }
}
