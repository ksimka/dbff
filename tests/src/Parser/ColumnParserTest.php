<?php

namespace Dbff\Parser;

/**
 * Column parser test
 *
 * @package Dbff\Parser
 */
class ColumnParserTest extends AbstractParserTest
{
    /**
     * @return array
     */
    public function providerDefs() {
        return [
            [
                '`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                [
                    'name' => 'id',
                    'type' => 'INT(10) UNSIGNED',
                    'null' => false,
                    'autoinc' => true,
                    'default' => '',
                ],
            ],
            [
                "`data` TEXT NOT NULL COLLATE utf8_unicode_ci",
                [
                    'name' => 'data',
                    'type' => "TEXT COLLATE utf8_unicode_ci",
                    'null' => false,
                    'autoinc' => false,
                    'default' => '',
                ],
            ],
            [
                "data CHAR COLLATE utf8_unicode_ci DEFAULT null comment 'comm ent'",
                [
                    'name' => 'data',
                    'type' => "CHAR COLLATE utf8_unicode_ci",
                    'null' => true,
                    'autoinc' => false,
                    'default' => 'null',
                ],
            ],
            [
                "`data 2` CHAR default '1' COLLATE utf8_unicode_ci comment 'comm ent'",
                [
                    'name' => 'data 2',
                    'type' => "CHAR COLLATE utf8_unicode_ci",
                    'null' => true,
                    'autoinc' => false,
                    'default' => '1',
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
        ];
    }

    /**
     * @return ColumnParser
     */
    protected function createParser() {
        return new ColumnParser();
    }
}
 