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
     * @var string[]
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
     * @param string[] $values
     * @param string $charset
     * @param string $collate
     */
    public function __construct(array $values, $charset, $collate)
    {
        // order doesn't matter, so sort
        sort($values);
        $this->values = array_map('strval', $values);
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

    /**
     * @return string[]
     */
    public function getEnumValues()
    {
        return $this->values;
    }
}
