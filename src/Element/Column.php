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
     * @var mixed
     */
    private $default;

    /**
     * @var bool
     */
    private $autoinc;

    /**
     * @param string $name
     * @param Type $type
     * @param bool $null
     * @param string $default
     * @param bool $autoinc
     */
    public function __construct($name, Type $type, $null, $default, $autoinc)
    {
        $this->setName($name);
        $this->type = $type;
        $this->null = (bool)$null;
        $this->setDefault($type, $default);
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

    /**
     * @return bool
     */
    public function isAutoincrement()
    {
        return $this->autoinc;
    }

    /**
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @return bool
     */
    public function isNullable()
    {
        return $this->null;
    }

    /**
     * @return \Dbff\Element\Type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets default with corresponding type
     *
     * @param Type $type
     * @param $default
     */
    private function setDefault(Type $type, $default)
    {
        $this->default = $type->convertDefault($default);
    }
}
