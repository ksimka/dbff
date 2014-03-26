<?php

namespace Dbff\Element\TypeProps;

use Dbff\DbffableElement;

/**
 * Properties for integer types
 *
 * @package Dbff\Element\TypeProps
 */
class IntProps extends DbffableElement implements TypePropsInterface
{
    /**
     * @var int
     */
    private $length;

    /**
     * @var bool
     */
    private $unsigned;

    /**
     * @var bool
     */
    private $zerofill;

    /**
     * @param int $length
     * @param bool $unsigned
     * @param bool $zerofill
     */
    public function __construct($length, $unsigned, $zerofill)
    {
        $this->length = (int)$length;
        $this->unsigned = (bool)$unsigned;
        $this->zerofill = (bool)$zerofill;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return [$this->length, $this->unsigned, $this->zerofill];
    }

    /**
     * @return string[]
     */
    public function getSchema()
    {
        return ['length', 'unsigned', 'zerofill'];
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @return bool
     */
    public function isUnsigned()
    {
        return $this->unsigned;
    }

    /**
     * @return bool
     */
    public function isZerofill()
    {
        return $this->zerofill;
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
        return 'int';
    }
}
