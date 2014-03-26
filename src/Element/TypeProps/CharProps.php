<?php

namespace Dbff\Element\TypeProps;

use Dbff\DbffableElement;
use Dbff\Element\Charset;

/**
 * Properties for char types
 *
 * @package Dbff\Element\TypeProps
 */
class CharProps extends DbffableElement implements TypePropsInterface
{
    /**
     * @var int
     */
    private $length;

    /**
     * @var Charset
     */
    private $charset;

    /**
     * @param int $length
     * @param Charset $charset
     * @internal param string $collate
     */
    public function __construct($length, Charset $charset)
    {
        $this->length = (int)$length;
        $this->charset = $charset;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return [$this->length, $this->charset->getCharset(), $this->charset->getCollate()];
    }

    /**
     * @return string[]
     */
    public function getSchema()
    {
        return ['length', 'charset', 'collate'];
    }

    /**
     * @return Charset
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Returns typegroup for props
     *
     * Typegroup is a group of types with similar properties
     *
     * @return string
     */
    public function getTypeGroup()
    {
        return 'char';
    }
}
