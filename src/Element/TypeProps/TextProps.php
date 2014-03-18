<?php

namespace Dbff\Element\TypeProps;

use Dbff\DbffableElement;

/**
 * Properties for text types
 *
 * @package Dbff\Element\TypeProps
 */
class TextProps extends DbffableElement
{
    /**
     * @var bool
     */
    private $binary;

    /**
     * @var string
     */
    private $charset;

    /**
     * @var string
     */
    private $collate;

    /**
     * @param $binary
     * @param $charset
     * @param $collate
     */
    public function __construct($binary, $charset, $collate)
    {
        $this->binary = (bool)$binary;
        $this->charset = (string)$charset;
        $this->collate = (string)$collate;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return [$this->binary, $this->charset, $this->collate];
    }

    /**
     * @return string[]
     */
    public function getSchema()
    {
        return ['binary', 'charset', 'collate'];
    }
}
