<?php

namespace Dbff\Parser;

/**
 * Table parser test
 * 
 * @package Dbff\Parser
 */
class TableParserTest extends AbstractParserTest
{
    public function providerDefs() {
        return [
            [
                "CREATE TABLE `Post` (
                    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `anketa_id` INT(10) UNSIGNED,
                    `data` TEXT NOT NULL COLLATE utf8_general_ci,
                    `flags` TINYINT(3) NOT NULL DEFAULT '0',
                    PRIMARY KEY (`id`),
                    INDEX `user` (`anketa_id`)
                )
                ENGINE=InnoDB
                default charset=utf8
                COLLATE=utf8_unicode_ci
                AUTO_INCREMENT=51;",
                [
                    'name' => 'Post',
                    'columns' => [
                        '`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                        '`anketa_id` INT(10) UNSIGNED',
                        "`data` TEXT NOT NULL COLLATE utf8_general_ci",
                        "`flags` TINYINT(3) NOT NULL DEFAULT '0'",
                    ],
                    'indices' => [
                        'PRIMARY KEY (`id`)',
                        'INDEX `user` (`anketa_id`)',
                    ],
                    'temporary' => false,
                    'charset' => 'utf8',
                    'collate' => 'utf8_unicode_ci',
                    'engine' => 'InnoDB',
                    'autoinc' => 51,
                ],
            ],
            [
                "CREATE TABLE Post (id INT(10))",
                [
                    'name' => 'Post',
                    'columns' => [
                        'id INT(10)',
                    ],
                    'indices' => [],
                    'temporary' => false,
                    'charset' => '',
                    'collate' => '',
                    'engine' => '',
                    'autoinc' => 0,
                ],
            ],
            [
                "CREATE TABLE Post (
                    id INT(10),
                    sort ENUM('1st','2nd','3rd') DEFAULT '1st',
                    PRIMARY KEY (id,sort)
                )",
                [
                    'name' => 'Post',
                    'columns' => [
                        'id INT(10)',
                        "sort ENUM('1st','2nd','3rd') DEFAULT '1st'",
                    ],
                    'indices' => [
                        "PRIMARY KEY (id,sort)",
                    ],
                    'temporary' => false,
                    'charset' => '',
                    'collate' => '',
                    'engine' => '',
                    'autoinc' => 0,
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
            ["CREATE TABLE `Post` ()"],
            ["CREATE TABLE (id INT(10))"],
        ];
    }

    /**
     * @return TableParser
     */
    protected function createParser() {
        return new TableParser();
    }
}