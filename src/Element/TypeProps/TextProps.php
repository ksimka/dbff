<?php

namespace Dbff\Element\TypeProps;

use Dbff\Element\Charset;

/**
 * Properties for text types
 *
 * @package Dbff\Element\TypeProps
 */
class TextProps extends TypePropsAbstract
{
    /**
     * @var bool
     */
    private $binary;

    /**
     * @var Charset
     */
    private $charset;

    /**
     * @param bool $binary
     * @param Charset $charset
     * @internal param string $collate
     */
    public function __construct($binary, Charset $charset)
    {
        $this->binary = (bool)$binary;
        $this->charset = $charset;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return [$this->binary, $this->charset->getCharset(), $this->charset->getCollate()];
    }

    /**
     * @return string[]
     */
    public function getSchema()
    {
        return ['binary', 'charset', 'collate'];
    }

    /**
     * @return bool
     */
    public function isBinary()
    {
        return $this->binary;
    }

    /**
     * @return Charset
     */
    public function getCharset()
    {
        return $this->charset;
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
        return 'text';
    }
}
