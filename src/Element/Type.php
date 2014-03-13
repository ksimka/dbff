<?php

namespace Dbff\Element;

use Dbff\DbffableElement;

/**
 * Type element
 * 
 * @package Dbff\Element
 */
class Type extends DbffableElement
{
    /**
     * Name of type, it's not the name of DbffableElement
     *
     * @var string
     */
    private $name;

    /**
     * @var \Dbff\DbffableElement
     */
    private $props;

    /**
     * @param $name
     * @param DbffableElement $props
     */
    public function __construct($name, DbffableElement $props) {
        $this->name = $name;
        $this->props = $props;
    }

    /**
     * @return array
     */
    public function getValues() {
        return [$this->name, $this->props];
    }

    /**
     * @return array
     */
    public function getSchema() {
        return ['name', 'props'];
    }
}