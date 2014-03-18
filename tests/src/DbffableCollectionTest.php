<?php

namespace Dbff;

use Dbff\Element\Column;
use Dbff\Element\Type;
use Dbff\Element\TypeProps\EmptyProps;

/**
 * DbffableCollection test
 *
 * @package Dbff
 */
class DbffableCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests empty collection
     */
    public function testEmpty()
    {
        $collection = new DbffableCollection([]);

        $this->assertNull($collection->get('some-key'));
        $this->assertSame([], $collection->getAll());
        $this->assertSame([], $collection->getNames());
        $this->assertSame(0, $collection->getLength());

        return $collection;
    }

    /**
     * @depends testEmpty
     *
     * @param $collection
     */
    public function testAdd(DbffableCollection $collection)
    {
        $column = new Column('counter', new Type('int', new EmptyProps()), true, 0, false);

        $collection->add($column);

        $this->assertNull($collection->get('some-key'));
        $this->assertSame($column, $collection->get('counter'));
        $this->assertSame(['counter' => $column], $collection->getAll());
        $this->assertSame(['counter'], $collection->getNames());
        $this->assertSame(1, $collection->getLength());

        // Same name
        $column = new Column('counter', new Type('char', new EmptyProps()), false, '100', false);

        $collection->add($column);

        $this->assertNull($collection->get('some-key'));
        $this->assertSame($column, $collection->get('counter'));
        $this->assertSame(['counter' => $column], $collection->getAll());
        $this->assertSame(['counter'], $collection->getNames());
        $this->assertSame(1, $collection->getLength());

        // Other element
        $column2 = new Column('name', new Type('char', new EmptyProps()), false, 'John', false);

        $collection->add($column2);

        $this->assertNull($collection->get('some-key'));
        $this->assertSame($column, $collection->get('counter'));
        $this->assertSame($column2, $collection->get('name'));
        $this->assertSame(['counter' => $column, 'name' => $column2], $collection->getAll());
        $this->assertSame(['counter', 'name'], $collection->getNames());
        $this->assertSame(2, $collection->getLength());
    }

    /**
     * Tests collection created from array via constructor
     */
    public function testCreateFromArray()
    {
        $column1 = new Column('col1', new Type('int', new EmptyProps()), true, 0, false);
        $column2 = new Column('col2', new Type('int', new EmptyProps()), true, 0, false);

        $collection = new DbffableCollection([$column1, $column2]);

        $this->assertSame($column1, $collection->get('col1'));
        $this->assertSame($column2, $collection->get('col2'));

        $this->assertSame(['col1' => $column1, 'col2' => $column2], $collection->getAll());
        $this->assertSame(['col1', 'col2'], $collection->getNames());
        $this->assertSame(2, $collection->getLength());
    }
}
