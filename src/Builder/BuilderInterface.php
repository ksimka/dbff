<?php

namespace Dbff\Builder;

use Dbff\DbffableElement;

/**
 * Interface for builders
 *
 * @package Dbff\Builder
 */
interface BuilderInterface
{
    /**
     * Creates DbffableElement from string
     *
     * @param $str
     * @return DbffableElement
     */
    public function createFromString($str);
} 