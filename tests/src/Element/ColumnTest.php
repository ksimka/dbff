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