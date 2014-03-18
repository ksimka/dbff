<?php

namespace Dbff\Parser;

/**
 * Database parser
 *
 * Parses database definition to struct
 *
 * @package Dbff\Parser
 */
class DatabaseParser extends AbstractParser
{
    /**
     * @param $str
     * @return array|bool
     */
    protected function doParse($str)
    {
        $matches = $this->match(
            "create database (:name)( default character set ([\w\-]+))?( collate (\w+))?",
            $str
        );
        if (!$matches) {
            return false;
        }

        return [
            'name' => trim($matches[1], '`'),
            'charset' => !empty($matches[3]) ? (string)$matches[3] : '',
            'collate' => !empty($matches[5]) ? (string)$matches[5] : '',
        ];
    }
}
