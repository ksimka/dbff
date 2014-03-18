<?php

namespace Dbff\Parser;

/**
 * Column parser
 *
 * Parses column definition to struct
 *
 * @package Dbff\Parser
 */
class ColumnParser extends AbstractParser
{
    /**
     * @param $str
     * @return array|bool
     */
    protected function doParse($str)
    {
        $matches = $this->match(
            "(:name) (.+?)( not null)?( auto_increment)?( default ('(.*?)'|null))?( collate \w+)?( comment '.*')?",
            $str
        );
        if (!$matches) {
            return false;
        }

        // Collate is a part of typedef, so join it
        $type = $matches[2];
        if (!empty($matches[8])) {
            $type .= $matches[8];
        }

        return [
            'name' => trim($matches[1], '`'),
            'type' => $type,
            'null' => empty($matches[3]),
            'autoinc' => !empty($matches[4]),
            'default' => !empty($matches[6]) ? trim($matches[6], "'") : '',
        ];
    }
}
