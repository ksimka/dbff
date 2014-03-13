<?php

namespace Dbff\Element\TypeProps;

use Dbff\DbffableElement;

/**
 * Properties for binary types
 * 
 * @package Dbff\Element\TypeProps
 */
class BinProps extends DbffableElement
{
    /**
     * @var int
     */
    private $length;

    /**
     * @param int $length
     */
    public function __construct($length) {
        $this->length = (int)$length;
    }

    /**
     * @return array
     */
    public function getValues() {
        return [$this->length];
    }

    /**
     * @return array
     */
    public function getSchema() {
        return ['length'];
    }
}