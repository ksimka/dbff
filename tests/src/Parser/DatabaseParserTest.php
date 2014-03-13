<?php

namespace Dbff\Parser;

/**
 * Database parser test
 *
 * @package Dbff\Parser
 */
class DatabaseParserTest extends AbstractParserTest
{
    /**
     * @return array
     */
    public function providerDefs() {
        return [
            [
                'CREATE DATABASE db',
                [
                    'name' => 'db',
                    'charset' => '',
                    'collate' => '',
                ],
            ],
            [
                "CREATE DATABASE `db 25` default CHARACTER set utf8 collate utf8_general_ci",
                [
                    'name' => 'db 25',
                    'charset' => 'utf8',
                    'collate' => 'utf8_general_ci',
                ],
            ],
            [
                "create database `database` collate utf8_unicode_ci",
                [
                    'name' => 'database',
                    'charset' => '',
                    'collate' => 'utf8_unicode_ci',
                ],
            ],
            [
                "create database `database` default CHARACTER set utf8",
                [
                    'name' => 'database',
                    'charset' => 'utf8',
                    'collate' => '',
                ],
            ],
            [
                "create database `database` /*!40100 default CHARACTER set utf8 */",
                [
                    'name' => 'database',
                    'charset' => 'utf8',
                    'collate' => '',
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
            ['create database db 25'],
            ['create database `db 25` /*!123 default character set */'],
        ];
    }

    /**
     * @return DatabaseParser
     */
    protected function createParser() {
        return new DatabaseParser();
    }
}
 