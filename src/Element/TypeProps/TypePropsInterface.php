<?php

namespace Dbff\Element\TypeProps;

/**
 * TypeProps interface
 *
 * @package Dbff\Element\TypeProps
 */
interface TypePropsInterface
{
    /**
     * Returns typegroup for props
     *
     * Typegroup is a group of types with similar properties
     *
     * @return string
     */
    public function getTypeGroup();
}
