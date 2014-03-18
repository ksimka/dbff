<?php

namespace Dbff\Element;

use Dbff\DbffableElement;

/**
 * Common test for any element
 *
 * @package Dbff\Element
 */
abstract class AbstractElementTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test getDefinition
     *
     * @param DbffableElement $element
     * @param array $definition
     * @param null $name
     *
     * @dataProvider providerElements
     */
    public function testDefinition(DbffableElement $element, array $definition, $name = null)
    {
        $this->assertSame($definition, $element->getDefinition(), 'Wrong definition', 0, 10, true);
        // if name is provided, test getName method
        if (null !== $name) {
            $this->assertSame($name, $element->getName());
        }
    }

    /**
     * Define 2 tests: empty element and non-empty element with parameters that need type conversion
     *
     * @return array
     */
    abstract public function providerElements();
}
