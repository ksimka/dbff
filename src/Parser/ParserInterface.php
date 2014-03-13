<?php

namespace Dbff\Parser;

/**
 * Interface for all dbff parsers
 *
 * @package Dbff\Parser
 */
interface ParserInterface
{
    /**
     * Parse element definition into struct
     *
     * @param string $str
     * @return array|bool
     */
    public function parse($str);
} 