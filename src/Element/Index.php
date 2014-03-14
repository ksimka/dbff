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
     * @var array
     */
    private $columns;

    /**
     * @var string
     */
    private $algo;

    public function __construct($name, $type, array $columns, $algo) {
        $this->setName($name);
        $this->type = (string)$type;
        $this->columns = $columns;
        $this->algo = (string)$algo;
    }

    /**
     * @return array
     */
    public function getValues() {
        return [$this->type, $this->columns, $this->algo];
    }

    /**
     * @return string[]
     */
    public function getSchema() {
        return ['type', 'columns', 'algo'];
    }
}