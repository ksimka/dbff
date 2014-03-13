<?php

namespace Dbff\Parser;

/**
 * Index parser
 *
 * Parses index definition to struct
 *
 * @package Dbff\Parser
 */
class IndexParser extends AbstractParser
{
    /**
     * @param $str
     * @return array|bool
     */
    protected function doParse($str) {
        if (stripos($str, 'primary key') === 0) {
            $matches = $this->match("(primary key)()( using (btree|hash))? \((.+)\)", $str);
        } else {
            $matches = $this->match(
                "(index|key|unique key|fulltext key|spatial key) (:name)( using (btree|hash))? \((.+)\)",
                $str
            );
        }
        if (!$matches) {
            return false;
        }

        // type: primary, index, unique, fulltext, spatial
        $type = strtolower($matches[1]);
        $type = str_replace(' key', '', $type);
        if ($type == 'key') {
            $type = 'index';
        }

        $name = trim($matches[2], '`');
        $columns = array_map(function($v) {return trim($v, ' `'); }, explode(',', $matches[5]));

        return [
            'name' => $name,
            'type' => $type,
            'columns' => $columns,
            'algo' => $matches[4],
        ];
    }
} 