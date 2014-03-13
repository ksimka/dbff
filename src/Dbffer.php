<?php

namespace Dbff;

/**
 * Dbffer itself
 *
 * Compares two dbffable elements and returns dbff as array of differencies
 * 
 * @package Dbff
 */
class Dbffer
{
    /**
     * Compares two elements
     *
     * @param DbffableElement $dbffable1
     * @param DbffableElement $dbffable2
     * @return bool|array
     */
    public function compare(DbffableElement $dbffable1, DbffableElement $dbffable2) {
        // Can't compare element with different schemas
        if ($dbffable1->getSchema() !== $dbffable2->getSchema()) {
            return true;
        }

        $definition1 = $dbffable1->getDefinition();
        $definition2 = $dbffable2->getDefinition();

        $dbff = [];
        foreach ($dbffable1->getSchema() as $key) {
            // Definitions can contain collections
            if (
                $definition1[$key] instanceof DbffableCollection
                && $definition2[$key] instanceof DbffableCollection
            ) {
                $compareResult = $this->compareCollections($definition1[$key], $definition2[$key]);
                if ($compareResult) {
                    $dbff[$key] = $compareResult;
                }
                continue;
            }

            // Definitions can contain other elements
            if (
                $definition1[$key] instanceof DbffableElement
                && $definition2[$key] instanceof DbffableElement
            ) {
                $compareResult = $this->compare($definition1[$key], $definition2[$key]);
                if ($compareResult) {
                    $dbff[$key] = $compareResult;
                }
                continue;
            }

            // Compare any other type
            if ($definition1[$key] !== $definition2[$key]) {
                $dbff[$key] = [$definition1[$key], $definition2[$key]];
            }
        }

        return $dbff;
    }

    /**
     * Compares two collections
     *
     * @param DbffableCollection $collection1
     * @param DbffableCollection $collection2
     * @return array
     */
    public function compareCollections(DbffableCollection $collection1, DbffableCollection $collection2) {
        $dbff = [];

        // Different number of elements
        if ($collection1->getLength() != $collection2->getLength()) {
            $dbff['length'] = [$collection1->getLength(), $collection2->getLength()];
        }

        // Different names
        $namesDbff = [
            array_diff($collection1->getNames(), $collection2->getNames()),
            array_diff($collection2->getNames(), $collection1->getNames()),
        ];
        if ($namesDbff[0] || $namesDbff[1]) {
            $dbff['names'] = $namesDbff;
        }

        // Calc dbff for those elements that exist in both collections
        $namesIntersection = array_intersect($collection1->getNames(), $collection2->getNames());

        $elementsDbffs = [];
        foreach ($namesIntersection as $name) {
            $elementsDbff = $this->compare($collection1->get($name), $collection2->get($name));
            if ($elementsDbff) {
                $elementsDbffs[$name] = $elementsDbff;
            }
        }

        if ($elementsDbffs) {
            $dbff['dbff'] = $elementsDbffs;
        }

        return $dbff;
    }
} 