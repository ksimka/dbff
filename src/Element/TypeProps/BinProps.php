<?php

namespace Dbff\Element\TypeProps;

use Dbff\DbffableElement;

/**
 * Properties for binary types
 *
 * @package Dbff\Element\TypeProps
 */
class BinProps extends DbffableElement implements TypePropsInterface
{
    /**
     * @var int
     */
    private $length;

    /**
     * @param int $length
     */
    public function __construct($length)
    {
        $this->length = (int)$length;
    }

    /**
     * @return integer[]
     */
    public function getValues()
    {
        return [$this->length];
    }

    /**
     * @return string[]
     */
    public function getSchema()
    {
        return ['length'];
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Returns typegroup for props
     *
     * Typegroup is a group of types with similar properties
     *
     * @return string
     */
    public function getTypeGroup()
    {
        return 'bin';
    }
}
