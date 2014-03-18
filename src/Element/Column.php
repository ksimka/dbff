<?php

namespace Dbff\Element;

use Dbff\DbffableElement;

/**
 * Column element
 *
 * @package Dbff\Element
 */
class Column extends DbffableElement
{
    /**
     * @var \Dbff\Element\Type
     */
    private $type;

    /**
     * @var bool
     */
    private $null;

    /**
     * @var string
     */
    private $default;

    /**
     * @var bool
     */
    private $autoinc;

    /**
     * @param $name
     * @param Type $type
     * @param $null
     * @param $default
     * @param $autoinc
     */
    public function __construct($name, Type $type, $null, $default, $autoinc)
    {
        $this->setName($name);
        $this->type = $type;
        $this->null = (bool)$null;
        $this->default = (string)$default;
        $this->autoinc = (bool)$autoinc;
    }

    /**
     * @return string[]
     */
    public function getSchema()
    {
        return ['type', 'isnull', 'default', 'isautoinc'];
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return [$this->type, $this->null, $this->default, $this->autoinc];
    }
}
