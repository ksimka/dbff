<?php

namespace Dbff\Parser;

/**
 * Type parser
 *
 * Parses type definition to struct
 *
 * @package Dbff\Parser
 */
class TypeParser extends AbstractParser
{
    /**
     * Parser definitions for uniform parsing
     *
     * @var array
     */
    private $typesDef = [
        'int' => [
            'names' => ['tinyint', 'smallint', 'mediumint', 'int', 'bigint', 'integer'],
            'regex' => '(\((\d+)\))?( unsigned)?( zerofill)?',
            'schema' => [1 => 'length', 'unsigned', 'zerofill'],
            'cast' => ['int', 'bool', 'bool'],
        ],
        'float' => [
            'names' => ['real', 'double', 'float', 'decimal', 'numeric'],
            'regex' => '(\((\d+)(,(\d+))?\))?( unsigned)?( zerofill)?',
            'schema' => [1 => 'length', 3 => 'decimal', 'unsigned', 'zerofill'],
            'cast' => ['int', 'int', 'bool', 'bool'],
        ],
        'datetime' => [
            'names' => ['date', 'time', 'timestamp', 'datetime', 'year'],
            'regex' => '',
            'schema' => [],
            'cast' => [],
        ],
        'char' => [
            'names' => ['char', 'varchar'],
            'regex' => "(\((\d+)\))?( character set ([\w\-]+))?( collate (\w+))?",
            'schema' => [1 => 'length', 3 => 'charset', 5 => 'collate'],
            'cast' => ['int', 'string', 'string'],
        ],
        'text' => [
            'names' => ['tinytext', 'text', 'mediumtext', 'longtext'],
            'regex' => "(binary)?( character set ([\w\-]+))?( collate (\w+))?",
            'schema' => ['binary', 2 => 'charset', 4 => 'collate'],
            'cast' => ['bool', 'string', 'string'],
        ],
        'bin' => [
            'names' => ['binary', 'varbinary'],
            'regex' => '(\((\d+)\))?',
            'schema' => [1 => 'length'],
            'cast' => ['int'],
        ],
        'blob' => [
            'names' => ['tinyblob', 'blob', 'mediumblob', 'longblob'],
            'regex' => '',
            'schema' => [],
            'cast' => [],
        ],
        'enum' => [
            'names' => ['enum', 'set'],
            'regex' => "\(('\w+'(,'\w+')*)\)( character set ([\w\-]+))?( collate (\w+))?",
            'schema' => ['values', 3 => 'charset', 5 => 'collate'],
            'cast' => ['string', 'string', 'string'],
        ],
    ];

    /**
     * Reverse index typename:typegroup
     *
     * @var array
     */
    private $typesRevIndex;

    /**
     * Prepare helper lists
     */
    public function __construct()
    {
        $this->typesRevIndex = [];
        foreach ($this->typesDef as $type => $def) {
            foreach ($def['names'] as $name) {
                $this->typesRevIndex[$name] = $type;
            }
        }
    }

    /**
     * @param $str
     * @return array|bool
     */
    protected function doParse($str)
    {
        $matches = [];
        preg_match("~^([a-z]+)~i", $str, $matches);
        $type = isset($matches[1]) ? $matches[1] : null;
        // There is no word at the beginning
        if (!$type) {
            return false;
        }

        $type = strtolower($type);
        // Unknown type
        if (!isset($this->typesRevIndex[$type])) {
            return false;
        }

        $str = substr($str, strlen($type));

        $typeGroup = $this->typesRevIndex[$type];
        $typeDef = $this->typesDef[$typeGroup];
        $matches = $this->match($typeDef['regex'], $str);
        // Invalid type def
        if (!$matches) {
            return false;
        }
        // Remove 0-th element
        array_shift($matches);
        // Intersect with schema
        $schema = array_intersect_key($matches, $typeDef['schema']);
        // Type cast
        $schema = array_map(
            function ($value, $type) {
                settype($value, $type);
                return $value;
            },
            $schema,
            $typeDef['cast']
        );
        // Combine struct
        $schema = array_combine($typeDef['schema'], $schema);
        // Add type and typegroup
        $schema['type'] = $type;
        $schema['group'] = $typeGroup;

        $schema = $this->customize($schema);

        return $schema;
    }

    /**
     * @param array $schema
     * @return array
     */
    private function customize(array $schema)
    {
        if ($schema['group'] == 'enum') {
            // convert to array and trim '
            $schema['values'] = array_map(
                function ($v) {
                    return trim($v, "'");
                },
                explode(',', $schema['values'])
            );
        }

        return $schema;
    }
}

