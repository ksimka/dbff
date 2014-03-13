<?php

namespace Dbff\Builder;

use Dbff\DbffableCollection;
use Dbff\Parser\TableParser;
use Dbff\Element\Table;

/**
 * Table element builder
 * 
 * @package Dbff\Builder
 */
class TableBuilder implements BuilderInterface
{
    /**
     * @var \Dbff\Parser\TableParser
     */
    private $tableParser;

    /**
     * @var ColumnBuilder
     */
    private $columnBuilder;

    /**
     * @var IndexBuilder
     */
    private $indexBuilder;

    /**
     * @param TableParser $tableParser
     * @param ColumnBuilder $columnBuilder
     * @param IndexBuilder $indexBuilder
     */
    public function __construct(TableParser $tableParser, ColumnBuilder $columnBuilder, IndexBuilder $indexBuilder) {
        $this->tableParser = $tableParser;
        $this->columnBuilder = $columnBuilder;
        $this->indexBuilder = $indexBuilder;
    }

    /**
     * Builds table element from string
     *
     * @param string $str
     * @return Table
     */
    public function createFromString($str) {
        $struct = $this->tableParser->parse($str);
        if (!$struct) {
            return new Table('', new DbffableCollection([]), new DbffableCollection([]), '', '', '', '', '');
        }

        $columns = new DbffableCollection([]);
        foreach ($struct['columns'] as $columnDef) {
            $column = $this->columnBuilder->createFromString($columnDef);
            $columns->add($column);
        }

        $indices = new DbffableCollection([]);
        foreach ($struct['indices'] as $indexDef) {
            $index = $this->indexBuilder->createFromString($indexDef);
            $indices->add($index);
        }

        return new Table(
            $struct['name'],
            $columns,
            $indices,
            $struct['temporary'],
            $struct['charset'],
            $struct['collate'],
            $struct['engine'],
            $struct['autoinc']
        );
    }
} 