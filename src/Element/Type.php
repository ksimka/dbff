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
     * Name of type
     *
     * @var string
     */
    private $type;

    /**
     * @var \Dbff\DbffableElement
     */
    private $props;

    /**
     * @param $type
     * @param DbffableElement $props
     */
    public function __construct($type, DbffableElement $props) {
        $this->type = $type;
        $this->props = $props;
    }

    /**
     * @return array
     */
    public function getValues() {
        return [$this->type, $this->props];
    }

    /**
     * @return string[]
     */
    public function getSchema() {
        return ['name', 'props'];
    }
}
