<?php

namespace Dbff\Builder;

use Dbff\Parser\IndexParser;
use Dbff\Element\Index;

/**
 * Index element builder
 * 
 * @package Dbff\Builder
 */
class IndexBuilder implements BuilderInterface
{
    /**
     * @var \Dbff\Parser\IndexParser
     */
    private $indexParser;

    /**
     * @param IndexParser $indexParser
     */
    public function __construct(IndexParser $indexParser) {
        $this->indexParser = $indexParser;
    }

    /**
     * Builds index element from string
     *
     * @param string $str
     * @return Index
     */
    public function createFromString($str) {
        $struct = $this->indexParser->parse($str);
        if (!$struct) {
            return new Index('', '', [], '');
        }

        return new Index($struct['name'], $struct['type'], $struct['columns'], $struct['algo']);
    }
} 