<?php

namespace Dbff\Element\TypeProps;

use Dbff\DbffableElement;

/**
 * Properties for types with no options
 *
 * @package Dbff\Element\TypeProps
 */
class EmptyProps extends DbffableElement
{
    /**
     * @return array
     */
    public function getValues() {
        return [];
    }

    /**
     * @return array
     */
    public function getSchema() {
        return [];
    }
}