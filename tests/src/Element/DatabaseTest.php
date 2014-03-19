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
    public function testConstruct()
    {
        $emptyTables = new DbffableCollection([]);
        $emptyCharset = new Charset();

        $database = new Database('', $emptyTables, $emptyCharset);

        $this->assertSame($emptyTables, $database->getTables());
        $this->assertSame($emptyCharset, $database->getCharset());
    }

    /**
     * @return array
     */
    public function providerElements()
    {
        $emptyTables = new DbffableCollection([]);

        return [
            [
                new Database('', $emptyTables, new Charset()),
                [
                    'tables' => $emptyTables,
                    'charset' => '',
                    'collate' => '',
                ],
                '',
            ],
            [
                new Database('db22', $emptyTables, new Charset('some-cs', 'some_cl')),
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
