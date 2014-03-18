<?php

namespace Dbff\Parser;

/**
 * Common test for all parsers
 *
 * All you need is to define providers with positives and negatives
 *
 * @package Dbff\Parser
 */
abstract class AbstractParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TypeParser
     */
    private $parser;

    /**
     * Positive cases provider
     *
     * @return array
     */
    abstract public function providerDefs();

    /**
     * Negative cases provider
     *
     * @return array
     */
    abstract public function providerErrors();

    /**
     * Returns test parser
     *
     * @return AbstractParser
     */
    abstract protected function createParser();

    /**
     * Creates parser for test case
     */
    final protected function setUp()
    {
        $this->parser = $this->createParser();
    }

    /**
     * Test positive cases
     *
     * @param string $def
     * @param array $expectedResult
     *
     * @dataProvider providerDefs
     */
    final public function testParse($def, $expectedResult)
    {
        $result = $this->parser->parse($def);
        $this->assertTrue(is_array($result), 'Actual result is not array');
        foreach ($expectedResult as $key => $value) {
            $this->assertArrayHasKey($key, $result);
            $this->assertSame($value, $result[$key], $key);
        }
    }

    /**
     * Test error
     *
     * @dataProvider providerErrors
     */
    final public function testParseError($str)
    {
        $this->assertFalse($this->parser->parse($str));
    }
}
