<?php

namespace Dbff\Element;

/**
 * Charset helper element
 *
 * @package Dbff\Element
 */
class Charset
{
    /**
     * @var string
     */
    private $charset;

    /**
     * @var string
     */
    private $collate;

    /**
     * @param string $charset
     * @param string $collate
     */
    public function __construct($charset = '', $collate = '')
    {
        $this->charset = $charset;
        $this->collate = $collate;
    }

    /**
     * @return string
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * @return string
     */
    public function getCollate()
    {
        return $this->collate;
    }
}
