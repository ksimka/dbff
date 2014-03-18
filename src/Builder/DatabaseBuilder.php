<?php

namespace Dbff\Builder;

use Dbff\DbffableCollection;
use Dbff\Element\Database;
use Dbff\Parser\DatabaseParser;

/**
 * Database element builder
 *
 * @package Dbff\Builder
 */
class DatabaseBuilder implements BuilderInterface
{
    /**
     * Separator for joining "create database" and "create table" statements
     */
    const SEPARATOR = "\n\n";

    /**
     * @var \Dbff\Parser\ColumnParser
     */
    private $databaseParser;

    /**
     * @var \Dbff\Builder\TableBuilder
     */
    private $tableBuilder;

    /**
     * @param DatabaseParser $databaseParser
     * @param TableBuilder $tableBuilder
     */
    public function __construct(DatabaseParser $databaseParser, TableBuilder $tableBuilder)
    {
        $this->databaseParser = $databaseParser;
        $this->tableBuilder = $tableBuilder;
    }

    /**
     * Builds database element from string
     *
     * @param string $str Must be string, separated by self::SEPARATOR.
     *      1st line is create database statement, others — create table statements
     * @return Database
     */
    public function createFromString($str)
    {
        $lines = explode(self::SEPARATOR, $str);

        $struct = $this->databaseParser->parse(array_shift($lines));
        if (!$struct) {
            return new Database('', new DbffableCollection([]), '', '');
        }

        $tables = new DbffableCollection([]);
        foreach ($lines as $tableStr) {
            $tables->add($this->tableBuilder->createFromString($tableStr));
        }

        return new Database($struct['name'], $tables, $struct['charset'], $struct['collate']);
    }

    /**
     * Helper method for building database element from separated "create database" and "create table" statements
     *
     * @param $dbStr
     * @param array $tablesStr
     * @return Database
     */
    public function createFromDbAndTablesStrings($dbStr, array $tablesStr)
    {
        return $this->createFromString(implode(self::SEPARATOR, array_merge([$dbStr], $tablesStr)));
    }
}
