<?php

namespace Dbff;

/**
 * Any element that can be compared to any other element of this type
 * 
 * @package Dbff
 */
abstract class DbffableElement implements Dbffable
{
    /**
     * @var string
     */
    private $name;

    /**
     * Describes element's schema
     *
     * @return array
     */
    abstract public function getSchema();

    /**
     * Returns values corresponding to the schema
     *
     * @return array
     */
    abstract public function getValues();

    /**
     * Describes element's definition: combined schema and values
     *
     * @return array
     */
    final public function getDefinition() {
        return array_combine($this->getSchema(), $this->getValues());
    }

    /**
     * Name of element
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Sets name
     *
     * @param $name
     */
    protected function setName($name) {
        $this->name = $name;
    }
}