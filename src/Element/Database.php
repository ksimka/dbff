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
     * @var string
     */
    private $charset;

    /**
     * @var string
     */
    private $collate;

    /**
     * @param string $name
     * @param DbffableCollection $tables
     * @param string $charset
     * @param string $collate
     */
    public function __construct($name, DbffableCollection $tables, $charset, $collate)
    {
        $this->setName($name);
        $this->tables = $tables;
        $this->charset = (string)$charset;
        $this->collate = (string)$collate;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return [$this->tables, $this->charset, $this->collate];
    }

    /**
     * @return string[]
     */
    public function getSchema()
    {
        return ['tables', 'charset', 'collate'];
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
     * @return \Dbff\DbffableCollection
     */
    public function getTables()
    {
        return $this->tables;
    }
}
