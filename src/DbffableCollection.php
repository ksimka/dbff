<?php

namespace Dbff;

/**
 * Collection of dbffable elements
 * 
 * @package Dbff
 */
class DbffableCollection
{
    /**
     * @var DbffableElement[]
     */
    private $elements = [];

    /**
     * @param DbffableElement[] $elements
     */
    public function __construct(array $elements) {
        array_walk($elements, [$this, 'add']);
    }

    /**
     * Adds element to collection
     *
     * Name is using for indexing, must be unique
     *
     * @param DbffableElement $element
     */
    public function add(DbffableElement $element) {
        $this->elements[$element->getName()] = $element;
    }

    /**
     * Returns element by name
     *
     * @param $name
     * @return DbffableElement|null
     */
    public function get($name) {
        return isset($this->elements[$name]) ? $this->elements[$name] : null;
    }

    /**
     * Returns all elements
     *
     * @return DbffableElement[]
     */
    public function getAll() {
        return $this->elements;
    }

    /**
     * Returns all names of elements
     *
     * @return array
     */
    public function getNames() {
        return array_keys($this->elements);
    }

    /**
     * Returns the number of elements
     *
     * @return int
     */
    public function getLength() {
        return count($this->elements);
    }
} 