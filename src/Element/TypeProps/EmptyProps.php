<?php

namespace Dbff\Element\TypeProps;

/**
 * Properties for types with no options
 *
 * @package Dbff\Element\TypeProps
 */
class EmptyProps extends TypePropsAbstract
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
