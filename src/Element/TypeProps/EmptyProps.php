<?php

namespace Dbff\Element\TypeProps;

use Dbff\DbffableElement;

/**
 * Properties for types with no options
 *
 * @package Dbff\Element\TypeProps
 */
class EmptyProps extends DbffableElement implements TypePropsInterface
{
    /**
     * @return array
     */
    public function getValues()
    {
        return [];
    }

    /**
     * @return array
     */
    public function getSchema()
    {
        return [];
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
        return '';
    }
}
