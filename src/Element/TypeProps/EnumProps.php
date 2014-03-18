<?php

namespace Dbff\Element\TypeProps;

use Dbff\DbffableElement;

/**
 * Properties for enum types
 *
 * @package Dbff\Element\TypeProps
 */
class EnumProps extends DbffableElement
{
    /**
     * @var array
     */
    private $values;

    /**
     * @var string
     */
    private $charset;

    /**
     * @var string
     */
    private $collate;

    /**
     * @param $values
     * @param $charset
     * @param $collate
     */
    public function __construct(array $values, $charset, $collate)
    {
        // order doesn't matter, so sort
        sort($values);
        $this->values = $values;
        $this->charset = (string)$charset;
        $this->collate = (string)$collate;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return [$this->values, $this->charset, $this->collate];
    }

    /**
     * @return string[]
     */
    public function getSchema()
    {
        return ['values', 'charset', 'collate'];
    }
}
