<?php

namespace Dbff\Parser;

/**
 * Type parser test
 * 
 * @package Dbff\Parser
 */
class TypeParserTest extends AbstractParserTest
{
    /**
     * @return array
     */
    public function providerDefs() {
        return [
            [
                'INT(10) ZEROFILL',
                [
                    'group' => 'int',
                    'type' => 'int',
                    'length' => 10,
                    'unsigned' => false,
                    'zerofill' => true,
                ],
            ],
            [
                'BIGINT',
                [
                    'group' => 'int',
                    'type' => 'bigint',
                    'length' => 0,
                    'unsigned' => false,
                    'zerofill' => false,
                ],
            ],
            [
                'real(4,10) unsigned',
                [
                    'group' => 'float',
                    'type' => 'real',
                    'length' => 4,
                    'decimal' => 10,
                    'unsigned' => true,
                    'zerofill' => false,
                ],
            ],
            [
                "char(100) character set utf-8 collate utf8_general_ci",
                [
                    'group' => 'char',
                    'type' => 'char',
                    'length' => 100,
                    'charset' => 'utf-8',
                    'collate' => 'utf8_general_ci',
                ],
            ],
            [
                'binary',
                [
                    'group' => 'bin',
                    'type' => 'binary',
                    'length' => 0,
                ],
            ],
            [
                'varbinary(36)',
                [
                    'group' => 'bin',
                    'type' => 'varbinary',
                    'length' => 36,
                ],
            ],
            [
                'blob',
                [
                    'group' => 'blob',
                    'type' => 'blob',
                ],
            ],
            [
                "ENUM('opt1','opt2') character set utf8",
                [
                    'group' => 'enum',
                    'type' => 'enum',
                    'values' => ['opt1', 'opt2'],
                    'charset' => 'utf8',
                    'collate' => '',
                ],
            ],
            [
                "set('opt1','opt2') collate utf8_general_ci",
                [
                    'group' => 'enum',
                    'type' => 'set',
                    'values' => ['opt1', 'opt2'],
                    'charset' => '',
                    'collate' => 'utf8_general_ci',
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function providerErrors() {
        return [
            [''],
            ['unknown'],
            ['INTEG'],
        ];
    }

    /**
     * @return TypeParser
     */
    protected function createParser() {
        return new TypeParser();
    }
}