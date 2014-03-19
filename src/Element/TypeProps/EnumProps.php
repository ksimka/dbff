<?php

namespace Dbff\Element\TypeProps;

use Dbff\DbffableElement;
use Dbff\Element\Charset;

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
     * @var Charset
     */
    private $charset;

    /**
     * @param string[] $values
     * @param Charset $charset
     * @internal param string $collate
     */
    public function __construct(array $values, Charset $charset)
    {
        // order doesn't matter, so sort
        sort($values);
        $this->values = array_map('strval', $values);
        $this->charset = $charset;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return [$this->values, $this->charset->getCharset(), $this->charset->getCollate()];
    }

    /**
     * @return string[]
     */
    public function getSchema()
    {
        return ['values', 'charset', 'collate'];
    }

    /**
     * @return Charset
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * @return string[]
     */
    public function getEnumValues()
    {
        return $this->values;
    }
}
