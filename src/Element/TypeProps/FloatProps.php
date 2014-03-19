<?php

namespace Dbff\Element\TypeProps;

use Dbff\DbffableElement;

/**
 * Properties for float types
 *
 * @package Dbff\Element\TypeProps
 */
class FloatProps extends DbffableElement
{
    /**
     * @var int
     */
    private $length;

    /**
     * @var int
     */
    private $decimal;

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
     * @param int $decimal
     * @param bool $unsigned
     * @param bool $zerofill
     */
    public function __construct($length, $decimal, $unsigned, $zerofill)
    {
        $this->length = (int)$length;
        $this->decimal = (int)$decimal;
        $this->unsigned = (bool)$unsigned;
        $this->zerofill = (bool)$zerofill;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return [$this->length, $this->decimal, $this->unsigned, $this->zerofill];
    }

    /**
     * @return string[]
     */
    public function getSchema()
    {
        return ['length', 'decimal', 'unsigned', 'zerofill'];
    }

    /**
     * @return int
     */
    public function getDecimal()
    {
        return $this->decimal;
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
}
