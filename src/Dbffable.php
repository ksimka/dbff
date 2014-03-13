<?php

namespace Dbff;

/**
 * Diffable element interface
 *
 * @package Dbff
 */
interface Dbffable
{
    /**
     * @return array
     */
    public function getDefinition();

    /**
     * @return string
     */
    public function getName();
} 