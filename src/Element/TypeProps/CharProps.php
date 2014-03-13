<?php

namespace Dbff\Element\TypeProps;

use Dbff\DbffableElement;

/**
 * Properties for char types
 *
 * @package Dbff\Element\TypeProps
 */
class CharProps extends DbffableElement
{
    /**
     * @var int
     */
    private $length;

    /**
     * @var string
     */
    private $charset;

    /**
     * @var string
     */
    private $collate;

    /**
     * @param $length
     * @param $charset
     * @param $collate
     */
    public function __construct($length, $charset, $collate) {
        $this->length = (int)$length;
        $this->charset = (string)$charset;
        $this->collate = (string)$collate;
    }

    /**
     * @return array
     */
    public function getValues() {
        return [$this->length, $this->charset, $this->collate];
    }

    /**
     * @return array
     */
    public function getSchema() {
        return ['length', 'charset', 'collate'];
    }
}