<?php

namespace Dbff\Element;

use Dbff\DbffableCollection;
use Dbff\DbffableElement;

/**
 * Table element
 * 
 * @package Dbff\Element
 */
class Table extends DbffableElement
{
    /**
     * @var \Dbff\DbffableCollection
     */
    private $columns;

    /**
     * @var \Dbff\DbffableCollection
     */
    private $indices;

    /**
     * @var bool
     */
    private $temporary;

    /**
     * @var string
     */
    private $charset;

    /**
     * @var string
     */
    private $collate;

    /**
     * @var string
     */
    private $engine;

    /**
     * @var int
     */
    private $autoincValue;

    /**
     * @param $name
     * @param DbffableCollection $columns
     * @param DbffableCollection $indices
     * @param $temporary
     * @param $charset
     * @param $collate
     * @param $engine
     * @param $autoincValue
     */
    public function __construct(
        $name,
        DbffableCollection $columns,
        DbffableCollection $indices,
        $temporary,
        $charset,
        $collate,
        $engine,
        $autoincValue
    ) {
        $this->setName($name);
        $this->columns = $columns;
        $this->indices = $indices;
        $this->temporary = (bool)$temporary;
        $this->charset = (string)$charset;
        $this->collate = (string)$collate;
        $this->engine = (string)$engine;
        $this->autoincValue = (int)$autoincValue;
    }

    /**
     * @return array
     */
    public function getValues() {
        return [$this->columns, $this->indices, $this->charset, $this->collate, $this->engine, $this->autoincValue];
    }

    /**
     * @return array
     */
    public function getSchema() {
        return ['columns', 'indices', 'charset', 'collate', 'engine', 'autoinc_val'];
    }
}