<?php

namespace Dbff\Element;

use Dbff\DbffableCollection;
use Dbff\DbffableElement;

/**
 * Database element
 *
 * @package Dbff\Element
 */
class Database extends DbffableElement
{
    /**
     * @var \Dbff\DbffableCollection
     */
    private $tables;

    /**
     * @var Charset
     */
    private $charset;

    /**
     * @param string $name
     * @param DbffableCollection $tables
     * @param \Dbff\Element\Charset $charset
     * @internal param string $collate
     */
    public function __construct($name, DbffableCollection $tables, Charset $charset)
    {
        $this->setName($name);
        $this->tables = $tables;
        $this->charset = $charset;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return [$this->tables, $this->charset->getCharset(), $this->charset->getCollate()];
    }

    /**
     * @return string[]
     */
    public function getSchema()
    {
        return ['tables', 'charset', 'collate'];
    }

    /**
     * @return Charset
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * @return \Dbff\DbffableCollection
     */
    public function getTables()
    {
        return $this->tables;
    }
}
