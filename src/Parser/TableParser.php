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
        // The simplest way for me is replace commas between braces, explode by commas, replace backwards
        // TODO: refactor this crazyness
        $columnsAndIndiciesDef = $matches[4];
        $bracesMatches = [];
        preg_match_all("~(\([^\)]+?,[^\)]+?(,[^\)]+?)*?\))~", $columnsAndIndiciesDef, $bracesMatches);
        if (isset($bracesMatches[0])) {
            foreach ($bracesMatches[0] as $i => $bracesMatch) {
                $columnsAndIndiciesDef = str_replace($bracesMatch, "<{$i}>", $columnsAndIndiciesDef);
            }
            $columnsAndIndicies = explode(',', $columnsAndIndiciesDef);
            foreach ($columnsAndIndicies as &$columnOrIndex) {
                foreach ($bracesMatches[0] as $i => $bracesMatch) {
                    $columnOrIndex = str_replace("<{$i}>", $bracesMatch, $columnOrIndex);
                }
            }
        } else {
            $columnsAndIndicies = explode(',', $columnsAndIndiciesDef);
        }

        foreach ($columnsAndIndicies as $def) {
            $def = trim($def);
            if (
                stripos($def, 'primary key') === 0
                || stripos($def, 'index') === 0
                || stripos($def, 'key') === 0
                || stripos($def, 'unique key') === 0
                || stripos($def, 'fulltext key') === 0
                || stripos($def, 'spatial key') === 0
            ) {
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