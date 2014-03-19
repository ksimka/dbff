<?php

namespace Dbff\Element;

use Dbff\DbffableElement;

/**
 * Index element
 *
 * @package Dbff\Element
 */
class Index extends DbffableElement
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string[]
     */
    private $columns;

    /**
     * @var string
     */
    private $algo;

    /**
     * @param string $name
     * @param string $type
     * @param string[] $columns
     * @param string $algo
     */
    public function __construct($name, $type, array $columns, $algo)
    {
        $this->setName($name);
        $this->type = (string)$type;
        $this->columns = $columns;
        $this->algo = (string)$algo;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return [$this->type, $this->columns, $this->algo];
    }

    /**
     * @return string[]
     */
    public function getSchema()
    {
        return ['type', 'columns', 'algo'];
    }

    /**
     * @return string
     */
    public function getAlgo()
    {
        return $this->algo;
    }

    /**
     * @return string[]
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
