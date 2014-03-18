<?php

namespace Dbff\Parser;

/**
 * Common structure for all dbff parsers
 *
 * @package Dbff\Parser
 */
abstract class AbstractParser implements ParserInterface
{
    /**
     * You can use this placeholders in {@see AbstractParser::match} method in pattern
     * to simplify regexps
     *
     * @var array
     */
    private $placeholders = [
        ':name' => "`.+?`|\S+",
    ];

    /**
     * Parse string and return struct
     *
     * @param string $str
     * @return array|bool   false on failure
     */
    final public function parse($str)
    {
        return $this->doParse($this->filterString($str));
    }

    /**
     * Filters input string
     *
     * - removes trailing spaces and semicolons
     * - replaces multiple spaces and newlines with one space
     * - removes conditional comments
     *
     * @param string $str
     * @return string
     */
    final protected function filterString($str)
    {
        $str = trim($str);
        $str = rtrim($str, ';');
        $str = str_replace(["\n", "\r"], ' ', $str);
        $str = preg_replace("~\s+~", ' ', $str);
        // There may be conditional comments (/*!40100 blabla */), simply remove them
        $str = preg_replace(["~\/\*!\d{5}\s*(.*?)\s*\*\/~ui"], ['$1'], $str);

        return $str;
    }

    /**
     * Does parsing itself
     *
     * @param string $str
     * @return array
     */
    abstract protected function doParse($str);

    /**
     * Helper method for simplified using preg_match with predefined placeholders
     *
     * @param string $pattern
     * @param string $subject
     * @return array|bool
     */
    final protected function match($pattern, $subject)
    {
        $pattern = str_replace(array_keys($this->placeholders), array_values($this->placeholders), $pattern);

        $matches = [];
        $isValid = preg_match("~^{$pattern}$~ui", $subject, $matches);
        if (!$isValid) {
            return false;
        }

        return $matches;
    }
}
