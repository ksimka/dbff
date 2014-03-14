<?php

namespace Dbff\Parser;

/**
 * Table parser
 *
 * Parses table definition to struct
 *
 * @package Dbff\Parser
 */
class TableParser extends AbstractParser
{
    /**
     * @param $str
     * @return array|bool
     */
    protected function doParse($str) {
        $matches = $this->match(
            "create( temporary)? table( if not exists)? (:name) \((.+)\)"
            . "( engine=(\w+))?( default charset=(\w+))?( collate=(\w+))?( auto_increment=(\d+))?",
            $str
        );
        if (!$matches) {
            return false;
        }

        // columns and indices
        $columns = [];
        $indices = [];

        // We can't just split this by comma, commas can be between braces (enum, index fields, etc.)
        $columnsAndIndiciesDef = $matches[4];
        preg_match_all(
            "~((?:[^\(,]+)|(?:[^\(,]*\([^)]*\)[^\(,]*)+)(?:,|$)~",
            $columnsAndIndiciesDef,
            $columnsAndIndicies
        );

        foreach ($columnsAndIndicies[1] as $def) {
            $def = trim($def);
            if (preg_match('~^(primary key|index|key|unique key|fulltext key|spatial key)~ui', $def)) {
                $indices[] = $def;
            } else {
                $columns[] = $def;
            }
        }

        return [
            'name' => trim($matches[3], '`'),
            'temporary' => !empty($matches[1]),
            'columns' => $columns,
            'indices' => $indices,
            'engine' => !empty($matches[6]) ? $matches[6] : '',
            'charset' => !empty($matches[8]) ? $matches[8] : '',
            'collate' => !empty($matches[10]) ? $matches[10] : '',
            'autoinc' => !empty($matches[12]) ? (int)$matches[12] : 0,
        ];
    }
} 