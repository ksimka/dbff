<?php

namespace Dbff\Builder;

use Dbff\Element\Type;
use Dbff\Element\TypeProps\EmptyProps;
use Dbff\Parser\ColumnParser;
use Dbff\Element\Column;

/**
 * Column element builder
 *
 *
 * 
 * @package Dbff\Builder
 */
class ColumnBuilder implements BuilderInterface
{
    /**
     * @var \Dbff\Parser\ColumnParser
     */
    private $columnParser;

    /**
     * @var \Dbff\Builder\TypeBuilder
     */
    private $typeBuilder;

    /**
     * @param ColumnParser $columnParser
     * @param TypeBuilder $typeBuilder
     */
    public function __construct(ColumnParser $columnParser, TypeBuilder $typeBuilder) {
        $this->columnParser = $columnParser;
        $this->typeBuilder = $typeBuilder;
    }

    /**
     * Builds column element from string
     *
     * @param $str
     * @return Column
     */
    public function createFromString($str) {
        $struct = $this->columnParser->parse($str);
        if (!$struct) {
            return new Column('', new Type('', new EmptyProps()), '', '', '');
        }

        $type = $this->typeBuilder->createFromString($struct['type']);

        return new Column($struct['name'], $type, $struct['null'], $struct['default'], $struct['autoinc']);
    }
} 