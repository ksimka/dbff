<?php

namespace Dbff\Element;

use Dbff\Element\TypeProps\EmptyProps;

/**
 * Column element test
 *
 * @package Dbff\Element
 */
class ColumnTest extends AbstractElementTest
{
    public function testConstruct()
    {
        $emptyType = new Type('', new EmptyProps());

        $column = new Column('', $emptyType, '', '', '');

        $this->assertSame($emptyType, $column->getType());
        $this->assertSame(false, $column->isNullable());
        $this->assertSame('', $column->getDefault());
        $this->assertSame(false, $column->isAutoincrement());
    }

    /**
     * @return array
     */
    public function providerElements()
    {
        $emptyType = new Type('', new EmptyProps());

        return [
            [
                new Column('', $emptyType, '', '', ''),
                [
                    'type' => $emptyType,
                    'isnull' => false,
                    'default' => '',
                    'isautoinc' => false,
                ],
                '',
            ],
            [
                new Column('id', $emptyType, 'null', '100', 'autoinc'),
                [
                    'type' => $emptyType,
                    'isnull' => true,
                    'default' => '100',
                    'isautoinc' => true,
                ],
                'id',
            ],
            [
                new Column('name', $emptyType, 'null', 100, 'autoinc'),
                [
                    'type' => $emptyType,
                    'isnull' => true,
                    'default' => '100',
                    'isautoinc' => true,
                ],
                'name',
            ],
        ];
    }
}
