<?php

namespace Dbff\Element\TypeProps;

use Dbff\DbffableElement;

/**
 * Properties for integer types
 *
 * @package Dbff\Element\TypeProps
 */
class IntProps extends DbffableElement
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
}
