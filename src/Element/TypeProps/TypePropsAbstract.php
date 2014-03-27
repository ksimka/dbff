<?php

namespace Dbff\Element\TypeProps;

use Dbff\DbffableElement;

/**
 * Type properties common class
 *
 * @package Dbff\Element\TypeProps
 */
abstract class TypePropsAbstract extends DbffableElement
{
    /**
     * Returns typegroup for props
     *
     * Typegroup is a group of types with similar properties
     *
     * @return string
     */
    abstract public function getTypeGroup();
}
