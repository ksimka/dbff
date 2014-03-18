<?php

namespace Dbff\Element;

use Dbff\DbffableCollection;

/**
 * Database element test
 * 
 * @package Dbff\Element
 */
class DatabaseTest extends AbstractElementTest
{
    /**
     * @return array
     */
    public function providerElements()
    {
        $emptyTables = new DbffableCollection([]);

        return [
            [
                new Database('', $emptyTables, '', ''),
                [
                    'tables' => $emptyTables,
                    'charset' => '',
                    'collate' => '',
                ],
                '',
            ],
            [
                new Database('db22', $emptyTables, 'some-cs', 'some_cl'),
                [
                    'tables' => $emptyTables,
                    'charset' => 'some-cs',
                    'collate' => 'some_cl',
                ],
                'db22',
            ],
        ];
    }
}
