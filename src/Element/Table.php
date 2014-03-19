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
     * @param string $name
     * @param DbffableCollection $columns
     * @param DbffableCollection $indices
     * @param bool $temporary
     * @param string $charset
     * @param string $collate
     * @param string $engine
     * @param int $autoincValue
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
    public function getValues()
    {
        return [$this->columns, $this->indices, $this->charset, $this->collate, $this->engine, $this->autoincValue];
    }

    /**
     * @return string[]
     */
    public function getSchema()
    {
        return ['columns', 'indices', 'charset', 'collate', 'engine', 'autoinc_val'];
    }

    /**
     * @return int
     */
    public function getAutoincrementValue()
    {
        return $this->autoincValue;
    }

    /**
     * @return string
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * @return string
     */
    public function getCollate()
    {
        return $this->collate;
    }

    /**
     * @return \Dbff\DbffableCollection
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @return string
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * @return \Dbff\DbffableCollection
     */
    public function getIndices()
    {
        return $this->indices;
    }

    /**
     * @return bool
     */
    public function isTemporary()
    {
        return $this->temporary;
    }
}
