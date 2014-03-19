<?php

namespace Dbff\Element;

/**
 * Charset element test
 *
 * @package Dbff\Element
 */
class CharsetTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $charset = new Charset();

        $this->assertSame('', $charset->getCharset());
        $this->assertSame('', $charset->getCollate());

        $charset = new Charset('utf-13', 'coll_ate');

        $this->assertSame('utf-13', $charset->getCharset());
        $this->assertSame('coll_ate', $charset->getCollate());
    }
}
