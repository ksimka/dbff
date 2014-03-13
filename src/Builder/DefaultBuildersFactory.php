<?php

namespace Dbff\Builder;

use Dbff\Parser\ColumnParser;
use Dbff\Parser\DatabaseParser;
use Dbff\Parser\IndexParser;
use Dbff\Parser\TableParser;
use Dbff\Parser\TypeParser;

/**
 * Factory for creating default builders (with all its default dependencies)
 * 
 * @package Dbff\Builder
 */
class DefaultBuildersFactory
{
    /**
     * @return DatabaseBuilder
     */
    public static function createDatabaseBuilder() {
        return new DatabaseBuilder(new DatabaseParser(), self::createTableBuilder());
    }

    /**
     * @return TableBuilder
     */
    public static function createTableBuilder() {
        return new TableBuilder(new TableParser(), self::createColumnBuilder(), self::createIndexBuilder());
    }

    /**
     * @return ColumnBuilder
     */
    public static function createColumnBuilder() {
        return new ColumnBuilder(new ColumnParser(), self::createTypeBuilder());
    }

    /**
     * @return IndexBuilder
     */
    public static function createIndexBuilder() {
        return new IndexBuilder(new IndexParser());
    }

    /**
     * @return TypeBuilder
     */
    public static function createTypeBuilder() {
        return new TypeBuilder(new TypeParser());
    }
}