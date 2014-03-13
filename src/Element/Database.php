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
     * @param $name
     * @param DbffableCollection $tables
     * @param $charset
     * @param $collate
     */
    public function __construct($name, DbffableCollection $tables, $charset, $collate) {
        $this->setName($name);
        $this->tables = $tables;
        $this->charset = (string)$charset;
        $this->collate = (string)$collate;
    }

    /**
     * @return array
     */
    public function getValues() {
        return [$this->tables, $this->charset, $this->collate];
    }

    /**
     * @return array
     */
    public function getSchema() {
        return ['tables', 'charset', 'collate'];
    }
}