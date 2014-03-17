<?php

namespace Dbff\Parser;

/**
 * Index parser test
 *
 * @package Dbff\Parser
 */
class IndexParserTest extends AbstractParserTest
{
    /**
     * @return array
     */
    public function providerDefs() {
        return [
            [
                'primary KEY (id)',
                [
                    'name' => '',
                    'type' => 'primary',
                    'columns' => ['id'],
                    'algo' => '',
                ],
            ],
            [
                'PRIMARY KEY (`id`) using HASH',
                [
                    'name' => '',
                    'type' => 'primary',
                    'columns' => ['id'],
                    'algo' => 'hash',
                ],
            ],
            [
                'INDEX ind_name (`id`, `name`)   ',
                [
                    'name' => 'ind_name',
                    'type' => 'index',
                    'columns' => ['id', 'name'],
                    'algo' => '',
                ],
            ],
            [
                '  INDEX `some name!` (`index`, name) using btree',
                [
                    'name' => 'some name!',
                    'type' => 'index',
                    'columns' => ['index', 'name'],
                    'algo' => 'btree',
                ],
            ],
            [
                'key ind_name (`id`)',
                [
                    'name' => 'ind_name',
                    'type' => 'index',
                    'columns' => ['id'],
                    'algo' => '',
                ],
            ],
            [
                'unique key ind_name (`id`)',
                [
                    'name' => 'ind_name',
                    'type' => 'unique',
                    'columns' => ['id'],
                    'algo' => '',
                ],
            ],
            [
                'fulltext key ind_name (`id`)',
                [
                    'name' => 'ind_name',
                    'type' => 'fulltext',
                    'columns' => ['id'],
                    'algo' => '',
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
            ['primary key `name` (id)'],
            ['primary key'],
            ['index'],
            ['index (`id`)'],
        ];
    }

    /**
     * @return IndexParser
     */
    protected function createParser() {
        return new IndexParser();
    }
}
 