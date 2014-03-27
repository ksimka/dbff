<?php

namespace Dbff\Element;

use Dbff\DbffableElement;
use Dbff\Element\TypeProps\TypePropsInterface;

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
     * @param string $type
     * @param DbffableElement $props
     */
    public function __construct($type, DbffableElement $props)
    {
        $this->type = (string)$type;
        $this->props = $props;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return [$this->type, $this->props];
    }

    /**
     * @return string[]
     */
    public function getSchema()
    {
        return ['name', 'props'];
    }

    /**
     * @return \Dbff\DbffableElement|TypePropsInterface
     */
    public function getProps()
    {
        return $this->props;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Converts default to corresponding type
     *
     * @param mixed $default
     * @return mixed
     */
    public function convertDefault($default)
    {
        if (null === $default) {
            return $default;
        }

        switch ($this->getProps()->getTypeGroup()) {
            case 'int':
                return (int)$default;
            case 'float':
                return (float)$default;
            default:
                return (string)$default;
        }
    }
}
