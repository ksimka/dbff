<?php

namespace Dbff\Element;

use Dbff\DbffableCollection;

/**
 * Table element test
 *
 * @package Dbff\Element
 */
class TableTest extends AbstractElementTest
{
    public function testConstruct()
    {
        $emptyColumns = new DbffableCollection([]);
        $emptyIndices = new DbffableCollection([]);

        $table = new Table('', $emptyColumns, $emptyIndices, '', '', '', '', '');

        $this->assertSame($emptyColumns, $table->getColumns());
        $this->assertSame($emptyIndices, $table->getIndices());
        $this->assertSame('', $table->getCharset());
        $this->assertSame('', $table->getCollate());
        $this->assertSame('', $table->getEngine());
        $this->assertSame(0, $table->getAutoincrementValue());
    }

    /**
     * @return array
     */
    public function providerElements()
    {
        $emptyColumns = new DbffableCollection([]);
        $emptyIndices = new DbffableCollection([]);

        return [
            [
                new Table('', $emptyColumns, $emptyIndices, '', '', '', '', ''),
                [
                    'columns' => $emptyColumns,
                    'indices' => $emptyIndices,
                    'charset' => '',
                    'collate' => '',
                    'engine' => '',
                    'autoinc_val' => 0,
                ],
                '',
            ],
            [
                new Table('user', $emptyColumns, $emptyIndices, 'temp', 'char61', 'col_90', 'InnoInno', '100500'),
                [
                    'columns' => $emptyColumns,
                    'indices' => $emptyIndices,
                    'charset' => 'char61',
                    'collate' => 'col_90',
                    'engine' => 'InnoInno',
                    'autoinc_val' => 100500,
                ],
                'user',
            ],
        ];
    }
}
